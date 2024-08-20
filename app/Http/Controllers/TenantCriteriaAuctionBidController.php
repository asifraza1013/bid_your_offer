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
            $bid->saveMeta('city', $request->city);
            $bid->saveMeta('county', $request->county);
            $bid->saveMeta('state', $request->state);
            $bid->saveMeta('property_type', $request->property_type);
            // dd($request->city);
            $bid->saveMeta('price', $request->price);
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
