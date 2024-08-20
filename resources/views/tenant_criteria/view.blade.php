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

    .removeBold {
      font-weight: normal;
    }

    #bidding_history_data p {

      flex-wrap: wrap;
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
          @if (@$auction->get->description)
            <div class="card-header">
              <h5>Description</h5>
            </div>
          @endif
          <div class="card-body">
            @if (@$auction->get->description)
              <p>
                {{ @$auction->get->description }}
              </p>
              <hr>
            @endif
            <h4>Features</h4>
            <div class="row" style="flex-wrap: wrap;">
              @if (@$auction->get->cities != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>City:</strong>
                  @foreach (@$auction->get->cities as $item)
                    <span class="bg-secondary text-white rounded d-inline-block px-2 my-1"> {{ $item }}</span>
                  @endforeach
                </div>
              @endif
              @if (@$auction->get->counties != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>County:</strong>
                  @foreach (@$auction->get->counties as $item)
                    <span class="bg-secondary text-white rounded d-inline-block px-2 my-1"> {{ $item }}</span>
                  @endforeach
                </div>
              @endif
              @if (@$auction->get->state != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>State:</strong>
                  @foreach (@$auction->get->state as $item)
                    <span class="bg-secondary text-white rounded d-inline-block px-2 my-1"> {{ $item }}</span>
                  @endforeach
                </div>
              @endif
              @if (@$auction->get->listing_date != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Listing
                    Date:</strong> {{ @$auction->get->listing_date }}</div>
              @endif
              @if (@$auction->get->expiration_date != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Expiration
                    Date:</strong> {{ @$auction->get->expiration_date }}</div>
              @endif
              @if (@$auction->get->listingType != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Listing Service Type: </strong> {{ @$auction->get->listingType }}</div>
              @endif
              @if (@$auction->get->representation != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Representation: </strong> {{ @$auction->get->representation }}</div>
              @endif
              @if (@$auction->get->titleListing != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Title of Listing:
                  </strong> {{ @$auction->get->titleListing }}</div>
              @endif
              @if (@$auction->get->property_type != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Interested Property Style:<span
                        class="removeBold">({{ @$auction->get->property_type }})</span></span><br>
                    @if ($auction->get->property_type != null)
                      @foreach (array_filter(@$auction->get->property_items) as $key => $item)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endforeach
                    @endif

                  </div>
                </div>
              @endif
              @if (@$auction->get->leaseProp != null && @$auction->get->leaseProp != 'Single Room')
                <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Is the tenant
                    looking to lease their entire property or a single room?
                  </strong> {{ @$auction->get->leaseProp }}</div>
              @elseif(@$auction->get->leaseProp == 'Single Room')
                <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Is the tenant
                    looking to lease their entire property or a single room?<span class="removeBold">(Single
                      Room)</span>
                  </strong> {{ @$auction->get->leasePropOther }}</div>
              @endif
              @if (@$auction->get->prop_condition != null)
                <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Acceptable
                    Property
                    Conditions: </strong>
                  @foreach ($auction->get->prop_condition as $item)
                    @if ($item != 'Other')
                      {{ $item }}
                    @elseif($item == 'Other')
                      {{ $auction->get->propsOther }}
                    @endif
                  @endforeach

                </div>
              @endif
              @if (@$auction->get->bedrooms != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Bedrooms
                    Needed:</strong>
                  {{ !empty($auction->get->bedrooms) ? ($auction->get->bedrooms != 'Other' ? $auction->get->bedrooms : $auction->get->custom_bedrooms) : '' }}

                </div>
              @endif
              @if (@$auction->get->bathrooms != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Bathrooms
                    Needed:</strong>
                  {{ !empty($auction->get->bathrooms) ? ($auction->get->bathrooms != 'Other' ? $auction->get->bathrooms : $auction->get->custom_bathrooms) : '' }}
                </div>
              @endif
              @if (@$auction->get->minimum_sqft_needed != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Sqft
                    Needed:</strong>
                  {{ $auction->get->minimum_sqft_needed }}
                </div>
              @endif
              @if (@$auction->get->heated_sqft != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Heated
                    Sqft:</strong> {{ @$auction->get->heated_sqft }}</div>
              @endif
              @if (@$auction->get->leasable_sqft != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Net
                    Leaseable
                    Sqft:</strong> {{ @$auction->get->leasable_sqft }}</div>
              @endif
              @if (@$auction->get->minimum_sqft_needed != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Minimum Total
                    Acreage Needed:</strong>
                  {{ $auction->get->minimum_sqft_needed }}
                </div>
              @endif
              @if (@$auction->get->parking_feature_garage != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Garage/Parking Features: </strong>
                  {{ @$auction->get->parking_feature_garage }}
                </div>
              @endif
              @if (@$auction->get->has_water_view != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Water View:<span
                        class="removeBold">({{ @$auction->get->has_water_view }})</span></span><br>
                    @if (@$auction->get->has_water_view != 'No')
                      @foreach (array_filter(@$auction->get->water_view) as $key => $item)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->has_water_extra != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Water Extras:<span
                        class="removeBold">({{ @$auction->get->has_water_extra }})</span></span><br>
                    @if (@$auction->get->has_water_extra != 'No ')
                      @foreach (array_filter(@$auction->get->water_extras) as $key => $item)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->waterFrontageOpt != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Water Frontage:<span
                        class="removeBold">({{ @$auction->get->waterFrontageOpt }})</span></span><br>
                    @if (@$auction->get->waterFrontageOpt != 'No')
                      @foreach (array_filter(@$auction->get->waterFrontage) as $key => $item)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->waterAccessOpt != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">Water Access:<span
                        class="removeBold">({{ @$auction->get->waterAccessOpt }})</span></span><br>
                    @if (@$auction->get->waterAccessOpt != 'No')
                      @foreach (array_filter(@$auction->get->water_access) as $key => $item)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              @endif
              @if (@$auction->get->viewOpt != null && @$auction->get->viewReference != null)
                <div class="row">
                  <div class="col-md-12">
                    <i class="fa-regular fa-check-square"></i>
                    <span class="fw-bold">View Preference:<span
                        class="removeBold">({{ @$auction->get->viewOpt }})</span></span><br>
                    @foreach (array_filter((array) @$auction->get->viewReference) as $key => $item)
                      @if (@$item != 'No' && @$item != 'Other')
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$item }}</span>
                      @endif
                      @if (@$item == 'Other' && @$auction->get->viewReferenceOther != null)
                        <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">
                          {{ @$auction->get->viewReferenceOther }}</span>
                      @endif
                    @endforeach
                  </div>
                </div>
              @endif
              @if (@$auction->get->custom_terms != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Offered Lease
                    Terms:</strong>
                  {{ @$auction->get->custom_terms != '' ? @$auction->get->lease_terms : @$auction->get->custom_terms }}
                </div>
              @endif
              @if (@$auction->get->sf_price != null)
                <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Price SF/YR:
                  </strong> {{ @$auction->get->sf_price }}</div>
              @endif

              @if (!@$auction->get && @$auction->get->Furnishings != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Furnishings Needed:</strong>
                  @foreach (array_filter(@$auction->get->Furnishings) as $key => $item)
                    {{ @$item }}
                  @endforeach
                </div>
              @endif
              @if (@$auction->get->pool != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Pool Needed:
                  </strong>
                  {{ @$auction->get->pool == 'Yes' ? @$auction->get->poolNeededOpt : '(No)' }}
              @endif
              @if (@$auction->get->carport != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Carport Needed:</strong>
                  {{ @$auction->get->carport == 'Yes' ? (@$auction->get->carport_opt == 'Other' ? $auction->get->custom_carport : '(No)') : '(No)' }}
                </div>
              @endif
              @if (@$auction->get->garage != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Garage Needed: </strong>
                  {{ $auction->get->garage == 'Yes' ? ($auction->get->garage_opt == 'Other' ? $auction->get->custom_garage : '(No)') : '(No)' }}
                </div>
              @endif
              @if (@$auction->get->need_water_view != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Water
                    View:</strong>
                  {{ @$auction->get->need_water_view }}</div>
              @endif
              @if (@$auction->get->tenant_criteria != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Tenants
                    Criteria:</strong> {{ @$auction->get->tenant_criteria }}</div>
              @endif
              @if (@$auction->get->credit_score != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Tenants Credit
                    Score:</strong> {{ @$auction->get->credit_score }}</div>
              @endif
              @if (@$auction->get->custom_total_occupants != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>How many people
                    will
                    be occupying the property?</strong>
                  {{ @$auction->get->custom_total_occupants != '' ? @$auction->get->total_occupants : @$auction->get->custom_total_occupants }}
                </div>
              @endif
             

              @if (@$auction->get->is_tenant_eligible != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Eligibility/Interest in Leasing in 55-and- Over Communities: </strong>
                  {{ @$auction->get->is_tenant_eligible }}
                </div>
              @endif
              @if (@$auction->get->is_tenant_eligible != null)
                <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i>
                  <strong>Non-Negotiable Amenities and Property Features: </strong>
                  @if (gettype(@$auction->get->negotiable) == 'array'&& @$auction->get->any_non_negotiable_factors == 'Yes')
                  @foreach (@$auction->get->negotiable as $item)
                    <span class="badge bg-secondary removeBold">
                      @if($item !='Other')
                        {{ $item }}
                      @endif
                      @if($item=='Other')
                        {{ $auction->get->negotiableOther }}
                      @endif
                    </span>
                  @endforeach
                @endif
                </div>
              @endif
              <hr class="mt-4">
              <h4>Tenant’s Leasing Terms</h4>
              <div class="row" style="flex-wrap: wrap;">
                @if (@$auction->get->monthly_price != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Maximum Monthly
                      Lease Price: </strong> {{ @$auction->get->monthly_price }}</div>
                @endif
                @if (@$auction->get->leaseLength != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Offered Lease
                      Terms:
                    </strong>
                    @foreach ($auction->get->leaseLength as $item)
                      @if ($item != 'Other')
                        {{ $item }}
                      @elseif($item == 'Other')
                        {{ $auction->get->leaseOther }}
                      @endif
                    @endforeach
                  </div>
                @endif
                
                @if (@$auction->get->idealDate != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Offered
                      Lease Date:
                    </strong> {{ @$auction->get->idealDate }}</div>
                @endif
              </div>
              <hr class="mt-4">
              <h4>Tenant’s Prescreening Criteria </h4>
              <div class="row" style="flex-wrap: wrap;">
                @if (@$auction->get->how_many_occupying != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Number of
                      Occupants:
                    </strong> {{ @$auction->get->how_many_occupying }}</div>
                @endif
                @if (@$auction->get->monthly_household_income != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Tenant’s Monthly Net Household Income:
                    </strong> {{ @$auction->get->monthly_household_income }}</div>
                @endif
                @if (@$auction->get->has_pets != null)
                  <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Pets:</strong>
                    {{ @$auction->get->has_pets }}</div>
                @endif
                @if (@$auction->get->has_pets == 'Yes')
                  @if (@$auction->get->petType != null)
                    <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Type of
                        Pet(s):</strong> {{ @$auction->get->petType }}</div>
                  @endif
                  @if (@$auction->get->totalPets != null)
                    <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Number of
                        Pet(s):</strong> {{ @$auction->get->totalPets }}</div>
                  @endif
                  @if (@$auction->get->petBreed != null)
                    <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>What is the
                        bread
                        of pets?</strong> {{ @$auction->get->petBreed }}</div>
                  @endif
                  @if (@$auction->get->petWeight != null)
                    <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>Weight of
                        Pet(s): </strong> {{ @$auction->get->petWeight }}</div>
                  @endif
                  @if (@$auction->get->peyWeight != null)
                    <div class="col-md-12 col-12  mt-2"><i class="fa-regular fa-check-square"></i> <strong>What is the
                        bread
                        of pets?</strong> {{ @$auction->get->peyWeight }}</div>
                  @endif
                @endif
                
                @if (@$auction->get->tenant_credit_score != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Tenant’s Credit
                      Score Rating:
                    </strong> {{ @$auction->get->tenant_credit_score }}</div>
                @endif
                @if (@$auction->get->convicted != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Prior Felony Conviction(s) in the Last 7 Years:
                    @if(@$auction->get->convicted != 'Yes')
                      </strong> {{ @$auction->get->convicted }}</div>
                    @elseif(@$auction->get->convicted == 'Yes')
                      </strong> {{ @$auction->get->custom_convicted }}</div>
                    @endif
                @endif
                @if (@$auction->get->evicted != null)
                <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>Prior Eviction(s) in the Last 7 Years:
                    @if(@$auction->get->evicted != 'Yes')
                      </strong> {{ @$auction->get->evicted }}</div>
                    @elseif(@$auction->get->evicted == 'Yes')
                      </strong> {{ @$auction->get->custom_evicted }}</div>
                    @endif
                  @endif
                  @if (@$auction->get->compensateOpt != null)
                  <div class="col-md-12 col-12 mt-2"><i class="fa-regular fa-check-square"></i> <strong>
                      Tenant-Offered AgentCompensation:{{ @$auction->get->compensateOpt != 'Yes' ? '(No)' : '' }}
                    </strong>
                    @if (@$auction->get->compensateOtherOpt != 'Other')
                      {{ @$auction->get->compensateOtherOpt }}
                    @else
                      {{ @$auction->get->compensateOther }}
                    @endif
  
                  </div>
                @endif
              </div>
            </div>
              <hr class="mt-4">
              <h4>Description</h4>
              <div class="row mx-2" style="flex-wrap: wrap;">
                {{@$auction->get->description_buyer_specific}}
              </div>
              <hr class="mt-4">
              <h4>Tenant's Agent Info</h4>
              <div class="row" style="flex-wrap: wrap;">
                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>Name:</strong>
                  {{ @$auction->get->agent_first_name }} {{ @$auction->get->agent_last_name }}
                </div>

                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>Brokerage:</strong>
                  {{ @$auction->get->agent_brokerage }}
                </div>

                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>Real Estate License
                    #:</strong>
                  {{ @$auction->get->agent_license_no }}
                </div>

                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>Phone:</strong>
                  {{ @$auction->get->agent_phone }}
                </div>

                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>Email:</strong>
                  {{ @$auction->get->agent_email }}
                </div>

                <div class="col-md-12 col-12 mt-2"><i class="fa fa-check-square-o"></i> <strong>MLD ID #:</strong>
                  {{ @$auction->get->agent_mls_id }}
                </div>
                <br>
                <br>
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
          <a href="{{ route('auction-chat', ['tenant-criteria', $auction->id]) }}" class="btn btn-success w-100 mb-2">
            <i class="fa-solid fa-paper-plane"></i> Send Message</a>
        @endif
        @if ($auth_id)
          @if (in_array(auth()->user()->user_type, ['landlord', 'agent']))
            <button class="btn w-100"
              onclick="javascript:window.location='{{ route('tenant.criteria.auction.bid', @$auction->id) }}';"
              {{ @$auction->user_id == $auth_id ? 'disabled' : '' }}>
              <span class="bid">Bid Now </span>
              <span
                class="badge bg-light float-end text-dark">${{ number_format(@$auction->get->monthly_price) }}</span>
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
              {{-- <p><b>{{ $lowest_bidder->user->name ?? '' }}</b> is the lowest bidder.</p> --}}
            @else
              <p>No one has bid on this auction.</p>
            @endif
            <div class="accordion" id="accordionExample">
              <div class="accordion-item border-0">
                {{-- @dd(@$auction->bids) --}}
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
                        ${{ number_format($bid->get->price) }} </div>
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
                          <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                              @if ($bid->get->price)
                                <tr>
                                  <th class="small">Price</th>
                                  <td class="small">
                                    <span>${{ number_format($bid->get->price) }}</span>
                                  </td>
                                </tr>
                              @endif
                              <tr>
                                <th class="small">First Name</th>
                                <td class="small">{{ $bid->get->firstName }}</td>
                              </tr>
                              <tr>
                                <th class="small">Phone number</th>
                                <td class="small">{{ $bid->get->phoneNumber }}</td>
                              </tr>
                              <tr>
                                <th class="small">Email</th>
                                <td class="small">{{ $bid->get->email }}</td>
                              </tr>
                            </tbody>
                          </table>
                          @if (@$auction->user_id == $auth_id)
                            <p class="d-flex justify-content-between small">Address:
                              <span>{{ isset($bid->get->address) }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->carport_spaces != null && @$bid->get->custom_carport_spaces != '')
                            <p class="d-flex justify-content-between small">How many carport spaces?
                              <span>{{ $bid->get->custom_carport_spaces != '' ? $bid->get->carport_spaces : $bid->get->custom_carport_spaces }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->garage_spaces != '' && @$bid->get->custom_garage_spaces != null)
                            <p class="d-flex justify-content-between small">How many garage spaces?
                              <span>{{ $bid->get->custom_garage_spaces != '' ? $bid->get->garage_spaces : $bid->get->custom_garage_spaces }}</span>
                            </p>
                          @endif
                          @if (@$bid->get->water_view != '')
                            <p class="d-flex justify-content-between small">Water View:
                              <span>{{ @$bid->get->water_view }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->water_extras != '')
                            <p class="d-flex justify-content-between small">Water Extras:
                              <span>{{ $bid->get->water_extras }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->requirements != '')
                            <p class="justify-content-between small">What is required at move in?
                              @if (gettype($bid->get->requirements))
                                @foreach ($bid->get->requirements as $item)
                                  <span class="badge bg-secondary">{{ $item }}</span>
                                @endforeach
                              @endif
                            </p>
                          @endif

                          @if (@$bid->get->security_deposit != '')
                            <p class="d-flex justify-content-between small">Security Deposit Amount:
                              <span>${{ number_format($bid->get->security_deposit) }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->is_application != '')
                            <p class="d-flex justify-content-between small">Is there an application?
                              <span>{{ $bid->get->is_application }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->application_amount != '')
                            <p class="d-flex justify-content-between small">How much is the application?
                              <span>${{ number_format($bid->get->application_amount) }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->application_link != '')
                            <p class="d-flex justify-content-between small">Application link:
                              <span>{{ $bid->get->application_link }}</span>
                            </p>
                          @endif

                          <h5>Will the landlord accept a pet if the tenant has one?</h5>

                          @if (@$bid->get->pet_deposit != '')
                            <p class="d-flex justify-content-between small">Pet deposit:
                              <span>${{ number_format($bid->get->pet_deposit) }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->pet_deposit_refundable != '')
                            <p class="d-flex justify-content-between small">Is pet deposit non-refundable or
                              refundable?
                              <span>{{ $bid->get->pet_deposit_refundable }}</span>
                            </p>
                          @endif

                          @if (@$bid->get->pet_deposit_type != '')
                            <p class="d-flex justify-content-between small">Is pet deposit monthly or one-time fee?
                              <span>{{ $bid->get->pet_deposit_type }}</span>
                            </p>
                          @endif

                          @if ($bid->get->picLinkProp)
                            <p class="d-flex justify-content-between small">Link to the property listing:
                              <span><a href="{{ $bid->get->picLinkProp }}"
                                  target="_blank">{{ $bid->get->picLinkProp }}</a></span>
                            </p>
                          @endif
                          @if ($bid->get->videoLink)
                            <p class="d-flex justify-content-between small">Link to the property Videos:
                              <span><a href="{{ $bid->get->videoLink }}"
                                  target="_blank">{{ $bid->get->videoLink }}</a></span>
                            </p>
                          @endif
                          @if (@$auction->user_id == $auth_id)
                            @if (@$bid->get->video_url)
                              <p>
                                <a href="{{ @$bid->get->video_url }}" class="btn btn-sm btn-primary"
                                  target="_blank">View
                                  Video</a>
                              </p>
                            @endif
                            @if (@$bid->get->note)
                              <p>
                                <a href="{{ url(@$bid->get->note) }}" class="btn btn-sm btn-primary"
                                  target="_blank">Proof of
                                  funds/pre-approval letter</a>
                              </p>
                            @endif
                            @if (@$bid->get->card)
                              <p>
                                <a href="{{ asset(@$bid->get->card) }}" target="_blank">
                                  <img src="{{ asset(@$bid->get->card) }}" alt="" style="width: 150px;"></a>
                              </p>
                            @endif
                            @if (@$bid->get->audio)
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
                              <form action="{{ route('agent.tenant.criteria.auction.bid.accept') }}" method="post">
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
            {{ qr_code(route('tenant.criteria.auction.view', @$auction->id), 200) }}
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



@endsection

@push('scripts')
  {{-- <script src="{{asset('assets/bootstrap-5.2.2/js/twitter-bootstrap.min.js')}}"></script> --}}
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.9.0/timer.jquery.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  @if (@$auction->get->auction_length_days > 0)
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
