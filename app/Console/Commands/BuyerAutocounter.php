<?php

namespace App\Console\Commands;

use App\Models\PropertyAuctionBid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyerAutocounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buyer:autocounter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to autocounter for seller bids from buyer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('BuyerAutoCounter Init');

        // Fetch PropertyAuctionBids along with their related auction and meta data
        $propertyAuctionBids = PropertyAuctionBid::with(['auction', 'auction.meta', 'meta'])
            ->whereHas('auction', function ($query) {
                $query->where('sold', '!=', 1);
            })
            ->whereHas('meta', function ($query) {
                $query->where('meta_key', 'autobid_price')
                    ->whereNotNull('meta_value'); // Ensure autobid_price is not null
            })
            ->where('accepted', '!=', 1)
            ->whereNull('accepted_date')
            ->whereNotNull('counter_id')
            ->select('id', 'property_auction_id', DB::raw('MAX(price) as max_price')) // Include 'id' in the select statement
            ->groupBy('id', 'property_auction_id') // Group by 'id' as well
            ->get()
            ->filter(function ($bid) {
                Log::info('buyerFilterBidID '.$bid->id);

                // Ensure meta values exist for the current bid
                $autobidPriceMeta = $bid->meta->firstWhere('meta_key', 'autobid_price');
                $increaseBidPriceMeta = $bid->meta->firstWhere('meta_key', 'autobid_escrow_deposit');

                if ($autobidPriceMeta && $increaseBidPriceMeta) {
                    $autobidPrice = (float)$autobidPriceMeta->meta_value;
                    $increaseBidPrice = (float)$increaseBidPriceMeta->meta_value;

                    // Check if max_price + autobid_price is less than increase_bid_price
                    return ($bid->max_price + $autobidPrice) < $increaseBidPrice;
                }

                return false;
            });


        Log::info('BuyerTotalBids ' . count($propertyAuctionBids));

        // Iterate over filtered property auction bids and create counter bids
        foreach ($propertyAuctionBids as $originalBid) {
            Log::info('OriginalBidId ' . $originalBid->id);

            // Check if the necessary auction data exists
            $auction = $originalBid->auction;
            if (!$auction) {
                Log::warning('No auction found for PropertyAuctionBid ID: ' . $originalBid->id);
                continue; // Skip if auction data is missing
            }

            $maxBidPrice = $originalBid->max_price;
            $escrowAmount = $auction->escrow_amount;
            $counterBidPrice = (float) $maxBidPrice + (float) $escrowAmount;

            // Create a new counter bid based on the original bid
            $newBid = new PropertyAuctionBid();
            $newBid->user_id = $auction->user_id;
            $newBid->counter_id = $originalBid->id;
            $newBid->property_auction_id = $originalBid->property_auction_id;
            $newBid->price = $counterBidPrice;
            $newBid->inspection_period = $originalBid->inspection_period;
            $newBid->autobid_price = $counterBidPrice;
            $newBid->closing_days = $originalBid->closing_days;
            $newBid->escrow_amount = $originalBid->escrow_amount;

            // Save the new bid
            $newBid->save();

            // Clone meta entries from the original bid
            foreach ($originalBid->meta as $originalMeta) {
                Log::info('Cloning Meta for OriginalBidId ' . $originalBid->id);

                $newMeta = $originalMeta->replicate(); // Clone the original meta entry
                $newMeta->property_auction_bid_id = $newBid->id; // Associate the cloned meta with the new bid

                // Ensure the correct meta values are set
                if ($originalMeta->meta_key === 'autobid_price') {
                    $newMeta->meta_value = $counterBidPrice; // Update autobid_price value
                }
                if ($originalMeta->meta_key === 'price') {
                    $newMeta->meta_value = $counterBidPrice; // Update price value
                }

                // Save the cloned meta entry
                $newMeta->save();
            }
        }
    }
}
