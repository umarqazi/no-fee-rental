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
					<form action="{{ route('agent.listingImages', $id) }}" id="images-uploader" class="dropzone">
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script type="text/javascript">
window.onload = function() {
	Dropzone.options.imagesUploader = {
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };
}
</script>