@extends('layouts.main')
@push('styles')
  <style>
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

    ::-ms-browse {
      height: 50px;
    }

    ::-webkit-file-upload-button {
      height: 50px;
    }

    input[type=file]::file-selector-button {
      height: 50px;
    }
  </style>
@endpush
@section('content')
  <div class="container p-4">
    <h4 class="title">
      {{ $title }}
    </h4>

    <div class="card m-4">
      <div class="card-title">
        {{--  --}}
      </div>
      <div class="card-body">
        <div class="wizard-steps-progress">
          <div class="steps-progress-percent"></div>
        </div>

        <form class="p-4 pt-0 mainform" action="{{ route('criteria.auction.bid', @$auction->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="auction_id" value="{{ @$auction->id }}">
          @php
            $yes_or_nos = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
          @endphp
          <div class="wizard-step" data-step="1">
            <h4 class="title">Please enter the city, county, and state of the property you are offering to sell.
            </h4>
            <div class="form-group">
              <label class="fw-bold">City:</label>
              <input type="text" name="city" data-type="cities" placeholder="" id="city"
                class="form-control has-icon search_places" data-icon="fa-solid fa-city"
                data-msg-required="Please enter city" required>
            </div>

            <div class="form-group">
              <label class="fw-bold">County:</label>
              <input type="text" name="county" data-type="counties" placeholder="" id="county"
                class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city"
                data-msg-required="Please enter county" required>
            </div>

            <div class="form-group">
              <label class="fw-bold">State:</label>
              <input type="text" name="state" data-type="states" placeholder="" id="states"
                class="form-control has-icon search_places" data-icon="fa-solid fa-flag-usa"
                data-msg-required="Please enter state" required>
            </div>
          </div>
          <div class="wizard-step" data-step="2">
            @php
              $property_types = [['name' => 'Residential Property'], ['name' => 'Income Property'], ['name' => 'Commercial Property'], ['name' => 'Business Opportunity'], ['name' => 'Vacant Land']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Offered Property Style:</label>
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
                      ['name' => 'Aeronautical', 'class' => 'business-opportunity'],
                      ['name' => 'Agriculture', 'class' => 'business-opportunity'],
                      ['name' => 'Arts and Entertainment', 'class' => 'business-opportunity'],
                      ['name' => 'Assembly Hall', 'class' => 'business-opportunity'],
                      ['name' => 'Assisted Living', 'class' => 'business-opportunity'],
                      ['name' => 'Auto Dealer', 'class' => 'business-opportunity'],
                      ['name' => 'Auto Service', 'class' => 'business-opportunity'],
                      ['name' => 'Bar/Tavern/Lounge', 'class' => 'business-opportunity'],
                      ['name' => 'Barber/Beauty', 'class' => 'business-opportunity'],
                      ['name' => 'Car Wash', 'class' => 'business-opportunity'],
                      ['name' => 'Child Care', 'class' => 'business-opportunity'],
                      ['name' => 'Church', 'class' => 'business-opportunity'],
                      ['name' => 'Commercial', 'class' => 'business-opportunity'],
                      ['name' => 'Concession Trailers/Vehicles', 'class' => 'business-opportunity'],
                      ['name' => 'Construction/Contractor', 'class' => 'business-opportunity'],
                      ['name' => 'Convenience Store', 'class' => 'business-opportunity'],
                      ['name' => 'Distribution', 'class' => 'business-opportunity'],
                      ['name' => 'Distributor Routine Ven', 'class' => 'business-opportunity'],
                      ['name' => 'Education/School', 'class' => 'business-opportunity'],
                      ['name' => 'Farm', 'class' => 'business-opportunity'],
                      ['name' => 'Fashion/Specialty', 'class' => 'business-opportunity'],
                      ['name' => 'Flex Space', 'class' => 'business-opportunity'],
                      ['name' => 'Florist/Nursery', 'class' => 'business-opportunity'],
                      ['name' => 'Food & Beverage', 'class' => 'business-opportunity'],
                      ['name' => 'Gas Station', 'class' => 'business-opportunity'],
                      ['name' => 'Grocery', 'class' => 'business-opportunity'],
                      ['name' => 'Heavy Weight Sales Service', 'class' => 'business-opportunity'],
                      ['name' => 'Hotel/Motel', 'class' => 'business-opportunity'],
                      ['name' => 'Industrial', 'class' => 'business-opportunity'],
                      ['name' => 'Light Items Sales Only', 'class' => 'business-opportunity'],
                      ['name' => 'Manufacturing', 'class' => 'business-opportunity'],
                      ['name' => 'Marine/Marina', 'class' => 'business-opportunity'],
                      ['name' => 'Medical', 'class' => 'business-opportunity'],
                      ['name' => 'Mixed', 'class' => 'business-opportunity'],
                      ['name' => 'Mobile/Trailer Park', 'class' => 'business-opportunity'],
                      ['name' => 'Other', 'class' => 'business-opportunity'],
                      ['name' => 'Personal Service', 'class' => 'business-opportunity'],
                      ['name' => 'Professional Service', 'class' => 'business-opportunity'],
                      ['name' => 'Professional/Office', 'class' => 'business-opportunity'],
                      ['name' => 'Recreation', 'class' => 'business-opportunity'],
                      ['name' => 'Research & Development', 'class' => 'business-opportunity'],
                      ['name' => 'Residential', 'class' => 'business-opportunity'],
                      ['name' => 'Restaurant', 'class' => 'business-opportunity'],
                      ['name' => 'Retail', 'class' => 'business-opportunity'],
                      ['name' => 'Shopping Center/Strip Center', 'class' => 'business-opportunity'],
                      ['name' => 'Storage', 'class' => 'business-opportunity'],
                      ['name' => 'Theater', 'class' => 'business-opportunity'],
                      ['name' => 'Timberland', 'class' => 'business-opportunity'],
                      ['name' => 'Veterinary', 'class' => 'business-opportunity'],
                      ['name' => 'Warehouse', 'class' => 'business-opportunity'],
                      ['name' => 'Wholesale', 'class' => 'business-opportunity'],
                      ['name' => 'Billboard Site', 'class' => 'vacant-land'],
                      ['name' => 'Business', 'class' => 'vacant-land'],
                      ['name' => 'Cattle', 'class' => 'vacant-land'],
                      ['name' => 'Commercial', 'class' => 'vacant-land'],
                      ['name' => 'Farm', 'class' => 'vacant-land'],
                      ['name' => 'Fishery', 'class' => 'vacant-land'],
                      ['name' => 'Highway Frontage', 'class' => 'vacant-land'],
                      ['name' => 'Horses', 'class' => 'vacant-land'],
                      ['name' => 'Industrial', 'class' => 'vacant-land'],
                      ['name' => 'Land Fill', 'class' => 'vacant-land'],
                      ['name' => 'Livestock', 'class' => 'vacant-land'],
                      ['name' => 'Mixed Use', 'class' => 'vacant-land'],
                      ['name' => 'Nursery', 'class' => 'vacant-land'],
                      ['name' => 'Orchard', 'class' => 'vacant-land'],
                      ['name' => 'Other', 'class' => 'vacant-land'],
                      ['name' => 'Pasture', 'class' => 'vacant-land'],
                      ['name' => 'Poultry', 'class' => 'vacant-land'],
                      ['name' => 'Ranch', 'class' => 'vacant-land'],
                      ['name' => 'Residential', 'class' => 'vacant-land'],
                      ['name' => 'Row Crops', 'class' => 'vacant-land'],
                      ['name' => 'Sod Farm', 'class' => 'vacant-land'],
                      ['name' => 'Subdivision', 'class' => 'vacant-land'],
                      ['name' => 'Timber', 'class' => 'vacant-land'],
                      ['name' => 'Tracts', 'class' => 'vacant-land'],
                      ['name' => 'Trans/Cell Tower', 'class' => 'vacant-land'],
                      ['name' => 'Tree Farm', 'class' => 'vacant-land'],
                      ['name' => 'Unimproved Land', 'class' => 'vacant-land'],
                      ['name' => 'Well Field', 'class' => 'vacant-land'],
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
                      ['name' => 'Five or More (Residential units)', 'class' => 'commercial-length'],
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
                <label for="" class="business-opportunity fw-bold">Business Type: </label>
                <label for="" class="vacant-land fw-bold">Current Use: </label>
                <select name="property_items" id="property_items" class="property_items grid-picker"
                  style="justify-content: flex-start;" multiple required>
                  <option value=""></option>
                  @foreach ($property_items as $item)
                    <option value="{{ $item['name'] }}" data-target="" class="card flex-row  {{ $item['class'] }}"
                      style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="3">
            @php
              $realEstateRes = [['icon' => '<i class="fa-regular fa-circle-check"></i>', 'name' => 'Yes', 'target' => '.realEstateRes'], ['icon' => '<i class="fa-regular fa-circle-xmark"></i>', 'name' => 'No', 'target' => '']];
            @endphp
            <div class="row ">
              <div class="form-group">
                <label class="fw-bold">Real Estate Included: </label>
                <select class="grid-picker" name="sale_include" id="sale_include" style="justify-content: flex-start;"
                  required>
                  <option value="">Select</option>
                  @foreach ($realEstateRes as $item)
                    <option value="{{ $item['name'] }}" data-icon='{{ $item['icon'] }}'
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group realEstateRes d-none">
                  <div class="form-group">
                    <label class="fw-bold">Business Name:</label>
                    <input type="text" name="businessName" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-qrcode" required>
                  </div>
                  <div class="form-group">
                    <label class="fw-bold">Year Established:</label>
                    <input type="text" name="yearEstablish" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-qrcode" required>
                  </div>
                </div>
              </div>
            </div>
            @php
              $licenseRes = [['name' => 'Beer/Wine', 'target' => ''], ['name' => 'Liquor', 'target' => ''], ['name' => 'None', 'target' => ''], ['name' => 'Off Site', 'target' => ''], ['name' => 'On Site', 'target' => '']];
            @endphp
            <div class="row ">
              <div class="form-group">
                <label class="fw-bold">Licenses: </label>
                <select class="grid-picker" name="lincenses[]" id="sale_include" style="justify-content: flex-start;"
                  required multiple>
                  <option value="">Select</option>
                  @foreach ($licenseRes as $item)
                    <option value="{{ $item['name'] }}" data-icon='<i class="fa-regular fa-circle-check"></i>'
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="4">
            <h4>Financial Information:</h4>
            @php
              $acutual_or_projected = [['name' => 'Actual', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Projected', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Operating Expenses:</label>
              <input type="number" name="operating_expenses" id="operating_expenses" class="form-control has-icon"
                data-icon="fa-solid fa-dollar " placeholder="Operating Expenses">
            </div>
            <div class="form-group">
              <label class="fw-bold">Net Operating Income:</label>
              <input type="number" name="net_operating_income" id="net_operating_income"
                class="form-control has-icon" data-icon="fa-solid fa-dollar" placeholder="Net Operating Income">
            </div>
            <div class="form-group">
              <label class="fw-bold">Net Operating Income Type:</label>
              <select class="grid-picker" name="net_operating_income_type" id="net_operating_income_type"
                style="justify-content: flex-start;">
                <option value="">Select</option>
                @foreach ($acutual_or_projected as $item)
                  @php
                    if ($item['name'] == 'Yes') {
                        $target = '';
                    } else {
                        $target = '';
                    }
                  @endphp
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="fw-bold">Annual Expense:</label>
              <input type="number" name="annual_expenses" id="annual_expenses" class="form-control has-icon"
                data-icon="fa-solid fa-dollar" placeholder="Annual Expenses">
            </div>
            <div class="form-group">
              <label class="fw-bold">Annual TTL Schedule Income:</label>
              <input type="number" name="annual_ttl_schedule_income" id="annual_ttl_schedule_income"
                class="form-control has-icon" data-icon="fa-solid fa-dollar" placeholder="Annual TTL Schedule Income">
            </div>
            <div class="form-group">
              <label class="fw-bold">Annual Income Type:</label>
              <select class="grid-picker" name="annual_income_type" id="annual_income_type"
                style="justify-content: flex-start;">
                <option value="">Select</option>
                @foreach ($acutual_or_projected as $item)
                  @php
                    if ($item['name'] == 'Yes') {
                        $target = '';
                    } else {
                        $target = '';
                    }
                  @endphp
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>


            @php
              $sale_includes = [['name' => 'Building(s) and Land', 'target' => ''], ['name' => 'Furniture/Fixtures', 'target' => ''], ['name' => 'Leases', 'target' => ''], ['name' => 'Other', 'target' => '']];
            @endphp
            <div class="row ">
              <div class="form-group">
                <label class="fw-bold">Sale Includes:</label>
                <select class="grid-picker" name="sale_include" id="sale_include"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($sale_includes as $sale_include)
                    <option value="{{ $sale_include['name'] }}" data-icon='<i class="fa-regular fa-circle-check"></i>'
                      data-target="{{ $sale_include['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);">
                      {{ $sale_include['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="fw-bold">Number of Tenants:</label>
              <input type="number" name="number_of_tenants" id="number_of_tenants" class="form-control has-icon"
                data-icon="fa-solid fa-qrcode">
            </div>
          </div>
          <div class="wizard-step" data-step="5">
            <div class="form-group">
              @php
                $unit_types = [['target' => '', 'name' => '1 Bed/1 Bath'], ['target' => '', 'name' => '1 Bedroom'], ['target' => '', 'name' => '2 Bed/1 Bath'], ['target' => '', 'name' => '2 Bed/2 Bath'], ['target' => '', 'name' => '2 Bedroom'], ['target' => '', 'name' => '3 Bed/1 Bath'], ['target' => '', 'name' => '3 Bed/2 Bath'], ['target' => '', 'name' => '3 Bedroom'], ['target' => '', 'name' => '4 Bedroom or More'], ['target' => '', 'name' => '4+ Bed/1 Bath'], ['target' => '', 'name' => '4+ Bed/2 Bath'], ['target' => '', 'name' => 'Apartments'], ['target' => '', 'name' => 'Efficiency'], ['target' => '', 'name' => 'Loft'], ['target' => '', 'name' => "Manager's Unit"], ['target' => '', 'name' => 'Multi-Level'], ['target' => '', 'name' => 'Penthouse'], ['target' => '', 'name' => 'Studio']];
              @endphp
              <label for="" class="fw-bold">Unit Types:</label>
              <select class="grid-picker" name="unitTypes[]" id="" style="justify-content: flex-start;"
                multiple required>
                <option value="">Select</option>
                @foreach ($unit_types as $item)
                  <option value="{{ $item['name'] }}" data-target="" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <button type="button" class="btn btn-secondary btn-sm w-100 unitTypeBtn mt-1"
                onclick="add_unit_types();"><i class="fa-solid fa-plus"></i> Add More</button>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label class="fw-bold">Heated Sqft</label>
                <input type="number" name="heatedSqft[]" id="sqt_ft_heated" placeholder="Heated Sqft "
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 sqft_btn_row mt-1"
                  onclick="add_sqft();"><i class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Number of Units</label>
                <input type="number" name="unitNumber[]" id="number_of_units" placeholder="Number of Units"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 unitNumberBtn mt-1"
                  onclick="add_nmbr();"><i class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Expected Rent</label>
                <input type="number" name="expected_rent" id="expected_rent" placeholder="Expected Rent"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 rentBtn mt-1" onclick="add_rent();"><i
                    class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Garage Spaces</label>
                <input type="number" name="garageSpaces[]" id="" placeholder="Garage Spaces"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 garageBtn mt-1"
                  onclick="add_garage_spaces();"><i class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Beds/Unit </label>
                <input type="number" name="bedsUnit[]" id="" placeholder="Beds/Unit"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 bedBtn mt-1" onclick="add_bed_unit();"><i
                    class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Baths/Unit</label>
                <input type="number" name="bathUnit[]" id="" placeholder="Baths/Unit"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                <button type="button" class="btn btn-secondary btn-sm w-100 bathBtn mt-1"
                  onclick="add_baths_unit();"><i class="fa-solid fa-plus"></i> Add More</button>
              </div>
              <div class="form-group col-md-12">
                <label class="fw-bold">Unit Type of Description:</label>
                <textarea name="unit_type_of_description" id="unit_type_of_description" class="form-control" cols="30"
                  rows="10"></textarea>
              </div>

              <div class="form-group col-md-4">
                <label class="fw-bold">Total Monthly Rent</label>
                <input type="number" name="total_monthly_rent" id="garage_attribute" placeholder="Total Monthly Rent"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Total Number of Units:</label>
                <input type="number" name="total_number_of_units" placeholder="Total Number of Units"
                  id="total_number_of_units" class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Total Monthly Expenses</label>
                <input type="number" name="total_monthly_expenses" id="garage_attribute"
                  placeholder="Total Monthly Expenses" class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Lease Terms</label>
                <input type="text" name="lease_terms" id="garage_attribute" placeholder="Lease Terms"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Annual Net Income</label>
                <input type="number" name="annual_net_income" id="garage_attribute" placeholder="Annual Net Income"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Annual Gross Income</label>
                <input type="number" name="annual_gross_income" id="garage_attribute"
                  placeholder="Annual Gross Income" class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Est Annual Market Income</label>
                <input type="text" name="est_annual_market_income" id="garage_attribute"
                  placeholder="Est Annual Market Income" class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Annual Expenses</label>
                <input type="number" name="annual_expenses" id="garage_attribute" placeholder="Annual Expenses"
                  class="form-control has-icon" data-icon="fa-solid fa-qrcode">
              </div>
              @php
                $terms_of_leases = [['name' => 'Gross Lease', 'target' => ''], ['name' => 'Net Lease', 'target' => ''], ['name' => 'Other', 'target' => ''], ['name' => 'Pass Throughts', 'target' => ''], ['name' => 'Purchase Options', 'target' => ''], ['name' => 'Renewal Option', 'target' => '']];
              @endphp
              <div class="form-group  ">
                <label class="fw-bold">Terms of Lease:</label>
                <select class="grid-picker" name="terms_of_lease" id="terms_of_lease"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($terms_of_leases as $terms_of_lease)
                    <option value="{{ $terms_of_lease['name'] }}" data-target="{{ $terms_of_lease['target'] }}"
                      class="card flex-row" data-icon='<i class="fa-regular fa-circle-check"></i>'
                      style="width:calc(33.3% - 10px);">
                      {{ $terms_of_lease['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $tenant_pays = [['name' => 'Association Fees', 'target' => ''], ['name' => 'Electricity', 'target' => ''], ['name' => 'Parking Fee', 'target' => ''], ['name' => 'Sewer', 'target' => ''], ['name' => 'Trash Collection', 'target' => ''], ['name' => 'Water', 'target' => ''], ['name' => 'Other', 'target' => '.tenantPayOthers']];
              @endphp
              <div class="form-group ">
                <label class="fw-bold">Tenant Pays:</label>
                <select class="grid-picker" name="tenant_pays" id="terms_of_lease"
                  style="justify-content: flex-start;" multiple required>
                  <option value="">Select</option>
                  @foreach ($tenant_pays as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      data-icon='<i class="fa-regular fa-circle-check"></i>' style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group tenantPayOthers d-none">
                  <label class="fw-bold">Tenant Pays:</label>
                  <input type="number" name="tenantPays" placeholder="" id="total_number_of_units"
                    class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                </div>

              </div>

              @php
                $financial_sources = [['name' => 'Accountant', 'target' => ''], ['name' => 'Broker', 'target' => ''], ['name' => 'Owner', 'target' => ''], ['name' => 'Tax Return', 'target' => '']];
              @endphp
              <div class="form-group road_frontage_next_hide ">
                <label class="fw-bold">Financial Sources:</label>
                <select class="grid-picker" name="financial_sources" id="terms_of_lease"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($financial_sources as $financial_source)
                    <option value="{{ $financial_source['name'] }}" data-target="{{ $financial_source['target'] }}"
                      class="card flex-row" data-icon='<i class="fa-regular fa-circle-check"></i>'
                      style="width:calc(33.3% - 10px);">
                      {{ $financial_source['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="fw-bold">Occupied:</label>
                <select class="grid-picker" name="occupied" id="occupied" style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($yes_or_nos as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="6">
            @php
              $special_sale = [['name' => 'Pre-Construction', 'target' => ''], ['name' => 'Currently Being Built', 'target' => ''], ['name' => 'New Construction', 'target' => ''], ['name' => 'Assignment Contract (Wholesale property)', 'target' => '.assignment_contract'], ['name' => 'Bank Owned/REO', 'target' => ''], ['name' => 'Probate Listing', 'target' => ''], ['name' => 'Short Sale', 'target' => ''], ['name' => 'Government Owned', 'target' => ''], ['name' => 'Auction', 'target' => ''], ['name' => 'None', 'target' => '']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Please select the sale provisions in which the seller is offering: </label>
              <select class="grid-picker" name="saleProvisions[]" id="assignment_contract" multiple
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($special_sale as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group assignment_contract d-none">
              @php
                $yes_no = [['name' => 'Yes', 'target' => '.assignment_contractYes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              @endphp
              <label class="fw-bold">Is the seller currently under contract with a property they would like to
                assign?</label>
              <select class="grid-picker" name="assignment_contract[]" id="assignment_contract" style=""
                required>
                <option value="">Select</option>
                @foreach ($yes_no as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(25% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group assignment_contractYes d-none">
                <label class="fw-bold">Please provide more information on the contract that the seller is seeking to
                  assign:</label>
                <input type="text" name="custom_assignment" id="custom_bedrooms" class="form-control"
                  data-icon="" required>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="7">
            @php
              $bedrooms = [['target' => '', 'name' => '1'], ['target' => '', 'name' => '2'], ['target' => '', 'name' => '3'], ['target' => '', 'name' => '4'], ['target' => '', 'name' => '5'], ['target' => '', 'name' => '6'], ['target' => '', 'name' => '7'], ['target' => '', 'name' => '8'], ['target' => '', 'name' => '9'], ['target' => '', 'name' => '10'], ['target' => '', 'name' => 'None'], ['target' => '.custom_bedrooms', 'name' => 'Other']];
            @endphp
            <div class="property_opt">
              <div class="form-group">
                <label class="fw-bold">How many bedrooms does the property have?</label>
                <select class="grid-picker" name="bedrooms" id="bedrooms" style="" required>
                  <option value="">Select</option>
                  @foreach ($bedrooms as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                      style="width:calc(9% - 10px);" data-icon='<i class="fa-solid fa-bed"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group custom_bedrooms d-none">
                <label class="fw-bold">Bedrooms:</label>
                <input type="text" name="custom_bedrooms" id="custom_bedrooms" class="form-control has-icon"
                  data-icon="fa-solid fa-bed" required>
              </div>
              <div class="form-group">
                @php
                  $bathrooms = [['target' => '', 'name' => '1'], ['target' => '', 'name' => '1.5'], ['target' => '', 'name' => '2'], ['target' => '', 'name' => '2.5'], ['target' => '', 'name' => '3'], ['target' => '', 'name' => '3.5'], ['target' => '', 'name' => '4'], ['target' => '', 'name' => '4.5'], ['target' => '', 'name' => '5'], ['target' => '', 'name' => '5.5'], ['target' => '', 'name' => '6'], ['target' => '', 'name' => '6.5'], ['target' => '', 'name' => '7'], ['target' => '', 'name' => '7.5'], ['target' => '', 'name' => '8'], ['target' => '', 'name' => '8.5'], ['target' => '', 'name' => '9'], ['target' => '', 'name' => '9.5'], ['target' => '', 'name' => '10'], ['target' => '', 'name' => 'None'], ['target' => '.custom_bathrooms', 'name' => 'Other']];
                @endphp
                <label class="fw-bold">How many bathrooms does the property have?</label>
                <select class="grid-picker" name="bathrooms" id="bathrooms" style="" required>
                  <option value="">Select</option>
                  @foreach ($bathrooms as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                      style="width:calc(10% - 10px);" data-icon='<i class="fa-solid fa-bath"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group custom_bathrooms d-none">
                <label class="fw-bold">Bathrooms:</label>
                <input type="text" name="custom_bathrooms" id="custom_bathrooms" class="form-control has-icon"
                  data-icon="fa-solid fa-bath" required>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="8">
            <div class="form-group">
              <label class="fw-bold">How many heated sqft does the property have?</label>
              <input type="number" name="min_sqft" id="min_sqft" class="form-control has-icon"
                data-icon="fa-solid fa-qrcode" required>
            </div>
          </div>
          <div class="wizard-step" data-step="9">
            @php
              $lot_sizes = [['name' => '0 to less than 1/4', 'target' => ''], ['name' => '1/4 to less than 1/2', 'target' => ''], ['name' => '1/2 to less than 1', 'target' => ''], ['name' => '1 to less than 2', 'target' => ''], ['name' => '2 to less than 5', 'target' => ''], ['name' => '5 to less than 10', 'target' => ''], ['name' => '10 to less than 20', 'target' => ''], ['name' => '20 to less than 50', 'target' => ''], ['name' => '50 to less than 100', 'target' => ''], ['name' => '100 to less than 200', 'target' => ''], ['name' => '200 to less than 500', 'target' => ''], ['name' => '500+ Acers', 'target' => ''], ['name' => 'Non-Applicable', 'target' => '']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">What is the total acreage of the property?</label>
              <select class="grid-picker" name="lot_size" id="lot_size" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($lot_sizes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group other_floor_in_property d-none">
              <label class="fw-bold" for="other_floor_in_property">Other Terms of Lease:</label>
              <input type="text" name="other_floor_in_property" id="other_floor_in_property"
                placeholder="Floors in property" class="form-control"
                data-msg-required="Please enter Floors in property" required>
            </div>
          </div>
          {{-- <div class="wizard-"11">
            @php
              $appliances = [
                  ['name' => 'Bar Fridge', 'target' => ''],
                  ['name' => 'Built-In Oven', 'target' => ''],
                  ['name' => 'Convection Oven', 'target' => ''],
                  ['name' => 'Cooktop', 'target' => ''],
                  ['name' => 'Dishwasher', 'target' => ''],
                  ['name' => 'Disposal', 'target' => ''],
                  ['name' => 'Dryer', 'target' => ''],
                  ['name' => 'Electric Water Heater', 'target' => ''],
                  ['name' => 'Exhaust Fan', 'target' => ''],
                  ['name' => 'Freezer', 'target' => ''],
                  ['name' => 'Gas Water Heater', 'target' => ''],
                  ['name' => 'Ice Maker', 'target' => ''],
                  ['name' => 'Indoor Grill', 'target' => ''],
                  ['name' => 'Kitchen Reverse Osmosis System', 'target' => ''],
                  ['name' => 'Microwave', 'target' => ''],
                  ['name' => 'Range Electric', 'target' => ''],
                  ['name' => 'Range Gas', 'target' => ''],
                  ['name' => 'Range Hood', 'target' => ''],
                  ['name' => 'Refrigerator', 'target' => ''],
                  ['name' => 'Solar Hot Water', 'target' => ''],
                  ['name' => 'Solar Hot Water Owned', 'target' => ''],
                  ['name' => 'Solar Hot Water Rented', 'target' => ''],
                  ['name' => 'Tankless Water Heater', 'target' => ''],
                  ['name' => 'Trash Compactor', 'target' => ''],
                  ['name' => 'Washer', 'target' => ''],
                  ['name' => 'Water Filtration System', 'target' => ''],
                  ['name' => 'Water Purifier', 'target' => ''],
                  ['name' => 'Water Softener', 'target' => ''],
                  ['name' => 'Whole House R.O. System', 'target' => ''],
                  ['name' => 'Wine Refrigerator', 'target' => ''],
                  ['name' => 'None', 'target' => ''],
                  ['name' => 'Other', 'target' => ''],
              ];
            @endphp
            <div class="form-group">
              <label class="fw-bold">What appliances are included? </label>
              <select class="grid-picker" name="lot_size" id="lot_size" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($appliances as $appliance)
                  <option value="{{ $appliance['name'] }}" data-target="{{ $appliance['target'] }}"
                    class="card flex-column " style="width:calc(20% - 10px);">
                    {{ $appliance['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div> --}}
          <div class="wizard-step" data-step="10">
            @php
              $yes_or_nos = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              $requires_or_no = [['name' => 'Yes', 'target' => '.custom_insurance', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              $requires_or_no1 = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              $requires_or_no2 = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              $requires_or_no3 = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Is flood insurance required?</label>
              <select class="grid-picker" name="flood_insurance" id="flood_insurance"
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($requires_or_no as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group custom_insurance d-none">
              <label class="fw-bold">How much is the flood insurance?</label>
              <input type="text" name="custom_insurance" id="custom_insurance" class="form-control has-icon"
                data-icon="fa-solid fa-dollar-sign" required>
            </div>
          </div>

          <div class="wizard-step" data-step="11">
            @php
              $pets = [['name' => 'Yes', 'target' => '.custom_pets', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              $pet_types = [['name' => 'Dog', 'target' => ''], ['name' => 'Cat', 'target' => ''], ['name' => 'Other', 'target' => '.other_pets']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Are pets allowed? </label>
              <select class="grid-picker" name="pets" id="pets" style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($pets as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group custom_pets d-none">
              <label class="fw-bold">Type of pets allowed:</label>
              <select class="grid-picker" name="custom_pets" id="prop_conditions" required>
                <option value="">Select</option>
                @foreach ($pet_types as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group d-none other_pets">
                <label class="fw-bold">Number of pets allowed:</label>
                <input type="number" name="number_of_pets" id="number_of_pets" class="form-control has-icon"
                  data-icon="fa-solid fa-qrcode" required>
                <label class="fw-bold">Max pet weight:</label>
                <input type="text" name="pet_weight" id="pet_weight" class="form-control has-icon"
                  data-icon="fa-solid fa-qrcode" required>
                <label class="fw-bold">Pet restrictions:</label>
                <input type="text" name="pet_restrictions" id="pet_restrictions" class="form-control has-icon"
                  data-icon="fa-solid fa-qrcode" required>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="12">
            <div class="form-group">
              @php
                $association = [['name' => 'Yes', 'target' => '.associationYesRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              @endphp
              <label class="fw-bold">Does the property have an HOA, condo association, master association, and/or
                community fee? </label>
              <select class="grid-picker" name="associationOpt" id="pools" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($association as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group d-none associationYesRes">
                <label class="fw-bold">Does the property have an HOA, condo association, master association, and/or
                  community fee? </label>
                <label class="fw-bold">HOA Fee:</label>
                <input type="number" name="custom_garage" id="custom_garage" class="form-control has-icon"
                  data-icon="fa-solid fa-qrcode" required>
                <div class="form-group">
                  @php
                    $paymentSchedule = [['name' => 'Annually', 'target' => '', 'icon' => 'f'], ['name' => 'Monthly', 'target' => '', 'icon' => ''], ['name' => 'Quarterly', 'target' => '', 'icon' => ''], ['name' => 'Semi-Annually', 'target' => '', 'icon' => '']];
                  @endphp
                  <label class="fw-bold">HOA Payment Schedule:</label>
                  <select class="grid-picker" name="paymentSchedule" id=""
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($paymentSchedule as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Condo Fee:</label>
                  <input type="text" name="condoFee" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  @php
                    $condoSchedule = [['name' => 'Annually', 'target' => '', 'icon' => 'f'], ['name' => 'Monthly', 'target' => '', 'icon' => ''], ['name' => 'Quarterly', 'target' => '', 'icon' => ''], ['name' => 'Semi-Annually', 'target' => '', 'icon' => '']];
                  @endphp
                  <label class="fw-bold">Condo Payment Schedule: </label>
                  <select class="grid-picker" name="condoSchedule" id="" style="justify-content: flex-start;"
                    required>
                    <option value="">Select</option>
                    @foreach ($condoSchedule as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  @php
                    $masterAssocYesRes = [['name' => 'Yes', 'target' => '.masterAssocYesRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
                  @endphp
                  <label class="fw-bold">Master Association: </label>
                  <select class="grid-picker" name="masterAssoc" id="pools" style="justify-content: flex-start;"
                    required>
                    <option value="">Select</option>
                    @foreach ($masterAssocYesRes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group d-none masterAssocYesRes">
                    <label class="fw-bold">Master Association Fee:</label>
                    <input type="text" name="csutomMasterAssoc" id="custom_garage" class="form-control has-icon"
                      data-icon="fa-solid fa-qrcode" required>
                  </div>
                </div>
                <div class="form-group">
                  @php
                    $masterAssocFee = [['name' => 'Annually', 'target' => '', 'icon' => 'f'], ['name' => 'Monthly', 'target' => '', 'icon' => ''], ['name' => 'Quarterly', 'target' => '', 'icon' => ''], ['name' => 'Semi-Annually', 'target' => '', 'icon' => '']];
                  @endphp
                  <label class="fw-bold">Master Association Fee Schedule: </label>
                  <select class="grid-picker" name="masterAssocFee" id=""
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($masterAssocFee as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Master Association Name:</label>
                  <input type="text" name="masterAssocName" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Master Association Contact Phone: </label>
                  <input type="text" name="masterAssocPhone" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  @php
                    $additionalFeeRes = [['name' => 'Yes', 'target' => '.additionalFeeRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
                  @endphp
                  <label class="fw-bold">Are there any additional fees? </label>
                  <select class="grid-picker" name="additionalFee" id="pools" style="justify-content: flex-start;"
                    required>
                    <option value="">Select</option>
                    @foreach ($additionalFeeRes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group d-none additionalFeeRes">
                    <label class="fw-bold">What is the fee for? </label>
                    <input type="text" name="customFee" id="custom_garage" class="form-control has-icon"
                      data-icon="fa-solid fa-qrcode" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Other Fee: </label>
                  <input type="text" name="otherFee" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  @php
                    $otherScheduleFee = [['name' => 'Annually', 'target' => '', 'icon' => 'f'], ['name' => 'Monthly', 'target' => '', 'icon' => ''], ['name' => 'Quarterly', 'target' => '', 'icon' => ''], ['name' => 'Semi-Annually', 'target' => '', 'icon' => '']];
                  @endphp
                  <label class="fw-bold">Other Fee Schedule: </label>
                  <select class="grid-picker" name="otherScheduleFee" id=""
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($otherScheduleFee as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Association/Manger Contact Name: </label>
                  <input type="text" name="mangerName" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Association/Manger Contact Email: </label>
                  <input type="text" name="managerEmail" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Association/Manger Contact Phone:</label>
                  <input type="text" name="managerPhone" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Association/Manger Contact Website Address:</label>
                  <input type="text" name="managerWeb" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
                <div class="form-group">
                  @php
                    $housesRes = [['name' => 'Yes', 'target' => '.housesRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
                  @endphp
                  <label class="fw-bold">Housing for Older Persons: </label>
                  <select class="grid-picker" name="houses" id="pools" style="justify-content: flex-start;"
                    required>
                    <option value="">Select</option>
                    @foreach ($housesRes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="13">
            <div class="form-group">
              @php
                $communityFeature = [
                    ['name' => 'Airport/Runway', 'target' => ''],
                    ['name' => 'Association Recreation - Lease', 'target' => ''],
                    ['name' => 'Association Recreation - Owned', 'target' => ''],
                    ['name' => 'Buyer Approval Required', 'target' => ''],
                    ['name' => 'Clubhouse', 'target' => ''],
                    ['name' => 'Community Boat Ramp', 'target' => ''],
                    ['name' => 'Community Mailbox', 'target' => ''],
                    ['name' => 'Deed Restrictions', 'target' => ''],
                    ['name' => 'Dog Park', 'target' => ''],
                    ['name' => 'Fishing', 'target' => ''],
                    ['name' => 'Fitness Center', 'target' => ''],
                    ['name' => 'Gated Community - Guard', 'target' => ''],
                    ['name' => 'Gated Community - No Guard', 'target' => ''],
                    ['name' => 'Golf Carts OK', 'target' => ''],
                    ['name' => 'Golf Community', 'target' => ''],
                    ['name' => 'Handicap Modified', 'target' => ''],
                    ['name' => 'Horse Stable(s)', 'target' => ''],
                    ['name' => 'Horses Allowed', 'target' => ''],
                    ['name' => 'Irrigation-Reclaimed Water', 'target' => ''],
                    ['name' => 'Lake', 'target' => ''],
                    ['name' => 'No Truck/RV/Motorcycle Parking', 'target' => ''],
                    ['name' => 'None', 'target' => ''],
                    ['name' => 'Park', 'target' => ''],
                    ['name' => 'Playground', 'target' => ''],
                    ['name' => 'Pool', 'target' => ''],
                    ['name' => 'Public Boat Ramp', 'target' => ''],
                    ['name' => 'Racquetball', 'target' => ''],
                    ['name' => 'Restaurant', 'target' => ''],
                    ['name' => 'Sidewalk', 'target' => ''],
                    ['name' => 'Special Community Restrictions', 'target' => ''],
                    ['name' => 'Stream Seasonal', 'target' => ''],
                    ['name' => 'Tennis Courts', 'target' => ''],
                    ['name' => 'Water Access', 'target' => ''],
                    ['name' => 'Waterfront', 'target' => ''],
                    ['name' => 'Wheelchair Access', 'target' => ''],
                ];

              @endphp
              <label class="fw-bold">Community Features: </label>
              <select class="grid-picker" name="communityFeature[]" id="pools"
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($communityFeature as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step="14">
            <div class="form-group">
              @php
                $assocAmenities = [
                    ['name' => 'Airport/Runway', 'target' => ''],
                    ['name' => 'Basketball Court', 'target' => ''],
                    ['name' => 'Boat Slip', 'target' => ''],
                    ['name' => 'Cable', 'target' => ''],
                    ['name' => 'Clubhouse', 'target' => ''],
                    ['name' => 'Dock', 'target' => ''],
                    ['name' => 'Elevators', 'target' => ''],
                    ['name' => 'Fence Restrictions', 'target' => ''],
                    ['name' => 'Fitness Center', 'target' => ''],
                    ['name' => 'Gated', 'target' => ''],
                    ['name' => 'Golf Course', 'target' => ''],
                    ['name' => 'Handicap Modified', 'target' => ''],
                    ['name' => 'Horse Stables', 'target' => ''],
                    ['name' => 'Laundry', 'target' => ''],
                    ['name' => 'Lobby Key Required', 'target' => ''],
                    ['name' => 'Maintenance', 'target' => ''],
                    ['name' => 'Marina', 'target' => ''],
                    ['name' => 'Optional Additional Fees', 'target' => ''],
                    ['name' => 'Other', 'target' => ''],
                    ['name' => 'Park', 'target' => ''],
                    ['name' => 'Pickleball Court(s)', 'target' => ''],
                    ['name' => 'Playground', 'target' => ''],
                    ['name' => 'Pool', 'target' => ''],
                    ['name' => 'Private Boat Ramp', 'target' => ''],
                    ['name' => 'Racquet Ball', 'target' => ''],
                    ['name' => 'Recreation Facilities', 'target' => ''],
                    ['name' => 'Sauna', 'target' => ''],
                    ['name' => 'Security', 'target' => ''],
                    ['name' => 'Shuffleboard Court', 'target' => ''],
                    ['name' => 'Spa/Hot Tub', 'target' => ''],
                    ['name' => 'Storage', 'target' => ''],
                    ['name' => 'Tennis Court(s)', 'target' => ''],
                    ['name' => 'Trails', 'target' => ''],
                    ['name' => 'Vehicle Restrictions', 'target' => ''],
                    ['name' => 'Wheelchair Access', 'target' => ''],
                ];

              @endphp
              <label class="fw-bold">Association Amenities: </label>
              <select class="grid-picker" name="assocAmenities[]" id="pools" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($assocAmenities as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step="15">
            <div class="form-group">
              @php
                $feeIncludes = [
                    ['name' => '24-Hour Guard', 'target' => ''],
                    ['name' => 'Cable TV', 'target' => ''],
                    ['name' => 'Common Area Taxes', 'target' => ''],
                    ['name' => 'Community Pool', 'target' => ''],
                    ['name' => 'Electricity', 'target' => ''],
                    ['name' => 'Escrow Reserves Fund', 'target' => ''],
                    ['name' => 'Fidelity Bond', 'target' => ''],
                    ['name' => 'Gas', 'target' => ''],
                    ['name' => 'Insurance', 'target' => ''],
                    ['name' => 'Internet', 'target' => ''],
                    ['name' => 'Maintenance Exterior', 'target' => ''],
                    ['name' => 'Maintenance Grounds', 'target' => ''],
                    ['name' => 'Maintenance Repairs', 'target' => ''],
                    ['name' => 'Manager', 'target' => ''],
                    ['name' => 'None', 'target' => ''],
                    ['name' => 'Other', 'target' => ''],
                    ['name' => 'Pest Control', 'target' => ''],
                    ['name' => 'Pool Maintenance', 'target' => ''],
                    ['name' => 'Private Road', 'target' => ''],
                    ['name' => 'Recreational Facilities', 'target' => ''],
                    ['name' => 'Security', 'target' => ''],
                    ['name' => 'Sewer', 'target' => ''],
                    ['name' => 'Trash', 'target' => ''],
                    ['name' => 'Water', 'target' => ''],
                ];
              @endphp
              <label class="fw-bold">Fee Includes: </label>
              <select class="grid-picker" name="feeIncludes[]" id="" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($feeIncludes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step="16">
            <span class="resFields">
              <div class="form-group">
                @php
                  $waterAccessRes = [['name' => 'Yes', 'target' => '.waterAccessRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'], ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question']];
                @endphp
                <label class="fw-bold">Water Access:</label>
                <select class="grid-picker" name="has_water_access" id="has_water_access"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterAccessRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $water_access = [['name' => 'Bay/Harbor', 'target' => ''], ['name' => 'Bayou', 'target' => ''], ['name' => 'Beach', 'target' => ''], ['name' => 'Beach - Access Deeded', 'target' => ''], ['name' => 'Brackish Water', 'target' => ''], ['name' => 'Canal - Brackish', 'target' => ''], ['name' => 'Canal - Freshwater', 'target' => ''], ['name' => 'Canal - Saltwater', 'target' => ''], ['name' => 'Creek', 'target' => ''], ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''], ['name' => 'Gulf/Ocean', 'target' => ''], ['name' => 'Gulf/Ocean to Bay', 'target' => ''], ['name' => 'Intracoastal Waterway', 'target' => ''], ['name' => 'Lagoon/Estuary', 'target' => ''], ['name' => 'Lake', 'target' => ''], ['name' => 'Lake - Chain of Lakes', 'target' => ''], ['name' => 'Limited Access', 'target' => ''], ['name' => 'Marina', 'target' => ''], ['name' => 'Pond', 'target' => ''], ['name' => 'River', 'target' => '']];
              @endphp
              <div class="form-group waterAccessRes d-none">
                <select class="grid-picker" name="water_access[]" id="water_access"
                  style="justify-content: flex-start;" multiple>
                  <option value="">Select</option>
                  @foreach ($water_access as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      data-icon="<i class='fa-regular fa-circle-check'></i>" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group ">
                @php
                  $waterViewRes = [['name' => 'Yes', 'target' => '.waterViewRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'], ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question']];
                @endphp
                <label class="fw-bold">Water View:</label>
                <select class="grid-picker" name="has_water_view" id="has_water_view"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterViewRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $water_views = [['name' => 'Bay/Harbor - Full', 'target' => ''], ['name' => 'Bay/Harbor - Partial', 'target' => ''], ['name' => 'Bayou', 'target' => ''], ['name' => 'Beach', 'target' => ''], ['name' => 'Canal', 'target' => ''], ['name' => 'Creek', 'target' => ''], ['name' => 'Gulf/Ocean - Full', 'target' => ''], ['name' => 'Gulf/Ocean - Partial', 'target' => ''], ['name' => 'Gulf/Ocean to Bay', 'target' => ''], ['name' => 'Intracoastal Waterway', 'target' => ''], ['name' => 'Lagoon/Estuary', 'target' => ''], ['name' => 'Lake', 'target' => ''], ['name' => 'Lake - Chain of Lakes', 'target' => ''], ['name' => 'Marina', 'target' => ''], ['name' => 'Pond', 'target' => ''], ['name' => 'River', 'target' => ''], ['name' => 'None', 'target' => '']];
              @endphp
              <div class="form-group waterViewRes d-none ">
                <select class="grid-picker" name="water_view[]" id="water_view" style="justify-content: flex-start;"
                  multiple>
                  <option value="">Select</option>
                  @foreach ($water_views as $water_view)
                    <option value="{{ $water_view['name'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $water_view['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);">
                      {{ $water_view['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                @php
                  $waterExtraRes = [['name' => 'Yes', 'target' => '.waterExtraRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'], ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question']];
                @endphp
                <label class="fw-bold">Water Extras:</label>
                <select class="grid-picker" name="has_water_extra" id="has_water_extra"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterExtraRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $water_extras = [
                    ['name' => 'Assigned Boat Slip', 'target' => ''],
                    ['name' => 'Boat Port', 'target' => ''],
                    ['name' => 'Boat Ramp - Private', 'target' => ''],
                    ['name' => 'Boathouse', 'target' => ''],
                    ['name' => 'Boats - None Allowed', 'target' => ''],
                    ['name' => 'Bridges - Fixed', 'target' => ''],
                    ['name' => 'Bridges - No Fixed Bridges', 'target' => ''],
                    ['name' => 'Davits', 'target' => ''],
                    ['name' => 'Dock - Composite', 'target' => ''],
                    ['name' => 'Dock - Concrete', 'target' => ''],
                    ['name' => 'Dock - Covered', 'target' => ''],
                    ['name' => 'Dock - Open', 'target' => ''],
                    ['name' => 'Dock - Slip 1st Come', 'target' => ''],
                    ['name' => 'Dock - Slip Deeded Off-Site', 'target' => ''],
                    ['name' => 'Dock - Slip Deeded On-Site', 'target' => ''],
                    ['name' => 'Dock - Wood', 'target' => ''],
                    ['name' => 'Dock w/Electric', 'target' => ''],
                    ['name' => 'Dock w/o Electric', 'target' => ''],
                    ['name' => 'Dock w/o Water Supply', 'target' => ''],
                    ['name' => 'Dock w/Water Supply', 'target' => ''],
                    ['name' => 'Fishing Pier', 'target' => ''],
                    ['name' => 'Lift', 'target' => ''],
                    ['name' => 'Lift - Covered', 'target' => ''],
                    ['name' => 'Lock', 'target' => ''],
                    ['name' => 'Minimum Wake Zone', 'target' => ''],
                    ['name' => 'No Wake Zone', 'target' => ''],
                    ['name' => 'Powerboats – None Allowed', 'target' => ''],
                    ['name' => 'Private Lake Dues Required', 'target' => ''],
                    ['name' => 'Riprap', 'target' => ''],
                    ['name' => 'Sailboat Water', 'target' => ''],
                    ['name' => 'Seawall - Concrete', 'target' => ''],
                    ['name' => 'Seawall - Other', 'target' => ''],
                    ['name' => 'Skiing Allowed', 'target' => ''],
                    ['name' => 'None', 'target' => ''],
                ];
              @endphp
              <div class="form-group waterExtraRes d-none ">
                <select class="grid-picker" name="water_extras[]" id="water_extras"
                  style="justify-content: flex-start;" multiple>
                  <option value="">Select</option>
                  @foreach ($water_extras as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      data-icon="<i class='fa-regular fa-circle-check'></i>" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                @php
                  $waterFrontageRes = [['name' => 'Yes', 'target' => '.waterFrontageRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'], ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question']];
                @endphp
                <label class="fw-bold">Water Frontage:</label>
                <select class="grid-picker" name="has_water_fontage" id="has_water_fontage"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterFrontageRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $water_frontage = [['name' => 'Bay/Harbor', 'target' => ''], ['name' => 'Bayou', 'target' => ''], ['name' => 'Beach', 'target' => ''], ['name' => 'Brackish Water', 'target' => ''], ['name' => 'Canal - Brackish', 'target' => ''], ['name' => 'Canal - Freshwater', 'target' => ''], ['name' => 'Canal - Saltwater', 'target' => ''], ['name' => 'Creek', 'target' => ''], ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''], ['name' => 'Gulf/Ocean', 'target' => ''], ['name' => 'Gulf/Ocean to Bay', 'target' => ''], ['name' => 'Intracoastal Waterway', 'target' => ''], ['name' => 'Lagoon/Estuary', 'target' => ''], ['name' => 'Lake', 'target' => ''], ['name' => 'Lake - Chain of Lakes', 'target' => ''], ['name' => 'Marina', 'target' => ''], ['name' => 'Pond', 'target' => ''], ['name' => 'River', 'target' => '']];
              @endphp
              <div class="form-group waterFrontageRes d-none">
                <select class="grid-picker" name="water_frontage[]" id="water_frontage"
                  style="justify-content: flex-start;" multiple>
                  <option value="">Select</option>
                  @foreach ($water_frontage as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row"
                      style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                @php
                  $waterPreferenceRes = [['name' => 'Yes', 'target' => '.waterPreferenceRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'], ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question']];
                @endphp
                <label class="fw-bold">What is the condition of the property? </label>
                <select class="grid-picker" name="viewOptions" id="has_view_prefrence"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterPreferenceRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @php
                $view = [['name' => 'City', 'target' => ''], ['name' => 'Garden', 'target' => ''], ['name' => 'Golf Course', 'target' => ''], ['name' => 'Greenbelt', 'target' => ''], ['name' => 'Mountain(s)', 'target' => ''], ['name' => 'Park', 'target' => ''], ['name' => 'Pool', 'target' => ''], ['name' => 'Tennis Court', 'target' => ''], ['name' => 'Trees/Woods', 'target' => ''], ['name' => 'Water', 'target' => ''], ['name' => 'Other', 'target' => '.viewOtherRes']];
              @endphp
              <div class="form-group waterPreferenceRes d-none">
                <select class="grid-picker" name="view[]" id="view" style="justify-content: flex-start;"
                  multiple>
                  <option value="">Select</option>
                  @foreach ($view as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row"
                      style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group viewOtherRes d-none">
                  <label class="fw-bold">What is the condition of the property? </label>
                  <input type="text" name="viewOther" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-qrcode" required>
                </div>
              </div>
            </span>
          </div>
          <div class="wizard-step" data-step="17">
            @php
              $pools = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Does the property have a pool? </label>
              <select class="grid-picker" name="pools" id="pools" style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($pools as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step="18">
            @php
              $garage = [['name' => 'Yes', 'target' => '.custom_garage', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Does the property have a garage? </label>
              <select class="grid-picker" name="garage" id="garage" style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($garage as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group d-none custom_garage">
              <label class="fw-bold">How many garage spaces? </label>
              <input type="number" name="custom_garage" id="custom_garage" class="form-control has-icon"
                data-icon="fa-solid fa-qrcode" required>
            </div>
          </div>
          <div class="wizard-step" data-step="19">
            @php
              $carport = [['name' => 'Yes', 'target' => '.custom_carport', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Does the property have a carport? </label>
              <select class="grid-picker" name="carport" id="carport" style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($carport as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group d-none custom_carport">
              <label class="fw-bold">How many carport spaces?</label>
              <input type="number" name="custom_carport" id="custom_carport" class="form-control has-icon"
                data-icon="" required>
            </div>
          </div>
          <div class="wizard-step" data-step="20">
            @php
              $propConditionsRes = [['name' => 'Pre-Construction', 'target' => ''], ['name' => 'Currently Being Built', 'target' => ''], ['name' => 'New Construction', 'target' => ''], ['name' => 'Completely Updated: No updates needed', 'target' => ''], ['name' => 'Semi-updated: Needs minor updates', 'target' => ''], ['name' => 'Not Updated: Requires a complete update', 'target' => ''], ['name' => 'Tear Down: Requires complete demolition and reconstruction', 'target' => ''], ['name' => 'Other', 'target' => '.propConditionOtherRes']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">What is the condition of the property? </label>
              <select class="grid-picker" name="prop_conditions[]" multiple id="prop_conditions" required>
                <option value="">Select</option>
                @foreach ($propConditionsRes as $item)
                  <option value="{{ $item['name'] }}" class="card flex-row" data-target="{{ $item['target'] }}"
                    style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group d-none propConditionOtherRes">
              <label class="fw-bold">What is the condition of the property? </label>
              <input type="number" name="custom_prop_conditions" id="custom_prop_conditions"
                class="form-control has-icon" data-icon="fa-solid fa-qrcode" required>
            </div>
          </div>
          {{-- Changes by Waqas  Start --}}

          <div class="wizard-step" data-step="21">
            <div class="form-group">
              <label class="fw-bold"> Is the property currently offered leased? </label>
              <select class="grid-picker" name="is_leased" id="is_leased" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($yes_or_nos as $item)
                  @php
                    if ($item['name'] == 'Yes') {
                        $target = '.commercial_fields';
                    } else {
                        $target = '';
                    }
                  @endphp
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row "
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="card-body commercial_fields d-none">
              <div class="row align-items-end">
                <div class="form-group col-md-12">
                  <label class="fw-bold">Current Rental Price:</label>
                  <input type="number" name="current_rental_price" placeholder="0.00"
                    class="form-control has-icon" data-icon="fa-solid fa-dollar" required>
                </div>
                @php
                  $utilities = [['name' => '3 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => '9 months', 'target' => ''], ['name' => '1 year', 'target' => ''], ['name' => '2 year', 'target' => ''], ['name' => '3-5 years', 'target' => ''], ['name' => 'Month to Month', 'target' => ''], ['name' => 'Other', 'target' => '']];
                @endphp
                <div class="form-group col-md-12">
                  <label class="fw-bold">Current Lease Terms:</label>
                  <select class="grid-picker" name="leased_term" id="leased_term"
                    style="justify-content: flex-start;" multiple required>
                    <option value="">Select</option>
                    @foreach ($utilities as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-row" style="width:calc(25% - 10px);">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                {{-- Changes By Waqas --}}
                <div class="form-group col-md-6">
                  <label for="address" class="fw-bold">Lease Start Date :</label>
                  <input type="date" name="move_in_date" id="move_in_date"
                    class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days"
                    data-msg-required="Please enter listing date" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="address" class="fw-bold">Lease Expiration Date:</label>
                  <input type="date" name="lease_expiration_date" id="lease_expiration_date"
                    class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days"
                    data-msg-required="Please enter listing date" required>
                </div>
                <div class="form-group only_income_property">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Unit #: </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" name="lease_unit[]" placeholder="Unit" data-type="unit"
                            id="unit" class="form-control  search_places" data-icon="fa-solid fa-unit"
                            data-msg-required="Please enter unit" required>
                        </td>
                      </tr>
                      <tr class="unit_btn_row">
                        <td><button type="button" class="btn btn-secondary btn-sm w-100 add-new-btn"
                            onclick="add_city_row()"><i class="fa-solid fa-plus"></i> Add New
                            Row</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Security Deposit:</label>
                  <input type="number" name="security_deposit" placeholder="0.00" class="form-control has-icon"
                    data-icon="fa-solid fa-dollar" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Did the tenant pay the last month's rent?</label>
                  <select class="grid-picker" name="is_tenant_pay_rent" id="is_tenant_pay_rent"
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($requires_or_no1 as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-row" style="width:calc(33.3% - 10px);"
                        data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Is the tenant current on rent?</label>
                  <select class="grid-picker" name="is_tenant_on_rent" id="is_tenant_on_rent"
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($requires_or_no2 as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-row " style="width:calc(33.3% - 10px);"
                        data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>

              </div>
            </div>
          </div>
          {{-- changes --}}
          <div class="wizard-step" data-step="22">
            <div class="form-group">
              @php
                $contingencies = [['name' => 'Contingency', 'target' => '.contingency', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Inspection', 'target' => '.inspection', 'icon' => 'fa-regular fa-circle-check']];

                $inspection = [['name' => 'Inspection contingency (days)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Appraisal contingency (days)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Financing contingency (days)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Sale of a property contingency (days)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '.custom_inspection', 'icon' => 'fa-regular fa-circle-check']];
              @endphp

              <div class="form-group">
                <label class="fw-bold">Acceptable Contingencies :</label>
                <select class="grid-picker" name="contingencies" id="carport"
                  style="justify-content: flex-start;" required>
                  <option value="">Select</option>
                  @foreach ($contingencies as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);"
                      data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group contingency d-none">
                <label class="fw-bold">Contingencies :</label>
                <input type="text" name="contingency" id="contingency" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar" required>
              </div>
              <div class="form-group inspection d-none">
                <label class="fw-bold">Inspection :</label>
                <select class="grid-picker" name="inspection" id="carport" style="justify-content: flex-start;"
                  required>
                  <option value="">Select</option>
                  @foreach ($inspection as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);"
                      data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group custom_inspection d-none">
                  <label class="fw-bold">Please enter Contingency (days) :</label>
                  <input type="text" name="custom_inspection" id="custom_inspection"
                    class="form-control has-icon" data-icon="fa-solid fa-dollar" required>
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="wizard-step" data-step="11">
            <div class="form-group">
              <label class="fw-bold">Offered Closing Date: </label>
              <input type="date" name="offer_closing_date" id="offer_closing_date"
                class="form-control has-icon" data-icon="fa-regular fa-calendar" required>
            </div>
            <div class="form-group">
              <label class="fw-bold">What is the desired number of days for the seller to complete the closing
                process?
              </label>
              <input type="number" name="number_of_days" id="number_of_days" class="form-control has-icon"
                data-icon="fas fa-calendar-day" required>
            </div>
          </div>
          <div class="wizard-step" data-step="11">
            @php
              $selle_offer = [['name' => 'Yes', 'target' => '.custom_offer', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Is the seller offering a credit to the buyer at closing? </label>
              <select class="grid-picker" name="selle_offer" id="selle_offer" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($selle_offer as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group d-none custom_offer">
              <label class="fw-bold"> Please enter the offered buyer’s credit:</label>
              <input type="number" name="custom_offer" id="custom_offer" class="form-control has-icon"
                data-icon="" required>
            </div>
          </div> --}}

          <div class="wizard-step" data-step="23">
            <div class="form-group">
              <label class="fw-bold" for="price">Offered Price:</label>
              <input type="number" step="0.01" name="max_price" placeholder="0.00" id="price"
                class="form-control has-icon hide_arrow" data-icon="fa-solid fa-dollar"
                data-msg-required="Please enter Price" autofocus required>
            </div>
            @php
              $financingsRes = [
                  ['name' => 'Cash', 'target' => ''],
                  ['name' => 'Conventional', 'target' => ''],
                  ['name' => 'FHA', 'target' => ''],
                  ['name' => 'VA', 'target' => ''],
                  ['name' => 'Litecoin (LTC)', 'target' => ''],
                  ['name' => 'Bitcoin Cash (BCH)', 'target' => ''],
                  ['name' => 'Dash (DASH)', 'target' => ''],
                  ['name' => 'Ripple (XRP)', 'target' => ''],
                  ['name' => 'Tether (USDT)', 'target' => ''],
                  ['name' => 'USD Coin (USDC)', 'target' => ''],
                  ['name' => 'NFT', 'target' => '.nftRes'],
                  ['name' => 'Private Financing Available', 'target' => ''],
                  ['name' => 'USDA', 'target' => ''],
                  ['name' => 'Assumable', 'target' => '.assumableRes'],
                  ['name' => 'Acceptable Exchange Item', 'target' => '.custom_exchange'],
                  ['name' => 'Lease Option', 'target' => ''],
                  ['name' => 'Lease Purchase', 'target' => ''],
                  ['name' => 'Special Funding', 'target' => ''],
                  ['name' => 'Seller Financing', 'target' => '.custom_seller_financings'],
                  ['name' => 'Cryptocurrency', 'target' => '.cryptoRes'],
                  ['name' => 'Prepayment Penalty', 'target' => '.prepaymentRes'],
                  ['name' => 'Balloon Payment', 'target' => '.balloonPaymentRes'],
                  ['name' => 'Other', 'target' => '.otherRes'],
              ];
            @endphp

            <div class="form-group">
              <label class="fw-bold">Acceptable Currency/Financing Type:</label>
              <select class="grid-picker" name="financing" id="financingRes" style="justify-content: flex-start;"
                required>
                @foreach ($financingsRes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>

            </div>
            {{-- Other --}}
            <div class="form-group otherRes d-none">
              <div class="form-group">
                <label class="fw-bold">Acceptable Currency/Financing: </label>
                <input type="text" name="financingOther[]" id=""
                  class="form-control form-control has-icon" data-icon="fa-solid fa-dollar" required>
              </div>
            </div>
            {{-- Other --}}

            {{-- Lease --}}
            <div class="form-group row" id="leaseOptionRes" style="display: none;">
              <div class="form-group">
                <label class="fw-bold" for="desired-offering-price">What is the seller's desired offering price for a
                  lease
                  purchase?</label>
                <input type="text" id="desired-offering-price" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="specific-terms">What specific terms does the seller propose for the lease
                  purchase?</label>
                <input type="text" id="specific-terms" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="proposed-duration">What is the proposed duration of the lease?</label>
                <input type="text" id="proposed-duration" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="monthly-payment">What is the monthly payment amount the seller is
                  seeking?</label>
                <input type="text" id="monthly-payment" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="conditions-requirements">Are there any specific conditions or requirements
                  outlined by the
                  seller for the lease purchase?</label>
                <input type="text" id="conditions-requirements" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="option-fee">Does the seller require an option fee, and if so, what is the
                  amount?</label>
                <input type="text" id="option-fee" name="lease[]" class="form-control form-control has-icon">
              </div>
              <div class="form-group">
                <label class="fw-bold" for="changes-in-offering-price">Is there a possibility of changes in the
                  offering price during
                  the lease period?</label>
                <input type="text" id="changes-in-offering-price" name="lease[]"
                  class="form-control form-control has-icon">
              </div>
            </div>
            {{-- Lease  --}}
            {{-- Customt fields fro seller_financings --}}
            <div class="form-group row custom_seller_financings d-none">
              <div class="form-group col-md-4">
                <label class="fw-bold">Puchase Price:</label>
                <input type="text" name="sellerFinancing[]" id=""
                  class="form-control form-control has-icon" data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Down Payment:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Seller Financing Amount:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Interest rate:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Term:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Monthly Payments:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group col-md-4">
                <label class="fw-bold">Closing Costs:</label>
                <input type="text" name="sellerFinancing[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
            </div>

            {{-- Assumable --}}
            <div class="form-group assumableRes d-none">
              <div class="form-group">
                <label class="fw-bold">What assumable terms are being offered?</label>
                <input type="text" name="assumable[]" id="" class="form-control form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold"> Are there any restrictions or qualifications for a buyer assuming the existing
                  financing?</label>
                <input type="text" name="assumable[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold">Is there any outstanding balance on the existing financing that the buyer would
                  need to cover?</label>
                <input type="text" name="assumable[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
            </div>

            {{-- Assumable --}}
            {{-- Cryptocurrency --}}
            <div class="form-group cryptoRes d-none">
              <div class="form-group">
                <label class="fw-bold">What type of cryptocurrency will the seller accept?</label>
                <input type="text" name="crypto[]" id="" class="form-control form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold"> What percentage of the purchase price will the seller accept in
                  cryptocurrency?</label>
                <input type="text" name="crypto[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold">What percentage of the purchase price will the seller accept in cash?</label>
                <input type="text" name="crypto[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
            </div>
            {{-- Cryptocurrency --}}
            {{-- NFT --}}
            <div class="form-group nftRes d-none">
              <div class="form-group">
                <label class="fw-bold">What type of NFT will the seller accept?</label>
                <input type="text" name="nft[]" id="" class="form-control form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold">What percentage of the purchase price will the seller accept as an NFT?</label>
                <input type="text" name="nft[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
              <div class="form-group">
                <label class="fw-bold">What percentage of the purchase price will the seller accept in cash?</label>
                <input type="text" name="nft[]" id="" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar">
              </div>
            </div>
            {{-- NFT --}}
            {{-- Exchange Item --}}
            <div class="form-group custom_exchange d-none">
              <div class="form-group">
                @php
                  $exchangeItemRes = [['name' => 'Another Home', 'target' => ''], ['name' => 'Vehicle', 'target' => ''], ['name' => 'Boat', 'target' => ''], ['name' => 'Motorhome', 'target' => ''], ['name' => 'Artwork', 'target' => ''], ['name' => 'Jewelry', 'target' => ''], ['name' => 'Other', 'target' => '.exchangeOtherRes']];
                @endphp
                <label class="fw-bold">Offered Exchange Item :</label>
                <select class="grid-picker" name="carport" id="carport" style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($exchangeItemRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);"
                      data-icon='<i class="fa-regular fa-circle-check"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group exchangeOtherRes">
                  <div class="form-group">
                    <label class="fw-bold">What is the estimated value of the acceptable exchange/trade item? </label>
                    <input type="text" name="exchangeOther[]" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-dollar">
                  </div>
                  <div class="form-group">
                    <label class="fw-bold">Are there specific criteria or conditions for the type of item the seller is
                      willing to exchange/trade? </label>
                    <input type="text" name="exchangeOther[]" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-dollar">
                  </div>
                  <div class="form-group">
                    <label class="fw-bold">How much cash does the seller require on top of the Exchange/Trade item?
                    </label>
                    <input type="text" name="exchangeOther[]" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-dollar">
                  </div>
                  <div class="form-group">
                    <label class="fw-bold">How is the value of the exchange/trade item determined? </label>
                    <input type="text" name="exchangeOther[]" id="" class="form-control has-icon"
                      data-icon="fa-solid fa-dollar">
                  </div>
                </div>
              </div>
            </div>
            {{-- Exchange Item --}}
            {{-- Prepayment --}}
            <div class="form-group prepaymentRes d-none">
              @php
                $prepaymentOpt = [['name' => 'Yes', 'target' => '.prepaymentYesRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              @endphp
              <div class="form-group">
                <label class="fw-bold">Is the seller offering a credit to the buyer at closing? </label>
                <select class="grid-picker" name="prepaymentOption" id="selle_offer"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($prepaymentOpt as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);"
                      data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach

                </select>
                <div class="form-group prepaymentYesRes d-none">
                  <label class="fw-bold">What is the prepayment penalty amount?</label>
                  <input type="text" name="customPrepayment" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-dollar">
                </div>
              </div>
            </div>
            {{-- Balloon Payment --}}
            <div class="form-group balloonPaymentRes d-none">
              @php
                $balloonOpt = [['name' => 'Yes', 'target' => '.balloonYesRes', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
              @endphp
              <div class="form-group">
                <label class="fw-bold">Is the seller offering a credit to the buyer at closing? </label>
                <select class="grid-picker" name="balloonOption" id="selle_offer"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($balloonOpt as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);"
                      data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach

                </select>
                <div class="form-group balloonYesRes d-none">
                  <label class="fw-bold">How much is the balloon payment?</label>
                  <input type="text" name="customPrepayment" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-dollar">
                  <label class="fw-bold">When is the balloon payment due?</label>
                  <input type="text" name="customPrepayment" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-dollar">
                </div>
              </div>
            </div>
          </div>

          <div class="wizard-step" data-step="24">
            <div class="form-group">
              <label class="fw-bold">What is the commission offered to the buyer’s agent? </label>
              <input type="number" name="agent_commission_percent" id="agent_commission_percent" min="1"
                class="form-control has-icon" data-icon="" required>
            </div>
          </div>

          <div class="wizard-step" data-step="25">
            <div class="form-group">
              <label class="fw-bold">Description and Additional Details: Please provide any additional information
                about
                the property:</label>
              <textarea name="description" id="description" class="form-control" cols="30" rows="5" required></textarea>
            </div>
          </div>

          {{-- Changes by Waqas  End --}}
          <div class="wizard-step" data-step="26">
            <small class="">Note: The following section is privately sent to the agent.</small>
            <div class="form-group">
              <label class="fw-bold">Address of the property:</label>
              <input type="text" name="address" placeholder="199 Florida A1A, Satellite Beach, FL, USA"
                id="form_title" class="form-control search_places has-icon" data-type="address" required
                data-icon="fa-solid fa-location-dot" />
            </div>
            <div class="form-group">
              <label class="fw-bold">Pictures of the property: (upload)</label>
              <input type="file" name="property_image" placeholder="" id="property_image"
                class="form-control has-icon" data-type="address" data-icon="fa-solid fa-link" />
            </div>
            <div class="form-group">
              <label class="fw-bold">Pictures of the property: (link)</label>
              <input type="text" name="floor_plan_link" placeholder="" id="floor_plan_link"
                class="form-control has-icon" data-type="address" data-icon="fa-solid fa-link" />
            </div>

            <div class="form-group">
              <label class="fw-bold">Video of the property: (upload)</label>
              <input type="file" class="form-control" name="video_image">
            </div>
            <div class="form-group">
              <label class="fw-bold">Video of the property: (link)</label>
              <input type="text" class="form-control" name="video_url">
            </div>
            <div class="form-group">
              <label class="fw-bold">Floor plan of the property: (upload)</label>
              <input type="file" class="form-control" name="floorImage">
            </div>
            <div class="form-group">
              <label class="fw-bold">Floor plan of the property: (link)</label>
              <input type="text" class="form-control" name="flooLink">
            </div>
          </div>
          @if (auth()->user()->user_type == 'agent')
            <div class="wizard-step" data-step="27">
              <div class="form-group col-md-">
                <label class="fw-bold">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" cols="30"
                  rows="5" placeholder="First Name" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" cols="30"
                  rows="5" placeholder="Last Name" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Phone Number:</label>
                <input type="number" name="phone_number" id="phone_number" class="form-control" cols="30"
                  rows="5" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Email:</label>
                <input type="email" name="email" id="email" class="form-control" cols="30"
                  rows="5" placeholder="Email">
              </div>
              <div class="form-group">
                <label class="fw-bold">Brokerage:</label>
                <input type="text" name="brokerage" id="brokerage" class="form-control" cols="30"
                  rows="5" placeholder="Brokerage">
              </div>
              <div class="form-group">
                <label class="fw-bold">Real Estate License #</label>
                <input type="text" name="license" id="license" class="form-control" cols="30"
                  rows="5" placeholder="Real Estate License">
              </div>
              <div class="form-group">
                <label class="fw-bold">NAR Member ID (NRDS ID): </label>
                <input type="text" name="member_id" id="member_id" class="form-control" cols="30"
                  rows="5" placeholder="NAR Member ID">
              </div>
            </div>
          @elseif (auth()->user()->user_type == 'seller')
            <div class="wizard-step" data-step="27">
              <div class="form-group col-md-">
                <label class="fw-bold">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" cols="30"
                  rows="5" placeholder="First Name" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" cols="30"
                  rows="5" placeholder="Last Name">
              </div>
              <div class="form-group">
                <label class="fw-bold">Phone Number:</label>
                <input type="number" name="phone_number" id="phone_number" class="form-control" cols="30"
                  rows="5" placeholder="Phone Number">
              </div>
              <div class="form-group">
                <label class="fw-bold">Email:</label>
                <input type="email" name="email" id="email" class="form-control" cols="30"
                  rows="5" placeholder="Email">
              </div>
            </div>
          @endif



          <div class="d-flex justify-content-between form-group mt-4">
            <div>
              <a class="wizard-step-back btn btn-success btn-lg text-600" style="display: none;">Back</a>
            </div>
            <div>
              <a class="wizard-step-next btn btn-success btn-lg text-600" style="display: none;">Next</a>
              <button type="button" class="wizard-step-finish btn btn-success btn-lg text-600"
                style="display: none;">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <template class="add_new_lease">
    <tr>
      <td><input type="text" name="lease_unit[]" placeholder="Uint" data-type="unit"
          class="form-control has-icon search_places" data-icon="fa-solid fa-tree-unit"></td>
    </tr>
  </template>
  <template class="sqft mt-1"><input type="text" name="heatedSqft[]" placeholder="Heated Sqft"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="unitTypeTemp mt-1"><input type="text" name="unitTypes[]" placeholder="Unit Types"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="unitNumber mt-1"><input type="text" name="unitNumber[]" placeholder="Number of Units"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="rentBtnTemp mt-1"><input type="text" name="rent[]" placeholder="Expected Rent"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="bedUnitTemp mt-1"><input type="text" name="bedUnit[]" placeholder="Beds/Unit"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="bathUnitTemp mt-1"><input type="text" name="bathUnit[]" placeholder="Baths/Unit"
      data-type="unit" class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
  <template class="garageTemp mt-1">
    <input type="text" name="garageSpaces[]" placeholder="Garage Spaces" data-type="unit"
      class="form-control has-icon mt-1" data-icon="fa-solid fa-qrcode">
  </template>
@endsection
@push('scripts')
  <script>
    $(function() {
      $('.add-row').on('click', function() {
        var socialRow =
          `<tr>
            <td>
                <select name="socialType[]" class="form-select">
                    <option value="Facebook">Facebook</option>
                    <option value="YouTube">YouTube</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Instagram">Instagram</option>
                </select>
            </td>
            <td>
                <input type="text" name="social_link[]" class="form-control">
            </td>
        </tr>`;
        $('.social-links').append(socialRow);
      });
    });
  </script>

  <script>
    function changeAuctionType(v) {
      if (v == "Normal (Timer)") {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').hide();
        $('.normal-length').show();
      } else {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').show();
        $('.normal-length').hide();
      }
    }
    // document.getElementById('auction_type').change();
    $(function() {
      // changeAuctionType("Normal (Timer)");
    });
  </script>
  <script>
    function changePropertyType(p) {
      if (p == "Residential Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').show();
        $('.business-opportunity').hide();
        $('.vacant-land').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.only_income_property').hide();
        $('.businessOpportunity').hide();


      } else if (p == "Income Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').show();
        $('.commercial-length').hide();
        $('.only_income_property').show();
        $('.business-opportunity').hide();
        $('.vacant-land').hide();
        $('.businessOpportunity').hide();


      } else if (p == "Commercial Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();
        $('.only_income_property').hide();
        $('.business-opportunity').hide();
        $('.vacant-land').hide();
        $('.businessOpportunity').hide();


      } else if (p == "Business Opportunity") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();
        $('.only_income_property').hide();
        $('.business-opportunity').show();
        $('.vacant-land').hide();
        $('.businessOpportunity').show();


      } else if (p == "Vacant Land") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();
        $('.only_income_property').hide();
        $('.business-opportunity').hide();
        $('.vacant-land').show();
        $('.businessOpportunity').hide();


      } else {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.only_income_property').hide();
        $('.business-opportunity').hide();
        $('.vacant-land').hide();
        $('.businessOpportunity').hide();

      }
    }
    // document.getElementById('auction_type').change();
    $(function() {
      changePropertyType("");
    });
  </script>
  <script>
    $(function() {
      $(document).ready(function() {
        /* var multipleCancelButton = new Choices('.multiple', {
            removeItemButton: true,
            // maxItemCount:5,
            // searchResultLimit: 5,
            // renderChoiceLimit: 5
        }); */
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
          // console.log(val, text, icon, classes);
        });
        // console.log(html);
        // html += `</div>`;
        // $(elm).after(html);
        /* $('.option-container').on('click', function(index, elm) {
            // alert("ok");
            var ind = $(elm).data(index);
            var op = $(elm).parent().html();
            console.log(op);
        }); */
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
      //   console.log(v);
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


    $('#no_vaccant').show();
    $('#yes_vaccant').show();
    $(document).on('change', '#is_vaccant', function() {

      var clicked_value = $(this).val();


      if (clicked_value == 'Yes') {

        $('#no_vaccant').hide();
        $('#yes_vaccant').show();
      }
      if (clicked_value == 'No') {
        $('#yes_vaccant').hide();
        $('#no_vaccant').show();
      }

      // alert(clicked_value);


    });
  </script>

  <script>
    $(function() {
      StepWizard.init();
    });

    var StepWizard = {
      init: function() {
        StepWizard.total_steps = $('.wizard-step').length;

        var v = $(".mainform").validate({
          errorClass: "text-error text-danger w-100",
          onkeyup: false,
          onfocusout: false,
          /* submitHandler: function() {
              // alert("Submitted, thanks!");
              $(".mainform").submit();
          } */
        });

        StepWizard.setStep();
        property_type;
        $('#property_type').on('change', function() {
          property_type = $(this).val();
          // Count the remaining steps without removing them
        });
        $('.wizard-step-next').click(function(e) {
          if (v.form()) {
            if ($('.wizard-step.active').next().is('.wizard-step')) {


              $('.wizard-step.active').removeClass('active');
              console.log(StepWizard.currentStep)
              if (StepWizard.currentStep == 2 && (property_type ==
                  'Residential Property' || property_type == 'Vacant Land')) {
                StepWizard.nextStep = 6;
                StepWizard.backStep = 2;
              } else if (StepWizard.currentStep == 2 && property_type ==
                'Commercial Property') {
                StepWizard.nextStep = 4;
                StepWizard.backStep = 2;
              } else if (StepWizard.currentStep == 4 && property_type ==
                'Commercial Property') {
                StepWizard.nextStep = 6;
                StepWizard.backStep = 4;
              } else if (StepWizard.currentStep == 2 && property_type ==
                'Income Property') {
                StepWizard.nextStep = 5;
                StepWizard.backStep = 2;
              } else if (StepWizard.currentStep == 4 && property_type ==
                'Business Opportunity') {
                StepWizard.nextStep = 6;
                StepWizard.backStep = 4;
              } else {
                StepWizard.backStep = StepWizard.currentStep;

                // StepWizard.backStep = StepWizard.nextStep + 1;

              }

              $('[ data-step="' + StepWizard.nextStep + '"]').addClass("active");
              StepWizard.setStep();
              if (StepWizard.currentStep == 27 &&
                property_type == 'Residential Property'
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (StepWizard.currentStep == 49 &&
                property_type == 'Income Property'
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (StepWizard.currentStep == 69 &&
                property_type == 'Commercial Property') {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if ((StepWizard.currentStep == 69) &&
                property_type == 'Business Opportunity') {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (StepWizard.currentStep == 81 &&
                property_type == 'Vacant Land'
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
            }
          }
        });
        $('.wizard-step-back').click(function(e) {
          if ($('.wizard-step.active').prev().is('.wizard-step')) {
            $('.wizard-step.active').removeClass('active');
            $('[ data-step="' + StepWizard.backStep + '"]').addClass("active");
            StepWizard.setStep();
            if (StepWizard.currentStep == 6 && (property_type ==
                'Residential Property' || property_type == 'Vacant Land')) {
              StepWizard.backStep = 2;

            } else if (StepWizard.currentStep == 4 && (property_type ==
                'Commercial Property' || property_type == 'Vacant Land')) {
              StepWizard.backStep = 2;

            } else if (StepWizard.currentStep == 6 && (property_type ==
                'Commercial Property' || property_type == 'Vacant Land')) {
              StepWizard.backStep = 4;

            } else if (StepWizard.currentStep == 5 && property_type ==
              'Income Property') {
              StepWizard.backStep = 2;
            } else if (StepWizard.currentStep == 6 && property_type ==
              'Business Opportunity') {
              StepWizard.backStep = 4;
            } else {
              StepWizard.backStep = StepWizard.currentStep - 1;

            }
          }
        });

        $('.wizard-step-finish').click(function(e) {
          if (v.form()) {
            $('.mainform').submit();
          }
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
            StepWizard.data_step = k;
            StepWizard.nextStep = k + 1;
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
        // console.log(t);
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
            // console.log("place", place);
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

    function add_city_row() {
      var city_row = $('.add_new_lease').html();
      $('.unit_btn_row').before(city_row);
      initialize();
    }

    function add_unit_types() {
      var unitType = $('.unitTypeTemp').html();
      $('.unitTypeBtn').before(unitType);
      initialize();
    }

    function add_sqft() {
      var sqft = $('.sqft').html();
      $('.sqft_btn_row').before(sqft);
      initialize();
    }

    function add_nmbr() {
      var unitNumber = $('.unitNumber').html();
      $('.unitNumberBtn').before(unitNumber);
      initialize();
    }

    function add_rent() {
      var rentBtn = $('.rentBtnTemp').html();
      $('.rentBtn').before(rentBtn);
      initialize();
    }

    function add_bed_unit() {
      var UnitTemp = $('.bedUnitTemp').html();
      $('.bedBtn').before(UnitTemp);
      initialize();
    }

    function add_baths_unit() {
      var bathTemp = $('.bathUnitTemp').html();
      $('.bathBtn').before(bathTemp);
      initialize();
    }

    function add_garage_spaces() {
      var garage = $('.garageTemp').html();
      $('.garageBtn').before(garage);
      initialize();
    }
    // Residential
    var leaseResDiv = $('#leaseOptionRes');
    $('#financingRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Lease Purchase') || $(this).val().includes('Lease Option')) ? leaseResDiv
        .show(): leaseResDiv.hide()
      //   end
      var selectedOption = $(this).find(':selected');
      var targetClass = selectedOption.data('target');

      // Hide all custom option fields first
      $('.form-group[data-target^=".custom_"]').addClass('d-none');

      // Show the specific custom option field based on the selected value
      if (targetClass) {
        $(targetClass).removeClass('d-none');
      }
    });
  </script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACES_API_KEY') }}&libraries=places&callback=initialize">
  </script>
@endpush
