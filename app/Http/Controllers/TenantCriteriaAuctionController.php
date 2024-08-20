<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TenantCriteriaAuction;

class TenantCriteriaAuctionController extends Controller
{
    public function index()
    {
        $page_data['title'] = 'Add Tenant\'s Criteria';
        return view('tenant_criteria.add', $page_data);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        try {

            if (str_contains(strtolower($request->auction_length), 'day')) {
                $auction_lengths = explode(' ', $request->auction_length);
                $auction_length_days = current($auction_lengths);
            } else {
                $auction_length_days = '-1';
            }

            DB::beginTransaction();
            $auction = new TenantCriteriaAuction();
            $auction->user_id = Auth::user()->id;

            // update code
            $auction->save();
            $listing_date = Carbon::parse($request->listing_date);
            $expiration_date = Carbon::parse($request->expiration_date);
            $auction->listing_date = $listing_date;
            $auction->expiration_date = $expiration_date;
            $auction->saveMeta("cities",json_encode($request->cities));
            $auction->saveMeta("counties",json_encode($request->counties));
            $auction->saveMeta("state",json_encode($request->state));
            $auction->saveMeta("listing_date",$request->listing_date);
            $auction->saveMeta("expiration_date",$request->expiration_date);
            $auction->saveMeta("listingType",$request->listingType);
            $auction->saveMeta("representation",$request->representation);
            $auction->saveMeta("titleListing",$request->titleListing);
            $auction->saveMeta("property_type",$request->property_type);
            $auction->saveMeta("property_items",json_encode($request->property_items));
            $auction->saveMeta("leaseProp",$request->leaseProp);
            $auction->saveMeta("leasePropOther",$request->leasePropOther);
            $auction->saveMeta("prop_condition",json_encode($request->prop_condition));
            $auction->saveMeta("propsOther",$request->propsOther);
            $auction->saveMeta("monthly_price",$request->monthly_price);
            $auction->saveMeta("leaseLength",json_encode($request->leaseLength));
            $auction->saveMeta("leaseOther",$request->leaseOther);
            $auction->saveMeta("idealDate",$request->idealDate);
            $auction->saveMeta("bedrooms",$request->bedrooms);
            $auction->saveMeta("custom_bedrooms",$request->custom_bedrooms);
            $auction->saveMeta("bathrooms",$request->bathrooms);
            $auction->saveMeta("custom_bathrooms",$request->custom_bathrooms);
            $auction->saveMeta("minimum_sqft_needed",$request->minimum_sqft_needed);
            $auction->saveMeta("garageParkingOpt",$request->garageParkingOpt);
            $auction->saveMeta("garageOther",$request->garageOther);
            $auction->saveMeta("carport",$request->carport);
            $auction->saveMeta("carport_opt",$request->carport_opt);
            $auction->saveMeta("custom_carport",$request->custom_carport);
            $auction->saveMeta("garage",$request->garage);
            $auction->saveMeta("garage_opt",$request->garage_opt);
            $auction->saveMeta("custom_garage",$request->custom_garage);
            $auction->saveMeta("has_water_view",$request->has_water_view);
            $auction->saveMeta("water_view",json_encode($request->water_view));
            $auction->saveMeta("has_water_extra",$request->has_water_extra);
            $auction->saveMeta("water_extras",json_encode($request->water_extras));
            $auction->saveMeta("waterFrontageOpt",$request->waterFrontageOpt);
            $auction->saveMeta("waterFrontage",json_encode($request->waterFrontage));
            $auction->saveMeta("waterAccessOpt",$request->waterAccessOpt);
            $auction->saveMeta("water_access",json_encode($request->water_access));
            $auction->saveMeta("viewOpt",$request->viewOpt);
            $auction->saveMeta("viewReference",json_encode($request->viewReference));
            $auction->saveMeta("viewReferenceOther",$request->viewReferenceOther);
            $auction->saveMeta("total_acreage",$request->total_acreage);
            $auction->saveMeta("Furnishings",json_encode($request->Furnishings));
            $auction->saveMeta("pool",$request->pool);
            $auction->saveMeta("poolNeededOpt",$request->poolNeededOpt);
            $auction->saveMeta("has_pets",$request->has_pets);
            $auction->saveMeta("totalPets",$request->totalPets);
            $auction->saveMeta("petType",$request->petType);
            $auction->saveMeta("petBreed",$request->petBreed);
            $auction->saveMeta("petWeight",$request->petWeight);
            $auction->saveMeta("is_tenant_eligible",$request->is_tenant_eligible);
            $auction->saveMeta("description_buyer_specific",$request->description_buyer_specific);
            $auction->saveMeta("any_non_negotiable_factors",$request->any_non_negotiable_factors);
            $auction->saveMeta("negotiable",json_encode($request->negotiable));
            $auction->saveMeta("negotiableOther",$request->negotiableOther);
            $auction->saveMeta("renterTerms",$request->renterTerms);
            $auction->saveMeta("how_many_occupying",$request->how_many_occupying);
            $auction->saveMeta("tenant_credit_score",$request->tenant_credit_score);
            $auction->saveMeta("monthly_household_income",$request->monthly_household_income);
            $auction->saveMeta("convicted",$request->convicted);
            $auction->saveMeta("custom_convicted",$request->custom_convicted);
            $auction->saveMeta("evicted",$request->evicted);
            $auction->saveMeta("custom_evicted",$request->custom_evicted);
            $auction->saveMeta("lease_violations",$request->lease_violations);
            $auction->saveMeta("lease_violation_why",$request->lease_violation_why);
            $auction->saveMeta("compensateOpt",$request->compensateOpt);
            $auction->saveMeta("compensateOtherOpt",$request->compensateOtherOpt);
            $auction->saveMeta("compensateOther",$request->compensateOther);
            $auction->saveMeta("agent_first_name",$request->agent_first_name);
            $auction->saveMeta("agent_last_name",$request->agent_last_name);
            $auction->saveMeta("agent_phone",$request->agent_phone);
            $auction->saveMeta("agent_email",$request->agent_email);
            $auction->saveMeta("agent_brokerage",$request->agent_brokerage);
            $auction->saveMeta("agent_license_no",$request->agent_license_no);
            $auction->saveMeta("agent_mls_id",$request->agent_mls_id);
            $auction->saveMeta("realStateAgent",$request->realStateAgent);

            // update code


            // 19 June 2023 for Residential and Income

            // photos and video uploads

            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

            $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];

            $visible_upload_file = [];
            // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf



            // photos and video uploads


            // Picture
            if ($request->hasFile('visible_property_picture')) {
                $visible_property_picture = $request->file('visible_property_picture');
                $originalName = $visible_property_picture->getClientOriginalName();
                $extension = $visible_property_picture->getClientOriginalExtension();
                $imageSize = $visible_property_picture->getSize();
                $check = in_array($extension, $allowedPhotos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $imageName = $uuid . '.' . $extension;
                    $visible_property_picture->move(public_path('auction/images'), $imageName);
                    $visible_property_picture = 'auction/images/' . $imageName;
                }
                $auction->saveMeta('property_picture', $visible_property_picture);
            }
            // Picture

            // Video
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $originalName = $video->getClientOriginalName();
                $extension = $video->getClientOriginalExtension();
                $videoSize = $video->getSize();
                $check = in_array($extension, $allowedVideos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $videoName = $uuid . '.' . $extension;
                    $video->move(public_path('auction/videos'), $videoName);
                    $video = 'auction/videos/' . $videoName;
                }
                $auction->saveMeta('video', $video);
            }

