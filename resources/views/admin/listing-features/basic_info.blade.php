

<div class="col-md-6">
	<div class="form-group">
		<label>Your Name </label>
		{!! Form::text('name', null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('name') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Phone Number</label>
		{!! Form::text('phone_number', null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('phone_number') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Email </label>
		{!! Form::text('email', null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('email') !!}
		</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Website</label>
		{!! Form::text('website', null, ['class' => 'input-style']) !!}
		<span class="invalid-feedback" role="alert">
			{!! $errors->first('website') !!}
		</span>
	</div>
</div>
{!! Form::hidden('status', 1) !!}