<?php

namespace App\Http\Controllers;

use App\Models\BuyerCriteriaAuction;
use App\Models\BuyerCriteriaAuctionBid;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuyerCriteriaAuctionBidController extends Controller
{
    public function add_bid($id)
    {
        // dd($id);
        $page_data['auction'] = BuyerCriteriaAuction::find($id);
        $page_data['title'] = "Add Bid for Buyer's Criteria Auction - ". $page_data['auction']->address;
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        // dd($page_data);
        return view('buyer_criteria.add-bid', $page_data);
    }
    //
    public function save_bid($id, Request $request)
    {

        // dd($request->all());

        try {
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf
            $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];

            DB::beginTransaction();
            $bid = new BuyerCriteriaAuctionBid();
            $bid->user_id = Auth::user()->id;
            $bid->buyer_criteria_auction_id = $id;
            $bid->save();

            // changes
            $bid->saveMeta("auction_id", $request->auction_id);
            $bid->saveMeta("city", $request->city);
            $bid->saveMeta("county", $request->county);
            $bid->saveMeta("state", $request->state);
            $bid->saveMeta("property_type", $request->property_type);
            $bid->saveMeta("property_items", $request->property_items);
            $bid->saveMeta("sale_include", $request->sale_include);
            $bid->saveMeta("businessName", $request->businessName);
            $bid->saveMeta("yearEstablish", $request->yearEstablish);
            $bid->saveMeta("lincenses", json_encode($request->lincenses));
            $bid->saveMeta("operating_expenses", $request->operating_expenses);
            $bid->saveMeta("net_operating_income", $request->net_operating_income);
            $bid->saveMeta("net_operating_income_type", $request->net_operating_income_type);
            $bid->saveMeta("annual_expenses", $request->annual_expenses);
            $bid->saveMeta("annual_ttl_schedule_income", $request->annual_ttl_schedule_income);
            $bid->saveMeta("annual_income_type", $request->annual_income_type);
            $bid->saveMeta("number_of_tenants", $request->number_of_tenants);
            $bid->saveMeta("inspection", $request->inspection);
            $bid->saveMeta("custom_inspection", $request->custom_inspection);
            $bid->saveMeta("unitTypes", json_encode($request->unitTypes));
            $bid->saveMeta("heatedSqft", json_encode($request->heatedSqft));
            $bid->saveMeta("unitNumber", json_encode($request->unitNumber));
            $bid->saveMeta("expected_rent", $request->expected_rent);
            $bid->saveMeta("garageSpaces", json_encode($request->garageSpaces));
            $bid->saveMeta("bedsUnit", json_encode($request->bedsUnit));
            $bid->saveMeta("bathUnit", json_encode($request->bathUnit));
            $bid->saveMeta("unit_type_of_description", $request->unit_type_of_description);
            $bid->saveMeta("total_monthly_rent", $request->total_monthly_rent);
            $bid->saveMeta("total_number_of_units", $request->total_number_of_units);
            $bid->saveMeta("total_monthly_expenses", $request->total_monthly_expenses);
            $bid->saveMeta("lease_terms", $request->lease_terms);
            $bid->saveMeta("annual_net_income", $request->annual_net_income);
            $bid->saveMeta("annual_gross_income", $request->annual_gross_income);
            $bid->saveMeta("est_annual_market_income", $request->est_annual_market_income);
            $bid->saveMeta("terms_of_lease", $request->terms_of_lease);
            $bid->saveMeta("tenant_pays", $request->tenant_pays);
            $bid->saveMeta("tenantPays", $request->tenantPays);
            $bid->saveMeta("financial_sources", $request->financial_sources);
            $bid->saveMeta("occupied", $request->occupied);
            $bid->saveMeta("saleProvisions", json_encode($request->saleProvisions));
            $bid->saveMeta("assignment_contract", json_encode($request->assignment_contract));
            $bid->saveMeta("custom_assignment", $request->custom_assignment);
            $bid->saveMeta("bedrooms", $request->bedrooms);
            $bid->saveMeta("custom_bedrooms", $request->custom_bedrooms);
            $bid->saveMeta("bathrooms", $request->bathrooms);
            $bid->saveMeta("custom_bathrooms", $request->custom_bathrooms);
            $bid->saveMeta("min_sqft", $request->min_sqft);
            $bid->saveMeta("lot_size", $request->lot_size);
            $bid->saveMeta("other_floor_in_property", $request->other_floor_in_property);
            $bid->saveMeta("flood_insurance", $request->flood_insurance);
            $bid->saveMeta("custom_insurance", $request->custom_insurance);
            $bid->saveMeta("pets", $request->pets);
            $bid->saveMeta("custom_pets", $request->custom_pets);
            $bid->saveMeta("number_of_pets", $request->number_of_pets);
            $bid->saveMeta("pet_weight", $request->pet_weight);
            $bid->saveMeta("pet_restrictions", $request->pet_restrictions);
            $bid->saveMeta("associationOpt", $request->associationOpt);
            $bid->saveMeta("custom_garage", $request->custom_garage);
            $bid->saveMeta("paymentSchedule", $request->paymentSchedule);
            $bid->saveMeta("condoFee", $request->condoFee);
            $bid->saveMeta("condoSchedule", $request->condoSchedule);
            $bid->saveMeta("masterAssoc", $request->masterAssoc);
            $bid->saveMeta("csutomMasterAssoc", $request->csutomMasterAssoc);
            $bid->saveMeta("masterAssocFee", $request->masterAssocFee);
            $bid->saveMeta("masterAssocName", $request->masterAssocName);
            $bid->saveMeta("masterAssocPhone", $request->masterAssocPhone);
            $bid->saveMeta("additionalFee", $request->additionalFee);
            $bid->saveMeta("customFee", $request->customFee);
            $bid->saveMeta("otherFee", $request->otherFee);
            $bid->saveMeta("otherScheduleFee", $request->otherScheduleFee);
            $bid->saveMeta("mangerName", $request->mangerName);
            $bid->saveMeta("managerEmail", $request->managerEmail);
            $bid->saveMeta("managerPhone", $request->managerPhone);
            $bid->saveMeta("managerWeb", $request->managerWeb);
            $bid->saveMeta("houses", $request->houses);
            $bid->saveMeta("communityFeature", json_encode($request->communityFeature));
            $bid->saveMeta("assocAmenities", json_encode($request->assocAmenities));
            $bid->saveMeta("feeIncludes", json_encode($request->feeIncludes));
            $bid->saveMeta("has_water_access", $request->has_water_access);
            $bid->saveMeta("has_water_view", $request->has_water_view);
            $bid->saveMeta("has_water_extra", $request->has_water_extra);
            $bid->saveMeta("has_water_fontage", $request->has_water_fontage);
            $bid->saveMeta("viewOptions", $request->viewOptions);
            $bid->saveMeta("viewOther", $request->viewOther);
            $bid->saveMeta("pools", $request->pools);
            $bid->saveMeta("garage", $request->garage);
            $bid->saveMeta("carport", $request->carport);
            $bid->saveMeta("custom_carport", $request->custom_carport);
            $bid->saveMeta("prop_conditions", json_encode($request->prop_conditions));
            $bid->saveMeta("custom_prop_conditions", $request->custom_prop_conditions);
            $bid->saveMeta("is_leased", $request->is_leased);
            $bid->saveMeta("current_rental_price", $request->current_rental_price);
            $bid->saveMeta("move_in_date", $request->move_in_date);
            $bid->saveMeta("lease_expiration_date", $request->lease_expiration_date);
            $bid->saveMeta("lease_unit", json_encode($request->lease_unit));
            $bid->saveMeta("security_deposit", $request->security_deposit);
            $bid->saveMeta("is_tenant_pay_rent", $request->is_tenant_pay_rent);
            $bid->saveMeta("is_tenant_on_rent", $request->is_tenant_on_rent);
            $bid->saveMeta("contingency", $request->contingency);
            $bid->saveMeta("custom_inspection", $request->custom_inspection);
            $bid->saveMeta("max_price", $request->max_price);
            $bid->saveMeta("financing", $request->financing);
            $bid->saveMeta("financingOther", json_encode($request->financingOther));
            $bid->saveMeta("lease", json_encode($request->lease));
            $bid->saveMeta("sellerFinancing", json_encode($request->sellerFinancing));
            $bid->saveMeta("assumable", json_encode($request->assumable));
            $bid->saveMeta("crypto", json_encode($request->crypto));
            $bid->saveMeta("nft", json_encode($request->nft));
            $bid->saveMeta("exchangeOther", json_encode($request->exchangeOther));
            $bid->saveMeta("prepaymentOption", $request->prepaymentOption);
            $bid->saveMeta("customPrepayment", $request->customPrepayment);
            $bid->saveMeta("balloonOption", $request->balloonOption);
            $bid->saveMeta("agent_commission_percent", $request->agent_commission_percent);
            $bid->saveMeta("description", $request->description);
            $bid->saveMeta("address", $request->address);
            $bid->saveMeta("floor_plan_link", $request->floor_plan_link);
            $bid->saveMeta("video_url", $request->video_url);
            $bid->saveMeta("flooLink", $request->flooLink);
            $bid->saveMeta("first_name", $request->first_name);
            $bid->saveMeta("last_name", $request->last_name);
            $bid->saveMeta("phone_number", $request->phone_number);
            $bid->saveMeta("email", $request->email);
            if ($request->audio != "") {
                $extension = $request->audio->getClientOriginalExtension();
                $check = in_array($extension, $allowedAudios);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $audioName = $uuid . '.' . $extension;
                    $request->audio->move(public_path('auction/bid/audios'), $audioName);
                    $bid->saveMeta('audio', 'auction/bid/audios/' . $audioName);
                }
            }


            if ($request->card != "") {
                $extension = $request->card->getClientOriginalExtension();
                $check = in_array($extension, $allowedPhotos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $cardName = $uuid . '.' . $extension;
                    $request->card->move(public_path('auction/bid/cards'), $cardName);
                    $bid->saveMeta('card', 'auction/bid/cards/' . $cardName);
                }
            }


            if ($request->note != "") {
                $extension = $request->note->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $letterName = $uuid . '.' . $extension;
                    $request->note->move(public_path('auction/bid/letters'), $letterName);
                    $bid->saveMeta('note', 'auction/bid/letters/' . $letterName);
                }
            }
            $route = route('buyer.criteria.view', $id);
            DB::commit();
            return redirect()->to($route)->with('success', 'Bid Added Successfully');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to add bid');
        }
    }

    public function acceptBCABid(Request $request)
    {
        $pab = BuyerCriteriaAuctionBid::whereId($request->bid_id)->first();
        $pab->is_accepted = true;
        $pab->accepted_date = date('Y-m-d H:i:s');

        $pa = BuyerCriteriaAuction::whereId($request->auction_id)->first();
        $pa->is_sold = true;
        $pa->sold_date = date('Y-m-d H:i:s');

        if ($pab->save() && $pa->save()) {
            return redirect()->back()->with('success', 'Bid Accepted successfully!');
        } else {
            return redirect()->back()->with('error', 'Some problem in bid acceptance!');
        }
    }
    public function renew($id)
    {
        $buyer_criteria = BuyerCriteriaAuction::whereId($id)->first();
        return view('buyer_criteria.renew', compact('buyer_criteria'));
    }
    public function renew_save(Request $request)
    {
        $buyer_criteriaAuction = BuyerCriteriaAuction::find($request->id);
        $buyer_criteriaAuction->saveMeta('listing_date', $request->listing_date);
        $buyer_criteriaAuction->saveMeta('expiration_date', $request->expiration_date);
        return redirect()->route('buyer.criteria.auctions');
    }
}
