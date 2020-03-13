@extends('secured-layouts.app')
@section('title', 'Listings')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="{{ route('agent.addListing') }}" class="btn-default"><i class="fa fa-plus"></i> Add Listing</a>
        </div>

        @if(!isAgentHasPlan() && !isMRGAgent())
            {!! bootstrapAlertDanger('You have no plan to post listing <b><a href="'.route("agent.creditPlan").'">Click Here</a></b> to purchase a plan and we are good to go.') !!}
        @endif

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
                                        <li><a href="{{ route('agent.sorting', 'cheaper') }}">Cheapest</a></li>
                                        <li><a href="{{ route('agent.sorting', 'recent') }}" >Recent</a></li>
                                        <li><a href="{{ route('agent.sorting', 'older') }}" >Oldest</a></li>
                                    </ul>
                                </div>
                                <span>Sort By</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('agent.listingSearch') }}" id="search" method="post">
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
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#active">Active ( {{ $listing->active->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#realty">Syndicated ( {{ $listing->realty->total() }} )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#archived">Archived ( {{ $listing->archived->total() }} )</a>
                    </li>
                    @if(!isMRGAgent())
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pending">Pending ( {{ $listing->pending->total() }} )</a>
                        </li>
                    @endif
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
                        @include('agent.listing-tabs.active')
                    </div>
                    <div class="tab-pane fade" id="realty">
                        @include('agent.listing-tabs.realty')
                    </div>
                    <div class="tab-pane fade" id="archived">
                        @include('agent.listing-tabs.archive')
                    </div>
                    <div class="tab-pane fade" id="pending">
                        @include('agent.listing-tabs.pending')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/tabs.js') !!}
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
