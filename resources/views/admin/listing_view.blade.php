@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="{{ route('admin.addListing') }}" class="btn-default">New Listing</a>
        </div>

        <div class="filter-mobile-data-wrapper">
            <div class="filter-mobile-data">
                <i class="fa fa-bars"></i> Filters
                <div class="filter-wrapper-mobile listing-container">
                    <div class="filter-wrapper">
                        <div class="listing-views">
                            <div>
                            <span><i class="fa fa-th-list list-view-btn active"></i></span>
                            <span><i class="fa fa-th grid-view-btn"></i></span>
                            </div>
                            <div class="sort-bt">
                                <i class="fa fa-sort-amount-down"></i>
                                <div class="custom-dropdown">
                                    <ul>
                                        <li><a href="{{ route('admin.sorting', 'cheaper') }}">Cheapest</a></li>
                                        <li><a href="{{ route('admin.sorting', 'recent') }}" >Recent</a></li>
                                    </ul>
                                </div>
                                <span>Sort By</span>
                            </div>
                        </div>

                        <form action="{{ route('admin.listingSearch') }}" id="search" method="post">
                            @csrf
                            <input value="{{ !empty(Request::get('beds')) ? Request::get('beds') : '' }}" type="number" name="beds" class="filter-input" placeholder="All Beds" />
                            <input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />
                            <button type="submit" class="btn-default">Filter</button>
                        </form>
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
                        <a class="nav-link" data-toggle="pill" href="#listing-realty">Realty ( {{ $listing->realty->total() }} )</a>
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
                    <div class="sort-bt">
                        <i class="fa fa-sort-amount-down"></i>
                        <div class="custom-dropdown">
                            <ul>
                                <li><a href="{{ route('admin.sorting', 'cheaper') }}">Cheapest</a></li>
                                <li><a href="{{ route('admin.sorting', 'recent') }}" >Recent</a></li>
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
                        @include('listing-tabs.active_inactive')
                    </div>
                    <div class="tab-pane fade" id="listing-realty">
                        @include('listing-tabs.realty')
                    </div>
                    <div class="tab-pane fade" id="owner-only">
                        @include('listing-tabs.owner_only')
                    </div>
                    <div class="tab-pane fade" id="listing-archived">
                        @include('listing-tabs.archive')
                    </div>
                    <div class="tab-pane fade" id="listing-pending">
                        @include('listing-tabs.pending')
                    </div>
                    <div class="tab-pane fade" id="listing-reported">
                        @include('listing-tabs.reported')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
