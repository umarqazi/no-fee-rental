@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
<div class="wrapper">
	<div class="heading-wrapper">
		<h1>{{$action}} Listing Images</h1>
	</div>
	<div class="block add-new-listing-wrapper">
		<div class="block-body">
			<div class="row">
				<div class="col-md-12 mt-4">
					<form action="{{ route('admin.listingImages', $id) }}" id="upload" class="dropzone">
						@csrf
					</form>
				</div>
				@if($action == 'Update' && !empty($listing_images) && count($listing_images) > 0)
				<div class="row after-dropzone-img">
					@foreach($listing_images as $image)

                        <div class="parent-div col-lg-2">
                        <span onclick="remove('{{$image->id}}', this)" >x</span>
                        <img src="{{ asset('storage/'.$image->listing_image) }}" height="50" width="50">
                        </div>
					@endforeach
				</div>
				@endif
				<div class="col-md-12 mt-4 text-center">
					<a href="{{ ($action == 'Update') ? route('admin.finishUpdateListing') : route('admin.finishCreateListing') }}"><button id="post_listing" class="btn-default">{{$action}}</button></a>
				</div>
			</div>
		</div>
	</div>
</div>

{!! HTML::script('assets/js/listing.js') !!}

@endsection
