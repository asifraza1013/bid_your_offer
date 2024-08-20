@extends('layouts.main')
@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
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

    .wizard-steps-progress {
      overflow: hidden;
    }

    .cityState #state,
    .countyState #state {
      display: none;
      ;
    }
  </style>
  <style>
    ::-ms-browse {
      height: 50px;
    }

    ::-webkit-file-upload-button {
      height: 50px;
    }

    input[type=file]::file-selector-button {
      height: 50px;
    }




    :root {
      --switches-bg-color: #169499;
      --switches-label-color: white;
      --switch-bg-color: white;
      --switch-text-color: #169499;
    }

    body {
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .switches-container {
      width: 16rem;
      position: relative;
      display: flex;
      padding: 0;
      position: relative;
      background: var(--switches-bg-color);
      line-height: 3rem;
      border-radius: 3rem;
      margin-left: auto;
      margin-right: auto;
    }

    /* input (radio) for toggling. hidden - use labels for clicking on */
    .switches-container input {
      visibility: hidden;
      position: absolute;
      top: 0;
    }

    /* labels for the input (radio) boxes - something to click on */
    .switches-container label {
      width: 50%;
      padding: 0;
      margin: 0;
      text-align: center;
      cursor: pointer;
      color: var(--switches-label-color);
    }

    .switch-wrapper {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 50%;
      padding: 0.15rem;
      z-index: 3;
      transition: transform .5s cubic-bezier(.77, 0, .175, 1);
      /* transition: transform 1s; */
    }

    /* switch box highlighter */
    .switch {
      border-radius: 3rem;
      background: var(--switch-bg-color);
      height: 100%;
    }

    .switch div {
      width: 100%;
      text-align: center;
      opacity: 0;
      display: block;
      color: var(--switch-text-color);
      transition: opacity .2s cubic-bezier(.77, 0, .175, 1) .125s;
      will-change: opacity;
      position: absolute;
      top: 0;
      left: 0;
    }

    /* slide the switch box from right to left */
    .switches-container input:nth-of-type(1):checked~.switch-wrapper {
      transform: translateX(0%);
    }

    /* slide the switch box from left to right */
    .switches-container input:nth-of-type(2):checked~.switch-wrapper {
      transform: translateX(100%);
    }

    /* toggle the switch box labels - first checkbox:checked - show first switch div */
    .switches-container input:nth-of-type(1):checked~.switch-wrapper .switch div:nth-of-type(1) {
      opacity: 1;
    }

    /* toggle the switch box labels - second checkbox:checked - show second switch div */
    .switches-container input:nth-of-type(2):checked~.switch-wrapper .switch div:nth-of-type(2) {
      opacity: 1;
    }
  </style>
@endpush
@section('content')
  @php
    $yes_or_nos = [
        ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
        ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
    ];
  @endphp
  <div class="container pt-5 pb-5">
    <div class="card">
      <div class="row">
        <div class="col-12 p-4">
          <form class="p-4 pt-0 mainform" action="{{ route('buyer.update-counter-terms', $counter->id) }}" method="POST"
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
                        "This is a service for tenants who are not currently working with a licensed agent."
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
                @if (auth()->user()->user_type == 'buyer')
                  Buyer’s Countered Terms
                @endif
                @if (auth()->user()->user_type == 'agent')
                  Agent’s Countered Terms
                @endif
              </h4>
              <div class="wizard-steps-progress">
                <div class="steps-progress-percent"></div>
              </div>
              <div class="wizard-step" data-step="1">
                <div class="form-group">
                  <label for="listing_title" class="fw-bold">What is the timeframe offered to the agent in the Buyer
                    Agency Agreement?</label>
                  <input type="text" name="timeframe" class="form-control has-icon" data-icon="fa-solid fa-qrcode"
                    required value="{{ $counter->timeframe }}">
                </div>
              </div>
              <div class="wizard-step" data-step="2">
                <span class="incomeFields">
                  <label class="fw-bold">
                    In cases where a property is For Sale By Owner or a Buyer’s agent commission is not offered, how will
                    the Buyer be able to pay their agent's commission?
                  </label>
                  <?php
                  $commissionIncome = [['target' => '', 'name' => "The Buyer will be able to pay their agent's commission out of pocket."], ['target' => '', 'name' => "The Buyer will ask the agent to include their agent's commission as a part of the offer to the Seller."], ['target' => '', 'name' => 'The Buyer will not allow any compensation that is not already offered.'], ['target' => '.OtherCommissionIncome', 'name' => 'Other']];
                  ?>
                  <select class="grid-picker" name="commission" id="commissionIncomeOpt"
                    style="justify-content: flex-start;" required>
                    <option value="">Select</option>
                    @foreach ($commissionIncome as $item)
                      <option value="{{ $item['name'] }}" {{ $item['name'] == $counter->commission ? 'selected' : '' }}
                        data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);"
                        data-icon='<i class="fa-regular fa-check-circle"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group" id="commissionIncomeOptOther"
                    {{ $counter->commission == 'Other' ? 'style=display:block;' : 'style=display:none;disabled;' }}>
                    <label class="fw-bold">
                      How will the Buyer be able to pay their agent's commission?</label>
                    <input type="text" name="otherCommission" value="{{ $counter->otherCommission }}"
                      class="form-control has-icon col-3" data-icon="fa-solid fa-qrcode" data-msg-required="" required>
                  </div>
                  <div class="form-group" id="commissionIncomeOptional"
                    {{ $counter->commission != 'The Buyer will not allow any compensation that is not already offered.' && $counter->commission != 'Other' ? 'style=display:block;' : 'style=display:none;disabled;' }}>


                    <label class="fw-bold">How much will the Buyer compensate their agent?</label>
                    <?php
                    $commissionOpt = [['target' => '', 'name' => '2%'], ['target' => '', 'name' => '2.5%'], ['target' => '', 'name' => '3%'], ['target' => '', 'name' => 'Negotiable'], ['target' => '.otherComIncomeOpt', 'name' => 'Other']];
                    ?>
                    <select class="grid-picker" name="commissionOpt" style="justify-content: flex-start;"
                      id="commissionOption" required>
                      <option value="">Select</option>
                      @foreach ($commissionOpt as $item)
                        <option value="{{ $item['name'] }}"
                          {{ $item['name'] == $counter->commissionOpt ? 'selected' : '' }}
                          data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);"
                          data-icon='<i class="fa-regular fa-check-circle"></i>'>
                          {{ $item['name'] }}
                        </option>
                      @endforeach
                    </select>
                    <div
                      class="form-group otherComIncomeOpt {{ $counter->commissionOpt == 'Other' ? 'd-block' : 'd-none' }} {{ $counter->commissionOpt != 'Other' ? 'disabled' : '' }}">
                      <label class="fw-bold">How much will the Buyer compensate their agent?</label>
                      <input type="text" name="otherComOptions" value="{{ $counter->otherComOptions }}"
                        class="form-control has-icon col-3" data-icon="fa-solid fa-qrcode" id="OtherComOptions"
                        data-msg-required="" required>
                    </div>
                  </div>
                </span>
              </div>
              <div class="wizard-step" data-step="3">
                @php
                  $commission = [
                      ['icon' => 'fa-regular fa-circle-check', 'name' => 'Yes'],
                      ['icon' => 'fa-regular fa-circle-xmark', 'name' => 'No'],
                      ['icon' => 'fa-regular fa-circle-check', 'name' => 'Optional'],
                  ];

                @endphp
                <div class="form-group">
                  <label class="fw-bold">In many situations, a Buyer's agent receives compensation from the Seller's
                    agent. The Seller agrees to pay their agent a commission, and that agent then shares their commission
                    with the Buyer's agent. If the Buyer's agent receives compensation from the Seller's agent, would the
                    buyer like to request that their hired agent offer a concession to assist with the buyer's closing
                    costs from the agent's commission?
                  </label>
                  <select class="grid-picker" name="compensation" id="property_type" required>
                    <option value="">Select</option>
                    @foreach ($commission as $item)
                      <option value="{{ $item['name'] }}"
                        {{ $item['name'] == $counter->compensation ? 'selected' : '' }} class="card flex-column"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <small>(Available in all the states except: Alabama, Alaska, Kansas, Mississippi, Missouri, Oklahoma,
                    Oregon, and Tennessee.)</small>
                </div>
              </div>
              <div class="wizard-step" data-step="4">
                @php
                  $services_data = [
                      [
                          'name' =>
                              'Assist the buyer in obtaining pre-approval or exploring financing options to determine their purchasing power.',
                          'target' => '',
                      ],
                      ['name' => 'List the Buyer’s Criteria Listing on the platform BidYourOffer.com.', 'target' => ''],
                      [
                          'name' =>
                              "Market the buyer's listing on numerous groups, pages, and affiliates through a listing link or QR code that links directly to the listing on BidYourOffer.com.",
                          'target' => '',
                      ],
                      [
                          'name' =>
                              "Promote the buyer's listing on social media platforms using a listing link or QR code that directs to the buyer's listing on the BidYourOffer.com platform.",
                          'target' => '',
                      ],
                      [
                          'name' =>
                              "Send prompt email notifications containing properties that meet the buyer's criteria as soon as they are listed, ensuring access to the most up-to-date listings.",
                          'target' => '',
                      ],
                      ['name' => 'Schedule and accompany the buyer on property viewings and showings.', 'target' => ''],
                      ['name' => 'Schedule video tours of the property as needed.', 'target' => ''],
                      [
                          'name' =>
                              'Provide detailed market analysis and comparative market information to help the buyer make informed decisions.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Assist the buyer in negotiations and in preparing offers to maximize their chances of securing the desired property.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Assist the buyer with the review and explanation of all contractual documents and disclosures.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Coordinate and oversee the home inspection process, including making recommendations for trusted inspectors.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Facilitate communication and coordination with other professionals involved in the transaction, such as lenders, attorneys, and title companies.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Provide guidance and support throughout the entire purchase transaction, from offer acceptance to closing.',
                          'target' => '',
                      ],
                      [
                          'name' =>
                              'Provide guidance and support throughout the entire purchase transaction, from offer acceptance to closing.',
                          'target' => '',
                      ],
                      ['target' => '.serviceOther', 'name' => 'Other-Add additional services as needed.'],
                  ];
                @endphp
                <div class="form-group">
                  <label class="fw-bold">Select the services the buyer wants the hired agent to provide: </label>
                  <select class="grid-picker" name="services[]" onchange="service_data(this.value)" id="services"
                    multiple required>
                    <option value="">Select</option>
                    @foreach ($services_data as $item)
                      @php
                        $serviceData = json_decode($counter->services);

                      @endphp
                      <option value="{{ $item['name'] }}" {{ in_array($item['name'], $serviceData) ? 'selected' : '' }}
                        data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(100% - 0px);"
                        data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                        {{ $item['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <div class="form-group serviceOther d-none">
                    <label class="fw-bold">Select the services that the buyer requests from an agent:</label>
                    <input type="text" class="form-control has-icon" name="serviceOther"
                      data-icon="fa-solid fa-qrcode" required />
                  </div>
                </div>
              </div>
              <div class="wizard-step" data-step="5">
                <div class="form-group">
                  <label class="fw-bold">Additional Details:</label>
                  <textarea name="additionalDetails" class="form-control" rows="5">{{ $counter->additionalDetails }}</textarea>
                </div>
                <div class="form-group">
                  <div class="container">
                    <div class="switches-container">
                      <input type="radio" id="switchMonthly" name="status" value="1"
                        {{ $counter->status == '1' ? 'checked' : '' }} />
                      <input type="radio" id="switchYearly" name="status" value="0"
                        {{ $counter->status == '0' ? 'checked' : '' }} />
                      <label for="switchMonthly">Active</label>
                      <label for="switchYearly">Inactive</label>
                      <div class="switch-wrapper">
                        <div class="switch">
                          <div>Active</div>
                          <div>Inactive</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between form-group mt-4">
                <div>
                  <a class="wizard-step-back btn btn-success btn-lg text-600" style="display: none;">Back</a>
                </div>
                <div>
                  <button type="button" class="wizard-step-next btn btn-success btn-lg text-600"
                    style="display: none;">Next</button>
                  <button type="button" class="wizard-step-finish btn btn-success btn-lg text-600"
                    style="display: none;">Update</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <template class="city_temp">
    <tr>
      <td>
        <div class="form-group">
          <div class="input-cover input-cover-0"><label for="cities" class="input-icon"><i
                class="fa-solid fa-flag-usa "></i></label><input type="text" name="cities[]" placeholder="City"
              data-type="cities" class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city"
              data-msg-required="Please enter city"></div>
        </div>
      </td>
    </tr>
  </template>
  <template class="county_temp">
    <tr>
      <td>
        <div class="input-cover input-cover-0"><label for="county" class="input-icon"><i
              class="fa-solid fa-flag-usa "></i></label><input type="text" id="county" name="counties[]"
            placeholder="County" data-type="counties" class="form-control has-icon search_places"
            data-icon="fa-solid fa-tree-city" data-msg-required="Please enter County"></div>
      </td>
    </tr>
  </template>
@endsection
@push('scripts')
  <script>
    function add_county_row() {
      var county_row = $('.county_temp').html();
      $('.county_btn_row').before(county_row);
      initialize();
    }

    function add_city_row() {
      var city_row = $('.city_temp').html();
      $('.city_btn_row').before(city_row);
      initialize();
    }

    function add_state_row() {
      var state_row = $('.state_temp').html();
      $('.state_btn_row').before(state_row);
      initialize();
    }

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
        } else if (t === "state") {
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
  </script>
  <script>
    function changeAuctionType(v) {
      if (v == "Auction (Timer)") {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').hide();
        $('.normal-length').show();
        $('.auction_length_cover').removeClass('d-none');

      } else {
        $('.auction_length').val("");
        $('.auction_length').parent().children('.option-container').removeClass('active');
        $('.traditional-length').show();
        $('.normal-length').hide();
        $('.auction_length_cover').addClass('d-none');
      }
    }
    // document.getElementById('auction_type').change();

    changeAuctionType();
  </script>
  <script>
    $('.exchange_trade_for').on('change', function() {
      var items = $(this).val();
      if (items == "Another home") {
        $('.custom_trade').addClass('d-none');

        $('.item_values').removeClass('d-none');
      } else if (items == "Vehicles") {
        $('.custom_trade').addClass('d-none');
        $('.item_values').removeClass('d-none');
      } else if (items == "Boats") {
        $('.custom_trade').addClass('d-none');
        $('.item_values').removeClass('d-none');
      } else if (items == "Motorhomes") {
        $('.custom_trade').addClass('d-none');
        $('.item_values').removeClass('d-none');
      } else if (items == "Artwork") {
        $('.custom_trade').addClass('d-none');
        $('.item_values').removeClass('d-none');
      } else if (items == "Jewelry") {
        $('.custom_trade').addClass('d-none');
        $('.item_values').removeClass('d-none');
      } else if (items == "Other") {
        $('.item_values').addClass('d-none');
        $('.custom_trade').removeClass('d-none');
      }
    });
    // function exchange_trade_for(p) {
    //     var selectedValue = selectElement.value;
    //     var selectedOption = selectElement.options[selectElement.selectedIndex];
    //     var target = selectedOption.getAttribute('data-target');

    //     alert('Selected Value: ' + selectedValue + '\nTarget: ' + target);
    // }
    // $(function() {
    //     exchange_trade_for("");
    //     });
  </script>
  <script>
    function changePropertyType(p) {
      if (p == "Residential Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').show();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.business_type_next').addClass('d-none');
        $('.business_type_next_hide').removeClass('d-none');
        $('.hide_vacant').addClass('d-none');
        $('.road_frontage_next_hide').removeClass('d-none');
        $('.residential_and_income_hide').addClass('d-none');
        $('.residential_and_income').removeClass('d-none');
        $('.for_income_only').addClass('d-none');
        $('.petYes').remove();
        $('.for_residential_only').removeClass('d-none');
        $('.residential_hide').removeClass('d-none');
        $('.business-length').hide();
        $('.businessTitle').addClass('d-none');
        $('.vacantTitle').addClass('d-none');
        $('.resFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
        });
        $('.commercialFields, .incomeFields, .vacantFields').each(function() {
          $(this).find('select, input, textarea').each(function() {
            $(this).prop('disabled', true);
          });
        });

      } else if (p == "Income Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').show();
        $('.commercial-length').hide();
        $('.residential_hide').removeClass('d-none');
        $('.residential_remove').remove();
        $('.vacant_land-length').hide();
        $('.business-length').hide();
        $('.petYesRes').remove();
        $('.businessTitle').addClass('d-none');
        $('.vacantTitle').addClass('d-none');
        $('.incomeFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
        });
        $('.commercialFields, .resFields, .vacantFields').each(function() {
          $(this).find('select, input, textarea').each(function() {
            $(this).prop('disabled', true);
          });
        });

      } else if (p == "Commercial Property") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').show();
        $('.business_type_next').removeClass('d-none');
        $('.business_type_next_hide').addClass('d-none');
        $('.residential_and_income').addClass('d-none');
        $('.residential_hide').addClass('d-none');
        $('.vacant_land-length').hide();
        $('.business-length').hide();
        $('.businessTitle').addClass('d-none');
        $('.vacantTitle').addClass('d-none');
        $('.commercialFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
        });
        $('.incomeFields, .resFields, .vacantFields').each(function() {
          $(this).find('select, input, textarea').each(function() {
            $(this).prop('disabled', true);
          });
        });

      } else if (p == "Vacant Land") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.business_type_next').removeClass('d-none');
        $('.business_type_next_hide').addClass('d-none');
        $('.residential_and_income').addClass('d-none');
        $('.residential_hide').addClass('d-none');
        $('.vacant_land-length').show();
        $('.business-length').hide();
        $('.businessTitle').addClass('d-none');
        $('.vacantTitle').removeClass('d-none');
        $('.vacantFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
        });
        $('.incomeFields, .resFields, .commercialFields').each(function() {
          $(this).find('select, input, textarea').each(function() {
            $(this).prop('disabled', true);
          });
        });

      } else if (p == "Business Opportunity") {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.business_type_next').removeClass('d-none');
        $('.business_type_next_hide').addClass('d-none');
        $('.residential_and_income').addClass('d-none');
        $('.residential_hide').addClass('d-none');
        $('.vacant_land-length').hide();
        $('.business-length').show();
        $('.businessTitle').removeClass('d-none');
        $('.vacantTitle').addClass('d-none');
        $('.commercialFields').each(function() {
          $(this).find('select, input ,textarea').prop('disabled', false);
        });
        $('.incomeFields, .resFields, .vacantFields').each(function() {
          $(this).find('select, input, textarea').each(function() {
            $(this).prop('disabled', true);
          });
        });
      } else {
        $('.property_items').val("");
        $('.property_items').parent().children('.option-container').removeClass('active');
        $('.residential-length').hide();
        $('.income-length').hide();
        $('.commercial-length').hide();
        $('.business_type_next').addClass('d-none');
        $('.business_type_next_hide').removeClass('d-none');
        $('.hide_vacant').addClass('d-none');
        $('.road_frontage_next_hide').removeClass('d-none');
        $('.vacant_land-length').hide();
        $('.business-length').hide();
        $('.businessTitle').addClass('d-none');
        $('.vacantTitle').addClass('d-none');

      }
    }
    // document.getElementById('auction_type').change();
    $(function() {
      changePropertyType("");
    });
  </script>
  <script>
    function changePropertyStyle(p) {
      if (p == "Vacant Land") {
        // alert('ok');
        $('.property_style_next_hide').addClass('d-none');
        $('.road_frontage_next_hide').addClass('d-none');
        $('.business_opportunity_show').addClass('d-none');
        $('.vacant_land_show').removeClass('d-none');
        $('.hide_vacant').removeClass('d-none');
        $('.show_vacant').removeClass('d-none');
        $('.vacant_land_hide').remove();
        // $('.remove_business_opportunity').remove();
        $('.business_opportunity_remove').show();

      } else {
        $('.vacant_land_show').addClass('d-none');
        $('.hide_vacant').addClass('d-none');
        $('.road_frontage_next_hide').removeClass('d-none');
        $('.business_opportunity_show').removeClass('d-none');
        $('#remove_pets_question').remove();
        // $('.vacant_land_remove').remove();
        $('.show_vacant').addClass('d-none');
      }
    }
    // document.getElementById('auction_type').change();
    $(function() {
      changePropertyStyle("");
    });
  </script>
  <script>
    function buyer_under_contract(w) {
      if (w == "Yes") {
        $('.has_assignment').removeClass('d-none');
        $('.has_no_assignment').addClass('d-none');
      } else if (w == "No") {
        $('.has_no_assignment').removeClass('d-none');
        $('.has_assignment').addClass('d-none');
      } else {
        $('.has_no_assignment').addClass('d-none');
        $('.has_assignment').addClass('d-none');
      }
    }

    function service_data(w) {
      if (w == "Other- Add additional services as needed") {
        $('#custom_service_buyer_want_income').removeClass('d-none');
        $('#custom_service_buyer_want').removeClass('d-none');
        $('#custom_service_buyer_want_commercial_and_business').removeClass('d-none');
        $('#custom_service_buyer_want_vacant').removeClass('d-none');
      } else {
        $('#custom_service_buyer_want_income').addClass('d-none');
        $('#custom_service_buyer_want').addClass('d-none');
        $('#custom_service_buyer_want_commercial_and_business').addClass('d-none');
        $('#custom_service_buyer_want_vacant').addClass('d-none');

      }
    }

    function change_sale_provision(w) {
      if (w == "Other") {
        $('#other_sale_provision').removeClass('d-none');
        $('#other_sale_provision1').removeClass('d-none');
        $('#other_sale_provision_commercial_and_business').removeClass('d-none');
        $('#other_sale_provision_vacant_land').removeClass('d-none');
      } else {
        $('#other_sale_provision').addClass('d-none');
        $('#other_sale_provision1').addClass('d-none');
        $('#other_sale_provision_commercial_and_business').addClass('d-none');
        $('#other_sale_provision_vacant_land').addClass('d-none');

      }
    }

    function buyerPrompt(w) {
      if (w == "4 Months" || w == "5 Months" || w == "6 Months" || w == "Over 6 Months" || w == "" || w ==
        'Not looking to sell') {
        $('.buying_timeframe_prompt').removeClass('d-none');
        $('#custom_timeframe_residential').addClass('d-none');
        $('#custom_timeframe_income').addClass('d-none');
        $('#custom_timeframe_commercial_and_business').addClass('d-none');
        $('#custom_timeframe_vacant_land').addClass('d-none');

      } else if (w == "Other") {
        $('#custom_timeframe_residential').removeClass('d-none');
        $('#custom_timeframe_income').removeClass('d-none');
        $('#custom_timeframe_commercial_and_business').removeClass('d-none');
        $('#custom_timeframe_vacant_land').removeClass('d-none');
        $('.buying_timeframe_prompt').addClass('d-none');
      } else {
        $('#custom_timeframe_residential').addClass('d-none');
        $('#custom_timeframe_income').addClass('d-none');
        $('#custom_timeframe_vacant_land').addClass('d-none');
        $('#custom_timeframe_commercial_and_business').addClass('d-none');
        $('.buying_timeframe_prompt').addClass('d-none');
      }
    }

    function showPrompt(w) {
      if (w == "4 Months" || w == "5 Months" || w == "6 Months" || w == "Over 6 Months" || w == "" || w ==
        'Not looking to sell') {
        $('.prompt_response').removeClass('d-none');
        $('#custom_timeframe_residential').addClass('d-none');
        $('#custom_timeframe_income').addClass('d-none');
        $('#custom_timeframe_commercial_and_business').addClass('d-none');
        $('#custom_timeframe_vacant_land').addClass('d-none');

      } else if (w == "Other") {
        $('#custom_timeframe_residential').removeClass('d-none');
        $('#custom_timeframe_income').removeClass('d-none');
        $('#custom_timeframe_commercial_and_business').removeClass('d-none');
        $('#custom_timeframe_vacant_land').removeClass('d-none');
        $('.prompt_response').addClass('d-none');
      } else {
        $('#custom_timeframe_residential').addClass('d-none');
        $('#custom_timeframe_income').addClass('d-none');
        $('#custom_timeframe_vacant_land').addClass('d-none');
        $('#custom_timeframe_commercial_and_business').addClass('d-none');
        $('.prompt_response').addClass('d-none');
      }
    }

    function changeWaterExtras(w) {
      if (w == "Yes" || w == "Optional") {
        $('.water_extras_residential_and_income').show();
      } else {
        $('.water_extras_residential_and_income').hide();
      }
    }

    function changeWaterFrontage(w) {
      if (w == "Yes" || w == "Optional") {
        $('.water_frontage_residential_and_income').show();
      } else {
        $('.water_frontage_residential_and_income').hide();
      }
    }

    function changeViewPrefrence(w) {
      if (w == "Yes" || w == "Optional") {
        $('.water_view_preference_residential_and_income').show();
      } else {
        $('.water_view_preference_residential_and_income').hide();
      }
    }
    $(function() {
      changeWaterView("");
      changeWaterAccess("");
      changeWaterExtras("");
      changeWaterFrontage("");
      changeViewPrefrence("");
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
      check_custom();
    }

    function check_custom() {
      $('.option-container').each(function(i, elm) {
        var target = $(elm).data('target') || "";
        var is_active = $(elm).hasClass('active');
        if (target != "") {
          //   console.log("is_active", is_active, target);
          if (is_active) {
            $(target).removeClass("d-none");
          } else {
            $(target).addClass("d-none");
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
          // alert($('.wizard-step.active').next().is('.wizard-step'));
          if (v.form()) {
            if ($('.wizard-step.active').next().is('.wizard-step')) {

              // $('.wizard-step.active').removeClass('active').next().addClass('active');
              $('.wizard-step.active').removeClass('active');

              if (StepWizard.currentStep == 6 && property_type ==
                'Income Property') {
                StepWizard.nextStep = 26;
                StepWizard.backStep = 6;
              } else if (StepWizard.currentStep == 6 && property_type ==
                'Residential Property') {
                StepWizard.nextStep = 7;
                StepWizard.backStep = 6;
              } else if (StepWizard.currentStep == 6 && (property_type ==
                  'Commercial Property' || property_type ==
                  'Business Opportunity')) {
                StepWizard.nextStep = 53;
                StepWizard.backStep = 6;
              } else if (
                StepWizard.currentStep == 59 && (property_type == 'Commercial Property')
              ) {
                StepWizard.nextStep = 61;
                StepWizard.backStep = 59;
              } else if (StepWizard.currentStep == 6 && property_type ==
                'Vacant Land'
              ) {
                StepWizard.nextStep = 42;
                StepWizard.backStep = 6;
              } else {
                StepWizard.backStep = StepWizard.currentStep;
              }
              console.log(StepWizard.currentStep)
              $('[ data-step="' + StepWizard.nextStep + '"]').addClass("active");
              StepWizard.setStep();
              if (
                StepWizard.currentStep == 24 &&
                property_type == 'Residential Property'
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (
                StepWizard.currentStep == 41 &&
                property_type == 'Income Property'
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (
                StepWizard.currentStep == 69 &&
                (property_type == 'Commercial Property' || property_type ==
                  'Business Opportunity')
              ) {
                $('.wizard-step-next').hide();
                $('.wizard-step-finish').show();
              }
              if (
                StepWizard.currentStep == 52 &&
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
            console.log(StepWizard.currentStep)
            StepWizard.setStep();
            if (StepWizard.currentStep == 26 && property_type ==
              'Income Property') {
              StepWizard.backStep = 6;
            } else if (StepWizard.currentStep == 53 && property_type ==
              'Business Opportunity') {
              StepWizard.backStep = 6;
            } else if (StepWizard.currentStep == 53 && property_type ==
              'Commercial Property') {
              StepWizard.backStep = 6;
            } else if (StepWizard.currentStep == 7 && property_type ==
              'Residential Property') {
              StepWizard.backStep = 6;
            } else if (StepWizard.currentStep == 61 && (property_type == 'Commercial Property')) {
              StepWizard.backStep = 59;
            } else if (StepWizard.currentStep == 42 && property_type == 'Vacant Land') {
              StepWizard.backStep = 6;
            } else {
              StepWizard.backStep = StepWizard.currentStep - 1;
            }
          }
        });
        // Assuming the code provided is within a function or a document.ready block

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
        var comp = 0;

        if (StepWizard.currentStep >= 1 && StepWizard.currentStep <= 5) {
          // Calculate progress for Residential steps (7 to 19)
          comp = 20 + ((StepWizard.currentStep - 1) / (5 - 1)) * 80;
        } else {
          // Default progress calculation for other steps
          comp = ((StepWizard.currentStep - 1) / 4) * 20;
        }
        $('.steps-progress-percent').animate({
          width: comp.toFixed(0) + '%',
        });
      },
      currentStep: 1,
      nextStep: 2,
      bsckStep: 1,
      total_steps: 0,
      data_step: 1,
    };
    $(document).on('change', '#need_water_view', function() {
      var selectedValue = $(this).val();
      if (selectedValue == 'No') {
        $('#prefer_water_view').hide();
        $('#extra_water').hide();
      }
      if (selectedValue == 'No') {
        $('#prefer_water_view').hide();
        $('#extra_water').hide();

      }
      if (selectedValue == 'Yes') {
        $('#prefer_water_view').show();
        $('#extra_water').show();

      }
    });
  </script>

  <script>
    // Commission Income
    var toggleCommissionIncome = $('#commissionIncomeOptional');
    var toggleCommissionIncomeOther = $('#commissionIncomeOptOther');

    $('#commissionIncomeOpt').change(function() {
      //Disply and hide a div
      if ($(this).val().includes("The Buyer will be able to pay their agent's commission out of pocket.") || $(this)
        .val().includes(
          "The Buyer will ask the agent to include their agent's commission as a part of the offer to the Seller.")) {
        toggleCommissionIncome.show();
        toggleCommissionIncomeOther.hide();
      } else if ($(this).val().includes("Other")) {
        toggleCommissionIncomeOther.show();
        toggleCommissionIncome.hide();
      } else {
        toggleCommissionIncomeOther.hide();
        toggleCommissionIncome.hide();
      }

      // Remove previously selected child options
      $('#commissionOption option[data-parent="' + $(this).val() + '"]:selected').prop('selected', false);

      // Show the selected option
      var selectedValue = $(this).val();
      $('#commissionOption option[value="' + selectedValue + '"]').prop('selected', true);

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
