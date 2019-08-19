
				<div class="col-md-6">
					<div class="form-group">
						<label>Street Address</label>
						{!! Form::text('street_address', null, ['id' => 'controls', 'class' => 'controls input-style']) !!}
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
						<label>Availble</label>
						{!! Form::select('available', ['' => 'Select Availability', '1' => 'Available', '0' => 'Not Available'], null, ['class' => 'input-style']) !!}
						<span class="invalid-feedback" role="alert">
							{!! $errors->first('available') !!}
						</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group" id="file">
						<label>Add Cover Photo</label>
						{!! Form::file('thumbnail', ['id' => 'upload-file', 'class' => 'form-control', 'name' => 'thumbnail']) !!}
						<span class="invalid-feedback" role="alert">
							{!! $errors->first('thumbnail') !!}
						</span>
					</div>
						@if(isset($listing->thumbnail))
							{!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
						@endif
					<img class="img-thumbnail" src="{{($action == 'Update' && isset($listing->thumbnail)) ? asset('storage/'.$listing->thumbnail) : ''}}" id="img" style="{{($action == 'Update') ? 'width: 180px;height: 145px;margin-bottom: 15px;' : ''}}">
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
