{!! HTML::style('assets/css/datepicker.min.css') !!}
{!! HTML::script('assets/js/datepicker.min.js') !!}
{!! HTML::script('assets/js/datepicker.en.js') !!}
<div class="col-md-6">
    <div class="form-group" id="address">
        <label>Street Address</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Display Address</label>
        {!! Form::text('display_address', null,
        [
            ($action == 'Update') ? 'readonly' : '',
            'id'    => 'autofill',
            'readonly' => 'readonly',
            'class' => 'input-style',
        ]) !!}
    </div>
</div>
<div class="col-md-12 col-lg-12 col-xl-6">
    <div class="neighborhood-flex">
        <div class="form-group">
            <label>Neighborhood</label>
            {!! Form::text('neighborhood', null, ['class' => 'input-style', 'readonly']) !!}
        </div>
        <div class="form-group">
            <label>Renter Rebate</label>
            {!! Form::text('renter_rebate', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            <label>Rent</label>
            {!! Form::text('rent', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-12 col-xl-6">
    <div class="unit-flex">
        <div class="form-group">
            <label>Unit</label>
            {!! Form::text('unit', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            <label>Bedrooms</label>
            {!! Form::select('bedrooms', config('formfields.listing.beds'), null, ['class' => 'input-style']) !!}
        </div>
        <div class="form-group">
            <label>Bathrooms</label>
            {!! Form::select('baths', config('formfields.listing.baths'), null, ['class' => 'input-style']) !!}
        </div>
        <div class="form-group by-add-only-chkbox">
            <div class="custom-control custom-checkbox by-add-only">
                {!! Form::checkbox('is_convertible', null,
                    (isset($listing->is_convertible) && ($listing->is_convertible == true)) ? true : false,
                    ['class' => "custom-control-input", 'id' => 'convertible'])
                !!}
                <label class="custom-control-label" for="convertible"> Convertible</label>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-lg-12 col-xl-6">
    <div class="unit-flex">
        <div class="form-group">
            <label>Square Feet</label>
            {!! Form::text('square_feet', null, ['pattern' => '\d*', 'maxlength' => '4', 'class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            <label>Free Months</label>
            {!! Form::text('free_months', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            <label>Application Fee</label>
            {!! Form::text('application_fee', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-12 col-xl-6">
    <div class="availability-flex">
        <div class="form-group">
            <label>Deposit</label>
            {!! Form::text('deposit', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            <label>Lease Term</label>
            {!! Form::select('lease_term', config('formfields.listing.free_months'), null, ['class' => 'input-style']) !!}
        </div>
        @if(!isOwner())
            <div class="form-group">
                <label>Listing Type</label>
                {!! Form::select('listing_type', config('formfields.listing.listing_type'), null, ['class' => 'input-style']) !!}
            </div>
        @endif
    </div>
</div>
<div class="col-md-12 col-lg-6 col-xl-6">
    <div class="availability-flex">
        <div class="form-group">
            <label>Availability</label>
            {!! Form::select('availability_type', config('formfields.listing.availability'), null, ['class' => 'input-style']) !!}
        </div>
        <div class="form-group availability-date" style="display: {{ isset($listing) && $listing->availability_type === 2 ? 'block' : 'none' }};">
            <label>Select Availability Date</label>
            {!! Form::text('availability', null,
                [
                    'data-date-format' => 'yyyy-mm-dd',
                    'autocomplete' => 'off',
                    'class' => 'input-style',
                    'id' => 'availability_date',
                    'data-language' => 'en'
                ]
            ) !!}
        </div>
    </div>
</div>
{{--Open House--}}
@include('listing-features.open_house')
<div class="row">
    <div class="col-md-6">
        <div class="choose-cover">
            <img class="img-thumbnail" src="{{ is_realty_listing($listing->thumbnail ?? DLI) }}" id="img" style="{{($action == 'Update' || $action == 'Copy') ? '' : ''}}">
            <div class="box">
                {!! Form::file('thumbnail',['class' => 'inputfile inputfile-3', 'id' => 'file-3']) !!}
                <label for="file-3" id="error-message">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                    </svg>
                    <span>Choose a Cover&hellip;</span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('description', null, ['class' => 'text-area', 'style' => 'resize:none;']) !!}
        </div>
    </div>
</div>