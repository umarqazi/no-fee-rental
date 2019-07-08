@extends('secured-layouts.app')
@section('title', 'no fee rental')
@section('content')
<!-- <div class="lds-ripple"><div></div><div></div></div> -->
<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Listings</h1>
				<a href="{{ route('agent.addListing') }}" class="btn-default">New Listing</a>
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" id="active" data-toggle="pill" href="#listing-active">Active ( {{ count($listing['active']) }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="deactive" data-toggle="pill" href="#listing-inactive">Inactive ( {{ count($listing['inactive']) }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pending" data-toggle="pill" href="#listing-pending">Pending ( {{ count($listing['pending']) }} )</a>
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
						<form action="{{ route('agent.listingSearch') }}" id="search" method="post">
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
						<div class="tab-pane active" id="listing-active">
							@include('agent.listing-features.active_listing')
						</div>
						<div class="tab-pane fade" id="listing-inactive">
							@include('agent.listing-features.inactive_listing')
						</div>
						<div class="tab-pane fade" id="listing-pending">
							@include('agent.listing-features.pending_listing')
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection