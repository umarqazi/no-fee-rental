@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
<div class="wrapper">
	<div class="heading-wrapper">
		<h1>{{ ($edit) ? 'Update' : 'Add' }} Listing</h1>
	</div>
	<div class="block add-new-listing-wrapper">
		<div class="block-body">
			{!! Form::model($listing, ['id' => 'listing-form', 'url' => ($edit) ? route('admin.updateListing', $listing->id) : route('admin.createListing'), 'id' => 'listing_form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
				<div class="row">
					@include('admin.listing-features.listing_info')

					@include('admin.listing-features.features')

					@include('admin.listing-features.basic_info')

				<div class="col-md-12 mt-4">
					<div id="map"></div>
				</div>
				<div class="col-md-12 mt-4 text-center">
					<button type="submit" class="btn-default">{{($edit) ? 'Update' : 'Post'}} Listing</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

{!! HTML::script('assets/js/listing.js') !!}

@endsection
