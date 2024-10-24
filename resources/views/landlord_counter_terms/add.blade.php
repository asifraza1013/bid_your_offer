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
    <h4>Landlord's Countered Terms</h4>
    <div class="card m-4">
      <div class="card-title">
      </div>
      <div class="card-body">
        <div class="wizard-steps-progress">
          <div class="steps-progress-percent"></div>
        </div>

        <form class="p-4 pt-0 mainform" action="{{ route('landlord.add-counter-terms') }}" method="POST"
          enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="landlordId" value="{{ $landlordId }}">
          @php
            $yes_or_nos = [
                ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
          @endphp

          <div class="wizard-step">
            <div class="form-group">
              <label class="fw-bold" for="timeframe">What is the timeframe offered to the agent in the Landlord Agency
                Agreement?</label>
              <input type="text" name="timeframe" class="form-control has-icon hide_arrow"
                data-icon="fa-solid fa-calendar-days" required>
            </div>
          </div>
          <div class="wizard-step">
            <div class="form-group">
              <label class="fw-bold" for="commission">What is the total commission being offered to the listing
                agent?</label>
              <input type="text" name="commission" class="form-control has-icon hide_arrow"
                data-icon="fa-solid fa-qrcode" required>
            </div>
            <div class="form-group">
              <label class="fw-bold" for="commission_for_tenants_agent">If a tenant is represented by an agent, what portion of the commission should be
                shared with the tenant’s agent?</label>
              <input type="text" name="agentCommission" class="form-control has-icon hide_arrow"
                data-icon="fa-solid fa-dollar" required>
            </div>
          </div>
          <div class="wizard-step">
            @php
            $services_data = [];
            if ($auction->get->property_type == 'Residential Property') {
              $services_data = [
                  [
                      'name' =>
                          "Conduct a thorough rental market analysis (RMA) to determine the property's value and pricing strategy.",
                      'target' => '',
                  ],
                  [
                      'name' => 'List the property on the Bid Your Offer platform.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'List the property on major real estate websites, such as Zillow, Trulia, Realtor.com, Homes.com, Homesnap, Hotpads, and others, to increase visibility and exposure.',
                      'target' => '',
                  ],
                  [
                      'name' => 'List the property on the Bid Your Offer platform.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          "Market the property to various groups, pages, and affiliates to generate interest and leads with a QR code or listing link leading to the property's listing.",
                      'target' => '',
                  ],
                  [
                      'name' =>
                          "Promote the property on social media platforms with a QR code or listing link leading to the property's listing.",
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Conduct real estate email marketing campaigns that lead to the property listing.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          "Provide professional photos showcasing the property's features.",
                      'target' => '',
                  ],
                  [
                      'name' =>
                          "Provide a professional video to showcase the property's features.",
                      'target' => '',
                  ],
                  [
                      'name' => "Provide a 3D tour to showcase the property's features.",
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Provide a floor plan of the property to highlight its layout and spatial configuration.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          "Provide virtual staging to enhance the property's visual appeal and attract potential tenants.",
                      'target' => '',
                  ],
                  ['name' => 'Host an Open House(s).', 'target' => ''],
                  [
                      'name' =>
                          "Send email alerts to tenants searching for properties that match the property's criteria the moment the property is listed directly through the MLS.",
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Conduct property showings and viewings for interested tenants.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Provide regular updates on market activity, showings, and feedback from potential tenants.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Conduct tenant screening with a thorough application process that includes credit, criminal, background, eviction, and income verification checks.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Assist in negotiating residential lease terms, including rental price, lease duration, and any additional clauses or provisions.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Assist in drafting residential lease agreements and required addendums/disclosures.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Assist with lease renewal negotiations and adjustments to rental terms.',
                      'target' => '',
                  ],
                  [
                      'name' => 'Assist with tenant move-in and move-out inspections.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Coordinate property maintenance and repairs through trusted contractors and vendors.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Handle tenant inquiries, maintenance requests, and resolve any issues that may arise during the tenancy.',
                      'target' => '',
                  ],
                  [
                      'name' =>
                          'Coordinate or assist in the move-in or move-out process for tenants.',
                      'target' => '',
                  ],
                  [
                      'name' => 'Other - Add additional services as needed.',
                      'target' => '.other_services',
                  ],
              ];
            } else {
              $services_data = [
                [
                    'name' =>
                        'Conduct a thorough rental market analysis (RMA) to determine the property\'s value and pricing strategy.',
                    'target' => '',
                ],
                ['name' => 'List the property on the MLS.', 'target' => ''],
                [
                    'name' =>
                        'List the property on Loopnet, a major commercial real estate website.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'List the property on Crexi, a major commercial real estate website.',
                    'target' => '',
                ],
                [
                    'name' => 'List the property on the Bid Your Offer platform.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Market the property to various groups, pages, and affiliates to generate interest and leads with a QR code or listing link leading to the property\'s listing.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Promote the property on social media platforms with a QR code or listing link leading to the property\'s listing.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Conduct real estate email marketing campaigns that lead to the property listing.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Provide professional photos showcasing the property\'s features.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Provide a professional video to showcase the property\'s features.',
                    'target' => '',
                ],
                [
                    'name' => 'Provide a 3D tour to showcase the property\'s features.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Provide a floor plan of the property to highlight its layout and spatial configuration.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Provide virtual staging to enhance the property\'s visual appeal and attract potential tenants.',
                    'target' => '',
                ],
                // ['name' => 'Host an Open House.', 'target' => ''],
                [
                    'name' =>
                        'Send email alerts to tenants searching for properties that match the property\'s criteria the moment the property is listed directly through the MLS.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Conduct property showings and viewings for interested tenants.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Provide regular updates on market activity, showings, and feedback from potential tenants.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Conduct tenant screening with a thorough application process that includes credit, criminal, background, eviction, and income verification checks.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Assist in negotiating residential lease terms, including rental price, lease duration, and any additional clauses or provisions.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Assist in drafting residential lease agreements and required addendums/disclosures.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Assist with lease renewal negotiations and adjustments to rental terms.',
                    'target' => '',
                ],
                [
                    'name' => 'Assist with tenant move-in and move-out inspections.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Coordinate property maintenance and repairs through trusted contractors and vendors.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Handle tenant inquiries, maintenance requests, and resolve any issues that may arise during the tenancy.',
                    'target' => '',
                ],
                [
                    'name' =>
                        'Coordinate or assist in the move-in or move-out process for tenants.',
                    'target' => '',
                ],

                [
                    'name' => 'Other - Add additional services as needed.',
                    'target' => '.other_services',
                ],
            ];
            }
        @endphp
            <div class="form-group">
              <label class="fw-bold">Select the services that the landlord requests from an agent:</label>
              <select class="grid-picker" name="services[]" id="services" multiple required>
                <option value="">Select</option>
                @foreach ($services_data as $service)
                  <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}" class="card flex-row"
                    style="width:calc(100% - 0px);" data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                    {{ $service['name'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group other_services d-none">
              <label class="fw-bold">What additional services will the agent provide to the buyer?</label>
              <input type="text" name="other_services" id="other_services" class="form-control has-icon"
                data-icon="fa-solid fa-hand-point-right" required />
            </div>
          </div>
          <div class="wizard-step">
            <div class="form-group">
              <label class="fw-bold">Additional Details or Countered Terms:</label>
              <textarea class="form-control" name="additionalDetails" rows="5" required></textarea>
            </div>
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
          // console.log(val, text, icon, classes);
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
  </script>

  <script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACES_API_KEY') }}&libraries=places&callback=initialize">
  </script>
@endpush
