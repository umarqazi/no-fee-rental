@extends('secured-layouts.app')
@section('title', 'Featured Listings')
@section('content')
	<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Featured Listings</h1>
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="pill" href="#featured">Featured ( {{ $listing->featured->total() }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#request-featured">Request Featured ( {{ $listing->request_featured->total() }} )</a>
						</li>
					</ul>
					<div class="filter-wrapper">
						<div class="listing-views">
							<span><i class="fa fa-th-list list-view-btn active"></i></span>
							<span><i class="fa fa-th grid-view-btn"></i></span>
						</div>
                        <div class="sort-bt">
                            <i class="fa fa-sort-amount-down"></i>
                            <div class="custom-dropdown">
                                <ul>
                                    <li><a href="{{ route('admin.featureSorting', 'cheaper') }}">Cheapest</a></li>
									<li><a href="{{ route('admin.featureSorting', 'recent') }}" >Recent</a></li>
									<li><a href="{{ route('admin.featureSorting', 'oldest') }}" >Oldest</a></li>
                                </ul>
                            </div>
                            <span>Sort By</span>
                        </div>
						{!! Form::open(['url' => route('admin.featureListingSearch'), 'class' => 'search', 'method' => 'get']) !!}
							<input value="{{ !empty(Request::get('bedrooms')) ? Request::get('bedrooms') : '' }}" type="number" name="bedrooms" class="filter-input" placeholder="All Beds" />
							<input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />
							<button type="submit" class="btn-default">Filter</button>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="block-body">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="featured">
							@include('listing-features.featured_listing')
						</div>
						<div class="tab-pane fade" id="request-featured">
							@include('listing-features.requested_feature_listing')
						</div>
					</div>
				</div>
			</div>
		</div>

{!! HTML::script('assets/js/tabs.js') !!}
{!! HTML::script('assets/js/listing.js') !!}
@endsection
