@extends('secured-layouts.app')
@section('title', 'Listings')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="{{ route('admin.addListing') }}" class="btn-default"><i class="fa fa-plus"></i> Add Listing</a>
        </div>
        <div class="filter-mobile-data-wrapper">
            <div class="filter-mobile-data">
                <i class="fa fa-bars filters-icon"></i> Filters
                <div class="filter-wrapper-mobile listing-container">
                    <div class="filter-wrapper">
                        <div class="listing-views">
                            <div class="listing-views-mobilee">
                            <span><i class="fa fa-th-list list-view-btn active"></i></span>
                            <span><i class="fa fa-th grid-view-btn"></i></span>
                                <div class="sort-bt">
                                    <i class="fa fa-sort-amount-down"></i>
                                    <div class="custom-dropdown">
                                        <ul>
                                            <li><a href="{{ route('admin.sorting', 'cheaper') }}">Cheapest</a></li>
                                            <li><a href="{{ route('admin.sorting', 'recent') }}" >Recent</a></li>
                                            <li><a href="{{ route('admin.sorting', 'oldest') }}" >Oldest</a></li>
                                        </ul>
                                    </div>
                                    <span>Sort By</span>
                                </div>
                            </div>

                            <form action="{{ route('admin.listingSearch') }}" class="search" method="get">
                                @csrf
                                <input value="{{ !empty(Request::get('bedrooms')) ? Request::get('bedrooms') : '' }}" type="number" name="bedrooms" class="filter-input" placeholder="All Beds" />
                                <input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />
                                <button type="submit" class="btn-default">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="block listing-container" id="app">
            <div class="heading-wrapper pl-0 listings-wrapperr">
                <ul class="nav nav-pills ">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-active">Active ( {{ $listing->active->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-realty">Syndicated ( {{ $listing->realty->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#owner-only">Owner Only ( {{ $listing->owner_only->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-archived">Archived ( {{ $listing->archived->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-pending">Requests ( {{ $listing->pending->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-reported">Reported ( {{ $listing->reported->total() }} )</a>
                    </li>
                </ul>
                <div class="filter-wrapper">
                    <div class="listing-views">
                        <span><i class="fa fa-th-list list-view-btn active"></i></span>
                        <span><i class="fa fa-th grid-view-btn"></i></span>
                    </div>
                    {!! panel_listing_filters(Request::all()) !!}
                </div>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="listing-active">
                        @include('admin.listing-tabs.active_inactive')
                    </div>
                    <div class="tab-pane fade" id="listing-realty">
                        @include('admin.listing-tabs.realty')
                    </div>
                    <div class="tab-pane fade" id="owner-only">
                        @include('admin.listing-tabs.owner_only')
                    </div>
                    <div class="tab-pane fade" id="listing-archived">
                        @include('admin.listing-tabs.archive')
                    </div>
                    <div class="tab-pane fade" id="listing-pending">
                        @include('admin.listing-tabs.pending')
                    </div>
                    <div class="tab-pane fade" id="listing-reported">
                        @include('admin.listing-tabs.reported')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
    {!! HTML::script('assets/js/tabs.js') !!}
@endsection
