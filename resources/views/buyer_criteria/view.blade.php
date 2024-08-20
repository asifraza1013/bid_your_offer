@extends('layouts.main')
@push('styles')
  <!-- //Listing Description css  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/listingDescription.css') }}" />
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    ul li {
      padding-left: var(--gutter);
      color: #34465c;
    }

    ul li::marker {
      content: "\f101";
      /* FontAwesome Unicode */
      font-family: FontAwesome;
      font-size: var(--icon-size);
      /* color: #006e9f; */
      color: #11b7cf;
    }

    ul {
      margin: 0;
    }

    .removeBold {
      font-weight: normal;
    }
  </style>
@endpush

@section('content')
  @php
    $auth_id = auth()->user() ? auth()->user()->id : 0;
  @endphp
  <!-- Gallery Start Here  -->
  <div class="container listingDescription">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-8 leftCol">

        <!-- Description Box  -->
        <div class="card description">
          @if (@$auction->description)
            <div class="card-header">
              <h5>Description</h5>
            </div>
          @endif
          <div class="card-body">
            @if (@$auction->description)
              <p>
                {{ @$auction->description }}
              </p>
              <hr>
            @endif
            <h5>Features</h5>
            <div class="row" style="flex-wrap: wrap;">
              @if (@$auction->get->counties != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Counties:
                  @if (gettype(@$auction->get->counties) == 'array')
                    @foreach (@$auction->get->counties as $county)
                      <span class="badge bg-secondary removeBold">{{ $county }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->cities != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Cities:
                  @if (gettype(@$auction->get->cities) == 'array')
                    @foreach (@$auction->get->cities as $city)
                      <span class="badge bg-secondary removeBold">{{ $city }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->states != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> States:
                  @if (gettype(@$auction->get->states) == 'array')
                  @foreach (@$auction->get->states as $city)
                    <span class="badge bg-secondary removeBold">{{ $city }}</span>
                  @endforeach
                @endif
                </div>
              @endif
              @if(@$auction->get->listing_date != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Date :
                  <span class="removeBold">{{ Carbon\Carbon::parse(@$auction->get->listing_date)->format('m-d-Y') }}</span>
                </div>
              @endif
              @if(@$auction->get->expiration_date != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Expiration Date :
                  <span class="removeBold">{{ Carbon\Carbon::parse(@$auction->get->expiration_date)->format('m-d-Y') }}</span> 
                </div>
              @endif
              @if(@$auction->get->service_type != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Service Type:
                  <span class="removeBold">{{ @$auction->get->service_type}}</span> 
                </div>
              @endif
              @if(@$auction->get->representation != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Representation :
                  <span class="removeBold">{{ @$auction->get->representation}}</span> 
                </div>
              @endif
              @if(@$auction->get->titleListing != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title of the listing :
                  <span class="removeBold">{{ @$auction->get->titleListing}}</span> 
                </div>
              @endif
              @if (@$auction->get->max_price != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Maximum Price:
                  <span class="removeBold">{{ @$auction->get->max_price }}</span>
                </div>
              @endif
              @if (@$auction->get->custom_financings != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Custom financing:
                  {{ @$auction->get->custom_financings }}</div>
              @endif
              @if (@$auction->get->property_items != null && @$auction->get->property_type != null)
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i>
                  <span class="fw-bold">Acceptable Property Styles:</span><span
                    class="removeBold">({{ @$auction->get->property_type }}) </span><br>
                  @foreach (@$auction->get->property_items as $item)
                    <span class="badge bg-secondary removeBold">{{ $item }}</span>
                  @endforeach
                </div>
              @endif
              @if (@$auction->get->contingencies != null && @$auction->get->contingencies != 'null')
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i>
                  <span class="fw-bold">Acceptable Property Conditions:</span><br>
                  @php
                    $elementToIgnore = 'Other';
                    $originalArray = $auction->get->contingencies;
                    $index = array_search($elementToIgnore, $originalArray);
                    if ($index !== false) {
                        array_splice($originalArray, $index, 1);
                    }
                  @endphp
                  @foreach (@$originalArray as $item)
                    <span class="badge bg-secondary removeBold">{{ $item }}</span>
                  @endforeach
                  @php $exists = in_array('Other', $auction->get->contingencies); @endphp
                  @if ($exists)
                    <span class="badge bg-secondary removeBold"> {{ @$auction->get->contingenciesOffered }}</span>
                  @endif
                </div>
              @endif
              @if (@$auction->get->real_estate_included != null)
                <div class="col-md-12
                      col-12 removeBold"><i
                    class="fa-regular fa-check-square"></i><span class="fw-bold">
                      Real Estate Included:</span>
                  {{ @$auction->get->real_estate_included }}
                </div>
              @endif
              @if(@$auction->get->lincenses != null)
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i><span class="fw-bold">
                      Licenses Needed:</span>
                      @if (is_array($auction->get->lincenses))
                          @foreach ($auction->get->lincenses as $item)
                              @if ($item == 'Other')
                                  @continue
                              @else
                              <span class="badge bg-secondary">{{ $item }}</span>
                              @endif
                          @endforeach
                      @endif
                </div>
              @endif
              @if (@$auction->get->petOptions != null)
                <div class="col-md-12
                      col-12 removeBold"><i
                    class="fa-regular fa-check-square"></i><span class="fw-bold">
                    Pets:</span>
                  {{ @$auction->get->petOptions }}
                </div>
              @endif
             
              @if (@$auction->get->petsNumber != null)
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i><span class="fw-bold">
                    Number of Pet(s):</span>
                  {{ @$auction->get->petsNumber }}
                </div>
              @endif
              @if (@$auction->get->petsType != null)
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i><span class="fw-bold">
                    Type of Pet(s):</span>
                  {{ @$auction->get->petsType }}
                </div>
              @endif
              @if (@$auction->get->petsWeight != null)
                <div class="col-md-12 col-12 removeBold"><i class="fa-regular fa-check-square"></i><span class="fw-bold">
                    Weight of Pet(s):</span>
                  {{ @$auction->get->petsWeight }}
                </div>
              @endif
              @if (@$auction->get->prop_conditions != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Acceptable Property
                  Conditions:
                  @if (gettype(@$auction->get->prop_conditions) == 'array')
                    @foreach (@$auction->get->prop_conditions as $item)
                      <span class="badge bg-secondary">{{ $item }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->special_sales != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Acceptable Sales
                  Provisions:<br>
                  @if (gettype(@$auction->get->special_sales) == 'array')
                    @foreach (@$auction->get->special_sales as $item)
                      <span class="badge bg-secondary removeBold">{{ $item }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->custom_bedrooms != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Bedrooms
                  Needed:
                  {{ @$auction->get->custom_bedrooms == '' ? @$auction->get->bedrooms : @$auction->get->custom_bedrooms }}
                </div>
              @endif
              @if (@$auction->get->bathrooms != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Bathrooms
                  Needed:
                  <span class="removeBold">{{@$auction->get->bathrooms?@$auction->get->bathrooms :@$auction->get->custom_bathrooms}}</span>
                </div>
              @endif
              @if (@$auction->get->min_sqft != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Sqft Needed:
                  <span class="removeBold"> {{ @$auction->get->min_sqft }}</span>
                </div>
              @endif
              @if (@$auction->get->minimum_total_acreage_needed != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Total Acreage Needed:
                  <span class="removeBold"> {{ @$auction->get->minimum_total_acreage_needed }}</span>
                </div>
              @endif
              @if (@$auction->get->garage != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Garage/Parking Features Needed:
                  <span class="removeBold">
                    @if(@$auction->get->garage != 'Yes')
                    {{ @$auction->get->garage }}
                    @elseif(gettype(@$auction->get->garage) == 'array')
                    @foreach (@$auction->get->garage as $item)
                      @if($item !='Other')
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @else
                          <span class="badge bg-secondary removeBold">{{ @$auction->get->garageNeedOther }}</span>
                      @endif
                      @endforeach
                    @endif
                  </span>
                </div>
              @endif
              @if (@$auction->get->escrow_amount_percent != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Offered Escrow
                  Amount(% or $): {{ @$auction->get->escrow_amount_percent }}</div>
              @endif
              @if (@$auction->get->inspection != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Inspection Period
                  Offered: {{ @$auction->get->inspection }}</div>
              @endif
              @if (@$auction->get->request_seller_premium != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Requested seller
                  credit at closing (seller's premium): {{ @$auction->get->request_seller_premium }}</div>
              @endif
              @if (@$auction->get->request_buyer_premium != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Requested Buyer
                  Credit Seller at closing (Buyer’s Premium): {{ @$auction->get->request_buyer_premium }}
                </div>
              @endif
              @if (@$auction->get->pool != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pool Needed:
                  <span class="removeBold">{{ @$auction->get->pool }}</span>
                </div>
              @endif
              @if (@$auction->get->carport != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Carport Needed?
                  <span class="removeBold">{{ @$auction->get->carport }}</span>
                </div>
              @endif
              @if (@$auction->get->garage_spaces != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Garage Spaces Needed:
                  {{ @$auction->get->garage_spaces }}</div>
              @endif
              @if (@$auction->get->parking_spaces_needed != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Parking spaces
                  needed? {{ @$auction->get->parking_spaces_needed }}</div>
              @endif
              <div>
                @if (@$auction->get->has_water_view != null && @$auction->get->has_water_view != 'null')
                  <div class="col-md-9 fw-bold">
                    <i class="fa-regular fa-check-square"></i> Water view:<span class="removeBold">({{@$auction->get->has_water_view}})</span><br>
                    @if (gettype(@$auction->get->water_view) == 'array' && @$auction->get->has_water_view !='No')
                      @foreach (@$auction->get->water_view as $item)
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->has_water_extra != null && @$auction->get->has_water_extra != 'null')
                  <div class="col-md-9 fw-bold">
                    <i class="fa-regular fa-check-square"></i> Water Extras:<span class="removeBold">({{@$auction->get->has_water_extra}})</span><br>
                    @if (gettype(@$auction->get->has_water_extra) == 'array' && @$auction->get->has_water_extra !='No')
                      @foreach (@$auction->get->has_water_extra as $item)
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->has_water_frontage != null && @$auction->get->has_water_frontage != 'null')
                <div class="col-md-9 fw-bold">
                  <i class="fa-regular fa-check-square"></i> Water Frontage:<span class="removeBold">({{@$auction->get->has_water_frontage}})</span><br>
                  @if (gettype(@$auction->get->water_frontage) == 'array' && @$auction->get->water_frontage !='No')
                    @foreach (@$auction->get->water_frontage as $item)
                      <span class="badge bg-secondary removeBold">{{ $item }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
                @if (@$auction->get->has_water_access != null && @$auction->get->has_water_access != 'null')
                <div class="col-md-9 fw-bold">
                  <i class="fa-regular fa-check-square"></i> Water Access:<span class="removeBold">({{@$auction->get->has_water_access}})</span><br>
                  @if (gettype(@$auction->get->water_access) == 'array' && @$auction->get->water_access !='No')
                    @foreach (@$auction->get->water_access as $item)
                      <span class="badge bg-secondary removeBold">{{ $item }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
                @if (@$auction->get->viewOptions != null && @$auction->get->viewOptions != 'null')
                <div class="col-md-9 fw-bold">
                  <i class="fa-regular fa-check-square"></i> View Preference:<span class="removeBold">({{@$auction->get->viewOptions}})</span><br>
                  @if (gettype(@$auction->get->view) == 'array' && @$auction->get->view !='No')
                    @foreach (@$auction->get->view as $item)
                      @if($item !='Other')
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @else
                        <span class="badge bg-secondary removeBold">{{ @$auction->get->viewOther }}</span>
                      @endif
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->nonNegotiableFactors != null && @$auction->get->nonNegotiableFactors != 'null')
                <div class="col-md-9 fw-bold">
                  <i class="fa-regular fa-check-square"></i> Non-negotiable Amenities or Property Features:<span class="removeBold">({{@$auction->get->nonNegotiableFactors}})</span><br>
                  @if (gettype(@$auction->get->nonNegotiable) == 'array' && @$auction->get->nonNegotiableFactors !='No')
                    @foreach (@$auction->get->nonNegotiable as $item)
                      @if($item !='Other')
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @else
                        <span class="badge bg-secondary removeBold">{{ @$auction->get->negotiableOther }}</span>
                      @endif
                    @endforeach
                  @endif
                </div>
              @endif
              </div>
              @if (@$auction->get->have_air_conditioning != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Air Conditioning Preferences and Heating and Fuel Preferences:</span>
                    @if (@$auction->get->have_air_conditioning == 'Yes')
                      <br>
                      <span class="badge bg-secondary removeBold">{{ @$auction->get->air_conditioning }}</span>
                      <span class="badge bg-secondary removeBold">{{ @$auction->get->heating_and_fuel }}</span>
                    @else
                      <span class="removeBold">{{ @$auction->get->have_air_conditioning }}</span>
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->financings != '' && @$auction->get->financings != null && @$auction->get->financings != 'null')
                @php
                  $financingData = @$auction->get->financings;
                @endphp
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Acceptable Financing/Currency:</span>
                    @if ($financingData != null)
                      @foreach (array_filter($financingData) as $key => $item)
                        <ul>
                          <li style="font-size: 16px; margin-top:5px;">&nbsp; {{ $item }}</li>
                        </ul>
                        @if ($item == 'Seller Financing')
                          @foreach (@$auction->get->sellerFinancing as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach
                        {{-- @elseif ($item == 'Assumable')
                          @foreach (@$auction->get->assumable as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach --}}
                        @elseif ($item == 'Exchange/Trade')
                          @foreach (@$auction->get->trade as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach
                        @elseif ($item == 'Lease Option' || $item == 'Lease Purchase')
                          @foreach (@$auction->get->leaseOptions as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'Cryptocurrency')
                          @foreach (@$auction->get->cryptocurrency as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'NFT')
                          @foreach (array_filter(@$auction->get->nft) as $key => $item)
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'Prepayment Penalty')
                          @if (@$auction->get->prepayment == 'Yes')
                            @foreach (@$auction->get->prepaymentOther as $key => $item)
                              <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                                {{ @$item }}</span>
                            @endforeach
                          @else
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$auction->get->prepayment }}</span>
                          @endif
                        @elseif($item == 'Balloon Payment')
                          @if (@$auction->get->balloon == 'Yes')
                            @foreach (@$auction->get->balloonpyment as $key => $item)
                              <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                                {{ @$item }}</span>
                            @endforeach
                          @else
                            <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                              {{ @$auction->get->balloon }}</span>
                          @endif
                        @elseif($item == 'Other')
                          <span class="d-inline-block bg-secondary removeBold text-white  px-2 rounded my-1">
                            {{ @$auction->get->type_of_financing }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->communitiesOption != null)
                @if (@$auction->get->communitiesOption == 'Yes')
                  <div class="row">
                    <div class="col-md-12">
                      <i class="fa-regular fa-check-square"></i>
                      <span class="fw-bold">Buyer Eligibility/Interest in Purchasing in 55-and- Over Communities:</span><br><span class="removeBold">{{ @$auction->get->communities }}</span>
                    </div>
                  </div>
                @else
                  <div class="row">
                    <div class="col-md-12">
                      <i class="fa-regular fa-check-square"></i><span class="fw-bold">Buyer Eligibility/Interest in
                        Purchasing in 55-and- Over Communities:</span>{{ @$auction->get->communitiesOption }}
                    </div>
                  </div>
                @endif
              @endif
          
              @if (@$auction->get->hoa_community != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> HOA/Community
                  Association: {{ @$auction->get->hoa_community }} </div>
              @endif
              @if (@$auction->get->hoa_fee_requirement != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> HOA Fee Requirement:
                  {{ @$auction->get->hoa_fee_requirement }} </div>
              @endif
              @if (@$auction->get->hoa_fee != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Maximum HOA fee
                  (Monthly rate): ${{ number_format(@$auction->get->hoa_fee) }} </div>
              @endif
              @if (@$auction->get->condo_fee != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Maximum Condo fee
                  (Monthly rate): ${{ number_format(@$auction->get->condo_fee) }} </div>
              @endif
              @if (@$auction->get->old_persons_community != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> 55+ over community:
                  {{ @$auction->get->old_persons_community }} </div>
              @endif
              @if (@$auction->get->pets_allowed != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Pets allowed:
                  {{ @$auction->get->pets_allowed }} </div>
              @endif
              @if (@$auction->get->number_of_pets != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> How many pets does
                  the Buyer have? {{ @$auction->get->number_of_pets }} </div>
              @endif
              @if (@$auction->get->pet_bread != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> What is the breed?
                  {{ @$auction->get->pet_bread }} </div>
              @endif
              @if (@$auction->get->pet_weight != null)
                <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> What is the weight?
                  {{ @$auction->get->pet_weight }} </div>
              @endif

              <hr>
              <h4>Invstment Information</h4>
              <div class="row" style="flex-wrap: wrap;">
                @if (@$auction->get->rental_requirements != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Rental
                    Requirements:<br>
                    {{ @$auction->get->rental_requirements }}
                  </div>
                @endif
                @if (@$auction->get->total_units_needed != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Total Number of
                    Units Needed: {{ @$auction->get->total_units_needed }} </div>
                @endif
                @if (@$auction->get->annual_income != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Annual Net Income
                    Minimum: ${{ @$auction->get->annual_income }} </div>
                @endif
                @if (@$auction->get->min_cap_rate != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Minimum Cap Rate:
                    ${{ @$auction->get->min_cap_rate }} </div>
                @endif
                @if (@$auction->get->additional_details != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Any additional
                    details:{{ @$auction->get->additional_details }}
                  </div>
                @endif
                @if (@$auction->get->arv != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> ARV:
                    {{ @$auction->get->arv }} </div>
                @endif
              </div>
              {{-- <hr>
              <h4>Offered Title Company:</h4>
              <div class="row" style="flex-wrap: wrap;">
                @if (@$auction->get->title_company != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title Company:
                    {{ @$auction->get->title_company }} </div>
                @endif
                @if (@$auction->get->title_agent != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title Agent:
                    {{ @$auction->get->title_agent }} </div>
                @endif
                @if (@$auction->get->title_company_phone != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title Company
                    Phone #: {{ @$auction->get->title_company_phone }} </div>
                @endif
                @if (@$auction->get->title_company_email != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title Company
                    Email: {{ @$auction->get->title_company_email }} </div>
                @endif

              </div>
              <div class="row" style="flex-wrap: wrap;">
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Days needed to
                  Close: {{ @$auction->get->closing_days }} </div>
              </div>
            </div> --}}

              <hr>
              <h4>Description</h4>
              @if (@$auction->get->description_buyer_specific != null)
                <div class="row">
                  <div class="col-md-12"> {{ @$auction->get->description_buyer_specific }}
                  </div>
                </div>
              @endif
              <hr>
              <h4>Buyer/Buyer’s Agent Info</h4>
              <div class="row" style="flex-wrap: wrap;">
                @if (@$auction->get->agent_first_name != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> First Name:
                    <span class="removeBold"> {{ @$auction->get->agent_first_name }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_last_name != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Last Name:
                    <span class="removeBold"> {{ @$auction->get->agent_last_name }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_email != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Email:
                    <span class="removeBold"> {{ @$auction->get->agent_email }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_phone != null)
                  <div class="col-md-12 col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Phone:
                    <span class="removeBold"> {{ @$auction->get->agent_phone }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_brokerage != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Brokerage:
                    <span class="removeBold">{{ @$auction->get->agent_brokerage }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_license_no != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> License No.:
                    <span class="removeBold">{{ @$auction->get->agent_license_no }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_mls_id != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> NAR Member ID (NRDS
                    ID):
                    <span class="removeBold">{{ @$auction->get->agent_mls_id }}</span>
                  </div>
                @endif
                @if (@$auction->get->agent_commission_percent != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Agent
                    Commission:
                    <span class="removeBold"> {{ @$auction->get->agent_commission_percent }}</span>
                  </div>
                @endif
              </div>
              <div class="row">
                @if (!@$auction->get && $auction->get->video != null)
                  <div class="col-md-6 col-6 pt-2 fw-bold">Video:
                    <span class="removeBold">
                      <video src="{{ asset($auction->get->video) }}" style="width:100%;height:29vh;"
                          controls autoplay></video>

                      </span>
                  </div>
                @endif
                @if (!@$auction->get && $auction->get->photo != null)
                  <div class="col-md-6 col-6 pt-2 fw-bold">Photo:
                    <span class="removeBold">
                      <img src="{{ asset($auction->get->photo) }}" style="width:100%;height:29vh;" />
                    </span>
                  </div>
                @endif
            </div>
          </div>
        </div>
      </div>
        <div class="card review">
          <div class="card-body d-flex align-items-center">
            <div class="left d-flex align-items-center">
              <img class="w-25" src="https://ppt1080.b-cdn.net/images/avatar/none.png" alt="">
              <div>
                <p class="mb-0"><a href="{{ route('author', [@$auction->user_id]) }}"><b>User
                      Details</b></a><span></span>
                  <span class="start opacity-50">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                </p>
                <p class="mb-0">...</p>
                <p class="mb-0 opacity-50">{{ @$auction->user->name }} • last online 5 days ago.</p>
              </div>
            </div>
            <div class="right text-center">
              <a href="{{ route('author', [@$auction->user_id]) }}"><button class="btn">Message</button></a>
              <a href="{{ route('author', [@$auction->user_id]) }}"><button class="btn">View
                  Profile</button></a>

            </div>
          </div>
        </div>
        <!-- End  -->
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 rightCol">
        <h1>{{ @$auction->get->property_type }}</h1>
        <hr>
        @inject('carbon', 'Carbon\Carbon')
        @php
          if (@$auction->auction_length > 0) {
              $start = $carbon::now();
              $end = $carbon::parse(@$auction->created_at)->addDays(@$auction->auction_length);
              $diff = $end->diffInDays($start);
          }
        @endphp
        @if (@$auction->auction_length > 0)
          @php
            $diff_d = $diff;
            $diff_H = $start->diff($end)->format('%H');
            $diff_I = $start->diff($end)->format('%I');
            $diff_S = $start->diff($end)->format('%S');
          @endphp
          <div class="time d-flex justify-content-between text-center flex-wrap pb-2">
            <div>
              <h5><b class="timer-d"> {{ $diff_d }} </b></h5>
              <h6 class="opacity-50">Days</h6>
            </div>
            <div>
              <h5><b class="timer-h"> {{ $diff_H }} </b></h5>
              <h6 class="opacity-50">Hrs</h6>
            </div>
            <div>
              <h5><b class="timer-m"> {{ $diff_I }} </b></h5>
              <h6 class="opacity-50">Mins</h6>
            </div>
            <div>
              <h5><b class="timer-s"> {{ $diff_S }} </b></h5>
              <h6 class="opacity-50">Secs</h6>
            </div>
          </div>
        @endif
        @php
          $lowest_bid_price = @$auction->bids->min('price') ?? @$auction->max_price;
          $lowest_bidder = @$auction->bids->where('price', $lowest_bid_price)->first();
          $my_bid = @$auction->bids->where('user_id', $auth_id)->first();
        @endphp
        @if (@$auction->user_id != $auth_id)
          <a href="{{ route('auction-chat', ['buyer-criteria', $auction->id]) }}" class="btn btn-success w-100 mb-2">
            <i class="fa-solid fa-paper-plane"></i> Send Message</a>
        @endif
        @if ($auth_id)
          @if (in_array(auth()->user()->user_type, ['seller', 'agent']))
            <button class="btn w-100"
              onclick="javascript:window.location='{{ route('criteria.auction.bid', @$auction->id) }}';"
              {{ @$auction->user_id == $auth_id ? 'disabled' : '' }}>
              <span class="bid">Bid Now </span>
              <span class="badge bg-light float-end text-dark">{{ @$auction->get->max_price }}</span>
              @if (@$auction->sold)
                <span class="badge bg-danger">Sold</span>
              @endif
              {{-- {{$res}} --}}
            </button>
          @endif
        @else
          <a href="{{ route('login') }}">
            <button class="btn w-100">
              <span class="bid">Login for Bid </span>
              <span class="badge bg-light float-end text-dark">${{ $lowest_bid_price }}</span>
            </button>
          </a>
        @endif
        <!-- Highest Bider -->
        <div class="card higestBider">
          <div class="card-body">
            @if ($lowest_bidder)
              <p><b>{{ $lowest_bidder->user->name ?? '' }}</b> is the lowest bidder.</p>
            @else
              <p>No one has bid on this auction.</p>
            @endif
            <div class="accordion" id="accordionExample">
              <div class="accordion-item border-0">
                @foreach (@$auction->bids as $bid)
                  <!-- Item loop -->
                  <div class="accordion" type="button" data-bs-toggle="collapse"
                    data-bs-target="#item{{ $bid->id }}" aria-expanded="true"
                    aria-controls="item{{ $bid->id }}">
                    <div class="d-flex small accordion mr-0 text-center">
                      <div class="col-1">
                        <span class="badge">{{ $loop->iteration }}</span>
                      </div>
                      <div class="col-4">
                        {{ $bid->user->name }} </div>
                      <div class="col-4 text-right">
                        {{ $bid->get->max_price }} </div>
                      <div class="col-2">
                        Terms↓
                      </div>
                    </div>
                  </div>
                  <div id="item{{ $bid->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">

                    <div class="accordion-body">
                      <div id="bidding_history_data">
                        <div>
                          {{-- <p class="d-flex justify-content-between small">Cash or Financing Type:
                                                        <span>{{ $bid->financing->name }}</span>
                                                    </p> --}}
                          @if ($bid->get->max_price != '')
                            <p class="d-flex justify-content-between small">Price:
                              <span>{{ $bid->get->max_price }}</span>
                            </p>
                          @endif
                          @if ($bid->get->financing != '')
                            <p class="d-flex justify-content-between small">
                              Acceptable Currency/Financing:
                              @if (gettype($bid->get->financing) == 'array')
                                <div>
                                  @foreach ($bid->get->financing as $item)
                                    <span class="badge bg-secondary">{{ $item }}</span>
                                  @endforeach
                                </div>
                              @endif
                            </p>
                          @endif
                          @if ($bid->get->property_type != '')
                            <p class="d-flex justify-content-between small">Property Type:
                              <span>{{ $bid->get->property_type }}</span>
                            </p>
                          @endif

                          @if ($bid->get->prop_conditions != '')
                            <p class="d-flex justify-content-between small">
                              Property Condition:
                              @if (gettype($bid->get->prop_conditions) == 'array')
                                <div style="overflow: hidden;">
                                  @foreach ($bid->get->prop_conditions as $item)
                                    <span class="badge bg-secondary">{{ $item }}</span>
                                  @endforeach
                                </div>
                              @endif
                            </p>
                          @endif

                          @if ($bid->get->special_sales != '')
                            <p class="d-flex justify-content-between small">
                              Special Sale Provision:
                              @if (gettype($bid->get->special_sales) == 'array')
                                <div>
                                  @foreach ($bid->get->special_sales as $item)
                                    <span class="badge bg-secondary">{{ $item }}</span>
                                  @endforeach
                                </div>
                              @endif
                            </p>
                          @endif
                          @if ($bid->get->bedrooms != '')
                            <p class="d-flex justify-content-between small">Bedrooms:
                              <span>{{ $bid->get->custom_bedrooms == '' ? $bid->get->bedrooms : $bid->get->custom_bedrooms }}</span>
                            </p>
                          @endif
                          @if ($bid->get->bathrooms != '')
                            <p class="d-flex justify-content-between small">Bathrooms:
                              <span>{{ $bid->get->custom_bathrooms == '' ? $bid->get->bathrooms : $bid->get->custom_bathrooms }}</span>
                            </p>
                          @endif
                          @if ($bid->get->county != '')
                            <p class="d-flex justify-content-between small">County:
                              <span>{{ $bid->get->county }}</span>
                            </p>
                          @endif
                          @if ($bid->get->min_sqft != '')
                            <p class="d-flex justify-content-between small">Heated Sqft:
                              <span>{{ $bid->get->min_sqft }}</span>
                            </p>
                          @endif
                          {{-- @if ($bid->get->escrow_amount_percent != '')
                            <p class="d-flex justify-content-between small">Escrow Amount:$ or
                              %
                              <span>{{ $bid->get->escrow_amount_percent }}</span>
                            </p>
                          @endif --}}
                          {{-- @dd($bid->get) --}}
                          @if ($bid->get->inspection != '')
                            <p class="d-flex justify-content-between small">Inspection Period
                              Offered:
                              <span>{{ $bid->get->inspection }}</span>
                            </p>
                          @endif

                          @if ($bid->get->contingency != '')
                            <p class="d-flex justify-content-between small">Contingencies:
                              <span>{{ $bid->get->contingency }}</span>
                            </p>
                          @endif

                          {{-- @if ($bid->get->request_seller_premium != '')
                            <p class="d-flex justify-content-between small">Requested Seller's
                              Credit:
                              <span>{{ $bid->get->request_seller_premium }}</span>
                            </p>
                          @endif --}}

                          {{-- @if ($bid->get->request_buyer_premium != '')
                            <p class="d-flex justify-content-between small">Offered Buyer’s
                              Credit:
                              <span>{{ $bid->get->request_buyer_premium }}</span>
                            </p>
                          @endif --}}

                          @if ($bid->get->description != '')
                            <p class="d-flex justify-content-between small">Description and
                              additional details:
                              <span>{{ $bid->get->description }}</span>
                            </p>
                          @endif

                          @if ($bid->get->lot_size != '')
                            <p class="d-flex justify-content-between small">Lot Size:
                              <span>{{ $bid->get->lot_size }}</span>
                            </p>
                          @endif

                          @if ($bid->get->flood_insurance != '')
                            <p class="d-flex justify-content-between small">Is flood insurance
                              required?
                              <span>{{ $bid->get->flood_insurance }}</span>
                            </p>
                          @endif

                          @if ($bid->get->agent_commission_percent != '')
                            <p class="d-flex justify-content-between small">Commission Offered
                              to Buyer's Agent: %
                              <span>{{ $bid->get->agent_commission_percent }}</span>
                            </p>
                          @endif


                          {{-- @if ($bid->get->is_commercial == 'Yes')
                            <h5>Commercial Property Information:</h5>
                            @if ($bid->get->total_units != '')
                                <p class="d-flex justify-content-between small">Total Number of
                                    Units:
                                    <span>{{ $bid->get->total_units }}</span>
                                </p>
                            @endif

                            @if ($bid->get->unit_sizes != '')
                                <p class="d-flex justify-content-between small">Unit sizes:
                                    <span>{{ $bid->get->unit_sizes }}</span>
                                </p>
                            @endif

                            @if ($bid->get->annual_income != '')
                                <p class="d-flex justify-content-between small">Annual Net
                                    Income:
                                    <span>{{ $bid->get->annual_income }}</span>
                                </p>
                            @endif

                            @if ($bid->get->cap_rate != '')
                                <p class="d-flex justify-content-between small">Cap Rate:
                                    <span>{{ $bid->get->cap_rate }}</span>
                                </p>
                            @endif

                            @if ($bid->get->known_repairs != '')
                                <p class="d-flex justify-content-between small">Known Repairs
                                    that
                                    need to be done:
                                    <span>{{ $bid->get->known_repairs }}</span>
                                </p>
                            @endif

                            @if ($bid->get->arv != '')
                                <p class="d-flex justify-content-between small">ARV:
                                    <span>{{ $bid->get->arv }}</span>
                                </p>
                            @endif

                            @if ($bid->get->tenant_pays != '')
                                <p class="d-flex justify-content-between small">
                                    Tenant Pays:
                                    @if (gettype($bid->get->tenant_pays) == 'array')
                                        <div>
                                            @foreach ($bid->get->tenant_pays as $item)
                                                <span
                                                    class="badge bg-secondary">{{ $item }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </p>
                            @endif

                            @if ($bid->get->landlord_pays != '')
                                <p class="d-flex justify-content-between small">
                                    Landlord Pays:
                                    @if (gettype($bid->get->landlord_pays) == 'array')
                                        <div>
                                            @foreach ($bid->get->landlord_pays as $item)
                                                <span
                                                    class="badge bg-secondary">{{ $item }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </p>
                            @endif

                            <hr>
                        @endif --}}



                          @if (@$auction->user_id == $auth_id)
                            @if (@$bid->get->video_url != '')
                              <p>
                                <a href="{{ @$bid->get->video_url }}" class="btn btn-sm btn-primary"
                                  target="_blank">View
                                  Video</a>
                              </p>
                            @endif

                            @if (@$bid->get->note != '')
                              <p>
                                <a href="{{ url(@$bid->get->note) }}" class="btn btn-sm btn-primary"
                                  target="_blank">Proof
                                  of funds/pre-approval letter</a>
                              </p>
                            @endif

                            @if (@$bid->get->card != '')
                              <p>
                                <a href="{{ asset(@$bid->get->card) }}" target="_blank">
                                  <img src="{{ asset(@$bid->get->card) }}" alt="" style="width: 150px;"></a>
                              </p>
                            @endif

                            @if (@$bid->get->audio != '')
                              <p>
                                <audio class="audio-fluid" controls style="width: 100%;">
                                  <source src="{{ asset(@$bid->get->audio) }}" type="audio/mp3">
                                  Your browser does not support the audio tag.
                                </audio>
                              </p>
                            @endif
                          @endif




                          @if (@$auction->user_id == $auth_id)
                            @if (!@$auction->is_sold)
                              <form action="{{ route('acceptBCABid') }}" method="post">
                                @csrf
                                <input type="hidden" name="auction_id" value="{{ @$auction->id }}">
                                <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                <div style="text-align: right;">
                                  <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                </div>
                              </form>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End  -->
                @endforeach

              </div>

            </div>
          </div>
        </div>
        <button class="btn w-100 mt-0">
          <span class="bid m-0"><i class="fa fa-user"></i> </span>
        </button>
        <!-- End  -->
        <!-- Social Details  -->
        <div class="p-4 card">
          <p class="text-600">Share this link via</p>
          <div class="qr-code" style="width: 100%; height:200px;">
            {{ qr_code(route('buyer.criteria.view', @$auction->id), 200) }}
          </div>
          <div class="card-social">
            <ul class="icons">
              <a href="">
                <i class="fab fa-facebook-f"></i>
              </a>

              <a href="">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="">
                <i class="fab fa-pinterest"></i>
              </a>
              <a href="">
                <i class="fab fa-linkedin"></i>
              </a>
            </ul>
            <p class="small opacity-8">Or copy link</p>
            <div class="field">
              <i class="fa fa-link"></i>
              <input type="text" readonly="" id="copylink"
                value="https://bidyouroffer.com/listing/534-pinellas-bayway-s-204-tierra-verde-fl-33715-4/">
              <button class="btn-primary btn-sm text-600 js-copy-link text-center border-0"
                style="min-width:60px;">Copy</button>
            </div>

          </div>
        </div>
        <!-- End  -->
      </div>
    </div>
  </div>
  <hr>
  <!-- Recommmended Section  -->
  <div class="container buyerOfferContentDetails">
    <h3 class="text-600 mb-4">Recommended For You</h3>
    <div class="cardsDetails row  justify-content-start">
      <!-- Card 1 -->
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card ">
          <img src="https://bidyouroffer.com/wp-content/uploads/2022/10/165522238955562a8b07535346697508007-300x200.jpg"
            class="card-img-top" alt="...">
          <div class="card-body pb-2 pt-2">
            <h5 class="card-title"><a href="">1199 Randall Way, Brownsburg, IN 46112 </a></h5>
            <div class="houseDetails mb-1">
              <span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/bed-front.svg') }}" alt="bed icon" width="15"><b>
                    4</b></span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/bath.svg') }}" alt="bed icon" width="15"><b>
                    2</b></span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/ruler-triangle.svg') }}" alt="bed icon"
                    width="15"><b> 1,643 </b>Sq Ft</span>
              </span>
              - House for sale
            </div>
            <p class="card-text mb-1"><span class="badge bg-secondary">land/lots</span> <span
                class="float-end"><span><b>MLS ID</b></span> <span>#12345</span></span></p>
            <p class="m-0"><svg xmlns="http://www.w3.org/2000/svg" class="clock" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg><b>28d 03:15:29</b></p>
          </div>
          <div class="card-footer bg-light">
            <div class="row">
              <div class="col-6 left">
                <!-- Barcode  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Scan Qr Code" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                  </path>
                </svg>
                <!-- <div hidden class="w-50">
                                                                                                                                                                                                                                                                                                  <div id="qr-content" class="text-center w-75 m-auto">
                                                                                                                                                                                                                                                                                                      <img class="w-50" src="https://www.freepnglogos.com/uploads/qr-code-png/qr-code-file-bangla-mobile-code-0.png" alt="">
                                                                                                                                                                                                                                                                                                      <p>Scan QR code to view on mobile device.</p>
                                                                                                                                                                                                                                                                                                  </div>
                                                                                                                                                                                                                                                                                                  </div> -->
                <!-- Message  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Send Message" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                  </path>
                </svg>
                <!-- FAvourite  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Add Favorites" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                  </path>
                </svg>
              </div>
              <div class="col-6 right text-end">
                <b>$1,000</b>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card ">
          <img src="https://bidyouroffer.com/wp-content/uploads/2022/10/165522238955562a8b07535346697508007-300x200.jpg"
            class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><a href="">1199 Randall Way, Brownsburg, IN 46112 </a></h5>
            <div class="houseDetails">
              <span>
                <span><b>4</b> bds</span>
                <span><b>2</b> ba</span>
                <span><b>1,643</b> sqft</span>
              </span>
              - House for sale
            </div>
            <p class="card-text"><span class="badge bg-secondary">land/lots</span> <span class="float-end"><span><b>MLS
                    ID</b></span> <span>#12345</span></span></p>
          </div>
          <div class="card-footer bg-light">
            <div class="row">
              <div class="col-6 left">
                <!-- Barcode  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Scan Qr Code" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                  </path>
                </svg>
                <!-- Message  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Send Message" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                  </path>
                </svg>
                <!-- FAvourite  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Add Favorites" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                  </path>
                </svg>
              </div>
              <div class="col-6 right text-end">
                <b>$1,000</b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  {{-- <script src="{{asset('assets/bootstrap-5.2.2/js/twitter-bootstrap.min.js')}}"></script> --}}
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.9.0/timer.jquery.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  @if (@$auction->auction_length > 0)
    <script>
      var durations = '{{ $diff_d }}d{{ $diff_H }}h{{ $diff_I }}m{{ $diff_S }}s';
      $('.timer-d').timer({
        countdown: true,
        duration: durations,
        format: '%d'
      });
      $('.timer-h').timer({
        countdown: true,
        duration: durations,
        format: '%h'
      });
      $('.timer-m').timer({
        countdown: true,
        duration: durations,
        format: '%m'
      });
      $('.timer-s').timer({
        countdown: true,
        duration: durations,
        format: '%s'
      });
    </script>
  @endif
  <script>
    function changeListed(val) {
      if (val == "Yes") {
        // alert("Yes");
        $('.listing_photos').addClass('d-none');
        $('.listing_link').removeClass('d-none');
      } else {
        // alert("No");
        $('.listing_link').addClass('d-none');
        $('.listing_photos').removeClass('d-none');
      }
    }
  </script>
  <script>
    $(function() {
      var multipleCancelButton = new Choices('.multiple', {
        removeItemButton: true,
        // maxItemCount:5,
        // searchResultLimit: 5,
        // renderChoiceLimit: 5
      });
    });
  </script>
@endpush
