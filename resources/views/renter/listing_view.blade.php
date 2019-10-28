@extends('secured-layouts.app')
@section('title', 'Renter')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Listings</h1>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#listing-active">Active ()</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-inactive">Closed ()</a>
                    </li>
                </ul>
                <div class="filter-wrapper">
                    <div class="listing-views">
                        <span><i class="fa fa-th-list list-view-btn active"></i></span>
                        <span><i class="fa fa-th grid-view-btn"></i></span>
                    </div>
                </div>
            </div>
            <div class="block-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="listing-active">
                        @include('listing-features.active_listing')
                    </div>
                    <div class="tab-pane fade" id="listing-inactive">
                        @include('listing-features.inactive_listing')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
