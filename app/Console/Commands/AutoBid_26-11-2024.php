<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\PropertyAuction;
use Illuminate\Console\Command;
use App\Models\PropertyAuctionBid;
use Illuminate\Support\Facades\DB;

class AutoBid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoBid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $propertyAuctions = PropertyAuction::where('auto_bid', 1)
            ->where('sold', 0)
            ->whereNull('sold_date')
            ->get();
        foreach ($propertyAuctions as $propertyAuction) {

            $propertyauctions_data = collect($propertyAuction->bids)->where('auto_bid_record', '!=', 1)->all();
            $maxBid = collect($propertyauctions_data)->where('price', collect($propertyauctions_data)->pluck('price')->max())->first();
            $maxBidPrice = $maxBid->price;
            // dd($maxBidPrice);
            $seller_price = $propertyAuction->autobid_price;  // minimum
            $seller_price2 = $propertyAuction->autobid_price2; //reserve
            $seller_price3 = $propertyAuction->autobid_price3; //buy now
            $price = null; // Initialize $price to null or any default value as needed
            $totalBoots = User::where('user_type', 'bot')->count();
            // Condition if bot is there then bid happend else not
            if ($totalBoots > 0) {
                // Generate a random number between 1 and the total number of boots
                $randomNumber = rand(1, $totalBoots);
                // Fetch the user with the boot user_type at the random offset
                $randomBoot = User::where('user_type', 'bot')->skip($randomNumber - 1)->take(1)->first();
                // Use the $randomBoot object to access the user's properties
                $randomBootId = $randomBoot->id;
                if ($seller_price > $maxBidPrice) {
                    $price = $seller_price;
                } elseif ($seller_price2 > $maxBidPrice) {
                    $price = $seller_price2;
                } elseif ($seller_price3 > $maxBidPrice) {
                    $price = $seller_price3;
                }
                if ($price) {
                    $new_propertyAuction_bid = new PropertyAuctionBid();
                    $new_propertyAuction_bid->property_auction_id = $maxBid->property_auction_id;
                    $new_propertyAuction_bid->user_id = $randomBootId;
                    $new_propertyAuction_bid->price = $price;
                    $new_propertyAuction_bid->autobid_maximum_price = "null";
                    $new_propertyAuction_bid->auto_bid_record = 0;
                    $new_propertyAuction_bid->save();
                    // Changes 31 May 2023
                    $new_propertyAuction_bid->saveMeta('price', $price);
                    $new_propertyAuction_bid->saveMeta('financing', 'Cash');
                    $new_propertyAuction_bid->saveMeta('custom_term_financings', "null");
                    $new_propertyAuction_bid->saveMeta('escrow_amount', "0");
                    $new_propertyAuction_bid->saveMeta('inspection_period', Carbon::now());
                    $new_propertyAuction_bid->saveMeta('closing_date', Carbon::now());
                    $new_propertyAuction_bid->saveMeta('contingencies', "Home Inspection");
                    $new_propertyAuction_bid->saveMeta('custom_contingencies', null);
                    $new_propertyAuction_bid->saveMeta('seller_premium', null);
                    $new_propertyAuction_bid->saveMeta('buyer_premium', "Buyer");
                    $new_propertyAuction_bid->saveMeta('buyer_type', "");
                    $new_propertyAuction_bid->saveMeta('video_url', "https://www.koqy.mobi");
                }
            }
        }
    }
}
