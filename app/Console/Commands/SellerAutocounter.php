<?php

namespace App\Console\Commands;

use App\Models\PropertyAuctionBid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerAutocounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seller:autocounter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to autocounter for buyer bids from seller';

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
        Log::info('SellerAutocounter Init');

        $propertyAuctionBids = PropertyAuctionBid::with(['auction', 'auction.meta', 'meta'])
            ->whereHas('auction', function ($query) {
                $query->where('sold', '!=', 1)
                    ->whereNotNull('escrow_amount');
            })
            ->where('accepted', '!=', 1)
            ->whereNull('accepted_date')
            ->get();

        $bidsGroupedByAuction = $propertyAuctionBids->groupBy('property_auction_id');

        Log::info('totalSellerBids ' . count($bidsGroupedByAuction));
        foreach ($bidsGroupedByAuction as $propertyAuctionId => $bids) {
            $originalBid = $bids->sortByDesc('price')->first(); // Get the highest bid

            if ($originalBid->user_id == $originalBid->auction->user_id) {
                Log::info('returningBackAsMainBidFound ');
                continue;
            }

            Log::info('currentBidID ' . $originalBid->id);
            $maxBidPrice = $originalBid->price;
            $escrowAmount = $originalBid->auction->escrow_amount;
            $counterBidPrice = $maxBidPrice + $escrowAmount;

            // Clone the original bid
            $newBid = $originalBid->replicate();
            $newBid->user_id = $originalBid->auction->user_id;
            $newBid->counter_id = $originalBid->id;
            $newBid->price = $counterBidPrice;
            $newBid->autobid_price = $counterBidPrice;

            $newBid->save();

            // Clone associated meta data
            foreach ($originalBid->meta as $originalMeta) {

                $newMeta = $originalMeta->replicate();
                $newMeta->property_auction_bid_id = $newBid->id;

                if ($originalMeta->meta_key === 'autobid_price') {
                    $newMeta->meta_value = $counterBidPrice;
                }
                if ($originalMeta->meta_key === 'price') {
                    $newMeta->meta_value = $counterBidPrice;
                }

                $newMeta->save();
            }
        }
    }
}
