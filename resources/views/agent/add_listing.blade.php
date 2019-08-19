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
				@include('agent.listing-features.listing_info')

				@include('agent.listing-features.features')

				@include('agent.listing-features.basic_info')

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

{!! HTML::script('assets/js/datetime.min.js') !!}
{!! HTML::script('assets/js/map.js') !!}
{!! HTML::script('assets/js/listing.js') !!}
<script>
    $('#datepicker').datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });
</script>
@endsection
