<?php

namespace App\Http\Controllers;

use App\Models\TenantCriteriaAuction;
use App\Models\TenantCriteriaAuctionBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TenantCriteriaAuctionBidController extends Controller
{
    public function add_bid($id)
    {
        $page_data['auction'] = TenantCriteriaAuction::find($id);
        $page_data['title'] = "Add Bid for Tenant's Criteria Auction";
        return view('tenant_criteria.add-bid', $page_data);
    }

    public function save_bid($id, Request $request)
    {
        // dd($request->all());

        try {

            DB::beginTransaction();
            $bid = new TenantCriteriaAuctionBid();
            $bid->user_id = Auth::user()->id;
            $bid->tenant_criteria_auction_id = $id;
            $bid->save();
            $bid->saveMeta('property_listed', $request->property_listed);
            $bid->saveMeta('property_link', $request->property_link);
            $bid->saveMeta('address', $request->address);
            $bid->saveMeta('city', $request->city);
            $bid->saveMeta('county', $request->county);
            $bid->saveMeta('state', $request->state);
            // dd($request->city);
            $bid->saveMeta('price', $request->price);
            $bid->saveMeta('list_price_per_sq', $request->list_price_per_sq);
            $bid->saveMeta('leaseDate', $request->leaseDate);
            $bid->saveMeta('leaseTime', json_encode($request->leaseTime));
            $bid->saveMeta('other_lease_duration', $request->other_lease_duration);
            $bid->saveMeta('leaseTerms', json_encode($request->leaseTerms));
            $bid->saveMeta('other_lease_terms', $request->other_lease_terms);
            $bid->saveMeta('frequency', json_encode($request->frequency));
            $bid->saveMeta('tenant_pays', json_encode($request->tenant_pays));
            $bid->saveMeta('tenantPaysOther', $request->tenantPaysOther);
            $bid->saveMeta('wnerPays', json_encode($request->wnerPays));
            $bid->saveMeta('landlordPaysOther', $request->landlordPaysOther);
            $bid->saveMeta('rent', json_encode($request->rent));
            $bid->saveMeta('rentOther', $request->rentOther);
            $bid->saveMeta('required_at_move_in', $request->required_at_move_in);
            $bid->saveMeta('moveInOther', $request->moveInOther);
            $bid->saveMeta('moveInOtherAmount', $request->moveInOtherAmount);
            $bid->saveMeta('firstMonthDeposit', $request->firstMonthDeposit);
            $bid->saveMeta('lastMonthDeposit', $request->lastMonthDeposit);
            $bid->saveMeta('securityDeposit', $request->securityDeposit);
            $bid->saveMeta('firstMonthSecond', $request->firstMonthSecond);
            $bid->saveMeta('lastMonthSecond', $request->lastMonthSecond);
            $bid->saveMeta('securityDepositSecond', $request->securityDepositSecond);
            $bid->saveMeta('exitCleaningFeeSecond', $request->exitCleaningFeeSecond);
            $bid->saveMeta('applicationFeeSecond', $request->applicationFeeSecond);
            $bid->saveMeta('applicationLinkSecond', $request->applicationLinkSecond);
            $bid->saveMeta('firstMonthThird', $request->firstMonthThird);
            $bid->saveMeta('lastMonthThird', $request->lastMonthThird);
            $bid->saveMeta('securityDepositThird', $request->securityDepositThird);
            $bid->saveMeta('petDepositThird', $request->petDepositThird);
            $bid->saveMeta('exitCleaningFeeThird', $request->exitCleaningFeeThird);
            $bid->saveMeta('applicationFeeThird', $request->applicationFeeThird);
            $bid->saveMeta('applicationLinkThird', $request->applicationLinkThird);
            $bid->saveMeta('firstMonthFour', $request->firstMonthFour);
            $bid->saveMeta('lastMonthFour', $request->lastMonthFour);
            $bid->saveMeta('securityDepositFour', $request->securityDepositFour);
            $bid->saveMeta('exitCleaningFeeFour', $request->exitCleaningFeeFour);
            $bid->saveMeta('applicationFeeFour', $request->applicationFeeFour);
            $bid->saveMeta('applicationLinkFour', $request->applicationLinkFour);
            $bid->saveMeta('vacationTaxFour', $request->vacationTaxFour);
            $bid->saveMeta('firstMonthFive', $request->firstMonthFive);
            $bid->saveMeta('securityDepositFive', $request->securityDepositFive);
            $bid->saveMeta('exitCleaningFeeFive', $request->exitCleaningFeeFive);
            $bid->saveMeta('applicationFeeFive', $request->applicationFeeFive);
            $bid->saveMeta('applicationLinkFive', $request->applicationLinkFive);
            $bid->saveMeta('vacationTaxFive', $request->vacationTaxFive);
            $bid->saveMeta('firstMonthSix', $request->firstMonthSix);
            $bid->saveMeta('securityDepositSix', $request->securityDepositSix);
            $bid->saveMeta('exitCleaningFeeSix', $request->exitCleaningFeeSix);
            $bid->saveMeta('applicationFeeSix', $request->applicationFeeSix);
            $bid->saveMeta('applicationLinkSix', $request->applicationLinkSix);
            $bid->saveMeta('firstMonthSeven', $request->firstMonthSeven);
            $bid->saveMeta('securityDepositSeven', $request->securityDepositSeven);
            $bid->saveMeta('applicationFeeSeven', $request->applicationFeeSeven);
            $bid->saveMeta('applicationLinkSeven', $request->applicationLinkSeven);
            $bid->saveMeta('specialMoveOption', $request->specialMoveOption);
            $bid->saveMeta('specialMove', $request->specialMove);

            $bid->saveMeta('petsOpt', $request->petsOpt);
            $bid->saveMeta('petsNumber', $request->petsNumber);
            $bid->saveMeta('petsType', $request->petsType);
            $bid->saveMeta('petsWeight', $request->petsWeight);
            $bid->saveMeta('petsFee', $request->petsFee);
            $bid->saveMeta('petsAmount', $request->petsAmount);
            $bid->saveMeta('petsFund', $request->petsFund);
            $bid->saveMeta('offer_allowed_occupants', $request->offer_allowed_occupants);
            $bid->saveMeta('custom_occupants', $request->custom_occupants);
            $bid->saveMeta('creditScore', $request->creditScore);
            $bid->saveMeta('offer_min_net_income', $request->offer_min_net_income);
            $bid->saveMeta('eviction', $request->eviction);
            $bid->saveMeta('offer_prior_felony', $request->offer_prior_felony);

            $bid->saveMeta('landlordOfferCommission', $request->landlordOfferCommission);
            $bid->saveMeta('commissionAmmountOffered', $request->commissionAmmountOffered);
            $bid->saveMeta('landlordPaysAmount', $request->landlordPaysAmount);
            
            $bid->saveMeta('petsOpt', $request->petsOpt);
            $bid->saveMeta('petsOpt', $request->petsOpt);
            $bid->saveMeta('petsOpt', $request->petsOpt);
            $bid->saveMeta('petsOpt', $request->petsOpt);

            $bid->saveMeta('property_type', $request->property_type);
            $bid->saveMeta('eviction', $request->eviction);
            $bid->saveMeta('felony', $request->felony);
            $bid->saveMeta('property_items', $request->property_items);
            $bid->saveMeta('landroomOpt', $request->landroomOpt);
            $bid->saveMeta('bedrooms', $request->bedrooms);
            $bid->saveMeta('custom_bedrooms', $request->custom_bedrooms);
            $bid->saveMeta('bathrooms', $request->bathrooms);
            $bid->saveMeta('custom_bathrooms', $request->custom_bathrooms);
            $bid->saveMeta('heated_sqft', $request->heated_sqft);
            $bid->saveMeta('total_acreage', $request->total_acreage);
            $bid->saveMeta('applianceTypes', json_encode($request->applianceTypes));
            $bid->saveMeta('washerDryerOptions', $request->washerDryerOptions);
            $bid->saveMeta('waterAccessOpt', $request->waterAccessOpt);
            $bid->saveMeta('has_water_view', $request->has_water_view);
            $bid->saveMeta('has_water_extra', $request->has_water_extra);
            $bid->saveMeta('waterFrontageOpt', $request->waterFrontageOpt);
            $bid->saveMeta('viewOpt', $request->viewOpt);
            $bid->saveMeta('viewOther', $request->viewOther);
            $bid->saveMeta('lease_terms', $request->lease_terms);
            $bid->saveMeta('custom_lease_terms', $request->custom_lease_terms);
            $bid->saveMeta('pool', $request->pool);
            $bid->saveMeta('garage', $request->garage);
            $bid->saveMeta('custom_garage_spaces', $request->custom_garage_spaces);
            $bid->saveMeta('carport', $request->carport);
            $bid->saveMeta('custom_carport_spaces', $request->custom_carport_spaces);
            $bid->saveMeta('propCondition', json_encode($request->propCondition));
            $bid->saveMeta('propsOther', $request->propsOther);
            $bid->saveMeta('offered_custom_lease_terms', $request->offered_custom_lease_terms);
            $bid->saveMeta('start_date', $request->start_date);
            $bid->saveMeta('end_date', $request->end_date);
            $bid->saveMeta('required_at_move_in', $request->required_at_move_in);
            $bid->saveMeta('required_at_move_in_custom', $request->required_at_move_in_custom);
            $bid->saveMeta('securityDeposit', $request->securityDeposit);
            $bid->saveMeta('applicationLink', $request->applicationLink);
            $bid->saveMeta('applicationCost', $request->applicationCost);
            $bid->saveMeta('landOfferOpt', $request->landOfferOpt);
            $bid->saveMeta('landOffer', $request->landOffer);
            $bid->saveMeta('LandPrescreening', $request->LandPrescreening);
            $bid->saveMeta('pet_accept', $request->pet_accept);
            $bid->saveMeta('petsAllowed', $request->petsAllowed);
            $bid->saveMeta('acceptablePet', $request->acceptablePet);
            $bid->saveMeta('petWeight', $request->petWeight);
            $bid->saveMeta('petFee', $request->petFee);
            $bid->saveMeta('petAmount', $request->petAmount);
            $bid->saveMeta('petRefund', $request->petRefund);
            $bid->saveMeta('occupants', $request->occupants);
            $bid->saveMeta('netIncome', $request->netIncome);
            $bid->saveMeta('commission', $request->commission);
            $bid->saveMeta('additionalDetails', $request->additionalDetails);
            $bid->saveMeta('addressProp', $request->addressProp);
            $bid->saveMeta('picLinkProp', $request->picLinkProp);
            $bid->saveMeta('videoLink', $request->videoLink);
            $bid->saveMeta('planPropLink', $request->planPropLink);
            $bid->saveMeta('firstName', $request->firstName);
            $bid->saveMeta('lastName', $request->lastName);
            $bid->saveMeta('phoneNumber', $request->phoneNumber);
            $bid->saveMeta('email', $request->email);
            $bid->saveMeta('brokerage', $request->brokerage);
            $bid->saveMeta('license', $request->license);
            $bid->saveMeta('memberId', $request->memberId);
            $route = route('tenant.criteria.auction.view', $id);

            // "picPropUpload" => Illuminate\Http\UploadedFile {#1675 ▶}
            // "videoUpload" => Illuminate\Http\UploadedFile {#1674 ▶}
            // "planPropUpload" => Illuminate\Http\UploadedFile {#1676 ▶}
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

            $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];

            $visible_upload_file = [];
            // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf



            // photos and video uploads


            // Picture
            if ($request->hasFile('picPropUpload')) {
                $picPropUpload = $request->file('picPropUpload');
                $originalName = $picPropUpload->getClientOriginalName();
                $extension = $picPropUpload->getClientOriginalExtension();
                $imageSize = $picPropUpload->getSize();
                $check = in_array($extension, $allowedPhotos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $imageName = $uuid . '.' . $extension;
                    $picPropUpload->move(public_path('auction/images'), $imageName);
                    $picPropUpload = 'auction/images/' . $imageName;
                }
                $bid->saveMeta('picPropUpload', $picPropUpload);
            }
            // Picture

            // Video
            if ($request->hasFile('videoUpload')) {
                $videoUpload = $request->file('videoUpload');
                $originalName = $videoUpload->getClientOriginalName();
                $extension = $videoUpload->getClientOriginalExtension();
                $videoSize = $videoUpload->getSize();
                $check = in_array($extension, $allowedVideos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $videoName = $uuid . '.' . $extension;
                    $videoUpload->move(public_path('auction/videos'), $videoName);
                    $videoUpload = 'auction/videos/' . $videoName;
                }
                $bid->saveMeta('videoUpload', $videoUpload);
            }
            // Video


            //Floor Plan
            if ($request->hasFile('planPropUpload')) {
                $planPropUpload = $request->file('planPropUpload');
                $originalName = $planPropUpload->getClientOriginalName();
                $extension = $planPropUpload->getClientOriginalExtension();
                $imageSize = $planPropUpload->getSize();
                $check = in_array($extension, $allowedPhotos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $imageName = $uuid . '.' . $extension;
                    $planPropUpload->move(public_path('auction/images'), $imageName);
                    $planPropUpload = 'auction/images/' . $imageName;
                }
                $bid->saveMeta('planPropUpload', $planPropUpload);
            }

            //Floor Plan

            // Business Card

            DB::commit();
            return redirect()->to($route)->with('success', 'Bid Added Successfully');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to add bid');
        }
    }

    public function accept_bid(Request $request)
    {
        $pab = TenantCriteriaAuctionBid::whereId($request->bid_id)->first();
        $pab->is_accepted = true;
        $pab->accepted_date = date('Y-m-d H:i:s');

        $pa = TenantCriteriaAuction::whereId($request->auction_id)->first();
        $pa->is_sold = true;
        $pa->sold_date = date('Y-m-d H:i:s');

        if ($pab->save() && $pa->save()) {
            return redirect()->back()->with('success', 'Bid Accepted successfully!');
        } else {
            return redirect()->back()->with('error', 'Some problem in bid acceptance!');
        }
    }
}
