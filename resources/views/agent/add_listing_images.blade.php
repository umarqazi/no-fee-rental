@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
<div class="wrapper">
	<div class="heading-wrapper">
		<h1>{{($edit) ? 'Update' : 'Upload' }} Listing Images</h1>
	</div>
	<div class="block add-new-listing-wrapper">
		<div class="block-body">
			<div class="row">
				<div class="col-md-12 mt-4">
					<form action="{{ route('agent.listingImages', $id) }}" id="upload" class="dropzone">
						@csrf
					</form>
				</div>
				@if($edit && count($listing_images) > 0)
				<div class="col-12">
					@foreach($listing_images as $image)
						<img onclick="remove('{{$image->id}}', this)" src="{{ asset('storage/'.$image->listing_image) }}" height="50" width="50">
					@endforeach
				</div>
				@endif
				<div class="col-md-12 mt-4 text-center">
					<a href="{{ ($edit) ? route('agent.finishUpdateListing') : route('agent.finishCreateListing') }}"><button id="post_listing" class="btn-default">{{ ($edit) ? 'Update' : 'Finish' }}</button></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script type="text/javascript">
	function remove(id, image) {
    	$.ajax({
    		url: `/agent/remove-listing-image/${id}`,
    		type: 'post',
    		success: function(res) {
    			$(image).remove();
    		},

    		error: function (err) {
    			console.log(err);
    		}
    	});
    }
</script>