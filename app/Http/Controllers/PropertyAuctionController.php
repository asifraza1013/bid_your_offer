<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\County;
use App\Models\Bedroom;
use App\Models\Bathroom;
use App\Models\Appliance;
use App\Models\Financing;
use App\Models\FeeInclude;
use App\Models\WaterExtra;
use App\Models\HeatingFuel;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\WaterViewType;
use App\Mail\NotificationEmail;
use App\Models\PropertyAuction;
use Illuminate\Support\Facades\DB;
use App\Models\AirConditioningType;
use App\Models\PropertyAuctionFuel;
use App\Models\PropertyAuctionTerm;
use App\Models\PropertyAuctionMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\PropertyAuctionAcType;
use App\Models\PropertyAuctionAppliance;
use App\Models\PropertyAuctionFinancing;
use App\Models\PropertyAuctionFeeInclude;
use App\Models\PropertyAuctionWaterExtra;
use App\Models\PropertyAuctionPropertyType;
use App\Events\SellerPropertyAuctionCreated;
use App\Events\SellerPropertyAuctionUpdated;    
use App\Models\PropertyAuctionBid;
use App\Models\PropertyAuctionWaterViewType;
use Illuminate\Http\Response;

class PropertyAuctionController extends Controller
{
    public function addListing(Request $request)
    {
        $page_data['title'] = 'Add Property Listing';
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        return view('seller_property.add', $page_data);
    }
    public function store(Request $request)
    {
        // dd('slkjdf');
        try {
            DB::beginTransaction();

            if (str_contains(strtolower($request->auction_length), 'day')) {
                $auction_lengths = explode(' ', $request->auction_length);
                $auction_length_days = current($auction_lengths);
            } else {
                $auction_length_days = '-1';
            }
            $auction = new PropertyAuction();
            $auction->user_id = Auth::user()->id;
            $auction->address = $request->address;
            $auction->description = $request->description;
            $keywords = str_replace(' ', ',', $request->keywords);
            $auction->keywords = $keywords;
            $auction->autobid_price = $request->autobid_price;
            $auction->autobid_price2 = $request->autobid_price2;
            $auction->autobid_price3 = $request->autobid_price3;
            $auction->escrow_amount = $request->escrow_amount;
            $auction->escrow_amount2 = $request->escrow_amount2;
            $auction->inspection_period = $request->inspection_period;
            $auction->inspection_period2 = $request->inspection_period2;
            $auction->closing_days2 = $request->closing_days2;
            $auction->closing_days = $request->closing_days;
            $listing_date = Carbon::parse($request->listing_date);
            $expiration_date = Carbon::parse($request->expiration_date);
            $auction->listing_date = $listing_date;
            $auction->expiration_date = $expiration_date;
            $auction->save();
            $auction->saveMeta("address",$request->address);
            $auction->saveMeta("city",$request->city);
            $auction->saveMeta("county",$request->county);
            $auction->saveMeta("state",$request->state);
            $auction->saveMeta("listing_date",$request->listing_date);
            $auction->saveMeta("expiration_date",$request->expiration_date);
            $auction->saveMeta("service_type",$request->service_type);
            $auction->saveMeta("representation",$request->representation);
            $auction->saveMeta("special_sale",$request->special_sale);
            $auction->saveMeta("custom_special_sale_provision",$request->custom_special_sale_provision);
            $auction->saveMeta("contribute_term",$request->contribute_term);
            $auction->saveMeta("commercialseller_contract_yes",$request->commercialseller_contract_yes);
            $auction->saveMeta("custom_seller_contract_no",$request->custom_seller_contract_no);
            $auction->saveMeta("auction_type",$request->auction_type);
            $auction->saveMeta("auction_length",$request->auction_length);
            $auction->saveMeta("buy_now_price",$request->buy_now_price);
            $auction->saveMeta("buy_now_price_per_sqfeet",$request->buy_now_price_per_sqfeet);
            $auction->saveMeta("starting_price",$request->starting_price);
            $auction->saveMeta("reserve_price",$request->reserve_price);
            $auction->saveMeta("price_per_sqfeet",$request->price_per_sqfeet);
            $auction->saveMeta("escrow_amount",$request->escrow_amount);
            $auction->saveMeta("closing_days",$request->closing_days);
            $auction->saveMeta("contigencies_accepted_by_seller",$request->contigencies_accepted_by_seller);
            $auction->saveMeta("inspection",$request->inspection);
            $auction->saveMeta("appraisal",$request->appraisal);
            $auction->saveMeta("finance",$request->finance);
            $auction->saveMeta("saleContingency",$request->saleContingency);
            $auction->saveMeta("acceptable",$request->acceptable);
            $auction->saveMeta("acceptable_days",$request->acceptable_days);
            $auction->saveMeta("term_financings",$request->term_financings);
            $auction->saveMeta("otherFinancing",$request->otherFinancing);
            $auction->saveMeta("type_of_NFT_accepted",$request->type_of_NFT_accepted);
            $auction->saveMeta("percentage_in_NFT",$request->percentage_in_NFT);
            $auction->saveMeta("percentage_in_cash",$request->percentage_in_cash);
            $auction->saveMeta("cryptocurrency_type",$request->cryptocurrency_type);
            $auction->saveMeta("percentage_in_crypto",$request->percentage_in_crypto);
            $auction->saveMeta("purchase_price_seller_financing",$request->purchase_price_seller_financing);
            $auction->saveMeta("down_payment_seller_financing",$request->down_payment_seller_financing);
            $auction->saveMeta("seller_financing_amount",$request->seller_financing_amount);
            $auction->saveMeta("interest_rate_seller_financing",$request->interest_rate_seller_financing);
            $auction->saveMeta("term_seller_financing",$request->term_seller_financing);
            $auction->saveMeta("monthly_payment_seller_financing",$request->monthly_payment_seller_financing);
            $auction->saveMeta("closing_costs",$request->closing_costs);
            $auction->saveMeta("ballonPenalty",$request->ballonPenalty);
            $auction->saveMeta("ballonPenaltyYes",$request->ballonPenaltyYes);
            $auction->saveMeta("balloonPay",$request->balloonPay);
            $auction->saveMeta("balloonPayment",$request->balloonPayment);
            $auction->saveMeta("balloonDue",$request->balloonDue);
            $auction->saveMeta("desired_offering_price",$request->desired_offering_price);
            $auction->saveMeta("lease_option_terms",$request->lease_option_terms);
            $auction->saveMeta("proposed_lease_duration",$request->proposed_lease_duration);
            $auction->saveMeta("monthly_payment_amount",$request->monthly_payment_amount);
            $auction->saveMeta("lease_option_conditions",$request->lease_option_conditions);
            $auction->saveMeta("price_changes_possibility",$request->price_changes_possibility);
            $auction->saveMeta("exchange_trade",$request->exchange_trade);
            $auction->saveMeta("sellerFeeOptionYes",$request->sellerFeeOptionYes);
            $auction->saveMeta("desired_offering_price_lease_purchase",$request->desired_offering_price_lease_purchase);
            $auction->saveMeta("lease_purchase_terms",$request->lease_purchase_terms);
            $auction->saveMeta("proposed_lease_duration_lease_purchase",$request->proposed_lease_duration_lease_purchase);
            $auction->saveMeta("monthly_payment_amount_lease_purchase",$request->monthly_payment_amount_lease_purchase);
            $auction->saveMeta("lease_purchase_conditions",$request->lease_purchase_conditions);
            $auction->saveMeta("price_changes_possibility_lease_purchase",$request->price_changes_possibility_lease_purchase);
            $auction->saveMeta("sellerFeePurchaseYes",$request->sellerFeePurchaseYes);
            $auction->saveMeta("assumable_terms_offered",$request->assumable_terms_offered);
            $auction->saveMeta("restrictions_or_qualifications",$request->restrictions_or_qualifications);
            $auction->saveMeta("assumable_interest",$request->assumable_interest);
            $auction->saveMeta("assumable_monthly_payment",$request->assumable_monthly_payment);
            $auction->saveMeta("outstandingBalanceYes",$request->outstandingBalanceYes);
            $auction->saveMeta("loan_balance_down_payment",$request->loan_balance_down_payment);
            $auction->saveMeta("otherTrade",$request->otherTrade);
            $auction->saveMeta("estimatedTrade",$request->estimatedTrade);
            $auction->saveMeta("specificTrade",$request->specificTrade);
            $auction->saveMeta("cashTrade",$request->cashTrade);
            $auction->saveMeta("valueTrade",$request->valueTrade);
            $auction->saveMeta("sellerOffer",$request->sellerOffer);
            $auction->saveMeta("sellerOfferYes",$request->sellerOfferYes);
            $auction->saveMeta("escrow_amount2",$request->escrow_amount2);
            $auction->saveMeta("closing_days2",$request->closing_days2);
            $auction->saveMeta("timeFrame",$request->timeFrame);
            $auction->saveMeta("multiTimeFrame",$request->multiTimeFrame);
            $auction->saveMeta("property_type",$request->property_type);
            $auction->saveMeta("propertyStyles",$request->propertyStyles);
            $auction->saveMeta("property_items",$request->property_items);
            $auction->saveMeta("otherProperty",$request->otherProperty);
            $auction->saveMeta("prop_condition",$request->prop_condition);
            $auction->saveMeta("otherCondition",$request->otherCondition);
            $auction->saveMeta("bedrooms",$request->bedrooms);
            $auction->saveMeta("custom_bedrooms",$request->custom_bedrooms);
            $auction->saveMeta("bathrooms",$request->bathrooms);
            $auction->saveMeta("custom_bathrooms",$request->custom_bathrooms);
            $auction->saveMeta("unit_type",$request->unit_type);
            $auction->saveMeta("beds_unit",$request->beds_unit);
            $auction->saveMeta("baths_unit",$request->baths_unit);
            $auction->saveMeta("sqt_ft_heated",$request->sqt_ft_heated);
            $auction->saveMeta("number_of_units",$request->number_of_units);
            $auction->saveMeta("occupied",$request->occupied);
            $auction->saveMeta("custom_occupied",$request->custom_occupied);
            $auction->saveMeta("current_rent",$request->current_rent);
            $auction->saveMeta("expected_rent",$request->expected_rent);
            $auction->saveMeta("garage_spaces_unit",$request->garage_spaces_unit);
            $auction->saveMeta("unit_type_of_description",$request->unit_type_of_description);
            $auction->saveMeta("annual_gross_income",$request->annual_gross_income);
            $auction->saveMeta("total_monthly_rent",$request->total_monthly_rent);
            $auction->saveMeta("total_monthly_expenses",$request->total_monthly_expenses);
            $auction->saveMeta("annual_net_income",$request->annual_net_income);
            $auction->saveMeta("est_annual_market_income",$request->est_annual_market_income);
            $auction->saveMeta("annual_expenses",$request->annual_expenses);
            $auction->saveMeta("custom_leases_terms",$request->custom_leases_terms);
            $auction->saveMeta("terms_of_lease",$request->terms_of_lease);
            $auction->saveMeta("otherTermLease",$request->otherTermLease);
            $auction->saveMeta("tenant_pays",$request->tenant_pays);
            $auction->saveMeta("otherTenantPay",$request->otherTenantPay);
            $auction->saveMeta("financial_sources",$request->financial_sources);
            $auction->saveMeta("total_number_of_units",$request->total_number_of_units);
            $auction->saveMeta("heated_sqft",$request->heated_sqft);
            $auction->saveMeta("total_sqft",$request->total_sqft);
            $auction->saveMeta("heated_source",$request->heated_source);
            $auction->saveMeta("total_aceage",$request->total_aceage);
            $auction->saveMeta("lot_size",$request->lot_size);
            $auction->saveMeta("year_built",$request->year_built);
            $auction->saveMeta("legal_description",$request->legal_description);
            $auction->saveMeta("legal_subdivison_name",$request->legal_subdivison_name);
            $auction->saveMeta("appliances",json_encode($request->appliances));
            $auction->saveMeta("otherAppliances",$request->otherAppliances);
            $auction->saveMeta("fireplace",$request->fireplace);
            $auction->saveMeta("has_furnishing",$request->has_furnishing);
            $auction->saveMeta("furnishings_include",$request->furnishings_include);
            $auction->saveMeta("has_additional_fees",$request->has_additional_fees);
            $auction->saveMeta("listed_furniture_price",$request->listed_furniture_price);
            $auction->saveMeta("interior_features",json_encode($request->interior_features));
            $auction->saveMeta("otherInterior",$request->otherInterior);
            $auction->saveMeta("additionalRooms",json_encode($request->additionalRooms));
            $auction->saveMeta("number_of_buildings",$request->number_of_buildings);
            $auction->saveMeta("floors_in_unit",$request->floors_in_unit);
            $auction->saveMeta("total_floors",$request->total_floors);
            $auction->saveMeta("building_elevator",$request->building_elevator);
            $auction->saveMeta("floor_covering",json_encode($request->floor_covering));
            $auction->saveMeta("otherFloorCovering",$request->otherFloorCovering);
            $auction->saveMeta("front_exposure",$request->front_exposure);
            $auction->saveMeta("foundation",json_encode($request->foundation));
            $auction->saveMeta("otherFoundation",$request->otherFoundation);
            $auction->saveMeta("exterior_construction",json_encode($request->exterior_construction));
            $auction->saveMeta("otherConstruction",$request->otherConstruction);
            $auction->saveMeta("exterior_feature",json_encode($request->exterior_feature));
            $auction->saveMeta("otherExterior",$request->otherExterior);
            $auction->saveMeta("lot_features",json_encode($request->lot_features));
            $auction->saveMeta("otherLotFeature",$request->otherLotFeature);
            $auction->saveMeta("otherStructureOpt",$request->otherStructureOpt);
            $auction->saveMeta("otherStruct",$request->otherStruct);
            $auction->saveMeta("otherStructure",$request->otherStructure);
            $auction->saveMeta("unitStructure",$request->unitStructure);
            $auction->saveMeta("sqftStructure",$request->sqftStructure);
            $auction->saveMeta("totalSqft",$request->totalSqft);
            $auction->saveMeta("roof",json_encode($request->roof));
            $auction->saveMeta("otherRoof",$request->otherRoof);
            $auction->saveMeta("road_surface_type",json_encode($request->road_surface_type));
            $auction->saveMeta("otherSurface",$request->otherSurface);
            $auction->saveMeta("garage",$request->garage);
            $auction->saveMeta("garage_spaces",$request->garage_spaces);
            $auction->saveMeta("carport",$request->carport);
            $auction->saveMeta("carport_spaces",$request->carport_spaces);
            $auction->saveMeta("pool",$request->pool);
            $auction->saveMeta("poolOpt",$request->poolOpt);
            $auction->saveMeta("ptesAllowed",$request->ptesAllowed);
            $auction->saveMeta("acceptablePet",$request->acceptablePet);
            $auction->saveMeta("has_rental_restrictions",$request->has_rental_restrictions);
            $auction->saveMeta("total_pets_allowed",$request->total_pets_allowed);
            $auction->saveMeta("custom_pets_allowed",$request->custom_pets_allowed);
            $auction->saveMeta("max_pet_weight",$request->max_pet_weight);
            $auction->saveMeta("pet_restrictions",$request->pet_restrictions);
            $auction->saveMeta("tax_id",$request->tax_id);
            $auction->saveMeta("tax_year",$request->tax_year);
            $auction->saveMeta("taxes_annual_amount",$request->taxes_annual_amount);
            $auction->saveMeta("has_homestead",$request->has_homestead);
            $auction->saveMeta("total_number_of_parcels",$request->total_number_of_parcels);
            $auction->saveMeta("additional_tax_id",$request->additional_tax_id);
            $auction->saveMeta("zoning",$request->zoning);
            $auction->saveMeta("is_in_flood_zone",$request->is_in_flood_zone);
            $auction->saveMeta("flood_zone_code",$request->flood_zone_code);
            $auction->saveMeta("utilities",json_encode($request->utilities));
            $auction->saveMeta("otherUtilitise",$request->otherUtilitise);
            $auction->saveMeta("water",json_encode($request->water));
            $auction->saveMeta("otherWater",$request->otherWater);
            $auction->saveMeta("sewer", json_encode($request->sewer));
            $auction->saveMeta("otherSewer",$request->otherSewer);
            $auction->saveMeta("air_conditioning",$request->air_conditioning);
            $auction->saveMeta("otherAirCondition",$request->otherAirCondition);
            $auction->saveMeta("heating_and_fuel", json_encode($request->heating_and_fuel));
            $auction->saveMeta("otherHeatingFuel",$request->otherHeatingFuel);
            $auction->saveMeta("approximate_room_dimensions",$request->approximate_room_dimensions);
            $auction->saveMeta("room_feature",json_encode($request->room_feature));
            $auction->saveMeta("custom_room_features",$request->custom_room_features);
            $auction->saveMeta("has_water_access",$request->has_water_access);
            $auction->saveMeta("water_access",json_encode($request->water_access));
            $auction->saveMeta("has_water_view",$request->has_water_view);
            $auction->saveMeta("water_view",json_encode($request->water_view));
            $auction->saveMeta("has_water_extra",$request->has_water_extra);
            $auction->saveMeta("water_extras",json_encode($request->water_extras));
            $auction->saveMeta("has_dock",$request->has_dock);
            $auction->saveMeta("dock",json_encode($request->dock));
            $auction->saveMeta("custom_dock",$request->custom_dock);
            $auction->saveMeta("dock_lift_capacity",$request->dock_lift_capacity);
            $auction->saveMeta("dock_year_built",$request->dock_year_built);
            $auction->saveMeta("dock_dimension",$request->dock_dimension);
            $auction->saveMeta("dock_maintenance_fee",$request->dock_maintenance_fee);

            $auction->saveMeta("green_features",$request->green_features);
            $auction->saveMeta("building_verification",$request->building_verification);
            $auction->saveMeta("green_status",$request->green_status);
            $auction->saveMeta("green_year",$request->green_year);
            $auction->saveMeta("green_version",$request->green_version);
            $auction->saveMeta("green_body",$request->green_body);
            $auction->saveMeta("green_metric",$request->green_metric);
            $auction->saveMeta("green_rating",$request->green_rating);
            $auction->saveMeta("green_source",$request->green_source);
            $auction->saveMeta("green_url",$request->green_url);
            $auction->saveMeta("green_sustainability",$request->green_sustainability);
            $auction->saveMeta("green_generation",$request->green_generation);
            $auction->saveMeta("green_water_features",$request->green_water_features);
            $auction->saveMeta("green_energy_features",$request->green_energy_features);
            $auction->saveMeta("green_landscaping",$request->green_landscaping);
            $auction->saveMeta("green_solar",$request->green_solar);
            $auction->saveMeta("green_disaster",$request->green_disaster);
            $auction->saveMeta("green_air",$request->green_air);

            $auction->saveMeta("has_water_fontage",$request->has_water_fontage);
            $auction->saveMeta("water_frontage",json_encode($request->water_frontage));
            $auction->saveMeta("viewOpt",$request->viewOpt);
            $auction->saveMeta("view",json_encode($request->view));
            $auction->saveMeta("otherView",$request->otherView);
            $auction->saveMeta("ownership",$request->ownership);
            $auction->saveMeta("otherOwnership",$request->otherOwnership);
            $auction->saveMeta("occupant_type",$request->occupant_type);
            $auction->saveMeta("exiting_lease_or_tenant",$request->exiting_lease_or_tenant);
            $auction->saveMeta("end_of_lease_date",$request->end_of_lease_date);
            $auction->saveMeta("monthToMonth",$request->monthToMonth);
            $auction->saveMeta("monthly_rental_ammount",$request->monthly_rental_ammount);
            $auction->saveMeta("days_notice_to_terminate",$request->days_notice_to_terminate);
            $auction->saveMeta("has_leasing",$request->has_leasing);
            $auction->saveMeta("has_lease_restriction",$request->has_lease_restriction);
            $auction->saveMeta("association_approval_required",$request->association_approval_required);
            $auction->saveMeta("minimum_lease_period",$request->minimum_lease_period);
            $auction->saveMeta("minimum_lease_per_year",$request->minimum_lease_per_year);
            $auction->saveMeta("years_of_ownership",$request->years_of_ownership);
            $auction->saveMeta("number_of_ownership_prior_lease",$request->number_of_ownership_prior_lease);
            $auction->saveMeta("has_hoa",$request->has_hoa);
            $auction->saveMeta("community_feature",json_encode($request->community_feature));
            $auction->saveMeta("association_amenitie",json_encode($request->association_amenitie));
            $auction->saveMeta("otherAssocAmenities",$request->otherAssocAmenities);
            $auction->saveMeta("fee_include",json_encode($request->fee_include));
            $auction->saveMeta("otherFeeInclude",$request->otherFeeInclude);
            $auction->saveMeta("amenities_with_additional_fees",$request->amenities_with_additional_fees);
            $auction->saveMeta("has_cdd",$request->has_cdd);
            $auction->saveMeta("annual_cdd_fee",$request->annual_cdd_fee);
            $auction->saveMeta("has_land_lease",$request->has_land_lease);
            $auction->saveMeta("land_lease_fee",$request->land_lease_fee);
            $auction->saveMeta("hoaFeeRequirements",$request->hoaFeeRequirements);
            $auction->saveMeta("hoaFeeAmount",$request->hoaFeeAmount);
            $auction->saveMeta("paymentSchedules",$request->paymentSchedules);
            $auction->saveMeta("condoFeeAmount",$request->condoFeeAmount);
            $auction->saveMeta("condoPay",$request->condoPay);
            $auction->saveMeta("masterAssoc",$request->masterAssoc);
            $auction->saveMeta("masterAssociationFeeAmount",$request->masterAssociationFeeAmount);
            $auction->saveMeta("assocSchedule",$request->assocSchedule);
            $auction->saveMeta("masterAssociationName",$request->masterAssociationName);
            $auction->saveMeta("masterAssociationContactPhone",$request->masterAssociationContactPhone);
            $auction->saveMeta("additionalFees",$request->additionalFees);
            $auction->saveMeta("additionalFeeReason",$request->additionalFeeReason);
            $auction->saveMeta("otherFeeAmount",$request->otherFeeAmount);
            $auction->saveMeta("otherFee",$request->otherFee);
            $auction->saveMeta("associationManagerContactName",$request->associationManagerContactName);
            $auction->saveMeta("associationManagerContactEmail",$request->associationManagerContactEmail);
            $auction->saveMeta("associationManagerContactPhone",$request->associationManagerContactPhone);
            $auction->saveMeta("associationManagerContactWebsite",$request->associationManagerContactWebsite);
            $auction->saveMeta("olderPersons",$request->olderPersons);
            $auction->saveMeta("description",$request->description);
            $auction->saveMeta("keywords",$request->keywords);
            $auction->saveMeta("disclamer",$request->disclamer);
            $auction->saveMeta("driving_directions",$request->driving_directions);
            $auction->saveMeta("looking_other_property",$request->looking_other_property);
            $auction->saveMeta("compensation_amount",$request->compensation_amount);
            $auction->saveMeta("listing_link",$request->listing_link);
            $auction->saveMeta("title_company_name",$request->title_company_name);
            $auction->saveMeta("title_company_address",$request->title_company_address);
            $auction->saveMeta("title_company_phone",$request->title_company_phone);
            $auction->saveMeta("title_company_email",$request->title_company_email);
            $auction->saveMeta("agent_first_name",$request->agent_first_name);
            $auction->saveMeta("agent_last_name",$request->agent_last_name);
            $auction->saveMeta("agent_phone",$request->agent_phone);
            $auction->saveMeta("agent_email",$request->agent_email);
            $auction->saveMeta("agent_brokerage",$request->agent_brokerage);
            $auction->saveMeta("agent_license_no",$request->agent_license_no);
            $auction->saveMeta("agent_mls_id",$request->agent_mls_id);
            $auction->saveMeta("realEstateAgent",$request->realEstateAgent);
            $auction->saveMeta("three_d_tour",$request->three_d_tour);

            // Pictures and Video Upload
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];

            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps'];
            $visible_upload_file = [];
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf

            if ($request->hasFile('floor_plan')) {
                $file = $request->floor_plan;
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $fileName = $uuid . '.' . $extension;
                    $file->move(public_path('auction/files'), $fileName);
                    $auction->saveMeta('floor_plan', 'auction/files/' . $fileName);
                }
            }
            if ($request->hasFile('photo')) {
                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $photoName = $uuid . '.' . $extension;
                    $photo->move(public_path('auction/images'), $photoName);
                    $auction->saveMeta('photo', 'auction/images/' . $photoName);
                }
            }
            // Picture Upload
            // Video Upload
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
            // Video Upload
            // Disclosure Upload
            $disclosures = [];
            if ($request->hasFile('disclosures')) {
                foreach ($request->file('disclosures') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileSize = $file->getSize();
                    $check = in_array($extension, $allowedFiles);
                    if ($check) {
                        $uuid = (string) Str::uuid();
                        $fileName = $uuid . '.' . $extension;
                        $file->move(public_path('auction/files'), $fileName);
                        $disclosures[] = 'auction/files/' . $fileName;
                    }
                }
                $auction->saveMeta('disclosures', json_encode($disclosures));
            }
  
            DB::commit();
            // SellerPropertyAuctionCreated::dispatch($auction);

            return redirect()->back()->with('success', 'Property listing added successfully.');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to add property listing.');
        }
    }

    public function edit($id, Request $request)
    {
        $page_data['auction'] = PropertyAuction::find($id);
        $page_data['title'] = 'Edit Seller\'s Property Listing';
        $page_data['property_types'] = PropertyType::orderBy('sort', 'ASC')->get();
        return view('seller_property.edit', $page_data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            if (str_contains(strtolower($request->auction_length), 'day')) {
                $auction_lengths = explode(' ', $request->auction_length);
                $auction_length_days = current($auction_lengths);
            } else {
                $auction_length_days = '-1';
            }
            $auction = PropertyAuction::find($id);
            $auction->user_id = Auth::user()->id;
            $auction->address = $request->address;
            $auction->description = $request->description;
            $keywords = str_replace(' ', ',', $request->keywords);
            $auction->keywords = $keywords;
            $auction->autobid_price = $request->autobid_price;
            $auction->autobid_price2 = $request->autobid_price2;
            $auction->autobid_price3 = $request->autobid_price3;
            $auction->escrow_amount = $request->escrow_amount;
            $auction->escrow_amount2 = $request->escrow_amount2;
            $auction->inspection_period = $request->inspection_period;
            $auction->inspection_period2 = $request->inspection_period2;
            $auction->closing_days2 = $request->closing_days2;
            $auction->closing_days = $request->closing_days;
            $auction->auto_bid = $request->auto_bid;
            $listing_date = Carbon::parse($request->listing_date);
            $expiration_date = Carbon::parse($request->expiration_date);
            $auction->listing_date = $listing_date;
            $auction->expiration_date = $expiration_date;
            $auction->update();
            $auction->saveMeta('address', $request->address);
            $auction->saveMeta('city', $request->city);
            $auction->saveMeta('state', $request->state);
            $auction->saveMeta('listing_date', $request->listing_date);
            $auction->saveMeta('starting_price', $request->starting_price);
            $auction->saveMeta('expiration_date', $request->expiration_date);
            $auction->saveMeta('county', $request->county);
            $auction->saveMeta('property_type', $request->property_type);
            $auction->saveMeta('contigencies_accepted_by_seller', $request->contigencies_accepted_by_seller);
            $auction->saveMeta('term_financings', $request->term_financings);
            $auction->saveMeta('property_items', $request->property_items);
            $auction->saveMeta('bedrooms', $request->bedrooms);
            $auction->saveMeta('custom_bedrooms', $request->custom_bedrooms);
            $auction->saveMeta('building_features', json_encode($request->building_features));
            $auction->saveMeta('lot_features', json_encode($request->lot_features));
            $auction->saveMeta('auto_bid', $request->auto_bid);
            $auction->saveMeta('closing_days', $request->closing_days);
            $auction->saveMeta('closing_days2', $request->closing_days2);
            $auction->saveMeta('inspection_period2', $request->inspection_period2);
            $auction->saveMeta('inspection_period', $request->inspection_period);
            $auction->saveMeta('bathrooms', $request->bathrooms);
            $auction->saveMeta('custom_bathrooms', $request->custom_bathrooms);
            // 3 Jul 2023
            $auction->saveMeta('current_use', $request->current_use);
            $auction->saveMeta('has_real_estate_include', $request->has_real_estate_include);
            $auction->saveMeta('business_name', $request->business_name);
            $auction->saveMeta('year_established', $request->year_established);
            $auction->saveMeta('real_estate_include', $request->real_estate_include);
            $auction->saveMeta('prop_condition', $request->prop_condition);
            $auction->saveMeta('heated_sqft', $request->heated_sqft);
            $auction->saveMeta('total_heated_sqft', $request->total_heated_sqft);
            $auction->saveMeta('sqft', $request->sqft);
            $auction->saveMeta('heated_source', $request->heated_source);
            $auction->saveMeta('total_aceage', $request->total_aceage);
            $auction->saveMeta('lot_size', $request->lot_size);
            $auction->saveMeta('number_of_buildings', $request->number_of_buildings);
            $auction->saveMeta('floors_in_unit', $request->floors_in_unit);
            $auction->saveMeta('total_floors', $request->total_floors);
            $auction->saveMeta('building_elevator', $request->building_elevator);
            $auction->saveMeta('appliances', json_encode($request->appliances));
            $auction->saveMeta('floor_covering', json_encode($request->floor_covering));
            $auction->saveMeta('interior_feature', json_encode($request->interior_feature));
            $auction->saveMeta('utilities', json_encode($request->utilities));
            $auction->saveMeta('water', json_encode($request->water12));
            $auction->saveMeta('sewer', json_encode($request->sewer));
            $auction->saveMeta('room_type', $request->room_type);
            $auction->saveMeta('room_level', $request->room_level);
            $auction->saveMeta('bed_room_closest_type', $request->bed_room_closest_type);
            $auction->saveMeta('room_primary_floor_covering', $request->room_primary_floor_covering);
            $auction->saveMeta('room_feature', json_encode($request->room_feature));
            $auction->saveMeta('adjoining_property', $request->adjoining_property);
            $auction->saveMeta('foundation', $request->foundation);
            $auction->saveMeta('exterior_construction', $request->exterior_construction);
            $auction->saveMeta('exterior_feature', json_encode($request->exterior_feature));
            $auction->saveMeta('roof', $request->roof);
            $auction->saveMeta('road_surface_type', $request->road_surface_type);
            $auction->saveMeta('road_frontage', $request->road_frontage);
            $auction->saveMeta('front_exposure', $request->front_exposure);
            $auction->saveMeta('parking_feature', json_encode($request->parking_feature));
            $auction->saveMeta('total_acreage', $request->total_acreage);
            $auction->saveMeta('lot_dimensions', $request->lot_dimensions);
            $auction->saveMeta('lot_size_square_footage', $request->lot_size_square_footage);
            $auction->saveMeta('front_footage', $request->front_footage);
            $auction->saveMeta('lot_size_acres', $request->lot_size_acres);
            $auction->saveMeta('has_water_view', $request->has_water_view);
            $auction->saveMeta('water_view', json_encode($request->water_view));
            $auction->saveMeta('has_water_extra', $request->has_water_extra);
            $auction->saveMeta('water_extras', json_encode($request->water_extras));
            $auction->saveMeta('has_water_fontage', $request->has_water_fontage);
            $auction->saveMeta('water_access', json_encode($request->water_access));
            $auction->saveMeta('ownership_co_op', $request->ownership_co_op);
            $auction->saveMeta('is_in_flood_zone', $request->is_in_flood_zone);
            $auction->saveMeta('flood_zone_code', $request->flood_zone_code);
            $auction->saveMeta('has_rental_restrictions', $request->has_rental_restrictions);
            $auction->saveMeta('total_pets_allowed', $request->total_pets_allowed);
            $auction->saveMeta('custom_pets_allowed', $request->custom_pets_allowed);
            $auction->saveMeta('max_pet_weight', $request->max_pet_weight);
            $auction->saveMeta('pet_restrictions', $request->pet_restrictions);
            $auction->saveMeta('tax_id', $request->tax_id);
            $auction->saveMeta('tax_year', $request->tax_year);
            $auction->saveMeta('taxes_annual_ammount', $request->taxes_annual_ammount);
            $auction->saveMeta('total_number_of_parcels', $request->total_number_of_parcels);
            $auction->saveMeta('additional_tax_id', $request->additional_tax_id);
            $auction->saveMeta('zoning', $request->zoning);
            $auction->saveMeta('occupant_type', $request->occupant_type);
            $auction->saveMeta('exiting_lease_or_tenant', $request->exiting_lease_or_tenant);
            $auction->saveMeta('monthly_rental_ammount', $request->monthly_rental_ammount);
            $auction->saveMeta('days_notice_to_terminate', $request->days_notice_to_terminate);
            $auction->saveMeta('end_of_lease_date', $request->end_of_lease_date);
            $auction->saveMeta('unit_type', $request->unit_type);
            $auction->saveMeta('sqt_ft_heated', $request->sqt_ft_heated);
            $auction->saveMeta('number_of_units', $request->number_of_units);
            $auction->saveMeta('occupied', $request->occupied);
            $auction->saveMeta('expected_rent', $request->expected_rent);
            $auction->saveMeta('garage_spaces', $request->garage_spaces);
            $auction->saveMeta('garage_attribute', $request->garage_attribute);
            $auction->saveMeta('unit_type_of_description', $request->unit_type_of_description);
            $auction->saveMeta('annual_gross_income', $request->annual_gross_income);
            $auction->saveMeta('total_monthly_rent', $request->total_monthly_rent);
            $auction->saveMeta('total_monthly_expenses', $request->total_monthly_expenses);
            $auction->saveMeta('lease_terms', $request->lease_terms);
            $auction->saveMeta('annual_net_income', $request->annual_net_income);
            $auction->saveMeta('est_annual_market_income', $request->est_annual_market_income);
            $auction->saveMeta('annual_expenses', $request->annual_expenses);
            $auction->saveMeta('terms_of_lease', $request->terms_of_lease);
            $auction->saveMeta('tenant_pays', $request->tenant_pays);
            $auction->saveMeta('financial_sources', $request->financial_sources);
            $auction->saveMeta('total_number_of_units', $request->total_number_of_units);
            $auction->saveMeta('has_leasing', $request->has_leasing);
            $auction->saveMeta('has_lease_restriction', $request->has_lease_restriction);
            $auction->saveMeta('association_approval_required', $request->association_approval_required);
            $auction->saveMeta('minimum_lease_period', $request->minimum_lease_period);
            $auction->saveMeta('minimum_lease_per_year', $request->minimum_lease_per_year);
            $auction->saveMeta('years_of_ownership', $request->years_of_ownership);
            $auction->saveMeta('number_of_ownership', $request->number_of_ownership);
            $auction->saveMeta('number_of_ownership_prior_lease', $request->number_of_ownership_prior_lease);
            $auction->saveMeta('operating_expenses', $request->operating_expenses);
            $auction->saveMeta('net_operating_income', $request->net_operating_income);
            $auction->saveMeta('annual_expenses', $request->annual_expenses);
            $auction->saveMeta('annual_ttl_schedule_income', $request->annual_ttl_schedule_income);
            $auction->saveMeta('number_of_tenants', $request->number_of_tenants);
            $auction->saveMeta('sale_includes', $request->sale_includes);
            $auction->saveMeta('net_operating_income_type', $request->net_operating_income_type);
            $auction->saveMeta('annual_income_type', $request->annual_income_type);
            $auction->saveMeta('ownership', $request->ownership);
            $auction->saveMeta('has_hoa', $request->has_hoa);
            $auction->saveMeta('hoa_fee_requirenment', $request->hoa_fee_requirenment);
            $auction->saveMeta('hoa_fee', $request->hoa_fee);
            $auction->saveMeta('hoa_payment_schedule', $request->hoa_payment_schedule);
            $auction->saveMeta('condo_fee', $request->condo_fee);
            $auction->saveMeta('condo_fee_schedule', $request->condo_fee_schedule);
            $auction->saveMeta('other_fee', $request->other_fee);
            $auction->saveMeta('other_fee_schedule', $request->other_fee_schedule);
            $auction->saveMeta('additional_monthly_maintenance_fee', $request->additional_monthly_maintenance_fee);
            $auction->saveMeta('association_name', $request->association_name);
            $auction->saveMeta('has_master_association', $request->has_master_association);
            $auction->saveMeta('master_association_fee', $request->master_association_fee);
            $auction->saveMeta('master_association_schedule', $request->master_association_schedule);
            $auction->saveMeta('master_association_name', $request->master_association_name);
            $auction->saveMeta('housing_for_older_persons', $request->housing_for_older_persons);
            $auction->saveMeta('is_condo_enviornment', $request->is_condo_enviornment);
            $auction->saveMeta('is_condo_enviornment', $request->is_condo_enviornment);
            $auction->saveMeta('condo_fee', $request->condo_fee);
            $auction->saveMeta('condo_fee_term', $request->condo_fee_term);
            $auction->saveMeta('association_contact_name', $request->association_contact_name);
            $auction->saveMeta('association_contact_information', $request->association_contact_information);
            $auction->saveMeta('association_contact_information', $request->association_contact_information);
            $auction->saveMeta('community_feature', json_encode($request->community_feature));
            $auction->saveMeta('association_amenitie', json_encode($request->association_amenitie));
            $auction->saveMeta('fee_include', json_encode($request->fee_include));
            $auction->saveMeta('amenities_with_additional_fees', $request->amenities_with_additional_fees);
            $auction->saveMeta('cost_additional_amenities', $request->cost_additional_amenities);
            $auction->saveMeta('description', $request->description);
            $auction->saveMeta('association_amenitie', json_encode($request->association_amenitie));
            $keywords = str_replace(' ', ',', $request->keywords);
            $auction->saveMeta('keywords', json_encode($keywords));
            $auction->saveMeta('driving_directions', $request->driving_directions);
            $auction->saveMeta('looking_other_property', $request->looking_other_property);
            $auction->saveMeta('listing_link', $request->listing_link);
            $auction->saveMeta('title_company_info', $request->title_company_info);
            $auction->saveMeta('agent_info', $request->agent_info);
            $auction->saveMeta('dual_variable_compensation', $request->dual_variable_compensation);
            $auction->saveMeta('three_d_tour', $request->three_d_tour);

            // Pictures and Video Upload

            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            $allowedVideos = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm', 'm4v'];

            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps'];
            $visible_upload_file = [];
            $allowedPhotos = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            // $allowedVideos = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'mpeg-2'];
            $allowedAudios = ['mp3', 'wav', 'voc', 'ogg', 'oga', 'cda', 'ogv', 'm4a'];
            $allowedFiles = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'csv', 'txt', 'xlx', 'xls', 'pdf', 'doc', 'docs', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'odt', 'rtf', 'wps', 'xml', 'xps']; //csv,txt,xlx,xls,pdf

            // 8 June 2023

            if ($request->hasFile('floor_plan')) {
                $floorPlan = $request->floor_plan;
                $extension = $floorPlan->getClientOriginalExtension();
                $check = in_array($extension, $allowedFiles);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $floorPlanName = $uuid . '.' . $extension;
                    $floorPlan->move(public_path('auction/files'), $floorPlanName);
                    $auction->saveMeta('floor_plan', 'auction/files/' . $floorPlanName);
                }
            }
           
            // Picture Upload
            // Video Upload
            if ($request->hasFile('property_video')) {
                $property_video = $request->file('property_video');
                $originalName = $property_video->getClientOriginalName();
                $extension = $property_video->getClientOriginalExtension();
                $videoSize = $property_video->getSize();
                $check = in_array($extension, $allowedVideos);
                if ($check) {
                    $uuid = (string) Str::uuid();
                    $videoName = $uuid . '.' . $extension;
                    $property_video->move(public_path('auction/videos'), $videoName);
                    $property_video = 'auction/videos/' . $videoName;
                }
                $auction->saveMeta('property_video', $property_video);
            }
            // Video Upload
            // Disclosure Upload
            $disclosures = [];
            if ($request->hasFile('disclosures')) {
                foreach ($request->file('disclosures') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileSize = $file->getSize();
                    $check = in_array($extension, $allowedFiles);
                    if ($check) {
                        $uuid = (string) Str::uuid();
                        $fileName = $uuid . '.' . $extension;
                        $file->move(public_path('auction/files'), $fileName);
                        $disclosures[] = 'auction/files/' . $fileName;
                    }
                }
                $auction->saveMeta('disclosures', json_encode($disclosures));
            }
            // File Upload


            // 3 Jul 2023
            // if ($request->hasFile('audio')) {
            //     $audio = $request->audio;
            //     $extension = $audio->getClientOriginalExtension();
            //     $check = in_array($extension, $allowedAudios);
            //     if ($check) {
            //         $uuid = (string) Str::uuid();
            //         $audioName = $uuid . '.' . $extension;
            //         $audio->move(public_path('auction/audios'), $audioName);
            //         $auction->saveMeta('audio', 'auction/audios/' . $audioName);
            //     }
            // }

            DB::commit();
            SellerPropertyAuctionUpdated::dispatch($auction);
            return redirect()->back()->with('success', 'Property listing updated successfully.');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'Unable to update property listing.');
        }
    }

    public function list(Request $request)
    {
        $page_data['title'] = 'Seller\'s Property Auctions';
        $page_data['type'] = $type = $request->type ?? "2";

        $pendingAuctions = PropertyAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'sold' => false]);
        $pendingApprovalAuctions = PropertyAuction::where(['user_id' => Auth::user()->id, 'is_approved' => false, 'sold' => false]);
        $liveAuctions = PropertyAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'sold' => false]);
        $soldAuctions = PropertyAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'sold' => true, 'is_paid' => true]);

        $pendingPaymentAuctions = PropertyAuction::where(['user_id' => Auth::user()->id, 'is_approved' => true, 'sold' => true, 'is_paid' => false]);

        if ($type == "0") {
            $auctions = $pendingAuctions->get();
        } elseif ($type == "1") {
            $auctions = $pendingApprovalAuctions->get();
        } elseif ($type == "2") {
            $auctions = $liveAuctions->get();
        } elseif ($type == '3') {
            $auctions = $soldAuctions->get();
        } elseif ($type == "4") {
            $auctions = $pendingPaymentAuctions->get();
        } else {
            $auctions = $liveAuctions->get();
        }

        $page_data['pendingCount'] = $pendingAuctions->count();
        $page_data['pendingApprovalCount'] = $pendingApprovalAuctions->count();
        $page_data['liveCount'] = $liveAuctions->count();
        $page_data['soldCount'] = $soldAuctions->count();
        $page_data['pendingPaymentCount'] = $pendingPaymentAuctions->count();

        $page_data['auctions'] = $auctions;

        return view('seller_property.list', $page_data);
    }


    public function viewPropertyListing($id, Request $request)
    {

        $data = PropertyAuction::with('meta')->find($id);
        $auction = PropertyAuction::whereId($id)->first();
        $bids = PropertyAuctionBid::with('meta')->where('property_auction_id', $id)->get();
        if (!$auction) {
            // Resource not found, handle the error
            return redirect('/login');
        } else {
            return view('seller_property.view', compact('data', 'auction', 'bids'));
        }
    }

    public function searchListing(Request $request)
    {
        $page_data['title'] = 'Search Property Listings (Sale)';
        $page_data['property_types'] = PropertyType::orderBy('id', 'DESC')->get();
        $page_data['bedrooms'] = Bedroom::all();
        $page_data['bathrooms'] = Bathroom::all();
        $auctions = PropertyAuction::all();
        $auctions = PropertyAuction::selectRaw('*, (SELECT meta_value FROM property_auction_metas WHERE property_auction_metas.property_auction_id = property_auctions.id AND meta_key = "starting_price") as price')->where('sold', false)->where('is_approved', 1);

        if ($request->title != "") {
            $auctions->where('address', 'like', '%' . $request->title . '%');
        }

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
                $sort_type = 'DESC';
            } elseif ($sort == 3) {
                $sort_by = 'created_at';
                $sort_type = 'DESC';
            } elseif ($sort == 4) {
                $sort_by = 'created_at';
                $sort_type = 'DESC';
            } elseif ($sort == 5) {
                $sort_by = 'price';
                $sort_type = 'DESC';
            } elseif ($sort == 6) {
                $sort_by = 'price';
                $sort_type = 'DESC';
            }
            $auctions->orderBy($sort_by, $sort_type);
        } else {
            $auctions->orderBy(DB::raw('id', 'DESC'));
        }

        $auctions_c = $auctions;

        // dd($auctions->toSql());

        $page_data['count'] = $auctions_c->count();
        // dd($page_data['count']);
        $page_data['pAuctions'] = $auctions->paginate(12);
        return view('seller_property.search', $page_data);
    }

    public function renew($id)
    {
        $property_auction = PropertyAuction::whereId($id)->first();
        return view('seller_property.renew', compact('property_auction'));
    }
    public function renew_save(Request $request)
    {
        PropertyAuction::whereId($request->id)->update([
            'listing_date' => $request->listing_date,
            'expiration_date' => $request->expiration_date,
        ]);

        return redirect()->route('myAuctions');
    }
    public function seller_property_partial_view(Request $request)
    {
        $html = (string)view('partial_view.seller_property');
        return response()->json([
            'message' => 200,
            'html' => $html,
        ]);
    }
}
