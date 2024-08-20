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
    .box {
      display: block;
      width: 200px;
      height: 160px;
      background-color: white;
      border-radius: 5px;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      /* overflow: hidden; */
      position: relative;
    }

    .js--image-preview {
      width: 200px;
      height: 160px;
    }

    .upload {
      margin-bottom: 100px;
    }

    .upload-options {
      position: relative;
      /* height: 65px; */
      background-color: $base-color;
      cursor: pointer;
      overflow: hidden;
      text-align: center;
      transition: background-color ease-in-out 150ms;
      color: red;
      width: 100%;
      border: 1px solid #dedddd;
      border-radius: 0px 0px 5px 5px;

      &:hover {
        background-color: lighten($base-color, 10%);
      }

      & input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
      }

      & label {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        font-weight: 400;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        overflow: hidden;

        &::after {
          content: "+";
          font-family: "Material Icons";
          z-index: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 198px;
          height: 50px;
          font-size: 28px;
          color: #e6e6e6;
        }

        & span {
          display: inline-block;
          width: 50%;
          height: 100%;
          text-overflow: ellipsis;
          white-space: nowrap;
          overflow: hidden;
          vertical-align: middle;
          text-align: center;

          &:hover i.material-icons {
            color: lightgray;
          }
        }
      }
    }

    .js--image-preview {
      height: 100%;
      width: 100%;
      /* position: relative; */
      overflow: hidden;
      background-image: url('/images/image.png');
      background-color: white;
      /* background-position: center center; */
      background-repeat: no-repeat;
      background-size: cover;

      &.js--no-default::after {
        display: none;
      }

      &:nth-child(2) {
        background-image: url("http://bastianandre.at/giphy.gif");
      }
    }

    i.material-icons {
      transition: color 100ms ease-in-out;
      font-size: 2.25em;
      line-height: 55px;
      color: white;
      display: block;
    }

    .drop {
      display: block;
      position: absolute;
      background: transparentize($base-color, 0.8);
      border-radius: 100%;
      transform: scale(0);
    }

    .animate {
      animation: ripple 0.4s linear;
    }

    @keyframes ripple {
      100% {
        opacity: 0;
        transform: scale(2.5);
      }
    }

    .video {
      height: 160px;
      width: 200px;
      position: relative;
      /* overflow: hidden; */

      background-color: white;
      /* background-position: center center; */
      background-repeat: no-repeat;
      background-size: cover;
      margin-bottom: 60px;

    }

    .bgImg {
      background-image: url('/images/play.png');
    }

    span.upload-button {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 198px;
      height: 50px;
      font-size: 28px;
      color: #e6e6e6;
    }

    .videoBox {
      width: 200px;
      border-radius: 5px;

    }

    .videoDiv {
      margin-top: -60px;
    }

    label.fileuploader-btn {
      /* position: absolute; */
      top: 100%;
      border-radius: 0px 0px 5px 5px;
      border: 1px solid #e2e2e2;
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

        <form class="p-4 pt-0 mainform" action="{{ route('tenant.criteria.auction.bid', @$auction->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @php
            $yes_or_nos = [
                ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
          @endphp
          <div class="wizard-step" data-step='1'>
            <h4>Please enter the city, county, and state of the property you are offering to lease.</h4>
            <div class="form-group">
              <label class="fw-bold" for="address">City:</label>
              <input type="text" name="city" placeholder="" data-type="cities" id="city"
                class="form-control has-icon search_places" data-icon="fa-solid fa-city"
                 required>
            </div>

            <div class="form-group">
              <label class="fw-bold" for="address">County:</label>
              <input type="text" name="county" placeholder="" id="county"
                class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city"
                 required>
            </div>

            <div class="form-group">
              <label class="fw-bold" for="address">State:</label>
              <input type="text" name="state" placeholder="" data-type="states" id="state"
                class="form-control has-icon search_places" data-icon="fa-solid fa-flag-usa"
                 required>
            </div>

          </div>
          <div class="wizard-step" data-step='2'>
            @php
              $property_types = [['name' => 'Residential Property'], ['name' => 'Commercial Property']];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Offered Property Style: </label>
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
                      ['name' => 'Apartments', 'class' => 'residential-length'],
                      ['name' => 'Townhouse', 'class' => 'residential-length'],
                      ['name' => 'Villa', 'class' => 'residential-length'],
                      ['name' => 'Condominium', 'class' => 'residential-length'],
                      ['name' => 'Condo-Hotel', 'class' => 'residential-length'],
                      ['name' => 'Dock-Rackominium', 'class' => 'residential-length'],
                      ['name' => 'Farm', 'class' => 'residential-length'],
                      ['name' => 'Garage Condo', 'class' => 'residential-length'],
                      ['name' => 'Mobile Home- Pre 1976', 'class' => 'residential-length'],
                      ['name' => 'Manufactured Home- Post 1977', 'class' => 'residential-length'],
                      ['name' => 'Modular Home', 'class' => 'residential-length'],
                      ['name' => '½ Duplex', 'class' => 'residential-length'],
                      ['name' => '1/3 Triplex', 'class' => 'residential-length'],
                      ['name' => '1/4 Quadplex', 'class' => 'residential-length'],
                      ['name' => 'Unimproved Land', 'class' => 'residential-length'],
                      ['name' => 'Duplex', 'class' => 'income-length'],
                      ['name' => 'Triplex', 'class' => 'income-length'],
                      ['name' => 'Quadplex', 'class' => 'income-length'],
                      ['name' => 'Five or More (Residential units)', 'class' => 'income-length'],
                      ['name' => 'Agriculture', 'class' => 'commercial-length'],
                      ['name' => 'Assembly Building', 'class' => 'commercial-length'],
                      ['name' => 'Business', 'class' => 'commercial-length'],
                      ['name' => 'Hotel/Motel', 'class' => 'commercial-length'],
                      ['name' => 'Industrial', 'class' => 'commercial-length'],
                      ['name' => 'Mixed Use', 'class' => 'commercial-length'],
                      ['name' => 'Office', 'class' => 'commercial-length'],
                      ['name' => 'Restaurant', 'class' => 'commercial-length'],
                      ['name' => 'Five or More', 'class' => 'commercial-length'],
                      ['name' => 'Retail', 'class' => 'commercial-length'],
                      ['name' => 'Warehouse', 'class' => 'commercial-length'],
                  ];
                @endphp
                <select name="property_items" id="" class="property_items grid-picker"
                  style="justify-content: flex-start;" multiple required>
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
          <div class="wizard-step" data-step='3'>
            @php
              $landRes = [
                  ['name' => 'Entire Property', 'target' => ''],
                  ['name' => 'Single Room', 'target' => '.landRoomRes'],
              ];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Is the landlord looking to lease their entire property or a single room?</label>
              <select class="grid-picker" name="landroomOpt" id="lease_terms" required>
                @foreach ($landRes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group landRoomRes d-none">
              <span class="resFields">
                <div class="form-group">
                  <label for="roomSize" class="fw-bold">What is the size of the room the landlord intends to lease?</label>
                  <input type="text" class="form-control has-icon" id="roomSize" name="roomSize" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="privateBathroom" class="fw-bold">Is there a private bathroom, or is it shared?</label>
                    <input type="text" class="form-control has-icon" id="privateBathroom" name="bathroomType" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="storageSpace" class="fw-bold">How much storage space is available?</label>
                    <input type="text" class="form-control has-icon" id="storageSpace" name="storageSpace" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="commonAreas" class="fw-bold">Can tenants use common areas like the kitchen, living room, or backyard?</label>
                    <input type="text" class="form-control has-icon" id="commonAreas" name="commonAreaUsage" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="cleaningMaintenance" class="fw-bold">How is cleaning and maintenance of common areas managed?</label>
                    <input type="text" class="form-control has-icon" id="cleaningMaintenance" name="cleaningMaintenance" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="guestsAllowed" class="fw-bold">Are tenants allowed to have guests, and if so, are there any restrictions?</label>
                    <input type="text" class="form-control has-icon" id="guestsAllowed" name="guestPolicy" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="maintenanceIssues" class="fw-bold">How are maintenance issues handled?</label>
                    <input type="text" class="form-control has-icon" id="maintenanceHandling" name="maintenanceIssues" data-icon="fa-solid fa-ruler-combined">
                </div>
                
                <div class="form-group">
                    <label for="utilitiesSplit" class="fw-bold">How are the utilities split?</label>
                    <input type="text" class="form-control has-icon" id="utilitiesSplit" name="utilitiesSplit" data-icon="fa-solid fa-ruler-combined">
                </div>
                

              </span>
              <span class="commercialFields">
                <div class="form-group">
                  <label for="roomSize" class="fw-bold">What is the size of the room the landlord intends to lease?</label>
                  <input type="text" class="form-control has-icon" id="roomSize" name="roomSize" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="receptionArea" class="fw-bold">Is there a designated reception area?</label>
                  <input type="text" class="form-control has-icon" id="receptionArea" name="receptionArea" data-icon="fa-solid fa-ruler-combined">
              </div>
              
                <div class="form-group">
                  <label for="layoutConfiguration" class="fw-bold">How is the layout of the commercial space configured?</label>
                  <input type="text" class="form-control has-icon" id="layoutConfiguration" name="layoutConfiguration" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="zoningRestrictions" class="fw-bold">Are there specific zoning restrictions or permitted uses for the space?</label>
                  <input type="text" class="form-control has-icon" id="zoningRestrictions" name="zoningRestrictions" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="storageSpace" class="fw-bold">How much storage space is available?</label>
                  <input type="text" class="form-control has-icon" id="storageSpace" name="storageSpace" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="sharedAmenities" class="fw-bold">Are there any shared amenities, such as conference rooms or parking facilities?</label>
                  <input type="text" class="form-control has-icon" id="sharedAmenities" name="sharedAmenities" data-icon="fa-solid fa-ruler-combined">
              </div>
                <div class="form-group">
                  <label for="cleaningMaintenance" class="fw-bold">How is cleaning and maintenance of common areas managed?</label>
                  <input type="text" class="form-control has-icon" id="cleaningMaintenance" name="cleaningMaintenance" data-icon="fa-solidfa-solid fa-ruler-combinedfa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="buildingHours" class="fw-bold">Are there specific hours of operation for the building, and is 24/7 access available?</label>
                  <input type="text" class="form-control has-icon" id="buildingHours" name="buildingHours" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="maintenanceHandling" class="fw-bold">How are maintenance issues and repairs handled for the commercial space?</label>
                  <input type="text" class="form-control has-icon" id="maintenanceHandling" name="maintenanceHandling" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="utilitiesSplit" class="fw-bold">How are the utilities split?</label>
                  <input type="text" class="form-control has-icon" id="utilitiesSplit" name="utilitiesSplit" data-icon="fa-solid fa-ruler-combined">
              </div>
              
              <div class="form-group">
                  <label for="neighboringBusinesses" class="fw-bold">What types of businesses are neighboring tenants in the building or surrounding area?</label>
                  <input type="text" class="form-control has-icon" id="neighboringBusinesses" name="neighboringTenants" data-icon="fa-solid fa-ruler-combined">
              </div>
              </span>
            </div>
          </div>
          <div class="wizard-step" data-step='4'>
            <span class="resFields">
              <div class="form-group">
                @php
                  $bedrooms = [
                      ['target' => '', 'name' => '1'],
                      ['target' => '', 'name' => '2'],
                      ['target' => '', 'name' => '3'],
                      ['target' => '', 'name' => '4'],
                      ['target' => '', 'name' => '5'],
                      ['target' => '', 'name' => '6'],
                      ['target' => '', 'name' => '7'],
                      ['target' => '', 'name' => '8'],
                      ['target' => '', 'name' => '9'],
                      ['target' => '', 'name' => '10'],
                      ['target' => '.custom_bedrooms', 'name' => 'Other'],
                  ];
                @endphp
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
            </span>

          </div>
          <div class="wizard-step" data-step="5">
            <div class="form-group" id="bathrooms">
              @php
                $bathrooms = [
                    ['target' => '', 'name' => '1'],
                    ['target' => '', 'name' => '1.5'],
                    ['target' => '', 'name' => '2'],
                    ['target' => '', 'name' => '2.5'],
                    ['target' => '', 'name' => '3'],
                    ['target' => '', 'name' => '3.5'],
                    ['target' => '', 'name' => '4'],
                    ['target' => '', 'name' => '4.5'],
                    ['target' => '', 'name' => '5'],
                    ['target' => '', 'name' => '5.5'],
                    ['target' => '', 'name' => '6'],
                    ['target' => '', 'name' => '6.5'],
                    ['target' => '', 'name' => '7'],
                    ['target' => '', 'name' => '7.5'],
                    ['target' => '', 'name' => '8'],
                    ['target' => '', 'name' => '8.5'],
                    ['target' => '', 'name' => '9'],
                    ['target' => '', 'name' => '9.5'],
                    ['target' => '', 'name' => '10'],
                    ['target' => '.custom_bathrooms', 'name' => 'Other'],
                ];
              @endphp
              <label class="fw-bold">How many bathrooms does the property have? </label>
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
          <div class="wizard-step" data-step='6'>
            <span class="resFields">
              <div class="form-group">
                <label class="fw-bold">What is the total heated square footage of the property?</label>
                <input type="text" name="heated_sqft" id="custom_lease_terms" class="form-control has-icon"
                  required data-icon="fa-solid fa-ruler-combined">
              </div>
            </span>
            <span class="commercialFields">
              <div class="form-group">
                <label class="fw-bold">What is the net leasable square footage? </label>
                <input type="text" name="netLeasable" id="custom_lease_terms" class="form-control has-icon"
                  required data-icon="fa-solid fa-ruler-combined">
              </div>
            </span>
          </div>
          <div class="wizard-step" data-step='7'>
            @php
              $acreageRes = [
                  ['name' => '0 to less than 1/4', 'target' => ''],
                  ['name' => '1/4 to less than 1/2', 'target' => ''],
                  ['name' => '1/2 to less than 1', 'target' => ''],
                  ['name' => '1 to less than 2', 'target' => ''],
                  ['name' => '2 to less than 5', 'target' => ''],
                  ['name' => '5 to less than 10', 'target' => ''],
                  ['name' => '10 to less than 20', 'target' => ''],
                  ['name' => '20 to less than 50', 'target' => ''],
                  ['name' => '50 to less than 100', 'target' => ''],
                  ['name' => '100 to less than 200', 'target' => ''],
                  ['name' => '200 to less than 500', 'target' => ''],
                  ['name' => '500+ acres', 'target' => ''],
                  ['name' => 'Non-Applicable', 'target' => ''],
              ];
            @endphp
            <div class="form-group ">
              <label class="fw-bold">What is the total acreage of the property? </label>
              <select class="grid-picker" name="total_acreage" id="total_acreage" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($acreageRes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(25% - 10px);" data-icon='<i class="fa-solid fa-ruler-combined"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step='8'>
            @php
              $propsFurnish = [
                  ['name' => 'Furnished', 'target' => ''],
                  ['name' => 'Unfurnished', 'target' => ''],
                  ['name' => 'Optional', 'target' => ''],
                  ['name' => 'Turnkey', 'target' => ''],
                  ['name' => 'Partially Furnished', 'target' => ''],
              ];
            @endphp
            <div class="form-group ">
              <label class="fw-bold">Does the property come furnished, unfurnished, optional, turnkey, or partially
                furnished?</label>
              <select class="grid-picker" name="total_acreage" id="" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($propsFurnish as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(25% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step='9'>
            @php
              $applianceTypes = [
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
                  ['name' => 'Other', 'target' => '.applianceOtherRes'],
              ];
            @endphp
            <div class="form-group ">
              <label class="fw-bold">What appliances are included? </label>
              <select class="grid-picker" name="applianceTypes[]" id="" style="justify-content: flex-start;"
                multiple required>
                <option value="">Select</option>
                @foreach ($applianceTypes as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column"
                    style="width:calc(25% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group applianceOtherRes d-none">
                <label class="fw-bold">What appliances are included?</label>
                <input type="text" name="applianceOther" class="form-control has-icon" required
                  data-icon="fa-solid fa-ruler-combined">
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step='10'>
            @php
              $tenant_pays = [
                  ['name' => 'Cable TV', 'target' => ''],
                  ['name' => 'Electricity', 'target' => ''],
                  ['name' => 'Gas', 'target' => ''],
                  ['name' => 'Grounds Care', 'target' => ''],
                  ['name' => 'Insurance', 'target' => ''],
                  ['name' => 'Internet', 'target' => ''],
                  ['name' => 'Laundry', 'target' => ''],
                  ['name' => 'Management', 'target' => ''],
                  ['name' => 'None', 'target' => ''],
                  ['name' => 'Pest Control', 'target' => ''],
                  ['name' => 'Pool Maintenance', 'target' => ''],
                  ['name' => 'Recreational', 'target' => ''],
                  ['name' => 'Repairs', 'target' => ''],
                  ['name' => 'Security', 'target' => ''],
                  ['name' => 'Sewer', 'target' => ''],
                  ['name' => 'Taxes', 'target' => ''],
                  ['name' => 'Telephone', 'target' => ''],
                  ['name' => 'Trash Collection', 'target' => ''],
                  ['name' => 'Water', 'target' => ''],
                  ['name' => 'Other', 'target' => '.tenantPaysOther'],
              ];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Tenant Pays:</label>
              <select class="grid-picker" name="tenant_pays[]" multiple id="tenant_pays"
                style="justify-content: flex-start;">
                <option value="">Select</option>
                @foreach ($tenant_pays as $tenant_pay)
                  <option value="{{ $tenant_pay['name'] }}" data-target="{{ $tenant_pay['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $tenant_pay['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group tenantPaysOther d-none">
                <label class="fw-bold">Tenant Pays:</label>
                <input type="text" name="tenantPaysOther" class="form-control has-icon"
                  data-icon="fa-solid fa-ruler-combined">
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step='11'>
            <div class="form-group">
              @php
                $ownerPays = [
                    ['name' => 'Cable TV', 'target' => ''],
                    ['name' => 'Electricity', 'target' => ''],
                    ['name' => 'Gas', 'target' => ''],
                    ['name' => 'Grounds Care', 'target' => ''],
                    ['name' => 'Insurance', 'target' => ''],
                    ['name' => 'Internet', 'target' => ''],
                    ['name' => 'Laundry', 'target' => ''],
                    ['name' => 'Management', 'target' => ''],
                    ['name' => 'None', 'target' => ''],
                    ['name' => 'Pest Control', 'target' => ''],
                    ['name' => 'Pool Maintenance', 'target' => ''],
                    ['name' => 'Recreational', 'target' => ''],
                    ['name' => 'Repairs', 'target' => ''],
                    ['name' => 'Security', 'target' => ''],
                    ['name' => 'Sewer', 'target' => ''],
                    ['name' => 'Taxes', 'target' => ''],
                    ['name' => 'Telephone', 'target' => ''],
                    ['name' => 'Trash Collection', 'target' => ''],
                    ['name' => 'Water', 'target' => ''],
                    ['name' => 'Other', 'target' => '.ownerPaysOther'],
                ];
              @endphp
              <label class="fw-bold">Owner Pays:</label>
              <select class="grid-picker" name="wnerPays[]" multiple style="justify-content: flex-start;">
                <option value="">Select</option>
                @foreach ($ownerPays as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group ownerPaysOther d-none">
                <label class="fw-bold">Owner Pays:</label>
                <input type="text" name="ownerPaysOther" id="owner_pays" class="form-control has-icon"
                  data-icon="fa-solid fa-ruler-combined">
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step='12'>
            <span class="resFields">
              @php
                $washerDryerOptions = [
                    [
                        'icon' => '<i class="fa-regular fa-circle-check"></i>',
                        'name' => 'Yes, Washer and Dryer',
                        'target' => 'washerDryer',
                    ],
                    [
                        'icon' => '<i class="fa-regular fa-circle-check"></i>',
                        'name' => 'No, Washer and Dryer',
                        'target' => 'noWasherDryer',
                    ],
                    [
                        'icon' => '<i class="fa-regular fa-circle-check"></i>',
                        'name' => 'Washer and Dryer Hook-up Available',
                        'target' => 'washerDryerHookup',
                    ],
                    ['icon' => '<i class="fa-regular fa-circle-xmark"></i>', 'name' => 'No', 'target' => 'no'],
                ];

              @endphp
              <div class="form-group">
                <label class="fw-bold">Does the property have a washer and dryer? </label>
                <select class="grid-picker" name="washerDryerOptions" id="lease_terms" required>
                  <option value="">Select</option>
                  @foreach ($washerDryerOptions as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(25% - 10px);" data-icon='{{ $item['icon'] }}'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
            </span>
          </div>
          <div class="wizard-step" data-step="13">
            {{-- <span class="resFieldss">
              <div class="form-group ">
                @php
                  $waterViewOptRes = [
                      ['name' => 'Yes', 'target' => '.waterviewCommercial', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water View Needed:</label>
                <select class="grid-picker" name="has_water_view" id="waterViewRes"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterViewOptRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group" id="waterViewResOpt" style="display: none">
                @php
                  $waterViewRes = [
                      ['name' => 'Bay/Harbor - Full', 'target' => ''],
                      ['name' => 'Bay/Harbor - Partial', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Canal', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Gulf/Ocean - Full', 'target' => ''],
                      ['name' => 'Gulf/Ocean - Partial', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                      ['name' => 'None', 'target' => ''],
                  ];
                @endphp
                <label class="fw-bold">Water View Needed:</label>
                <select class="grid-picker" name="water_view[]" id="water_view" style="justify-content: flex-start;"
                  multiple required>
                  <option value="">Select</option>
                  @foreach ($waterViewRes as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                @php
                  $waterExtrasOptRes = [
                      ['name' => 'Yes', 'target' => '.waterviewCommercial', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Extras Needed:</label>
                <select class="grid-picker" name="has_water_extra" id="waterExtraRes"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterExtrasOptRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group" id="waterExtraResOpt" style="display: none;">
                @php
                  $waterExtraRes = [
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
                <label class="fw-bold">Water Extras Needed:</label>
                <select class="grid-picker" name="water_extras[]" id="water_extras"
                  style="justify-content: flex-start;" multiple>
                  <option value="">Select</option>
                  @foreach ($waterExtraRes as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group ">
                @php
                  $waterfrontageOptRes = [
                      [
                          'name' => 'Yes',
                          'target' => '.waterfrontageOptRes',
                          'icon' => 'fa-regular fa-circle-check',
                      ],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Frontage Needed:</label>
                <select class="grid-picker" name="waterFrontageOpt" id="waterFrontageRes"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterfrontageOptRes as $item)
                    <option value="{{ $item['name'] }}" data-icon='<i class="{{ $item['icon'] }}"></i>'
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" id="waterFrontageResOpt" style="display: none;">
                @php
                  $waterFrontageOptCommercial = [
                      ['name' => 'Bay/Harbor', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Brackish Water', 'target' => ''],
                      ['name' => 'Canal - Brackish', 'target' => ''],
                      ['name' => 'Canal - Freshwater', 'target' => ''],
                      ['name' => 'Canal - Saltwater', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''],
                      ['name' => 'Gulf/Ocean', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                  ];

                @endphp
                <label class="fw-bold">Water Frontage Needed:</label>
                <select class="grid-picker" name="waterFrontage[]" id="has_water_fontage"
                  style="justify-content: flex-start;" multiple required>
                  <option value="">Select</option>
                  @foreach ($waterFrontageOptCommercial as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                @php
                  $waterAccessOptRes = [
                      [
                          'name' => 'Yes',
                          'target' => '.waterAccessOptRes',
                          'icon' => 'fa-regular fa-circle-check',
                      ],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Access Needed:</label>
                <select class="grid-picker" name="waterAccessOpt" id="waterAccessRes"
                  style="justify-content: flex-start">
                  <option value="">Select</option>
                  @foreach ($waterAccessOptRes as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='{{ $item['icon'] }}'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" id="waterAccessResOpt" style="display: none;">
                @php
                  $waterAccessRes = [
                      ['name' => 'Bay/Harbor', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Beach - Access Deeded', 'target' => ''],
                      ['name' => 'Brackish Water', 'target' => ''],
                      ['name' => 'Canal - Brackish', 'target' => ''],
                      ['name' => 'Canal - Freshwater', 'target' => ''],
                      ['name' => 'Canal - Saltwater', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''],
                      ['name' => 'Gulf/Ocean', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Limited Access', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                  ];
                @endphp
                <label class="fw-bold">Water Access Needed:</label>
                <select class="grid-picker" name="water_access[]" id="" style="justify-content: flex-start;"
                  multiple required>
                  <option value="">Select</option>
                  @foreach ($waterAccessRes as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group ">
                @php
                  $viewOptRes = [
                      ['name' => 'Yes', 'target' => '.viewOptYes', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '.viewOptNo', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '.viewOptional', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">View Preference Needed:</label>
                  <select class="grid-picker" name="viewOpt" id="viewRes" style="justify-content: flex-start;">
                    <option value="">Select</option>
                    @foreach ($viewOptRes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='{{ $item['icon'] }}'></i>">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" id="viewOptRes" style="display:none;">
                  @php
                    $viewReferenceRes = [
                        ['name' => 'City', 'target' => ''],
                        ['name' => 'Garden', 'target' => ''],
                        ['name' => 'Golf Course', 'target' => ''],
                        ['name' => 'Greenbelt', 'target' => ''],
                        ['name' => 'Mountain(s)', 'target' => ''],
                        ['name' => 'Park', 'target' => ''],
                        ['name' => 'Pool', 'target' => ''],
                        ['name' => 'Tennis Court', 'target' => ''],
                        ['name' => 'Trees/Woods', 'target' => ''],
                        ['name' => 'Water', 'target' => ''],
                        ['name' => 'Other', 'target' => '.viewReferenceResOther'],
                    ];
                  @endphp
                  <label class="fw-bold">View Preference Needed:</label>
                  <select class="grid-picker" name="viewReference[]" id=""
                    style="justify-content: flex-start;" multiple required>
                    <option value="">Select</option>
                    @foreach ($viewReferenceRes as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row"
                        style="width:calc(33.3% - 10px);">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group viewReferenceResOther d-none">
                    <label class="fw-bold">View Preference Needed:</label>
                    <input type="text" name="viewReferenceOther" class="form-control has-icon"
                      data-icon="fa-solid fa-ruler-combined" required>
                  </div>
                </div>
              </div>
            </span> --}}
            <span class="commercialFieldss">
              <div class="form-group ">
                @php
                  $waterViewOptComm = [
                      ['name' => 'Yes', 'target' => '.waterviewCommercial', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water View Needed:</label>
                <select class="grid-picker" name="has_water_view" id="waterViewComm"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterViewOptComm as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group" id="waterViewOptComm" style="display:none;">
                @php
                  $water_views = [
                      ['name' => 'Bay/Harbor - Full', 'target' => ''],
                      ['name' => 'Bay/Harbor - Partial', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Canal', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Gulf/Ocean - Full', 'target' => ''],
                      ['name' => 'Gulf/Ocean - Partial', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                      ['name' => 'None', 'target' => ''],
                  ];
                @endphp
                <label class="fw-bold">Water View Needed:</label>
                <select class="grid-picker" name="water_view[]" id="water_view" style="justify-content: flex-start;"
                  multiple required>
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

              <div class="form-group ">
                @php
                  $waterExtraOptComm = [
                      ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Extras Needed:</label>
                <select class="grid-picker" name="has_water_extra" id="waterExtraComm"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterExtraOptComm as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group" id="waterExtraOptComm" style="display: none;">
                @php
                  $water_extrasComm = [
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
                <label class="fw-bold">Water Extras Needed:</label>
                <select class="grid-picker" name="water_extras[]" id="water_extras"
                  style="justify-content: flex-start;" multiple required>
                  <option value="">Select</option>
                  @foreach ($water_extrasComm as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group ">
                @php
                  $waterFrontageOptComm = [
                      ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Frontage Needed:</label>
                <select class="grid-picker" name="waterFrontageOpt" id="waterFrontageComm"
                  style="justify-content: flex-start;">
                  <option value="">Select</option>
                  @foreach ($waterFrontageOptComm as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='{{ $item['icon'] }}'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group " id="waterfrontageOptComm" style="display: none;">
                @php
                  $waterFrontageComm = [
                      ['name' => 'Bay/Harbor', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Brackish Water', 'target' => ''],
                      ['name' => 'Canal - Brackish', 'target' => ''],
                      ['name' => 'Canal - Freshwater', 'target' => ''],
                      ['name' => 'Canal - Saltwater', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''],
                      ['name' => 'Gulf/Ocean', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                  ];

                @endphp
                <label class="fw-bold">Water Frontage Needed:</label>
                <select class="grid-picker" name="waterFrontage[]" id="has_water_fontage"
                  style="justify-content: flex-start;" multiple required>
                  <option value="">Select</option>
                  @foreach ($waterFrontageComm as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                @php
                  $waterAccessOptComm = [
                      ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <label class="fw-bold">Water Access Needed:</label>
                <select class="grid-picker" name="waterAccessOpt" id="waterAccessComm"
                  style="justify-content: flex-start">
                  <option value="">Select</option>
                  @foreach ($waterAccessOptComm as $item)
                    <option value="{{ $item['name'] }}" data-icon="<i class='{{ $item['icon'] }}'></i>"
                      data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);">
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" id="waterAccessOptComm" style="display:none;">
                @php
                  $waterAccessComm = [
                      ['name' => 'Bay/Harbor', 'target' => ''],
                      ['name' => 'Bayou', 'target' => ''],
                      ['name' => 'Beach', 'target' => ''],
                      ['name' => 'Beach - Access Deeded', 'target' => ''],
                      ['name' => 'Brackish Water', 'target' => ''],
                      ['name' => 'Canal - Brackish', 'target' => ''],
                      ['name' => 'Canal - Freshwater', 'target' => ''],
                      ['name' => 'Canal - Saltwater', 'target' => ''],
                      ['name' => 'Creek', 'target' => ''],
                      ['name' => 'Freshwater Canal w/Lift to Saltwater Canal', 'target' => ''],
                      ['name' => 'Gulf/Ocean', 'target' => ''],
                      ['name' => 'Gulf/Ocean to Bay', 'target' => ''],
                      ['name' => 'Intracoastal Waterway', 'target' => ''],
                      ['name' => 'Lagoon/Estuary', 'target' => ''],
                      ['name' => 'Lake', 'target' => ''],
                      ['name' => 'Lake - Chain of Lakes', 'target' => ''],
                      ['name' => 'Limited Access', 'target' => ''],
                      ['name' => 'Marina', 'target' => ''],
                      ['name' => 'Pond', 'target' => ''],
                      ['name' => 'River', 'target' => ''],
                  ];
                @endphp
                <label class="fw-bold">Water Access Needed:</label>
                <select class="grid-picker" name="water_access[]" id="water_access"
                  style="justify-content: flex-start;" multiple required>
                  <option value="">Select</option>
                  @foreach ($waterAccessComm as $water_access1)
                    <option value="{{ $water_access1['name'] }}"
                      data-icon="<i class='fa-regular fa-circle-check'></i>"
                      data-target="{{ $water_access1['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);">
                      {{ $water_access1['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group ">
                @php

                  $viewOptComm = [
                      ['name' => 'Yes', 'target' => '.viewOptYes', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '.viewOptNo', 'icon' => 'fa-regular fa-circle-xmark'],
                      ['name' => 'Optional', 'target' => '.viewOptional', 'icon' => 'fa-regular fa-circle-question'],
                  ];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">View Preference Needed:</label>
                  <select class="grid-picker" name="viewOpt" id="viewOptionComm" style="justify-content: flex-start;">
                    <option value="">Select</option>
                    @foreach ($viewOptComm as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='{{ $item['icon'] }}'></i>">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" id="viewOptComm" style="display:none;">
                  @php
                    $viewReferenceComm = [
                        ['name' => 'City', 'target' => ''],
                        ['name' => 'Garden', 'target' => ''],
                        ['name' => 'Golf Course', 'target' => ''],
                        ['name' => 'Greenbelt', 'target' => ''],
                        ['name' => 'Mountain(s)', 'target' => ''],
                        ['name' => 'Park', 'target' => ''],
                        ['name' => 'Pool', 'target' => ''],
                        ['name' => 'Tennis Court', 'target' => ''],
                        ['name' => 'Trees/Woods', 'target' => ''],
                        ['name' => 'Water', 'target' => ''],
                        ['name' => 'Other', 'target' => '.viewReferenceCommercialOther']
                    ];
                  @endphp
                  <label class="fw-bold">View Preference Needed:</label>
                  <select class="grid-picker" name="viewReference[]" id=""
                    style="justify-content: flex-start;" multiple required>
                    <option value="">Select</option>
                    @foreach ($viewReferenceComm as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row"
                        style="width:calc(33.3% - 10px);">
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group viewReferenceCommercialOther d-none">
                    <label class="fw-bold">View Preference Needed:</label>
                    <input type="text" name="viewReferenceOther" class="form-control has-icon"
                      data-icon="fa-solid fa-ruler-combined" required>
                  </div>
                </div>
              </div>
            </span>
          </div>
          <div class="wizard-step" data-step='14'>
            <span class="resFields">
              @php
                $yes_or_nos = [
                    ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                    ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                ];
              @endphp
              <div class="form-group">
                @php
                  $pool = [
                      ['name' => 'Yes', 'target' => '.poolYes', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                  ];
                @endphp
                <label class="fw-bold">Does the property have a pool? </label>
                <select class="grid-picker" name="pool" style="justify-content: flex-start;" required>
                  <option value="">Select</option>
                  @foreach ($pool as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group poolYes d-none">
                  @php
                    $poolOpt = [
                        ['name' => 'Private', 'target' => '', 'icon' => 'fa-solid fa-warehouse'],
                        ['name' => 'Community', 'target' => '', 'icon' => 'fa-solid fa-warehouse'],
                    ];
                  @endphp
                  <label class="fw-bold">Does the property have a pool? </label>
                  <select class="grid-picker" name="poolOpt" style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($poolOpt as $item)
                      <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="fw-bold">Does the property have a garage? </label>
                <select class="grid-picker" name="garage" id="garage" style="justify-content: flex-start;"
                  required>
                  <option value="">Select</option>
                  @foreach ($yes_or_nos as $item)
                    @php
                      if ($item['name'] == 'Yes') {
                          $target = '.garage_space';
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
              <div class="form-group garage_space custom_garage_spaces d-none">
                <label class="fw-bold">How many garage spaces?</label>
                <input type="text" name="custom_garage_spaces" id="custom_garage_spaces"
                  class="form-control has-icon" required data-icon="fa-solid fa-warehouse">
              </div>

              <div class="form-group">
                <label class="fw-bold">Does the property have a carport? </label>
                <select class="grid-picker" name="carport" id="carport" style="justify-content: flex-start;"
                  required>
                  <option value="">Select</option>
                  @foreach ($yes_or_nos as $item)
                    @php
                      if ($item['name'] == 'Yes') {
                          $target = '.carport_space';
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
              <div class="form-group carport_space custom_carport_spaces d-none">
                <label class="fw-bold">How many carport spaces?</label>
                <input type="text" name="custom_carport_spaces" id="custom_carport_spaces"
                  class="form-control has-icon" required data-icon="fa-solid fa-warehouse">
              </div>
            </span>
            <span class="commercialFields">
              <div class="form-group">
                @php
                  $garageParking = [
                      ['name' => '1 to 5 Spaces', 'target' => ''],
                      ['name' => '6 to 12 Spaces', 'target' => ''],
                      ['name' => '13 to 18 Spaces', 'target' => ''],
                      ['name' => '19 to 30 Spaces', 'target' => ''],
                      ['name' => 'Airplane Hangar', 'target' => ''],
                      ['name' => 'Common', 'target' => ''],
                      ['name' => 'Curb Parking', 'target' => ''],
                      ['name' => 'Deeded', 'target' => ''],
                      ['name' => 'Electric Vehicle Charging Station(s)', 'target' => ''],
                      ['name' => 'Ground Level', 'target' => ''],
                      ['name' => 'Lighted', 'target' => ''],
                      ['name' => 'Over 30 Spaces', 'target' => ''],
                      ['name' => 'RV Parking', 'target' => ''],
                      ['name' => 'Secured', 'target' => ''],
                      ['name' => 'Under Building', 'target' => ''],
                      ['name' => 'Underground', 'target' => ''],
                      ['name' => 'Valet', 'target' => ''],
                      ['name' => 'None', 'target' => ''],
                      ['name' => 'Other', 'target' => '.garageParkingOther'],
                  ];

                @endphp
                <label class="fw-bold">Does the property have garage/parking features? </label>
                <select class="grid-picker" name="garageParking" id="garage" style="justify-content: flex-start;"
                  required>
                  <option value="">Select</option>
                  @foreach ($garageParking as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                      style="width:calc(33.3% - 10px);" data-icon='<i class="fa-solid fa-warehouse"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group garageParkingOther d-none">
                <label class="fw-bold">What garage/parking features does the property have?</label>
                <input type="text" name="garageParkingOther" class="form-control has-icon" required
                  data-icon="fa-solid fa-warehouse">
              </div>
            </span>
          </div>
          <div class="wizard-step" data-step='15'>
            @php
              $propsConditions = [
                  ['name' => 'New Construction', 'target' => 'newConstruction'],
                  ['name' => 'Completely Updated: No updates needed.', 'target' => 'completelyUpdated'],
                  ['name' => 'Semi-updated: Needs minor updates.', 'target' => 'semiUpdated'],
                  ['name' => 'Not Updated: Requires a complete update.', 'target' => 'notUpdated'],
                  ['name' => 'Other', 'target' => '.propsOther'],
              ];

            @endphp
            <div class="form-group">
              <label class="fw-bold">What is the condition of the property? </label>
              <select class="grid-picker" name="propCondition[]" id="requirements"
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($propsConditions as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle""></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group propsOther d-none">
              <label class="fw-bold">What is the condition of the property? </label>
              <input type="text" name="propsOther" placeholder="" id="property_link" class="form-control has-icon"
                data-type="address" data-icon="fa-solid fa-ruler-combined" required />
            </div>
          </div>
          <div class="wizard-step" data-step='16'>
            @php
              $lease_terms = [
                  ['name' => '3 months', 'target' => ''],
                  ['name' => '6 months', 'target' => ''],
                  ['name' => '9 months', 'target' => ''],
                  ['name' => '1 year', 'target' => ''],
                  ['name' => '2 years', 'target' => ''],
                  ['name' => '3-5 years', 'target' => ''],
                  ['name' => '5+ years', 'target' => ''],
                  ['name' => 'Month to Month', 'target' => ''],
                  ['name' => 'Other', 'target' => ''],
              ];
            @endphp
            <div class="form-group">
              <label class="fw-bold">Acceptable Lease Duration: </label>
              <select class="grid-picker" name="lease_terms" id="leaseTermsOpt" style="justify-content: flex-start;"
                multiple required>
                @foreach ($lease_terms as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                    class="card flex-row pt-0 pb-0" style="width:calc(33.3% - 10px);"
                    data-icon='<i class="fa-regular fa-check-circle" style="font-size:30px;position:relative;top:-5px;"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group">
                <label class="fw-bold" for="monthlyPrice">Offered Monthly
                  Price: </label>
                <input type="text" name="monthlyPrice" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar-sign">
              </div>

              <div class="form-group">
                <label class="fw-bold" for="availabilityDate">Lease
                  Availability Date: </label>
                <input type="date" name="availabilityDate" class="form-control has-icon"
                  data-icon="fa-regular fa-calendar-days">
              </div>

              <div class="form-group">
                <label class="fw-bold" for="leaseDuration">Acceptable Lease
                  Duration: </label>
                <input type="text" name="leaseDuration" class="form-control has-icon"
                  data-icon="fa-regular fa-calendar-days">
              </div>

              <div class="form-group">
                <label class="fw-bold" for="moveInCost">What is required at
                  move-in? </label>
                <input type="text" name="moveInCost" class="form-control has-icon"
                  data-icon="fa-solid fa-dollar-sign">
              </div>
              <div class="form-group">
                @php
                  $landlordSpecial = [
                      ['name' => 'Yes', 'target' => '.landlordSpecial', 'icon' => 'fa-regular fa-circle-check'],
                      ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                  ];
                @endphp
                <label class="fw-bold">Would the landlord like to offer any move in specials for a tenant? </label>
                <select class="grid-picker" name="landlordSpecialOpt" id="leaseTermsOpt"
                  style="justify-content: flex-start;" required>
                  @foreach ($landlordSpecial as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row "
                      style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group landlordSpecial d-none">
                  <label class="fw-bold">What is the move in special? </label>
                  <input type="text" name="landlordSpecial" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
              </div>
            </div>
            @php
              $moveIn = [
                  [
                      'name' => 'First, Last, and Security',
                      'target' => '.moveInSecurity',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Last, Security Deposit, Exit Cleaning Fee, & Application Fee',
                      'target' => '.cleaning',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Last, Security Deposit, Pet Deposit, Exit Cleaning Fee, & Application Fee',
                      'target' => '.cleaningFee',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Last, Security Deposit, Exit Cleaning Fee, Application Fee, Vacation Tax',
                      'target' => '.vacationTax',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Security Deposit, Exit Cleaning Fee, Application Fee, & Vacation Tax',
                      'target' => '.vacationFive',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Security, Exit Cleaning Fee & Application Fee',
                      'target' => '.cleaningSix',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  [
                      'name' => 'First, Security, & Application Fee',
                      'target' => '',
                      'icon' => 'fa-regular fa-circle-check',
                  ],
                  ['name' => 'Other', 'target' => '.moveOther', 'icon' => 'fa-regular fa-circle-check'],
              ];

            @endphp
            <div class="form-group ">
              <label class="fw-bold">What is required at move-in? </label>
              <select class="grid-picker" name="required_at_move_in" id=""
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($moveIn as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
              <div class="form-group d-none moveOther">
                <div class="form-group">
                  <label class="fw-bold">What is required at move-in? </label>
                  <input type="text" name="moveInOther" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Please enter the required move-in amounts: </label>
                  <input type="text" name="moveInAmount" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
              </div>
              {{-- First  --}}
              <div class="form-group d-none moveInSecurity">
                <label class="fw-bold">Please enter the required move-in amounts: </label>
                <div class="form-group">
                  <label class="fw-bold">First Month:</label>
                  <input type="text" name="firstMonthSec" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Last Month: </label>
                  <input type="text" name="lastMonthSec" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
                <div class="form-group">
                  <label class="fw-bold">Security Deposit: </label>
                  <input type="text" name="DepositSec" id="" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
              </div>
              {{-- First  --}}
              {{-- Second  --}}
              <div class="form-group cleaning d-none">
                <label class="fw-bold">Please enter the required move-in amounts:</label>
                <div class="form-group">
                  <label class="fw-bold" for="firstMonth">First Month:</label>
                  <input type="text" name="firstMonthCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="lastMonth"> Last Month:</label>
                  <input type="text" name="lastMonthCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="securityDeposit"> Security
                    Deposit:</label>
                  <input type="text" name="securityDepositCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="petDeposit"> Pet Deposit:</label>
                  <input type="text" name="petDepositCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="exitCleaningFee"> Exit Cleaning
                    Fee:</label>
                  <input type="text" name="exitCleaningFeeCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationFee"> Application
                    Fee:</label>
                  <input type="text" name="applicationFeeCleaning" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationLinkCleaning">
                    Application
                    Link:</label>
                  <input type="text" name="applicationLink" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
              </div>
              {{-- Second  --}}
              {{-- Third --}}
              <div class="form-group cleaningFee d-none">
                <label class="fw-bold">Please enter the required move-in amounts:</label>
                <div class="form-group">
                  <label class="fw-bold" for="firstMonth">First Month:</label>
                  <input type="text" name="fMonthCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="lastMonth"> Last Month:</label>
                  <input type="text" name="lMonthCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="securityDeposit"> Security
                    Deposit:</label>
                  <input type="text" name="secDepCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="petDeposit"> Pet Deposit:</label>
                  <input type="text" name="petDepCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="exitCleaningFee"> Exit Cleaning
                    Fee:</label>
                  <input type="text" name="exitCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationFee"> Application
                    Fee:</label>
                  <input type="text" name="appCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationLinkCleaning">
                    Application
                    Link:</label>
                  <input type="text" name="appLinkCleaningFee" class="form-control has-icon"
                    data-icon="fa-solid fa-ruler-combined" required>
                </div>
              </div>
              {{-- Third --}}
              {{-- Four  --}}
              <div class="form-group vacationTax d-none">
                <label class="fw-bold">Please enter the required move-in amounts:</label>
                <div class="form-group">
                  <label class="fw-bold" for="firstMonth">First Month:</label>
                  <input type="text" name="firstMonthvacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="lastMonth">Last Month:</label>
                  <input type="text" name="lastMonthvacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="securityDeposit">Security Deposit:</label>
                  <input type="text" name="secDepvacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationFee">Application Fee:</label>
                  <input type="text" name="appFeevacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationLink">Application Link:</label>
                  <input type="text" name="appLinkvacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="vacationTax">Vacation Tax:</label>
                  <input type="text" name="vacationTax" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>
              </div>
              {{-- Four --}}
              {{-- Five  --}}
              <div class="form-group vacationFive d-none">
                <label class="fw-bold">Please enter the required move-in amounts:</label>
                <div class="form-group">
                  <label class="fw-bold" for="firstMonth">First Month:</label>
                  <input type="text" name="firstMonthvacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="securityDeposit">Security Deposit:</label>
                  <input type="text" name="secDepvacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>
                <div class="form-group">
                  <label class="fw-bold" for="lastMonth">Exit Cleaning Fee:</label>
                  <input type="text" name="cleaningvacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationFee">Application Fee:</label>
                  <input type="text" name="appFeevacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationLink">Application Link:</label>
                  <input type="text" name="appLinkvacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="vacationTax">Vacation Tax:</label>
                  <input type="text" name="vacationFive" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>
              </div>
              {{-- Five --}}
              {{-- Six  --}}
              <div class="form-group cleaningSix d-none">
                <label class="fw-bold">Please enter the required move-in amounts:</label>
                <div class="form-group">
                  <label class="fw-bold" for="firstMonth">First Month:</label>
                  <input type="text" name="fMonthCleaningSix" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="securityDeposit">Security Deposit:</label>
                  <input type="text" name="secDepCleaningSix" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>
                <div class="form-group">
                  <label class="fw-bold" for="lastMonth">Exit Cleaning Fee:</label>
                  <input type="text" name="CleaningSixFee" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationFee">Application Fee:</label>
                  <input type="text" name="appFeeCleaningSix" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>

                <div class="form-group">
                  <label class="fw-bold" for="applicationLink">Application Link:</label>
                  <input type="text" name="appLinkCleaningSix" class="form-control has-icon" required
                    data-icon='fa-solid fa-ruler-combined'>
                </div>
              </div>
              {{-- Six --}}

            </div>

          </div>
          <div class="wizard-step" data-step='17'>
            <h4>Landlord Prescreening Terms:</h4>
            <div class="form-group">
              <label class="fw-bold">How many occupants will the landlord accept?</label>
              <input type="text" name="occupants" placeholder="" id="" class="form-control has-icon"
                data-type="" data-icon="fa-solid fa-users" required />
            </div>
            <div class="form-group">
              <label class="fw-bold">What is the minimum net income a household must earn to qualify for the
                rental?</label>
              <input type="text" name="netIncome" placeholder="" id="" class="form-control has-icon"
                data-type="" data-icon="fa-solid fa-dollar-sign" required />
            </div>
          </div>
          <div class="wizard-step" data-step='18'>
            <div class="form-group">
              <label class="fw-bold">Will the landlord accept pets? </label>
              <select class="grid-picker" name="pet_accept" id="pet_accept" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($yes_or_nos as $item)
                  @php
                    if ($item['name'] == 'Yes') {
                        $target = '.pet_questions';
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

            <div class="form-group pet_questions d-none">
              <div class="form-group">
                <label class="fw-bold">Number of Pets Allowed:</label>
                <input type="text" name="petsAllowed" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Acceptable Pet Types:</label>
                <input type="text" name="acceptablePet" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Maximum Pet Weight:</label>
                <input type="text" name="petWeight" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">One-Time Pet Deposit or Monthly Pet Fee:</label>
                <input type="text" name="petFee" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Pet Fee Amount:</label>
                <input type="text" name="petAmount" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
              <div class="form-group">
                <label class="fw-bold">Is the Pet Fee Refundable or Non-Refundable?</label>
                <input type="text" name="petRefund" id="pet_deposit" class="form-control has-icon"
                  data-icon="fa-solid fa-dog" required>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step='19'>
            <div class="form-group">
              @php
                $scoreRating = [
                    ['name' => 'Poor', 'target' => ''],
                    ['name' => 'Fair', 'target' => ''],
                    ['name' => ' Good', 'target' => ''],
                    ['name' => ' Very Good', 'target' => ''],
                    ['name' => 'Excellent', 'target' => ''],
                ];
              @endphp
              <label class="fw-bold">What is the minimum credit score rating the landlord will accept?</label>
              <select class="grid-picker" name="pet_accept" id="" style="justify-content: flex-start;"
                required>
                <option value=""></option>
                @foreach ($scoreRating as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="wizard-step" data-step='20'>
            <div class="form-group">
              @php
                $eviction = [
                    ['name' => 'Yes', 'target' => '', 'icon' => '<i class="fa-regular fa-circle-check"></i>'],
                    ['name' => 'No', 'target' => '', 'icon' => '<i class="fa-regular fa-circle-xmark"></i>'],
                    [
                        'name' => ' Depends on the Circumstance',
                        'target' => '',
                        'icon' => '<i class="fa-regular fa-circle-check"></i>',
                    ],
                ];
              @endphp
              <label class="fw-bold">Will the landlord accept a tenant with a prior eviction within the last 7 years?
              </label>
              <select class="grid-picker" name="pet_accept" id="" style="justify-content: flex-start;"
                required>
                <option value=""></option>
                @foreach ($eviction as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='{{ $item['icon'] }}'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              @php
                $landlordFelony = [
                    ['name' => 'Yes', 'target' => '', 'icon' => '<i class="fa-regular fa-circle-check"></i>'],
                    ['name' => 'No', 'target' => '', 'icon' => '<i class="fa-regular fa-circle-xmark"></i>'],
                    [
                        'name' => ' Depends on the Circumstance',
                        'target' => '',
                        'icon' => '<i class="fa-regular fa-circle-check"></i>',
                    ],
                ];
              @endphp
              <label class="fw-bold">Will the landlord accept a tenant with a prior felony within the last 7 years?
              </label>
              <select class="grid-picker" name="pet_accept" id="" style="justify-content: flex-start;"
                required>
                <option value=""></option>
                @foreach ($landlordFelony as $item)
                  <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='{{ $item['icon'] }}'>
                    {{ $item['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          @if (auth()->user()->user_type == 'agent')
            <div class="wizard-step" data-step='21'>
              <div class="form-group">
                @php
                  $agentChargeOpt = [
                      [
                          'name' => 'Yes',
                          'target' => '.agentChargeYes',
                          'icon' => '<i class="fa-regular fa-circle-check"></i>',
                      ],
                      [
                          'name' => 'No',
                          'target' => '',
                          'icon' => '<i class="fa-regular fa-circle-xmark"></i>',
                      ],
                  ];
                @endphp
                <label class="fw-bold">Does the agent charge a finder’s fee to secure a property for the tenant?
                </label>
                <select class="grid-picker" name="agentChargeOpt" id=""
                  style="justify-content: flex-start;" required>
                  <option value=""></option>
                  @foreach ($agentChargeOpt as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                      class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='{{ $item['icon'] }}'>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
                <div class="form-group agentChargeYes d-none">
                  <label class="fw-bold">What is the fee that the agent charges to secure a property for the
                    tenant?</label>
                  <input type="text" name="agentCharge" placeholder="" id=""
                    class="form-control has-icon" data-type="" data-icon="fa-solid fa-dollar-sign" required />
                </div>
              </div>
            </div>
          @endif
          <div class="wizard-step" data-step="{{ auth()->user()->user_type == 'agent' ? '22' : '21' }}">
            <div class="form-group">
              <label class="fw-bold">What is the commission offered to the tenant’s agent? </label>
              <input type="text" name="commission" placeholder="" id=""
                class="form-control has-icon" data-type="" data-icon="fa-solid fa-ruler-combined" required />
            </div>
          </div>
          <div class="wizard-step" data-step="{{ auth()->user()->user_type == 'agent' ? '23' : '22' }}">
            <div class="form-group">
              <label class="fw-bold">Please provide any additional information about
                the property: </label>
              <textarea type="text" rows="5" name="additionalDetails" placeholder="" id=""
                class="form-control" data-type="" data-icon="" required>{{ old('additionalDetails') }}</textarea>
            </div>
          </div>
          <div class="wizard-step" data-step="{{ auth()->user()->user_type == 'agent' ? '24' : '23' }}">
            <h4>The following section is privately sent to the agent:</h4>
            <div class="form-group">
              <label class="fw-bold">Address of the property: </label>
              <input type="text" name="addressProp" placeholder="" id="address"
                class="form-control search_places has-icon" data-type="" data-icon="fa-solid fa-location-dot"
                required />
            </div>
            <div class="form-group">
              <label class="fw-bold">Pictures of the property: (link)</label>
              <input type="url" name="picLinkProp" class="form-control has-icon" data-type=""
                data-icon="fa-solid fa-link" />
            </div>
            <div class="form-group">
              <label class="fw-bold">Video of the property: (link)</label>
              <input type="file" name="videoLink" placeholder="" id="" class="form-control"
                data-type="" data-icon="" />
            </div>
            <div class="form-group">
              <label class="fw-bold">Floor plan of the property: (upload) </label>
              <input type="file" name="planPropUpload" placeholder="" id="" class="form-control"
                data-type="" data-icon="" />
            </div>
            <div class="form-group">
              <label class="fw-bold">Floor plan of the property: (link)</label>
              <input type="url" name="planPropLink" placeholder="" id=""
                class="form-control has-icon" data-type="address" data-icon="fa-solid fa-link" />
            </div>
            <div class="row">
              <div class="col-6  form-group">
                <div class="videoBox ">
                  <label class="fw-bold">Video of the property: (upload)</label>
                  <div class="video bgImg"></div>
                  <div class="form-group videoDiv">
                    <input type="file" class="fileuploader" name="videoUpload" style="display: none;"
                      accept="video/*">
                    <label for="fileuploader" class="fileuploader-btn">
                      <span class="upload-button">+</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-6  form-group">
                <div class="upload">
                  <label class="fw-bold">Pictures of the property: (upload)</label>
                  <div class="wrapper">
                    <div class="box">
                      <div class="js--image-preview"></div>
                      <div class="upload-options">
                        <label>
                          <input type="file" name="picPropUpload" class="image-upload" accept="image/*" />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="wizard-step" data-step="{{ auth()->user()->user_type == 'agent' ? '25' : '24' }}">
            @if (auth()->user()->user_type == 'landlord' || auth()->user()->user_type == 'agent')
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fw-bold">First Name:</label>
                  <input type="text" name="firstName" placeholder="" class="form-control has-icon"
                    data-icon="fa-solid fa-user-tie " value="{{ Auth::user()->firstName }}" required />
                </div>
                <div class="col-md-6">
                  <label class="fw-bold">Last Name:</label>
                  <input type="text" name="lastName" placeholder="" class="form-control has-icon" required
                    value="{{ Auth::user()->lastName }}" data-icon="fa-solid fa-user-tie " />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fw-bold">Phone Number:</label>
                  <input type="text" name="phoneNumber" placeholder="" id=""
                    class="form-control has-icon" value="{{ Auth::user()->phoneNumber }}" required
                    data-icon="fa-solid fa-phone" />
                </div>
                <div class="col-md-6">
                  <label class="fw-bold">Email:</label>
                  <input type="text" name="email" placeholder="" id=""
                    class="form-control has-icon" value="{{ Auth::user()->email }}" required
                    data-icon="fa-solid fa-envelope" />
                </div>
              </div>
            @endif
            @if (auth()->user()->user_type == 'agent')
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fw-bold">Brokerage:</label>
                  <input type="text" name="brokerage" placeholder="" id=""
                    class="form-control has-icon" required value="{{ Auth::user()->brokerage }}"
                    data-icon="fa-solid fa-handshake" />
                </div>
                <div class="col-md-6">
                  <label class="fw-bold">Real Estate License #:</label>
                  <input type="text" name="license" placeholder="" class="form-control has-icon" required
                    value="{{ Auth::user()->license }}" data-icon="fa-solid fa-id-card" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fw-bold">NAR Member ID (NRDS ID):</label>
                  <input type="text" name="memberId" placeholder="" id=""
                    class="form-control has-icon" required value="{{ Auth::user()->memberId }}"
                    data-icon="fa-solid fa-id-card-clip" />
                </div>
              </div>
            @endif
          </div>

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
@endsection
@push('scripts')
<script>
  // Video Preview
  $(document).ready(function($) {
    // Click button to activate hidden file input
    $('.fileuploader-btn').on('click', function() {
      $('.fileuploader').click();
    });
    // Click above calls the open dialog box
    // Once something is selected the change function will run
    $('.fileuploader').change(function() {
      // Check if a file has been selected
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        var file = this.files[0];

        if (file.type.startsWith('image/')) {
          reader.onload = function(event) {
            $('.video').empty();
            $('.video').append('<img src="' + event.target.result + '" width="200" height="160">');
          };
          reader.readAsDataURL(file);
          $('.video').removeClass('bgImg');
        } else if (file.type.startsWith('video/')) {
          reader.onload = function(event) {
            var fileContent = event.target.result;
            $('.video').empty();
            $('.video').append('<video src="' + fileContent +
              '" width="200" height="160" controls autoplay></video>');
          };
          reader.readAsDataURL(file);
          $('.video').removeClass('bgImg');
        } else {
          // File is neither image nor video
          alert('Please select either an image or a video file.');
          this.value = ''; // Clear the file input
          return;
        }
        // Hide the preview icon and show the upload button
        $('.video').removeClass('bgImg');
        $('.upload-button').show();
      } else {
        // If no file is selected, and if .video container is empty, show the preview icon and hide the add button
        if ($('.video').is(':empty')) {
          $('.video').addClass('bgImg');
          $('.upload-button').show();
        } else {
          // If a file already exists, hide the preview icon and show the add button
          $('.video').removeClass('bgImg');
          $('.upload-button').show();
        }
      }
    });
  });
  // Video Preview
  function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');
    uploadField.addEventListener('change', getFile);
    function getFile(e) {
      let file = e.currentTarget.files[0];
      checkType(file);
    }
    function previewImage(file) {
      let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();
      reader.onload = function() {
        thumb.style.backgroundImage = 'url(' + reader.result + ')';
      }
      reader.readAsDataURL(file);
      thumb.className += ' js--no-default';
    }
    function checkType(file) {
      let imageType = /image.*/;
      if (!file.type.match(imageType)) {
        throw 'Datei ist kein Bild';
      } else if (!file) {
        throw 'Kein Bild gewählt';
      } else {
        previewImage(file);
      }
    }
  }

  // initialize box-scope
  var boxes = document.querySelectorAll('.box');
  for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
  }
  /// drop-effect
  function initDropEffect(box) {
    let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
    // get clickable area for drop effect
    area = box.querySelector('.js--image-preview');
    area.addEventListener('click', fireRipple);
    function fireRipple(e) {
      area = e.currentTarget
      // create drop
      if (!drop) {
        drop = document.createElement('span');
        drop.className = 'drop';
        this.appendChild(drop);
      }
      // reset animate class
      drop.className = 'drop';
      // calculate dimensions of area (longest side)
      areaWidth = getComputedStyle(this, null).getPropertyValue("width");
      areaHeight = getComputedStyle(this, null).getPropertyValue("height");
      maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));
      // set drop dimensions to fill area
      drop.style.width = maxDistance + 'px';
      drop.style.height = maxDistance + 'px';
      // calculate dimensions of drop
      dropWidth = getComputedStyle(this, null).getPropertyValue("width");
      dropHeight = getComputedStyle(this, null).getPropertyValue("height");
      // calculate relative coordinates of click
      // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
      x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
      y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;
      // position drop and animate
      drop.style.top = y + 'px';
      drop.style.left = x + 'px';
      drop.className += ' animate';
      e.stopPropagation();

    }
  }
  function validateFile() {
    const fileInput = document.querySelector('input[name="video"]');
    const fileSizeError = document.getElementById('fileSizeError');
    const maxFileSize = 5 * 1024 * 1024; // 5MB
    if (fileInput.files[0].size > maxFileSize) {
      fileSizeError.style.display = 'block';
      fileInput.value = ''; // Clear the file input to prevent submission
      return false;
    } else {
      fileSizeError.style.display = 'none';
      return true;
    }
  }
  function show_garage_opt() {
    var h = $('#garage').val();
    if (h == "Yes" || h == "Optional") {
      $('.garage_opt').show();
    } else {
      $('.garage_opt').hide();
    }
  }
  $(function() {
    show_garage_opt("");
  });
</script>
  <script>
    function show_card_field() {
      $('.card-field').removeClass('d-none');
    }
  </script>
  <script>
    $(function() {
      $('.add-row').on('click', function() {
        var socialRow = `<tr>
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
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.resFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
          $(this).show();
        });
        $('.commercialFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', true);
          $(this).hide();
        });

      } else if (p == "Income Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').show();
        $('.commercial-length').hide();

      } else if (p == "Commercial Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();

        $('.commercialFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
          $(this).show();
        });
        $('.resFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', true);
          $(this).hide();
        });


      } else {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.commercialFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', true);
          $(this).hide();
        });
        $('.resFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', true);
          $(this).hide();
        });

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
          errorClass: "text-error text-danger w-100",
          onkeyup: false,
          onfocusout: false,
        });
        StepWizard.setStep();
        property_type;
        $('#property_type').on('change', function() {
          property_type = $(this).val();
        });
        $('.wizard-step-next').click(function(e) {
          console.log(StepWizard.currentStep)
          if (v.form()) {
            if ($('.wizard-step.active').next().is('.wizard-step')) {

              $('.wizard-step.active').removeClass('active');
              if (StepWizard.currentStep == 3 && property_type ==
                'Commercial Property') {
                StepWizard.nextStep = 5;
                StepWizard.backStep = 3;
              } else if (StepWizard.currentStep == 11 && property_type ==
                'Commercial Property') {
                StepWizard.nextStep = 13;
                StepWizard.backStep = 11;
              } else if (StepWizard.currentStep == 17 && property_type ==
                'Commercial Property') {
                StepWizard.nextStep = 19;
                StepWizard.backStep = 17;
              } else {
                StepWizard.backStep = StepWizard.currentStep;

              }
              $('[ data-step="' + StepWizard.nextStep + '"]').addClass("active");
              StepWizard.setStep();
              //   if (StepWizard.currentStep == 50 &&
              //     property_type == 'Residential Property'
              //   ) {
              //     $('.wizard-step-next').hide();
              //     $('.wizard-step-finish').show();
              //   }
            }
          }
        });

        $('.wizard-step-back').click(function(e) {
          if ($('.wizard-step.active').prev().is('.wizard-step')) {

            $('.wizard-step.active').removeClass('active');
            $('[ data-step="' + StepWizard.backStep + '"]').addClass("active");
            StepWizard.setStep();
            console.log(StepWizard.currentStep)
            if (StepWizard.currentStep == 5 && property_type ==
              'Commercial Property') {
              StepWizard.backStep = 3;
            } else if (StepWizard.currentStep == 13 && property_type ==
              'Commercial Property') {
              StepWizard.backStep = 11;
            } else if (StepWizard.currentStep == 19 && property_type ==
              'Commercial Property') {
              StepWizard.backStep = 17;
            } else {
              StepWizard.backStep = StepWizard.currentStep - 1;
            }
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
            var lat = place.geometry['locations'].lat();
            var lng = place.geometry['locations'].lng();
            if (t == "counties") {
              $('#lat').val(lat);
              $('#long').val(lng);
            }
          }
        });
      }
    }
    var leaseTerms = $('#leaseTermsOptions');
    $('#leaseTermsOpt').change(function() {
      //Disply and hide a div
      ($(this).val().includes('3 months') || $(this).val().includes('6 months') || $(this).val().includes(
          '9 months') || $(this).val().includes('1 year') || $(this).val().includes('2 years') || $(this).val()
        .includes('3-5 years') || $(this).val().includes('5+ years') || $(this).val().includes('Month to Month') || $(
          this).val().includes('Other')) ? leaseTerms.show():
        leaseTerms.hide()
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


    var viewRefRes = $('#viewOptRes');
    $('#viewRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? viewRefRes.show():
        viewRefRes.hide()
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
    var viewRefComm = $('#viewOptComm');
    $('#viewOptionComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? viewRefComm.show():
        viewRefComm.hide()
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
    var waterViewRes = $('#waterViewResOpt');
    $('#waterViewRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterViewRes.show():
        waterViewRes.hide()
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
    var waterExtraRes = $('#waterExtraResOpt');
    $('#waterExtraRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterExtraRes.show():
        waterExtraRes.hide()
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
    var waterFrontageRes = $('#waterFrontageResOpt');
    $('#waterFrontageRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterFrontageRes.show():
        waterFrontageRes.hide()
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
    var waterAccessRes = $('#waterAccessResOpt');
    $('#waterAccessRes').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterAccessRes.show():
        waterAccessRes.hide()
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
    var garageParkingComm = $('#garageParkingOpt');
    $('#garageParkingComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? garageParkingComm.show():
        garageParkingComm.hide()
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
    var waterViewComm = $('#waterViewOptComm');
    $('#waterViewComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterViewComm.show():
        waterViewComm.hide()
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
    var waterExtraComm = $('#waterExtraOptComm');
    $('#waterExtraComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterExtraComm.show():
        waterExtraComm.hide()
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
    var waterFrontageComm = $('#waterfrontageOptComm');
    $('#waterFrontageComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterFrontageComm.show():
        waterFrontageComm.hide()
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
    var waterAccessComm = $('#waterAccessOptComm');
    $('#waterAccessComm').change(function() {
      //Disply and hide a div
      ($(this).val().includes('Yes') || $(this).val().includes('Optional')) ? waterAccessComm.show():
        waterAccessComm.hide()
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
