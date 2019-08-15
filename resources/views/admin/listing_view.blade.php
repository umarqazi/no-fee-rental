@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
	<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Listings</h1>
				<a href="{{ route('admin.addListing') }}" class="btn-default">New Listing</a>
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#listing-active">Active ( {{ $listing['totalActive'] }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#listing-inactive">Inactive ( {{ $listing['totalInactive'] }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#listing-pending">Pending Requests ( {{ $listing['totalPending'] }} )</a>
						</li>
					</ul>
					<div class="filter-wrapper">
						<div class="listing-views">
							<span><i class="fa fa-th-list list-view-btn active"></i></span>
							<span><i class="fa fa-th grid-view-btn"></i></span>
						</div>
						<div class="sort-by">
							<i class="fa fa-sort-amount-down"></i>
                            <div class="custom-dropdown">
                                <ul>
                                    <li><a href="/admin/listing_view/cheaper">Cheeper</a></li>
                                    <li><a href="/admin/listing_view/petPolicy" >Pet Policy </a></li>
                                    <li><a href="/admin/listing_view/recent" >Recent</a></li>
                                </ul>
                            </div>
							<span>Sort By</span>
						</div>
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
						<div class="tab-pane" id="listing-active">
							@include('admin.listing-features.active_listing')
						</div>
						<div class="tab-pane fade" id="listing-inactive">
							@include('admin.listing-features.inactive_listing')
						</div>
						<div class="tab-pane fade" id="listing-pending">
							@include('admin.listing-features.pending_request_listing')
						</div>
					</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
    $(".sort-by > i").click(function () {
       $(this).siblings(".custom-dropdown").slideToggle();
    });
</script>
{!! HTML::script('assets/js/listing.js') !!}

@endsection
