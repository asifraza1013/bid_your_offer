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


    .box {
        display: block;
        width: 400px;
        height: auto;
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
      width: 100%;
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
                <form class="p-4 pt-0 mainform" id="edit-landlord-auction" action="{{ route('agent.landlord.auction.update', @$auction->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('patch-script', ['moduleName' => 'edit-landlord-auction', 'patchName' => 'edit-landlord-auction', 'id' => $auction->id]);

    <script>
        $('select').trigger('change');

        function changeAuctionType(v) {
            if (v == "Auction Listing") {
                $('.auction_length').val("");
                $('.auction_length').parent().children('.option-container').removeClass('active');
                $('.traditional-length').hide();
                $('.normal-length').show();
                $('.auction_length_cover').show();
                $('.traditional').hide();
                $('.timerAuction').show();
            } else if (v == "Traditional Listing") {
                $('.auction_length').val("");
                $('.auction_length').parent().children('.option-container').removeClass('active');
                $('.traditional-length').show();
                $('.normal-length').hide();
                $('.auction_length_cover').hide();
                $('.traditional').show();
                $('.timerAuction').hide();
            }
        }
        // document.getElementById('auction_type').change();
        $(function() {
            changeAuctionType("Auction (Timer)");
        });

        // Nisar Changing
        Filevalidation = () => {

            var txt = "";
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 102400) {
                        // alert(
                        //     "File too Big, please select a file less than 2mb");
                        txt = "File too Big, please select a file less than 100mb";
                        document.getElementById("demo").innerHTML = txt;
                        // var myText = "File too Big, please select a file less than 2mb";
                    } else if (file < 102400) {
                        txt = "";
                        document.getElementById("demo").innerHTML = txt;
                    } else {
                        document.getElementById('size').innerHTML = '<b>' +
                            file + '</b> KB';
                    }
                }
            }
        }
        // Nisar Changing End
    </script>
    <script>
        function changePropertyType(p) {
            if (p == "Residential Property") {
                $('.property_items').val("");
                $('.property_items').parent().children('.option-container').removeClass('active');
                $('.residential-length').show();
                $('.income-length').hide();
                $('.commercial-length').hide();
                $('.residential_show').removeClass('d-none');
                $('.commercial_show').addClass('d-none');
                // nisar changing
                $('#leasable-sqft').remove();
                $('#price').remove();
                $('#terms').remove();
                $('.resFields').each(function() {
                    $(this).find('select, input,label,div,option,textarea').prop('disabled', false).show();
                });
                $('.commercialFields').each(function() {
                    $(this).find('select, input,label,div,option ,textarea').prop('disabled', true).hide();
                });


            } else if (p == "Commercial Property") {
                $('.property_items').val("");
                $('.property_items').parent().children('.option-container').removeClass('active');
                $('.residential-length').hide();
                $('.income-length').hide();
                $('.commercial-length').show();
                $('.residential_show').addClass('d-none');
                $('.commercial_show').removeClass('d-none');

                // nisar changing
                $('#price').show();
                $('#bathroom').remove();
                $('#commercial').remove();
                $('#furnishings').remove();
                $('#pool').remove();
                $('#priceSqft').remove();
                $('#RentIncludes').remove();
                $('#acceptPet').remove();
                $('.commercialFields').each(function() {
                    $(this).find('select, input,label,div,option ,textarea').prop('disabled', false).show();
                });
                $('.resFields').each(function() {
                    $(this).find('select,input,label,div,option ,textarea').prop('disabled', true).hide();
                });
            } else {
                $('.property_items').val("");
                $('.property_items').parent().children('.option-container').removeClass('active');
                $('.residential-length').hide();
                $('.income-length').hide();
                $('.commercial-length').hide();
            }
        }
        // document.getElementById('auction_type').change();
        // $(function() {
        //     changePropertyType("");
        // });
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
        //water view changing by waqas


        $(document).on('change', '#has_water_view', function() {

            var selectedOptionWater = $(this).val();
            // alert(selectedOptionWater);


            if (selectedOptionWater == 'No') {
                $('#water_show').hide();
                $('#water_extras_show').hide();
            }
            if (selectedOptionWater == 'Yes') {
                $('#water_show').show();
                $('#water_extras_show').show();
            }

        });

        //water view changing by waqas


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
                $(document).on('change', '#property_type', function() {
                    property_type = $(this).val();
                });
                $('.wizard-step-next').click(function(e) {
                    console.log(StepWizard.currentStep)
                    if (v.form()) {
                        if ($('.wizard-step.active').next().is('.wizard-step')) {

                            $('.wizard-step.active').removeClass('active');
                            if (StepWizard.currentStep == 13 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 15;
                                StepWizard.backStep = 13;
                            } else if (StepWizard.currentStep == 10 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 12;
                                StepWizard.backStep = 10;
                            } else if (StepWizard.currentStep == 17 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 21;
                                StepWizard.backStep = 17;
                            } else if (StepWizard.currentStep == 22 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 24;
                                StepWizard.backStep = 22;
                            }  
                            // else if (StepWizard.currentStep == 24 && property_type ==
                            //     'Commercial Property') {
                            //     StepWizard.nextStep = 26;
                            //     StepWizard.backStep = 24;
                            // }
                             else if (StepWizard.currentStep == 26 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 29;
                                StepWizard.backStep = 26;
                            } 
                            else if (StepWizard.currentStep == 32 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 35;
                                StepWizard.backStep = 32;
                            }
                              else if (StepWizard.currentStep == 41 && property_type ==
                                'Commercial Property') {
                                StepWizard.nextStep = 43;
                                StepWizard.backStep = 41;
                            } 
                            else if (StepWizard.currentStep == 28 && property_type ==
                                'Residential Property') {
                                StepWizard.nextStep = 30;
                                StepWizard.backStep = 28;
                            } 
                            else if (StepWizard.currentStep == 34 && property_type ==
                                'Residential Property') {
                                StepWizard.nextStep = 37;
                                StepWizard.backStep = 33;
                            } 
                            else if (StepWizard.currentStep == 38 && property_type ==
                                'Residential Property') {
                                StepWizard.nextStep = 42;
                                StepWizard.backStep = 38;
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
                        if (StepWizard.currentStep == 15 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 13;
                        } else if (StepWizard.currentStep == 12 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 10;
                        } else if (StepWizard.currentStep == 21 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 17;
                        } else if (StepWizard.currentStep == 24 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 22;
                        } 
                        // else if (StepWizard.currentStep == 26 && property_type ==
                        //     'Commercial Property') {
                        //     StepWizard.backStep = 24;
                        // } 
                        else if (StepWizard.currentStep == 29 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 26;
                        }else if (StepWizard.currentStep == 35 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 32;
                        } else if (StepWizard.currentStep == 43 && property_type ==
                            'Commercial Property') {
                            StepWizard.backStep = 41;
                        }  else if (StepWizard.currentStep == 30 && property_type ==
                            'Residential Property') {
                            StepWizard.backStep = 28;
                        } else if (StepWizard.currentStep == 37 && property_type ==
                            'Residential Property') {
                            StepWizard.backStep = 33;
                        } else if (StepWizard.currentStep == 42 && property_type ==
                            'Residential Property') {
                            StepWizard.backStep = 38;
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
