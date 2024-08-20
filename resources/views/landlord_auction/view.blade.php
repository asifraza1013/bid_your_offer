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

    table .small {
      font-size: 14px;
    }

    .image {
      width: 200px;
    }

    .url {
      margin-left: 2px;
    }

    .removeBold {
      font-weight: normal;
    }
    .imgBox {
      width: 300px;
      height: 300px;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      margin: auto;
  }
  .imgBox img{
    width:100%;
    height: 100%;
  }
    .videoBox {
      width: 300px;
      height: 300px;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      margin: auto;
  }
  .videoBox video{
    width:100%;
    height: 100%;
  }
  </style>
@endpush

@section('content')
  @php
    $auth_id = auth()->user() ? auth()->user()->id : 0;
    $meta = @$auction->meta;
  @endphp
  <!-- Gallery Start Here  -->
  <div class="container listingDescription">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-8 leftCol">

        <!-- Description Box  -->
        <div class="card description">
          <div class="col-md-12 col-12 fw-bold image">
            @php
              $photos = json_decode(@$auction->info('photos'));
            @endphp
            @if (gettype($photos) == 'array')
              @foreach ($photos as $photo)
                <img src={{ asset($photo) }}>
              @endforeach
            @endif
          </div>
          <div class="card-body">
            <h4>Basic Information</h4>
            <hr>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Address: <span
                  class="removeBold"> {{ @$auction->address }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> City: <span
                  class="removeBold">{{ @$auction->city }}</span></div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> County: <span
                  class="removeBold">{{ @$auction->county }}</span></div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> State: <span
                  class="removeBold">{{ @$auction->state }}</span></div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Date:
                <span class="removeBold">{{ Carbon\Carbon::parse(@$auction->listing_date)->format('M d, Y') }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Expiration Date:
                <span class="removeBold">{{ Carbon\Carbon::parse(@$auction->expiration_date)->format('M d, Y') }}</span>
              </div>
              @if(@$auction->get->listing_service_type != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Service Type:
                <span class="removeBold">{{ @$auction->get->listing_service_type }}</span>
              </div>
              @endif
              @if(@$auction->get->representation != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Representation:
                <span class="removeBold">{{ @$auction->get->representation }}</span>
              </div>
              @endif
              @if(@$auction->get->auction_type != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Type:
                <span class="removeBold">{{ @$auction->get->auction_type }}</span>
              </div>
              @endif
              @if(@$auction->get->property_type != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property Style:
                <span class="removeBold">{{ @$auction->get->property_type }}</span>
              </div>
              @endif
              @if(@$auction->get->leasePropOption != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Is the landlord looking to lease their entire property or a single room?
                  <span class="removeBold">{{ @$auction->get->leasePropOption }}</span>
                </div>
              @endif
              @if(@$auction->get->propConditions != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property Condition:
                  <span class="removeBold">{{ @$auction->get->propConditions?@$auction->get->propConditions:@$auction->get->propOther }}</span>
                </div>
              @endif
              @if(@$auction->get->petsOpt != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Will the landlord accept pets? 
                  <span class="removeBold">{{ @$auction->get->petsOpt }}</span>
                </div>
              @endif
              @if(@$auction->get->petsNumber != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Number of Pets Allowed:
                  <span class="removeBold">{{ @$auction->get->petsNumber }}</span>
                </div>
              @endif
              @if(@$auction->get->petsType != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Acceptable Pet Types:
                  <span class="removeBold">{{ @$auction->get->petsType }}</span>
                </div>
              @endif
              @if(@$auction->get->petsWeight != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Maximum Pet Weight:
                  <span class="removeBold">{{ @$auction->get->petsWeight }}</span>
                </div>
              @endif
              @if(@$auction->get->petsFee != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> One-Time Pet Deposit or Monthly Pet Fee:
                  <span class="removeBold">{{ @$auction->get->petsFee }}</span>
                </div>
              @endif
              @if(@$auction->get->petsAmount != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pet Fee Amount:
                  <span class="removeBold">{{ @$auction->get->petsAmount}}</span>
                </div>
              @endif
              @if(@$auction->get->petsFund != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Is the Pet Fee Refundable or Non-Refundable?
                  <span class="removeBold">{{ @$auction->get->petsFund}}</span>
                </div>
              @endif
              @if(@$auction->get->offer_allowed_occupants != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many occupants will the landlord accept?
                  <span class="removeBold">{{ @$auction->get->offer_allowed_occupants !='Other'?@$auction->get->offer_allowed_occupants:@$auction->get->custom_occupants }}</span>
                </div>
              @endif  
              @if(@$auction->get->creditScore != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> What is the minimum credit score rating the landlord will accept? 
                  <span class="removeBold">{{ @$auction->get->creditScore }}</span>
                </div>
              @endif
              @if(@$auction->get->offer_min_net_income != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> What is the minimum net income a household must earn to qualify for the rental? 
                  <span class="removeBold">{{ @$auction->get->offer_min_net_income }}</span>
                </div>
              @endif
              @if(@$auction->get->eviction != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Will the landlord accept a tenant with a prior eviction within the last 7 years? 
                  <span class="removeBold">{{ @$auction->get->eviction }}</span>
                </div>
              @endif
              @if(@$auction->get->offer_prior_felony != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Will the landlord accept a tenant with a prior felony within the last 7 years? 
                  <span class="removeBold">{{ @$auction->get->offer_prior_felony }}</span>
                </div>
              @endif
              <hr>
              <h4>Offered Lease Terms:</h4>
              <div class="row" style="flex-wrap: wrap;">
                @if(@$auction->get->price != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Price:
                    <span class="removeBold">{{ @$auction->get->price }}</span>
                  </div>
                @endif
                @if(@$auction->get->rentNow != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Rent Now:
                    <span class="removeBold">{{ @$auction->get->rentNow }}</span>
                  </div>
                @endif
                @if(@$auction->get->startingPrice != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Starting Price:
                    <span class="removeBold">{{ @$auction->get->startingPrice }}</span>
                  </div>
                @endif
                @if(@$auction->get->reservePrice != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Reserve Price:
                    <span class="removeBold">{{ @$auction->get->reservePrice }}</span>
                  </div>
                @endif
                @if(@$auction->get->timeFrame != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Timeframe Allocated to Respond to Offers:
                    <span class="removeBold">{{ @$auction->get->timeFrame }}</span>
                  </div>
                @endif
                @if(@$auction->get->timeFrameMultiple != null)
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Timeframe Allocated to Respond to Multiple Offers:
                    <span class="removeBold">{{ @$auction->get->timeFrameMultiple }}</span>
                  </div>
                @endif
              </div>
            <hr>
            <h4>Features</h4>
            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property Type:
                <span class="removeBold"> {{ @$auction->info('property_type') }}
              </div></span>
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Auction Type:
                <span class="removeBold">{{ @$auction->info('auction_type') }}
              </div></span>
              @if (@$auction->info('auction_length') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Auction Length:
                  <span class="removeBold">{{ @$auction->info('auction_length') }}</span>
                </div>
              @endif
              @if (@$auction->get->bedroom != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i>
                  Bedrooms: <span class="removeBold">{{ @$auction->get->bedroom !="Other"?@$auction->get->bedroom:@$auction->get->other_bedrooms }}</span>
                </div>
              @endif
              @if (@$auction->get->bathrooms != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i>
                  Bathrooms:
                  <span class="removeBold">{{ @$auction->get->bathrooms !="Other" ?@$auction->get->bathrooms:@$auction->get->other_bathrooms }}
                </div></span>
              @endif
              @if (@$auction->info('year_built') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Year Built:
                  <span class="removeBold">{{ @$auction->info('year_built') }}</span>
                </div>
              @endif
              @if (@$auction->info('heated_sqft') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Heated Sqft:
                  <span class="removeBold">{{ @$auction->info('heated_sqft') }}</span>
                </div>
              @endif
              @if (@$auction->info('sqft_total') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Sqft Total:
                  <span class="removeBold">{{ @$auction->info('sqft_total') }}</span>
                </div>
              @endif
              @if (@$auction->get->heated_source != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Sqft Heated Source:
                  <span class="removeBold">{{ @$auction->get->heated_source != 'Other'?@$auction->get->heated_source:@$auction->get->otherSqft }}</span>
                </div>
              @endif
              @if (@$auction->get->total_acreage != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Total Acreage:
                  <span class="removeBold">{{@$auction->get->total_acreage }}</span>
                </div>
              @endif
              @if (@$auction->get->yearBuilt != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Year Built:
                  <span class="removeBold">{{@$auction->get->yearBuilt }}</span>
                </div>
              @endif
              @if (@$auction->get->lotSize != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lot Size:
                  <span class="removeBold">{{@$auction->get->lotSize }}</span>
                </div>
              @endif
              @if (@$auction->get->legarName != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Legal Subdivision Name:
                  <span class="removeBold">{{@$auction->get->legarName }}</span>
                </div>
              @endif
              @if (@$auction->get->taxId != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Tax ID (Parcel Number):
                  <span class="removeBold">{{@$auction->get->taxId }}</span>
                </div>
              @endif
              @if (@$auction->get->zoneCode != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Flood Zone Code:
                  <span class="removeBold">{{@$auction->get->zoneCode }}</span>
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->appliances)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Appliances Included:
                      @foreach (json_decode(@$auction->get->appliances) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->appliancesOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if (@$auction->get->firePlace != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Fireplace:
                  <span class="removeBold">{{@$auction->get->firePlace }}</span>
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->rent)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Rent Includes:
                      @foreach (json_decode(@$auction->get->rent) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->rentOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->features)) == 'array')
              <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Accessibility Features:
                @foreach (json_decode(@$auction->get->features) as $item)
                <span class="removeBold badge bg-secondary">
                  {{ $item }} 
                </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->interiorFeatures)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Interior Features:
                      @foreach (json_decode(@$auction->get->interiorFeatures) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->interiorFeatureOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->additional_rooms)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Additional Rooms:
                      @foreach (json_decode(@$auction->get->additional_rooms) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->roomOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->laundry)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Laundry Features:
                      @foreach (json_decode(@$auction->get->laundry) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->laundryOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if (@$auction->get->propFloors != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many floors are in the property?
                  <span class="removeBold">{{@$auction->get->propFloors }}</span>
                </div>
              @endif
              @if (@$auction->get->floorNumber != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> What floor number is the property on?
                  <span class="removeBold">{{@$auction->get->floorNumber }}</span>
                </div>
              @endif
              @if (@$auction->get->totalFloors != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many floors are in the entire building?
                  <span class="removeBold">{{@$auction->get->totalFloors }}</span>
                </div>
              @endif
              @if (@$auction->get->building_elevator != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Building Elevator:
                  <span class="removeBold">{{@$auction->get->building_elevator }}</span>
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->floor_covering)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Floor Covering:
                      @foreach (json_decode(@$auction->get->floor_covering) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->floorConvringOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->room_type)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Room Type:
                      @foreach (json_decode(@$auction->get->room_type) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->room_level)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Room Level:
                      @foreach (json_decode(@$auction->get->room_level) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->bedroomCloset)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Bedroom Closet Type:
                      @foreach (json_decode(@$auction->get->bedroomCloset) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->roomPrimary)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Room Primary Covering:
                      @foreach (json_decode(@$auction->get->roomPrimary) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->room_feature)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Room Features:
                      @foreach (json_decode(@$auction->get->room_feature) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->roomFeatueOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if (@$auction->info('water_view') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Water View:
                  @if (@$auction->info('water_view') != '' && @$auction->info('water_view') != 'null')
                    @foreach (json_decode(@$auction->info('water_view')) as $water_view)
                      <span class="badge bg-secondary removeBold">{{ $water_view }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->info('water_extras') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Water Extras:
                  @if (@$auction->info('water_extras') != '' && @$auction->info('water_extras') != 'null')
                    @foreach (json_decode(@$auction->info('water_extras')) as $water_extras)
                      <span class="badge bg-secondary removeBold">{{ $water_extras }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->water_access)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Water Access:
                      @foreach (json_decode(@$auction->get->water_access) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->waterFrontageView)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Water Frontage:
                      @foreach (json_decode(@$auction->get->waterFrontageView) as $item)
                    <span class="removeBold badge bg-secondary">
                        {{ $item }} 
                    </span>
                @endforeach
              </div>
              @endif
              @if(gettype(json_decode(@$auction->get->utilities)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Utilities:
                      @foreach (json_decode(@$auction->get->utilities) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->otherUtilities }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->water)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Water:
                      @foreach (json_decode(@$auction->get->water) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->otherWater }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->sewer)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Sewer:
                      @foreach (json_decode(@$auction->get->sewer) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{-- {{ $auction->get->othersewer }} --}} 
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->airConditioning)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Air Conditioning:
                      @foreach (json_decode(@$auction->get->airConditioning) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->otherAirCondition }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->heatingFuel)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Heating/Cooling:
                      @foreach (json_decode(@$auction->get->heatingFuel) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->otherFuel }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if (@$auction->get->carport != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Carport:
                  <span class="removeBold"> {{ @$auction->get->carport }}</span>
                </div>
              @endif
              @if (@$auction->get->carport  == 'Yes')
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many carport
                  spaces? <span class="removeBold">{{ @$auction->get->carportOther }}</span>
                </div>
              @endif
              @if (@$auction->get->garage != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Garage:
                  <span class="removeBold"> {{ @$auction->get->garage }}</span>
                </div>
              @endif
              @if (@$auction->get->garage  == 'Yes')
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many garage
                spaces? <span class="removeBold"> {{ @$auction->get->garageOther }}</span>
              </div>
              @endif
              @if (@$auction->get->front_exposure != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Front Exposure:
                  <span class="removeBold"> {{ @$auction->get->front_exposure }}</span>
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->foundation)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Foundation:
                      @foreach (json_decode(@$auction->get->foundation) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->foundationOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->exterior_construction)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Exterior Construction:
                      @foreach (json_decode(@$auction->get->exterior_construction) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->exteriorOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->exterior_feature)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Exterior Features:
                      @foreach (json_decode(@$auction->get->exterior_feature) as $item)
                      @if($item !='Other')
                      <span class="removeBold badge bg-secondary">
                        {{ $item }} 
                      </span>
                      @elseif($item == 'Other' && $auction->get->exteriorFeatureOther != null)
                      <span class="removeBold badge bg-secondary">
                      {{ $auction->get->exteriorFeatureOther }}
                          </span>
                            @endif
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->road_surface_type)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Road Surface Type:
                      @foreach (json_decode(@$auction->get->road_surface_type) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->roadSurfaceOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->roof)) == 'array')
              <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Roof:
                @foreach (json_decode(@$auction->get->roof) as $item)
                <span class="removeBold badge bg-secondary">
                  @if($item !='Other')
                  {{ $item }} 
                  @endif
                  @if($item == 'Other')
                  {{ $auction->get->roofCementOther }}
                  @endif
                </span>
                @endforeach
              </div>
              @endif
              @if(gettype(json_decode(@$auction->get->adjoining_property)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Adjoining Property:
                      @foreach (json_decode(@$auction->get->adjoining_property) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->community_feature)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Road Surface Type:
                      @foreach (json_decode(@$auction->get->community_feature) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !='Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other')
                                  {{ $auction->get->communityFeatureOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->association_amenitie)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Association Amenities:
                      @foreach (json_decode(@$auction->get->association_amenitie) as $item)
                              @if($item !='Other')
                              <span class="removeBold badge bg-secondary">
                                {{ $item }} 
                              </span>
                              @endif
                              @if($item =='Other')
                              <span class="removeBold badge bg-secondary">
                                {{ $auction->get->otherAmenities }} 
                              </span>
                              @endif
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->community_feature)) == 'array' && @$auction->get->community_feature != 'null' && @$auction->get->community_feature != null)
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Community Features:
                      @foreach (json_decode(@$auction->get->community_feature) as $item)
                              @if($item !='Other')
                              <span class="removeBold badge bg-secondary">
                                {{ $item }} 
                              </span>
                              @endif
                              @if($item =='Other')
                              <span class="removeBold badge bg-secondary">
                                {{ $auction->get->communityFeatureOther }} 
                              </span>
                              @endif
                      @endforeach
                  </div>
              @endif
              @if (@$auction->get->description != null)
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Description:
                  <span class="removeBold">{{ @$auction->get->description }}</span>
                </div>
              @endif
              @if (@$auction->get->disclaimer != null)
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Legal Disclaimers:
                  <span class="removeBold">{{ @$auction->get->disclaimer }}</span>
                </div>
              @endif
              @if (@$auction->get->driving_directions != null)
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Driving Directions:
                  <span class="removeBold">{{ @$auction->get->driving_directions }}</span>
                </div>
              @endif
              @if (@$auction->info('leasable_sqft') != null)
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Net Leaseable Sqft:
                  <span class="removeBold">{{ @$auction->info('leasable_sqft') }}</span>
                </div>
              @endif
              @if (@$auction->info('lease_type') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lease Type:
                  <span class="removeBold">{{ @$auction->info('lease_type') }}</span>
                </div>
              @endif
              @if (@$auction->info('lease_term') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lease Terms:
                  <span class="removeBold"> {{ @$auction->info('lease_term') }}</span>
                </div>
              @endif
              @if (@$auction->info('custom_lease_term') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Custom Lease Term:
                  <span class="removeBold"> {{ @$auction->info('custom_lease_term') }}</span>
                </div>
              @endif
              @if (@$auction->info('monthly_lease_price') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Monthly Lease Price:
                  <span class="removeBold">${{ @$auction->info('monthly_lease_price') }}</span>
                </div>
              @endif
              @if (@$auction->info('commercial_price') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Price SF/YR (Commercial):
                  <span class="removeBold">${{ @$auction->info('commercial_price') }}</span>
                </div>
              @endif
              @if (@$auction->info('residential_price') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Leased Price per
                  Sqft(Residential):
                  <span class="removeBold">${{ @$auction->info('residential_price') }}</span>
                </div>
              @endif
              @if (@$auction->info('terms_of_lease') != null && @$auction->info('terms_of_lease') != 'null')
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Terms of Lease:
                  @if (@$auction->info('terms_of_lease') != '' && @$auction->info('terms_of_lease') != 'null')
                    @foreach (json_decode(@$auction->info('terms_of_lease')) as $term_of_lease)
                      <span class="badge bg-secondary removeBold">{{ $term_of_lease }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->info('owner_pays') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Owner Pays:
                  @if (gettype(json_decode(@$auction->info('owner_pays'))) == 'array')
                    @if (@$auction->info('owner_pays') != '' && @$auction->info('owner_pays') != 'null')
                      @foreach (json_decode(@$auction->info('owner_pays')) as $owner_pays)
                        <span class="badge bg-secondary">{{ $owner_pays }}</span>
                      @endforeach
                    @endif
                  @else
                    <span class="badge bg-secondary">{{ @$auction->info('owner_pays') }}</span>
                  @endif
                </div>
              @endif
              @if (@$auction->info('tenant_pays') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Tenant Pays:
                  @if (@$auction->info('tenant_pays') != '' && @$auction->info('tenant_pays') != 'null')
                    @foreach (json_decode(@$auction->info('tenant_pays')) as $tenant_pays)
                      <span class="badge bg-secondary">{{ $tenant_pays }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->info('furnishings') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Furnishings:
                  <span class="removeBold"> {{ @$auction->info('furnishings') }}</span>
                </div>
              @endif
              @if (@$auction->info('allowed_tenants') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Max number of tenants
                  allowed:
                  <span class="removeBold"> {{ @$auction->info('allowed_tenants') }}</span>
                </div>
              @endif
              @if (@$auction->info('pool') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pool:
                  <span class="removeBold"> {{ @$auction->info('pool') }}</span>
                </div>
              @endif
              
              @if (@$auction->info('parking_spaces') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How many parking
                  spaces are available? {{ @$auction->info('parking_spaces') }}
                </div>
              @endif
              @if (@$auction->info('floors_in_property') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Floors In Property:
                  <span class="removeBold"> {{ @$auction->info('floors_in_property') }}</span>
                </div>
              @endif
              @if (@$auction->info('lot_size') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lot Size:
                  <span class="removeBold"> {{ @$auction->info('lot_size') }}</span>
                </div>
              @endif             
              @if (@$auction->info('ac_type') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Air Conditioning
                  Type: {{ @$auction->info('ac_type') }}
                </div>
              @endif
              @if (@$auction->info('application_fee_cost') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Application fee
                  cost:
                  ${{ @$auction->info('application_fee_cost') }}
                </div>
              @endif
              @if (@$auction->info('listing_id') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> MLS ID #:
                  {{ @$auction->info('listing_id') }}
                </div>
              @endif
              {{-- End --}}

            </div>

            <hr>
            <h4>Landlord/Landlords Agent Info</h4>
            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Name:
                <span class="removeBold">{{ @$auction->info('first_name') }} {{ @$auction->info('last_name') }}</span>
              </div>

              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Brokerage:
                <span class="removeBold">{{ @$auction->info('agent_brokerage') }}</span>
              </div>

              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> License Number:
                <span class="removeBold">{{ @$auction->info('agent_license_no') }}</span>
              </div>

              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Phone:
                <span class="removeBold">{{ @$auction->info('agent_phone') }}</span>
              </div>

              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Email:
                <span class="removeBold">{{ @$auction->info('agent_email') }}</span>
              </div>

              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> MLD ID:
                <span class="removeBold"> {{ @$auction->info('agent_mls_id') }}</span>
              </div>
            </div>
            <div class="row">
              @if(@$auction->get->video)
                  <div class="col-6 form-group">
                    <label class="fw-bold mt-1">Video:</label><br>
                     <div class="videoBox">
                      <video controls autoplay="true">
                          <source src="{{ asset(@$auction->get->video) }}" type="video/mp4">
                              <source src="{{ asset(@$auction->get->video) }}" type="video/ogg">
                              Your browser does not support the video tag.
                      </video>
                     </div>
                  </div>
              @endif
              @if(@$auction->get->photo)
                  <div class="form-group col-6">
                      <label class="fw-bold">Photo:</label><br>
                        <div class="imgBox">
                          <img src="{{ asset(@$auction->get->photo) }}" />
                        </div>
                      </div>
              @endif
          </div>
            <div class="row" style="flex-wrap: wrap;">

              @if (@$auction->info('public_private_contract_term') == 'Yes')
                <hr>
                <h4>If Landlord has an offer less than then Ideal price and terms what are the lowest
                  countered
                  terms Landlord will go (Lowest Terms Seller will accept):</h4>

                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Rental Price:
                  ${{ @$auction->info('offer_rental_price') }} </div>
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lease Terms:
                  {{ @$auction->info('special_offer_lease_term') }}
                </div>

                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Security
                  Deposit:
                  ${{ @$auction->info('special_offer_security_deposit') }} </div>

                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> offered Move in
                  Date:
                  {{ @$auction->info('special_offer_move_date') }} </div>
              @endif

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
        <h1>{{ @$auction->address }}</h1>
        <hr>
        @inject('carbon', 'Carbon\Carbon')
        @php
          $lowest_bid_price = ''; //@$auction->bids->min('price') ?? @$auction->max_price;
          $lowest_bidder = ''; //@$auction->bids->where('price', $lowest_bid_price)->first();
          $my_bid = ''; //@$auction->bids->where('user_id', $auth_id)->first();
        @endphp
        @if (@$auction->user_id != $auth_id)
          <a href="{{ route('auction-chat', ['landlord-property', $auction->id]) }}"
            class="btn btn-success w-100 mb-2">
            <i class="fa-solid fa-paper-plane"></i> Send Message</a>
        @endif
        @if ($auth_id)
          @if (in_array(auth()->user()->user_type, ['seller', 'agent']))
            <button class="btn w-100"
              onclick="javascript:window.location='{{ route('agent.landlord.auction.bid', @$auction->id) }}';"
              {{ @$auction->user_id == $auth_id ? 'disabled' : '' }}>
              <span class="bid">Bid Now </span>
              <span class="badge bg-light float-end text-dark">${{ @$auction->get->price? @$auction->get->price:@$auction->get->startingPrice }}</span>
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
                        ${{ $bid->get->price }} </div>
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
                              <tr>
                                <th colspan="2">Tenant/Tenant’s Agent Info</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th class="small">First Name</th>
                                <td class="small">{{ $bid->get->first_name }}</td>
                              </tr>
                              <tr>
                                <th class="small">Last Name</th>
                                <td class="small">{{ $bid->get->last_name }}</td>
                              </tr>
                              <tr>
                                <th class="small">Phone number</th>
                                <td class="small">{{ $bid->get->agent_phone }}</td>
                              </tr>
                              <tr>
                                <th class="small">Email</th>
                                <td class="small">{{ $bid->get->agent_email }}</td>
                              </tr>
                              <tr>
                                <th class="small">Brokerage</th>
                                <td class="small">{{ $bid->get->agent_brokerage }}</td>
                              </tr>
                              <tr>
                                <th class="small">Real Estate License #:</th>
                                <td class="small">{{ $bid->get->agent_license_no }}</td>
                              </tr>
                              <tr>
                                <th class="small">MLS ID #</th>
                                <td class="small">{{ $bid->get->agent_mls_id }}</td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th colspan="2">Terms offered by the tenant</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th class="small">Lease Terms</th>
                                @if (is_string($bid->get->lease_terms))
                                  @php
                                    $leaseTermsArray = json_decode($bid->get->lease_terms, true);
                                  @endphp
                                  @if ($leaseTermsArray)
                                    <td class="small">
                                      {{ implode(', ', array_map('rtrim', $leaseTermsArray, [','])) }}
                                    </td>
                                  @endif
                                @else
                                  {{-- <td class="small">{{ json_decode($bid->get->lease_terms) }}</td> --}}
                                @endif
                              </tr>
                              <tr>
                                <th class="small">Security Deposit</th>
                                <td class="small">
                                  ${{ $bid->get->securityDeposit }}</td>
                              </tr>
                              {{-- <tr>
                                <th class="small">Offered Move in Date</th>
                                <td class="small">{{ $bid->get->offer_move_date }}</td>
                              </tr> --}}
                              <tr>
                                <th class="small">How many occupants?</th>
                                <td class="small">
                                  @if ($bid->get->occupants != '' && $bid->get->occupants != 'null')
                                    <span class="badge bg-secondary">{{ $bid->get->occupants }}</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th class="small">Does tenant have a pet?</th>
                                <td class="small">
                                  @if ($bid->get->petOpt != '' && $bid->get->petOpt != 'null')
                                    <span class="badge bg-secondary">{{ $bid->get->petOpt }}</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th class="small">How many pets does the tenant have</th>
                                <td class="small">{{ $bid->get->pets }}
                                </td>
                              </tr>
                              <tr>
                                <th class="small">Credit Score Rating:</th>
                                <td class="small">
                                  {{ $bid->get->scoreRating }}</td>
                              </tr>
                              <tr>
                                <th class="small">Household Net Income:</th>
                                <td class="small">${{ $bid->get->monthlyIncome }}
                                </td>
                              </tr>
                              <tr>
                                <th class="small">Has tenant had any prior evictions?</th>
                                <td class="small">{{ $bid->get->evictions }}
                                </td>
                              </tr>
                              <tr>
                                <th class="small">Has tenant been convicted of a felony?
                                </th>
                                <td class="small">{{ $bid->get->convicted }}
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          @if (@$auction->user_id == $auth_id)
                            @if (!@$auction->is_sold)
                              <form action="{{ route('agent.landlord.auction.bid.accept', $bid->id) }}" method="post">
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
            {{ qr_code(route('agent.landlord.auction', @$auction->id), 200) }}
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
  {{-- <script>
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
    </script> --}}
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
