<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CounterBid;
use App\Models\CounterBidMeta;
use App\Models\PropertyAuction;
use App\Models\PropertyAuctionBid;
use App\Models\PropertyAuctionBidMeta;
use App\Models\User;
use Auth;

class CounterBidController extends Controller
{
    public function addListing(Request $request)
    {
        $page_data['title'] = 'Add Property Listing';
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        return view('seller_property.add', $page_data);
    }
    public function store(Request $request)
    {


        $dataa = PropertyAuctionBid::with('meta')->find($request->bid_id);
        $bid = new PropertyAuctionBid();
        // $bidDetails = PropertyAuctionBid::where('property_auction_id', $request->auction_id)->max('price');
        $counterBidmax = PropertyAuctionBid::where('counter_id', $request->bid_id)->max('price');
        // if ($request->counterAmount >= $bidDetails) {
        if ($request->counterAmount >= $counterBidmax) {
            $bid->user_id = $dataa->user_id;
            $bid->counter_id = $request->bid_id;
            $bid->property_auction_id = $dataa->property_auction_id;
            $bid->price = $request->counterAmount;
            $bid->inspection_period = $dataa->inspection_period ?? $dataa->get->inspection_period ?? null;
            $bid->save();
            $lastInsertedId = $bid->id;
            $bid->saveMeta(
                "custom_seller_financings_seller_financing_amount",
                $dataa->get->custom_seller_financings_seller_financing_amount ?? ''
            );
            $bid->saveMeta("custom_seller_financings_puchase_price", $dataa->get->custom_seller_financings_puchase_price ?? '');
            $bid->saveMeta("custom_seller_financings_down_payment", $dataa->get->custom_seller_financings_down_payment ?? '');
            $bid->saveMeta("custom_seller_financings_interest_rate", $dataa->get->custom_seller_financings_interest_rate ?? '');
            $bid->saveMeta("custom_seller_financings_term", $dataa->get->custom_seller_financings_term ?? '');
            $bid->saveMeta("custom_seller_financings_monthly_payments", $dataa->get->custom_seller_financings_monthly_payments ?? '');
            $bid->saveMeta("custom_seller_financings_balloon_payments", $dataa->get->custom_seller_financings_balloon_payments ?? '');
            $bid->saveMeta("custom_seller_financings_security", $dataa->get->custom_seller_financings_security ?? '');
            $bid->saveMeta("custom_seller_financings_prepayment_penalty", $dataa->get->custom_seller_financings_prepayment_penalty ?? '');
            $bid->saveMeta("custom_seller_financings_closing_costs", $dataa->get->custom_seller_financings_closing_costs ?? '');
            $bid->saveMeta("custom_exchange", $dataa->get->custom_exchange ?? '');
            $bid->saveMeta("custom_exchange_offered_value", $dataa->get->custom_exchange_offered_value ?? '');
            $bid->saveMeta("custom_exchange_offered_exchange", $dataa->get->custom_exchange_offered_exchange ?? '');
            $bid->saveMeta("custom_exchange_offered_exchange_item", $dataa->get->custom_exchange_offered_exchange_item ?? '');
            $bid->saveMeta("custom_exchange_price_adjustment", $dataa->get->custom_exchange_price_adjustment ?? '');
            $bid->saveMeta("custom_exchange_price_exchange", $dataa->get->custom_exchange_price_exchange ?? '');
            $bid->saveMeta("custom_exchange_additional", $dataa->get->custom_exchange_additional ?? '');
            $bid->saveMeta("custom_exchange_details", $dataa->get->custom_exchange_details ?? '');
            $bid->saveMeta("closing_days2", $dataa->get->closing_days2 ?? '');
            $bid->saveMeta("desired_days", $dataa->get->desired_days ?? '');
            $bid->saveMeta("carport", $dataa->get->carport ?? '');
            $bid->saveMeta("contingency", $dataa->get->contingency ?? '');
            $bid->saveMeta("custom_inspection", $dataa->get->custom_inspection ?? '');
            $bid->saveMeta("custom_seller_close", $dataa->get->custom_seller_close ?? '');
            $bid->saveMeta("custom_buyer_close", $dataa->get->custom_buyer_close ?? '');
            $bid->saveMeta("first_name", $dataa->get->first_name ?? '');
            $bid->saveMeta("last_name", $dataa->get->last_name ?? '');
            $bid->saveMeta("phone_number", $dataa->get->phone_number ?? '');
            $bid->saveMeta("email", $dataa->get->email ?? '');
            $bid->saveMeta("buyer_id", $dataa->get->buyer_id ?? '');
            $bid->saveMeta("proof_of_fund_url", $dataa->get->proof_of_fund_url ?? '');
            $bid->saveMeta('price', $dataa->get->price ?? '');
            $bid->saveMeta('financing', $dataa->get->financing ?? '');
            $bid->saveMeta('custom_term_financings', $dataa->get->custom_term_financings ?? '');
            $bid->saveMeta('escrow_amount', $dataa->get->escrow_amount ?? '');
            $bid->saveMeta('closing_date', $dataa->get->closing_date ?? '');
            $bid->saveMeta('contingencies', $dataa->get->contingencies ?? '');
            $bid->saveMeta('custom_contingencies', $dataa->get->custom_contingencies ?? '');
            $bid->saveMeta('seller_premium', $dataa->get->seller_premium ?? '');
            $bid->saveMeta('buyer_premium', $dataa->get->buyer_premium ?? '');
            $bid->saveMeta('buyer_type', $dataa->get->buyer_type ?? '');
            $bid->saveMeta('video_url', $dataa->get->video_url ?? '');
            $bid->saveMeta('inspection_period', $dataa->get->inspection_period ?? '');
            $auction = PropertyAuction::whereId($request->auction_id)->first();
            $data = PropertyAuction::whereId($request->auction_id)->first();
            $user = User::where('id', $auction->user_id)->first();
            $counterView = PropertyAuctionBid::with('meta')->find($lastInsertedId);
            // Redirecting back with query parameters
            return redirect()->back()->with(['success' => 'Your Counter Bid Has Been Added!', 'data' => $data, 'auction' => $auction, 'user' => $user]);
        } else {
            return redirect()->back()->with('error', 'Your Offered Price Should matched with Demonded price!');
        }

        // try {
        //     $serializedFormData = $data[0]->input('formData'); // Retrieve serialized data
        //     $formData = [];
        //     parse_str($serializedFormData, $formData);
        //     $counterBid = new CounterBid();
        //     $counterMeta = new CounterBidMeta();
        //     $sender = Auth::user();
        //     $receiver = User::where('id', $formData['userId'])->first();
        //     if ($formData['message'] != null) {
        //         $counterBid->sender_id = $sender->id;
        //         $counterBid->receiver_id = $formData['userId'];
        //         $counterBid->save();
        //         $counterMeta->message = $formData['message'];
        //         $counterMeta->receiver_id = $formData['userId'];
        //         $counterMeta->sender_id = $sender->id;
        //         $counterMeta->receiver = $receiver->name;
        //         $counterMeta->sender = $sender->name;
        //         $counterMeta->save();
        //         return response()->json(['redirectTo' => route('counterBiding'), 'success' => 'sdafjsla']);
        //     }
        // } catch (\Exception $e) {
        //     // dd($e);
        //     // Log the error or handle it appropriately
        //     // For example, log the error message:
        //     return response()->json(['redirectTo' => route('counterBiding'), 'error' => 'sdafjsla']);

        //     // You might want to return an error response or perform other actions based on your application's needs.
        // }
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function list()
    {
    }


    public function viewPropertyListing()
    {
    }

    public function searchListing()
    {
    }
}
