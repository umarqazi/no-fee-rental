
				<div class="col-md-6">
					<div class="form-group">
						<label>Street Address</label>
						{!! Form::text('street_address', null, ['class' => 'input-style']) !!}
						<span class="mt-2 d-block">* The street address is not shown, and is used for your reference</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>City, State, Zip code</label>
						{!! Form::text('city_state_zip', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Display Address</label>
						{!! Form::text('display_address', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Neighborhood</label>
						{!! Form::text('neighborhood', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Bedrooms</label>
						{!! Form::number('bedrooms', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Bathrooms</label>
						{!! Form::number('baths', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Unit</label>
						{!! Form::number('unit', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Rent</label>
						{!! Form::number('rent', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Square Feet</label>
						{!! Form::number('square_feet', null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Availble</label>
						{!! Form::select('available', ['' => 'Select Availability', '1' => 'Available', '0' => 'Not Available'], null, ['class' => 'input-style']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group" id="file">
						<label>Add Cover Photo</label>
						{!! Form::file('thumbnail', ['id' => 'upload-file', 'class' => 'form-control', 'name' => 'thumbnail']) !!}
					</div>
						@if(isset($listing->thumbnail))
							{!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
						@endif
					<img src="{{($edit && isset($listing->thumbnail)) ? asset('uploads/listing/thumbnails/'.$listing->thumbnail) : ''}}" id="img" style="{{($edit) ? 'width: 180px;height: 145px;margin-bottom: 15px;' : ''}}">
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						{!! Form::textarea('description', null, ['class' => 'text-area', 'style' => 'resize:none;']) !!}
					</div>
				</div>