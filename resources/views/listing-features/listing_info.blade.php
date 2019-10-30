{!! HTML::style('assets/css/datepicker.min.css') !!}
{!! HTML::script('assets/js/datepicker.min.js') !!}
{!! HTML::script('assets/js/datepicker.en.js') !!}
<div class="col-md-6">
    <div class="form-group">
        <label>Street Address</label>
        {!! Form::text('street_address', null,
        [
            ($action == 'Update') ? 'readonly' : '',
            'id'           => ($action !== 'Update') ? 'controls' : '',
            'class'        => 'controls input-style',
            'autocomplete' => 'off'
        ]) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('street_address') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Display Address</label>
        {!! Form::text('display_address', null,
        [
            ($action == 'Update') ? 'readonly' : '',
            'id'    => 'autofill',
            'class' => 'input-style',
        ]) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('display_address') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Neighborhood</label>
        {!! Form::select('neighborhood_id', neighborhoods(), null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('neighborhood') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Bedrooms</label>
        {!! Form::text('bedrooms', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('bedrooms') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Bathrooms</label>
        {!! Form::text('baths', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('baths') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Unit</label>
        {!! Form::text('unit', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('unit') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Rent</label>
        {!! Form::text('rent', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('rent') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Square Feet</label>
        {!! Form::text('square_feet', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
            {!! $errors->first('square_feet') !!}
        </span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Application Fee</label>
        {!! Form::text('application_fee', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('application_fee') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Deposit</label>
        {!! Form::text('deposit', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
            {!! $errors->first('deposit') !!}
        </span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Availability</label>
        {!! Form::select('availability', config('formfields.listing.availability'), null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('available') !!}
		</span>
    </div>
</div>
<div class="col-md-6 availability-date" style="display: none;">
    <div class="form-group">
        <label>Select Availability Date</label>
        {!! Form::text('availability_date', null,
            [
                'autocomplete' => 'off',
                'class' => 'input-style',
                'id' => 'availability_date',
                'data-language' => 'en'
            ]) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('availability_date') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Listing Type</label>
        {!! Form::select('building_type',
        [
            ''          => 'Select Type',
            'open'      => 'Open',
            'exclusive' => 'Exclusive'
        ], null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
            {!! $errors->first('building_type') !!}
		</span>
    </div>
</div>
{{--Open House--}}
@include('listing-features.open_house')
<div class="row">
<div class="col-md-6">
    <div class="choose-cover">
        <img class="img-thumbnail" src="{{isset($listing->thumbnail) ? asset($listing->thumbnail ?? DLI ) : ''}}" id="img" style="{{($action == 'Update' || $action == 'Copy') ? '' : ''}}">
        <div class="box">
            {!! Form::file('thumbnail',['class' => 'inputfile inputfile-3', 'id' => 'file-3']) !!}
            <label for="file-3" id="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                </svg>
                <span>Choose a Cover&hellip;</span>
            </label>
        </div>
        @if(isset($listing->thumbnail))
            {!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
        @endif

    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label>Description</label>
        {!! Form::textarea('description', null, ['class' => 'text-area', 'style' => 'resize:none;']) !!}
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('description') !!}
		</span>
    </div>
</div>