            // Video


            //Floor Plan
            if ($request->hasFile('visible_note')) {
                $file = $request->visible_note;
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $fileName = $uuid . '.' . $extension;
                    $file->move(public_path('auction/files'), $fileName);
                    $auction->saveMeta('note', 'auction/files/' . $fileName);
                }
            }

            //Floor Plan

            // Business Card
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $originalName = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $imageSize = $photo->getSize();
                $check = in_array($extension, $allowedPhotos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $imageName = $uuid . '.' . $extension;
                    $photo->move(public_path('auction/images'), $imageName);
                    $photo = 'auction/images/' . $imageName;
                }
                $auction->saveMeta('photo', $photo);
            }
            // Business Card

            // 19 June 2023 for Residential and Income

            DB::commit();
            return redirect()->back()->with('success', 'Auction added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to add auction');
        }
    }

    public function edit($id, Request $request)
    {
        $page_data['auction'] = TenantCriteriaAuction::findOrFail($id);
        $page_data['title'] = 'Edit Tenant\'s Criteria';
        return view('tenant_criteria.edit', $page_data);
    }

    public function update($id, Request $request)
    {

        // try {

        if (str_contains(strtolower($request->auction_length), 'day')) {
            $auction_lengths = explode(' ', $request->auction_length);
            $auction_length_days = current($auction_lengths);
        } else {
            $auction_length_days = '-1';
        }

        // DB::beginTransaction();
        $auction = TenantCriteriaAuction::findOrFail($id);
        $auction->user_id = Auth::user()->id;
        $auction->auction_type = $request->auction_type;
        $auction->auction_length = $auction_length_days;
        $auction->update();
        $listing_date = Carbon::parse($request->listing_date);
        $expiration_date = Carbon::parse($request->expiration_date);
        $auction->listing_date = $listing_date;
        $auction->expiration_date = $expiration_date;
        $auction->saveMeta('auction_type', $request->auction_type);
        $auction->saveMeta('auction_length', $request->auction_length);
        $auction->saveMeta('auction_length_days', $auction_length_days);
        $auction->saveMeta('cities', json_encode($request->cities));
        $auction->saveMeta('county', $request->county);
        $auction->saveMeta('state', $request->state);
        $auction->saveMeta('listing_date', $request->listing_date);
        $auction->saveMeta('expiration_date', $request->expiration_date);
        $auction->saveMeta('property_type', $request->property_type);
        $auction->saveMeta('description_preference', $request->description_preference);
        $auction->saveMeta('property_items', json_encode($request->property_items));
        $auction->saveMeta('is_tenant_eligible', $request->is_tenant_eligible);
        $auction->saveMeta('bedrooms', $request->bedrooms);
        $auction->saveMeta('tenant_credit_score', $request->tenant_credit_score);
        $auction->saveMeta('custom_bedrooms', $request->custom_bedrooms);
        $auction->saveMeta('offer_rental_price', $request->offer_rental_price);
        $auction->saveMeta('bathrooms', $request->bathrooms);
        $auction->saveMeta('minimum_sqft_needed', $request->minimum_sqft_needed);
        $auction->saveMeta('any_non_negotiable_factors', $request->any_non_negotiable_factors);
        $auction->saveMeta('custom_bathrooms', $request->custom_bathrooms);
        $auction->saveMeta('previous_land', $request->previous_land);
        $auction->saveMeta('heated_sqft', $request->heated_sqft);
        $auction->saveMeta('leasable_sqft', $request->leasable_sqft);
        $auction->saveMeta('move_in_date', $request->move_in_date);
        $auction->saveMeta('lease_terms', $request->lease_terms);
        $auction->saveMeta('custom_terms', $request->custom_terms);
        $auction->saveMeta('is_tenant_smoke', $request->is_tenant_smoke);
        $auction->saveMeta('monthly_price', $request->monthly_price);
        $auction->saveMeta('sf_price', $request->sf_price);
        $auction->saveMeta('Furnishings', $request->Furnishings);
        $auction->saveMeta('number_of_tenants', $request->number_of_tenants);
        $auction->saveMeta('custom_number_of_tenants', $request->custom_number_of_tenants);
        $auction->saveMeta('pool', $request->pool);
        $auction->saveMeta('carport', $request->carport);
        $auction->saveMeta('carport_opt', $request->carport_opt);
        $auction->saveMeta('custom_carport', $request->custom_carport);
        $auction->saveMeta('garage', $request->garage);
        $auction->saveMeta('garage_opt', $request->garage_opt);
        $auction->saveMeta('custom_garage', $request->custom_garage);
        $auction->saveMeta('has_water_view', $request->has_water_view);
        $auction->saveMeta('has_water_fontage', $request->has_water_fontage);
        $auction->saveMeta('water_view', json_encode($request->water_view));
        $auction->saveMeta('has_water_extra', json_encode($request->has_water_extra));
        $auction->saveMeta('water_access', json_encode($request->water_access));
        $auction->saveMeta('need_water_view', $request->need_water_view);
        $auction->saveMeta('water_views', json_encode($request->water_views));
        $auction->saveMeta('water_extras', $request->water_extras);
        $auction->saveMeta('water_extras_opt', json_encode($request->water_extras_opt));
        $auction->saveMeta('parking_feature_garage', json_encode($request->parking_feature_garage));
        $auction->saveMeta('tenant_criteria', $request->tenant_criteria);
        $auction->saveMeta('credit_score', $request->credit_score);
        $auction->saveMeta('total_occupants', $request->total_occupants);
        $auction->saveMeta('description_buyer_specific', $request->description_buyer_specific);
        $auction->saveMeta('custom_total_occupants', $request->custom_total_occupants);
        $auction->saveMeta('has_pets', $request->has_pets);
        $auction->saveMeta('type_of_pet', $request->type_of_pet);
        $auction->saveMeta('total_pets', $request->total_pets);
        $auction->saveMeta('pets_bread', $request->pets_bread);
        $auction->saveMeta('how_many_occupying', $request->how_many_occupying);
        $auction->saveMeta('monthly_household_income', $request->monthly_household_income);
        $auction->saveMeta('convicted', $request->convicted);
        $auction->saveMeta('custom_convicted', $request->custom_convicted);
        $auction->saveMeta('evicted', $request->evicted);
        // nisar changing
        $auction->saveMeta('smoke', $request->smoke);

        $auction->saveMeta('custom_evicted', $request->custom_evicted);
        $auction->saveMeta('lease_violations', $request->lease_violations);
        $auction->saveMeta('tenant_smoke', $request->tenant_smoke);
        $auction->saveMeta('description', $request->description);
        $auction->saveMeta('first_name', $request->first_name);
        $auction->saveMeta('last_name', $request->last_name);
        $auction->saveMeta('agent_phone', $request->agent_phone);
        $auction->saveMeta('agent_email', $request->agent_email);
        $auction->saveMeta('agent_brokerage', $request->agent_brokerage);
        $auction->saveMeta('agent_license_no', $request->agent_license_no);
        $auction->saveMeta('agent_mls_id', $request->agent_mls_id);
        $auction->saveMeta('agent_commission_percent', $request->agent_commission_percent);
        $auction->saveMeta('lease_terms1', $request->lease_terms1);
        $auction->saveMeta('offere_rental_price', $request->offere_rental_price);
        $auction->saveMeta('offered_leased_terms', $request->offered_leased_terms);
        $auction->saveMeta('offered_leased_terms', $request->offered_leased_terms);
        $auction->saveMeta('offered_custom_terms', $request->offered_custom_terms);
        $auction->saveMeta('required_at_move_in', $request->required_at_move_in);
        $auction->saveMeta('is_application', $request->is_application);
        $auction->saveMeta('accept_pet', $request->accept_pet);
        $date = date('Y-m-d', strtotime($request->date));
        $auction->saveMeta('ideal_move_in_date', $request->date);
        $auction->saveMeta('description_and_additional_terms', $request->description_and_additional_terms);
        $auction->saveMeta('adress_of_the_property', $request->adress_of_the_property);


        $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

        $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];

        $visible_upload_file = [];
        // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
        $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
        $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf



        // photos and video uploads


        // Picture
        if ($request->hasFile('visible_property_picture')) {
            $visible_property_picture = $request->file('visible_property_picture');
            $originalName = $visible_property_picture->getClientOriginalName();
            $extension = $visible_property_picture->getClientOriginalExtension();
            $imageSize = $visible_property_picture->getSize();
            $check = in_array($extension, $allowedPhotos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $imageName = $uuid . '.' . $extension;
                $visible_property_picture->move(public_path('auction/images'), $imageName);
                $visible_property_picture = 'auction/images/' . $imageName;
            }
            $auction->saveMeta('property_picture', $visible_property_picture);
        }
        // Picture

        // Video
        if ($request->hasFile('visible_property_video')) {
            $visible_property_video = $request->file('visible_property_video');
            $originalName = $visible_property_video->getClientOriginalName();
            $extension = $visible_property_video->getClientOriginalExtension();
            $videoSize = $visible_property_video->getSize();
            $check = in_array($extension, $allowedVideos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $videoName = $uuid . '.' . $extension;
                $visible_property_video->move(public_path('auction/videos'), $videoName);
                $visible_property_video = 'auction/videos/' . $videoName;
            }
            $auction->saveMeta('property_video', $visible_property_video);
        }

        // Video


        //Floor Plan
        if ($request->hasFile('visible_note')) {
            $file = $request->visible_note;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFiles);
            if ($check) {
                $uuid = (string) Str::uuid();
                $fileName = $uuid . '.' . $extension;
                $file->move(public_path('auction/files'), $fileName);
                $auction->saveMeta('note', 'auction/files/' . $fileName);
            }
        }

        //Floor Plan

        // Business Card
        if ($request->hasFile('business_card')) {
            $visible_property_picture = $request->file('business_card');
            $originalName = $visible_property_picture->getClientOriginalName();
            $extension = $visible_property_picture->getClientOriginalExtension();
            $imageSize = $visible_property_picture->getSize();
            $check = in_array($extension, $allowedPhotos);
            if ($check) {
                $uuid = (string) Str::uuid();
                $imageName = $uuid . '.' . $extension;
                $visible_property_picture->move(public_path('auction/images'), $imageName);
                $visible_property_picture = 'auction/images/' . $imageName;
            }
            $auction->saveMeta('business_card', $visible_property_picture);
        }
        // Business Card

        // DB::commit();
        // return redirect()->back()->with('success', 'Auction updated successfully');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return $e->getMessage();
        //     return redirect()->back()->with('error', 'Unable to update auction');
        // }
    }

    public function list(Request $request)
    {
        $page_data['title'] = 'Tenant Criteria Auctions';
        $page_data['type'] = $type = $request->type ?? "2";
        $pendingAuctions = TenantCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
        $pendingApprovalAuctions = TenantCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
        $liveAuctions = TenantCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => false]);
        $soldAuctions = TenantCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true]); //, 'is_paid' => true
        $pendingPaymentAuctions = TenantCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true, 'is_paid' => false]);
        if ($type == "0") {
            // $auctions = $pendingAuctions->get();
        } else if ($type == "1") {
            $auctions = $pendingApprovalAuctions->get();
        } else if ($type == "2") {
            $auctions = $liveAuctions->get();
        } else if ($type == '3') {
            $auctions = $soldAuctions->get();
        } else if ($type == "4") {
            // $auctions = $pendingPaymentAuctions->get();
        } else {
            $auctions = $liveAuctions->get();
        }

        $page_data['pendingCount'] = $pendingAuctions->count();
        $page_data['pendingApprovalCount'] = $pendingApprovalAuctions->count();
        $page_data['liveCount'] = $liveAuctions->count();
        $page_data['soldCount'] = $soldAuctions->count();
        $page_data['pendingPaymentCount'] = $pendingPaymentAuctions->count();

        $page_data['auctions'] = $auctions;

        // dd($page_data['count_my_auctions']);
        return view('tenant_criteria.list', $page_data);
    }


    public function admin_list(Request $request)
    {
        $page_data['title'] = "Tenant's Criteria";
        $page_data['type'] = $type = $request->type ?? 0;

        if ($type == 1) {
            $page_data['auctions'] = TenantCriteriaAuction::where('is_approved', true)->get();
        } else if ($type == 2) {
            $page_data['auctions'] = TenantCriteriaAuction::where('is_sold', true)->get();
        } else {
            $page_data['auctions'] = TenantCriteriaAuction::where('is_approved', false)->get();
        }
        return view('admin.tenantCriteriaAuctions', $page_data);
    }


    public function approve($id)
    {
        $auction = TenantCriteriaAuction::find($id);
        $auction->is_approved = true;
        $auction->update();
        return redirect()->back()->with('success', 'Auction Approved Successfully!');
    }

    public function view($id, Request $request)
    {
        $page_data['auction'] = TenantCriteriaAuction::whereId($id)->first();
        // $page_data['counties'] = County::all();
        // $page_data['cities'] = City::where('state_id', '3930')->get();
        // $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        // $page_data['bedrooms'] = Bedroom::all();
        // $page_data['bathrooms'] = Bathroom::all();
        // $page_data['financings'] = Financing::orderBy('sort', 'ASC')->get();
        $page_data['title'] = 'Tenant Criteria';
        $page_data['id'] = $id;
        return view('tenant_criteria.view', $page_data);
    }

    public function search(Request $request)
    {
        $page_data['title'] = 'Search Listings';
        $auctions = TenantCriteriaAuction::selectRaw('*, (SELECT meta_value FROM tenant_criteria_auction_metas WHERE tenant_criteria_auction_metas.tenant_criteria_auction_id = tenant_criteria_auctions.id AND meta_key = "max_price") as price, (SELECT meta_value FROM tenant_criteria_auction_metas WHERE tenant_criteria_auction_metas.tenant_criteria_auction_id = tenant_criteria_auctions.id AND meta_key = "property_type") as address')->where('is_sold', false)->where('is_approved', 1);

        if ($request->bedrooms != "") {
            $auctions->whereHas('meta', function ($meta) use ($request) {
                $meta->where('meta_key', 'bedrooms')->where('meta_value', $request->bedrooms);
            });
        }

        if ($request->bathrooms != "") {
            $auctions->whereHas('meta', function ($meta) use ($request) {
                $meta->where('meta_key', 'bathrooms')->where('meta_value', $request->bathrooms);
            });
        }

        if ($request->property_type != "") {
            $auctions->whereHas('meta', function ($meta) use ($request) {
                $meta->where('meta_key', 'property_type')->where('meta_value', $request->property_type);
            });
        }

        if ($request->sort) {
            $sort = $request->sort;
            if ($sort == 1) {
                $sort_by = 'address';
                $sort_type = 'DESC';
            } else if ($sort == 2) {
                $sort_by = 'address';
                $sort_type = 'ASC';
            } else if ($sort == 3) {
                $sort_by = 'created_at';
                $sort_type = 'DESC';
            } else if ($sort == 4) {
                $sort_by = 'created_at';
                $sort_type = 'ASC';
            } else if ($sort == 5) {
                $sort_by = 'price';
                $sort_type = 'DESC';
            } else if ($sort == 6) {
                $sort_by = 'price';
                $sort_type = 'ASC';
            }
            $auctions->orderBy($sort_by, $sort_type);
        } else {
            $auctions->orderBy(DB::raw('RAND()'));
        }

        $auctions_c = $auctions;

        $page_data['count'] = $auctions_c->count();
        $page_data['pAuctions'] = $auctions->paginate(12);
        return view('tenant_criteria.search', $page_data);
    }

    public function renew($id)
    {
        $tenant_criteria = TenantCriteriaAuction::whereId($id)->first();
        return view('tenant_criteria.renew', compact('tenant_criteria'));
    }
    public function renew_save(Request $request)
    {
        $tenantCriteriaAuction = TenantCriteriaAuction::find($request->id);
        $tenantCriteriaAuction->saveMeta('listing_date', $request->listing_date);
        $tenantCriteriaAuction->saveMeta('expiration_date', $request->expiration_date);
        return redirect('/tenant/criteria/auctions');
    }
}
