<?php

namespace App\Http\Controllers;

use App\Models\LandlordAgentAuction;
use App\Models\LandlordAgentAuctionBid;
use App\Models\UserAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandlordAgentAuctionBidController extends Controller
{
    public function add_bid($id, Request $request)
    {
        $auction = LandlordAgentAuction::find($id);
        $title = "Add Bid to Hire a Listing Agent Listing";
        return view('hire_landlord_agent.add-bid', compact('title', 'auction'));
    }


    public function save_bid(Request $request)
    {
        // dd($request->all());

        $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
        $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf
        $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
        $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv'];

        // try {
        //     DB::beginTransaction();
        $bid = new LandlordAgentAuctionBid();
        $bid->user_id = Auth::user()->id;
        $bid->landlord_agent_auction_id = $request->auction_id;
        $bid->save();
        $bid->saveMeta("auction_id", $request->auction_id);
        $bid->saveMeta("listing_terms", $request->listing_terms);
        $bid->saveMeta("custom_listing_terms", $request->custom_listing_terms);
        $bid->saveMeta("offering_price", $request->offering_price);
        $bid->saveMeta("agentCommission", $request->agentCommission);
        $bid->saveMeta("agentCommissionOther", $request->agentCommissionOther);
        $bid->saveMeta("commissionRetianOpt", $request->commissionRetianOpt);
        $bid->saveMeta("customRetainCommission", $request->customRetainCommission);
        $bid->saveMeta("agentCharges", $request->agentCharges);
        $bid->saveMeta("broker_compensation", $request->broker_compensation);
        $bid->saveMeta("compensation_percent", $request->compensation_percent);
        $bid->saveMeta("handle_compensation", $request->handle_compensation);
        $bid->saveMeta("compensation_amount", $request->compensation_amount);
        $bid->saveMeta("compensation_tenant_broker", $request->compensation_tenant_broker);
        $bid->saveMeta("payment_timing", $request->payment_timing);
        $bid->saveMeta("payment_timing_days", $request->payment_timing_days);
        $bid->saveMeta("early_termination", $request->early_termination);
        $bid->saveMeta("early_termination_amount", $request->early_termination_amount);
        $bid->saveMeta("protection_period", $request->protection_period);
        $bid->saveMeta("protection_period_days", $request->protection_period_days);
        $bid->saveMeta("compensation_new_lease_percent", $request->compensation_new_lease_percent);
        $bid->saveMeta("compensation_new_lease_amount", $request->compensation_new_lease_amount);
        $bid->saveMeta("compensation_new_lease", $request->compensation_new_lease);
        $bid->saveMeta("custom_agent_charges", $request->custom_agent_charges);
        $bid->saveMeta("services", json_encode($request->services));
        $bid->saveMeta("other_services", $request->other_services);
        $bid->saveMeta("bio", $request->bio);
        $bid->saveMeta("why_hire_you", $request->why_hire_you);
        $bid->saveMeta("what_sets_you_apart", $request->what_sets_you_apart);
        $bid->saveMeta("marketing_plan", $request->marketing_plan);
        $bid->saveMeta("website_link", json_encode($request->website_link));
        $bid->saveMeta("reviews_link", json_encode($request->reviews_link));
        $bid->saveMeta("socialType", json_encode($request->socialType));
        $bid->saveMeta("social_link", json_encode($request->social_link));
        $bid->saveMeta("licensed", $request->licensed);
        $bid->saveMeta("first_name", $request->first_name);
        $bid->saveMeta("last_name", $request->last_name);
        $bid->saveMeta("agent_phone", $request->agent_phone);
        $bid->saveMeta("agent_email", $request->agent_email);
        $bid->saveMeta("agent_brokerage", $request->agent_brokerage);
        $bid->saveMeta("agent_license_no", $request->agent_license_no);
        $bid->saveMeta("mls_id", $request->mls_id);
        $bid->saveMeta("bid_on_hirenow_terms", $request->bid_on_hirenow_terms);

        if ($request->hasFile('video_file')) {
            $file = $request->video_file;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedVideos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $fileName = $uuid . '.' . $extension;
                $file->move(public_path('auction/files'), $fileName);
                $bid->saveMeta('video_file', 'auction/files/' . $fileName);
            }
        }

        if ($request->hasFile('card')) {
            $file = $request->card;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedPhotos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $fileName = $uuid . '.' . $extension;
                $file->move(public_path('auction/images'), $fileName);
                $bid->saveMeta('card', 'auction/images/' . $fileName);
            }
        }
        if ($request->hasFile('promo')) {
            $files = $request->file('promo');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);

                if ($check) {
                    $uuid = Str::uuid();
                    $fileName = $uuid . '.' . $extension;
                    $file->move(public_path('auction/files'), $fileName);
                    // Assuming $bid is defined somewhere in your code
                    $bid->saveMeta('promo', 'auction/files/' . $fileName);
                }
            }
        }
        // DB::commit();

        $hireNowTerms = [
            'listing_term',
            'custom_listing_terms',
            'broker_compensation', 
            'compensation_percent', 
            'handle_compensation', 
            'compensation_amount', 
            'compensation_tenant_broker',
            'payment_timing',
            'payment_timing_days',
            'early_termination',
            'early_termination_amount',
            'protection_period',
            'protection_period_days',
            'compensation_new_lease_percent',
            'compensation_new_lease_amount',
            'compensation_new_lease'
        ];

        $this->checkHireNowTerms($request, $hireNowTerms, $request->auction_id, $bid->id);

        $route = route('landlord.agent.auction.view', $request->auction_id);
        return redirect()->to($route)->with('success', 'Bid added successfully.');
        // } catch (\Exception $e) {
        //throw $e;
        DB::rollBack();
        return $e->getMessage();
        return redirect()->back()->with('error', 'Unable to add bid on Landlord\'s Agent Auction.');
        // }
    }

    public function view($bid_id)
    {
        $bid = LandlordAgentAuctionBid::findOrFail($bid_id);
        return view('hire_landlord_agent.view-bid', compact('bid'));
    }


    public function accept_bid(Request $request)
    {
        try {
            DB::beginTransaction();
            $bid = LandlordAgentAuctionBid::whereId($request->bid_id)->first();
            $bid->accepted = 1;
            $bid->accepted_date = date('Y-m-d H:i:s');
            $bid->save();

            $auction = LandlordAgentAuction::whereId($request->auction_id)->first();
            $auction->is_sold = true;
            $auction->sold_date = date('Y-m-d H:i:s');
            $auction->save();

            $ua = new UserAgent();
            $ua->user_id = Auth::user()->id;
            $ua->agent_id = $bid->user_id;
            $ua->type = 'landlord';
            $ua->save();

            DB::commit();
            return redirect()->back()->with('success', 'Bid Accepted successfully!');
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'Some problem in bid acceptance!');
        }
    }

    public function reject_bid(Request $request)
    {
        $bid = LandlordAgentAuctionBid::whereId($request->bid_id)->first();
        $bid->accepted = 2;
        $bid->save();
        return redirect()->back()->with('success', 'Bid Rejected successfully!');
    }

    public function addCounterBid(Request $request, $bid_id)
    {
        // dd($bid_id);
        $auction_bid = LandlordAgentAuctionBid::find($bid_id);
        $page_data['auction'] = $auction = LandlordAgentAuction::find($auction_bid->landlord_agent_auction_id);
        $page_data['title'] = "Add Counter Bid for Landlord's Agent - {$auction->titleListing}";
        $page_data['bid'] = $auction_bid;
        return view('hire_landlord_agent.add-counter-bid', $page_data);
    }

    public function saveCounterBid(Request $request, $bid_id)
    {
        $auctionBid = LandlordAgentAuctionBid::with('meta')->find($bid_id);
        $bid = new LandlordAgentAuctionBid();

        $bid->user_id = Auth::user()->id;
        $bid->counter_id = $bid_id;
        $bid->landlord_agent_auction_id = $auctionBid->landlord_agent_auction_id;
        $bid->save();
        $bid->saveMeta("auction_id", $request->auction_id);
        $bid->saveMeta("listing_terms", $request->listing_terms);
        $bid->saveMeta("custom_listing_terms", $request->custom_listing_terms);
        $bid->saveMeta("offering_price", $request->offering_price);
        $bid->saveMeta("agentCommission", $request->agentCommission);
        $bid->saveMeta("agentCommissionOther", $request->agentCommissionOther);
        $bid->saveMeta("commissionRetianOpt", $request->commissionRetianOpt);
        $bid->saveMeta("customRetainCommission", $request->customRetainCommission);
        $bid->saveMeta("broker_compensation", $request->broker_compensation);
        $bid->saveMeta("compensation_percent", $request->compensation_percent);
        $bid->saveMeta("handle_compensation", $request->handle_compensation);
        $bid->saveMeta("compensation_amount", $request->compensation_amount);
        $bid->saveMeta("compensation_tenant_broker", $request->compensation_tenant_broker);
        $bid->saveMeta("payment_timing", $request->payment_timing);
        $bid->saveMeta("payment_timing_days", $request->payment_timing_days);
        $bid->saveMeta("early_termination", $request->early_termination);
        $bid->saveMeta("early_termination_amount", $request->early_termination_amount);
        $bid->saveMeta("protection_period", $request->protection_period);
        $bid->saveMeta("protection_period_days", $request->protection_period_days);
        $bid->saveMeta("compensation_new_lease_percent", $request->compensation_new_lease_percent);
        $bid->saveMeta("compensation_new_lease_amount", $request->compensation_new_lease_amount);
        $bid->saveMeta("compensation_new_lease", $request->compensation_new_lease);
        $bid->saveMeta("agentCharges", $request->agentCharges);
        $bid->saveMeta("custom_agent_charges", $request->custom_agent_charges);
        $bid->saveMeta("services", json_encode($request->services));
        $bid->saveMeta("other_services", $request->other_services);
        $bid->saveMeta("bio", $request->bio);
        $bid->saveMeta("why_hire_you", $request->why_hire_you);
        $bid->saveMeta("what_sets_you_apart", $request->what_sets_you_apart);
        $bid->saveMeta("marketing_plan", $request->marketing_plan);
        $bid->saveMeta("website_link", json_encode($request->website_link));
        $bid->saveMeta("reviews_link", json_encode($request->reviews_link));
        $bid->saveMeta("socialType", json_encode($request->socialType));
        $bid->saveMeta("social_link", json_encode($request->social_link));
        $bid->saveMeta("licensed", $request->licensed);
        $bid->saveMeta("first_name", $request->first_name);
        $bid->saveMeta("last_name", $request->last_name);
        $bid->saveMeta("agent_phone", $request->agent_phone);
        $bid->saveMeta("agent_email", $request->agent_email);
        $bid->saveMeta("agent_brokerage", $request->agent_brokerage);
        $bid->saveMeta("agent_license_no", $request->agent_license_no);
        $bid->saveMeta("mls_id", $request->mls_id);
        $bid->saveMeta("bid_on_hirenow_terms", $request->bid_on_hirenow_terms);


        $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
        $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf
        $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
        $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv'];

        if ($request->hasFile('video_file')) {
            $file = $request->video_file;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedVideos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $fileName = $uuid . '.' . $extension;
                $file->move(public_path('auction/files'), $fileName);
                $bid->saveMeta('video_file', 'auction/files/' . $fileName);
            }
        }

        if ($request->hasFile('card')) {
            $file = $request->card;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedPhotos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $fileName = $uuid . '.' . $extension;
                $file->move(public_path('auction/images'), $fileName);
                $bid->saveMeta('card', 'auction/images/' . $fileName);
            }
        }
        if ($request->hasFile('promo')) {
            $files = $request->file('promo');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);

                if ($check) {
                    $uuid = Str::uuid();
                    $fileName = $uuid . '.' . $extension;
                    $file->move(public_path('auction/files'), $fileName);
                    // Assuming $bid is defined somewhere in your code
                    $bid->saveMeta('promo', 'auction/files/' . $fileName);
                }
            }
        }

        $route = route('landlord.agent.auction.view', $auctionBid->landlord_agent_auction_id);
        return redirect()->to($route)->with('success', 'Counter Bid placed successfully!');
    }

    private function checkHireNowTerms($req, $terms, $auction_id, $bid_id)
    {
        $auction = LandlordAgentAuction::find($auction_id);
        $bid = LandlordAgentAuctionBid::find($bid_id);

        if (!$auction) {
            return false;
        }

        // Check terms
        foreach ($terms as $term) {
            if ($req->has($term) && $req->input($term) != $auction->$term) {
                return false; // Found a mismatch, return false immediately
            }
        }

        // Check services
        if (!empty($req->services) && is_array($req->services)) {
            foreach ($req->services as $service) {
                if (!in_array($service, json_decode($auction->services, true))) {
                    return false; // Found a mismatch, return false immediately
                }
            }
        }

        // If everything is valid, update auction
        DB::beginTransaction();
        $bid->accepted = 1;
        $bid->accepted_date = date('Y-m-d H:i:s');
        $bid->save();

        $auction->auction_ended = 1;
        $auction->is_sold = true;
        $auction->sold_date = date('Y-m-d H:i:s');
        $auction->save();

        $ua = new UserAgent();
        $ua->user_id = Auth::user()->id;
        $ua->agent_id = $bid->user_id;
        $ua->type = 'landlord';
        $ua->save();
        DB::commit();

        return true;
    }
}