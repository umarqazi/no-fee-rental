

<div class="col-md-4">
	<div class="form-group">
		<label>Your Name </label>
		{!! Form::text('name', $listing->name ?? mySelf()->first_name, ['class' => 'input-style','readonly' =>
		true]) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('name') !!}
		</span>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label>Phone Number</label>
		{!! Form::text('phone_number', $listing->phone_number ?? mySelf()->phone_number ?? null, ['class' => 'input-style','readonly' =>
		true]) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('phone_number') !!}
		</span>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label>Email </label>
		{!! Form::text('email', $listing->email ?? mySelf()->email, ['class' => 'input-style','readonly' =>
		true]) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('email') !!}
		</span>
	</div>
</div>
{!! Form::hidden('map_location', null) !!}
