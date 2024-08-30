@extends('layouts.main')
@push('styles')
    <!-- //Listing Description css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/listingDescription.css') }}" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

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

        ul.leasing {
            --icon-size: 0.8em;
            --gutter: .5em;
            padding: 0 0 0 calc(var(--icon-size) + 1em);
            margin-bottom: 5px;
        }

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

        ul.services li {
            padding-left: var(--gutter);
            color: #34465c;
            list-style: none;
            /* Remove default list style */
            position: relative;
            /* Set position relative for ::before pseudo-element */
        }

        ul.services li::before {
            content: "\f101";
            /* FontAwesome icon content */
            font-family: FontAwesome;
            font-size: var(--icon-size);
            /* Set the desired icon size */
            position: absolute;
            /* Position the icon */
            left: -1.5em;
            /* Adjust the icon position */
            color: #11b7cf;
            /* Set the icon color */
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
    <div class="container listingDescription">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 leftCol">
                @if (gettype(@$auction->get->photos) == 'array')
                    <div class="d-flex flex-wrap justify-content-start">
                        @foreach (@$auction->get->photos as $image)
                            <a href="{{ asset($image) }}" data-toggle="lightbox" data-gallery="example-gallery"
                                style="display:block; width:200px; height: 200px; border:1px solid #e0e0e0; border-radius: 5px; overflow: hidden; margin:4px;background-color: #f2f2f2;">
                                <img class="w-100" src="{{ asset($image) }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="card description">
                    <div class="card-body">
                        <h4>Property Features: </h4>
                        @if (@$auction->get->city != '' && @$auction->get->city != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> City:
                                    <span class="removeBold">{{ @$auction->get->city }}</span>
                                </div>
                            </div>
                        @endif
                        @if (@$auction->get->county != '' && @$auction->get->county != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> County:
                                    <span class="removeBold">{{ @$auction->get->county }}</span>
                                </div>
                            </div>
                        @endif
                        @if (@$auction->get->state != '' && @$auction->get->state != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> State:
                                    <span class="removeBold">{{ @$auction->get->state }}</span>
                                </div>
                            </div>
                        @endif
                        @if (@$auction->get->listing_date != '' && @$auction->get->listing_date != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Listing Date:
                                    <span class="removeBold">{{ @$auction->get->listing_date }}</span>
                                </div>
                            </div>
                        @endif
                        @if (@$auction->get->expiration_date != '' && @$auction->get->expiration_date != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Expiration Date:
                                    <span class="removeBold">{{ @$auction->get->expiration_date }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="row" style="flex-wrap: wrap;">
                            @if (@$auction->get->custom_bedrooms != '' && @$auction->get->custom_bedrooms != 'null')
                                <div class="col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Bedrooms:
                                    <span class="removeBold">{{ @$auction->get->custom_bedrooms }}
                                </div>
                            @elseif(@$auction->get->bedrooms != '' && @$auction->get->bedrooms != 'null' && @$auction->get->bedrooms != null)
                                <div class="col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Bedrooms:
                                    <span class="removeBold">{{ @$auction->get->bedrooms }}
                                </div>
                            @endif
                        </div>
                        @if (@$auction->get->custom_bathrooms != '' && @$auction->get->custom_bathrooms != 'null')
                            <div class="col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Bathrooms:
                                <span class="removeBold">{{ @$auction->get->custom_bathrooms }}
                            </div>
                        @else
                            <div class="col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Bathrooms:
                                <span class="removeBold">{{ @$auction->get->bathrooms }}
                            </div>
                        @endif
                        @if (@$auction->get->property_type != '' && @$auction->get->property_type != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property Style:
                                <span class="removeBold">
                                    ({{ @$auction->get->property_type }})
                                </span><br>
                                @foreach (array_filter(@$auction->get->property_items) as $item)
                                    <span class="bg-secondary badge  removeBold">
                                        {{ $item }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        @if (@$auction->get->prop_condition != '' && @$auction->get->prop_condition != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Property
                                Condition:
                                @if (@$auction->get->prop_condition != 'Other')
                                    <span class="removeBold">
                                        {{ @$auction->get->prop_condition }}
                                    </span>
                                @else
                                    <br>
                                    <ul class="leasing">
                                        <li style="font-size:16px;">
                                            What is the condition of the landlord’s property?
                                            <span class="removeBold"> {{ $auction->get->custom_property_condition }}</span>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        @endif
                        @if (@$auction->get->leaseRoom != '' && @$auction->get->leaseRoom != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Leasing Space
                                :<span class="removeBold"> {{ @$auction->get->leaseRoom }}</span>
                                <br>
                                @if (@$auction->get->leaseRoom == 'Single Room')
                                    <span class="removeBold">
                                        <ul class="leasing">
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">What is the size of the
                                                        room the landlord
                                                        intends to lease?</span></li>
                                                {{ @$auction->get->sizeOfRoom }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">Is there a private
                                                        bathroom, or is it
                                                        shared?</span></li>
                                                {{ @$auction->get->privateBathroom }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">How much storage space is
                                                        available?</span></li>
                                                {{ @$auction->get->storageSpace }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">Can tenants use common
                                                        areas like the kitchen,
                                                        living room, or
                                                        backyard?</span></li>
                                                {{ @$auction->get->commonAreas }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">How is cleaning and
                                                        maintenance of common areas
                                                        managed?</span></li>
                                                {{ @$auction->get->areasManaged }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">Are tenants allowed to
                                                        have guests, and if so,
                                                        are there any
                                                        restrictions?</span></li>
                                                {{ @$auction->get->tenantsGuests }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">How are maintenance issues
                                                        handled?</span></li>
                                                {{ @$auction->get->maintenanceIssues }}
                                            </div>
                                            <div>
                                                <li style="font-size:16px;"><span class="fw-bold">How are the utilities
                                                        split?</span></li>
                                                {{ @$auction->get->utilitiesSplit }}
                                            </div>
                                        </ul>
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (@$auction->get->heated_square_footage != '' && @$auction->get->heated_square_footage != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Heated Sqft:
                                <span class="removeBold">
                                    {{ @$auction->get->heated_square_footage }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->totalSqft != '' && @$auction->get->totalSqft != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Total Sqft:
                                <span class="removeBold">
                                    {{ @$auction->get->totalSqft }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->net_leasable_square_footage != '' && @$auction->get->net_leasable_square_footage != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Net Leaseable
                                Sqft:
                                <span class="removeBold">
                                    {{ @$auction->get->net_leasable_square_footage }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->heated_sqft != '' && @$auction->get->heated_sqft != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Sqft Heated
                                Source:
                                <span class="removeBold">
                                    @if (@$auction->get->heated_sqft != 'Other')
                                        {{ @$auction->get->heated_sqft }}
                                    @else
                                        {{ @$auction->get->other_heated_sqft }}
                                    @endif
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->total_acreage != '' && @$auction->get->total_acreage != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Total Acreage:
                                <span class="removeBold">
                                    {{ @$auction->get->total_acreage }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->petOptions != '' && @$auction->get->petOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Pets:
                                <span class="removeBold">
                                    {{ @$auction->get->petOptions }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->petOptions != '' && @$auction->get->petOptions != 'null' && @$auction->get->petOptions == 'Yes')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Number of
                                Pets Allowed:
                                <span class="removeBold">
                                    {{ @$auction->get->petsNumber }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->petOptions != '' && @$auction->get->petOptions != 'null' && @$auction->get->petOptions == 'Yes')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Acceptable
                                Pet Types:
                                <span class="removeBold">
                                    {{ @$auction->get->petsType }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->petOptions != '' && @$auction->get->petOptions != 'null' && @$auction->get->petOptions == 'Yes')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Maximum Pet
                                Weight:
                                <span class="removeBold">
                                    {{ @$auction->get->petsWeight }}
                                </span>
                            </div>
                        @endif

                        @if (@$auction->get->total_acreage != '' && @$auction->get->total_acreage != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Appliances
                                Included:
                                @if (gettype(@$auction->get->appliances) == 'array')
                                    @foreach ($auction->get->appliances as $appliance)
                                        @if ($appliance != 'Other')
                                            <span class="removeBold badge bg-secondary">
                                                {{ $appliance }}
                                            </span>
                                        @else
                                            <br>
                                            <ul class="leasing">
                                                <li style="font-size:16px;">
                                                    What appliances are included in the property?
                                                    <span class="removeBold"> {{ $auction->get->otherAppliances }}</span>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        @if (@$auction->get->garageOptions != '' && @$auction->get->garageOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i>
                                Garage:<span class="removeBold">({{ $auction->get->garageOptions }})</span>
                                <span class="removeBold">
                                    @if ($auction->get->garageOptions == 'Yes')
                                        {{ $auction->get->custom_garage }}
                                    @endif
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->carportOptions != '' && @$auction->get->carportOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Carport:<span
                                    class="removeBold">({{ $auction->get->carportOptions }})</span>
                                <span class="removeBold">
                                    @if ($auction->get->carportOptions == 'Yes')
                                        {{ $auction->get->custom_carport }}
                                    @endif
                                </span>
                            </div>
                        @elseif(@$auction->get->carportOptions != '' && @$auction->get->carportOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Carport:
                                <span class="removeBold">
                                    {{ $auction->get->carportOptions }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->poolOptions != '' && @$auction->get->poolOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i>
                                Pool:<span
                                    class="removeBold">({{ @$auction->get->poolOptions == 'Yes' ? @$auction->get->poolOptions : 'No' }})</span>
                                <span class= "removeBold">
                                    @if (@$auction->get->poolOptions == 'Yes')
                                        {{ $auction->get->pool }}
                                    @endif
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->view != '' && @$auction->get->view != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> View:
                                @foreach ($auction->get->view as $item)
                                    @if (@$item != 'Other')
                                        <span class="removeBold badge bg-secondary">
                                            {{ $item }}
                                        </span>
                                    @else
                                        <br>
                                        <ul class="leasing">
                                            <li style="font-size:16px;">
                                                View:
                                                <span class="removeBold"> {{ $auction->get->viewOther }}</span>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if (@$auction->get->parkingOptions != '' && @$auction->get->parkingOptions != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i>
                                Garage/Parking Features:
                                @if (@$auction->get->parking != 'Other')
                                    <span class="removeBold badge bg-secondary">
                                        {{ $auction->get->parking }}
                                    </span>
                                @else
                                    <br>
                                    <ul class="leasing">
                                        <li style="font-size:16px;">
                                            What amenities or features does the property
                                            offer?
                                            <span class="removeBold"> {{ $auction->get->parkingOther }}</span>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        @endif
                        @if (@$auction->get->tenantPays != '' && @$auction->get->tenantPays != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Tenant Pays:
                                @foreach ($auction->get->tenantPays as $item)
                                    @if (@$item != 'Other')
                                        <span class="removeBold badge bg-secondary">
                                            {{ $item }}
                                        </span>
                                    @else
                                        <br>
                                        <ul class="leasing">
                                            <li style="font-size:16px;">
                                                Tenant Pays:
                                                <span class="removeBold"> {{ $auction->get->otherTenantPays }}</span>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if (@$auction->get->ownerPays != '' && @$auction->get->ownerPays != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Owner Pays:
                                @foreach ($auction->get->ownerPays as $item)
                                    @if (@$item != 'Other')
                                        <span class="removeBold badge bg-secondary">
                                            {{ $item }}
                                        </span>
                                    @else
                                        <br>
                                        <ul class="leasing">
                                            <li style="font-size:16px;">
                                                Owner Pays:
                                                <span class="removeBold"> {{ $auction->get->otherOwnerPays }}</span>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if (@$auction->get->total_acreage != '' && @$auction->get->total_acreage != 'null')
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Rent
                                Includes:
                                @if (gettype(@$auction->get->rent_include) == 'array')
                                    @foreach ($auction->get->rent_include as $item)
                                        @if ($item != 'Other')
                                            <span class="removeBold">
                                                {{ $item }}
                                            </span>
                                        @else
                                            <br>
                                            <ul class="leasing">
                                                <li style="font-size:16px;">
                                                    What utilities are included in the rent?
                                                    <span class="removeBold">
                                                        {{ $auction->get->other_rent_include }}</span>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Amenities and
                            Property Features:
                            @if (gettype(@$auction->get->amenities) == 'array')
                                @foreach ($auction->get->amenities as $amenitie)
                                    @if ($amenitie != 'Other')
                                        <span class="removeBold badge bg-secondary">
                                            {{ $amenitie }}
                                        </span>
                                    @else
                                        <br>
                                        <ul class="leasing">
                                            <li style="font-size:16px;">
                                                What amenities or features does the property
                                                offer?
                                                <span class="removeBold"> {{ $auction->get->otherAmenities }}</span>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        @if (@$auction->get->propertyLoc != '' && @$auction->get->propertyLoc != 'null' && @$auction->get->propertyLoc != null)
                            <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> 55-and-Over
                                Community?
                                <span class="removeBold">
                                    {{ @$auction->get->propertyLoc }}
                                </span>
                            </div>
                        @endif
                        @if (@$auction->get->termLease != '' && @$auction->get->termLease != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Terms of Lease:
                                    @foreach (@$auction->get->termLease as $item)
                                        <span class="removeBold">${{ $item }}</span>
                                        @if ($item == 'Other')
                                            <span
                                                class="d-inline-block removeBold">${{ @$auction->get->termLeaseOther }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (@$auction->get->leaseAmount != '' && @$auction->get->leaseAmount != 'null')
                            <div class="row" style="flex-wrap: wrap;">
                                <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Lease Amount
                                    Frequency:
                                    <span class="removeBold">${{ @$auction->get->leaseAmount }}</span>
                                </div>
                            </div>
                        @endif

                        <hr>
                        <div class="card-body">
                            <h5>Desired Price and Terms: </h5>
                            @if (@$auction->get->expectation != '' && @$auction->get->expectation != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Desired Rental
                                        Amount:
                                        <span class="removeBold">${{ @$auction->get->expectation }}</span>
                                    </div>
                                </div>
                            @endif
                            @if (@$auction->get->occupant_type != '' && @$auction->get->occupant_type != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Occupancy
                                        Status:<span class="removeBold">({{ @$auction->get->occupant_type }})</span><br>

                                        @if ($auction->get->occupant_type == 'Occupied')
                                            <span class="removeBold">Occupied Until
                                                {{ @$auction->get->occupied_until }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="landlords_hiring_terms">
                                <h5 class="mt-4">Landlord’s Hiring Terms:</h5>
                                @if (@$auction->get->custom_ready_timeframe != '' && @$auction->get->custom_ready_timeframe != 'null')
                                    <div class="row" style="flex-wrap: wrap;">
                                        <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Listing
                                            Availability Date:
                                            <span class="removeBold">{{ @$auction->get->custom_ready_timeframe }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if (@$auction->get->lease_period != '' && @$auction->get->lease_period != 'null')
                                    <div class="row" style="flex-wrap: wrap;">
                                        <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Desired
                                            Lease
                                            Length:<span class="removeBold">{{ $auction->get->lease_period }}

                                                @if (@$auction->get->lease_period === 'Other')
                                                    <span
                                                        class="removeBold">{{ @$auction->get->custom_lease_period }}</span>
                                                @endif
                                        </div>
                                    </div>
                                @endif
                                @if (@$auction->get->listing_term != '' && @$auction->get->listing_term != 'null')
                                    <div class="row" style="flex-wrap: wrap;">
                                        <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Offered
                                            Timeframe for the Landlord Agency Agreement:<span
                                                class="removeBold">{{ $auction->get->listing_term }}</span>

                                            @if (@$auction->get->listing_term === 'Other')
                                                <span class="removeBold">{{ @$auction->get->custom_listing_terms }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (@$auction->get->offered_commission != '' && @$auction->get->offered_commission != 'null')
                                    <div class="row" style="flex-wrap: wrap;">
                                        <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Listing
                                            Agent
                                            Commission Offered:<span
                                                class="removeBold">{{ $auction->get->offered_commission == 'Other' ? '(Other)' : '' }}</span>
                                            @if (@$auction->get->offered_commission != 'Other')
                                                <span class="removeBold">{{ @$auction->get->offered_commission }}</span>
                                            @else
                                                <br>
                                                <ul class="leasing">
                                                    <li style="font-size:16px;">
                                                        <span class="fw-bold">What is the total commission being offered to
                                                            the
                                                            listing agent? </span>
                                                        <span class="removeBold">
                                                            {{ $auction->get->offeredCommissionOther }}</span>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (@$auction->get->tenantCommission != '' && @$auction->get->tenantCommission != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Tenant
                                        Agent
                                        Commission
                                        Split:<span
                                            class="removeBold">{{ $auction->get->tenantCommission == 'Other' ? '(Other)' : '' }}</span>
                                        @if (@$auction->get->tenantCommission != 'Other')
                                            <span class="removeBold">{{ @$auction->get->tenantCommission }}</span>
                                        @else
                                            <br>
                                            <ul class="leasing">
                                                <li style="font-size:16px;">
                                                    <span class="fw-bold"> Tenant's Agent Commission Split from Listing
                                                        Agent's
                                                        Commission Offered:</span>
                                                    <span class="removeBold">
                                                        {{ $auction->get->offeredCommissionOther }}</span>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="card-body">
                            <h4>Most Important Aspects the Landlord Considers When Hiring a Real Estate Agent:</h4>
                            @if (@$auction->get->description != '' && @$auction->get->description != 'null')
                                <div class="col-md-12 col-12 fw-bold" <i class="fa-regular fa-check-square"></i>
                                    <span class="removeBold">
                                        {{ @$auction->get->description }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="card-body">
                            <h4>Additional Details:</h4>
                            <div class="row" style="flex-wrap: wrap;">
                                @if (@$auction->get->important_info != '' && @$auction->get->important_info != 'null')
                                    <span class="removeBold">
                                        {{ @$auction->get->important_info }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <h5>Services the Landlord Requests from Their Agent:</h5>
                            @if (@$auction->get->services != '' && @$auction->get->services != null && @$auction->get->services != 'null')
                                <div class="col-md-12 col-12 removeBold">
                                    <ul>
                                        @if (gettype(@$auction->get->services) == 'array')
                                            @foreach (@$auction->get->services as $service)
                                                <li style="font-size:16px;">{{ $service }}</li>
                                            @endforeach
                                        @else
                                            <li style="font-size:16px;">{{ @$auction->get->services }}</li>
                                        @endif
                                        @if (@$auction->get->servicesOther != null)
                                            <li style="font-size:16px;">{{ @$auction->get->servicesOther }}</li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h4>Landlord’s Info:</h4>
                            @if (@$auction->get->first_name != '' && @$auction->get->first_name != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> First
                                        Name:
                                        <span class="removeBold">{{ @$auction->get->first_name }}</span>
                                    </div>
                                </div>
                            @endif
                            @if (@$auction->get->last_name != '' && @$auction->get->last_name != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Last Name:
                                        <span class="removeBold">{{ @$auction->get->last_name }}</span>
                                    </div>
                                </div>
                            @endif
                            @if (@$auction->get->email != '' && @$auction->get->email != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Email:
                                        <span class="removeBold">{{ @$auction->get->email }}</span>
                                    </div>
                                </div>
                            @endif
                            @if (@$auction->get->phone != '' && @$auction->get->phone != 'null')
                                <div class="row" style="flex-wrap: wrap;">
                                    <div class="col-12 fw-bold"> <i class="fa-regular fa-check-square"></i> Phone
                                        Number:
                                        <span class="removeBold">{{ @$auction->get->phone }}</span>
                                    </div>
                                </div>
                            @endif
                            @if ($auction->get->auction_type !== null && $auction->get->auction_type == 'Auction Listing')
                                <div class="disclaimer">
                                    <h5>Legal Disclaimer:</h5>
                                    <p>For Timed Listings, the landlord must wait until the timer
                                        has ended before selecting an agent to accept, counter, or reject. The only way the
                                        landlord can choose
                                        to end the timer early is if an agent matches the 'Hire Now' terms. These terms
                                        consist of the landlord’s
                                        preferences for the Landlord Agent Agreement Timeframe, the Landlord’s Agent
                                        Commission Split from
                                        the Listing Agent’s Commission, and the services the tenant requests from their
                                        agent.</p>
                                </div>
                            @endif
                            <div class="row">
                                @if (@$auction->get->video)
                                    <div class="col-6 form-group">
                                        <label class="fw-bold mt-1">Video:</label><br>
                                        <video style="width:100%; height:224px;" controls autoplay="true">
                                            <source src="{{ asset(@$auction->get->video) }}" type="video/mp4">
                                            <source src="{{ asset(@$auction->get->video) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                                @if (@$auction->get->photo)
                                    <div class="form-group col-6">
                                        <label class="fw-bold">Photo:</label><br>
                                        <img src="{{ asset(@$auction->get->photo) }}" class="mt-2"
                                            style="width:100%; height:224px;" />
                                    </div>
                            </div>
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
                                <p class="mb-0"><a href="{{ route('author', [$auser->id]) }}"><b>Seller
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
                                <p class="mb-0 opacity-50">{{ $auser->name }} • last online 5 days ago.</p>
                            </div>
                        </div>
                        <div class="right text-center">
                            <a href="{{ route('author', [$auser->id]) }}"><button class="btn">Message</button></a>
                            <a href="{{ route('author', [$auser->id]) }}"><button class="btn">View
                                    Profile</button></a>
                        </div>
                    </div>
                </div>
                <!-- End  -->
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 rightCol">
            @if (@$auction->get->titleListing != null)
                <div class="col-md-12 col-12 fw-bold"><i class="fa-regular fa-check-square"></i> Title of the listing:
                    <h1>{{ @$auction->get->titleListing }}</h1>
                </div>
            @endif
            {{-- <h1>{{ @$auction->address }}</h1> --}}
            <hr>
            @inject('carbon', 'Carbon\Carbon')
            @php
                if (@$auction->auction_length > 0) {
                    $start = $carbon::now();
                    $end = $carbon::parse(@$auction->created_at)->addDays(@$auction->auction_length);
                    $diff = $end->diffInDays($start);
                }
            @endphp
            @if (@$auction->auction_length > 0)
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
                $highest_bid_price = @$auction->bids->max('price_percent') ?? @$auction->get->ideal_price;
                $highest_bid_price =
                    $highest_bid_price > @$auction->get->ideal_price ? $highest_bid_price : @$auction->get->ideal_price;
                $highest_bidder = @$auction->bids->where('price_percent', $highest_bid_price)->first();
                $my_bid = @$auction->bids->where('user_id', $auth_id)->first();
            @endphp
            @if (@$auction->user_id != $auth_id)
                <a href="{{ route('auction-chat', ['landlord-agent', $auction->id]) }}"
                    class="btn btn-success w-100 mb-2">
                    <i class="fa-solid fa-paper-plane"></i> Send Message</a>
            @endif
            @if ($auth_id)
                @if (in_array(auth()->user()->user_type, ['agent']))
                    <button class="btn w-100"
                        onclick="javascript:window.location='{{ route('landlord.agent.auction.bid.add', @$auction->id) }}';"
                        {{-- {{ $my_bid || @$auction->user_id == $auth_id ? 'disabled' : '' }} --}}>
                        <span class="bid">Bid Now </span>
                        <span
                            class="badge bg-light float-end text-dark">${{ @$auction->get->custom_expectation == '' ? @$auction->get->expectation : @$auction->get->custom_expectation }}</span>
                        @if (@$auction->sold)
                            <span class="badge bg-danger">Sold</span>
                        @endif
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <button class="btn w-100">
                        <span class="bid">Login for Bid </span>
                        <span class="badge bg-light float-end text-dark">${{ $highest_bid_price }}</span>
                    </button>
                </a>
            @endif
            <!-- Highest Bider   -->
            <div class="card higestBider">
                <div class="card-body">
                    @if (@$auction->bids->count() > 0)
                    @else
                        <p>No one has bid on this auction.</p>
                    @endif
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0">
                            @foreach (@$auction->bids as $bid)
                                <!-- Item loop -->
                                <div class="accordion" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#item{{ @$bid->id }}" aria-expanded="true"
                                    aria-controls="item{{ @$bid->id }}">
                                    <div class="d-flex small accordion mr-0 text-center">
                                        <div class="col-1">
                                            <span class="badge">{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="col-4">
                                            {{ @$bid->user->name }} </div>
                                        <div class="col-4 text-right">
                                            ${{ @$bid->get->offering_price }}</div>
                                        <div class="col-2">
                                            Terms↓
                                        </div>
                                    </div>
                                </div>
                                <div id="item{{ @$bid->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div id="bidding_history_data">
                                            <div>
                                                <p class="d-flex justify-content-between small">First Name:
                                                    <span>{{ @$bid->get->first_name }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between small">Landlord Agency
                                                    Agreement Timeframe:
                                                    <span>{{ @$bid->get->listing_terms }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between small">Commission Offered:
                                                    <span>{{ @$bid->get->offering_price }}</span>
                                                </p>
                                                @if (@$bid->get->services)
                                                    <div>
                                                        <label>Services Offered by the Agent:</label>
                                                        <ul class="services">
                                                            @foreach (@$bid->get->services as $service)
                                                                @if ($service == 'Other')
                                                                    @continue
                                                                @endif
                                                                <li style="font-size: 16px; margin-top:15px;">
                                                                    {{ $service }}</li>
                                                            @endforeach
                                                            @if (@$bid->get->other_services != '' && @$bid->get->other_services != 'null')
                                                                <li style="font-size: 16px; margin-top:15px;">
                                                                    {{ @$bid->get->other_services }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn w-100 mt-0">
                <span class="bid m-0"><i class="fa fa-user"></i> </span>
            </button>
            <!-- Social Details  -->
            <div class="p-4 card">
                <p class="text-600">Share this link via</p>
                <div class="qr-code" style="width: 100%; height:200px;">
                    {{ qr_code(route('landlord.agent.auction.view', @$auction->id), 200) }}
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
                                        src="{{ asset('assets/fontawesome/svgs/thin/bed-front.svg') }}" alt="bed icon"
                                        width="15"><b>
                                        4</b></span>
                                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                                        src="{{ asset('assets/fontawesome/svgs/thin/bath.svg') }}" alt="bed icon"
                                        width="15"><b>
                                        2</b></span>
                                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                                        src="{{ asset('assets/fontawesome/svgs/thin/ruler-triangle.svg') }}"
                                        alt="bed icon" width="15"><b> 1,643 </b>Sq Ft</span>
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
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Scan Qr Code"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                    </path>
                                </svg>
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Send Message"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                <!-- FAvourite  -->
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Add Favorites"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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
                        <p class="card-text"><span class="badge bg-secondary">land/lots</span> <span
                                class="float-end"><span><b>MLS
                                        ID</b></span> <span>#12345</span></span></p>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-6 left">
                                <!-- Barcode  -->
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Scan Qr Code"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                    </path>
                                </svg>
                                <!-- Message  -->
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Send Message"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                <!-- FAvourite  -->
                                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="Add Favorites"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('saveSABid') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="auction_id" value="{{ @$auction->id }}">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between mb-2">
                            <div style="font-size:18px; font-weight:bold;">
                                ${{ number_format(@$auction->min_price, 2, '.', ',') }}</div>
                            <div style="color: rgba(0,0,0,0.5);">Price Now</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label>Full Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name') }}" />
                                        @if ($errors->has('name'))
                                            <div class="small error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" required />
                                        @if ($errors->has('phone'))
                                            <div class="small error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label>Email: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required />
                                        @if ($errors->has('email'))
                                            <div class="small error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Brokerage: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="brokerage" id="brokerage"
                                            required value="{{ old('brokerage') }}">
                                        {{-- </div> --}}
                                        @if ($errors->has('brokerage'))
                                            <div class="small error">{{ $errors->first('brokerage') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <label>MLS ID: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mls_id"
                                            value="{{ old('mls_id') }}" />
                                        @if ($errors->has('mls_id'))
                                            <div class="small error">{{ $errors->first('mls_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label>Real Estate License #: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="license_no" required
                                            value="{{ old('license_no') }}" />
                                        @if ($errors->has('license_no'))
                                            <div class="small error">{{ $errors->first('license_no') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Commission Offered %: <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-baseline">
                                            <i class="fa fa-percent"></i>
                                            <input type="number" class="form-control border-start-0"
                                                name="price_percent" id="price_percent" min="0" max="100"
                                                required placeholder="0.00" value="{{ old('price_percent') }}">
                                        </div>
                                        @if ($errors->has('price_percent'))
                                            <div class="small error">{{ $errors->first('price_percent') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group d-none">
                                    <div class="col-md-6">
                                        <label>County the agent is in:</label>
                                        <select class="form-control" name="county_id">
                                            @foreach ($counties as $county)
                                                <option value="{{ $county->id }}"
                                                    {{ old('county_id') == $county->id ? 'selected' : '' }}>
                                                    {{ $county->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Offering Price $: <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-baseline">
                                            <i class="fa fa-dollar"></i>
                                            <input type="number" class="form-control border-start-0" name="price"
                                                id="price" min="0" placeholder="0.00"
                                                value="{{ old('price') }}">
                                        </div>
                                        @if ($errors->has('price'))
                                            <div class="small error">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label>Reviews link:</label>
                                        <input type="text" class="form-control" name="reviews_link"
                                            value="{{ old('reviews_link') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Website link:</label>
                                        <input type="text" class="form-control" name="website_link"
                                            value="{{ old('website_link') }}" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 mb-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-center">Social Media Platforms</th>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody class="social-links">
                                                <tr>
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
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right">
                                                        <a class="btn btn-primary add-row">Add New Row</a>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Any details agent wants to share with the seller (Why should the Seller pick
                                        you
                                        as their agent):</label>
                                    <textarea class="form-control" name="additional_details">{{ old('additional_details') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Contract Listing Terms (Time amount for listing agreement):</label>
                                    <textarea class="form-control" name="listing_terms">{{ old('listing_terms') }}</textarea>
                                </div>
                                <div class="form-group d-none">
                                    <label>Why should the Seller pick you as their agent?</label>
                                    <textarea class="form-control" name="why_seller_pick_me">{{ old('why_seller_pick_me') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Services offered to Seller: </label>
                                    <textarea class="form-control" name="services_description">{{ old('services_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group d-none">
                                    <div>
                                        <label>Video:</label>
                                        <div class="d-flex align-items-baseline">
                                            <input type="file" class="form-control" name="video">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label>Video URL: (Virtual Listing Presentation)</label>
                                    <div class="d-flex align-items-baseline">
                                        <input type="text" class="form-control" name="video_url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Audio:</label>
                                    <div class="d-flex align-items-baseline">
                                        <input type="file" class="form-control" name="audio">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Note:</label>
                                    <div class="d-flex align-items-baseline">
                                        <input type="file" class="form-control" name="note">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Comparative Market Analysis:</label>
                                    <div class="d-flex align-items-baseline">
                                        <input type="file" class="form-control" name="market_analysis">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-secondary">Bid Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.9.0/timer.jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    @if (@$auction->get->auction_length_days > 0)
        <script>
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
    @endif
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        import Lightbox from "bs5-lightbox";
        const options = {
            keyboard: true,
            size: "fullscreen",
        };

        document.querySelectorAll(".my-lightbox-toggle").forEach((el) =>
            el.addEventListener("click", (e) => {
                e.preventDefault();
                const lightbox = new Lightbox(el, options);
                lightbox.show();
            })
        );
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
@endpush
