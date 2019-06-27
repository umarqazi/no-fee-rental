@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Listings</h1>
			</div>
			<div class="block add-new-listing-wrapper">
				<div class="block-body">
					{!! Form::model($listing, ['url' => route('agent.createListing'), 'id' => 'listing_form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
					<div class="row">
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
								{!! Form::text('bedrooms', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Bathrooms</label>
								{!! Form::text('baths', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Unit</label>
								{!! Form::text('unit', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Rent</label>
								{!! Form::text('rent', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Square Feet</label>
								{!! Form::text('square_feet', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Availble</label>
								{!! Form::text('available', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								{!! Form::textarea('description', null, ['class' => 'text-area', 'style' => 'resize:none;']) !!}
							</div>
						</div>

						<div class="col-md-6">
							<h3>Listing Type</h3>
							<ul class="checkbox-listing">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('listing_type[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem1']) !!}
										<label class="custom-control-label" for="listitem1">By Owner</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('listing_type[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem2']) !!}
										<label class="custom-control-label" for="listitem2">Exclusive</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('listing_type[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem3']) !!}
										<label class="custom-control-label" for="listitem3">No Fee</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('listing_type[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem4']) !!}
										<label class="custom-control-label" for="listitem4">Exclusive</label>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-md-6">
							<h3>Pet Policy</h3>
							<ul class="checkbox-listing">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('pet_policy[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem5']) !!}
										<label class="custom-control-label" for="listitem5">Cats Allowed</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('pet_policy[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem6']) !!}
										<label class="custom-control-label" for="listitem6">Dogs Allowed</label>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-md-6">
							<h3>Unit Features</h3>
							<ul class="checkbox-listing">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('unit_feature[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem7']) !!}
										<label class="custom-control-label" for="listitem7">Furnished</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('unit_feature[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem8']) !!}
										<label class="custom-control-label" for="listitem8">Laundry In Unit</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('unit_feature[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem9']) !!}
										<label class="custom-control-label" for="listitem9">Parking Space</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('unit_feature[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem10']) !!}
										<label class="custom-control-label" for="listitem10">Outdoor Space</label>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-md-6">
							<h3>Building Features</h3>
							<ul class="checkbox-listing">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('building_feature[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem11']) !!}
										<label class="custom-control-label" for="listitem11">Door Man</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('building_feature[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem12']) !!}
										<label class="custom-control-label" for="listitem12">Fitness Center</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('building_feature[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem13']) !!}
										<label class="custom-control-label" for="listitem13">Storage Facility</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('building_feature[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem14']) !!}
										<label class="custom-control-label" for="listitem14">Elevator</label>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-md-6">
							<h3>Amenities</h3>
							<ul class="checkbox-listing">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem15']) !!}
										<label class="custom-control-label" for="listitem15">Balcony</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem16']) !!}
										<label class="custom-control-label" for="listitem16">Dishwasher</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem17']) !!}
										<label class="custom-control-label" for="listitem17">Concierge</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem18']) !!}
										<label class="custom-control-label" for="listitem18">Elevator</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 5, null, ['class' => 'custom-control-input', 'id' => 'listitem19']) !!}
										<label class="custom-control-label" for="listitem19">Furnished</label>
									</div>
								</li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="checkbox-listing" style="margin-top: 28px;">
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 6, null, ['class' => 'custom-control-input', 'id' => 'listitem20']) !!}
										<label class="custom-control-label" for="listitem20">Gym</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 7, null, ['class' => 'custom-control-input', 'id' => 'listitem21']) !!}
										<label class="custom-control-label" for="listitem21">In-unit Laundry</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 8, null, ['class' => 'custom-control-input', 'id' => 'listitem22']) !!}
										<label class="custom-control-label" for="listitem22">On-site Parking</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 9, null, ['class' => 'custom-control-input', 'id' => 'listitem23']) !!}
										<label class="custom-control-label" for="listitem23">Terrace</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-checkbox">
										{!! Form::checkbox('amenities[]', 10, null, ['class' => 'custom-control-input', 'id' => 'listitem24']) !!}
										<label class="custom-control-label" for="listitem24">Pets Allowed</label>
									</div>
								</li>
							</ul>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Your Name </label>
								{!! Form::text('name', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone Number</label>
								{!! Form::text('phone', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email </label>
								{!! Form::text('email', null, ['class' => 'input-style']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Website</label>
								{!! Form::text('website', null, ['class' => 'input-style']) !!}
							</div>
						</div>
					</div>
					{!! Form::close() !!}
					<div class="row">
						<div class="col-md-12">
							<form action="{{ route('agent.litingImages') }}" id="images-uploader" class="dropzone">
								@csrf
							</form>
						</div>
						<div class="col-md-12 mt-4">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d76130.04175199835!2d-1.569495477097316!3d53.39579851938416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48790aa9fae8be15%3A0x3e2827f5af06b078!2sSheffield%2C+UK!5e0!3m2!1sen!2s!4v1558968017158!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
						<div class="col-md-12 mt-4 text-center">
							<button id="post_listing" class="btn-default">Post Listing</button>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

<script type="text/javascript">
	window.onload = function() {
		$('#post_listing').on('click', function() {
			$('#listing_form').submit();
		});
	}
</script>