@extends('layouts.main')
@push('styles')
  <!-- //Listing Description css  -->
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

    .fa-dollar,
    .fa-percent {
      padding: 0 20px;
      background: #facd34;
      color: #fff;
      border: 0;
      font-weight: 700 !important;
      line-height: 39px !important;
      margin-right: -5px;
      z-index: 1;
      border-radius: 3px 0 0 3px;
    }

    .form-control,
    .form-select {
      border-radius: 0.25rem;
      box-shadow: inset 0 1px 2px 0 rgb(66 71 112 / 12%);
      border-radius: 0.25rem;
      background-color: #fafafb;
      margin-bottom: 15px;
    }
  </style>
  <style>
    ul {
      --icon-size: 1em;
      --gutter: .5em;
      padding: 0 0 0 calc(var(--icon-size) + 2em);
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
          @if (@$auction->video_file)
            <div class="row">
              <div class="col-md-12">
                <video class="video-fluid" controls playsinline muted style="width: 100%;">
                  <source src="{{ asset('auction/videos/' . @$auction->video_file) }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            </div>
          @endif

          @if (@$auction->audio_file)
            <div class="row">
              <div class="col-md-12">
                <audio class="audio-fluid" controls>
                  <source src="{{ asset('auction/audios/' . @$auction->audio_file) }}" type="audio/mp3">
                  Your browser does not support the audio tag.
                </audio>
              </div>
            </div>
          @endif

          <div class="card-header">
            <h5>Desired Features</h5>
          </div>
          <div class="card-body">
            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i> <span
                  class="fw-bold">Cities:</span>
                @php
                  $city_decode = json_decode($auction->get_meta('cities'));
                @endphp
                @foreach ($city_decode as $city)
                  {{ $city }},
                @endforeach

              </div>
              @if ($auction->get_meta('counties') != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold"> Counties:</span>
                  @foreach (json_decode($auction->get_meta('counties')) as $county)
                    {{ $county }},
                  @endforeach
                </div>
              @endif
              {{-- @dd($auction->get_meta('state')); --}}
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  State:</span>
                {{ substr($auction->get_meta('state'), 2, -2) }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Listing Date:</span>
                {{ date('Y-m-d', strtotime($auction->get->listing_date)) }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Expiration Date:</span>
                {{ date('Y-m-d', strtotime($auction->get->expiration_date)) }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Listing Type:</span>
                {{ $auction->get->auction_type }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Title of Listing:</span>
                {{ $auction->get->title_of_listing }}
              </div>

              @if (@$auction->get->bedrooms != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold"> Minimum
                    Bedrooms
                    Needed: </span>
                  {{ @$auction->get->bedrooms }}
                </div>
              @endif
              @if (@$auction->get->bathrooms != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Minimum Bathrooms Needed:</span>
                  {{ @$auction->get->bathrooms }}
                </div>
              @endif

              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Acceptable Property Styles:</span>({{ @$auction->get->property_type }})<br>
                @foreach (@$auction->get->property_items as $item)
                  @if (@$item != null)
                    <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                  @endif
                @endforeach
              </div>
              @if (@$auction->get->special_sale != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Acceptable Special Sales Provisions:</span><br>
                  @if (gettype($auction->get->special_sale) == 'array')
                    @foreach (@$auction->get->special_sale as $item)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                    @endforeach
                  @else
                    {{ @$auction->get->special_sale }}
                  @endif
                </div>
              @endif
              @if (@$auction->get->propsCondition != null || @$auction->get->custom_props_condition != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Acceptable Property Conditions:</span><br>
                  @if (gettype(@$auction->get->propsCondition) == 'array')
                    @foreach (@$auction->get->propsCondition as $props)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$props }}</span>
                    @endforeach
                  @else
                    <span
                      class="d-inline-block bg-secondary text-white  px-2 rounded my-1 ">{{ @$auction->get->custom_props_condition }}</span>
                  @endif
                </div>
              @endif
              @if (@$minimum_heated_sqft != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa fa-bath"></i><span class="fw-bold">
                    Minimum Heated Sqft Needed: :
                  </span>
                  {{ @$auction->get->minimum_heated_sqft }}
                </div>
              @endif
              @if (@$total_acreage != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Minimum Total Acreage Needed:</span>
                  {{ @$auction->get->total_acreage }}
                </div>
              @endif
              @if (@$auction->get->carportOptions != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Carport Needed:</span>({{ @$auction->get->carportOptions }})<br>
                  @if (gettype(@$auction->get->carportOptions) == 'array')
                    @foreach ($auction->get->carportOptions as $item)
                      {{ @$item }}
                    @endforeach
                  @elseif(@$auction->get->carportOptions == 'Yes')
                    {{ @$auction->get->carportCustom }}
                  @endif
                </div>
              @endif
              @if (@$auction->get->garageOptions != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Garage Needed:</span>({{ @$auction->get->garageOptions }})<br>
                  @if (gettype(@$auction->get->garageOptions) == 'array')
                    @foreach ($auction->get->garageOptions as $item)
                      {{ @$item }}
                    @endforeach
                  @elseif(@$auction->get->garageOptions == 'Yes')
                    {{ @$auction->get->garageCustom }}
                  @endif
                </div>
              @endif
              @if (@$auction->get->garageOption != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Garage/Parking Featured Needed:</span>({{ @$auction->get->garageOption }})<br>
                  @if (gettype(@$auction->get->garage_parking) == 'array')
                    @foreach ($auction->get->garage_parking as $item)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                    @endforeach
                  @endif
                  @if (@$auction->get->other_garage != null)
                    <span
                      class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$auction->get->other_garage }}</span>
                  @endif
                </div>
              @endif
              @if (@$auction->get->poolOptions != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Pool Needed:</span>({{ @$auction->get->poolOptions }})<br>
                  @if (gettype(@$auction->get->poolCustom) == 'array' && @$auction->get->poolOptions == 'Yes')
                    @foreach ($auction->get->poolCustom as $item)
                      {{ @$item }}
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->prefrenceOptions != null || @$auction->get->prefrence != 'null')
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    View Preference Needed :</span>({{ @$auction->get->prefrenceOptions }})<br>
                  @if (gettype(@$auction->get->prefrence) == 'array')
                    @foreach ($auction->get->prefrence as $item)
                      @if ($item == 'Other')
                        @continue
                      @endif
                      <span class="d-inline-block bg-secondary text-white px-2 rounded my-1">
                        {{ $item }}
                      </span>
                    @endforeach
                  @endif
                  @if (@$auction->get->preferenceOther != null)
                    <span
                      class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$auction->get->preferenceOther }}</span>
                  @endif
                </div>
              @endif
              @if (@$auction->get->petOptions != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Pets:</span>
                  {{ @$auction->get->petOptions }}
                </div>
              @endif
              @if (@$auction->get->petsNumber != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Number of Pet(s):</span>
                  {{ @$auction->get->petsNumber }}
                </div>
              @endif
              @if (@$auction->get->petsType != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Type of Pet(s):</span>
                  {{ @$auction->get->petsType }}
                </div>
              @endif
              @if (@$auction->get->petsWeight != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Weight of Pet(s):</span>
                  {{ @$auction->get->petsWeight }}
                </div>
              @endif
              @if (@$auction->get->purchasing_props != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Eligibility/Interest in Leasing in 55-and-Over Communities: </span>
                  {{ @$auction->get->purchasing_props }}
                </div>
              @endif
              @if (@$auction->get->non_negotiable_terms != 'null' && @$auction->get->non_negotiable_terms != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Non-Negotiable Amenities and Property Features:
                  </span>({{ @$auction->get->has_non_negotiable_terms }})<br>
                  @if (gettype(@$auction->get->non_negotiable_terms) == 'array')
                    @foreach (@$auction->get->non_negotiable_terms as $item)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                    @endforeach
                  @else
                    <span
                      class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$auction->get->has_non_negotiable_terms }}</span>
                  @endif
                </div>
              @endif
              @if (@$auction->get->commissionOpt != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    How much will the Buyer compensate their agent? </span><br>
                  @if (gettype(@$auction->get->commissionOpt) == 'array' && !in_array('Other', @$auction->get->commissionOpt))
                    @foreach (array_filter(@$auction->get->commissionOpt) as $item)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                    @endforeach
                  @else
                    <span>{{ @$auction->get->OtherComOptions }}</span>
                  @endif

                </div>
              @endif
            </div>
            @if (@$auction->get->aspect_hiring_agent != null)
              <hr>
              <h4>Desired Price and Terms:</h4>
              {{-- @if (@$auction->get->garageOption != null) --}}
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Maximum Budget:</span>
                <span>{{ @$auction->get->maxBudget }}</span>
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i>
                @php
                  $financingData = @$auction->get->financings;
                @endphp

                <span class="fw-bold">Offered Financing/Currency:</span>
                <div class="row">
                  <div class="col-md-12">
                    @if ($financingData != null)
                      @foreach ($financingData as $key => $item)
                        <ul>
                          <li style="font-size: 16px; margin-top:5px;">{{ $item }}</li>
                        </ul>
                        @if ($item == 'Cash')
                          @foreach (@$auction->get->financingOptionsCash as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif (
                            $item == 'Conventional' ||
                                $item == 'Jumbo' ||
                                $item == 'VA' ||
                                $item == 'No-Doc' ||
                                $item == 'Non-QM' ||
                                $item == 'FHA' ||
                                $item == 'USDA')
                          @foreach (array_filter(@$auction->get->financingOptionsConventional) as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif ($item == 'Seller Financing')
                          @foreach (@$auction->get->financingOptionsSeller as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif ($item == 'Assumable')
                          @foreach (@$auction->get->financingOptionsAssumble as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif ($item == 'Exchange/Trade')
                          @foreach (@$auction->get->financingOptionsTrade as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif ($item == 'Lease Option' || $item == 'Lease Purchase')
                          @foreach (@$auction->get->financingOptionsLease as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'Cryptocurrency')
                          @foreach (@$auction->get->financingOptionsCrypto as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'NFT')
                          @foreach (@$auction->get->financingOptionsNft as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @elseif($item == 'Other')
                          @foreach (@$auction->get->financingOther as $key => $item)
                            <span
                              class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                          @endforeach
                        @endif
                      @endforeach
                    @endif
                  </div>

                </div>

              </div>
              {{-- @endif --}}
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Offered Purchase Timeframe:</span>
                {{ @$auction->get->buying_timeframe }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Offered Timeframe for the Buyer Agency Agreement:</span>
                {{ @$auction->get->timeframe }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Offered Commission to Buyer’s Agent if Not Included in Listing:</span>
                <ul>
                  @if (@$auction->get->commission != null && @$auction->get->commission != 'Other')
                    <li style="font-size: 16px; margin-top:5px;">{{ @$auction->get->commission }}</li>
                    @if (@$auction->get->commissionOpt == 'Other')
                      {{ @$auction->get->OtherComOptions }}
                    @else
                      <span
                        class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$auction->get->commissionOpt }}</span>
                    @endif
                  @endif
                  @if (@$auction->get->commission == 'Other')
                    <li style="font-size: 16px; margin-top:5px;">{{ @$auction->get->commission }}</li>
                    <span
                      class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$auction->get->OtherCommission }}</span>
                  @endif
                </ul>
                @if (gettype(@$auction->get->OtherCommission) == 'array')
                  @foreach (array_filter(@$auction->get->commission) as $item)
                    <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                  @endforeach
                @endif
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Buyer Requests Concession from Agent:</span>
                {{ @$auction->get->concession }}
              </div>
              @if (@$auction->get->concession != null)
                <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                    class="fw-bold">
                    Buyer Requests Concession from Agent: </span>{{ @$auction->get->concession }}<br>
                  @if (gettype(@$auction->get->concession) == 'array')
                    @foreach (array_filter(@$auction->get->concession) as $item)
                      <span class="d-inline-block bg-secondary text-white  px-2 rounded my-1">{{ @$item }}</span>
                    @endforeach
                  @endif

                </div>
              @endif
            @endif
            @if (@$auction->get->aspect_hiring_agent != null)
              <hr>
              <h4>Buyer’s Info </h4>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  First Name:</span>
                {{ @$auction->get->timeframe }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Last Name:</span>
                {{ @$auction->get->timeframe }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Email:</span>
                {{ @$auction->get->timeframe }}
              </div>
              <div class="col-md-12 col-12 pt-2 removeBold"><i class="fa-regular fa-check-square"></i><span
                  class="fw-bold">
                  Phone Number:</span>
                {{ @$auction->get->timeframe }}
              </div>
              <div class="row">
                <div class="col-6 form-group">
                  <label class="fw-bold mt-1">Video:</label><br>
                  <video style="width:100%; height:224px;" controls autoplay="true">
                    <source src="{{ asset(@$auction->get->video) }}" type="video/mp4">
                    <source src="{{ asset(@$auction->get->video) }}" type="video/ogg">
                    Your browser does not support the video tag.
                  </video>
                </div>
                <div class="form-group col-6">
                  <label class="fw-bold">Photo:</label><br>
                  <img src="{{ asset(@$auction->get->photo) }}" style="width:100%; height:224px;" />
                </div>
              </div>
            @endif
            @if (@$auction->get->aspect_hiring_agent != null)
              <hr>
              <h4>Most Important Aspects the Buyer Considers When Hiring a Real Estate Agent</h4>
              <div class="row">
                <span class="removeBold">
                  {{ @$auction->get->aspect_hiring_agent }}
                </span>
              </div>
            @endif
            <hr>
            @if (@$auction->get->additional_details != null)
              <h4>Additional Details</h4>
              <div class="row">
                <span class="removeBold">
                  {{ @$auction->get->additional_details }}
                </span>
              </div>
            @endif
            <hr>
            <h4>Services the Buyer Requests from Their Agent</h4>
            <div class="row">
              @if (gettype(@$auction->get->services) == 'array')
                <ul class="px-5">
                  @foreach (@$auction->get->services as $val)
                    @if ($val == 'Other')
                      @continue
                    @endif
                    <li style="font-size: 16px; margin-top:5px;">
                      <span class="removeBold">
                        {{ $val }}
                      </span>
                    </li>
                  @endforeach
                  @if (in_array('Other', @$auction->get->services))
                    <li style="font-size: 16px; margin-top:5px;">
                      <span class="removeBold">
                        {{ @$auction->get->other_services }}
                    </li>
                    <span class="removeBold">
                  @endif
                </ul>
              @endif
            </div>
          </div>
        </div>
        @inject('auctionUser', 'App\Models\User')
        @php
          $auser = $auctionUser::find(@$auction->user_id);
        @endphp
        <!-- Review  -->
        <div class="card review">
          <div class="card-body d-flex align-items-center">
            <div class="left d-flex align-items-center">
              <img class="w-25"
                src="{{ $auser->avatar ? asset('images/avatar/' . $auser->avatar) : 'https://ppt1080.b-cdn.net/images/avatar/none.png' }}"
                alt="">
              <div>
                <p class="mb-0"><a href="{{ route('author', [$auser->id]) }}"><b>User
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
                <p class="mb-0 opacity-50">{{ $auser->name }}last online 5 days ago.</p>
              </div>
            </div>
            <div class="right text-center">
              <a href="{{ route('author', [$auser->id]) }}"><button class="btn">Message</button></a>
              <a href="{{ route('author', [$auser->id]) }}"><button class="btn">View Profile</button></a>
            </div>
          </div>
        </div>
        <!-- End  -->
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 rightCol">
        <h1>{{ @$auction->title }}</h1>
        <hr>
        @inject('carbon', 'Carbon\Carbon')
        @php
          if (@$data->get->expiration_date) {
              $start = $carbon::now();
              $end = $carbon::parse($data->get->expiration_date);

              // Check the values of $start and $end for debugging

              $diff = $end->diffInDays($start);
              // Output the difference for debugging purposes
          }
        @endphp
        @if (@$data->get->expiration_date)
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
          $lowest_bid_price = @$auction->bids->min('brokerage') ?? @$auction->get->concession;
          $lowest_bid_price =
              $lowest_bid_price < @$auction->get->concession ? $lowest_bid_price : @$auction->get->concession;
          $lowest_bidder = @$auction->bids->where('brokerage', $lowest_bid_price)->first();
          $my_bid = @$auction->bids->where('user_id', $auth_id)->first();
        @endphp
        @if (@$auction->user_id != $auth_id)
          <a href="{{ route('auction-chat', ['buyer-agent', $auction->id]) }}" class="btn btn-success w-100 mb-2">
            <i class="fa-solid fa-paper-plane"></i> Send Message</a>
        @endif
        @if ($auth_id)
          @if (in_array(auth()->user()->user_type, ['agent']))
            <button class="btn w-100"
              onclick="javascript:window.location='{{ route('agent.buyer.agent.auction.bid', @$auction->id) }}';"
              {{ $my_bid || @$auction->user_id == $auth_id ? 'disabled' : '' }}>
              <span class="bid">Bid Now </span>
              <span class="badge bg-light float-end text-dark">{{ @$auction->get->buyer_budget }}</span>
              @if (@$auction->is_sold)
                <span class="badge bg-danger">Sold</span>
              @endif
              {{-- {{$res}} --}}
            </button>
          @endif
        @else
          <a href="{{ route('login') }}">
            <button class="btn w-100">
              <span class="bid">Login for Bid </span>
              <span class="badge bg-light float-end text-dark">{{ @$auction->get->buyer_budget }}</span>
            </button>
          </a>
        @endif
        <!-- Highest Bider   -->
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
                  {{-- @dd(@$bid->get) --}}
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
                        {{-- ${{ number_format($bid->brokerage, 0, '.', '') }} --}} </div>
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
                          {{-- @dd(@$bid->get) --}}
                          <p class="fw-bold d-flex justify-content-between small">First Name:
                            <span class="removeBold">{{ @$bid->get->first_name }}</span>
                          </p>
                          <p class="fw-bold d-flex justify-content-between small">Buyer Agency Agreement Timeframe:
                            <span class="removeBold">{{ @$bid->get->terms_of_contract }}</span>
                          </p>
                          <p class="fw-bold d-flex justify-content-between small">Commission Offered:
                            <span class="removeBold">{{ @$bid->get->buyer_credit_at_closing ?: 'N/A' }}</span>
                          </p>

                          {{-- @if ($bid->note_public || @$auction->user_id == $auth_id) --}}
                          @if (@$bid->get->note != '' && @$bid->get->note != 'null')
                            <p class="">
                              @if (gettype(@$bid->get->note) == 'array')
                                @foreach (@$bid->get->note as $note)
                                  <a href="{{ asset('auction/files/' . @$note) }}"
                                    class="btn btn-secondary btn-sm mb-1" download style="width: 100%;"
                                    target="_blank">Download
                                    Letter
                                  </a>
                                  <br>
                                @endforeach
                              @endif
                            </p>
                          @endif
                          {{-- @endif --}}

                          @if (@$auction->user_id == $auth_id)
                            @if (!@$auction->is_sold)
                              <form action="{{ route('buyer.acceptBABid') }}" method="post">
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
            {{ qr_code(route('buyer.view-auction', @$auction->id), 200) }}
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.9.0/timer.jquery.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script>
    // var durations = '2d01h43m45s';
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
@endpush
