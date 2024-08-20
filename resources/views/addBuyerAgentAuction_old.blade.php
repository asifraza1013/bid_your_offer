@extends('layouts.main')

{{-- @php
    $getState=collect($countries)->where('name','algeria')->first();
    dd($getState->states->first()->name);
    dd($getState);
@endphp
@foreach ($countries as $country)


{{ dd($country->name); }}
@endforeach --}}

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <style>
    .dropdown-menu {
      width: 100%;
    }

    .choices__list {
      z-index: 999;
    }

    .wizard-steps-progress {
      height: 5px;
      width: 100%;
      background-color: #CCC;
      position: absolute;
      top: 0;
      left: 0;
    }

    .steps-progress-percent {
      height: 100%;
      width: 0%;
      background-color: #11b7cf;
    }

    .wizard-step {
      display: none;
    }

    .wizard-step.active {
      display: block;
    }

    label.warning {
      color: #f00;
    }

    ::placeholder {
      color: #cacaca !important;
      opacity: 1;
      /* Firefox */
    }

    :-ms-input-placeholder {
      /* Internet Explorer 10-11 */
      color: #cacaca !important;
    }

    ::-ms-input-placeholder {
      /* Microsoft Edge */
      color: #cacaca !important;
    }

    .hide_arrow::-webkit-outer-spin-button,
    .hide_arrow::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    .hide_arrow {
      -moz-appearance: textfield;
    }

    .input-cover {
      align-items: center;
      position: relative;
    }

    .input-cover .input-icon {
      position: absolute;
      left: 10px;
      font-size: 30px;
      color: #11b7cf;
    }

    .input-cover .form-control {
      padding-left: 50px;
    }

    .form-control {
      min-height: 50px;
    }

    .form-group {
      margin-top: 15px;
    }

    .options-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
    }

    .option-container {
      align-items: center;
      cursor: pointer;
      display: flex;
      flex-direction: row;
      align-items: center;
      padding: 15px;
      margin: 10px;
      margin-left: 0;
      margin-bottom: 0;
    }

    .option-container.active {
      border-color: #006e9f;
      color: #006e9f;
    }

    .option-container .option-icon {
      font-size: 40px;
      color: #11b7cf;
    }

    .option-container .option-text {
      padding-left: 10px;
    }

    .text-error {
      width: 100%;
    }

    .text-error {
      border-color: rgba(var(--bs-danger-rgb), var(--bs-text-opacity)) !important;
    }

    .grid-picker {
      width: 100%;
      height: 0px;
      visibility: hidden;
    }
  </style>
