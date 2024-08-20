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
                <form class="p-4 pt-0 mainform" action="{{ route('buyer.add-auction') }}" method="POST" enctype="multipart/form-data">
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
                        {{-- Slide 1  --}}
                        <div class="wizard-step" data-step="1">
                            <div class="form-group">
                                <label class="fw-bold">Is the buyer currently represented by another agent?</label>
                                <select class="grid-picker" name="working_with_agent" id="working_with_agent" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($yes_or_nos as $yes_or_no)
                                    <option value="{{ $yes_or_no['name'] }}" data-target="{{ $yes_or_no['target'] }}" class="card flex-row fw-bold" style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $yes_or_no['icon'] }}"></i>'>
                                        {{ $yes_or_no['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="yes_message text-danger" style="font-size:18px; font-weight:bold;"></label>
                            </div>
                        </div>
                        {{-- Slide 1 --}}
                        {{-- Slide 2  --}}
                        <div class="wizard-step" data-step="2">
                            <h4> Please provide the cities, counties, and state pertaining to the real estate location
                                that the buyer intends to purchase a property. </h4>
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="cities[]" placeholder="City" data-type="cities" id="cities" class="form-control  search_places" data-icon="fa-solid fa-city" data-msg-required="Please enter city" required>
                                            </td>
                                        </tr>
                                        <tr class="city_btn_row">
                                            <td><button type="button" class="btn btn-secondary btn-sm w-100" onclick="add_city_row();"><i class="fa-solid fa-plus"></i> Add New
                                                    Row</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Counties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="counties[]" placeholder="County" data-type="counties" id="counties" class="form-control  search_places" data-icon="fa-solid fa-city" data-msg-required="Please enter County" required>
                                            </td>
                                        </tr>
                                        <tr class="city_btn_row">
                                            <td><button type="button" class="btn btn-secondary btn-sm w-100" onclick="add_county_row();"><i class="fa-solid fa-plus"></i> Add New
                                                    Row</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">State:</label>
                                <input type="text" name="state" name="state" placeholder="State" data-type="states" id="state" class="form-control search_places has-icon" data-icon="fa-solid fa-flag-usa" data-msg-required="Please enter state" required>
                            </div>

                        </div>
                        {{-- Slide 2  --}}
                        {{-- Slide 3  --}}
                        <div class="wizard-step" data-step="3">
                            <div class="form-group">
                                <label for="address">Listing Date:</label>
                                <input type="date" name="listing_date" id="listing_date" class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days" data-msg-required="Please enter listing date" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Expiration Date:</label>
                                <input type="date" name="expiration_date" id="expiration_date" class="form-control has-icon search_places" data-icon="fa-regular fa-calendar-days" data-msg-required="Please enter expiration date" required>
                            </div>
                        </div>
                        {{-- Slide 3  --}}
                        {{-- Slide 4  --}}
                        <div class="wizard-step" data-step="4">
                            <div class="form-group">
                                <label class="fw-bold">
                                    Listing Type:
                                </label>
                                <div>
                                    @php
                                    $auction_types = [['name' => 'Auction (Timer)', 'icon' => '<i class="fa-regular fa-clock"></i>', 'target' => ''], ['name' => 'Traditional (No Timer)', 'icon' => '<i class="fa-regular fa-circle-xmark"></i>', 'target' => '']];
                                    @endphp
                                    <select name="auction_type" id="auction_type" class="grid-picker" style="justify-content: flex-start;" onchange="changeAuctionType(this.value);" required>
                                        <option value=""></option>
                                        @foreach ($auction_types as $item)
                                        <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='{{ $item['icon'] }}'>
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
                                    <select name="auction_length" id="auction_length" class="auction_length grid-picker" style="justify-content: flex-start;" required>
                                        <option value=""></option>
                                        @foreach ($auction_lengths as $item)
                                        <option value="{{ $item['name'] }}" data-target="" class="card flex-row  {{ $item['class'] }}" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        {{-- Slide 4  --}}
                        {{-- Slide 5  --}}
                        <div class="wizard-step" data-step="5">
                            <div class="form-group">
                                <label class="fw-bold" for="heated_sqft">Title of Listing:</label>
                                <input type="text" name="title_of_listing" placeholder="Title of Listing:" id="title_of_listing" class="form-control has-icon hide_arrow" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Heated sqft" required>
                            </div>
                        </div>
                        {{-- Slide 5  --}}
                        {{-- Slide 6  --}}
                        <div class="wizard-step" data-step="6">
                            @php
                            $property_types = [['name' => 'Residential Property'], ['name' => 'Income Property'], ['name' => 'Commercial Property'], ['name' => 'Business Opportunity (Business Type)'], ['name' => 'Vacant Land (Current Use)']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please select the property types in which the buyer is
                                    interested in purchasing:</label>
                                <select class="grid-picker" name="property_type" id="property_type" onchange="changePropertyType(this.value);" required>
                                    <option value="">Select</option>
                                    @foreach ($property_types as $row_pt)
                                    <option value="{{ $row_pt['name'] }}" class="card flex-column" style="width:calc(24% - 10px);" data-icon='<i class="fa-solid fa-hotel"></i>'>
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
                                    // Business Items
                                    ['name' => 'Aeronautical', 'class' => 'business-length'],
                                    ['name' => 'Agriculture', 'class' => 'business-length'],
                                    ['name' => 'Arts and Entertainment', 'class' => 'business-length'],
                                    ['name' => 'Assembly Hall', 'class' => 'business-length'],
                                    ['name' => 'Assisted Living', 'class' => 'business-length'],
                                    ['name' => 'Auto Dealer', 'class' => 'business-length'],
                                    ['name' => 'Auto Service', 'class' => 'business-length'],
                                    ['name' => 'Bar/Tavern/Lounge', 'class' => 'business-length'],
                                    ['name' => 'Barber/Beauty', 'class' => 'business-length'],
                                    ['name' => 'Car Wash', 'class' => 'business-length'],
                                    ['name' => 'Child Care', 'class' => 'business-length'],
                                    ['name' => 'Church', 'class' => 'business-length'],
                                    ['name' => 'Commercial', 'class' => 'business-length'],
                                    ['name' => 'Construction/Contractor', 'class' => 'business-length'],
                                    ['name' => 'Distribution', 'class' => 'business-length'],
                                    ['name' => 'Distributor Routine Ven', 'class' => 'business-length'],
                                    ['name' => 'Education/School', 'class' => 'business-length'],
                                    ['name' => 'Farm', 'class' => 'business-length'],
                                    ['name' => 'Fashion/Specialty', 'class' => 'business-length'],
                                    ['name' => 'Flex Space', 'class' => 'business-length'],
                                    ['name' => 'Florist/Nursery', 'class' => 'business-length'],
                                    ['name' => 'Food & Beverage', 'class' => 'business-length'],
                                    ['name' => 'Gas Station', 'class' => 'business-length'],
                                    ['name' => 'Grocery', 'class' => 'business-length'],
                                    ['name' => 'Heavy Weight Sales Service', 'class' => 'business-length'],
                                    ['name' => 'Hotel/Motel', 'class' => 'business-length'],
                                    ['name' => 'Industrial', 'class' => 'business-length'],
                                    ['name' => 'Light Items Sales Only', 'class' => 'business-length'],
                                    ['name' => 'Manufacturing', 'class' => 'business-length'],
                                    ['name' => 'Marine/Marina', 'class' => 'business-length'],
                                    ['name' => 'Medical', 'class' => 'business-length'],
                                    ['name' => 'Mixed', 'class' => 'business-length'],
                                    ['name' => 'Mobile/Trailer Park', 'class' => 'business-length'],
                                    ['name' => 'Other', 'class' => 'business-length'],
                                    ['name' => 'Professional Service', 'class' => 'business-length'],
                                    ['name' => 'Professional/Office', 'class' => 'business-length'],
                                    ['name' => 'Recreation', 'class' => 'business-length'],
                                    ['name' => 'Research & Development', 'class' => 'business-length'],
                                    ['name' => 'Residential', 'class' => 'business-length'],
                                    ['name' => 'Restaurant', 'class' => 'business-length'],
                                    ['name' => 'Retail', 'class' => 'business-length'],
                                    ['name' => 'Storage', 'class' => 'business-length'],
                                    ['name' => 'Theatre', 'class' => 'business-length'],
                                    ['name' => 'Timberland', 'class' => 'business-length'],
                                    ['name' => 'Veterinary', 'class' => 'business-length'],
                                    ['name' => 'Warehouse', 'class' => 'business-length'],
                                    ['name' => 'Wholesale', 'class' => 'business-length'],
                                    // Vacant Land Items
                                    ['name' => 'Billboard Site', 'class' => 'vacant_land-length'],
                                    ['name' => 'Business', 'class' => 'vacant_land-length'],
                                    ['name' => 'Cattle', 'class' => 'vacant_land-length'],
                                    ['name' => 'Commercial', 'class' => 'vacant_land-length'],
                                    ['name' => 'Farm', 'class' => 'vacant_land-length'],
                                    ['name' => 'Fishery', 'class' => 'vacant_land-length'],
                                    ['name' => 'Highway Frontage', 'class' => 'vacant_land-length'],
                                    ['name' => 'Horses', 'class' => 'vacant_land-length'],
                                    ['name' => 'Industrial', 'class' => 'vacant_land-length'],
                                    ['name' => 'Land Fill', 'class' => 'vacant_land-length'],
                                    ['name' => 'Livestock', 'class' => 'vacant_land-length'],
                                    ['name' => 'Mixed Use', 'class' => 'vacant_land-length'],
                                    ['name' => 'Nursery', 'class' => 'vacant_land-length'],
                                    ['name' => 'Orchard', 'class' => 'vacant_land-length'],
                                    ['name' => 'Other', 'class' => 'vacant_land-length'],
                                    ['name' => 'Pasture', 'class' => 'vacant_land-length'],
                                    ['name' => 'Poultry', 'class' => 'vacant_land-length'],
                                    ['name' => 'Ranch', 'class' => 'vacant_land-length'],
                                    ['name' => 'Residential', 'class' => 'vacant_land-length'],
                                    ['name' => 'Row Crops', 'class' => 'vacant_land-length'],
                                    ['name' => 'Sod Farm', 'class' => 'vacant_land-length'],
                                    ['name' => 'Subdivision', 'class' => 'vacant_land-length'],
                                    ['name' => 'Timber', 'class' => 'vacant_land-length'],
                                    ['name' => 'Tracts', 'class' => 'vacant_land-length'],
                                    ['name' => 'Trans/Cell Tower', 'class' => 'vacant_land-length'],
                                    ['name' => 'Tree Farm', 'class' => 'vacant_land-length'],
                                    ['name' => 'Unimproved Land', 'class' => 'vacant_land-length'],
                                    ['name' => 'Well Field', 'class' => 'vacant_land-length'],
                                    ];
                                    @endphp
                                    <select name="property_items[]" id="property_items" class="property_items grid-picker" style="justify-content: flex-start;" multiple required>
                                        <option value=""></option>
                                        @foreach ($property_items as $item)
                                        <option value="{{ $item['name'] }}" data-target="" class="card flex-row {{ $item['class'] }}" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Slide 6  --}}

                        {{-- Residential SLides Start    --}}
                        {{-- Slide 7  --}}
                        <div class="wizard-step" data-step="7">
                            @php
                            $sale_provision = [['name' => 'Regular Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Pre-Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'New Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Assignment Contract (Wholesale properties)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Short Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">
                                    Please select the sale provisions in which the buyer is interested in purchasing:
                                </label>
                                <select class="grid-picker" name="sale_provision" onchange="change_sale_provision(this.value)" id="sale_provision" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($sale_provision as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.other_sale_provision';
                                    } elseif ($item['name'] == 'Assignment Contract (Wholesale properties)') {
                                    $target = '.sale_provision_custom';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row sale_provision_custom d-none">
                                <div class="form-group">
                                    <label class="fw-bold">Is the buyer currently under contract with a property they
                                        would like to assign?</label>
                                    <select class="grid-picker" name="financing_info" onchange="buyer_under_contract(this.value)" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group has_assignment d-none">
                                    <label class="fw-bold">What fee would the buyer pay the agent to assign the
                                        contract? $ % or</label>
                                    <input type="number" name="finder_fee" placeholder="0.00" id="concession" min="0.5" step=".01" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="Finder Fee" placeholder="% or $">
                                </div>
                                <div class="form-group has_no_assignment d-none">
                                    <label class="fw-bold">Is the buyer looking to take over another buyer's
                                        contract?</label>
                                    <select class="grid-picker" name="another_contract" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  d-none" id="other_sale_provision">
                                <label class="fw-bold">Please select the sale provisions in which the buyer is
                                    interested in purchasing:</label>
                                <input type="text" name="custom_sale_provisions" id="custom_sale_provisions" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-qrcode" data-msg-required="Sale Provision" placeholder="Sale Provision">
                            </div>
                        </div>
                        {{-- Slide 7  --}}
                        {{-- Slide 8  --}}
                        <div class="wizard-step" data-step="8">
                            @php
                            $conditions_interested = [['name' => 'Not Updated: Requires a complete update.'], ['name' => 'Tear Down: Requires complete demolition and reconstruction.'], ['name' => 'Semi-updated, needs minor updates: Partially updated, but requires additional minor updates.'], ['name' => 'Move-in Ready, Completely Updated: Fully updated and ready for occupancy.'], ['name' => 'Open to any type of property condition.']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please select the property conditions in which the buyer is
                                    interested in purchasing:</label>
                                <select class="grid-picker" name="condition_interested[]" id="condition_interested" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($conditions_interested as $condition_interested)
                                    <option value="{{ $condition_interested['name'] }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $condition_interested['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 8  --}}
                        {{-- Slide 9  --}}
                        @php
                        $bedrooms = [['name' => '1+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Other', 'target' => '.other_bedrooms1']];
                        $bathrooms = [['name' => '1', 'target' => ''], ['name' => '1.5+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '2.5+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '3.5+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '4.5+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Other', 'target' => '.other_bathrooms']];
                        @endphp
                        <div class="wizard-step" data-step="9">
                            <div class="form-group">
                                <label class="fw-bold">How many bedrooms does the buyer require?</label>
                                <select class="grid-picker" name="bedrooms" id="bedrooms" style="justify-content: center;" required>
                                    <option value="">Select</option>
                                    @foreach ($bedrooms as $bedroom)
                                    <option value="{{ $bedroom['name'] }}" @php if ($bedroom['name']=='Other' ) { $target='.other_bedrooms1' ; } else { $target='' ; } @endphp data-target="{{ $bedroom['target'] }}" class="card flex-column" style="width:calc(20% - 10px);" data-icon='<i class="fa-solid fa-bed"></i>'>
                                        {{ $bedroom['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group other_bedrooms1 d-none">
                                <label class="fw-bold" for="other_bedrooms">Bedrooms:</label>
                                <input type="text" name="other_bedrooms" id="other_bedrooms" placeholder="Custom Bedrooms" class="form-control has-icon" data-icon="fa-solid fa-bed" data-msg-required="Please enter Custom Bedrooms" required>
                            </div>
                        </div>
                        {{-- Slide 9  --}}
                        {{-- Slide 10  --}}
                        <div class="wizard-step" data-step="10">
                            <div class="form-group">
                                <label class="fw-bold">How many bathrooms does the buyer require?</label>
                                <select class="grid-picker" name="bathrooms" id="bathrooms" style="justify-content: center;" required>
                                    <option value="">Select</option>
                                    @foreach ($bathrooms as $bathroom)
                                    <option value="{{ $bathroom['name'] }}" data-target="{{ $bathroom['target'] }}" class="card flex-column" style="width:calc(20% - 10px);" data-icon='<i class="fa-solid fa-bath"></i>'>
                                        {{ $bathroom['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group other_bathrooms d-none">
                                <label class="fw-bold" for="other_bathrooms">Bathrooms:</label>
                                <input type="text" name="other_bathrooms" id="other_bathrooms" placeholder="Custom Bathrooms" class="form-control has-icon" data-icon="fa-solid fa-bath" data-msg-required="Please enter Custom Bathrooms" required>
                            </div>
                        </div>
                        {{-- Slide 10 --}}
                        {{-- Slide 11 --}}
                        <div class="wizard-step" data-step="11">
                            <div class="form-group">
                                <label class="fw-bold" for="heated_sqft">What is the minimum heated square footage
                                    required?</label>
                                <input type="number" name="minimum_heated_sqft" placeholder=" Minimum Heated sqft" id="minimum_heated_sqft" class="form-control has-icon hide_arrow" data-icon="fa-solid fa-ruler-combined" data-msg-required="Please enter Heated sqft">
                            </div>
                        </div>
                        {{-- Slide 11 --}}
                        {{-- Slide 12 --}}
                        @php
                        $yes_or_nos = [['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark']];
                        @endphp
                        <div class="wizard-step" data-step="12">
                            <div class="form-group">
                                <label class="fw-bold">Are there any non-negotiable amenities or property features that
                                    the buyer is seeking?</label>
                                <select class="grid-picker" name="has_non_negotiable_amenities" id="has_non_negotiable_amenities" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($yes_or_nos as $item)
                                    @php
                                    if ($item['name'] == 'Yes') {
                                    $target = '.custom_bathroom_residential_and_income';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                            $non_negotiable_terms = [
                            ['name' => 'Garage', 'target' => ''],
                            ['name' => 'Carport', 'target' => ''],
                            ['name' => 'Pool', 'target' => ''],
                            ['name' => 'Waterfront', 'target' => ''],
                            ['name' => 'In-Unit Laundry', 'target' => ''],
                            ['name' => 'On-site Laundry', 'target' => ''],
                            ['name' => 'Washer and Dryer Hookup', 'target' => ''],
                            ['name' => 'Washer and Dryer', 'target' => ''],
                            ['name' => 'Covered Carport', 'target' => ''],
                            ['name' => 'First Floor Unit', 'target' => ''],
                            ['name' => 'Elevator', 'target' => ''],
                            ['name' => 'Pet Friendly', 'target' => ''],
                            ['name' => 'Balcony/Patio', 'target' => ''],
                            ['name' => 'Fitness Center/Gym', 'target' => ''],
                            ['name' => 'Central Heating', 'target' => ''],
                            ['name' => 'Central Air Conditioning', 'target' => ''],
                            ['name' => 'Fireplace', 'target' => ''],
                            ['name' => 'Walk-in Closet', 'target' => ''],
                            ['name' => 'Hardwood Floors', 'target' => ''],
                            ['name' => 'Tile Floors', 'target' => ''],
                            ['name' => 'Carpet Floors', 'target' => ''],
                            ['name' => 'Security System', 'target' => ''],
                            ['name' => 'Gated Community', 'target' => ''],
                            ['name' => 'HOA Community', 'target' => ''],
                            ['name' => '55 and Over Community', 'target' => ''],
                            ['name' => 'Specific School District', 'target' => ''],
                            ['name' => 'Accessibility Features', 'target' => ''],
                            ['name' => 'On-site Maintenance', 'target' => ''],
                            ['name' => 'On-site Management', 'target' => ''],
                            ['name' => 'Outdoor Space', 'target' => ''],
                            ['name' => 'Playground', 'target' => ''],
                            ['name' => 'Clubhouse', 'target' => ''],
                            ['name' => 'Storage Space', 'target' => ''],
                            ['name' => 'Study/Den/Office', 'target' => ''],
                            ['name' => 'Updated Kitchen', 'target' => ''],
                            ['name' => 'Updated Bathroom', 'target' => ''],
                            ['name' => 'Other', 'target' => '.custom_non_negotiable_terms'],
                            ];
                            @endphp

                            <div class="form-group custom_bathroom_residential_and_income d-none">
                                <select class="grid-picker" name="non_negotiable_terms" id="utilities" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($non_negotiable_terms as $item)
                                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row" style="width:calc(33.3% - 10px);">
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_non_negotiable_terms d-none">
                                <label class="fw-bold" for="custom_non_negotiable_terms">Are there any non-negotiable
                                    amenities or property features that the buyer is seeking?</label>
                                <input type="text" name="custom_non_negotiable_terms" id="custom_non_negotiable_terms" placeholder="Custom Non-Negotiable Terms" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Non-Negotiable Terms" required>
                            </div>
                        </div>
                        {{-- Slide 12 --}}
                        {{-- Slide 13 --}}
                        <div class="wizard-step" data-step="13">
                            @php
                            $financings_info = [['name' => 'Yes, pre-approved'], ['name' => 'Yes, cash buyer'], ['name' => 'No, I need a lender recommendation'], ['name' => 'No, I have my own lender I will apply with']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold"> Is the buyer pre-approved for a loan, or are they a cash
                                    buyer?</label>
                                <select class="grid-picker" name="are_they_been_pre_approved" id="are_they_been_pre_approved" required>
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
                                    <option value="{{ $financing_info['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $financing_info['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        {{-- Slide 13 --}}
                        {{-- Slide 14 --}}
                        <div class="wizard-step" data-step="14">
                            @php
                            $term_financings = [['name' => 'Cash', 'target' => ''], ['name' => 'Conventional', 'target' => ''], ['name' => 'FHA', 'target' => ''], ['name' => 'VA', 'target' => ''], ['name' => 'USDA', 'target' => ''], ['name' => 'Assumable', 'target' => ''], ['name' => 'Exchange/Trade', 'target' => ''], ['name' => 'Lease Option', 'target' => ''], ['name' => 'Lease Purchase', 'target' => ''], ['name' => 'Private Financing Available', 'target' => ''], ['name' => 'Special Funding', 'target' => ''], ['name' => 'Seller Financing', 'target' => ''], ['name' => 'Jumbo', 'target' => ''], ['name' => 'Non-QM', 'target' => ''], ['name' => 'No-Doc', 'target' => ''], ['name' => 'Other', 'target' => '.custom_term_financings']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please indicate the financing/currency that the buyer will use
                                    to purchase the property:</label>
                                <select class="grid-picker" name="term_financings" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($term_financings as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_term_financings1';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_term_financings1 d-none">
                                <label class="fw-bold" for="custom_term_financings">Please indicate the
                                    financing/currency that the buyer will use to purchase the property:</label>
                                <input type="text" name="custom_term_financings" id="custom_term_financings" placeholder="Custom Term Financing" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Term Financing" required>
                            </div>
                        </div>
                        {{-- Slide 14 --}}
                        {{-- Slide 15 --}}
                        <div class="wizard-step" data-step="15">
                            <div class="form-group">
                                <label class="fw-bold">
                                    When will the buyer be ready to purchase a property?
                                </label>

                                {{-- <div class="form-group prompt_response" style="display: none;">
                                        <p class="text-danger">This is a service designed for buyers who are seeking to
                                            purchase a property within the next 3 months.</p>
                                    </div> --}}
                                @php
                                $timeframes = [['name' => 'ASAP', 'target' => ''], ['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '.custom_amount1']];
                                @endphp
                                <select class="grid-picker" name="buying_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($timeframes as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_amount12';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group custom_amount12 d-none">
                                <label class="fw-bold">When will the buyer be ready to purchase a property? </label>
                                <input type="text" class="form-control has-icon" name="custom_buyer_looking_to_purchase" data-icon="fa-regular fa-check-circle" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 15 --}}
                        {{-- Slide 16 --}}
                        <div class="wizard-step" data-step="16">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What is the buyer's preferred contract timeframe for working with the real estate agent?
                                </label>
                                @php
                                $buyer_prefered_timeframe = [['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '']];
                                @endphp
                                <select class="grid-picker" name="buyer_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($buyer_prefered_timeframe as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_buyer_prefered_timeframes';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_buyer_prefered_timeframes d-none">
                                <label class="fw-bold">What is the buyer's preferred contract timeframe for working with the real
                                    estate agent?</label>
                                <input type="text" class="form-control has-icon" placeholder="Enter buyer's preferred timeframe" name="buyer_prefered_timeframe" data-icon="fa-solid fa-qrcode" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 16 --}}
                        {{-- Slide 17 --}}
                        <div class="wizard-step" data-step="17">
                            <label class="fw-bold">
                                Please indicate the concession that the buyer wishes to receive, if any (up to .5%
                                of the agent's commission):
                            </label>
                            <div class="form-group col-md-3 mt-2">
                                <input type="number" name="concession" placeholder="0.00" id="concession" min="0" max=".5" step=".1" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="" required>
                            </div>
                            <small>(Available in all the states except: Alabama, Alaska, Iowa, Kansas, Louisiana,
                                Mississippi, Missouri, Oklahoma, Oregon, and Tennessee)</small>
                        </div>
                        {{-- Slide 17 --}}
                        {{-- Slide 18 --}}
                        <div class="wizard-step" data-step="18">
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
                            ['target' => '.custom_service_buyer_want', 'name' => 'Other- Add additional services as needed'],
                            ];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Select the services the buyer wants the hired agent to
                                    provide:</label>
                                <select class="grid-picker" name="services[]" onchange="service_data(this.value)" id="services" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($services_data as $service)
                                    @php
                                    if ($item['name'] == 'Other- Add additional services as needed') {
                                    $target = '.custom_service_buyer_want';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}" class="card flex-row" style="width:calc(100% - 0px);" data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                                        {{ $service['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  d-none" id="custom_service_buyer_want">
                                <label>Select the services the Buyer wants the hired agent to provide:</label>
                                <input type="text" name="other_services" id="other_services" class="form-control">
                            </div>
                        </div>
                        {{-- Slide 18 --}}
                        {{-- Slide 19 --}}
                        <div class="wizard-step" data-step="19">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What are the most important aspects you will consider when hiring a real estate
                                    agent?
                                </label>
                                <input type="text" name="aspect_hiring_agent" id="aspect_hiring_agent" class="form-control has-icon" data-icon="fa-solid fa-qrcode">
                            </div>

                            <div class=" form-group">
                                <label class="fw-bold">What additional details would the buyer like to share with the
                                    agent? </label>
                                <textarea name="additional_details" class="form-control" rows="5">{{ old('additional_details') }}</textarea>
                            </div>
                        </div>
                        {{-- Slide 19 --}}
                        {{-- Residential Slide End --}}
                        {{-- --}}

                        {{-- Income Slide Start --}}
                        {{-- Slide 7  --}}
                        <div class="wizard-step" data-step="20">
                            @php
                            $sale_provision = [['name' => 'Regular Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Pre-Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'New Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Assignment Contract (Wholesale properties)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Short Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">
                                    Please select the sale provisions in which the buyer is interested in purchasing:
                                </label>
                                <select class="grid-picker" name="sale_provision" onchange="change_sale_provision(this.value)" id="sale_provision" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($sale_provision as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.other_sale_provision1';
                                    } elseif ($item['name'] == 'Assignment Contract (Wholesale properties)') {
                                    $target = '.sale_provision_custom1';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row sale_provision_custom1 d-none">
                                <div class="form-group">
                                    <label class="fw-bold">Is the buyer currently under contract with a property they
                                        would like to assign?</label>
                                    <select class="grid-picker" name="financing_info" onchange="buyer_under_contract(this.value)" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group has_assignment d-none">
                                    <label class="fw-bold">What fee would the buyer pay the agent to assign the
                                        contract? $ % or</label>
                                    <input type="number" name="finder_fee" placeholder="0.00" id="concession" min="0.5" step=".01" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="Finder Fee" placeholder="% or $">
                                </div>
                                <div class="form-group has_no_assignment d-none">
                                    <label class="fw-bold">Is the buyer looking to take over another buyer's
                                        contract?</label>
                                    <select class="grid-picker" name="another_contract" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  d-none" id="other_sale_provision1">
                                <label class="fw-bold">Please select the sale provisions in which the buyer is
                                    interested in purchasing:</label>
                                <input type="text" name="custom_sale_provisions" id="custom_sale_provisions" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-qrcode" data-msg-required="Sale Provision" placeholder="Sale Provision">
                            </div>
                        </div>
                        {{-- Slide 7  --}}
                        {{-- Slide 8  --}}
                        <div class="wizard-step" data-step="21">
                            @php
                            $conditions_interested = [['name' => 'Not Updated: Requires a complete update.'], ['name' => 'Tear Down: Requires complete demolition and reconstruction.'], ['name' => 'Semi-updated, needs minor updates: Partially updated, but requires additional minor updates.'], ['name' => 'Move-in Ready, Completely Updated: Fully updated and ready for occupancy.'], ['name' => 'Open to any type of property condition.']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please select the property conditions in which the buyer is
                                    interested in purchasing:</label>
                                <select class="grid-picker" name="condition_interested[]" id="condition_interested" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($conditions_interested as $condition_interested)
                                    <option value="{{ $condition_interested['name'] }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $condition_interested['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Add Unit --}}
                            @php
                            $unit_types = [['name' => '1 Bed/1 Bath'], ['name' => '1 Bedroom'], ['name' => '2 Bed/1 Bath'], ['name' => '2 Bed/2 Bath'], ['name' => '2 Bedroom'], ['name' => '3 Bed/1 Bath'], ['name' => '3 Bed/2 Bath'], ['name' => '3 Bedroom'], ['name' => '4 Bedroom or More'], ['name' => '4+ Bed/1 Bath'], ['name' => '4+ Bed/2 Bath'], ['name' => 'Apartments'], ['name' => 'Efficiency'], ['name' => 'Loft'], ['name' => "Manager's Unit"]];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please select the property conditions in which the buyer is
                                    interested in purchasing:</label>
                                <select class="grid-picker" name="unit_types" id="condition_interested" required>
                                    <option value="">Select</option>
                                    @foreach ($unit_types as $unity_type)
                                    <option value="{{ $unity_type['name'] }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $unity_type['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 8  --}}
                        {{-- Slide 9  --}}
                        <div class="wizard-step" data-step="22">
                            @php
                            $financings_info = [['name' => 'Yes, pre-approved'], ['name' => 'Yes, cash buyer'], ['name' => 'No, I need a lender recommendation'], ['name' => 'No, I have my own lender I will apply with']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold"> Is the buyer pre-approved for a loan, or are they a cash
                                    buyer?</label>
                                <select class="grid-picker" name="are_they_been_pre_approved" id="are_they_been_pre_approved" required>
                                    <option value="">Select</option>
                                    @foreach ($financings_info as $financing_info)
                                    <option value="{{ $financing_info['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $financing_info['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 9  --}}
                        {{-- Slide 10  --}}
                        <div class="wizard-step" data-step="23">
                            @php
                            $term_financings = [['name' => 'Cash', 'target' => ''], ['name' => 'Conventional', 'target' => ''], ['name' => 'FHA', 'target' => ''], ['name' => 'VA', 'target' => ''], ['name' => 'USDA', 'target' => ''], ['name' => 'Assumable', 'target' => ''], ['name' => 'Exchange/Trade', 'target' => ''], ['name' => 'Lease Option', 'target' => ''], ['name' => 'Lease Purchase', 'target' => ''], ['name' => 'Private Financing Available', 'target' => ''], ['name' => 'Special Funding', 'target' => ''], ['name' => 'Seller Financing', 'target' => ''], ['name' => 'Jumbo', 'target' => ''], ['name' => 'Non-QM', 'target' => ''], ['name' => 'No-Doc', 'target' => ''], ['name' => 'Other', 'target' => '.custom_term_financings']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please indicate the financing/currency that the buyer will use
                                    to purchase the property:</label>
                                <select class="grid-picker" name="term_financings" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($term_financings as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_term_financings_income_property';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_term_financings_income_property d-none">
                                <label class="fw-bold" for="custom_term_financings">Please indicate the
                                    financing/currency that the buyer will use to purchase the property:</label>
                                <input type="text" name="custom_term_financings" id="custom_term_financings" placeholder="Custom Term Financing" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Term Financing" required>
                            </div>
                        </div>
                        {{-- Slide 10 --}}
                        {{-- Slide 11 --}}
                        <div class="wizard-step" data-step="24">
                            <div class="form-group">
                                <label class="fw-bold">
                                    When will the buyer be ready to purchase a property?
                                </label>
                                @php
                                $timeframes = [['name' => 'ASAP', 'target' => ''], ['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '.custom_amount1']];
                                @endphp
                                <select class="grid-picker" name="buying_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($timeframes as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_amount_income_property';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group custom_amount_income_property d-none">
                                <label class="fw-bold">When will the buyer be ready to purchase a property? </label>
                                <input type="text" class="form-control has-icon" name="custom_buyer_looking_to_purchase" data-icon="fa-regular fa-check-circle" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 11 --}}
                        {{-- Slide 12 --}}
                        <div class="wizard-step" data-step="25">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What is the buyer's preferred contract timeframe for working with the real estate
                                    agent?
                                </label>
                                @php
                                $buyer_prefered_timeframe = [['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '']];
                                @endphp
                                <select class="grid-picker" name="buyer_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($buyer_prefered_timeframe as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_buyer_prefered_timeframes_income';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_buyer_prefered_timeframes_income d-none">
                                <label class="fw-bold">What is the buyer's preferred timeframe for working with the
                                    real estate agent?</label>
                                <input type="text" class="form-control has-icon" placeholder="Enter buyer's preferred timeframe" name="buyer_prefered_timeframe" data-icon="fa-solid fa-qrcode" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 12 --}}
                        {{-- Slide 13 --}}
                        <div class="wizard-step" data-step="26">
                            <label class="fw-bold">
                                Please indicate the concession that the buyer wishes to receive, if any (up to .5%
                                of the agent's commission):
                            </label>
                            <div class="form-group col-md-3 mt-2">
                                <input type="number" name="concession" placeholder="0.00" id="concession" min="0" max=".5" step=".1" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="" required>
                            </div>
                            <small>(Available in all the states except: Alabama, Alaska, Iowa, Kansas, Louisiana,
                                Mississippi, Missouri, Oklahoma, Oregon, and Tennessee)</small>
                        </div>
                        {{-- Slide 13 --}}
                        {{-- Slide 14 --}}
                        <div class="wizard-step" data-step="27">

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
                            ['target' => '', 'name' => 'Other- Add additional services as needed'],
                            ];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Select the services the buyer wants the hired agent to
                                    provide:</label>
                                <select class="grid-picker" name="services[]" onchange="service_data(this.value)" id="services" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($services_data as $service)
                                    @php
                                    if ($item['name'] == 'Other- Add additional services as needed') {
                                    $target = '.custom_service_buyer_want_income';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}" class="card flex-row" style="width:calc(100% - 0px);" data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                                        {{ $service['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  d-none" id="custom_service_buyer_want_income">
                                <label>Select the services the Buyer wants the hired agent to provide:</label>
                                <input type="text" name="other_services" id="other_services" class="form-control">
                            </div>
                        </div>
                        {{-- Slide 14 --}}
                        {{-- Slide 15 --}}
                        <div class="wizard-step" data-step="28">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What are the most important aspects you will consider when hiring a real estate
                                    agent?
                                </label>
                                <input type="text" name="aspect_hiring_agent" placeholder="5000" id="aspect_hiring_agent" class="form-control has-icon search_places" data-icon="fa-solid fa-qrcode">
                            </div>

                            <div class=" form-group">
                                <label class="fw-bold">What additional details would the buyer like to share with the
                                    agent? </label>
                                <textarea name="additional_details" class="form-control" rows="5">{{ old('additional_details') }}</textarea>
                            </div>
                        </div>
                        {{-- Slide 15 --}}
                        {{-- Income Slide End --}}

                        {{-- Commercial and Business Opportunity Slide Start --}}
                        {{-- Slide 7  --}}
                        <div class="wizard-step" data-step="29">
                            @php
                            $sale_provision = [['name' => 'Regular Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Pre-Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'New Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Assignment Contract (Wholesale properties)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Short Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">
                                    Please select the sale provisions in which the buyer is interested in purchasing:
                                </label>
                                <select class="grid-picker" name="sale_provision" onchange="change_sale_provision(this.value)" id="sale_provision" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($sale_provision as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.other_sale_provision1';
                                    } elseif ($item['name'] == 'Assignment Contract (Wholesale properties)') {
                                    $target = '.sale_provision_custom_commercial_and_business';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row sale_provision_custom_commercial_and_business d-none">
                                <div class="form-group">
                                    <label class="fw-bold">Is the buyer currently under contract with a property they
                                        would like to assign?</label>
                                    <select class="grid-picker" name="financing_info" onchange="buyer_under_contract(this.value)" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group has_assignment d-none">
                                    <label class="fw-bold">What fee would the buyer pay the agent to assign the
                                        contract? $ % or</label>
                                    <input type="number" name="finder_fee" placeholder="0.00" id="concession" min="0.5" step=".01" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="Finder Fee" placeholder="% or $">
                                </div>
                                <div class="form-group has_no_assignment d-none">
                                    <label class="fw-bold">Is the buyer looking to take over another buyer's
                                        contract?</label>
                                    <select class="grid-picker" name="another_contract" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  d-none" id="other_sale_provision_commercial_and_business">
                                <label class="fw-bold">Please select the sale provisions in which the buyer is
                                    interested in purchasing:</label>
                                <input type="text" name="custom_sale_provisions" id="custom_sale_provisions" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-qrcode" data-msg-required="Sale Provision" placeholder="Sale Provision">
                            </div>
                        </div>
                        {{-- Slide 7  --}}
                        {{-- Slide 8  --}}
                        <div class="wizard-step" data-step="30">
                            @php
                            $conditions_interested = [['name' => 'Not Updated: Requires a complete update.'], ['name' => 'Tear Down: Requires complete demolition and reconstruction.'], ['name' => 'Semi-updated, needs minor updates: Partially updated, but requires additional minor updates.'], ['name' => 'Move-in Ready, Completely Updated: Fully updated and ready for occupancy.'], ['name' => 'Open to any type of property condition.']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please select the property conditions in which the buyer is
                                    interested in purchasing:</label>
                                <select class="grid-picker" name="condition_interested[]" id="condition_interested" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($conditions_interested as $condition_interested)
                                    <option value="{{ $condition_interested['name'] }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $condition_interested['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 8  --}}
                        {{-- Slide 9  --}}
                        @php
                        $bathrooms = [['name' => '1', 'target' => ''], ['name' => '1.5+', 'target' => ''], ['name' => '2+', 'target' => ''], ['name' => '2.5+', 'target' => ''], ['name' => '3+', 'target' => ''], ['name' => '3.5+', 'target' => ''], ['name' => '4+', 'target' => ''], ['name' => '4.5+', 'target' => ''], ['name' => '5+', 'target' => ''], ['name' => '6+', 'target' => ''], ['name' => '7+', 'target' => ''], ['name' => '8+', 'target' => ''], ['name' => '9+', 'target' => ''], ['name' => '10+', 'target' => ''], ['name' => 'Other', 'target' => '.other_bathrooms12']];
                        @endphp
                        <div class="wizard-step" data-step="31">
                            <div class="form-group">
                                <label class="fw-bold">How many bathrooms does the buyer require?</label>
                                <select class="grid-picker" name="bathrooms" id="bathrooms" style="justify-content: center;" required>
                                    <option value="">Select</option>
                                    @foreach ($bathrooms as $bathroom)
                                    <option value="{{ $bathroom['name'] }}" data-target="{{ $bathroom['target'] }}" class="card flex-column" style="width:calc(20% - 10px);" data-icon='<i class="fa-solid fa-bath"></i>'>
                                        {{ $bathroom['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group other_bathrooms12 d-none">
                                <label class="fw-bold" for="other_bathrooms">Bathrooms:</label>
                                <input type="text" name="other_bathrooms" id="other_bathrooms" placeholder="Custom Bathrooms" class="form-control has-icon" data-icon="fa-solid fa-bath" data-msg-required="Please enter Custom Bathrooms" required>
                            </div>
                        </div>
                        {{-- Slide 9  --}}
                        {{-- Slide 10  --}}
                        <div class="wizard-step" data-step="32">
                            <div class="form-group">
                                <label class="fw-bold" for="heated_sqft">What is the minimum heated square footage
                                    required?</label>
                                <input type="number" name="minimum_heated_sqft" placeholder=" Minimum Heated sqft" id="minimum_heated_sqft" class="form-control has-icon hide_arrow" data-icon="fa-solid fa-ruler-combined" data-msg-required="Please enter Heated sqft">
                            </div>
                        </div>
                        {{-- Slide 10 --}}
                        {{-- Slide 11 --}}
                        <div class="wizard-step" data-step="33">
                            @php
                            $purchase_of_business = [['name' => 'Real Estate Building and Business', 'target' => ''], ['name' => 'Business Only ', 'target' => '']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Is the purchase of the business required to include the real
                                    estate building itself, or is it solely for the business? </label>
                                <select class="grid-picker" name="purchase_of_business" id="purchase_of_business" style="justify-content: center;" required>
                                    <option value="">Select</option>
                                    @foreach ($purchase_of_business as $item)
                                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-column" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 11 --}}
                        {{-- Slide 12 --}}
                        <div class="wizard-step" data-step="34">
                            <div class="form-group">
                                <label class="fw-bold">Are there any non-negotiable amenities or property features that
                                    the buyer is seeking?</label>
                                <select class="grid-picker" name="has_non_negotiable_amenities" id="has_non_negotiable_amenities" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($yes_or_nos as $item)
                                    @php
                                    if ($item['name'] == 'Yes') {
                                    $target = '.custom_non_negotiable_term_commercial_and_business';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                            $non_negotiable_terms = [
                            ['name' => 'Garage', 'target' => ''],
                            ['name' => 'Carport', 'target' => ''],
                            ['name' => 'Pool', 'target' => ''],
                            ['name' => 'Waterfront', 'target' => ''],
                            ['name' => 'In-Unit Laundry', 'target' => ''],
                            ['name' => 'On-site Laundry', 'target' => ''],
                            ['name' => 'Washer and Dryer Hookup', 'target' => ''],
                            ['name' => 'Washer and Dryer', 'target' => ''],
                            ['name' => 'Covered Carport', 'target' => ''],
                            ['name' => 'First Floor Unit', 'target' => ''],
                            ['name' => 'Elevator', 'target' => ''],
                            ['name' => 'Pet Friendly', 'target' => ''],
                            ['name' => 'Balcony/Patio', 'target' => ''],
                            ['name' => 'Fitness Center/Gym', 'target' => ''],
                            ['name' => 'Central Heating', 'target' => ''],
                            ['name' => 'Central Air Conditioning', 'target' => ''],
                            ['name' => 'Fireplace', 'target' => ''],
                            ['name' => 'Walk-in Closet', 'target' => ''],
                            ['name' => 'Hardwood Floors', 'target' => ''],
                            ['name' => 'Tile Floors', 'target' => ''],
                            ['name' => 'Carpet Floors', 'target' => ''],
                            ['name' => 'Security System', 'target' => ''],
                            ['name' => 'Gated Community', 'target' => ''],
                            ['name' => 'HOA Community', 'target' => ''],
                            ['name' => '55 and Over Community', 'target' => ''],
                            ['name' => 'Specific School District', 'target' => ''],
                            ['name' => 'Accessibility Features', 'target' => ''],
                            ['name' => 'On-site Maintenance', 'target' => ''],
                            ['name' => 'On-site Management', 'target' => ''],
                            ['name' => 'Outdoor Space', 'target' => ''],
                            ['name' => 'Playground', 'target' => ''],
                            ['name' => 'Clubhouse', 'target' => ''],
                            ['name' => 'Storage Space', 'target' => ''],
                            ['name' => 'Study/Den/Office', 'target' => ''],
                            ['name' => 'Updated Kitchen', 'target' => ''],
                            ['name' => 'Updated Bathroom', 'target' => ''],
                            ['name' => 'Other', 'target' => '.custom_non_negotiable_terms_other'],
                            ];
                            @endphp

                            <div class="form-group custom_non_negotiable_term_commercial_and_business d-none">
                                <select class="grid-picker" name="non_negotiable_terms" id="utilities" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($non_negotiable_terms as $item)
                                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" data-icon="<i class='fa-regular fa-circle-check'></i>" class="card flex-row" style="width:calc(33.3% - 10px);">
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_non_negotiable_terms_other d-none">
                                <label class="fw-bold" for="custom_non_negotiable_terms">Are there any non-negotiable
                                    amenities or property features that the buyer is seeking?</label>
                                <input type="text" name="custom_non_negotiable_terms" id="custom_non_negotiable_terms" placeholder="Custom Non-Negotiable Terms" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Non-Negotiable Terms" required>
                            </div>
                        </div>
                        {{-- Slide 12 --}}
                        {{-- Slide 13 --}}
                        <div class="wizard-step" data-step="35">
                            @php
                            $financings_info = [['name' => 'Yes, pre-approved'], ['name' => 'Yes, cash buyer'], ['name' => 'No, I need a lender recommendation'], ['name' => 'No, I have my own lender I will apply with']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold"> Is the buyer pre-approved for a loan, or are they a cash
                                    buyer?</label>
                                <select class="grid-picker" name="are_they_been_pre_approved" id="are_they_been_pre_approved" required>
                                    <option value="">Select</option>
                                    @foreach ($financings_info as $financing_info)
                                    <option value="{{ $financing_info['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $financing_info['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 13 --}}
                        {{-- Slide 14 --}}
                        <div class="wizard-step" data-step="36">
                            <div class="form-group">
                                <label class="fw-bold">
                                    At what price point is the buyer interested in making a purchase?

                                </label>
                                @php
                                $buyer_budgets = [['name' => '100k or less'], ['name' => '100k-200k'], ['name' => '200k-300k'], ['name' => '300k-400k'], ['name' => '400k-500k'], ['name' => '500k-600k'], ['name' => '600k-700k'], ['name' => '700k-800k'], ['name' => '800-900k'], ['name' => '900k-1 million'], ['name' => '1 million +'], ['name' => '2 million +'], ['name' => '3 million +'], ['name' => '4 million +'], ['name' => '5 million +'], ['name' => '10 million +']];
                                @endphp
                                <select name="buyer_budget" id="buyer_budget" class="grid-picker" style="justify-content: flex-start;" required>
                                    <option value=""></option>
                                    @foreach ($buyer_budgets as $pt)
                                    <option value="{{ $pt['name'] }}" data-target="" class="card flex-column" style="width:calc(20% - 10px);" data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;"></i>'>
                                        {{ $pt['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                            $term_financings = [['name' => 'Cash', 'target' => ''], ['name' => 'Conventional', 'target' => ''], ['name' => 'FHA', 'target' => ''], ['name' => 'VA', 'target' => ''], ['name' => 'USDA', 'target' => ''], ['name' => 'Assumable', 'target' => ''], ['name' => 'Exchange/Trade', 'target' => ''], ['name' => 'Lease Option', 'target' => ''], ['name' => 'Lease Purchase', 'target' => ''], ['name' => 'Private Financing Available', 'target' => ''], ['name' => 'Special Funding', 'target' => ''], ['name' => 'Seller Financing', 'target' => ''], ['name' => 'Jumbo', 'target' => ''], ['name' => 'Non-QM', 'target' => ''], ['name' => 'No-Doc', 'target' => ''], ['name' => 'Other', 'target' => '.custom_term_financings']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please indicate the financing/currency that the buyer will use
                                    to purchase the property:</label>
                                <select class="grid-picker" name="term_financings" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($term_financings as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_term_financings_commercial_and_business';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_term_financings_commercial_and_business d-none">
                                <label class="fw-bold" for="custom_term_financings">Please indicate the
                                    financing/currency that the buyer will use to purchase the property:</label>
                                <input type="text" name="custom_term_financings" id="custom_term_financings" placeholder="Custom Term Financing" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Term Financing" required>
                            </div>
                        </div>
                        {{-- Slide 14 --}}
                        {{-- Slide 15 --}}
                        <div class="wizard-step" data-step="37">
                            <div class="form-group">
                                <label class="fw-bold">
                                    When will the buyer be ready to purchase a property?
                                </label>
                                @php
                                $timeframes = [['name' => 'ASAP', 'target' => ''], ['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '.custom_amount1']];
                                @endphp
                                <select class="grid-picker" name="buying_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($timeframes as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_amount_commercial_and_business';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group custom_amount_commercial_and_business d-none">
                                <label class="fw-bold">When will the buyer be ready to purchase a property? </label>
                                <input type="text" class="form-control has-icon" name="custom_buyer_looking_to_purchase" data-icon="fa-regular fa-check-circle" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 15 --}}
                        {{-- Slide 16 --}}
                        <div class="wizard-step" data-step="38">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What is the buyer's preferred contract timeframe for working with the real estate
                                    agent?
                                </label>
                                @php
                                $buyer_prefered_timeframe = [['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '']];
                                @endphp
                                <select class="grid-picker" name="buyer_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($buyer_prefered_timeframe as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_buyer_prefered_timeframes_income';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_buyer_prefered_timeframes_income d-none">
                                <label class="fw-bold">What is the buyer's preferred timeframe for working with the
                                    real estate agent?</label>
                                <input type="text" class="form-control has-icon" placeholder="Enter buyer's preferred timeframe" name="buyer_prefered_timeframe" data-icon="fa-solid fa-qrcode" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 16 --}}
                        {{-- Slide 17 --}}
                        <div class="wizard-step" data-step="39">
                            <label class="fw-bold">
                                Please indicate the concession that the buyer wishes to receive, if any (up to .5%
                                of the agent's commission):
                            </label>
                            <div class="form-group col-md-3 mt-2">
                                <input type="number" name="concession" placeholder="0.00" id="concession" min="0" max=".5" step=".1" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="" required>
                            </div>
                            <small>(Available in all the states except: Alabama, Alaska, Iowa, Kansas, Louisiana,
                                Mississippi, Missouri, Oklahoma, Oregon, and Tennessee)</small>
                        </div>
                        {{-- Slide 17 --}}
                        {{-- Slide 18 --}}
                        <div class="wizard-step" data-step="40">
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
                            ['target' => '', 'name' => 'Other- Add additional services as needed'],
                            ];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Select the services the buyer wants the hired agent to
                                    provide:</label>
                                <select class="grid-picker" name="services[]" onchange="service_data(this.value)" id="services" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($services_data as $service)
                                    @php
                                    if ($item['name'] == 'Other- Add additional services as needed') {
                                    $target = '.custom_service_buyer_want_commercial_and_business';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}" class="card flex-row" style="width:calc(100% - 0px);" data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                                        {{ $service['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  d-none" id="custom_service_buyer_want_commercial_and_business">
                                <label>Select the services the Buyer wants the hired agent to provide:</label>
                                <input type="text" name="other_services" id="other_services" class="form-control">
                            </div>
                        </div>
                        {{-- Slide 18 --}}
                        {{-- Slide 19 --}}
                        <div class="wizard-step" data-step="41">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What are the most important aspects you will consider when hiring a real estate
                                    agent?
                                </label>
                                <input type="text" name="aspect_hiring_agent" id="aspect_hiring_agent" class="form-control has-icon search_places" data-icon="fa-solid fa-qrcode">
                            </div>

                            <div class=" form-group">
                                <label class="fw-bold">What additional details would the buyer like to share with the
                                    agent? </label>
                                <textarea name="additional_details" class="form-control" rows="5">{{ old('additional_details') }}</textarea>
                            </div>
                        </div>
                        {{-- Slide 19 --}}
                        {{-- Commercial and Business Opportunity Slide End --}}

                        {{-- Vacant Land Start --}}
                        {{-- Slide 7  --}}
                        <div class="wizard-step" data-step="42">
                            @php
                            $sale_provision = [['name' => 'Regular Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Pre-Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'New Construction', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Assignment Contract (Wholesale properties)', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Short Sale', 'target' => '', 'icon' => 'fa-regular fa-circle-check'], ['name' => 'Other', 'target' => '', 'icon' => 'fa-regular fa-circle-check']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">
                                    Please select the sale provisions in which the buyer is interested in purchasing:
                                </label>
                                <select class="grid-picker" name="sale_provision" onchange="change_sale_provision(this.value)" id="sale_provision" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($sale_provision as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.other_sale_provision1';
                                    } elseif ($item['name'] == 'Assignment Contract (Wholesale properties)') {
                                    $target = '.sale_provision_vacant_land';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(50% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row sale_provision_vacant_land d-none">
                                <div class="form-group">
                                    <label class="fw-bold">Is the buyer currently under contract with a property they
                                        would like to assign?</label>
                                    <select class="grid-picker" name="financing_info" onchange="buyer_under_contract(this.value)" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group has_assignment d-none">
                                    <label class="fw-bold">What fee would the buyer pay the agent to assign the
                                        contract? $ % or</label>
                                    <input type="number" name="finder_fee" placeholder="0.00" id="concession" min="0.5" step=".01" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="Finder Fee" placeholder="% or $">
                                </div>
                                <div class="form-group has_no_assignment d-none">
                                    <label class="fw-bold">Is the buyer looking to take over another buyer's
                                        contract?</label>
                                    <select class="grid-picker" name="another_contract" id="financing_info" required>
                                        <option value="">Select</option>
                                        @foreach ($yes_or_nos as $item)
                                        <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                            {{ $item['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  d-none" id="other_sale_provision_vacant_land">
                                <label class="fw-bold">Please select the sale provisions in which the buyer is
                                    interested in purchasing:</label>
                                <input type="text" name="custom_sale_provisions" id="custom_sale_provisions" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-qrcode" data-msg-required="Sale Provision" placeholder="Sale Provision">
                            </div>
                        </div>
                        {{-- Slide 7  --}}
                        {{-- Slide 8  --}}
                        <div class="wizard-step" data-step="43">
                            <div class="form-group">
                                <label class="fw-bold" for="heated_sqft">What is the minimum heated square footage
                                    required?</label>
                                <input type="number" name="minimum_heated_sqft" placeholder=" Minimum Heated sqft" id="minimum_heated_sqft" class="form-control has-icon hide_arrow" data-icon="fa-solid fa-ruler-combined" data-msg-required="Please enter Heated sqft">
                            </div>
                        </div>
                        {{-- Slide 8  --}}
                        {{-- Slide 9  --}}
                        <div class="wizard-step" data-step="44">
                            @php
                            $financings_info = [['name' => 'Yes, pre-approved'], ['name' => 'Yes, cash buyer'], ['name' => 'No, I need a lender recommendation'], ['name' => 'No, I have my own lender I will apply with']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold"> Is the buyer pre-approved for a loan, or are they a cash
                                    buyer?</label>
                                <select class="grid-picker" name="are_they_been_pre_approved" id="are_they_been_pre_approved" required>
                                    <option value="">Select</option>
                                    @foreach ($financings_info as $financing_info)
                                    <option value="{{ $financing_info['name'] }}" data-target="{{ $target }}" class="card flex-column" style="width:calc(33.33% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $financing_info['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 9  --}}
                        {{-- Slide 10  --}}
                        <div class="wizard-step" data-step="45">
                            <div class="form-group">
                                <label class="fw-bold">
                                    At what price point is the buyer interested in making a purchase?

                                </label>
                                @php
                                $buyer_budgets = [['name' => '100k or less'], ['name' => '100k-200k'], ['name' => '200k-300k'], ['name' => '300k-400k'], ['name' => '400k-500k'], ['name' => '500k-600k'], ['name' => '600k-700k'], ['name' => '700k-800k'], ['name' => '800-900k'], ['name' => '900k-1 million'], ['name' => '1 million +'], ['name' => '2 million +'], ['name' => '3 million +'], ['name' => '4 million +'], ['name' => '5 million +'], ['name' => '10 million +']];
                                @endphp
                                <select name="buyer_budget" id="buyer_budget" class="grid-picker" style="justify-content: flex-start;" required>
                                    <option value=""></option>
                                    @foreach ($buyer_budgets as $pt)
                                    <option value="{{ $pt['name'] }}" data-target="" class="card flex-column" style="width:calc(20% - 10px);" data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;"></i>'>
                                        {{ $pt['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Slide 10 --}}
                        {{-- Slide 11 --}}
                        <div class="wizard-step" data-step="46">
                            @php
                            $term_financings = [['name' => 'Cash', 'target' => ''], ['name' => 'Conventional', 'target' => ''], ['name' => 'FHA', 'target' => ''], ['name' => 'VA', 'target' => ''], ['name' => 'USDA', 'target' => ''], ['name' => 'Assumable', 'target' => ''], ['name' => 'Exchange/Trade', 'target' => ''], ['name' => 'Lease Option', 'target' => ''], ['name' => 'Lease Purchase', 'target' => ''], ['name' => 'Private Financing Available', 'target' => ''], ['name' => 'Special Funding', 'target' => ''], ['name' => 'Seller Financing', 'target' => ''], ['name' => 'Jumbo', 'target' => ''], ['name' => 'Non-QM', 'target' => ''], ['name' => 'No-Doc', 'target' => ''], ['name' => 'Other', 'target' => '.custom_term_financings']];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Please indicate the financing/currency that the buyer will use
                                    to purchase the property:</label>
                                <select class="grid-picker" name="term_financings" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($term_financings as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_term_financings_vacant_land';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_term_financings_vacant_land d-none">
                                <label class="fw-bold" for="custom_term_financings">Please indicate the
                                    financing/currency that the buyer will use to purchase the property:</label>
                                <input type="text" name="custom_term_financings" id="custom_term_financings" placeholder="Custom Term Financing" class="form-control has-icon" data-icon="fa-solid fa-qrcode" data-msg-required="Please enter Custom Term Financing" required>
                            </div>
                        </div>
                        {{-- Slide 11 --}}
                        {{-- Slide 12 --}}
                        <div class="wizard-step" data-step="47">
                            <div class="form-group">
                                <label class="fw-bold">
                                    When will the buyer be ready to purchase a property?
                                </label>
                                @php
                                $timeframes = [['name' => 'ASAP', 'target' => ''], ['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '.custom_amount1']];
                                @endphp
                                <select class="grid-picker" name="buying_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($timeframes as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_amount_vacant_land';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group custom_amount_vacant_land d-none">
                                <label class="fw-bold">When will the buyer be ready to purchase a property? </label>
                                <input type="text" class="form-control has-icon" name="custom_buyer_looking_to_purchase" data-icon="fa-regular fa-check-circle" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 12 --}}
                        {{-- Slide 13 --}}
                        <div class="wizard-step" data-step="48">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What is the buyer's preferred contract timeframe for working with the real estate
                                    agent?
                                </label>
                                @php
                                $buyer_prefered_timeframe = [['name' => '1 month', 'target' => ''], ['name' => '2 months', 'target' => ''], ['name' => '3 months', 'target' => ''], ['name' => '4 months', 'target' => ''], ['name' => '5 months', 'target' => ''], ['name' => '6 months', 'target' => ''], ['name' => 'Over 6 months', 'target' => ''], ['name' => 'Not looking to purchase', 'target' => ''], ['name' => 'Other', 'target' => '']];
                                @endphp
                                <select class="grid-picker" name="buyer_timeframe" id="term_financings" style="justify-content: flex-start;" required>
                                    <option value="">Select</option>
                                    @foreach ($buyer_prefered_timeframe as $item)
                                    @php
                                    if ($item['name'] == 'Other') {
                                    $target = '.custom_buyer_prefered_timeframes_vacant_land';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row" style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-check-circle"></i>'>
                                        {{ $item['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group custom_buyer_prefered_timeframes_vacant_land d-none">
                                <label class="fw-bold">What is the buyer's preferred timeframe for working with the
                                    real estate agent?</label>
                                <input type="text" class="form-control has-icon" placeholder="Enter buyer's preferred timeframe" name="buyer_prefered_timeframe" data-icon="fa-solid fa-qrcode" id="custom_amount" required />
                            </div>
                        </div>
                        {{-- Slide 13 --}}
                        {{-- Slide 14 --}}
                        <div class="wizard-step" data-step="49">
                            <label class="fw-bold">
                                Please indicate the concession that the buyer wishes to receive, if any (up to .5%
                                of the agent's commission):
                            </label>
                            <div class="form-group col-md-3 mt-2">
                                <input type="number" name="concession" placeholder="0.00" id="concession" min="0" max=".5" step=".1" class="form-control has-icon search_places col-3" data-icon="fa-solid fa-percent" data-msg-required="" required>
                            </div>
                            <small>(Available in all the states except: Alabama, Alaska, Iowa, Kansas, Louisiana,
                                Mississippi, Missouri, Oklahoma, Oregon, and Tennessee)</small>
                        </div>
                        {{-- Slide 14 --}}
                        {{-- Slide 15 --}}
                        <div class="wizard-step" data-step="50">
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
                            ['target' => '', 'name' => 'Other- Add additional services as needed'],
                            ];
                            @endphp
                            <div class="form-group">
                                <label class="fw-bold">Select the services the buyer wants the hired agent to
                                    provide:</label>
                                <select class="grid-picker" name="services[]" onchange="service_data(this.value)" id="services" multiple required>
                                    <option value="">Select</option>
                                    @foreach ($services_data as $service)
                                    @php
                                    if ($item['name'] == 'Other- Add additional services as needed') {
                                    $target = '.custom_service_buyer_want_vacant';
                                    } else {
                                    $target = '';
                                    }
                                    @endphp
                                    <option value="{{ $service['name'] }}" data-target="{{ $service['target'] }}" class="card flex-row" style="width:calc(100% - 0px);" data-icon='<i class="fa-solid fa-hand-point-right"></i>'>
                                        {{ $service['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  d-none" id="custom_service_buyer_want_vacant">
                                <label>Select the services the Buyer wants the hired agent to provide:</label>
                                <input type="text" name="other_services" id="other_services" class="form-control">
                            </div>
                        </div>
                        {{-- Slide 15 --}}
                        {{-- Slide 16 --}}
                        <div class="wizard-step" data-step="51">
                            <div class="form-group">
                                <label class="fw-bold">
                                    What are the most important aspects you will consider when hiring a real estate
                                    agent?
                                </label>
                                <input type="text" name="aspect_hiring_agent" id="aspect_hiring_agent" class="form-control has-icon search_places" data-icon="fa-solid fa-qrcode">
                            </div>

                            <div class=" form-group">
                                <label class="fw-bold">What additional details would the buyer like to share with the
                                    agent? </label>
                                <textarea name="additional_details" class="form-control" rows="5">{{ old('additional_details') }}</textarea>
                            </div>
                        </div>
                        {{-- Slide 16 --}}
                        {{-- Vacant Land End --}}
                        <div class="d-flex justify-content-between form-group " style="margin-top:78px;">
                            <div>
                                <a class="wizard-step-back btn btn-success btn-lg text-600" style="display: none;">Back</a>
                            </div>
                            <div>
                                <button type="button" class="wizard-step-next btn btn-success btn-lg text-600" style="display: none;">Next</button>
                                <button type="button" class="wizard-step-finish btn btn-success btn-lg text-600" style="display: none;">Save</button>
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
                    <input type="text" name="counties[]" id="counties" class="form-control search_places " placeholder="Search Country..." data-msg-required="Please enter county" required>
                    <div class="dropdown" style="width: 200px;
                                            position: absolute;
                                            left: 50px;
                                            top: 149px;">

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="countryDropdownButton" id="countryDropdown">
                            <!-- Dropdown options will be populated dynamically -->
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <label for="">State</label>
                    <input type="text" id="read_only_state" class="form-control search_places " placeholder="Search state..." data-msg-required="Please enter state....." readonly>
                    <div id="dynamic_row" class="dynamic_row">
                    </div>
                </div>
                <div class="col-4">
                    <label for="">Cities</label>

                    <div class="input-group readonly_city" id="read_only_city">
                        <input type="text" class="form-control search_places " placeholder="Search city..." data-msg-required="Please enter city....." readonly>
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

<template class="city_temp">
    <tr>
        <td><input type="text" name="cities[]" placeholder="City" data-type="cities" class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city" data-msg-required="Please enter city"></td>
    </tr>
</template>

<template class="state_temp">
    <tr>
        <td><input type="text" name="states[]" placeholder="State" data-type="states" class="form-control has-icon search_places" data-icon="fa-solid fa-tree-city" data-msg-required="Please enter state"></td>
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

    /* function add_state_row() {
        var state_row = $('.state_temp').html();
        $('.state_btn_row').before(state_row);
        initialize();
    } */
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
    // document.getElementById('auction_type').change();
    $(function() {
        changeAuctionType("Auction (Timer)");
    });
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
            $('.for_residential_only').removeClass('d-none');
            $('.residential_hide').removeClass('d-none');
            $('.business-length').hide();

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

        } else if (p == "Vacant Land (Current Use)") {
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

        } else if (p == "Business Opportunity (Business Type)") {
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
        console.log(v);
        check_custom();
    }

    function check_custom() {
        $('.option-container').each(function(i, elm) {
            var target = $(elm).data('target') || "";
            var is_active = $(elm).hasClass('active');
            if (target != "") {
                console.log("is_active", is_active, target);
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
                            StepWizard.nextStep = 20;
                            StepWizard.backStep = 6;
                        } else if (StepWizard.currentStep == 6 && property_type ==
                            'Residential Property') {
                            StepWizard.nextStep = 7;
                            StepWizard.backStep = 6;
                        } else if (StepWizard.currentStep == 32 && property_type ==
                            'Commercial Property') {
                            StepWizard.nextStep = 34;
                            StepWizard.backStep = 32;
                        } else if (StepWizard.currentStep == 6 && (property_type ==
                                'Commercial Property' || property_type ==
                                'Business Opportunity (Business Type)')

                        ) {
                            StepWizard.nextStep = 29;
                            StepWizard.backStep = 6;

                        } else if (StepWizard.currentStep == 6 && property_type ==
                            'Vacant Land (Current Use)'

                        ) {
                            StepWizard.nextStep = 42;
                            StepWizard.backStep = 6;
                        } else {
                            StepWizard.backStep = StepWizard.currentStep;
                        }
                        $('[ data-step="' + StepWizard.nextStep + '"]').addClass("active");
                        StepWizard.setStep();
                        if (
                            StepWizard.currentStep == 19 &&
                            property_type == 'Residential Property'
                        ) {
                            $('.wizard-step-next').hide();
                            $('.wizard-step-finish').show();
                        }
                        if (
                            StepWizard.currentStep == 28 &&
                            property_type == 'Income Property'
                        ) {
                            $('.wizard-step-next').hide();
                            $('.wizard-step-finish').show();
                        }
                        if (
                            StepWizard.currentStep == 41 &&
                            (property_type == 'Commercial Property' || property_type ==
                                'Business Opportunity (Business Type)')
                        ) {
                            $('.wizard-step-next').hide();
                            $('.wizard-step-finish').show();
                        }
                        if (
                            StepWizard.currentStep == 51 &&
                            property_type == 'Vacant Land (Current Use)'
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
                    if (StepWizard.currentStep == 20 && property_type ==
                        'Income Property') {

                        StepWizard.backStep = 6;
                    } else if (StepWizard.currentStep == 34 && property_type ==
                        'Commercial Property') {
                        StepWizard.backStep = 32;
                    } else if (StepWizard.currentStep == 7 && property_type ==
                        'Residential Property') {

                        StepWizard.backStep = 6;
                    } else if (StepWizard.currentStep == 29 && (property_type ==
                            'Commercial Property' || property_type ==
                            'Business Opportunity (Business Type)')

                    ) {

                        StepWizard.backStep = 6;

                    } else if (StepWizard.currentStep == 42 && property_type ==
                        'Vacant Land (Current Use)'

                    ) {

                        StepWizard.backStep = 6;
                    } else {
                        StepWizard.backStep = StepWizard.currentStep - 1;
                    }
                }
            });
            // Assuming the code provided is within a function or a document.ready block

            $('.wizard-step-finish').click(function(e) {
                if (property_type === 'Residential Property') {
                    var $stepsToRemove = $('.wizard-step[data-step]').filter(function() {
                        return parseInt($(this).attr('data-step')) >= 20 && parseInt($(this)
                            .attr('data-step')) <= 51;
                    });
                    $stepsToRemove.each(function() {
                        $(this).closest('div[data-step]').remove();
                    });
                }
                if (property_type === 'Income Property') {
                    var $stepsToRemove = $('.wizard-step[data-step]').filter(function() {
                        var stepValue = parseInt($(this).attr('data-step'));
                        return (stepValue >= 7 && stepValue <= 19) || (stepValue >= 29 &&
                            stepValue <= 51);
                    });
                    $stepsToRemove.each(function() {
                        $(this).closest('div[data-step]').remove();
                    });
                }
                if (property_type === 'Commercial Property' || property_type ===
                    'Business Opportunity') {
                    var $stepsToRemove = $('.wizard-step[data-step]').filter(function() {
                        var stepValue = parseInt($(this).attr('data-step'));
                        return (stepValue >= 7 && stepValue <= 28) || (stepValue >= 42 &&
                            stepValue <= 51);
                    });

                    $stepsToRemove.each(function() {
                        $(this).closest('div[data-step]').remove();
                    });
                }
                if (property_type === 'Vacant Land (Current Use)') {
                    var $stepsToRemove = $('.wizard-step[data-step]').filter(function() {
                        return parseInt($(this).attr('data-step')) >= 7 && parseInt($(this)
                            .attr('data-step')) <= 41;
                    });
                    $stepsToRemove.each(function() {
                        $(this).closest('div[data-step]').remove();
                    });
                }
                // Submitting The Form After Removing the Extra slide to get rid of null Data
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

            if (StepWizard.currentStep >= 7 && StepWizard.currentStep <= 19) {
                // Calculate progress for Residential steps (7 to 19)
                comp = 20 + ((StepWizard.currentStep - 7) / (19 - 7)) * 80;
            } else if (StepWizard.currentStep >= 20 && StepWizard.currentStep <= 28) {
                // Calculate progress for Income steps (20 to 28)
                comp = 20 + ((StepWizard.currentStep - 20) / (28 - 20)) * 80;
            } else if (StepWizard.currentStep >= 29 && StepWizard.currentStep <= 41) {
                // Calculate progress for Commercial and Business opportunity steps (29 to 41)
                comp = 20 + ((StepWizard.currentStep - 29) / (41 - 29)) * 80;
            } else if (StepWizard.currentStep >= 42 && StepWizard.currentStep <= 51) {
                // Calculate progress for Vacant land steps (42 to 51)
                comp = 20 + ((StepWizard.currentStep - 42) / (51 - 42)) * 80;
            } else {
                // Default progress calculation for other steps
                comp = ((StepWizard.currentStep - 1) / 25) * 100;
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
        // alert('ok');

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
        //    alert(selectedValue);
    });
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACES_API_KEY') }}&libraries=places&callback=initialize">
</script>
@endpush