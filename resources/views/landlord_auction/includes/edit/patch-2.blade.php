<div class="wizard-step" data-step='12'>
    <div class="form-group">
        <label for="heated_sqft" class="fw-bold">Heated Sqft:</label>
        <input type="text" name="heated_sqft" id="heated_sqft" class="form-control has-icon"
            data-icon="fa-solid fa-ruler-combined" required
            value="{{ isset($auction->get->heated_sqft) ? $auction->get->heated_sqft : '' }}">
    </div>
    <div class="form-group commercial_show">
        <label for="heated_sqft" class="fw-bold"> Net Leasable Sqft:</label>
        <input type="text" name="net_leasable_sqft" id="net_leasable_sqft" class="form-control has-icon"
            data-icon="fa-solid fa-ruler-combined" required
            value="{{ isset($auction->get->net_leasable_sqft) ? $auction->get->net_leasable_sqft : '' }}">
    </div>
    <div class="form-group">
        <label for="sqft_total" class="fw-bold"> Total Sqft:</label>
        <input type="text" name="sqft_total" id="sqft_total" class="form-control has-icon"
            data-icon="fa-solid fa-ruler-combined" required
            value="{{ isset($auction->get->sqft_total) ? $auction->get->sqft_total : '' }}">
    </div>
    @php
        $heated_sources = [
            ['target' => '', 'name' => 'Appraisal'],
            ['target' => '', 'name' => 'Building'],
            ['target' => '', 'name' => 'Measured'],
            ['target' => '', 'name' => 'Owner Provided'],
            ['target' => '', 'name' => 'Public Records'],
            ['target' => '.otherSqftRes', 'name' => 'Other'],
        ];

    @endphp
    <div class="form-group">
        <label class="fw-bold">Sqft Heated Source:</label>
        <select class="grid-picker" name="heated_source" style="justify-content: left;" required>
            <option value="">Select</option>
            @foreach ($heated_sources as $heated_source)
                <option value="{{ $heated_source['name'] }}" data-target="{{ $heated_source['target'] }}"
                    class="card flex-row" style="width:calc(25% - 10px);"
                    data-icon='<i class="fa-regular fa-circle-check "></i>'
                    {{ isset($auction->get->heated_source) && $heated_source['name'] == $auction->get->heated_source ? 'selected' : '' }}>
                    {{ $heated_source['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherSqftRes d-none">
            <label for="sqft_total" class="fw-bold"> Sqft Heated Source:</label>
            <input type="text" name="otherSqft" class="form-control has-icon" data-icon="fa-regular fa-circle-check"
                value="{{ isset($auction->get->otherSqft) ? $auction->get->otherSqft : '' }}" required>
        </div>
    </div>
</div>
<div class="wizard-step" data-step='13'>
    <h4>Land Information:</h4>
    @php
        $total_acreages = [
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
        <label class="fw-bold">Total Acreage:</label>
        <select class="grid-picker" name="total_acreage" id="total_acreage" style="justify-content: flex-start;"
            required>
            <option value="">Select</option>
            @foreach ($total_acreages as $total_acreage)
                <option value="{{ $total_acreage['name'] }}" data-target="{{ $total_acreage['target'] }}"
                    class="card flex-column" style="width:calc(25% - 10px);"
                    data-icon='<i class="fa-solid fa-ruler-combined"></i>'
                    {{ isset($auction->get->total_acreage) && $total_acreage['name'] == $auction->get->total_acreage ? 'selected' : '' }}>
                    {{ $total_acreage['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="fw-bold">Year Built:</label>
        <input type="text" name="yearBuilt" class="form-control has-icon" data-icon="fa-regular fa-calendar-days"
            value="{{ isset($auction->get->yearBuilt) ? $auction->get->yearBuilt : '' }}">
    </div>
    <div class="form-group">
        <label class="fw-bold">Lot Size:</label>
        <input type="text" name="lotSize" class="form-control has-icon" data-icon="fa-solid fa-ruler-combined"
            required value="{{ isset($auction->get->lotSize) ? $auction->get->lotSize : '' }}">
    </div>
    <div class="form-group">
        <label class="fw-bold">Legal Subdivision Name:</label>
        <input type="text" name="legarName" class="form-control has-icon" data-icon="fa-solid fa-ruler-combined"
            required value="{{ isset($auction->get->legarName) ? $auction->get->legarName : '' }}">
    </div>
    <div class="form-group">
        <label class="fw-bold">Tax ID (Parcel Number) :</label>
        <input type="text" name="taxId" class="form-control has-icon" data-icon="fa-solid fa-ruler-combined"
            required value="{{ isset($auction->get->taxId) ? $auction->get->taxId : '' }}">
    </div>
    <div class="form-group">
        <label class="fw-bold">Flood Zone Code:</label>
        <input type="text" name="zoneCode" class="form-control has-icon" data-icon="fa-solid fa-ruler-combined"
            required value="{{ isset($auction->get->zoneCode) ? $auction->get->zoneCode : '' }}">
    </div>
    <span class="commercialFields">
        <div class="form-group">
            <label class="fw-bold">Zoning:</label>
            <input type="text" name="zoning" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle" required
                value="{{ isset($auction->get->zoning) ? $auction->get->zoning : '' }}">
        </div>
        <div class="form-group">
            <label class="fw-bold">Tax Year:</label>
            <input type="text" name="tax_year" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle" required
                value="{{ isset($auction->get->tax_year) ? $auction->get->tax_year : '' }}">
        </div>
        <div class="form-group">
            <label class="fw-bold">Taxes (Annual Amount):</label>
            <input type="text" name="taxes_annual" class="form-control has-icon"
                data-icon="fa-solid fa-dollar-sign" required
                value="{{ isset($auction->get->taxes_annual) ? $auction->get->taxes_annual : '' }}">
        </div>
        <div class="form-group">
            <label class="fw-bold">Legal Description:</label>
            <input type="text" name="legal_description" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle" required
                value="{{ isset($auction->get->legal_description) ? $auction->get->legal_description : '' }}">
        </div>
        <div class="form-group">
            <label class="fw-bold">Total Number of Parcels:</label>
            <input type="text" name="no_of_parcels" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle" required
                value="{{ isset($auction->get->no_of_parcels) ? $auction->get->no_of_parcels : '' }}">
        </div>
        @php
            $additional = [
                ['name' => 'Yes', 'target' => '.additionalTax', 'icon' => 'fa-regular fa-circle-check'],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
        @endphp
        <div class="form-group ">
            <label class="fw-bold">Additional Parcels</label>
            <select class="grid-picker" name="additional_parcels" id="additional_parcels"
                style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($additional as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-column" style="width:calc(25% - 10px);"
                        data-icon='<i class="{{ $item['icon'] }}"></i>'
                        {{ isset($auction->get->additional_parcels) && $item['name'] == $auction->get->additional_parcels ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group additionalTax  d-none">
            <label class="fw-bold">Additional Tax ID’s:</label>
            <input type="text" name="additional_tax_id" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle" required
                value="{{ isset($auction->get->additional_tax_id) ? $auction->get->additional_tax_id : '' }}">
        </div>
    </span>
</div>
<div class="wizard-step" data-step='14'>
    @php
        $furnishings = [
            ['name' => 'Furnished', 'target' => '', 'icon' => ''],
            ['name' => 'Optional', 'target' => '', 'icon' => ''],
            ['name' => 'Partial', 'target' => '', 'icon' => ''],
            ['name' => 'Turnkey', 'target' => '', 'icon' => ''],
            ['name' => 'Unfurnished', 'target' => '', 'icon' => ''],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Furnishings:</label>
        <select class="grid-picker" name="furnishings" id="furnishings" style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($furnishings as $furnishing)
                <option value="{{ $furnishing['name'] }}" data-target="{{ $furnishing['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon='<i class="fa-regular fa-circle-check"></i>'
                    {{ isset($auction->get->furnishings) && $furnishing['name'] == $auction->get->furnishings ? 'selected' : '' }}>
                    {{ $furnishing['name'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="wizard-step" data-step='15'>
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
            ['name' => 'Touchless Faucet', 'target' => ''],
            ['name' => 'Trash Compactor', 'target' => ''],
            ['name' => 'Washer', 'target' => ''],
            ['name' => 'Water Filtration System', 'target' => ''],
            ['name' => 'Water Purifier', 'target' => ''],
            ['name' => 'Water Softener', 'target' => ''],
            ['name' => 'Whole House R.O. System', 'target' => ''],
            ['name' => 'Wine Refrigerator', 'target' => ''],
            ['name' => 'None', 'target' => ''],
            ['name' => 'Other', 'target' => '.appliancesOtherRes'],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Appliances:</label>
        <select class="grid-picker" name="appliances[]" id="appliances" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($appliances as $appliance)
                <option value="{{ $appliance['name'] }}" data-target="{{ $appliance['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->appliances) && in_array($appliance['name'], json_decode($auction->get->appliances) ?? []) ? 'selected' : '' }}>
                    {{ $appliance['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group appliancesOtherRes d-none">
            <label class="fw-bold">Appliances:</label>
            <input type="text" name="appliancesOther" id="total_floors" placeholder=""
                class="form-control has-icon" data-icon="fa-regular fa-circle-check"
                value="{{ isset($auction->get->appliancesOther) ? $auction->get->appliancesOther : '' }}">
        </div>
    </div>
    @php
        $yes_or_nos = [
            ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
            ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
        ];
        $yes_or_nos_opt = [
            ['name' => 'Yes', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
            ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ['name' => 'Optional', 'target' => '', 'icon' => 'fa-regular fa-circle-question'],
        ];

    @endphp
    <span class="resFields">
        <div class="form-group">
            <label class="fw-bold">Fireplace:</label>
            <select class="grid-picker" name="firePlace" id="carport" style="justify-content: flex-start;"
                required>
                <option value="">Select</option>
                @foreach ($yes_or_nos as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                        {{ isset($auction->get->firePlace) && $item['name'] == $auction->get->firePlace ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </span>
</div>
<div class="wizard-step" data-step='16'>
    <span class="resFields">
        <div class="form-group">
            <label class="fw-bold">
                Amenities and Property Features:
            </label>
            @php
                $amenitiesFeatureRes = [
                    ['target' => '', 'name' => 'Garage'],
                    ['target' => '', 'name' => 'Carport'],
                    ['target' => '', 'name' => 'Pool'],
                    ['target' => '', 'name' => 'Waterfront'],
                    ['target' => '', 'name' => 'In-Unit Laundry'],
                    ['target' => '', 'name' => 'On-site Laundry'],
                    ['target' => '', 'name' => 'Washer and Dryer Hookup'],
                    ['target' => '', 'name' => 'Washer and Dryer'],
                    ['target' => '', 'name' => 'Covered Carport'],
                    ['target' => '', 'name' => 'First Floor Unit'],
                    ['target' => '', 'name' => 'Elevator'],
                    ['target' => '', 'name' => 'Pet Friendly'],
                    ['target' => '', 'name' => 'Balcony/Patio'],
                    ['target' => '', 'name' => 'Fitness Center/Gym'],
                    ['target' => '', 'name' => 'Central Heating'],
                    ['target' => '', 'name' => 'Central Air Conditioning'],
                    ['target' => '', 'name' => 'Fireplace'],
                    ['target' => '', 'name' => 'Walk-in Closet'],
                    ['target' => '', 'name' => 'Hardwood Floors'],
                    ['target' => '', 'name' => 'Tile Floors'],
                    ['target' => '', 'name' => 'Carpet Floors '],
                    ['target' => '', 'name' => 'Security System'],
                    ['target' => '', 'name' => 'Gated Community'],
                    ['target' => '', 'name' => 'HOA Community'],
                    ['target' => '', 'name' => '55 and Over Community'],
                    ['target' => '', 'name' => 'Specific School District'],
                    ['target' => '', 'name' => 'Accessibility Features'],
                    ['target' => '', 'name' => 'On-site Maintenance'],
                    ['target' => '', 'name' => 'On-site Management'],
                    ['target' => '', 'name' => 'Outdoor Space'],
                    ['target' => '', 'name' => 'Playground'],
                    ['target' => '', 'name' => 'Clubhouse'],
                    ['target' => '', 'name' => 'Storage Space'],
                    ['target' => '', 'name' => 'Study/Den/Office'],
                    ['target' => '', 'name' => 'Updated Kitchen'],
                    ['target' => '', 'name' => 'Updated Bathroom'],
                    ['target' => '.otherAmenitiesFeatureRes', 'name' => 'Other'],
                ];
            @endphp
            <select name="amenities[]" id="negotiable_terms" class="grid-picker"
                style="justify-content: flex-start;" multiple required>
                <option value=""></option>
                @foreach ($amenitiesFeatureRes as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        class="card flex-column" style="width:calc(20% - 10px);"
                        data-icon='<i class="fa-regular fa-check-circle" style="font-size:24px;"></i>'
                        {{ isset($auction->get->amenities) && in_array($item['name'], json_decode($auction->get->amenities) ?? []) ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group otherAmenitiesFeatureRes d-none">
            <label class="fw-bold" for="custom_negotiable_terms"> Amenities and Property Features:
            </label>
            <input type="text" name="otherAmenities" id="custom_negotiable_terms" placeholder=""
                class="form-control has-icon" data-icon="fa-regular fa-circle-check" required
                value="{{ isset($auction->get->otherAmenities) ? $auction->get->otherAmenities : '' }}">
        </div>
    </span>
    <span class="commercialFields">
        @php
            $amenitiesCommercial = [
                ['name' => 'Parking Spaces', 'target' => ''],
                ['name' => 'Loading Dock', 'target' => ''],
                ['name' => 'Warehouse Space', 'target' => ''],
                ['name' => 'Office Space', 'target' => ''],
                ['name' => 'Conference Room', 'target' => ''],
                ['name' => 'Kitchenette/Break Room', 'target' => ''],
                ['name' => 'Restrooms', 'target' => ''],
                ['name' => 'Elevator', 'target' => ''],
                ['name' => 'Handicap Accessibility ', 'target' => ''],
                ['name' => 'Security System ', 'target' => ''],
                ['name' => 'On-site Maintenance ', 'target' => ''],
                ['name' => 'On-site Management ', 'target' => ''],
                ['name' => 'Outdoor Space/Garden ', 'target' => ''],
                ['name' => 'Signage Opportunities ', 'target' => ''],
                ['name' => 'High-Speed Internet ', 'target' => ''],
                ['name' => 'Utilities Included ', 'target' => ''],
                ['name' => 'HVAC System ', 'target' => ''],
                ['name' => 'Natural Lighting ', 'target' => ''],
                ['name' => 'Storage Space ', 'target' => ''],
                ['name' => 'Open Floor Plan ', 'target' => ''],
                ['name' => 'Retail Frontage ', 'target' => ''],
                ['name' => 'Restaurant Space ', 'target' => ''],
                ['name' => 'Industrial Features ', 'target' => ''],
                ['name' => 'Flexibility for Renovations ', 'target' => ''],
                ['name' => 'Common Areas ', 'target' => ''],
                ['name' => 'Business Center ', 'target' => ''],
                ['name' => 'Gym/Fitness Facilities ', 'target' => ''],
                ['name' => 'Lounge Area ', 'target' => ''],
                ['name' => 'Reception Area ', 'target' => ''],
                ['name' => 'Security Guard ', 'target' => ''],
                ['name' => 'Fire Safety Systems ', 'target' => ''],
                ['name' => 'Energy-Efficient Features ', 'target' => ''],
                ['name' => 'Green Building Certification ', 'target' => ''],
                ['name' => 'Access to Public Transportation ', 'target' => ''],
                ['name' => 'Proximity to Highways ', 'target' => ''],
                ['name' => 'Visibility from Main Road ', 'target' => ''],
                ['name' => 'Other ', 'target' => '.otherAmenitiesCommercial'],
            ];
        @endphp
        <div class="form-group">
            <label class="fw-bold">Amenities and Property Features:</label>
            <select class="grid-picker" name="amenities[]" id="appliances" style="justify-content: flex-start;"
                multiple required>
                <option value="">Select</option>
                @foreach ($amenitiesCommercial as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                        data-icon='<i class="fa-regular fa-check-circle"></i>' class="card flex-row"
                        style="width:calc(33.3% - 10px);"
                        {{ isset($auction->get->amenities) && in_array($item['name'], json_decode($auction->get->amenities) ?? []) ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
            <div class="form-group otherAmenitiesCommercial d-none">
                <label class="fw-bold">Amenities and Property Features:</label>
                <input type="text" class="form-control has-icon" name="otherAmenities"
                    data-icon="fa-regular fa-check-circle" required
                    value="{{ isset($auction->get->otherAmenities) ? $auction->get->otherAmenities : '' }}" />
            </div>
        </div>
    </span>
</div>
<div class="wizard-step" data-step='17'>
    @php
        $accessibilityFeaturesRes = [
            ['name' => 'Accessible Approach', 'target' => ''],
            ['name' => 'Accessible Bedroom', 'target' => ''],
            ['name' => 'Accessible Closets', 'target' => ''],
            ['name' => 'Accessible Common Room', 'target' => ''],
            ['name' => 'Accessible Doors', 'target' => ''],
            ['name' => 'Accessible Electrical and Environmental Controls', 'target' => ''],
            ['name' => 'Accessible Elevator Installed', 'target' => ''],
            ['name' => 'Accessible Entrance', 'target' => ''],
            ['name' => 'Accessible for Hearing-Impairment', 'target' => ''],
            ['name' => 'Accessible Full Bath', 'target' => ''],
            ['name' => 'Accessible Guest Bathroom', 'target' => ''],
            ['name' => 'Accessible Hallway(s)', 'target' => ''],
            ['name' => 'Accessible Kitchen', 'target' => ''],
            ['name' => 'Accessible Kitchen Appliances', 'target' => ''],
            ['name' => 'Accessible Living Area', 'target' => ''],
            ['name' => 'Accessible Stairway', 'target' => ''],
            ['name' => 'Accessible Washer/Dryer', 'target' => ''],
            ['name' => 'Ceiling Track for Chair Lift', 'target' => ''],
            ['name' => 'Central Living Area', 'target' => ''],
            ['name' => 'Customized Wheelchair Accessible', 'target' => ''],
            ['name' => 'Enhanced Accessible', 'target' => ''],
            ['name' => 'Exterior Wheelchair Lift', 'target' => ''],
            ['name' => 'Grip-Accessible Features', 'target' => ''],
            ['name' => 'Stair Lift', 'target' => ''],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Accessibility Features:</label>
        <select class="grid-picker" name="features[]" multiple style="justify-content: flex-start;" required>
            <option value="">Select</option>
            @foreach ($accessibilityFeaturesRes as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'
                    {{ isset($auction->get->features) && in_array($item['name'], json_decode($auction->get->features) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="wizard-step" data-step='18'>
    <h4>Interior Features</h4>
    @php
        $interior_features = [
            ['name' => 'Accessibility Features', 'target' => ''],
            ['name' => 'Attic Fan', 'target' => ''],
            ['name' => 'Attic Ventilator', 'target' => ''],
            ['name' => 'Built in Features', 'target' => ''],
            ['name' => 'Cathedral Ceiling(s)', 'target' => ''],
            ['name' => 'Ceiling Fans(s)', 'target' => ''],
            ['name' => 'Central Vacuum', 'target' => ''],
            ['name' => 'Chair Rail', 'target' => ''],
            ['name' => 'Coffered Ceiling(s)', 'target' => ''],
            ['name' => 'Crown Molding', 'target' => ''],
            ['name' => 'Dry Bar', 'target' => ''],
            ['name' => 'Dumbwaiter', 'target' => ''],
            ['name' => 'Eating Space In Kitchen', 'target' => ''],
            ['name' => 'Elevator', 'target' => ''],
            ['name' => 'High Ceiling(s)', 'target' => ''],
            ['name' => 'In Wall Pest System', 'target' => ''],
            ['name' => 'Kitchen/Family Room Combo', 'target' => ''],
            ['name' => 'L Dining', 'target' => ''],
            ['name' => 'Living Room/Dining Room Combo', 'target' => ''],
            ['name' => 'Primary Bedroom Main Floor', 'target' => ''],
            ['name' => 'Primary Bedroom Upstairs', 'target' => ''],
            ['name' => 'Open Floorplan', 'target' => ''],
            ['name' => 'Pest Guard System', 'target' => ''],
            ['name' => 'Sauna', 'target' => ''],
            ['name' => 'Skylight(s)', 'target' => ''],
            ['name' => 'Smart Home', 'target' => ''],
            ['name' => 'Solid Surface Counters', 'target' => ''],
            ['name' => 'Solid Wood Cabinets', 'target' => ''],
            ['name' => 'Split Bedroom', 'target' => ''],
            ['name' => 'Stone Counters', 'target' => ''],
            ['name' => 'Thermostat', 'target' => ''],
            ['name' => 'Thermostat Attic Fan', 'target' => ''],
            ['name' => 'Tray Ceiling(s)', 'target' => ''],
            ['name' => 'Vaulted Ceiling(s)', 'target' => ''],
            ['name' => 'Walk-In Closet(s)', 'target' => ''],
            ['name' => 'Wet Bar', 'target' => ''],
            ['name' => 'Window Treatments', 'target' => ''],
            ['name' => 'None', 'target' => ''],
            ['name' => 'Other', 'target' => '.interiorFeatureOtherRes'],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Interior Features:</label>
        <select class="grid-picker" name="interiorFeatures[]" multiple id="tenant_pays"
            style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($interior_features as $interior_feature)
                <option value="{{ $interior_feature['name'] }}" data-target="{{ $interior_feature['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon='<i class="fa-regular fa-circle-check"></i>'
                    {{ isset($auction->get->interiorFeatures) && in_array($item['name'], json_decode($auction->get->interiorFeatures) ?? []) ? 'selected' : '' }}>
                    {{ $interior_feature['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group interiorFeatureOtherRes d-none">
            <label class="fw-bold">Interior Features:</label>
            <input type="text" name="interiorFeatureOther" id="floors_in_unit" placeholder=""
                class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->interiorFeatureOther) ? $auction->get->interiorFeatureOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='19'>
    <h4>Additional Rooms</h4>
    @php
        $additional_rooms = [
            ['name' => 'Attic', 'target' => ''],
            ['name' => 'Bonus Room', 'target' => ''],
            ['name' => 'Breakfast Room Separate', 'target' => ''],
            ['name' => 'Den/Library/Office', 'target' => ''],
            ['name' => 'Family Room', 'target' => ''],
            ['name' => 'Florida Room', 'target' => ''],
            ['name' => 'Formal Dining Room Separate', 'target' => ''],
            ['name' => 'Formal Living Room Separate', 'target' => ''],
            ['name' => 'Garage Apartment', 'target' => ''],
            ['name' => 'Great Room', 'target' => ''],
            ['name' => 'Inside Utility', 'target' => ''],
            ['name' => 'Interior In-Law Suite w/Private Entry', 'target' => ''],
            ['name' => 'Interior In-Law Suite w/No Private Entry', 'target' => ''],
            ['name' => 'Loft', 'target' => ''],
            ['name' => 'Media Room', 'target' => ''],
            ['name' => 'Storage Rooms', 'target' => ''],
            ['name' => 'Other', 'target' => '.roomOtherRes'],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Additional Rooms:</label>
        <select class="grid-picker" name="additional_rooms[]" multiple id="additional_rooms"
            style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($additional_rooms as $additional_room)
                <option value="{{ $additional_room['name'] }}" data-target="{{ $additional_room['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon='<i class="fa-regular fa-circle-check"></i>'
                    {{ isset($auction->get->additionalRooms) && in_array($item['name'], json_decode($auction->get->additionalRooms) ?? []) ? 'selected' : '' }}>

                    {{ $additional_room['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group roomOtherRes d-none">
            <label class="fw-bold">Additional Rooms:</label>
            <input type="text" name="roomOther" id="number_of_buildings" placeholder=""
                class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->roomOther) ? $auction->get->roomOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='20'>
    @php
        $laundryRes = [
            ['name' => 'Common Area', 'target' => ''],
            ['name' => 'Corridor Access', 'target' => ''],
            ['name' => 'Electric Dryer Hookup', 'target' => ''],
            ['name' => 'Gas Dryer Hookup', 'target' => ''],
            ['name' => 'Outside', 'target' => ''],
            ['name' => 'Same Floor As Condo Unit', 'target' => ''],
            ['name' => 'Upper Floor', 'target' => ''],
            ['name' => 'Washer Hookup', 'target' => ''],
            ['name' => 'Inside', 'target' => ''],
            ['name' => 'In Garage', 'target' => ''],
            ['name' => 'In Kitchen', 'target' => ''],
            ['name' => 'Laundry Chute', 'target' => ''],
            ['name' => 'Laundry Closet', 'target' => ''],
            ['name' => 'Laundry Room', 'target' => ''],
            ['name' => 'None', 'target' => ''],
            ['name' => 'Other', 'target' => '.laundryOtherRes'],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Laundry Features:</label>
        <select class="grid-picker" name="laundry[]" multiple style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($laundryRes as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-regular fa-circle-check"></i>'
                    {{ isset($auction->get->laundry) && in_array($item['name'], json_decode($auction->get->laundry) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group laundryOtherRes d-none">
            <label class="fw-bold">Laundry Features: </label>
            <input type="text" name="laundryOther" id="number_of_buildings" placeholder=""
                class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->laundryOther) ? $auction->get->laundryOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='21'>
    <div class="form-group">
        <label class="fw-bold">How many floors are in the property? </label>
        <input type="text" name="propFloors" id="number_of_buildings" placeholder=""
            class="form-control has-icon" data-icon="fa-solid fa-hotel"
            value="{{ isset($auction->get->propFloors) ? $auction->get->propFloors : '' }}">
    </div>
    <div class="form-group">
        <label class="fw-bold">What floor number is the property on?</label>
        <input type="text" name="floorNumber" id="floors_in_unit" placeholder="" class="form-control has-icon"
            data-icon="fa-solid fa-hotel"
            value="{{ isset($auction->get->floorNumber) ? $auction->get->floorNumber : '' }}">
    </div>

    <div class="form-group">
        <label class="fw-bold">How many floors are in the entire building? </label>
        <input type="text" name="totalFloors" id="total_floors" placeholder="" class="form-control has-icon"
            data-icon="fa-solid fa-hotel"
            value="{{ isset($auction->get->totalFloors) ? $auction->get->totalFloors : '' }}">
    </div>
    <span class="commercialFields">
        <div class="form-group">
            <label class="fw-bold">Total Number of Buildings: </label>
            <input type="text" name="totalBuildings" placeholder="" class="form-control has-icon"
                data-icon="fa-solid fa-hotel"
                value="{{ isset($auction->get->totalBuildings) ? $auction->get->totalBuildings : '' }}">
        </div>
    </span>
    <div class="form-group">
        <label class="fw-bold">Building Elevator:</label>
        <select class="grid-picker" name="building_elevator" id="building_elevator"
            style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($yes_or_nos as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="fa-solid fa-hotel"></i>'
                    {{ isset($auction->get->building_elevator) && $item['name'] == $auction->get->building_elevator ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="wizard-step" data-step='22'>
    @php
        $floor_coverings = [
            ['name' => 'Bamboo', 'target' => ''],
            ['name' => 'Brick/Stone', 'target' => ''],
            ['name' => 'Carpet', 'target' => ''],
            ['name' => 'Ceramic Tile', 'target' => ''],
            ['name' => 'Concrete', 'target' => ''],
            ['name' => 'Cork', 'target' => ''],
            ['name' => 'Engineered Hardwood', 'target' => ''],
            ['name' => 'Epoxy', 'target' => ''],
            ['name' => 'Forestry Stewardship Certified', 'target' => ''],
            ['name' => 'Granite', 'target' => ''],
            ['name' => 'Laminate', 'target' => ''],
            ['name' => 'Linoleum', 'target' => ''],
            ['name' => 'Luxury Vinyl', 'target' => ''],
            ['name' => 'Marble', 'target' => ''],
            ['name' => 'Parquet', 'target' => ''],
            ['name' => 'Porcelain Tile', 'target' => ''],
            ['name' => 'Quarry Tile', 'target' => ''],
            ['name' => 'Reclaimed Wood', 'target' => ''],
            ['name' => 'Recycled/Composite Flooring', 'target' => ''],
            ['name' => 'Slate', 'target' => ''],
            ['name' => 'Terrazzo', 'target' => ''],
            ['name' => 'Tile', 'target' => ''],
            ['name' => 'Travertine', 'target' => ''],
            ['name' => 'Vinyl', 'target' => ''],
            ['name' => 'Wood', 'target' => ''],
            ['name' => 'Other', 'target' => '.floorCoveringOtherRes'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Floor Covering:</label>
        <select class="grid-picker" name="floor_covering[]" id="floor_covering" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($floor_coverings as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->floor_covering) && in_array($item['name'], json_decode($auction->get->floor_covering) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group  floorCoveringOtherRes d-none">
            <label class="fw-bold">Floor Covering:</label>
            <input type="text" name="floorConvringOther" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->floorConvringOther) ? $auction->get->floorConvringOther : '' }}">
        </div>
    </div>
</div>

<div class="wizard-step" data-step='23'>
    <h4>Room Details:</h4>
    @php
        $room_types = [
            ['name' => 'Additional Bedroom', 'target' => ''],
            ['name' => 'Balcony/Porch/Lanai', 'target' => ''],
            ['name' => 'Basement', 'target' => ''],
            ['name' => 'Bathroom 1', 'target' => ''],
            ['name' => 'Bathroom 2', 'target' => ''],
            ['name' => 'Bathroom 3', 'target' => ''],
            ['name' => 'Bathroom 4', 'target' => ''],
            ['name' => 'Bathroom 5', 'target' => ''],
            ['name' => 'Bedroom 1', 'target' => ''],
            ['name' => 'Bedroom 2', 'target' => ''],
            ['name' => 'Bedroom 3', 'target' => ''],
            ['name' => 'Bedroom 4', 'target' => ''],
            ['name' => 'Bedroom 5', 'target' => ''],
            ['name' => 'Bonus Room', 'target' => ''],
            ['name' => 'Breezeway', 'target' => ''],
            ['name' => 'Dining Room', 'target' => ''],
            ['name' => 'Dinette', 'target' => ''],
            ['name' => 'Garage Room', 'target' => ''],
            ['name' => 'Garage Apartment,', 'target' => ''],
            ['name' => 'Double Primary Bedroom', 'target' => ''],
            ['name' => 'Family Room', 'target' => ''],
            ['name' => 'Florida Room', 'target' => ''],
            ['name' => 'Foyer', 'target' => ''],
            ['name' => 'Game Room', 'target' => ''],
            ['name' => 'Great Room', 'target' => ''],
            ['name' => 'Gym', 'target' => ''],
            ['name' => 'Inside Utility', 'target' => ''],
            ['name' => 'Interior In-Law Suite', 'target' => ''],
            ['name' => 'Kitchen', 'target' => ''],
            ['name' => 'Laundry', 'target' => ''],
            ['name' => 'Library', 'target' => ''],
            ['name' => 'Living Room', 'target' => ''],
            ['name' => 'Loft', 'target' => ''],
            ['name' => 'Primary Bathroom', 'target' => ''],
            ['name' => 'Primary Bedroom', 'target' => ''],
            ['name' => 'Media Room', 'target' => ''],
            ['name' => 'Office', 'target' => ''],
            ['name' => 'Sauna', 'target' => ''],
            ['name' => 'Studio', 'target' => ''],
            ['name' => 'Study/Den', 'target' => ''],
            ['name' => 'Workshop', 'target' => ''],
        ];
    @endphp
    {{-- <div class="form-group ">
        <label class="fw-bold">Room Type:</label>
        <select class="grid-picker" name="room_type[]" id="room_typeRes" onChange="roomFtn();"
            style="justify-content: flex-start;" required>
            <option value="">Select</option>
            @foreach ($room_types as $room_type)
                <option value="{{ $room_type['name'] }}" data-target="{{ $room_type['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->room_type) && in_array($item['name'], json_decode($auction->get->room_type) ?? []) ? 'selected' : '' }}>
                    {{ $room_type['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group roomDet">
        <label class="fw-bold">Approximate Room Dimensions (Width x Length) </label>
        <input type="text" name="roomDimensions[]" class="form-control" required
            value="{{ isset($auction->get->roomDimensions) ? json_decode($auction->get->roomDimensions)[0] : '' }}">
        <button type="button" class="btn btn-secondary btn-sm w-100 roomBtn mt-2" onclick="add_room_dimension();"><i
                class="fa-solid fa-plus"></i> Add New
            Row</button>
    </div>
    @php
        $room_levels = [
            ['name' => 'Upper', 'target' => ''],
            ['name' => 'Basement', 'target' => ''],
            ['name' => 'First', 'target' => ''],
            ['name' => 'Second', 'target' => ''],
            ['name' => 'Third', 'target' => ''],
        ];
    @endphp
    <div class="form-group roomDet">
        <label class="fw-bold">Room Level:</label>
        <select class="grid-picker" name="room_level[]" id="room_level" style="justify-content: flex-start;"
            required multiple>
            <option value="">Select</option>
            @foreach ($room_levels as $room_level)
                <option value="{{ $room_level['name'] }}" data-target="{{ $room_level['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->room_level) && in_array($item['name'], json_decode($auction->get->room_level) ?? []) ? 'selected' : '' }}>
                    {{ $room_level['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    @php
        $bedroomCloset = [
            ['name' => 'Built-in Closet', 'target' => ''],
            ['name' => 'Coat Closet', 'target' => ''],
            ['name' => 'Dual Closets', 'target' => ''],
            ['name' => 'Linen Closet', 'target' => ''],
            ['name' => 'No Closet', 'target' => ''],
            ['name' => 'Storage Closet', 'target' => ''],
            ['name' => 'Walk-in Closet', 'target' => ''],
        ];
    @endphp
    <div class="form-group roomDet ">
        <label class="fw-bold">Closet Type:</label>
        <select class="grid-picker" name="bedroomCloset[]" style="justify-content: flex-start;" required>
            <option value="">Select</option>
            @foreach ($bedroomCloset as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->bedroomCloset) && in_array($item['name'], json_decode($auction->get->bedroomCloset) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    @php
        $roomPrimary = [
            ['name' => 'Bamboo', 'target' => ''],
            ['name' => 'Brick/Stone', 'target' => ''],
            ['name' => 'Carpet', 'target' => ''],
            ['name' => 'Ceramic Tile', 'target' => ''],
            ['name' => 'Concrete', 'target' => ''],
            ['name' => 'Cork', 'target' => ''],
            ['name' => 'Engineered Hardwood', 'target' => ''],
            ['name' => 'Epoxy', 'target' => ''],
            ['name' => 'Forestry Stewardship Certified', 'target' => ''],
            ['name' => 'Granite', 'target' => ''],
            ['name' => 'Laminate', 'target' => ''],
            ['name' => 'Linoleum', 'target' => ''],
            ['name' => 'Marble', 'target' => ''],
            ['name' => 'Parquet', 'target' => ''],
            ['name' => 'Porcelain Tile', 'target' => ''],
            ['name' => 'Quarry Tile', 'target' => ''],
            ['name' => 'Reclaimed Wood', 'target' => ''],
            ['name' => 'Recycled/Composite Flooring', 'target' => ''],
            ['name' => 'Slate', 'target' => ''],
            ['name' => 'Terrazzo', 'target' => ''],
            ['name' => 'Tile', 'target' => ''],
            ['name' => 'Travertine', 'target' => ''],
            ['name' => 'Vinyl', 'target' => ''],
            ['name' => 'Wood', 'target' => ''],
            ['name' => 'Other', 'target' => ''],
        ];
    @endphp
    <div class="form-group roomDet ">
        <label class="fw-bold">Room Primary Floor Covering:</label>
        <select class="grid-picker" name="roomPrimary[]" style="justify-content: flex-start;" multiple required>
            <option value="">Select</option>
            @foreach ($roomPrimary as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->roomPrimary) && in_array($item['name'], json_decode($auction->get->roomPrimary) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    @php
        $room_features = [
            ['name' => 'Bar', 'target' => ''],
            ['name' => 'Bath with Spa/Hydro Massage Tub', 'target' => ''],
            ['name' => 'Bath With Whirlpoo', 'target' => ''],
            ['name' => 'Bidet', 'target' => ''],
            ['name' => 'Breakfast Bar', 'target' => ''],
            ['name' => 'Built-In Shelving', 'target' => ''],
            ['name' => 'Built-In Shower Bench', 'target' => ''],
            ['name' => 'Ceiling Fan(s)', 'target' => ''],
            ['name' => 'Claw Foot Tub', 'target' => ''],
            ['name' => 'Closet Pantry', 'target' => ''],
            ['name' => 'Cooking Island', 'target' => ''],
            ['name' => 'Desk Built-In ', 'target' => ''],
            ['name' => 'Dual Sinks', 'target' => ''],
            ['name' => 'En Suite Bathroom ', 'target' => ''],
            ['name' => 'Exhaust Fan', 'target' => ''],
            ['name' => 'Garden Bath ', 'target' => ''],
            ['name' => 'Granite Counters', 'target' => ''],
            ['name' => 'Handicap Accessible', 'target' => ''],
            ['name' => 'Heated Floors', 'target' => ''],
            ['name' => 'Island', 'target' => ''],
            ['name' => 'Jack and Jill Bathroom', 'target' => ''],
            ['name' => 'Linen Closet Bath', 'target' => ''],
            ['name' => 'Makeup/Vanity Space', 'target' => ''],
            ['name' => 'Multiple Shower Heads', 'target' => ''],
            ['name' => 'Wet Bar', 'target' => ''],
            ['name' => 'Pantry', 'target' => ''],
            ['name' => 'Rain Shower Head', 'target' => ''],
            ['name' => 'Sauna', 'target' => ''],
            ['name' => 'Shower- No Tub', 'target' => ''],
            ['name' => 'Single Vanity', 'target' => ''],
            ['name' => 'Sink-Pedestal ', 'target' => ''],
            ['name' => 'Split Vanities ', 'target' => ''],
            ['name' => 'Steam Shower', 'target' => ''],
            ['name' => 'Stone Counters', 'target' => ''],
            ['name' => 'Sunken Shower', 'target' => ''],
            ['name' => 'Tall Countertops ', 'target' => ''],
            ['name' => 'Tile Counters', 'target' => ''],
            ['name' => 'Tub with Separate Shower Stall ', 'target' => ''],
            ['name' => 'Tub with Shower', 'target' => ''],
            ['name' => 'Urinal', 'target' => ''],
            ['name' => 'Walk-In Pantry', 'target' => ''],
            ['name' => 'Walk-In Tub', 'target' => ''],
            ['name' => 'Water Closet/Priv Toliet', 'target' => ''],
            ['name' => 'Window/Skylight in Bath', 'target' => ''],
            ['name' => 'Other', 'target' => '.roomFeatureOther'],
        ];
    @endphp
    <div class="form-group roomDet ">
        <label class="fw-bold">Room Features:</label>
        <select class="grid-picker" name="room_feature[]" id="room_feature" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($room_features as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->room_feature) && in_array($item['name'], json_decode($auction->get->room_feature) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group roomFeatureOther d-none">
            <label class="fw-bold">Room Features:</label>
            <input type="text" name="roomFeatueOther" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->roomFeatueOther) ? $auction->get->roomFeatueOther : '' }}">
        </div>
    </div> --}}
</div>
<div class="wizard-step" data-step='24'>
    <h4>Water and Dock Information:</h4>
    <div class="form-group ">
        @php
            $waterAccessOption = [
                [
                    'name' => 'Yes',
                    'target' => '.waterAccessYes',
                    'icon' => 'fa-regular fa-circle-check',
                ],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
        @endphp
        <label class="fw-bold">Water Access:</label>
        <select class="grid-picker" name="waterAccessOpt" id="water_access" style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($waterAccessOption as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='{{ $item['icon'] }}'></i>"
                    {{ isset($auction->get->waterAccessOpt) && $item['name'] == $auction->get->waterAccessOpt ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group waterAccessYes d-none ">
        @php
            $water_access = [
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
        <label class="fw-bold">Water Access:</label>
        <select class="grid-picker" name="water_access[]" id="water_access" style="justify-content: flex-start;"
            required multiple>
            <option value="">Select</option>
            @foreach ($water_access as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->water_access) && in_array($item['name'], json_decode($auction->get->water_access) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group ">
        <label class="fw-bold">Water View:</label>
        <select class="grid-picker" name="has_water_view" id="has_water_view" style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($yes_or_nos as $item)
                @php
                    if ($item['name'] == 'Yes') {
                        $target = '.water_view';
                    } else {
                        $target = '';
                    }
                @endphp
                <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->has_water_view) && $item['name'] == $auction->get->has_water_view ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
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
    <div class="form-group water_view d-none">
        <label class="fw-bold">Water View:</label>
        <select class="grid-picker" name="water_view[]" id="water_view" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($water_views as $water_view)
                <option value="{{ $water_view['name'] }}" data-target="{{ $water_view['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->water_view) && in_array($item['name'], json_decode($auction->get->water_view) ?? []) ? 'selected' : '' }}>
                    {{ $water_view['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group ">
        <label class="fw-bold">Water Extras:</label>
        <select class="grid-picker" name="has_water_extra" id="has_water_extra"
            style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($yes_or_nos as $item)
                @php
                    if ($item['name'] == 'Yes') {
                        $target = '.water_extras';
                    } else {
                        $target = '';
                    }
                @endphp
                <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->water_access) && $item['name'] == $auction->get->water_access ? 'selected' : '' }}>
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
    <div class="form-group water_extras d-none ">
        <label class="fw-bold">Water Extras:</label>
        <select class="grid-picker" name="water_extras[]" id="water_extras" style="justify-content: flex-start;"
            multiple>
            <option value="">Select</option>
            @foreach ($water_extras as $water_extra)
                <option value="{{ $water_extra['name'] }}" data-target="{{ $water_extra['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->water_extras) && in_array($item['name'], json_decode($auction->get->water_extras) ?? []) ? 'selected' : '' }}>
                    {{ $water_extra['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group ">
        <label class="fw-bold">Water Frontage:</label>
        <select class="grid-picker" name="has_water_fontage" id="has_water_fontage"
            style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($yes_or_nos as $item)
                @php
                    if ($item['name'] == 'Yes') {
                        $target = '.waterFrontageYes';
                    } else {
                        $target = '';
                    }
                @endphp
                <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->has_water_fontage) && $item['name'] == $auction->get->has_water_fontage ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group waterFrontageYes d-none">
            @php
                $waterFrontageView = [
                    ['name' => 'Bay/Harbor', 'target' => ''],
                    ['name' => 'Bayou', 'target' => ''],
                    ['name' => 'Beach', 'target' => ''],
                    ['name' => 'Brackish Water', 'target' => ''],
                    ['name' => 'Canal - Brackish', 'target' => ''],
                    ['name' => 'Canal - Freshwater', 'target' => ''],
                    ['name' => 'Canal - Saltwater', 'target' => ''],
                    ['name' => 'Canal Front', 'target' => ''],
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
                    ['name' => 'Riparian Rights', 'target' => ''],
                    ['name' => 'River', 'target' => ''],
                ];
            @endphp
            <label class="fw-bold">Water Frontage: </label>
            <select class="grid-picker" name="waterFrontageView[]" style="justify-content: flex-start;" multiple
                required>
                <option value="">Select</option>
                @foreach ($waterFrontageView as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                        {{ isset($auction->get->waterFrontageView) && in_array($item['name'], json_decode($auction->get->waterFrontageView) ?? []) ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group ">
        <label class="fw-bold">Dock:</label>
        <select class="grid-picker" name="has_dock" id="has_dock" style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($yes_or_nos as $item)
                @php
                    if ($item['name'] == 'Yes') {
                        $target = '.dockYes';
                    } else {
                        $target = '';
                    }
                @endphp
                <option value="{{ $item['name'] }}" data-target="{{ $target }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->has_dock) && $item['name'] == $auction->get->has_dock ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group dockYes d-none">
            @php
                $dock = [
                    ['name' => '2 Point Moorage', 'target' => ''],
                    ['name' => '3 Point Moorage', 'target' => ''],
                    ['name' => '4 Point Moorage', 'target' => ''],
                    ['name' => 'CATV', 'target' => ''],
                    ['name' => 'Clubhouse', 'target' => ''],
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
                    ['name' => 'Fish Cleaning Station', 'target' => ''],
                    ['name' => 'Floating Dock', 'target' => ''],
                    ['name' => 'Harbormaster', 'target' => ''],
                    ['name' => 'Internet', 'target' => ''],
                    ['name' => 'Lift', 'target' => ''],
                    ['name' => 'Restroom/Shower', 'target' => ''],
                    ['name' => 'Wet Dock', 'target' => ''],
                    ['name' => 'None', 'target' => ''],
                    ['name' => 'Other', 'target' => '.therDock'],
                ];
            @endphp
            <label class="fw-bold">Dock: </label>
            <select class="grid-picker" name="dock[]" style="justify-content: flex-start;" multiple required>
                <option value="">Select</option>
                @foreach ($dock as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                        {{ isset($auction->get->dock) && in_array($item['name'], json_decode($auction->get->dock) ?? []) ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
            <div class="form-group otherDock d-none">
                <label class="fw-bold">Dock Description:</label>
                <input type="text" name="dockDescription" class="form-control has-icon"
                    data-icon="fa-regular fa-check-circle"
                    value="{{ isset($auction->get->dockDescription) ? $auction->get->dockDescription : '' }}">
            </div>
            <div class="form-group">
                <label class="fw-bold">Dock Lift Capacity:</label>
                <input type="text" name="dockLiftCapacity" class="form-control has-icon"
                    data-icon="fa-regular fa-check-circle"
                    value="{{ isset($auction->get->dockLiftCapacity) ? $auction->get->dockLiftCapacity : '' }}">
            </div>
            <div class="form-group">
                <label class="fw-bold">Dock Year Built:</label>
                <input type="text" name="dockYearBuilt" class="form-control has-icon"
                    data-icon="fa-regular fa-check-circle"
                    value="{{ isset($auction->get->dockYearBuilt) ? $auction->get->dockYearBuilt : '' }}">
            </div>
            <div class="form-group">
                <label class="fw-bold">Dock Dimension:</label>
                <input type="text" name="dockDimension" class="form-control has-icon"
                    data-icon="fa-regular fa-check-circle"
                    value="{{ isset($auction->get->dockDimension) ? $auction->get->dockDimension : '' }}">
            </div>
            <div class="form-group">
                <label class="fw-bold">Dock Maintenance Fee:</label>
                <input type="text" name="dockMaintenanceFee" class="form-control has-icon"
                    data-icon="fa-regular fa-check-circle"
                    value="{{ isset($auction->get->dockMaintenanceFee) ? $auction->get->dockMaintenanceFee : '' }}">
            </div>
            @php
                $dock = [
                    ['name' => 'Annual', 'target' => ''],
                    ['name' => 'Monthly', 'target' => ''],
                    ['name' => 'Quarterly', 'target' => ''],
                    ['name' => 'N/A', 'target' => ''],
                ];
            @endphp
            <label class="fw-bold">Dock Maintenance Fee Frequency:</label>
            <select class="grid-picker" name="dockMaintenanceFeeFrequency" style="justify-content: flex-start;"
                multiple required>
                <option value="">Select</option>
                @foreach ($dock as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                        {{ isset($auction->get->dockMaintenanceFeeFrequency) && $item['name'] == $auction->get->dockMaintenanceFeeFrequency ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="wizard-step" data-step='25'>
    @php
        $utilities = [
            ['name' => 'BB/HS Internet Available', 'target' => ''],
            ['name' => 'Cable Available', 'target' => ''],
            ['name' => 'Cable Connected', 'target' => ''],
            ['name' => 'Electric - Multiple Meters', 'target' => ''],
            ['name' => 'Electricity Available', 'target' => ''],
            ['name' => 'Electricity Connected', 'target' => ''],
            ['name' => 'Emergency Power', 'target' => ''],
            ['name' => 'Fiber Optics', 'target' => ''],
            ['name' => 'Fire Hydrant', 'target' => ''],
            ['name' => 'Mini Sewer', 'target' => ''],
            ['name' => 'Natural Gas Available', 'target' => ''],
            ['name' => 'Natural Gas Connected', 'target' => ''],
            ['name' => 'Phone Available', 'target' => ''],
            ['name' => 'Private', 'target' => ''],
            ['name' => 'Propane', 'target' => ''],
            ['name' => 'Public', 'target' => ''],
            ['name' => 'Sewer Available', 'target' => ''],
            ['name' => 'Sewer Connected', 'target' => ''],
            ['name' => 'Solar', 'target' => ''],
            ['name' => 'Sprinkler Meter', 'target' => ''],
            ['name' => 'Sprinkler Recycled', 'target' => ''],
            ['name' => 'Sprinkler Well', 'target' => ''],
            ['name' => 'Street Lights', 'target' => ''],
            ['name' => 'Underground Utilities', 'target' => ''],
            ['name' => 'Water - Multiple Meters', 'target' => ''],
            ['name' => 'Water Available', 'target' => ''],
            ['name' => 'Water Connected', 'target' => ''],
            ['name' => 'None', 'target' => ''],
            ['name' => 'Other', 'target' => '.otherUtilitiesRes'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Utilities:</label>
        <select class="grid-picker" name="utilities[]" id="utilities" style="justify-content: flex-start;" multiple
            required>
            <option value="">Select</option>
            @foreach ($utilities as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->utilities) && in_array($item['name'], json_decode($auction->get->utilities) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherUtilitiesRes d-none">
            <label for="" class="fw-bold">Utilities: </label>
            <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                name="otherUtilities"
                value="{{ isset($auction->get->otherUtilities) ? $auction->get->otherUtilities : '' }}">
        </div>
    </div>
    @php
        $waters = [
            ['name' => 'Canal/Lake For Irrigation', 'target' => ''],
            ['name' => 'Private', 'target' => ''],
            ['name' => 'Public', 'target' => ''],
            ['name' => 'Well', 'target' => ''],
            ['name' => 'None', 'target' => ''],
            ['name' => 'Other', 'target' => '.otherWaterRes'],
        ];
    @endphp
    <div class="form-group">
        <label class="fw-bold">Water:</label>
        <select class="grid-picker" name="water[]" id="water12" style="justify-content: flex-start;" multiple
            required>
            <option value="">Select</option>
            @foreach ($waters as $water)
                <option value="{{ $water['name'] }}" data-target="{{ $water['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->water) && in_array($item['name'], json_decode($auction->get->water) ?? []) ? 'selected' : '' }}>
                    {{ $water['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherWaterRes d-none">
            <label for="" class="fw-bold">Water: </label>
            <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                name="otherWater" value="{{ isset($auction->get->otherWater) ? $auction->get->otherWater : '' }}">
        </div>
    </div>

    @php
        $sewers1 = [
            ['name' => 'Aerobic Septic', 'target' => ''],
            ['name' => 'PEP-Holding Tank', 'target' => ''],
            ['name' => 'Private Sewer', 'target' => ''],
            ['name' => 'Public Sewer', 'target' => ''],
            ['name' => ' Septic Tank', 'target' => ''],
            ['name' => ' None', 'target' => ''],
            ['name' => 'Other', 'target' => '.otherSewerRes'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Sewer:</label>
        <select class="grid-picker" name="sewer[]" id="sewer" style="justify-content: flex-start;" multiple
            required>
            <option value="">Select</option>
            @foreach ($sewers1 as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->sewer) && in_array($item['name'], json_decode($auction->get->sewer) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherSewerRes d-none">
            <label for="" class="fw-bold">Sewer: </label>
            <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                name="otherSewer" value="{{ isset($auction->get->otherSewer) ? $auction->get->otherSewer : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='26'>
    <div class="form-group ">
        @php
            $airConditioning = [
                ['name' => 'Central Air', 'target' => ''],
                ['name' => 'Humidity Control', 'target' => ''],
                ['name' => 'Mini-Split Unit(s)', 'target' => ''],
                ['name' => 'Wall/Window Unit(s)', 'target' => ''],
                ['name' => 'Zoned', 'target' => ''],
                ['name' => 'None', 'target' => ''],
                ['name' => 'Other', 'target' => '.otherAirConditionRes'],
            ];
        @endphp
        <label class="fw-bold">Air Conditioning: </label>
        <select class="grid-picker" name="airConditioning[]" id="utilities" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($airConditioning as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->airConditioning) && in_array($item['name'], json_decode($auction->get->airConditioning) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherAirConditionRes d-none">
            <label for="" class="fw-bold"> Air Conditioning: </label>
            <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                name="otherAirCondition"
                value="{{ isset($auction->get->otherAirCondition) ? $auction->get->otherAirCondition : '' }}">
        </div>
    </div>
    <div class="form-group ">
        @php
            $heatingFuel = [
                ['name' => 'Baseboard', 'target' => ''],
                ['name' => 'Central', 'target' => ''],
                ['name' => 'Electric', 'target' => ''],
                ['name' => 'Exhaust Fans', 'target' => ''],
                ['name' => 'Heat Pump', 'target' => ''],
                ['name' => 'Heat Recovery Unit', 'target' => ''],
                ['name' => 'Natural Gas', 'target' => ''],
                ['name' => 'Oil', 'target' => ''],
                ['name' => 'Partial', 'target' => ''],
                ['name' => 'Propane', 'target' => ''],
                ['name' => 'Radiant Ceiling', 'target' => ''],
                ['name' => 'Reverse Cycle', 'target' => ''],
                ['name' => 'Solar', 'target' => ''],
                ['name' => 'Space Heater', 'target' => ''],
                ['name' => 'Wall Furnace', 'target' => ''],
                ['name' => 'Wall Units / Window Unit', 'target' => ''],
                ['name' => 'Zoned', 'target' => ''],
                ['name' => 'None', 'target' => ''],
                ['name' => 'Other', 'target' => '.otherFuelRes'],
            ];
        @endphp
        <label class="fw-bold">Heating and Fuel: </label>
        <select class="grid-picker" name="heatingFuel[]" id="utilities" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($heatingFuel as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->heatingFuel) && in_array($item['name'], json_decode($auction->get->heatingFuel) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherFuelRes d-none">
            <label for="" class="fw-bold"> Heating and Fuel: </label>
            <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                name="otherFuel" value="{{ isset($auction->get->otherFuel) ? $auction->get->otherFuel : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='27'>
    <div class="form-group ">
        @php
            $carportOption = [
                [
                    'name' => 'Yes',
                    'target' => '.carprotYes',
                    'icon' => 'fa-regular fa-circle-check',
                ],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
        @endphp
        <label class="fw-bold">Carport:</label>
        <select class="grid-picker" name="carport" id="carport" style="justify-content: flex-start;" required>
            <option value="">Select</option>
            @foreach ($carportOption as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->carport) && $item['name'] == $auction->get->carport ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group carprotYes d-none">
            <label class="fw-bold">How many carport spaces?</label>
            <input type="number" name="carportOther" id="condo_fee" class="form-control has-icon"
                data-icon="fa-solid fa-warehouse"
                value="{{ isset($auction->get->carportOther) ? $auction->get->carportOther : '' }}">
        </div>
    </div>
    <div class="form-group ">
        @php
            $garageOption = [
                ['name' => 'Yes', 'target' => '.garageYes', 'icon' => 'fa-regular fa-circle-check'],
                ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
            ];
        @endphp
        <label class="fw-bold">Garage:</label>
        <select class="grid-picker" name="garage" id="garage" style="justify-content: flex-start;" required>
            <option value="">Select</option>
            @foreach ($garageOption as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->garage) && $item['name'] == $auction->get->garage ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group garageYes d-none">
            <label class="fw-bold">How many garage spaces?</label>
            <input type="number" name="garageOther" class="form-control has-icon" data-icon="fa-solid fa-warehouse"
                value="{{ isset($auction->get->garageOther) ? $auction->get->garageOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='28'>

    <div class="form-group ">
        <div class="form-group">
            @php
                $poolOpt = [
                    ['name' => 'Yes', 'target' => '.poolYesRes', 'icon' => 'fa-regular fa-circle-check'],
                    ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                ];
            @endphp
            <label class="fw-bold">Pool:</label>
            <select class="grid-picker" name="poolOpt" id="pool" style="justify-content: flex-start;" required>
                <option value="">Select</option>
                @foreach ($poolOpt as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                        {{ isset($auction->get->poolOpt) && $item['name'] == $auction->get->poolOpt ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
            <div class="form-group poolYesRes d-none">
                @php
                    $pools = [
                        ['name' => 'Private', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                        ['name' => 'Community', 'target' => '', 'icon' => 'fa-regular fa-circle-check'],
                    ];
                @endphp
                <label class="fw-bold">Pool Type:</label>
                <select class="grid-picker" name="pool" id="pool" style="justify-content: flex-start;"
                    required>
                    <option value="">Select</option>
                    @foreach ($pools as $item)
                        <option value="{{ $item['name'] }}" data-target="{{ $target }}"
                            class="card flex-row" style="width:calc(33.3% - 10px);"
                            data-icon='<i class="{{ $item['icon'] }}"></i>'
                            {{ isset($auction->get->pool) && $item['name'] == $auction->get->pool ? 'selected' : '' }}>
                            {{ $item['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group ">
            @php
                $viewOption = [
                    [
                        'name' => 'Yes',
                        'target' => '.viewYes',
                        'icon' => 'fa-regular fa-circle-check',
                    ],
                    ['name' => 'No', 'target' => '', 'icon' => 'fa-regular fa-circle-xmark'],
                ];
            @endphp
            <label class="fw-bold">View:</label>
            <select class="grid-picker" name="viewOption[]" style="justify-content: flex-start;">
                <option value="">Select</option>
                @foreach ($viewOption as $item)
                    <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                        style="width:calc(33.3% - 10px);" data-icon="<i class='{{ $item['icon'] }}'></i>"
                        {{ isset($auction->get->viewOption) && in_array($item['name'], json_decode($auction->get->viewOption) ?? []) ? 'selected' : '' }}>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
            <div class="form-group viewYes d-none">
                @php
                    $view = [
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
                        ['name' => 'Beach', 'target' => ''],
                        ['name' => 'Other', 'target' => '.viewOther'],
                    ];
                @endphp
                <label class="fw-bold">View: </label>
                <select class="grid-picker" name="view[]" id="water_access" style="justify-content: flex-start;"
                    multiple required>
                    <option value="">Select</option>
                    @foreach ($view as $item)
                        <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}"
                            class="card flex-row" style="width:calc(33.3% - 10px);"
                            data-icon="<i class='fa-regular fa-circle-check'></i>"
                            {{ isset($auction->get->view) && in_array($item['name'], json_decode($auction->get->view) ?? []) ? 'selected' : '' }}>
                            {{ $item['name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="form-group viewOther d-none">
                    <label for="" class="fw-bold">View: </label>
                    <input type="text" class="form-control has-icon" data-icon="fa-regular fa-check-circle"
                        name="viewOther"
                        value="{{ isset($auction->get->viewOther) ? $auction->get->viewOther : '' }}">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="wizard-step" data-step='29'>
    @php
        $garage_spaces = [
            ['target' => '', 'name' => '1 to 5 Spaces', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => '6 to 12 Spaces', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => '13 to 18 Spaces', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => '19 to 30 Spaces', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Airplane Hangar', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Common', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Curb Parking', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Deeded', 'icon' => 'fa-solid fa-warehouse'],
            [
                'target' => '',
                'name' => 'Electric Vehicle Charging Station(s)',
                'icon' => 'fa-solid fa-warehouse',
            ],
            ['target' => '', 'name' => 'Ground Level', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Lighted', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'None', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Over 30 Spaces', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Secured', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Under Building', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Underground', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'Valet', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '', 'name' => 'None', 'icon' => 'fa-solid fa-warehouse'],
            ['target' => '.otherParkingCommercial', 'name' => 'Other', 'icon' => 'fa-solid fa-warehouse'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Garage/Parking Features:</label>
        <select class="grid-picker" name="parking_feature_garage[]" id="parking_feature_garage"
            style="justify-content: flex-start;" required multiple>
            <option value="">Select</option>
            @foreach ($garage_spaces as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon='<i class="{{ $item['icon'] }}"></i>'
                    {{ isset($auction->get->parking_feature_garage) && in_array($item['name'], json_decode($auction->get->parking_feature_garage) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group otherParkingCommercial d-none">
            <label class="fw-bold">Garage/Parking Features: </label>
            <input type="text" name="otherParking" class="form-control has-icon"
                data-icon="fa-solid fa-warehouse"
                value="{{ isset($auction->get->otherParking) ? $auction->get->otherParking : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='30'>
    @php
        $front_exposures = [
            ['name' => 'North', 'target' => ''],
            ['name' => 'East', 'target' => ''],
            ['name' => 'South', 'target' => ''],
            ['name' => 'West', 'target' => ''],
            ['name' => 'Southeast', 'target' => ''],
            ['name' => 'Northeast', 'target' => ''],
            ['name' => 'Southwest', 'target' => ''],
            ['name' => 'Northwest', 'target' => ''],
            ['name' => 'Undetermined', 'target' => ''],
        ];
    @endphp
    <div class="form-group residential_and_income_hide">
        <label class="fw-bold">Front Exposure:</label>
        <select class="grid-picker" name="front_exposure" id="front_exposure" style="justify-content: flex-start;">
            <option value="">Select</option>
            @foreach ($front_exposures as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->front_exposure) && $item['name'] == $auction->get->front_exposure ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="wizard-step" data-step='31'>
    @php
        $foundations = [
            ['name' => 'Basement', 'target' => ''],
            ['name' => 'Block', 'target' => ''],
            ['name' => 'Brick/Mortar', 'target' => ''],
            ['name' => 'Concrete Perimeter', 'target' => ''],
            ['name' => 'Crawlspace', 'target' => ''],
            ['name' => 'Pillar/Post/Pier', 'target' => ''],
            ['name' => 'Slab', 'target' => ''],
            ['name' => 'Stem Wall', 'target' => ''],
            ['name' => 'Stilt/On Piling', 'target' => ''],
            ['name' => 'Other', 'target' => '.foundationOther'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Foundation:</label>
        <select class="grid-picker" name="foundation[]" id="foundation" style="justify-content: flex-start;"
            multiple required>
            <option value="">Select</option>
            @foreach ($foundations as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->foundation) && in_array($item['name'], json_decode($auction->get->foundation) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group foundationOther d-none">
            <label class="fw-bold">Foundation: </label>
            <input type="text" name="foundationOther" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->foundationOther) ? $auction->get->foundationOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='32'>
    @php
        $exterior_constructions = [
            ['name' => 'Asbestos', 'target' => ''],
            ['name' => 'Block', 'target' => ''],
            ['name' => 'Brick', 'target' => ''],
            ['name' => 'Cedar', 'target' => ''],
            ['name' => 'Cement Siding', 'target' => ''],
            ['name' => 'Concrete', 'target' => ''],
            ['name' => 'HardiPlank Type', 'target' => ''],
            ['name' => 'ICFs (Insulated Concrete Forms)', 'target' => ''],
            ['name' => 'Log', 'target' => ''],
            ['name' => 'Metal Frame', 'target' => ''],
            ['name' => 'Metal Siding', 'target' => ''],
            ['name' => 'SIP (Structurally Insulated Panel)', 'target' => ''],
            ['name' => 'Stone', 'target' => ''],
            ['name' => 'Stucco', 'target' => ''],
            ['name' => 'Tilt up Walls', 'target' => ''],
            ['name' => 'Vinyl Siding', 'target' => ''],
            ['name' => 'Wood Frame', 'target' => ''],
            ['name' => 'Wood Frame (FSC)', 'target' => ''],
            ['name' => 'Wood Siding ', 'target' => ''],
            ['name' => 'Other', 'target' => '.exteriorOther'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Exterior Construction:</label>
        <select class="grid-picker" name="exterior_construction[]" id="exterior_construction"
            style="justify-content: flex-start;" multiple>
            <option value="">Select</option>
            @foreach ($exterior_constructions as $item)
                <option value="{{ $item['name'] }}" data-target="{{ $item['target'] }}" class="card flex-row"
                    style="width:calc(33.3% - 10px);" data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->exterior_construction) && in_array($item['name'], json_decode($auction->get->exterior_construction) ?? []) ? 'selected' : '' }}>
                    {{ $item['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group exteriorOther d-none">
            <label class="fw-bold">Exterior Construction: </label>
            <input type="text" name="exteriorOther" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->exteriorOther) ? $auction->get->exteriorOther : '' }}">
        </div>
    </div>
</div>
<div class="wizard-step" data-step='33'>
    @php
        $exterior_features = [
            ['name' => 'Awning(s)', 'target' => ''],
            ['name' => 'Balcony', 'target' => ''],
            ['name' => 'Courtyard', 'target' => ''],
            ['name' => 'Dog Run', 'target' => ''],
            ['name' => 'French Doors', 'target' => ''],
            ['name' => 'Garden', 'target' => ''],
            ['name' => 'Gray Water System', 'target' => ''],
            ['name' => 'Hurricane Shutters', 'target' => ''],
            ['name' => 'Irrigation System', 'target' => ''],
            ['name' => 'Lighting', 'target' => ''],
            ['name' => 'Outdoor Grill', 'target' => ''],
            ['name' => 'Outdoor Kitchen', 'target' => ''],
            ['name' => 'Outdoor Shower', 'target' => ''],
            ['name' => 'Private Mailbox', 'target' => ''],
            ['name' => 'Rain Barrel/Cistern(s)', 'target' => ''],
            ['name' => 'Rain Gutters', 'target' => ''],
            ['name' => 'Sauna', 'target' => ''],
            ['name' => 'Shade Shutter(s)', 'target' => ''],
            ['name' => 'Sidewalk', 'target' => ''],
            ['name' => 'Sliding Doors', 'target' => ''],
            ['name' => 'Sprinkler Metered', 'target' => ''],
            ['name' => 'Storage', 'target' => ''],
            ['name' => 'Tennis Court(s)', 'target' => ''],
            ['name' => 'Other', 'target' => '.exteriorFeatureOther'],
        ];
    @endphp
    <div class="form-group ">
        <label class="fw-bold">Exterior Features:</label>
        <select class="grid-picker" name="exterior_feature[]" id="exterior_feature"
            style="justify-content: flex-start;" multiple>
            <option value="">Select</option>
            @foreach ($exterior_features as $exterior_feature)
                <option value="{{ $exterior_feature['name'] }}" data-target="{{ $exterior_feature['target'] }}"
                    class="card flex-row" style="width:calc(33.3% - 10px);"
                    data-icon="<i class='fa-regular fa-circle-check'></i>"
                    {{ isset($auction->get->exterior_feature) && in_array($item['name'], json_decode($auction->get->exterior_feature) ?? []) ? 'selected' : '' }}>
                    {{ $exterior_feature['name'] }}
                </option>
            @endforeach
        </select>
        <div class="form-group exteriorFeatureOther d-none">
            <label class="fw-bold">Exterior Features: </label>
            <input type="text" name="exteriorFeatureOther" class="form-control has-icon"
                data-icon="fa-regular fa-check-circle"
                value="{{ isset($auction->get->exteriorFeatureOther) ? $auction->get->exteriorFeatureOther : '' }}">
        </div>
    </div>
</div>