@endpush
@section('content')
  {{-- @if ($errors->any())
<h4>{{$errors->first()}}</h4>
@endif --}}

  @php
    $yes_or_nos = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
  @endphp
  <div class="container pt-5 pb-5">
    <div class="card">
      <div class="row">
        <div class="col-12 p-4">
          <form class="p-4 pt-0 mainform" action="{{ route('buyer.add-auction') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @push('scripts')
              <script>
                $(function() {
                  $('#working_with_agent').change(function() {
                    var val = $(this).val();
                    if (val == "Yes") {
                      $('.wizard-step-next').attr("disabled", "disabled");
                      $('.yes_message').text(
                        "This is a service for buyers that are not currently working with a licensed agent."
                      );
                    } else {
                      $('.wizard-step-next').removeAttr("disabled");
                      $('.yes_message').text("");
                    }
                  });
                });
              </script>
            @endpush
            <div class="container">
              <h4 class="title">
                Hire Buyer's Agent auction
              </h4>
              <div class="wizard-steps-progress">
                <div class="steps-progress-percent"></div>
              </div>
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">Is the buyer currently represented by another agent?</label>
                  <select class="grid-picker" name="working_with_agent" id="working_with_agent"
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($yes_or_nos as $yes_or_no)
                      <option value="{{ $yes_or_no['name'] }}" data-target="{{ $yes_or_no['target'] }}"
                        class="card flex-row fw-bold" style="width:calc(33.3% - 10px);"
                        data-icon='<i class="{{ $yes_or_no['icon'] }}"></i>'>
                        {{ $yes_or_no['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="yes_message text-danger" style="font-size:18px; font-weight:bold;"></label>
                </div>
              </div>

              {{-- <div class="wizard-step">
                                <div class="form-group">
                                    <label class="fw-bold">
                                        Is Buyer interested in Residential or Commercial?
                                    </label>
                                    <div>
                                        @php
                                            $interested_in = [['name' => 'Residential', 'icon' => '<i class="fa-solid fa-house-chimney-window"></i>', 'target' => ''], ['name' => 'Commercial', 'icon' => '<i class="fa-solid fa-hotel"></i>', 'target' => '']];
                                        @endphp
                                        <select name="interested_in" id="interested_in" class="grid-picker"
                                            style="justify-content: flex-start;" required>
                                            <option value=""></option>
                                            @foreach ($interested_in as $item)
                                                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                                                    class="card flex-row fw-bold" style="width:calc(33.3% - 10px);"
                                                    data-icon='{{ $item['icon'] }}'>
                                                    {{ $item['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}

              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">
                    Auction Type:
                  </label>
                  <div>
                    @php
                      $auction_types = [['name' => 'Auction (Timer)', 'icon' => '<i class="fa-regular fa-clock"></i>', 'target' => ''], ['name' => 'Traditional (No Timer)', 'icon' => '<i class="fa-regular fa-circle-xmark"></i>', 'target' => '']];
                    @endphp
                    <select name="auction_type" id="auction_type" class="grid-picker" style="justify-content: flex-start;"
                      onchange="changeAuctionType(this.value);" required>
                      <option value=""></option>
                      @foreach ($auction_types as $item)
                        <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                          class="card flex-row fw-bold" style="width:calc(33.3% - 10px);" data-icon='{{ $item['icon'] }}'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group auction_length_cover">
                  <label class="fw-bold">
                    Auction Length:
                  </label>
                  <div>
                    @php
                      $auction_lengths = [['name' => '1 Day', 'class' => 'normal-length'], ['name' => '3 Days', 'class' => 'normal-length'], ['name' => '5 Days', 'class' => 'normal-length'], ['name' => '7 Days', 'class' => 'normal-length'], ['name' => '10 Days', 'class' => 'normal-length'], ['name' => '14 Days', 'class' => 'normal-length'], ['name' => '21 Days', 'class' => 'normal-length'], ['name' => '30 Days', 'class' => 'normal-length'], ['name' => '45 Days', 'class' => 'normal-length'], ['name' => '60 Days', 'class' => 'normal-length'], ['name' => '75 Days', 'class' => 'normal-length'], ['name' => '90 Days', 'class' => 'normal-length'], ['name' => 'No time limit', 'class' => 'traditional-length']];
                    @endphp
                    <select name="auction_length" id="auction_length" class="auction_length grid-picker"
                      style="justify-content: flex-start;" required>
                      <option value=""></option>
                      @foreach ($auction_lengths as $item)
                        <option value="{{ $item['name'] }}" data-target=""
                          class="card flex-row fw-bold {{ $item['class'] }}" style="width:calc(33.3% - 10px);"
                          data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

              </div>

              <div class="wizard-step">
                <label class="fw-bold">Please provide the names of the cities, counties, and states in which
                  the buyer intends to make a purchase</label>


                <div class="form-group">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Counties</th>
                      </tr>
                    </thead>
                    <tbody class="getting_html">



                      <tr>

                        <td id="conty">



                          <div class="row">
                            <div class="col-4">
                              <label for=""> Countries</label>
                              <input type="text" name="counties[]" id="counties" class="form-control search_places "
                                placeholder="Search Country..." data-msg-required="Please enter county" required>
                              <div class="dropdown"
                                style="width: 200px;
                                                                                position: absolute;
                                                                                left: 50px;
                                                                                top: 149px;">

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="countryDropdownButton"
                                  id="countryDropdown">
                                  <!-- Dropdown options will be populated dynamically -->
                                </ul>
                              </div>
                            </div>
                            <div class="col-4">

                              <label for="">State</label>

                              <input type="text" id="read_only_state" class="form-control search_places"
                                placeholder="Search state..." data-msg-required="Please enter state....." readonly>



                              <div id="dynamic_row" class="dynamic_row">

                              </div>
                            </div>
                            <div class="col-4">
                              <label for="">Cities</label>

                              <div class="input-group readonly_city" id="read_only_city">
                                <input type="text" class="form-control search_places " placeholder="Search city..."
                                  data-msg-required="Please enter city....." readonly>

                                <div class="input-group-append" style="padding: 9px;">
                                  <span class="input-group-text add_city_row"><i class="fas fa-plus"></i></span>

                                </div>
                              </div>
                              <div class="dynamic_row_city">

                              </div>
                            </div>
                          </div>




                        </td>
                      </tr>




                    </tbody>
                  </table>
                </div>


              </div>

              {{-- 26 June 2023 --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label for="address">Listing Date:</label>
                  <input type="date" name="listing_date" id="listing_date"
                    class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days"
                    data-msg-required="Please enter listing date" required>
                </div>

                <div class="form-group">
                  <label for="address">Expiration Date:</label>
                  <input type="date" name="expiration_date" id="expiration_date"
                    class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days"
                    data-msg-required="Please enter expiration date" required>
                </div>
              </div>
              {{-- 26 June 2023 --}}
              {{-- Old commented code uncommented by waqas --}}

              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">Add Title</label>
                  <input type="text" name="title" placeholder="eg. Need a buyer's agent for a house"
                    id="title" class="form-control has-icon" data-icon="fa-solid fa-heading"
                    data-msg-required="Please enter title" required>
                </div>
              </div>

              {{-- Old commented code uncommented by waqas --}}


              {{-- 26 June 2023  --}}
              <div class="wizard-step">
                @php
                  $property_types = [['name' => 'Residential Property'], ['name' => 'Income Property'], ['name' => 'Commercial Property']];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Please select the property types in which the buyer is
                    interested in purchasing:</label>
                  <select class="grid-picker" name="property_type" id="property_type"
                    onchange="changePropertyType(this.value);" required>
                    <option value="">Select</option>
                    @foreach ($property_types as $row_pt)
                      <option value="{{ $row_pt['name'] }}" class="card flex-column" style="width:calc(24% - 10px);"
                        data-icon='<i class="fa-solid fa-hotel"></i>'>
                        {{ $row_pt['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <div>
                    @php
                      $property_items = [
                          ['name' => 'Single Family Residence', 'class' => 'residential-length'],
                          ['name' => 'Townhouse', 'class' => 'residential-length'],
                          ['name' => 'Villa', 'class' => 'residential-length'],
                          ['name' => 'Condominium', 'class' => 'residential-length'],
                          ['name' => 'Condo-Hotel', 'class' => 'residential-length'],
                          ['name' => '½ Duplex', 'class' => 'residential-length'],
                          ['name' => 'Dock-Rackominium', 'class' => 'residential-length'],
                          ['name' => 'Farm', 'class' => 'residential-length'],
                          ['name' => 'Garage Condo', 'class' => 'residential-length'],
                          ['name' => 'Manufactured Home', 'class' => 'residential-length'],
                          ['name' => 'Mobile Home', 'class' => 'residential-length'],
                          ['name' => 'Modular Home', 'class' => 'residential-length'],
                          ['name' => 'Duplex', 'class' => 'income-length'],
                          ['name' => 'Triplex', 'class' => 'income-length'],
                          ['name' => 'Quadplex', 'class' => 'income-length'],
                          ['name' => 'Five or More (Residential units)', 'class' => 'income-length'],
                          ['name' => 'Agriculture', 'class' => 'commercial-length'],
                          ['name' => 'Assembly Building', 'class' => 'commercial-length'],
                          ['name' => 'Business', 'class' => 'commercial-length'],
                          ['name' => 'Five or More (Commercial units)', 'class' => 'commercial-length'],
                          ['name' => 'Hotel/Motel', 'class' => 'commercial-length'],
                          ['name' => 'Industrial', 'class' => 'commercial-length'],
                          ['name' => 'Mixed Use', 'class' => 'commercial-length'],
                          ['name' => 'Office', 'class' => 'commercial-length'],
                          ['name' => 'Restaurant', 'class' => 'commercial-length'],
                          ['name' => 'Retail', 'class' => 'commercial-length'],
                          ['name' => 'Unimproved Land', 'class' => 'commercial-length'],
                          ['name' => 'Warehouse', 'class' => 'commercial-length'],
                      ];
                    @endphp
                    <select name="property_items" id="property_items" class="property_items grid-picker"
                      style="justify-content: flex-start;" multiple required>
                      <option value=""></option>
                      @foreach ($property_items as $item)
                        <option value="{{ $item['name'] }}" data-target="" class="card flex-row {{ $item['class'] }}"
                          style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              {{-- 26 June 2023  --}}
              {{-- 26 June 2023  --}}
              <div class="wizard-step business_type_next">
                @php
                  $property_styles = [['name' => 'Vacant Land'], ['name' => 'Busniess Opportunity']];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Property Styles:</label>
                  <select class="grid-picker" name="property_style" id="property_style"
                    onchange="changePropertyStyle(this.value);" required>
                    <option value="">Select</option>
                    @foreach ($property_styles as $property_style)
                      <option value="{{ $property_style['name'] }}" class="card flex-column"
                        style="width:calc(24% - 10px);" data-icon='<i class="fa-solid fa-hotel"></i>'>
                        {{ $property_style['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group business_opportunity">
                  <div>
                    @php
                      $property_items = [
                          ['name' => 'Single Family Residence', 'class' => 'residential-length'],
                          ['name' => 'Townhouse', 'class' => 'residential-length'],
                          ['name' => 'Villa', 'class' => 'residential-length'],
                          ['name' => 'Condominium', 'class' => 'residential-length'],
                          ['name' => 'Condo-Hotel', 'class' => 'residential-length'],
                          ['name' => '½ Duplex', 'class' => 'residential-length'],
                          ['name' => 'Dock-Rackominium', 'class' => 'residential-length'],
                          ['name' => 'Farm', 'class' => 'residential-length'],
                          ['name' => 'Garage Condo', 'class' => 'residential-length'],
                          ['name' => 'Manufactured Home', 'class' => 'residential-length'],
                          ['name' => 'Mobile Home', 'class' => 'residential-length'],
                          ['name' => 'Modular Home', 'class' => 'residential-length'],
                          ['name' => 'Duplex', 'class' => 'income-length'],
                          ['name' => 'Triplex', 'class' => 'income-length'],
                          ['name' => 'Quadplex', 'class' => 'income-length'],
                          ['name' => 'Five or More (Residential units)', 'class' => 'income-length'],
                          ['name' => 'Agriculture', 'class' => 'commercial-length'],
                          ['name' => 'Arts And Entertainment', 'class' => 'commercial-length'],
                          ['name' => 'Assembly Hall', 'class' => 'commercial-length'],
                          ['name' => 'Assisted Living', 'class' => 'commercial-length'],
                          ['name' => 'Auto Dealer', 'class' => 'commercial-length'],
                          ['name' => 'Auto Service', 'class' => 'commercial-length'],
                          ['name' => 'Bar/Tavern/Lounge', 'class' => 'commercial-length'],
                          ['name' => 'Barber Beauty', 'class' => 'commercial-length'],
                          ['name' => 'Car Wash', 'class' => 'commercial-length'],
                          ['name' => 'Child Care', 'class' => 'commercial-length'],
                          ['name' => 'Church', 'class' => 'commercial-length'],
                          ['name' => 'Commercial', 'class' => 'commercial-length'],
                          ['name' => 'Construction/Contractor', 'class' => 'commercial-length'],
                          ['name' => 'Distribution', 'class' => 'commercial-length'],
                          ['name' => 'Distributor Routine Ven', 'class' => 'commercial-length'],
                          ['name' => 'Education/School', 'class' => 'commercial-length'],
                          ['name' => 'Farm', 'class' => 'commercial-length'],
                          ['name' => 'Fashion Specialty', 'class' => 'commercial-length'],
                          ['name' => 'Flex Spaces', 'class' => 'commercial-length'],
                          ['name' => 'Florist/Nursery', 'class' => 'commercial-length'],
                          ['name' => 'Food & Beverage', 'class' => 'commercial-length'],
                          ['name' => 'Gas Station', 'class' => 'commercial-length'],
                          ['name' => 'Grocery', 'class' => 'commercial-length'],
                          ['name' => 'Heave Weight Sales Service', 'class' => 'commercial-length'],
                          ['name' => 'Hotel/Motel', 'class' => 'commercial-length'],
                          ['name' => 'Industrial', 'class' => 'commercial-length'],
                          ['name' => 'Light Items Sales Only', 'class' => 'commercial-length'],
                          ['name' => 'Marine/Marina', 'class' => 'commercial-length'],
                          ['name' => 'Medical', 'class' => 'commercial-length'],
                          ['name' => 'Mixed', 'class' => 'commercial-length'],
                          ['name' => 'Mobile/Trailer Park', 'class' => 'commercial-length'],
                          ['name' => 'Professional Service', 'class' => 'commercial-length'],
                          ['name' => 'Professional/Office', 'class' => 'commercial-length'],
                          ['name' => 'Five or More (Commercial units)', 'class' => 'income-length'],
                          ['name' => 'Recreation', 'class' => 'commercial-length'],
                          ['name' => 'Research & Development', 'class' => 'commercial-length'],
                          ['name' => 'Residential', 'class' => 'commercial-length'],
                          ['name' => 'Restaurant', 'class' => 'commercial-length'],
                          ['name' => 'Retail', 'class' => 'commercial-length'],
                          ['name' => 'Storage', 'class' => 'commercial-length'],
                          ['name' => 'Theatre', 'class' => 'commercial-length'],
                          ['name' => 'Timberland', 'class' => 'commercial-length'],
                          ['name' => 'Veterinary', 'class' => 'commercial-length'],
                          ['name' => 'Warehouse', 'class' => 'commercial-length'],
                          ['name' => 'Wholesale', 'class' => 'commercial-length'],
                      ];
                    @endphp
                    <label class="fw-bold"> Business Type: </label>
                    <select name="property_items" id="property_items" class="property_items grid-picker"
                      style="justify-content: flex-start;" multiple required>
                      <option value=""></option>
                      @foreach ($property_items as $item)
                        <option value="{{ $item['name'] }}" data-target="" class="card flex-row {{ $item['class'] }}"
                          style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group vacant_land">
                  <div>
                    @php
                      $current_uses = [
                          ['name' => 'Billboard Site', 'target' => ''],
                          ['name' => 'Business', 'target' => ''],
                          ['name' => 'Cattle', 'target' => ''],
                          ['name' => 'Commercial', 'target' => ''],
                          ['name' => 'Farm', 'target' => ''],
                          ['name' => 'Fishery', 'target' => ''],
                          ['name' => 'Highway Frontage', 'target' => ''],
                          ['name' => 'Horses', 'target' => ''],
                          ['name' => 'Industrial', 'target' => ''],
                          ['name' => 'Land Fill', 'target' => ''],
                          ['name' => 'Livestock', 'target' => ''],
                          ['name' => 'Mixed Use', 'target' => ''],
                          ['name' => 'Nursery', 'target' => ''],
                          ['name' => 'Orchard', 'target' => ''],
                          ['name' => 'Other', 'target' => ''],
                          ['name' => 'Pasture', 'target' => ''],
                          ['name' => 'Poultry', 'target' => ''],
                          ['name' => 'Ranch', 'target' => ''],
                          ['name' => 'Residential', 'target' => ''],
                          ['name' => 'Row Crops', 'target' => ''],
                          ['name' => 'Sod Farm', 'target' => ''],
                          ['name' => 'Subdivision', 'target' => ''],
                          ['name' => 'Timber', 'target' => ''],
                          ['name' => 'Tracts', 'target' => ''],
                          ['name' => 'Trans/Cell Tower', 'target' => ''],
                          ['name' => 'Tree Farm', 'target' => ''],
                          ['name' => 'Unimproved Land', 'target' => ''],
                          ['name' => 'Well Field ', 'target' => ''],
                      ];
                    @endphp
                    <label class="fw-bold"> Current Use:</label>
                    <select name="current_use" id="current_use" class="property_items grid-picker"
                      style="justify-content: flex-start;" required>
                      <option value=""></option>
                      @foreach ($current_uses as $current_use)
                        <option value="{{ $current_use['name'] }}" data-target="" class="card flex-row"
                          style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $current_use['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>


              </div>
              {{-- 26 June 2023  --}}
              {{-- 26 June 2023  --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">
                    Please select the sale provisions in which the buyer is interested in purchasing:
                  </label>
                  @php
                    $types_of_prop = [['name' => 'Regular Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Pre-Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Currently Being Built', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'New Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'REO/Bank Owned', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Assignment Contract (Wholesale properties)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Short Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];
                    $yes_or_nos = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];

                  @endphp
                  <div class="select2-parent">
                    <select name="type_of_prop" id="type_of_prop" class="grid-picker"
                      style="justify-content: flex-start;" required>
                      <option value=""></option>
                      @foreach ($types_of_prop as $pt)
                        @php
                          if ($pt['name'] == 'Assignment Contract (Wholesale properties)') {
                              $target = '.assignment_contract';
                          } else {
                              $target = '';
                          }
                        @endphp
                        <option value="{{ $pt['name'] }}" data-target="{{ $target }}" class="card flex-row"
                          style="width:calc(50% - 10px);"
                          data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;position:relative;top:-7px;"></i>'>
                          {{ $pt['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group assignment_contract d-none">
                    <label class="fw-bold">Is the buyer currently under contract with a property they
                      would like to assign?</label>
                    <select class="grid-picker" name="financing_info" id="financing_info" required>
                      <option value="">Select</option>
                      @foreach ($yes_or_nos as $item)
                        @php
                          if ($item['name'] == 'Assignment Contract (Wholesale properties)') {
                              $target = '.assignment_contract1';
                          } else {
                              $target = '';
                          }
                        @endphp
                        <option value="{{ $item['name'] }}" data-target="{{ $target }}"
                          class="card flex-column" style="width:calc(33.33% - 10px);"
                          data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group assignment_contract1 d-none">
                    <label class="fw-bold">What is the finder’s fee that you will be paying to the
                      agent? % or $</label>
                    <input type="number" name="finder_fee" placeholder="0.00" id="concession" min="0"
                      max=".05" step=".01" class="form-control has-icon search_places col-3"
                      data-icon="fa-solid fa-percent" data-msg-required="Finder Fee" placeholder="% or $">
                  </div>

                </div>
              </div>
              {{-- 26 June 2023 --}}
              {{-- 26 June 2023 --}}
              @php
                $bedrooms = [['name' => '1+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Commercial', 'target' => ''], ['name' => 'Other', 'target' => '.other_bedrooms']];
                $bathrooms = [['name' => '1', 'target' => ''], ['name' => '1.5+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '2.5+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '3.5+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '4.5+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Other', 'target' => '.other_bathrooms']];
              @endphp
              <div class="wizard-step residential_and_income">
                <div class="form-group">
                  <label class="fw-bold">How many bedrooms does the buyer require?</label>
                  <select class="grid-picker" name="bedrooms" id="bedrooms" style="justify-content: center;"
                    required>
                    <option value="">Select</option>
                    @foreach ($bedrooms as $bedroom)
                      <option value="{{ $bedroom['name'] }}" data-target="{{ $bedroom['target'] }}"
                        class="card flex-column" style="width:calc(20% - 10px);"
                        data-icon='<i class="fa-solid fa-bed"></i>'>
                        {{ $bedroom['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group other_bedrooms d-none">
                  <label class="fw-bold" for="other_bedrooms">Bedrooms:</label>
                  <input type="text" name="other_bedrooms" id="other_bedrooms" placeholder="Custom Bedrooms"
                    class="form-control has-icon" data-icon="fa-solid fa-bed"
                    data-msg-required="Please enter Custom Bedrooms" required>
                </div>
              </div>
              {{-- 26 June 2023 --}}
              {{-- 26 June 2023 --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">How many bathrooms does the buyer require?</label>
                  <select class="grid-picker" name="bathrooms" id="bathrooms" style="justify-content: center;"
                    required>
                    <option value="">Select</option>
                    @foreach ($bathrooms as $bathroom)
                      <option value="{{ $bathroom['name'] }}" data-target="{{ $bathroom['target'] }}"
                        class="card flex-column" style="width:calc(20% - 10px);"
                        data-icon='<i class="fa-solid fa-bath"></i>'>
                        {{ $bathroom['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group other_bathrooms d-none">
                  <label class="fw-bold" for="other_bathrooms">Bathrooms:</label>
                  <input type="text" name="other_bathrooms" id="other_bathrooms" placeholder="Custom Bathrooms"
                    class="form-control has-icon" data-icon="fa-solid fa-bath"
                    data-msg-required="Please enter Custom Bathrooms" required>
                </div>
              </div>
              {{-- 26 June 2023 --}}
              {{-- 26 June 2023 --}}

              <div class="wizard-step">

                <div class="form-group residential_and_income_hide">
                  <label class="fw-bold" for="heated_sqft">Minimum Heated Sqft:</label>
                  <input type="number" name="minimum_heated_sqft" placeholder=" Minimum Heated sqft"
                    id="minimum_heated_sqft" class="form-control has-icon hide_arrow"
                    data-icon="fa-solid fa-ruler-combined" data-msg-required="Please enter Heated sqft" required>
                </div>
                <div class="form-group commercial_hide">
                  <label class="fw-bold" for="heated_sqft">Minimum Net Leasable Sqft:</label>
                  <input type="number" name="minimum_net_leasable_sqft" placeholder="Minimum Net Leasable sqft"
                    id="minimum_net_leasable_sqft" class="form-control has-icon hide_arrow"
                    data-icon="fa-solid fa-ruler-combined" data-msg-required="Please enter Heated sqft" required>
                </div>

                @php
                  $total_acreages = [['name' => '0 to less than 14', 'target' => ''], ['name' => '1/4 to less than 1/2', 'target' => ''], ['name' => '1/2 to less than 1', 'target' => ''], ['name' => '1/2 to less than 1', 'target' => ''], ['name' => '1 to less than 2', 'target' => ''], ['name' => '2 to less than 5', 'target' => ''], ['name' => '5 to less than 10', 'target' => ''], ['name' => '10 to less than 20', 'target' => ''], ['name' => '20 to less than 50', 'target' => ''], ['name' => '50 to less than 100', 'target' => ''], ['name' => '100 to less than 200', 'target' => ''], ['name' => '200 to less than 500', 'target' => ''], ['name' => '500+ acres', 'target' => ''], ['name' => 'Non-Applicable', 'target' => '']];
                @endphp
                <div class="form-group commercial_hide">
                  <label class="fw-bold">Total Acreage :</label>
                  <select class="grid-picker" name="total_acreage" id="total_acreage"
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($total_acreages as $total_acreage)
                      <option value="{{ $item['name'] }}" data-target="{{ $total_acreage['target'] }}"
                        class="card flex-column" style="width:calc(25% - 10px);"
                        data-icon='<i class="fa-solid fa-check-circle"></i>'>
                        {{ $total_acreage['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- 26 June 2023 --}}
              <div class="wizard-step business_type_next">
                <div class="form-group">
                  <label class="fw-bold">Are there any non-negotiable amenities or property features that
                    the buyer is seeking?</label>
                  <select class="grid-picker" name="any_non_negotiable" id="financing_info" required>
                    <option value="">Select</option>
                    @foreach ($yes_or_nos as $item)
                      @php
                        if ($item['name'] == 'Yes') {
                            $target = '.non_negotiable_terms';
                        } else {
                            $target = '';
                        }
                      @endphp
                      <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-column"
                        style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- this is non negotiable terms for Residential and Income --}}
                <div class="residential_and_income">
                  @php
                    $yes_or_nos = [
                        ['name' => 'Garage', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                        ['name' => 'Carport', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Pool', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Waterfront', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'In-Unit Laundry', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'On-site Laundry', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Washer and Dryer Hookup', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Washer and Dryer', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'First Floor Unit', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Elevator', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Pet Friendly', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Balcony/Patio', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Fitness Center/Gym', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Central Heating', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Central Air Conditioning', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Fireplace', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Walk-in Closet', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Hardwood Floors', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Tile Floors', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Carpet Floors', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Security System', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Gated Community', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'HOA Community', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => '55 and Over Community', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Specific School District', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Accessibility Features', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'On-site Maintenance', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Playground', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Clubhouse', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Storage Space', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Study/Den/Office', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Updated Kitchen', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Updated Bathroom', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                    ];
                  @endphp
                  <div class="form-group non_negotiable_terms">
                    <label class="fw-bold">Non Negotiable Terms:</label>
                    <select class="grid-picker" name="non_negotiable_terms" id="pool"
                      style="justify-content: flex-start;" required>
                      <option value="">Select</option>
                      @foreach ($yes_or_nos as $item)
                        @php
                          if ($item['name'] == 'Other') {
                              $target = '.other_input';
                          } else {
                              $target = '';
                          }
                        @endphp
                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                          style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group other_input d-none">
                    <label class="fw-bold" for="other_bathrooms">Custom Input:</label>
                    <input type="text" name="custom_non_negotialble_terms" id="custom_non_negotialble_terms"
                      placeholder="Custom Bathrooms" class="form-control has-icon" data-icon="fa-solid fa-bath"
                      data-msg-required="Please enter Custom Input" required>
                  </div>
                </div>
                {{-- this is non negotiable terms for Residential and Income --}}
                {{-- this is non negotiable terms for Business --}}
                <div class="business_type_next">
                  @php
                    $yes_or_nos = [
                        ['name' => 'Parking Spaces', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                        ['name' => 'Loading Dock', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Warehouse Space', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Office Space', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Conference Room', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Kitchenette/Break Room', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Restrooms', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Elevator', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Handicap Accessibility', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Security System', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'On-site Maintenance', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'On-site Management', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Outdoor Space/Garden', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Signage Opportunities', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'High-Speed Internet', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Utilities Included', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'HVAC System', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Natural Lighting', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Storage Space', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Open Floor Plan', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Retail Frontage', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Restaurant Space', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Industrial Features', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Flexibility for Renovations', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Common Areas', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Business Center', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Gym/Fitness Facilities', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Lounge Area', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Reception Areas', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Reception Area', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Fire Safety Systems', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Energy-Efficient Features', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Green Building Certification', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Access to Public Transportation', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Proximity to Highways', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Visibility from Main Road', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                        ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                    ];
                  @endphp
                  <div class="form-group non_negotiable_terms">
                    <label class="fw-bold">Non Negotiable Terms:</label>
                    <select class="grid-picker" name="non_negotiable_terms" id="pool"
                      style="justify-content: flex-start;" required>
                      <option value="">Select</option>
                      @foreach ($yes_or_nos as $item)
                        @php
                          if ($item['name'] == 'Other') {
                              $target = '.other_input1';
                          } else {
                              $target = '';
                          }
                        @endphp
                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                          style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group other_input1 d-none">
                    <label class="fw-bold" for="custom_non_negotialble_terms">Custom Input:</label>
                    <input type="text" name="custom_non_negotialble_terms" id="custom_non_negotialble_terms"
                      placeholder="Custom Bathrooms" class="form-control has-icon" data-icon="fa-solid fa-bath"
                      data-msg-required="Please enter Custom Input" required>
                  </div>

                </div>
                {{-- this is non negotiable terms for Business --}}

              </div>
              {{-- 26 June 2023 --}}

              {{-- 27 June 2023 --}}
              <div class="wizard-step">
                @php
                  $financings_info = [['name' => 'Yes, pre-approved'], ['name' => 'Yes, cash buyer'], ['name' => 'No, I need a lender recommendation'], ['name' => 'No, I have my own lender I will apply with']];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Has the buyer been pre-approved for a loan for the selected
                    amount, or are they a cash buyer, or will they be using a combination of cash
                    and
                    cryptocurrency for the purchase?</label>
                  <select class="grid-picker" name="are_they_been_pre_approved" id="are_they_been_pre_approved"
                    required>
                    <option value="">Select</option>
                    @foreach ($financings_info as $financing_info)
                      @php
                        if ($financing_info['name'] == 'Yes, pre-approved') {
                            $target = '.buyer_pre_approved';
                        } elseif ($financing_info['name'] == 'Yes, cash buyer') {
                            $target = '.buyer_budget_purchasing';
                        } elseif ($financing_info['name'] == 'No, I need a lender recommendation') {
                            $target = '.no_terms';
                        } elseif ($financing_info['name'] == 'No, I have my own lender I will apply with') {
                            $target = '.no_terms';
                        } else {
                            $target = '';
                        }
                      @endphp
                      <option value="{{ $financing_info['name'] }}" data-target="{{ $target }}"
                        class="card flex-column" style="width:calc(33.33% - 10px);"
                        data-icon='<i class="fa-regular fa-check-circle"></i>'>
                        {{ $financing_info['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group buyer_pre_approved d-none">
                  <label class="fw-bold" for="buyer_pre_approved">How much is the buyer pre-approved
                    for?</label>
                  <input type="number" name="buyer_pre_approved" id="buyer_pre_approved"
                    placeholder="Buyer Pre-approved" class="form-control has-icon" data-icon="fa-solid fa-bath"
                    data-msg-required="Please enter Custom Input" required>
                </div>
                <div class="form-group buyer_budget_purchasing d-none">
                  <label class="fw-bold" for="buyer_purchasing">What is the buyer's budget for
                    purchasing a property?</label>
                  <input type="number" name="buyer_budget_purchasing" id="buyer_budget_purchasing"
                    placeholder="Buyer Pre-approved" class="form-control has-icon" data-icon="fa-solid fa-bath"
                    data-msg-required="Please enter Custom Input" required>
                </div>
                <div class="no_terms">
                  <div class="form-group ">
                    <label class="fw-bold" for="buyer_pre_approved">How much do you think the buyer
                      will get pre-approved for?</label>
                    <input type="number" name="buyer_get_pre_approved" id="buyer_get_pre_approved"
                      placeholder="How Much Do you think the buyer will get pre-approved" class="form-control has-icon"
                      data-icon="fa-solid fa-bath" data-msg-required="Please enter Custom Input" required>
                  </div>
                </div>

              </div>
              {{-- 27 June 2023 --}}


              {{-- 27 June 2023 --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">
                    At what price point is the buyer interested in making a purchase?
                    <span class="text-danger">*</span>
                  </label>
                  @php
                    $buyer_budgets = [['name' => '100k or less'], ['name' => '100k-200k'], ['name' => '200k-300k'], ['name' => '300k-400k'], ['name' => '400k-500k'], ['name' => '500k-600k'], ['name' => '600k-700k'], ['name' => '700k-800k'], ['name' => '800-900k'], ['name' => '900k-1 million'], ['name' => '1 million +'], ['name' => '2 million +'], ['name' => '3 million +'], ['name' => '4 million +'], ['name' => '5 million +'], ['name' => '10 million +']];
                  @endphp
                  <select name="buyer_budget" id="buyer_budget" class="grid-picker"
                    style="justify-content: flex-start;" required>
                    <option value=""></option>
                    @foreach ($buyer_budgets as $pt)
                      <option value="{{ $pt['name'] }}" data-target="" class="card flex-column"
                        style="width:calc(20% - 10px);"
                        data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;"></i>'>
                        {{ $pt['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              {{-- 27 June 2023 --}}
              {{-- 27 June 2023 --}}
              <div class="wizard-step">
                @php
                  $term_financings = [['name' => 'Cash', 'target' => ''], ['name' => 'Conventional', 'target' => ''], ['name' => 'FHA', 'target' => ''], ['name' => 'VA', 'target' => ''], ['name' => 'USDA', 'target' => ''], ['name' => 'Assumable', 'target' => ''], ['name' => 'Exchange/Trade', 'target' => ''], ['name' => 'Lease Option', 'target' => ''], ['name' => 'Lease Purchase', 'target' => ''], ['name' => 'Private Financing Available', 'target' => ''], ['name' => 'Special Funding', 'target' => ''], ['name' => 'Seller Financing', 'target' => ''], ['name' => 'Jumbo', 'target' => ''], ['name' => 'Non-QM', 'target' => ''], ['name' => 'No-Doc', 'target' => ''], ['name' => 'Other', 'target' => '.custom_term_financings']];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">financing/currency that the buyer will use to purchase the
                    property:</label>
                  <select class="grid-picker" name="term_financings[]" id="term_financings"
                    style="justify-content: flex-start;" multiple required>
                    <option value="">Select</option>
                    @foreach ($term_financings as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(20% - 10px);">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- 27 June 2023 --}}
              {{-- 27 June 2023 --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">
                    When is Buyer looking to purchase?
                  </label>
                  <div class="form-group prompt_response" style="display: none;">
                    <p class="text-danger">This is a service designed for buyers who are seeking to
                      purchase a property within the next 3 months.</p>
                  </div>
                  @php
                    $timeframes = [['name' => 'ASAP', 'target' => ''], ['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '.custom_amount']];
                  @endphp
                  <select name="buying_timeframe" id="buying_timeframe" class="grid-picker"
                    style="justify-content: flex-start;" onchange="showPrompt(this.value);" required>
                    <option value=""></option>
                    @foreach ($timeframes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-column" style="width:calc(20% - 10px);"
                        data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group custom_amount d-none">
                  <label class="fw-bold">When is Buyer looking to purchase?</label>
                  <input type="text" class="form-control has-icon" placeholder="Enter Amount"
                    name="custom_buyer_looking_to_purchase" data-icon="fa-solid fa-dollar" id="custom_amount"
                    required />
                </div>
              </div>
              {{-- 27 June 2023 --}}
              {{-- 27 June 2023 --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">What is the buyer's preferred timeframe for working with the
                    real estate agent?</label>
                  <input type="text" class="form-control has-icon" placeholder="Enter Amount"
                    name="buyer_prefered_timeframe" data-icon="fa-solid fa-dollar" id="custom_amount" required />
                </div>
              </div>
              {{-- 27 June 2023 --}}


              {{--
                            @php
                                $bedrooms = [['name' => '1+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Commercial', 'target' => ''], ['name' => 'Other', 'target' => '.other_bedrooms']];
                                $bathrooms = [['name' => '1', 'target' => ''], ['name' => '1.5+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '2.5+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '3.5+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '4.5+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Other', 'target' => '.other_bathrooms']];
                            @endphp
                            <div class="wizard-step">
                                <div class="form-group">
                                    <label class="fw-bold">How many bathrooms does the buyer require?</label>
                                    <select class="grid-picker" name="bathrooms" id="bathrooms"
                                        style="justify-content: center;" required>
                                        <option value="">Select</option>
                                        @foreach ($bathrooms as $bathroom)
                                            <option value="{{ $bathroom['name'] }}"
                                                data-target="{{ $bathroom['target'] }}" class="card flex-column"
                                                style="width:calc(20% - 10px);"
                                                data-icon='<i class="fa-solid fa-bath"></i>'>
                                                {{ $bathroom['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group other_bathrooms d-none">
                                    <label class="fw-bold" for="other_bathrooms">Bathrooms:</label>
                                    <input type="text" name="other_bathrooms" id="other_bathrooms"
                                        placeholder="Custom Bathrooms" class="form-control has-icon"
                                        data-icon="fa-solid fa-bath" data-msg-required="Please enter Custom Bathrooms"
                                        required>
                                </div>
                            </div> --}}

              {{-- 27 June 2023 --}}

              <div class="wizard-step">
                <label class="fw-bold">
                  Please indicate the concession that the buyer wishes to receive, if any (up to .5%
                  of the agent's commission):
                </label>
                <div class="form-group col-md-3 mt-2">
                  <input type="number" name="concession" placeholder="0.00" id="concession" min="0"
                    max=".5" step=".1" class="form-control has-icon search_places col-3"
                    data-icon="fa-solid fa-percent" data-msg-required="">
                </div>
                <small>(Available in all the states except: Alabama, Alaska, Iowa, Kansas, Louisiana,
                  Mississippi, Missouri, Oklahoma, Oregon, and Tennessee )</small>
              </div>
              {{-- 27 June 2023 for Business --}}
              {{-- 27 June 2023 for Business --}}
              <div class="wizard-step">

                @php
                  $services_data = [
                      ['target' => '', 'name' => 'Buyer’s listing on the platform BidYourOffer.com'],
                      ['target' => '', 'name' => "Sending prompt email notifications containing properties that meet the buyer's criteria as soon as they are listed, ensuring access to the most up-to-date listings."],
                      ['target' => '', 'name' => "Marketing the buyer's listing on numerous groups, pages, and affiliates through a QR code that links directly to the listing on BidYourOffer.com."],
                      ['target' => '', 'name' => "Promoting the buyer's listing on social media platforms through a QR code or listing link leading to the BidYourOffer.com listing."],
                      ['target' => '', 'name' => "Assisting with obtaining pre-approval or financing options to determine the buyer's purchasing power."],
                      ['target' => '', 'name' => 'Providing detailed market analysis and comparative market information to help the buyer make informed decisions.'],
                      ['target' => '', 'name' => 'Scheduling and accompanying the buyer on property viewings and showings.'],
                      ['target' => '', 'name' => 'Scheduling video tours of the property as needed.'],
                      ['target' => '', 'name' => "Assisting with negotiations and preparing offers to maximize the buyer's chances of securing their desired property."],
                      ['target' => '', 'name' => 'Coordinating and overseeing the home inspection process, including recommending trusted inspectors.'],
                      ['target' => '', 'name' => 'Facilitating communication and coordination with other professionals involved in the transaction, such as lenders, attorneys, and title companies.'],
                      ['target' => '', 'name' => 'Assisting with the review and explanation of all contractual documents and disclosures.'],
                      ['target' => '', 'name' => 'Providing guidance and support throughout the entire purchase transaction, from offer acceptance to closing.'],
                      ['target' => '', 'name' => 'Offering post-purchase assistance, such as recommending service providers for home maintenance and renovations.'],
                      ['target' => '', 'name' => 'Other- Add additional services as needed.'],
                  ];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Select the services Buyer wants hired agent to provide:</label>
                  <select class="grid-picker" name="services[]" id="services" multiple required>
                    <option value="">Select</option>
                    @foreach ($services_data as $service)
                      <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}"
                        class="card flex-row fw-bold" style="width:calc(100% - 0px);"
                        data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                        {{ $service['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group other_services d-none">
                  <label>Write other services</label>
                  <input type="text" name="other_services" id="other_services" class="form-control">
                </div>
              </div>
              {{-- 27 June 2023 for Business --}}
              <div class="wizard-step">
                @php
                  $conditions_interested = [['name' => 'Not Updated: Requires a complete update.'], ['name' => 'Tear Down: Requires complete demolition and reconstruction.'], ['name' => 'Semi-updated, needs minor updates: Partially updated, but requires additional minor updates.'], ['name' => 'Move-in Ready, Completely Updated: Fully updated and ready for occupancy.'], ['name' => 'Open to any type of property condition.']];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Select the property conditions Buyer is interested in
                    purchasing:</label>
                  <select class="grid-picker" name="condition_interested" id="condition_interested" required>
                    <option value="">Select</option>
                    @foreach ($conditions_interested as $condition_interested)
                      <option value="{{ $condition_interested['name'] }}" class="card flex-row fw-bold"
                        style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                        {{ $condition_interested['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>

              </div>
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">Add Does the buyer have any preferred agent(s) whom they would like to notify to
                    participate in the auction?</label>
                  <input type="text" name="notify_particpate" id="other_services" class="form-control">
                </div>
              </div>
              {{-- 27 June 2023  --}}
              <div class="wizard-step">
                <div class="form-group">
                  <label class="fw-bold">
                    What are the most important aspects you will consider when hiring a real estate
                    agent?
                  </label>
                  <input type="text" name="aspect_hiring_agent" placeholder="5000" id="aspect_hiring_agent"
                    class="form-control has-icon search_places" data-icon="fa-solid fa-dollar">
                </div>

                <div class=" form-group">
                  <label class="fw-bold">Additional details the buyer wishes to share with the
                    agent:</label>
                  <textarea name="additional_details" class="form-control" rows="5">{{ old('additional_details') }}</textarea>
                </div>
              </div>
              {{-- 27 June 2023  --}}
              {{-- 27 June 2023  --}}
              <div class="wizard-step">
                {{-- 12 June 2023 for Residential and Income --}}
                <h4>Buyer’s Contact info </h4>
                <div class="form-group">
                  <label class="fw-bold">First Name:</label>
                  <input type="text" name="agent_first_name" id="agent_first_name" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-user" value="{{ Auth::user()->first_name }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Last Name:</label>
                  <input type="text" name="agent_last_name" id="agent_last_name" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-user" value="{{ Auth::user()->last_name }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Phone Number:</label>
                  <input type="text" name="agent_phone" id="agent_phone" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-phone" value="{{ Auth::user()->phone }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Email:</label>
                  <input type="text" name="agent_email" id="agent_email" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-envelope" value="{{ Auth::user()->email }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Brokerage:</label>
                  <input type="text" name="agent_brokerage" id="agent_brokerage" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-icon" value="{{ Auth::user()->brokerage }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Real Estate License #:</label>
                  <input type="text" name="agent_license_no" id="agent_license_no" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-id-card"
                    value="{{ Auth::user()->license_no }}" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">MLS ID #:</label>
                  <input type="text" name="agent_mls_id" id="agent_mls_id" placeholder=""
                    class="form-control has-icon" data-icon="fa-solid fa-id-badge" value="{{ Auth::user()->mls_id }}"
                    required>
                </div>

                <div class="form-group">
                  <label class="fw-bold">Agent Commission (Paid by Seller): $ or %</label>
                  <input type="text" name="agent_commission_percent" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-percent" required>
                </div>
                {{-- 12 June 2023 for Residential and Income --}}
              </div>
              {{-- 27 June 2023  --}}
              <div class="d-flex justify-content-between form-group " style="margin-top:78px;">
                <div>
                  <a class="wizard-step-back btn btn-success btn-lg text-600" style="display: none;">Back</a>
                </div>
                <div>
                  <button type="button" class="wizard-step-next btn btn-success btn-lg text-600"
                    style="display: none;">Next</button>
                  <button type="button" class="wizard-step-finish btn btn-success btn-lg text-600"
                    style="display: none;">Save</button>
                </div>
              </div>
              {{-- <div class="form-group mt-4 text-right">
                                <button class="btn btn-lg text-600 btn-success" type="submit">Save</button>
                            </div> --}}
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Changes By waqas  --}}
  <template class="county_temp">
    <tr>

      <td id="conty" class="conty">



        <div class="row" style="margin-top:40px;">
          <div class="col-4">
            <label for=""> Countries</label>
            <input type="text" name="counties[]" id="counties" class="form-control search_places "
              placeholder="Search Country..." data-msg-required="Please enter county" required>
            <div class="dropdown"
              style="width: 200px;
                                            position: absolute;
                                            left: 50px;
                                            top: 149px;">

              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="countryDropdownButton"
                id="countryDropdown">
                <!-- Dropdown options will be populated dynamically -->
              </ul>
            </div>
          </div>
          <div class="col-4">

            <label for="">State</label>

            <input type="text" id="read_only_state" class="form-control search_places "
              placeholder="Search state..." data-msg-required="Please enter state....." readonly>



            <div id="dynamic_row" class="dynamic_row">

            </div>
          </div>
          <div class="col-4">
            <label for="">Cities</label>

            <div class="input-group readonly_city" id="read_only_city">
              <input type="text" class="form-control search_places " placeholder="Search city..."
                data-msg-required="Please enter city....." readonly>



              <div class="input-group-append" style="padding: 9px;">
                <span class="input-group-text remove_city_row"><i class="fas fa-minus"></i></span>

              </div>
            </div>
            <div class="dynamic_row_city">

            </div>
          </div>
        </div>




      </td>
    </tr>

  </template>



  {{-- Changes By waqas  --}}

  <template class="city_temp dynamic_city_row2">





  </template>

  <template class="state_temp">
    <tr>
      <td><input type="text" name="states[]" placeholder="State" data-type="states"
          class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city"
          data-msg-required="Please enter state"></td>
    </tr>
  </template>
@endsection
@push('scripts')
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  <script>
    $('.add_country_row').click(function() {
      // alert('ok');

      add_county_row();
    });
    $(document).on('click', '.remove_country_row', function() {
      // Your code to handle the click event

      // Example code to remove the row
      $(this).closest('tr').remove();
    });


    function add_county_row() {
      var county_row = $('.county_temp').html();
      $('.county_btn_row').before(county_row);
      // initialize();
    }

    function remove_county_row() {
      $('.county_btn_row').prev('tr').remove();
      // initialize();
    }
  </script>
  <script>
    function changeAuctionType(v) {
      if (v == "Auction (Timer)") {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').hide();
        $('.normal-length').show();
        $('.auction_length_cover').show();
      } else {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').show();
        $('.normal-length').hide();
        $('.auction_length_cover').hide();
      }
    }

    $(function() {
      changeAuctionType("Auction (Timer)");
    });

    function showPrompt(s) {
      $('.prompt_response').hide();
      if (s == "4 months" || s == "5 months" || s == "6 months" || s == "Over 6 months" || s ==
        "Not looking to purchase") {
        $('.prompt_response').show();
      } else {
        $('.prompt_response').hide();
      }
    }
  </script>
  <script>
    function changePropertyStyle(p) {

      // alert(p);
      if (p == "Vacant Land") {
        $('.business_opportunity').addClass('d-none');
        $('.vacant_land').removeClass('d-none');
      } else {
        $('.vacant_land').addClass('d-none');
        $('.business_opportunity').removeClass('d-none');

      }
    }
    // document.getElementById('auction_type').change();
    $(function() {
      changePropertyStyle("");
    });
  </script>
  <script>
    function changePropertyType(p) {
      if (p == "Residential Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').show();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.business_type_next').remove();
        $('.commercial').addClass('d-none');
        $('.residential_and_income_hide').removeClass('d-none');

        // Nisar Changing
        $('#buyer').remove();

      } else if (p == "Income Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').show();
        $('.commercial-length').hide();
        $('.business_type_next').remove();
        $('.commercial').addClass('d-none');
        $('.residential_and_income_hide').removeClass('d-none');



        // Nisar Changing
        $('#buyer').remove();


      } else if (p == "Commercial Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();
        $('.commercial').removeClass('d-none');

        $('.residential_and_income').remove();
        $('.residential_and_income_hide').addClass('d-none');


        // nisar changing
        $('#bedrooms').remove();
        $('#buyer-request').remove();



      } else {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
      }
    }

    $(function() {
      changePropertyType("");
    });
  </script>
  <script>
    $(function() {
      $(document).ready(function() {

        $('.multiple').select2();

        $('.select2').each(function() {
          $(this).prependTo($(this).parent('.select2-parent'));
        });
      });
    });
  </script>

  <script>
    $(function() {
      $('.has-icon').each(function(i) {
        var cover = `<div class="input-cover input-cover-${i}"></div>`;
        $(this).before(cover);
        $(this).appendTo(`.input-cover-${i}`);
        var iconClass = $(this).data('icon');
        var id = $(this).attr('id');
        var htm = `<label for="${id}" class="input-icon"><i class="${iconClass} " ></i></label>`;
        $(this).before(htm);
      });

      $('.grid-picker').each(function(index, elm) {
        var st = $(elm).attr('style');
        var html =
          `<div class="options-container options-container-${index}" style="${st}"></div>`;
        $(elm).after(html);
        $(elm).appendTo(`.options-container-${index}`);
        $(elm).children('option').each(function(i) {
          var val = $(this).val();
          if (val != "") {
            var text = $(this).text();
            var classes = $(this).attr('class');
            var styles = $(this).attr('style') || "";
            var icon = $(this).data('icon') || "";
            var selected = $(this).attr('selected') || "";
            var target = $(this).data('target') || "";
            selected = selected && "active";
            icon = icon && icon + " ";
            var htm = `<div onclick="checkselect(this);" style="${styles}" class="${classes} ${selected} option-container" data-index="${i}" data-target="${target}">
                    <div class="option-icon">${icon}</div>
                    <div class="option-text">${text}</div>
                    </div>`;
            $(`.options-container-${index}`).append(htm);
          }

        });

      });



    });

    function checkselect(elm) {
      var i = $(elm).data('index');
      var mult = $(elm).parent().children('select').attr('multiple') || false;
      // console.log(mult);
      if (mult == false) {
        var option = $(elm).parent().children('select').children(`option:eq(${i})`);
        var ov = option.val();
        $(elm).parent().children('.option-container').removeClass('active');
        $(elm).addClass('active');
        $(elm).parent().children('select').val(ov);
      } else {
        $(elm).toggleClass('active');
        var option = $(elm).parent().children('select').children(`option:eq(${i})`);
        var ov = option.val();
        var vals = $(elm).parent().children('select').val();
        if (vals.includes(ov)) {
          option.removeAttr('selected');
        } else {
          option.attr('selected', 'selected');
        }
      }

      // console.log(op);
      var v = $(elm).parent().children('select').val();
      $(elm).parent().children('select').trigger('change');
      console.log(v);
      check_custom();
    }

    function check_custom() {
      $('.option-container').each(function(i, elm) {
        var target = $(elm).data('target') || "";
        var is_active = $(elm).hasClass('active');
        if (target != "") {
          if (is_active) {
            $(target).removeClass("d-none");
          } else {
            $(target).addClass("d-none");
            $(target).find('input').val("");
          }
        }
      });
      // setTimeout(check_custom, 500);
    }
  </script>

  <script>
    $(function() {
      StepWizard.init();
    });

    var StepWizard = {
      init: function() {
        StepWizard.total_steps = $('.wizard-step').length;

        var v = $(".mainform").validate({
          errorClass: "text-danger w-100",
          onkeyup: false,
          onfocusout: false,
          /* submitHandler: function() {
              // alert("Submitted, thanks!");
              $(".mainform").submit();
          } */
        });

        StepWizard.setStep();
        $('.wizard-step-next').click(function(e) {
          if (v.form()) {
            if ($('.wizard-step.active').next().is('.wizard-step')) {
              $('.wizard-step.active').removeClass('active').next().addClass('active');
              StepWizard.setStep();
            }
          }
        });

        $('.wizard-step-back').click(function(e) {
          if ($('.wizard-step.active').prev().is('.wizard-step')) {
            $('.wizard-step.active').removeClass('active').prev().addClass('active');
            StepWizard.setStep();
          }
        });

        $('.wizard-step-finish').click(function(e) {
          $('.mainform').submit();
        });
      },
      setStep: function() {
        if ($('.wizard-step.active').length == 0) {
          $('.wizard-step').first().addClass('active');
        }
        if ($('.wizard-step.active').prev().is('.wizard-step')) {
          $('.wizard-step-back').show();
        } else {
          $('.wizard-step-back').hide();
        }

        if ($('.wizard-step.active').next().is('.wizard-step')) {
          $('.wizard-step-next').show();
          $('.wizard-step-finish').hide();
        } else {
          $('.wizard-step-next').hide();
          $('.wizard-step-finish').show();
        }
        $('.wizard-step').each(function(i, element) {
          var k = i + 1;
          if ($(element).hasClass('active')) {
            StepWizard.currentStep = k;
          }
        });
        StepWizard.stepChanged();
      },
      stepChanged: function() {
        var comp = (StepWizard.currentStep / StepWizard.total_steps) * 100;
        $('.steps-progress-percent').animate({
          width: comp.toFixed(0) + '%',
        });
      },
      currentStep: 1,
      total_steps: 0,
    };
  </script>

  <script>
    // google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var inputField = document.getElementsByClassName('search_places');

      for (var i = 0; i < inputField.length; i++) {
        var t = inputField[i].dataset.type;
        console.log(t);
        if (t === "cities") {
          var options = {
            types: ['(cities)'],
            componentRestrictions: {
              country: "us"
            },
          };
        } else if (t === "states") {
          var options = {
            types: ['administrative_area_level_1'],
            componentRestrictions: {
              country: "us"
            },
          };
        } else if (t === "address") {
          var options = {
            types: [],
            componentRestrictions: {
              country: "us"
            },
          };
        } else {
          var options = {
            types: ['administrative_area_level_2'],
            componentRestrictions: {
              country: "us"
            },
          };
        }

        google.maps.event.addDomListener(inputField[i], 'keydown', function(e) {
          if (e.keyCode == 13) {
            if (e.preventDefault) {
              e.preventDefault();
            } else {
              // Since the google event handler framework does not handle early IE versions, we have to do it by our self.: -(
              e.cancelBubble = true;
              e.returnValue = false;
            }
          }
        });



        var autocomplete = new google.maps.places.Autocomplete(inputField[i], options);

        autocomplete.addListener('place_changed', function(e) {
          var place = autocomplete.getPlace();
          if (place) {
            console.log("place", place);
            // place variable will have all the information you are looking for.
            var lat = place.geometry['location'].lat();
            var lng = place.geometry['location'].lng();
            if (t == "counties") {
              $('#lat').val(lat);
              $('#long').val(lng);
            }
          }
        });
      }
    }


    $(document).on('click', '.add_city_row', function() {
      // alert('ok');

      add_city_row();
    });
    $(document).on('click', '.remove_city_row', function() {
      // Your code to handle the click event

      // Example code to remove the row
      $(this).closest('tr').remove();
    });






    // Code for Country By Waqas


    var countries = [
      @foreach ($countries as $country)
        '{{ $country->name }}',
      @endforeach
    ];

    var counter = 0;

    var checking = 0;



    $(document).on('input', '[id^="counties"]', function() {
      // Get the ID of the clicked element
      var clickedId = $(this).attr('id');


      var parentElement = $(this).closest('.conty');



      var input = $(this).val().toLowerCase();




      var options = '';
      var country_id = $()

      if (input.length >= 3) {
        $.each(countries, function(index, country) {
          if (country.toLowerCase().startsWith(input)) {
            options +=
              '<li class="dropdown-item" role="presentation" >' +
              country + '</li>';
          }
        });
      }
      // alert(options);

      var dropdownId = $(this).siblings('.dropdown').find('.dropdown-menu').attr('id');
      country_counter_id = dropdownId;
      if (dropdownId == 'countryDropdown') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '247px',
          'position': 'absolute',
          'left': '61px',
          'top': '227px'
        });

      }

      if (dropdownId == 'countryDropdown0') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '356px'
        });

      }
      if (dropdownId == 'countryDropdown1') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '486px'
        });

      }
      if (dropdownId == 'countryDropdown2') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '617px'
        });

      }
      if (dropdownId == 'countryDropdown3') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '748px'
        });

      }
      if (dropdownId == 'countryDropdown4') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '879px'
        });

      }
      if (dropdownId == 'countryDropdown5') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '1010px'
        });

      }
      if (dropdownId == 'countryDropdown6') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '860px'
        });

      }
      if (dropdownId == 'countryDropdown7') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '950px'
        });

      }
      if (dropdownId == 'countryDropdown8') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '1010px'
        });

      }




      $('#' + dropdownId).html(options);

      if (options.length > 0) {
        $('#' + dropdownId).show();
      } else {
        $('#' + dropdownId).hide();
      }

      // Handle the click event for the specific element


    });


    $(document).on('click', '[id^="countryDropdown"] li', function() {


      var current_id = country_counter_id.replace("countryDropdown", "");

      global_id = current_id
      var selectedCountry = $(this).text();

      var inputField = $(this).closest('.col-4').find('.search_places');
      var dynamicRow = $(this).closest('.col-4').next('.col-4').find('.dynamic_row');
      var hide_row_state = $(this).closest('.col-4').next('.col-4').find('.search_places');


      var readonly = dynamicRow.closest('.search_places').attr('id');


      inputField.val(selectedCountry);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/option_dynamic',
        method: 'POST',
        data: {
          country_name: selectedCountry
        },
        success: function(res) {
          // Handle the successful response
          console.log(res.message);
          console.log(res.html);
          hide_row_state.hide();


          res.html = res.html.replace('id="read_only_state"', 'id="read_only_state' +
            current_id + '"');
          res.html = res.html.replace('id="stateDropdown"', 'id="stateDropdown' +
            current_id + '"');
          console.log(res.html);

          dynamicRow.empty();
          dynamicRow.html(res.html);

          states_Array = res.states_Array;
          // console.log(states_Array);
        },
        error: function(xhr, status, error) {
          // Handle the error
          console.log(error);
        }
      });

      $(this).closest('.dropdown').empty();
      $(this).closest('.dropdown').hide();
    });



    // End Code for Country By Waqas






    // Code for State By Waqas


    $(document).on('input', '[id^="read_only_state"]', function() {


      var clickedId = $(this).attr('id');
      // alert(clickedId);


      var parentElement = $(this).closest('.conty');



      var input = $(this).val().toLowerCase();




      var options = '';
      var country_id = $()



      if (input.length >= 3) {
        $.each(states_Array, function(index, state) {
          if (state.name.toLowerCase().startsWith(input)) {
            options +=
              '<li class="dropdown-item" role="presentation" >' +
              state.name + '</li>';
          }
        });


      }
      // alert(options);



      var dropdownId = $(this).siblings('.dropdown').find('.dropdown-menu').attr('id');
      // alert(dropdownId);

      if (dropdownId == 'stateDropdown') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '247px',
          'position': 'absolute',
          'left': '36%',
          'top': '227px'
        });

      }

      if (dropdownId == 'stateDropdown0') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '354px'
        });

      }
      if (dropdownId == 'stateDropdown1') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '486px'
        });

      }
      if (dropdownId == 'stateDropdown2') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '617px'
        });

      }
      if (dropdownId == 'stateDropdown3') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '749px'
        });

      }
      if (dropdownId == 'stateDropdown4') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '61px',
          'top': '748px'
        });

      }
      if (dropdownId == 'stateDropdown5') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '1010px'
        });

      }
      if (dropdownId == 'stateDropdown6') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '860px'
        });

      }
      if (dropdownId == 'stateDropdown7') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '950px'
        });

      }
      if (dropdownId == 'stateDropdown8') {
        var dropdownElement = $(this).siblings('.dropdown');

        dropdownElement.css({
          'width': '203px',
          'position': 'absolute',
          'left': '36%',
          'top': '1040px'
        });

      }




      $('#' + dropdownId).html(options);

      if (input.length > 3) {
        $('#' + dropdownId).show();
      } else {
        $('#' + dropdownId).hide();
      }



    });
    $(document).on('click', '[id^="stateDropdown"] li', function() {
      // alert(global_id);
      var state_name = $(this).text();
      var inputField = $(this).closest('.col-4').find('.search_places');
      var dynamicRow = $(this).closest('.col-4').next('.col-4').find('.dynamic_row_city');
      // alert(dynamicRow);
      var nextCol4 = $(this).closest('.col-4').next('.col-4');
      var readonlyCityId = nextCol4.find('.readonly_city').attr('id');
      inputField.val(state_name);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/option_dynamic_city',
        method: 'POST',
        data: {
          state_name: state_name
        },
        success: function(res) {
          // Handle the successful response
          console.log(res.message);
          console.log(res.html);
          $('#' + readonlyCityId).hide();
          console.log('this is city html');
          console.log(res.html);
          res.html = res.html.replace('id="read_only_city"', 'id="read_only_city' +
            global_id + '"');
          res.html = res.html.replace('id="cityDropdown"', 'id="cityDropdown' +
            global_id + '"');
          console.log('this is city html ');
          if (global_id === '') {
            console.log('this is first html');
            console.log(res.html);
            dynamicRow.empty();
            dynamicRow.html(res.html);
          } else {
            console.log('this is first html');
            console.log(res.html2);
            dynamicRow.empty();
            dynamicRow.html(res.html2);
          }
          console.log(res.html);
          city_Array = res.cityArray;
          // console.log(states_Array);
        },
        error: function(xhr, status, error) {
          // Handle the error
          console.log(error);
        }
      });

      $(this).closest('.dropdown').empty();
      $(this).closest('.dropdown').hide();
    });
    // End code for State By Waqas
    //Code start for CIty By Waqas
    $(document).on('input', '[id^="read_only_city"]', function() {
      var clickedId = $(this).attr('id');
      // alert(clickedId);
      var parentElement = $(this).closest('.conty');
      var input = $(this).val().toLowerCase();
      var options = '';
      var country_id = $();
      // $.each(states_Array, function(index, state) {
      //     if (state.name.toLowerCase().startsWith(input)) {
      //         options +=
      //             '<li class="dropdown-item" role="presentation" style="border-bottom:1px solid black;">' +
      //             state.name + '</li>';
      //     }
      // });


      if (input.length >= 3) {

        $.each(city_Array, function(index, city) {
          if (city.name.toLowerCase().startsWith(input)) {
            options +=
              '<li class="dropdown-item" role="presentation" >' +
              city.name + '</li>';
          }
        });

      }
      // alert(options);
      var dropdownId = $(this).siblings('.dropdown').find('.dropdown-menu').attr('id');
      // alert(dropdownId);
      var dropdownElement = $(this).siblings('.dropdown');
      dropdownElement.css({
        'width': '320px',
        'position': 'absolute',
        'left': '6px',
        'top': '57px'
      });
      $('#' + dropdownId).html(options);

      if (input.length > 0) {
        $('#' + dropdownId).show();
      } else {
        $('#' + dropdownId).hide();
      }
    });
    $(document).on('click', '[id^="cityDropdown"] li', function() {
      // alert(global_id);
      var city_name = $(this).text();
      var inputField = $(this).closest('.col-4').find('.search_places');
      inputField.val(city_name);
      $(this).closest('.dropdown').empty();
      $(this).closest('.dropdown').hide();
    });
    // Code End for City By Waqas
    // Adding new record By Waqas
    function add_city_row() {
      var city_row = $('.county_temp').html();
      var $city_row = $(city_row);
      $city_row.find('#conty').attr('id', 'conty' + counter);
      // Append the modified $city_row object
      $('.getting_html').append($city_row);
      var lastAppendedHTML = $('.getting_html tr').last().html();
      var $lastAppendedHTML = $(lastAppendedHTML);
      $lastAppendedHTML.find('#counties').attr('id', 'counties' + counter);
      $lastAppendedHTML.find('#counties').attr('id', 'state' + counter);
      $lastAppendedHTML.find('#countryDropdown').attr('id', 'countryDropdown' + counter);
      $lastAppendedHTML.find('#stateDropdown').attr('id', 'stateDropdown' + counter);
      $lastAppendedHTML.find('#cityDropdown').attr('id', 'cityDropdown' + counter);
      $lastAppendedHTML.find('#read_only_state').attr('id', 'read_only_state' + counter);
      $lastAppendedHTML.find('#read_only_city').attr('id', 'read_only_city' + counter);
      $lastAppendedHTML.find('#dynamic_row').attr('id', 'dynamic_row' + counter);
      $('.getting_html tr').last().html($lastAppendedHTML);
      console.log($('.getting_html tr').last().html());

      counter++; // Increment the counter for the next row
      // initialize();

    }
    // Adding new record end by waqas
  </script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACES_API_KEY') }}&libraries=places&callback=initialize">
  </script>
@endpush
