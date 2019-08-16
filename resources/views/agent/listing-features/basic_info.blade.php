

<div class="col-md-6">
	<div class="form-group">
		<label>Your Name </label>
		{!! Form::text('name', mySelf()->first_name, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('name') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Phone Number</label>
		{!! Form::text('phone_number', mySelf()->phone_number ?? null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('phone_number') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Email </label>
		{!! Form::text('email', mySelf()->email, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('email') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Website</label>
		{!! Form::text('url', null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('website') !!}
		</span>
	</div>
</div>
{!! Form::hidden('map_location', null) !!}
{!! Form::hidden('visibility', 2) !!}
