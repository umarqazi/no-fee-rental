@extends('secured-layouts.app')
@section('title', 'Listings')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="{{ route('owner.addListing') }}" class="btn-default"><i class="fa fa-plus"></i> Add Listing</a>
        </div>
        <div class="block listing-container" id="app">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#active">Active ( {{ $listing->active->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#owner-only">Owner Only ( {{ $listing->owner_only->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#archived">Archived ( {{ $listing->archived->total() }} )</a>
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
                    <div class="tab-pane" id="active">
                        @include('owner.listing-tabs.active')
                    </div>
                    <div class="tab-pane fade" id="owner-only">
                        @include('owner.listing-tabs.owner_only')
                    </div>
                    <div class="tab-pane fade" id="archived">
                        @include('owner.listing-tabs.archive')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/tabs.js') !!}
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
