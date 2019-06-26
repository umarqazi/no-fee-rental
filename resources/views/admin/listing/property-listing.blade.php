@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="#" class="btn-default">New Listing</a>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#listing-active">Active ( 86 )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-inactive">Inactive ( 1686 )</a>
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
                    <input type="number" class="filter-input" placeholder="All Beds" />
                    <input type="number" class="filter-input" placeholder="All Baths" />
                    <button class="btn-default">Filter</button>
                </div>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="listing-active">

                        @include('admin.listing.list-view')
                        @include('admin.listing.grid-view')

                    </div>
                    <div class="tab-pane fade" id="listing-inactive">

                        @include('admin.listing.list-view')
                        @include('admin.listing.grid-view')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
