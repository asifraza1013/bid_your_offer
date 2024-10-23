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
<!-- Modal -->
@if (@$auction->get->photo)
<div class="modal fade" id="lightbox" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close text-right p-2" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div id="indicators" class="carousel slide" data-interval="false">
        <ol class="carousel-indicators">
          @php
            $photo = json_decode($auction->get->photo);
          @endphp
          @foreach ($photo as $image)
            <li data-target="#indicators" data-slide-to="{{ $loop->iteration }}" class="active">
            </li>
          @endforeach
        </ol>
        <div class="carousel-inner">
          @php
            $i = 1;
          @endphp
          @foreach ($photo as $image)
            <div class="carousel-item {{ $i++ == 1 ? 'active' : '' }}">
              <img class="d-block w-100" src="{{ asset($image) }}" alt="First slide">
            </div>
          @endforeach

        </div>
        <a class="carousel-control-prev" href="#indicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#indicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>
  </div>
</div>
@endif
<!-- End  -->
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
            <h4>Marketing Materials:</h4>
            <hr>
            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 col-12 fw-bold mt-1 mb-1" data-toggle="modal" data-target="#lightbox">
                Property Photos:
                <!-- Main Video Baner  -->
                @php
                  $i_sr = 0;
                  $mediaImage = url('auction/images/noimage.png');
                  $photo = null;
                  if (isset($auction->get->photo)){
                    $photo = json_decode($auction->get->photo);
                    // dd($photo);
                  }
                  if (gettype($photo) == 'array') {
                      $photos = $photo;
                      $mediaImage = url(current($photos));
                  }
                @endphp
                <div class="col-sm-12 col-md-6 col-lg-8">
                  <img class="w-100" src="{{ asset(@$mediaImage) }}" data-target="#indicators"
                    data-slide-to="{{ $i_sr }}" alt="" />
                </div>
                <!-- Small Images  -->
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="row">
                    {{-- @dd(@$auction->get) --}}
                    @if ($photo)
                      @foreach ($photo as $image)
                        <div class="col-sm-4 col-md-6 col-lg-6 p-2">
                          <img class="w-100" src="{{ asset($image) }}" data-target="#indicators"
                            data-slide-to="{{ $i_sr++ }}" alt="" />
                        </div>
                      @endforeach
                    @else
                      <div class="col-sm-4 col-md-6 col-lg-6 p-2">
                        <img class="w-100" src="{{ asset($mediaImage) }}" data-target="#indicators"
                          data-slide-to="{{ $i_sr++ }}" alt="" />
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              @if (isset($auction->get->video) && $auction->get->video !== null)
                <div class="col-md-12 col-12 fw-bold mt-2 mb-1">
                  Property Video:
                  <span class="removeBold">
                    <video src="{{ asset($auction->get->video) }}" style="width:100%;height:29vh;"
                        controls autoplay></video>
                  </span>
                </div>
              @endif
              @if (isset($auction->get->note) && $auction->get->note !== null)
                <div class="col-md-12 col-12 fw-bold mt-2 mb-1">
                  Floor Plan:
                  @if (isset($auction->get->note) && $auction->get->note !== null && !is_array($auction->get->note))
                    <span class="removeBold">
                      <a href="{{ asset($auction->get->note) }}" class="d-block" download><img src="{{ asset($auction->get->note) }}" style="width:100px;height:130px;" /></a>
                    </span>
                  @endif
                </div>
              @endif
              @php
                $disclosure = json_decode($auction->get->disclosures);
              @endphp
              @if (isset($disclosure) && $disclosure !== null && is_array($disclosure))
                <div class="col-md-12 col-12 fw-bold mt-2 mb-1">
                  Addendums/Disclosure:
                  @if ($disclosure !== null && is_array($disclosure) && count($disclosure) > 0)
                  <div>
                    @foreach ($disclosure as $item)
                    <span class="removeBold">
                      <a href="{{ asset($item) }}" download><img src="{{ asset($item) }}" style="width:100px;height:130px;" /></a>
                    </span>
                    @endforeach
                  </div>
                  @endif
                </div>
              @endif
            </div>
            <hr>

            <h4>Description:</h4>
            <p class="card-text">{{ @$auction->get->description }}</p>
            <hr>

            <h4>Price and Terms:</h4>
            <div class="row" style="flex-wrap: wrap;">
              @if(isset($auction->get->price) && $auction->get->price != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Price:
                  <span class="removeBold">{{ @$auction->get->price }}</span>
                </div>
              @endif
              @if(isset($auction->get->list_price_per_sq) && $auction->get->list_price_per_sq != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> List Price Per Sqft:
                  <span class="removeBold">{{ @$auction->get->list_price_per_sq }}</span>
                </div>
              @endif
              @if(isset($auction->get->rentNow) && $auction->get->rentNow != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Rent Now Price:
                <span class="removeBold">{{ @$auction->get->rentNow }}</span>
              </div>
              @endif
              @if(isset($auction->get->rentNowSqft) && $auction->get->rentNowSqft != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Rent Now Price Per Sqft:
                  <span class="removeBold">{{ @$auction->get->rentNowSqft }}</span>
                </div>
              @endif
              @if(isset($auction->get->startingPrice) && $auction->get->startingPrice != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Starting Price:
                <span class="removeBold">{{ @$auction->get->startingPrice }}</span>
              </div>
              @endif
              @if(isset($auction->get->reservePrice) && $auction->get->reservePrice != null)
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Reserve Price:
                <span class="removeBold">{{ @$auction->get->reservePrice }}</span>
              </div>
              @endif
              @if(isset($auction->get->leaseDate) && $auction->get->leaseDate != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lease Availability Date:
                  <span class="removeBold">{{ @$auction->get->leaseDate }}</span>
                </div>
              @endif
              @if(isset($auction->get->leaseTime) && $auction->get->leaseTime != null)
                @php
                  $leaseTime = json_decode($auction->get->leaseTime);
                @endphp
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Acceptable Lease Duration:
                  @foreach ($leaseTime as $item)
                    <span class="removeBold">{{ $item !== 'Other' ? $item : $auction->get->other_lease_duration }}</span>
                  @endforeach
                </div>
              @endif
              @if(isset($auction->get->frequency) && $auction->get->frequency != null)
                @php
                  $frequency = json_decode($auction->get->frequency);
                @endphp
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Lease Amount Frequency:
                  @foreach ($frequency as $item)
                    <span class="removeBold">{{ $item }}</span>
                  @endforeach
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
              @if(isset($auction->get->required_at_move_in) && $auction->get->required_at_move_in != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Move-In Requirements:
                    <span class="removeBold">{{ $auction->get->required_at_move_in !== 'Other' ? $auction->get->required_at_move_in : $auction->get->leaseTermOther }}</span>
                </div>
              @endif
              @if(isset($auction->get->specialMoveOption) && $auction->get->specialMoveOption != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Offered Move in Specials:
                    <span class="removeBold">{{ $auction->get->specialMoveOption }}</span>
                  @if ($auction->get->specialMoveOption == 'Yes')
                    <span class="d-inline-block removeBold badge bg-secondary">{{$auction->get->specialMove}}</span>
                  @endif
                </div>
              @endif
            </div>
            <hr>

            <h4>Landlord Pre-Screening Terms:</h4>
            <div class="row" style="flex-wrap: wrap;">
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
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pet Fee Type:
                  <span class="removeBold">{{ @$auction->get->petsFund}}</span>
                </div>
              @endif
              @if(@$auction->get->offer_allowed_occupants != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Maximum Number of Occupants Allowed:
                  <span class="removeBold">{{ @$auction->get->offer_allowed_occupants !='Other'?@$auction->get->offer_allowed_occupants:@$auction->get->custom_occupants }}</span>
                </div>
              @endif  
              @if(@$auction->get->creditScore != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Acceptable Credit Score:
                  <span class="removeBold">{{ @$auction->get->creditScore }}</span>
                </div>
              @endif
              @if(@$auction->get->offer_min_net_income != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Minimum Household Net Income:
                  <span class="removeBold">{{ @$auction->get->offer_min_net_income }}</span>
                </div>
              @endif
              @if(@$auction->get->eviction != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Landlord Consideration of Tenants with Prior Evictions Within the Last 7 Years:
                  <span class="removeBold">{{ @$auction->get->eviction }}</span>
                </div>
              @endif
              @if(@$auction->get->offer_prior_felony != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Landlord Consideration of Tenants with Prior Felonies Within the Last 7 Years:
                  <span class="removeBold">{{ @$auction->get->offer_prior_felony }}</span>
                </div>
              @endif
            </div>
            <hr>

            <h4>Listing Information:</h4>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Address: 
                <span class="removeBold"> {{ @$auction->address }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> City: 
                <span class="removeBold">{{ @$auction->city }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> County: 
                <span class="removeBold">{{ @$auction->county }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> State: 
                <span class="removeBold">{{ @$auction->state }}</span>
              </div>
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
                @if (isset($auction->get->property_items))
                  @php
                    $property_items = json_decode($auction->get->property_items);
                  @endphp
                  @foreach ($property_items as $item)
                    <span class="d-inline-block removeBold badge bg-secondary">{{$item}}</span>
                  @endforeach
                @endif
              </div>
              @endif
              @if(isset($auction->get->leasePropOption) && @$auction->get->leasePropOption != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Leasing Space:
                  <span class="removeBold">{{ @$auction->get->leasePropOption }}</span>
                </div>
                @if ($auction->get->leasePropOption == 'Single Room' && isset($auction->get->singleRoom))
                  @php
                    $singleRoom = json_decode($auction->get->singleRoom);
                  @endphp
                  @if(isset($singleRoom[0]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> What is the size of the room the landlord intends to lease?
                    <span class="removeBold">{{$singleRoom[0] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[1]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Is there a private bathroom, or is it shared?
                    <span class="removeBold">{{ $singleRoom[1] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[2]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How much storage space is available?
                    <span class="removeBold">{{ $singleRoom[2] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[3]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Can tenants use common areas like the kitchen, living room, or backyard?
                    <span class="removeBold">{{ $singleRoom[3] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[4]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How is cleaning and maintenance of common areas managed?
                    <span class="removeBold">{{ $singleRoom[4] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[5]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Are tenants allowed to have guests, and if so, are there any restrictions?
                    <span class="removeBold">{{ $singleRoom[5] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[6]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How are maintenance issues handled?
                    <span class="removeBold">{{ $singleRoom[6] }}</span>
                  </div>
                  @endif
                  @if(isset($singleRoom[7]))
                  <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> How are the utilities split?
                    <span class="removeBold">{{ $singleRoom[7] }}</span>
                  </div>
                  @endif
                @endif
              @endif
              @if(isset($auction->get->propConditions) && @$auction->get->propConditions != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property Condition:
                  <span class="removeBold">{{ $auction->get->propConditions !== 'Other' ? $auction->get->propConditions : $auction->get->propOther }}</span>
                </div>
              @endif
            <hr>

            <h4>Interior Features:</h4>
              @if (@$auction->get->bedroom != null)
              <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Bedrooms: 
                <span class="removeBold">{{ @$auction->get->bedroom !="Other" ? $auction->get->bedroom : $auction->get->other_bedrooms }}</span>
              </div>
              @endif
              @if (@$auction->get->bathrooms != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i>Bathrooms:
                  <span class="removeBold">{{ $auction->get->bathrooms != "Other" ? $auction->get->bathrooms : $auction->get->other_bathrooms }}
                </div></span>
              @endif
              @if (@$auction->info('heated_sqft') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Heated Sqft:
                  <span class="removeBold">{{ @$auction->info('heated_sqft') }}</span>
                </div>
              @endif
              @if (@$auction->info('sqft_total') != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Total Sqft:
                  <span class="removeBold">{{ @$auction->info('sqft_total') }}</span>
                </div>
              @endif
              @if (@$auction->get->heated_source != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Heated SqFt Source:
                  <span class="removeBold">{{ @$auction->get->heated_source != 'Other' ? $auction->get->heated_source : $auction->get->otherSqft }}</span>
                </div>
              @endif
              @if(gettype(json_decode(@$auction->get->appliances)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Appliances:
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
              @if (@$auction->info('furnishings') != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Furnishings:
                  <span class="removeBold"> {{ @$auction->info('furnishings') }}</span>
                </div>
              @endif
              @if ($auction->get->amenities)
                @php
                  $amenities = json_decode($auction->get->amenities);
                @endphp
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Amenities or Property Features:
                  @foreach ($amenities as $item)
                    <span class="removeBold"> {{ $item }}</span>
                    @if ($item == 'Other' && isset($auction->get->otherAmenities))
                      <span class="d-inline-block removeBold  badge bg-secondary"> {{ $auction->get->otherAmenities }}</span>
                    @endif
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
              @if (@$auction->get->propFloors != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Number of Floors in the Property:
                  <span class="removeBold">{{@$auction->get->propFloors }}</span>
                </div>
              @endif
              @if (@$auction->get->floorNumber != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Floor Number:
                  <span class="removeBold">{{@$auction->get->floorNumber }}</span>
                </div>
              @endif
              @if (@$auction->get->totalFloors != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Number of Floors in the Entire Building:
                  <span class="removeBold">{{@$auction->get->totalFloors }}</span>
                </div>
              @endif
              @if (@$auction->get->building_elevator != null)
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Building Elevator:
                  <span class="removeBold">{{@$auction->get->building_elevator }}</span>
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
              @if(isset($auction->get->sewer) && gettype(json_decode(@$auction->get->sewer)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Sewer:
                      @foreach (json_decode(@$auction->get->sewer) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item != 'Other')
                              {{ $item }} 
                              @endif
                              @if($item == 'Other' && isset($auction->get->otherSewer))
                                  {{ $auction->get->otherSewer }} 
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
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Heating and Fuel:
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
            <hr>

            <h4>Room Details:</h4>
              @if(gettype(json_decode(@$auction->get->roomDimensions)) == 'array')
                <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Approximate Room Dimensions (Width x Length):
                    @foreach (json_decode(@$auction->get->roomDimensions) as $item)
                        <span class="removeBold">{{$item}}</span>
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
            <hr>
            
            <h4>Exterior Features:</h4>
              <div class="row" style="flex-wrap: wrap">
                @if ($auction->get->front_exposure && $auction->get->front_exposure != null)
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Front Exposure:
                    <span class="removeBold">{{@$auction->get->front_exposure }}</span>
                  </div>
                @endif
              </div>
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
                      <span class="removeBold badge bg-secondary">{{ $item !== 'Other' ? $item : $auction->get->exteriorFeatureOther }}</span>
                      @endforeach
                  </div>
              @endif
              @if(gettype(json_decode(@$auction->get->other_structures)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Other Structures:
                      @foreach (json_decode($auction->get->other_structures) as $item)
                      <span class="removeBold badge bg-secondary">{{ $item !== 'Other' ? $item : $auction->get->structuresOther }}</span>
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
              @if(gettype(json_decode(@$auction->get->road_surface_type)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Road Surface Type:
                      @foreach (json_decode(@$auction->get->road_surface_type) as $item)
                          <span class="removeBold badge bg-secondary">
                              @if($item !== 'Other')
                                {{ $item }} 
                              @else
                                {{ $auction->get->roadSurfaceOther }}
                              @endif
                          </span>
                      @endforeach
                  </div>
              @endif
              @if (isset($auction->get->garage) && $auction->get->garage != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Garage Spaces:
                  <span class="removeBold"> {{ @$auction->get->garage !== 'Yes' ?  $auction->get->garage : $auction->get->garageOther}}</span>
                </div>
              @endif
              @if (isset($auction->get->carport) && $auction->get->carport != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Carport:
                  <span class="removeBold"> {{ $auction->get->carport !== 'Yes' ? $auction->get->carport : $auction->get->carportOther }}</span>
                </div>
              @endif
              @if (isset($auction->get->poolOpt) && $auction->get->poolOpt != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pool:
                  <span class="removeBold"> {{ $auction->get->poolOpt !== 'Yes' ? $auction->get->poolOpt : $auction->get->pool }}</span>
                </div>
              @endif
              @if (isset($auction->get->viewOption) && $auction->get->viewOption != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> View:
                  @foreach (json_decode($auction->get->viewOption) as $item)
                    <span class="removeBold"> {{ $item}}</span>
                    @if ($item == 'Yes')
                      @if (isset($auction->get->view))
                        @foreach (json_decode($auction->get->view) as $item2)
                          @if ($item2 !== 'Other')
                            <span class="d-inline-block removeBold badge bg-secondary"> {{ $item2}}</span>
                          @else
                            @if (isset($auction->get->viewOther))
                              <span class="d-inline-block removeBold badge bg-secondary"> {{ $auction->get->viewOther }}</span>
                            @endif
                          @endif                          
                        @endforeach
                      @endif
                    @endif
                  @endforeach
                </div>
              @endif
            <hr>

            <h4>Water and Dock Information:</h4>
              <div class="row" style="flex-wrap: wrap">
                @if(gettype(json_decode(@$auction->get->water_access)) == 'array')
                  <div class="col-md-12 fw-bold"><i class="far fa-check-square"></i> Water Access:
                      @foreach (json_decode(@$auction->get->water_access) as $item)
                          <span class="removeBold badge bg-secondary">
                              {{ $item }} 
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
                @if (isset($auction->get->has_dock) && $auction->get->has_dock != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Dock:
                  <span class="removeBold">{{ $auction->get->has_dock }}</span>
                  @if ($auction->get->has_dock == 'Yes' && isset($auction->get->dock))
                    @foreach (json_decode($auction->get->dock) as $item)
                      <span class="removeBold badge bg-secondary">{{ $item }}</span>
                      @if ($item == 'Other' && isset($auction->get->dockDescription))
                        <span class="removeBold badge bg-secondary">{{ $auction->get->dockDescription }}</span>
                      @endif
                    @endforeach
                  @endif
                </div>
                @endif
              </div>
            <hr>

            <h4>Land Information:</h4>
            <div class="row" style="flex-wrap: wrap">
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
            </div>
            <hr>

            <h4>HOA and Condo Association Information:</h4>
              <div class="row" style="flex-wrap: wrap">
                @if (isset($auction->get->has_hoa))
                <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Does the property have an HOA, condo association, master association, and/or
                  community fee?
                  <span class="removeBold">{{ $auction->get->has_hoa }}</span>
                </div>
                @if ($auction->get->has_hoa == 'Yes')
                  @if (isset($auction->get->assocRequired))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association Approval Required:
                    <span class="removeBold">{{ $auction->get->assocRequired }}</span>
                  </div>
                  @endif       
                  @if (isset($auction->get->oldHouse))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Housing For Older Persons:
                    <span class="removeBold">{{ $auction->get->oldHouse }}</span>
                  </div>
                  @endif             
                  @if (isset($auction->get->hoa_fee_requirenment))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> HOA Fee Requirement:
                    <span class="removeBold">{{ $auction->get->hoa_fee_requirenment }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->feeReq))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> How much is the HOA Fee?
                    <span class="removeBold">{{ $auction->get->feeReq }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->paySchedule))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> HOA Payment Schedule:
                    <span class="removeBold">{{ $auction->get->paySchedule }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->association_approval_fee))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association Approval Fee for Tenants:
                    <span class="removeBold">{{ $auction->get->association_approval_fee }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->parking_fee_for_tenants))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Parking Fee For Tenants:
                    <span class="removeBold">{{ $auction->get->parking_fee_for_tenants }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->association_security_deposit))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association Security Deposit Fee for Tenant:
                    <span class="removeBold">{{ $auction->get->association_security_deposit }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->other_association_fee))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Other Association Fees for Tenants:
                    <span class="removeBold">{{ $auction->get->other_association_fee }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->association_name))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association/Manager Name:
                    <span class="removeBold">{{ $auction->get->association_name }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->association_phone))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association/Manager Phone:
                    <span class="removeBold">{{ $auction->get->association_phone }}</span>
                  </div>
                  @endif  
                  @if (isset($auction->get->association_email))
                  <div class="col-md-12 fw-bold"><i class="fa-regular fa-check-square"></i> Association/Manager Email:
                    <span class="removeBold">{{ $auction->get->association_email }}</span>
                  </div>
                  @endif  
                @endif
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
              </div>
            <hr>

            
            @if (@$auction->get->disclaimer != null)
            <h4>Legal Disclaimers:</h4>
            <div class="col-md-12 fw-bold">
              <span class="removeBold">{{ @$auction->get->disclaimer }}</span>
            </div>
            <hr>
            @endif
            

            @if (@$auction->get->driving_directions != null)
            <h4>Driving Directions:</h4>
            <div class="col-md-12 fw-bold">
                <span class="removeBold">{{ @$auction->get->driving_directions }}</span>
              </div>
              <hr>
            @endif
            

            @if (@$auction->get->compensationYes != null)
            <h4>Tenant’s Agent Compensation:</h4>
            <div class="col-md-12 fw-bold">
                <span class="removeBold">{{ @$auction->get->compensationYes }}</span>
              </div>
              <hr>
            @endif

            @php
              $user = $auction->user()->first();
            @endphp

            @if ($user->user_type == 'agent')
              <h4>Listing Agent Information:</h4>
            @else
              <h4>Landlord’s Information:</h4>
            @endif

            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> First Name:
                <span class="removeBold">{{ @$auction->info('first_name') }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Last Name:
                <span class="removeBold"> {{ @$auction->info('last_name') }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Phone Number:
                <span class="removeBold">{{ @$auction->info('agent_phone') }}</span>
              </div>
              <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Email:
                <span class="removeBold">{{ @$auction->info('agent_email') }}</span>
              </div>
              @if($user->user_type === 'agent')
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Brokerage:
                  <span class="removeBold">{{ @$auction->info('agent_brokerage') }}</span>
                </div>
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Real Estate License #:
                  <span class="removeBold">{{ @$auction->info('agent_license_no') }}</span>
                </div>
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> NAR Member ID (NRDS ID):
                  <span class="removeBold">{{ @$auction->info('agent_mls_id') }}</span>
                </div>
              @endif
            </div>            
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
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 rightCol">
        <h1>{{ @$auction->address }}</h1>
        <hr>
        @inject('carbon', 'Carbon\Carbon')
        @php
          $lowest_bid_price = $auction->bids->min('price');
          $lowest_bidder = @$auction->bids->where('price', $lowest_bid_price)->first();
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
                        ${{ $bid->get->offered_price }} </div>
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
                            {{-- <thead>
                              <tr>
                                <th colspan="2">Tenant/Tenant’s Agent Info</th>
                              </tr>
                            </thead> --}}
                            <tbody>
                              <tr>
                                <th class="small">First Name</th>
                                <td class="small">{{ $bid->get->first_name }}</td>
                              </tr>
                              <tr>
                                <th class="small">Offered Price:</th>
                                <td class="small">${{ $bid->get->offered_price }}</td>
                              </tr>
                              <tr>
                                <th class="small">Offered Lease Length:</th>
                                @if (isset($bid->get->lease_terms))
                                  @php
                                    $data = json_decode($bid->get->lease_terms, true);
                                  @endphp
                                  @if (isset($data) && is_array($data) && count($data) > 0)
                                    @foreach ($data as $item)
                                      <td class="small">{{ $item !== 'Other' ? $item :  $bid->get->price}}</td>
                                    @endforeach
                                  @endif
                                @endif
                              </tr>
                              <tr>
                                <th class="small">Offered Lease Start Date:</th>
                                <td class="small">{{ $bid->get->start_date }}</td>
                              </tr>
                              <tr>
                                <th class="small">Offered Days Until the Lease Start Date:</th>
                                <td class="small">{{ $bid->get->days_until_start_date }}</td>
                              </tr>
                              <tr>
                                <th class="small">Acceptable Real Estate Agent Commission:</th>
                                <td class="small">{{ $bid->get->tenant_requests_commission_amount !== 'Other' ? $bid->get->tenant_requests_commission_amount : $bid->get->tenant_requests_commission_amount_other }}</td>
                              </tr>
                              @if ($auction->get->auction_type == 'Traditional Listing')
                                <tr>
                                  <th class="small">Offer Expires</th>
                                  <td class="small">{{ $bid->get->offer_expiry }}</td>
                                </tr>
                              @endif
                              <tr>
                                <th class="small">Additional Details or Countered Terms:</th>
                                <td class="small">{{ $bid->get->additionalInfo}}</td>
                              </tr>
                            </tbody>
                          </table>

                          {{-- <table class="table table-bordered">
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
                                @endif
                              </tr>
                              <tr>
                                <th class="small">Security Deposit</th>
                                <td class="small">
                                  ${{ $bid->get->securityDeposit }}</td>
                              </tr>
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
                          </table> --}}

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
