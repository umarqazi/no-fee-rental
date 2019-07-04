@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
<div class="wrapper">
	<div class="heading-wrapper">
		<h1>{{ ($edit) ? 'Update' : 'Add' }} Listing</h1>
	</div>
	<div class="block add-new-listing-wrapper">
		<div class="block-body">
			{!! Form::model($listing, ['url' => ($edit) ? route('agent.updateListing', $listing->id) : route('agent.createListing'), 'id' => 'listing_form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
			<div class="row">
				@include('agent.listing-features.listing-info')
				<!-- Listing Type -->
				<div class="col-md-6">
					@include('agent.listing-features.listing_types')
				</div>
				<!-- Pet Policy -->
				<div class="col-md-6">
					@include('agent.listing-features.pet_policy')
				</div>
				<!-- Unit Features -->
				<div class="col-md-6">
					@include('agent.listing-features.unit_features')
				</div>
				<!-- Building Features -->
				<div class="col-md-6">
					@include('agent.listing-features.building_features')
				</div>
				<!-- Amenities -->
					@include('agent.listing-features.amenities')
				@include('agent.listing-features.basic-info')
				<div class="col-md-12 mt-4">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d76130.04175199835!2d-1.569495477097316!3d53.39579851938416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48790aa9fae8be15%3A0x3e2827f5af06b078!2sSheffield%2C+UK!5e0!3m2!1sen!2s!4v1558968017158!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-md-12 mt-4 text-center">
					<button type="submit" class="btn-default">{{($edit) ? 'Update' : 'Post'}} Listing</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection