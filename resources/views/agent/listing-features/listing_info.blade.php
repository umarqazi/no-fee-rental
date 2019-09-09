
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<div class="col-md-6">
    <div class="form-group">
        <label>Street Address</label>
        {!! Form::text('street_address', null, ['id' => 'controls', 'class' => 'controls input-style', 'autocomplete' => 'off']) !!}
        <span class="mt-2 d-block">* The street address is not shown, and is used for your reference</span>
        <span class="invalid-feedback" role="alert">
			{!! $errors->first('street_address') !!}
		</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>City, State, Zip code</label>
        {!! Form::text('city_state_zip', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
							{!! $errors->first('city_state_zip') !!}
						</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Display Address</label>
        {!! Form::text('display_address', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
							{!! $errors->first('display_address') !!}
						</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Neighborhood</label>
        {!! Form::text('neighborhood', null, ['class' => 'input-style']) !!}
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
        {!! Form::number('square_feet', null, ['class' => 'input-style']) !!}
        <span class="invalid-feedback" role="alert">
            {!! $errors->first('square_feet') !!}
        </span>
	</div>
</div>
				<div class="col-md-6">
					<div class="form-group">
                        <label>Open House</label>
                        {!! Form::text('open_house', null, ['class' => 'input-style', 'id' => 'timepicker-actions-exmpl']) !!}
                        <span class="invalid-feedback" role="alert">
							{!! $errors->first('available') !!}
						</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Availability</label>
                        {!! Form::select('availability', ['' => 'Select', '1' => 'Available', '2' => 'Not Available'], null, ['class' => 'input-style']) !!}
                        <span class="invalid-feedback" role="alert">
							{!! $errors->first('available') !!}
						</span>
                    </div>
                </div>
                <div class="col-md-6"></div>
				<div class="col-md-6">
                    <div class="box">
                        {!! Form::file('thumbnail', ['class' => 'inputfile inputfile-3', 'id' => 'file-3']) !!}
                        <label for="file-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                            </svg>
                            <span>Choose a Cover&hellip;</span>
                        </label>
                    </div>
                    <span class="invalid-feedback" role="alert">
                        {!! $errors->first('thumbnail') !!}
                    </span>
                    @if(isset($listing->thumbnail))
                        {!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
                    @endif
					<img class="img-thumbnail" src="{{($edit && isset($listing->thumbnail)) ? asset('storage/'.$listing->thumbnail) : ''}}" id="img" style="{{($edit) ? 'width: 180px;height: 145px;margin-bottom: 15px;' : ''}}">
				</div>
                <div class="col-md-6"></div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						{!! Form::textarea('description', null, ['class' => 'text-area', 'style' => 'resize:none;']) !!}
						<span class="invalid-feedback" role="alert">
							{!! $errors->first('description') !!}
						</span>
    </div>
</div>
