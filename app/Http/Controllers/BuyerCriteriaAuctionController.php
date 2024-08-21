<?php

namespace App\Http\Controllers;

use App\Models\Bathroom;
use App\Models\BCCity;
use App\Models\BCCounty;
use App\Models\BCWaterExtra;
use App\Models\BCWaterView;
use App\Models\Bedroom;
use App\Models\BuyerCriteriaAuction;
use App\Models\City;
use App\Models\County;
use App\Models\Financing;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\State;
use App\Models\WaterExtra;
use App\Models\WaterViewType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuyerCriteriaAuctionController extends Controller
{
    public function addAuction()
    {
        $page_data['title'] = 'Add Buyer\'s Criteria';
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        return view('buyer_criteria.add', $page_data);
    }

    public function storeAuction(Request $request)
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
            $auction = new BuyerCriteriaAuction();
            $auction->user_id = Auth::user()->id;
            $auction->auction_type = $request->auction_type;
            $auction->auction_length = $auction_length_days;
            $auction->save();
            $auction->saveMeta("cities",json_encode($request->cities));
            $auction->saveMeta("counties",json_encode($request->counties));
            $auction->saveMeta("states",json_encode($request->states));
            $auction->saveMeta("listing_date",$request->listing_date);
            $auction->saveMeta("expiration_date",$request->expiration_date);
            $auction->saveMeta("service_type",$request->service_type);
            $auction->saveMeta("representation",$request->representation);
            $auction->saveMeta("titleListing",$request->titleListing);
            $auction->saveMeta("property_type",$request->property_type);
            $auction->saveMeta("propertyStyles",$request->propertyStyles);
            $auction->saveMeta("property_items",json_encode($request->property_items));
            $auction->saveMeta("businessOther",$request->businessOther);
            $auction->saveMeta("vacantOther",$request->vacantOther);
            $auction->saveMeta("special_sales",json_encode($request->special_sales));
            $auction->saveMeta("otherSaleRes",$request->otherSaleRes);
            $auction->saveMeta("specialSaleOpt",$request->specialSaleOpt);
            $auction->saveMeta("specialOptYes",$request->specialOptYes);
            $auction->saveMeta("specialOptNo",$request->specialOptNo);
            $auction->saveMeta("prop_condition",json_encode($request->prop_condition));
            $auction->saveMeta("propConditionOther",$request->propConditionOther);
            $auction->saveMeta("max_price",$request->max_price);
            $auction->saveMeta("financings",json_encode($request->financings));
            $auction->saveMeta("financingOther",$request->financingOther);
            $auction->saveMeta("trade",json_encode($request->trade));
            $auction->saveMeta("conventionalOptions",json_encode($request->conventionalOptions));
            $auction->saveMeta("financingOptionsConventional",json_encode($request->financingOptionsConventional));
            $auction->saveMeta("buyerBudget",$request->buyerBudget);
            $auction->saveMeta("customOptionsYesNo",$request->customOptionsYesNo);
            $auction->saveMeta("leaseOptions",json_encode($request->leaseOptions));
            $auction->saveMeta("leasePurchase",json_encode($request->leasePurchase));
            $auction->saveMeta("prepayment",$request->prepayment);
            $auction->saveMeta("prepaymentOther",json_encode($request->prepaymentOther));
            $auction->saveMeta("balloon",$request->balloon);
            $auction->saveMeta("balloonpyment",json_encode($request->balloonpyment));
            $auction->saveMeta("assumable",json_encode($request->assumable));
            $auction->saveMeta("sellerFinancing",json_encode($request->sellerFinancing));
            $auction->saveMeta("cryptocurrency",json_encode($request->cryptocurrency));
            $auction->saveMeta("nft",json_encode($request->nft));
            $auction->saveMeta("escrow_amount",$request->escrow_amount);
            $auction->saveMeta("contingencies",json_encode($request->contingencies));
            $auction->saveMeta("contingenciesOpt",$request->contingenciesOpt);
            $auction->saveMeta("contingenciesOffered",$request->contingenciesOffered);
            $auction->saveMeta("contingenciesOfferDays",$request->contingenciesOfferDays);
            $auction->saveMeta("closeDays",$request->closeDays);
            $auction->saveMeta("idealDate",$request->idealDate);
            $auction->saveMeta("creditRes",$request->creditRes);
            $auction->saveMeta("creditOptYes",$request->creditOptYes);
            $auction->saveMeta("bedrooms",$request->bedrooms);
            $auction->saveMeta("custom_bedrooms",$request->custom_bedrooms);
            $auction->saveMeta("bathrooms",$request->bathrooms);
            $auction->saveMeta("custom_bathrooms",$request->custom_bathrooms);
            $auction->saveMeta("total_number_of_units",$request->total_number_of_units);
            $auction->saveMeta("otherBuyerIncome",$request->otherBuyerIncome);
            $auction->saveMeta("minimum_annual_net_income",$request->minimum_annual_net_income);
            $auction->saveMeta("minimum_cap_rate",$request->minimum_cap_rate);
            $auction->saveMeta("additional_details",$request->additional_details);
            $auction->saveMeta("min_sqft",$request->min_sqft);
            $auction->saveMeta("minimum_total_acreage_needed",$request->minimum_total_acreage_needed);
            $auction->saveMeta("carport",$request->carport);
            $auction->saveMeta("carportOptYes",$request->carportOptYes);
            $auction->saveMeta("garage",$request->garage);
            $auction->saveMeta("garage_spaces",$request->garage_spaces);
            $auction->saveMeta("custom_garage",$request->custom_garage);
            $auction->saveMeta("pool",$request->pool);
            $auction->saveMeta("poolOption",$request->poolOption);
            $auction->saveMeta("has_water_extra",$request->has_water_extra);
            $auction->saveMeta("water_extra",json_encode($request->water_extra));
            $auction->saveMeta("has_water_frontage",$request->has_water_frontage);
            $auction->saveMeta("water_frontage",json_encode($request->water_frontage));
            $auction->saveMeta("has_water_access",$request->has_water_access);
            $auction->saveMeta("water_access",json_encode($request->water_access));
            $auction->saveMeta("has_water_view",$request->has_water_view);
            $auction->saveMeta("water_view",json_encode($request->water_view));
            $auction->saveMeta("has_dock", $request->has_dock);
            $auction->saveMeta("dock",json_encode($request->dock));
            $auction->saveMeta("dockDescription", $request->dockDescription);
            $auction->saveMeta("viewOptions",$request->viewOptions);
            $auction->saveMeta("view",json_encode($request->view));
            $auction->saveMeta("viewOther",$request->viewOther);
            $auction->saveMeta("petOptions",$request->petOptions);
            $auction->saveMeta("petsNumber",$request->petsNumber);
            $auction->saveMeta("petsType",$request->petsType);
            $auction->saveMeta("pet_breed",$request->pet_breed);
            $auction->saveMeta("petsWeight",$request->petsWeight);
            $auction->saveMeta("have_air_conditioning",$request->have_air_conditioning);
            $auction->saveMeta("air_conditioning",$request->air_conditioning);
            $auction->saveMeta("otherAirCondition",$request->otherAirCondition);
            $auction->saveMeta("heating_and_fuel",$request->heating_and_fuel);
            $auction->saveMeta("otherFuel",$request->otherFuel);
            $auction->saveMeta("communitiesOption",$request->communitiesOption);
            $auction->saveMeta("communities",$request->communities);
            $auction->saveMeta("communityYes",$request->communityYes);
            $auction->saveMeta("description_buyer_specific",$request->description_buyer_specific);
            $auction->saveMeta("nonNegotiableFactors",$request->nonNegotiableFactors);
            $auction->saveMeta("nonNegotiable",json_encode($request->nonNegotiable));
            $auction->saveMeta("negotiableOther",$request->negotiableOther);
            $auction->saveMeta('buyerHaveAgentRepresentation', $request->buyerHaveAgentRepresentation);
            $auction->saveMeta('buyersAgentCommissionRequested', $request->buyersAgentCommissionRequested);
            $auction->saveMeta('buyersAgentCompensationRequested', $request->buyersAgentCompensationRequested);
            $auction->saveMeta('buyersAgentCompensationRequestedAmount', $request->buyersAgentCompensationRequestedAmount);
            $auction->saveMeta('BuyerSellingProperty', $request->isBuyerCurrentlySellingProperty);
            $auction->saveMeta('linkToThePropertyListing', $request->linkToThePropertyListing);
            $auction->saveMeta("agent_first_name",$request->agent_first_name);
            $auction->saveMeta("agent_last_name",$request->agent_last_name);
            $auction->saveMeta("agent_phone",$request->agent_phone);
            $auction->saveMeta("agent_email",$request->agent_email);
            $auction->saveMeta("agent_brokerage",$request->agent_brokerage);
            $auction->saveMeta("license",$request->license);
            $auction->saveMeta("agent_mls_id",$request->agent_mls_id);
            $auction->saveMeta("agent_commission_percent",$request->agent_commission_percent);//residential and income
            $auction->saveMeta("requestCredit",$request->requestCredit);
            $auction->saveMeta("real_estate_included",$request->real_estate_included);
            $auction->saveMeta("lincenses",json_encode($request->lincenses));
            $auction->saveMeta("licenseOther",$request->licenseOther);
            $auction->saveMeta("garageNeedOther",$request->garageNeedOther);
            $auction->saveMeta("non_negotiable_factors",$request->non_negotiable_factors);
            $auction->saveMeta("otherFeature",$request->otherFeature);
            $auction->saveMeta("lot_dimensions",$request->lot_dimensions);
            $auction->saveMeta("lot_size_square_footage",$request->lot_size_square_footage);
            $auction->saveMeta("front_footage",$request->front_footage);
            $auction->saveMeta("otherFrontage",$request->otherFrontage);
            $auction->saveMeta("othersurface",$request->othersurface);
            $auction->saveMeta("otherUtilities",$request->otherUtilities);
            $auction->saveMeta("otherWater",$request->otherWater);
            $auction->saveMeta("otherSewer",$request->otherSewer);
            $auction->saveMeta("buyer_intrest_in_purchasing",$request->buyer_intrest_in_purchasing);
            $auction->saveMeta("maximum_monthly_condo",$request->maximum_monthly_condo);
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];
            $visible_upload_file = [];
            // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf
            // File and Picture Upload
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
            // File and Picture Upload


            DB::commit();
            return redirect()->to(route('buyer.criteria.view', $auction->id))->with('success', 'Buyer criteria added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to add buyer criteria auction.');
        }
    }

    public function view($id)
    {
        $page_data['auction'] = BuyerCriteriaAuction::whereId($id)->first();
        $page_data['created_by'] = User::whereId($page_data['auction']->user_id)->get()->first();
        $page_data['counties'] = County::all();
        $page_data['cities'] = City::where('state_id', '3930')->get();
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        $page_data['bedrooms'] = Bedroom::all();
        $page_data['bathrooms'] = Bathroom::all();
        $page_data['financings'] = Financing::orderBy('sort', 'ASC')->get();
        $page_data['title'] = 'Buyer Criteria';
        $page_data['id'] = $id;
        return view('buyer_criteria.view', $page_data);
    }

    public function edit($id)
    {
        $page_data['title'] = 'Edit Buyer Criteria';
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        $page_data['auction'] = BuyerCriteriaAuction::find($id);
        $page_data['id'] = $id;
        return view('buyer_criteria.edit', $page_data);
    }

    public function updateAuction(Request $request)
    {
        try {

            if (str_contains(strtolower($request->auction_length), 'day')) {
                $auction_lengths = explode(' ', $request->auction_length);
                $auction_length_days = current($auction_lengths);
            } else {
                $auction_length_days = '-1';
            }
            DB::beginTransaction();
            $auction = BuyerCriteriaAuction::find($request->id);
            // $auction = new BuyerCriteriaAuction();
            // $auction->user_id = Auth::user()->id;
            $auction->auction_type = $request->auction_type;
            $auction->auction_length = $auction_length_days;
            $auction->update();
            $auction->saveMeta('listing_date', $request->listing_date);
            $auction->saveMeta('expiration_date', $request->expiration_date);
            $auction->saveMeta('city', $request->city);
            $auction->saveMeta('county', $request->county);
            $auction->saveMeta('state', $request->state);
            $auction->saveMeta('state', $request->state);
            $auction->saveMeta('property_type', $request->property_type);
            $auction->saveMeta('property_style', $request->property_style);
            $auction->saveMeta('lot_size_square_footage', $request->lot_size_square_footage);
            $auction->saveMeta('property_items', json_encode($request->property_items));
            $auction->saveMeta('real_estate_included', json_encode($request->real_estate_included));
            $auction->saveMeta('prop_conditions', json_encode($request->prop_conditions));
            $auction->saveMeta('special_sales', json_encode($request->special_sales));
            $auction->saveMeta('lot_features', json_encode($request->lot_features));
            $auction->saveMeta('road_frontage', json_encode($request->road_frontage));
            $auction->saveMeta('road_surface_type', json_encode($request->road_surface_type));
            $auction->saveMeta('utilities', json_encode($request->utilities));
            $auction->saveMeta('water12', json_encode($request->water12));
            $auction->saveMeta('sewer', json_encode($request->sewer));
            $auction->saveMeta('bedrooms', $request->bedrooms);
            $auction->saveMeta('custom_bedrooms', $request->custom_bedrooms);
            $auction->saveMeta('bathrooms', $request->bathrooms);
            $auction->saveMeta('custom_bathrooms', $request->custom_bathrooms);
            $auction->saveMeta('min_sqft', $request->min_sqft);
            $auction->saveMeta('pool', $request->pool);
            $auction->saveMeta('carport', $request->carport);
            $auction->saveMeta('garage', $request->garage);
            $auction->saveMeta('current_use', $request->current_use);
            $auction->saveMeta('garage_spaces', $request->garage_spaces);
            $auction->saveMeta('custom_garage', $request->custom_garage);
            $auction->saveMeta('has_water_view', $request->has_water_view);
            $auction->saveMeta('has_water_extra', $request->has_water_extra);
            $auction->saveMeta('has_water_fontage', $request->has_water_fontage);
            $auction->saveMeta('water_frontage', json_encode($request->water_frontage));
            $auction->saveMeta('has_rental_restrictions', $request->has_rental_restrictions);
            $auction->saveMeta('total_pets_allowed', $request->total_pets_allowed);
            $auction->saveMeta('custom_pets_allowed', $request->custom_pets_allowed);
            $auction->saveMeta('max_pet_weight', $request->max_pet_weight);
            $auction->saveMeta('pet_restrictions', $request->pet_restrictions);
            $auction->saveMeta('water_view', json_encode($request->water_view));
            $auction->saveMeta('parking_feature_garage', json_encode($request->parking_feature_garage));
            $auction->saveMeta('water_extras', json_encode($request->water_extras));
            $auction->saveMeta('water_access', json_encode($request->water_access));
            $auction->saveMeta('other_days', $request->other_days);
            $auction->saveMeta('hoa_community', $request->hoa_community);
            $auction->saveMeta('hoa_fee_requirement', $request->hoa_fee_requirement);
            $auction->saveMeta('description', $request->description);
            $auction->saveMeta('hoa_fee', $request->hoa_fee);
            $auction->saveMeta('description_buyer_specific', $request->description_buyer_specific);
            $auction->saveMeta('description_preference', $request->description_preference);
            $auction->saveMeta('any_non_negotiable_factors', $request->any_non_negotiable_factors);
            $auction->saveMeta('max_price', $request->max_price);
            $auction->saveMeta('financings', json_encode($request->financings));
            $auction->saveMeta('custom_financings', $request->custom_financings);
            $auction->saveMeta('purchase_price', $request->purchase_price);
            $auction->saveMeta('down_payment', $request->down_payment);
            $auction->saveMeta('seller_financing_amount', $request->seller_financing_amount);
            $auction->saveMeta('interest_rate', $request->interest_rate);
            $auction->saveMeta('term', $request->term);
            $auction->saveMeta('monthly_payment', $request->monthly_payment);
            $auction->saveMeta('ballon_payment', $request->ballon_payment);
            $auction->saveMeta('prepayment_penalty', $request->prepayment_penalty);
            $auction->saveMeta('closing_costs', $request->closing_costs);
            $auction->saveMeta('exchange_trade_for', $request->exchange_trade_for);
            $auction->saveMeta('exchange_for_custom', $request->exchange_for_custom);
            $auction->saveMeta('exchange_cash', $request->exchange_cash);
            $auction->saveMeta('escrow_amount', $request->escrow_amount);
            $auction->saveMeta('inspection_period', $request->inspection_period);
            $auction->saveMeta('contingencies', json_encode($request->contingencies));
            $auction->saveMeta('custom_contingencies', $request->custom_contingencies);
            $auction->saveMeta('closing_days', $request->closing_days);
            $auction->saveMeta('ideal_move_in_date', $request->ideal_move_in_date);
            $auction->saveMeta('request_buyer_credit', $request->request_buyer_credit);
            $auction->saveMeta('preferred_title_company', $request->preferred_title_company);
            $auction->saveMeta('agent_first_name', $request->agent_first_name);
            $auction->saveMeta('agent_last_name', $request->agent_last_name);
            $auction->saveMeta('agent_phone', $request->agent_phone);
            $auction->saveMeta('agent_email', $request->agent_email);
            $auction->saveMeta('agent_brokerage', $request->agent_brokerage);
            $auction->saveMeta('agent_license_no', $request->agent_license_no);
            $auction->saveMeta('agent_mls_id', $request->agent_mls_id);
            $auction->saveMeta('agent_commission_percent', $request->agent_commission_percent);
            $auction->saveMeta('special_sales1', json_encode($request->special_sales1));
            $auction->saveMeta('description_and_additional_terms', json_encode($request->description_and_additional_terms));
            $auction->saveMeta('heated_sqft', $request->heated_sqft);
            $auction->saveMeta('price', $request->price);
            $auction->saveMeta('desired_timline', $request->desired_timline);
            $auction->saveMeta('total_sqft', $request->total_sqft);
            $auction->saveMeta('total_acreage', $request->total_acreage);
            $auction->saveMeta('buyer_intrest_in_purchasing', $request->buyer_intrest_in_purchasing);
            $auction->saveMeta('has_rental_restrictions', $request->has_rental_restrictions);
            $auction->saveMeta('has_property_leased', $request->has_property_leased);
            $auction->saveMeta('ammount', $request->ammount);
            $auction->saveMeta('adress_of_the_property', $request->adress_of_the_property);
            $auction->saveMeta('business_card', $request->business_card);
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
            // 12 June 2023 for Residential and Income
            $auction->saveMeta('auction_type', $request->auction_type);
            $auction->saveMeta('auction_length', $request->auction_length);
            $auction->saveMeta('auction_length_days', $auction_length_days);
            $auction->saveMeta('financings', json_encode($request->financings));
            $auction->saveMeta('custom_financings', $request->custom_financings);
            $auction->saveMeta('escrow_amount_percent', $request->escrow_amount_percent);
            $auction->saveMeta('request_seller_premium', $request->request_seller_premium);
            $auction->saveMeta('request_buyer_premium', $request->request_buyer_premium);
            $auction->saveMeta('counties', json_encode($request->counties));
            $auction->saveMeta('cities', json_encode($request->cities));
            $auction->saveMeta('state', $request->state);
            // $auction->saveMeta('parking_spaces_needed', $request->parking_spaces_needed);
            $auction->saveMeta('need_water_view', $request->need_water_view);
            // $auction->saveMeta('condo_fee', $request->condo_fee);
            $auction->saveMeta('old_persons_community', $request->old_persons_community);
            $auction->saveMeta('pets_allowed', $request->pets_allowed);
            $auction->saveMeta('number_of_pets', $request->number_of_pets);
            $auction->saveMeta('pet_type', $request->pet_type);
            $auction->saveMeta('pet_bread', $request->pet_bread);
            $auction->saveMeta('pet_weight', $request->pet_weight);
            $auction->saveMeta('rental_requirements', $request->rental_requirements);
            $auction->saveMeta('total_units_needed', $request->total_units_needed);
            $auction->saveMeta('annual_income', $request->annual_income);
            $auction->saveMeta('min_cap_rate', $request->min_cap_rate);
            $auction->saveMeta('additional_details', $request->additional_details);
            $auction->saveMeta('arv', $request->arv);
            $auction->saveMeta('title_company', $request->title_company);
            $auction->saveMeta('title_agent', $request->title_agent);
            $auction->saveMeta('title_company_phone', $request->title_company_phone);
            $auction->saveMeta('title_company_email', $request->title_company_email);
            DB::commit();
            return redirect()->back()->with('success', 'Buyer criteria auction updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to update buyer criteria auction.');
        }
    }


    public function myAuctions(Request $request)
    {
        $page_data['title'] = 'My Auctions';
        $page_data['type'] = $type = $request->type ?? "2";
        if (Auth::user()->user_type == 'agent') {
            $pendingAuctions = BuyerCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
            $pendingApprovalAuctions = BuyerCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
            $liveAuctions = BuyerCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => false]);
            $soldAuctions = BuyerCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true]); //, 'is_paid' => true
            $pendingPaymentAuctions = BuyerCriteriaAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true, 'is_paid' => false]);
        } else {
            $pendingAuctions = BuyerCriteriaAuction::where(['buyer_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
            $pendingApprovalAuctions = BuyerCriteriaAuction::where(['buyer_id' => Auth::user()->id, 'is_approved' => false, 'is_sold' => false]);
            $liveAuctions = BuyerCriteriaAuction::where(['buyer_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => false]);
            $soldAuctions = BuyerCriteriaAuction::where(['buyer_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true]); //, 'is_paid' => true
            $pendingPaymentAuctions = BuyerCriteriaAuction::where(['buyer_id' => Auth::user()->id, 'is_approved' => true, 'is_sold' => true, 'is_paid' => false]);
        }
        if ($type == "0") {
            // $auctions = $pendingAuctions->get();
        } elseif ($type == "1") {
            $auctions = $pendingApprovalAuctions->get();
        } elseif ($type == "2") {
            $auctions = $liveAuctions->get();
        } elseif ($type == '3') {
            $auctions = $soldAuctions->get();
        } elseif ($type == "4") {
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
        return view('buyer_criteria.list', $page_data);
    }

    public function searchListing(Request $request)
    {
        $page_data['title'] = 'Search Listings';

        $auctions = BuyerCriteriaAuction::where('is_sold', false)->where('is_approved', 1);

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
            } elseif ($sort == 2) {
                $sort_by = 'address';
                $sort_type = 'ASC';
            } elseif ($sort == 3) {
                $sort_by = 'created_at';
                $sort_type = 'DESC';
            } elseif ($sort == 4) {
                $sort_by = 'created_at';
                $sort_type = 'ASC';
            }
            $auctions->orderBy($sort_by, $sort_type);
        } else {
            $auctions->orderBy(DB::raw('RAND()'));
        }

        $auctions_c = $auctions;

        $page_data['count'] = $auctions_c->count();
        // dd($page_data['count']);
        $page_data['pAuctions'] = $auctions->paginate(12);
        return view('buyer_criteria.search', $page_data);
    }
}
