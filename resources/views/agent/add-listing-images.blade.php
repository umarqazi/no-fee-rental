@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
<div class="wrapper">
	<div class="heading-wrapper">
		<h1>Upload Listing Images</h1>
	</div>
	<div class="block add-new-listing-wrapper">
		<div class="block-body">
			<div class="row">
				<div class="col-md-12 mt-4">
					<form action="{{ route('agent.listingImages', $id) }}" id="upload" class="dropzone">
						@csrf
					</form>
				</div>
				<div class="col-md-12 mt-4 text-center">
					<a href="{{ route('agent.finishListing') }}"><button id="post_listing" class="btn-default">Finish</button></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection