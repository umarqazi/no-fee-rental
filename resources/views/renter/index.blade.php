@extends('secured-layouts.app')
@section('title', 'Renter')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Wishlist</h1>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#listing-active">Active ( 86 )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-inactive">Closed ( 166 )</a>
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
                        @include('renter.wishlist.active')
                    </div>
                    <div class="tab-pane fade" id="listing-inactive">
                        @include('renter.wishlist.inactive')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/tabs.js') !!}
@endsection
