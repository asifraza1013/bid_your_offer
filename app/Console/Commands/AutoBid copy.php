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
        $this->info('here');
        $propertyAuctions = PropertyAuction::where('auto_bid', 1)
            ->where('sold', 0)
            ->whereNull('sold_date')
            ->get();
        foreach ($propertyAuctions as $propertyAuction) {

            $propertyauctions_data = collect($propertyAuction->bids)->where('auto_bid_record', '!=', 1)->all();
            foreach ($propertyauctions_data as $propertybid) {
                // Property AUction Setting Data
                $seller_price = $propertyAuction->autobid_price;  // minimum
                $seller_price2 = $propertyAuction->autobid_price2; //reserve
                $seller_price3 = $propertyAuction->autobid_price3; //buy now
                $seller_inspection_period = $propertyAuction->inspection_period;
                $seller_inspection_period2 = $propertyAuction->inspection_period2;
                $seller_closing_days = $propertyAuction->closing_days;
                $seller_closing_days2 = $propertyAuction->closing_days2;
                $seller_escrow_amount = $propertyAuction->escrow_amount;
                $seller_escrow_amount2 = $propertyAuction->escrow_amount2;
                $seller_maximum_escrow = max($seller_escrow_amount, $seller_escrow_amount2);
                $seller_minimum_inspection = min($seller_inspection_period, $seller_inspection_period2);
                $seller_minimum_closing = min($seller_closing_days, $seller_closing_days2);
                $user_id = $propertyAuction->user_id;
                $property_id = $propertyAuction->id;
                $max_seller =  max($seller_price, $seller_price2, $seller_price3);
                $min_seller =  min($seller_price, $seller_price2, $seller_price3);
                $second_lowest_price = collect([$seller_price, $seller_price2, $seller_price3])
                    ->sort()
                    ->values()[1];
                // Property Auction  setting Data ENd
                $buyer_price = $propertybid->autobid_price; //bid1
                $buyer_price3 = $propertybid->autobid_price3; //bid3
                $buyer_inspection_period = $propertybid->inspection_period;
                $buyer_inspection_period2 = $propertybid->inspection_period2;
                $buyer_closing_days = $propertybid->closing_days;
                $buyer_closing_days2 = $propertybid->closing_days2;
                $buyer_escrow_amount = $propertybid->escrow_amount;
                $buyer_escrow_amount2 = $propertybid->escrow_amount2;
                $buyer_maximum_escrow = max($buyer_inspection_period, $buyer_inspection_period2);
                $buyer_minimum_inspection = min($buyer_inspection_period, $buyer_inspection_period2);
                $buyer_minimum_closing = min($buyer_closing_days, $buyer_closing_days2);
                $user_id1 = $propertybid->user_id;
                $max_buyer = max($buyer_price, $buyer_price3);
                // Getting the Bots
                $totalBoots = User::where('user_type', 'bot')->count();
                // Condition if bot is there then bid happend else not
                if ($totalBoots > 0) {
                    // Generate a random number between 1 and the total number of boots
                    $randomNumber = rand(1, $totalBoots);
                    // Fetch the user with the boot user_type at the random offset
                    $randomBoot = User::where('user_type', 'bot')->skip($randomNumber - 1)->take(1)->first();
                    // Use the $randomBoot object to access the user's properties
                    $randomBootId = $randomBoot->id;
                    if ($max_buyer > $min_seller) {
                        // Changes 31 May 2023
                        if ($buyer_price < $min_seller) {

                            if ($buyer_price3 < $second_lowest_price) {
                            }

                            if ($buyer_price3 > $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                            if ($buyer_price3 == $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                        }
                        if ($buyer_price > $min_seller) {
                            if ($buyer_price3 > $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                            if ($buyer_price3 == $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                        }
                        if ($buyer_price == $min_seller) {
                            if ($buyer_price3 > $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                            if ($buyer_price3 == $second_lowest_price) {
                                if ($buyer_price3 < $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 > $max_seller) {
                                    $price = $buyer_price3;
                                }
                                if ($buyer_price3 == $max_seller) {
                                    $price = $buyer_price3;
                                }
                            }
                        }
                    }

                    if (isset($price)) {
                        if ($propertybid->autobid_user_id !== $user_id1 && $propertybid->autobid_maximum_price !== $price) {
                            $new_propertyAuction_bid = new PropertyAuctionBid();
                            $new_propertyAuction_bid->property_auction_id = $property_id;
                            // Passing the Random Bot id to Auction Bid user id
                            $new_propertyAuction_bid->user_id = $propertybid->user_id;
                            //Passing the user id of bid for revoking the duplicate entry
                            $new_propertyAuction_bid->autobid_user_id = $user_id1;
                            //Passing the Random Bot id to Auction Bid user id End
                            $new_propertyAuction_bid->price = $price;
                            $new_propertyAuction_bid->autobid_maximum_price = $price;
                            $new_propertyAuction_bid->auto_bid_record = 1;
                            $new_propertyAuction_bid->save();
                            if ($buyer_minimum_closing > $seller_minimum_closing && $buyer_minimum_inspection > $seller_minimum_inspection && $buyer_maximum_escrow < $seller_maximum_escrow) {
                                $message[] = "Escrow Amount is Low";
                                $message[] = "Closing Date is Exceeded";
                                $message[] = "Inspection Days is Exceeded";
                            } elseif ($buyer_minimum_closing > $seller_minimum_closing &&  $buyer_minimum_inspection > $seller_minimum_inspection) {
                                $message[] = "Closing Date is Exceeded";
                                $message[] = "Inspection Days is Exceeded";
                            } elseif ($buyer_minimum_closing > $seller_minimum_closing && $buyer_maximum_escrow < $seller_maximum_escrow) {
                                $message[] = "Closing Date is Exceeded";
                                $message[] = "Escrow Amount is Low";
                            } elseif ($buyer_maximum_escrow < $seller_maximum_escrow && $buyer_minimum_inspection > $seller_minimum_inspection) {
                                $message[] = "Inspection Days is Exceeded";
                                $message[] = "Escrow Amount is Low";
                            } elseif ($buyer_minimum_inspection > $seller_minimum_inspection) {
                                $message[] = "Inspection Days is Exceeded";
                            } elseif ($buyer_maximum_escrow < $seller_maximum_escrow) {
                                $message[] = "Escrow Amount is Low";
                            } else if ($buyer_minimum_closing > $seller_minimum_closing) {
                                $message[] = "Closing Date is Exceeded";
                            }
                            if ($message) {
                                $message = json_encode($message);
                                $notification = new Notification;
                                $notification->message = $message;
                                $notification->user_id = $user_id;
                                $notification->property_auction_id = $property_id;
                                $notification->property_auction_bid_id = $new_propertyAuction_bid->id;
                                $notification->save();
                            }
                            $new_propertyAuction_bid->notification_id = $notification->id;
                            $propertyAuction->notification_id = $notification->id;
                            $start = Carbon::now();
                            $end = Carbon::parse(@$propertyAuction->created_at)->addDays(@$propertyAuction->get->auction_length_days);
                            $diffInSeconds = ($end->getTimestamp() -  $start->getTimestamp());
                            if ($diffInSeconds <= 3000) {
                                $propertyAuction->created_at = date('Y-m-d H:i:s', strtotime($propertyAuction->created_at . '+10 minutes'));
                            }
                            $propertyAuction->update();
                            $new_propertyAuction_bid->update();
                            $new_propertyAuction_bid->saveMeta('price', $new_propertyAuction_bid->price);
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
                            $propertybid->autobid_user_id = $user_id1;
                            $propertybid->autobid_maximum_price = $price;
                            $propertybid->update();
                        }
                    }
                }
            }
        }
    }
}
