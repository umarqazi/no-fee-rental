@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
	<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Featured Listings</h1>
				<!-- <a href="{{ route('admin.addListing') }}" class="btn-default">Fe Listing</a> -->
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="pill" href="#featured">Featured ( {{ count($listing['featured']) }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#request-featured">Request Featured ( {{ count($listing['request_featured']) }} )</a>
						</li>
					</ul>
					<div class="filter-wrapper">
						<div class="listing-views">
							<span><i class="fa fa-th-list list-view-btn active"></i></span>
							<span><i class="fa fa-th grid-view-btn"></i></span>
						</div>
						<span class="sort-bt">
							<i class="fa fa-sort-amount-down"></i>
							<span>Sort By</span>
						</span>
						<form action="{{ route('admin.listingSearch') }}" id="search" method="post">
							@csrf
							<input value="{{ !empty(Request::get('beds')) ? Request::get('beds') : '' }}" type="number" name="beds" class="filter-input" placeholder="All Beds" />
							<input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />
							<button type="submit" class="btn-default">Filter</button>
						</form>
					</div>
				</div>
				<div class="block-body">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="featured">
							@include('admin.listing-features.featured_listing')
						</div>
						<div class="tab-pane fade" id="request-featured">
							@include('admin.listing-features.requested_feature_listing')
						</div>
					</div>
				</div>
			</div>
		</div>

{!! HTML::script('assets/js/listing.js') !!}

@endsection
