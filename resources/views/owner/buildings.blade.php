@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Buildings</h1>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#building-popup" class="btn-default">Add Building</a>
        </div>
        <div class="block listing-container" id="app">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#buildings-active">
                            No Fee ( {{ $buildings->total() }} )
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" data-toggle="pill" href="#buildings-inactive">--}}
{{--                            Pending Requests  ( 2 )--}}
{{--                        </a>--}}
{{--                    </li>--}}
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
                                <li><a href="{{ route('admin.sorting', 'cheaper') }}">Cheaper</a></li>
                                <li><a href="{{ route('admin.sorting', 'petPolicy') }}" >Pet Policy </a></li>
                                <li><a href="{{ route('admin.sorting', 'recent') }}" >Recent</a></li>
                            </ul>
                        </div>
                        <span>Sort By</span>
                    </div>
{{--                    <form action="{{ route('admin.listingSearch') }}" id="search" method="post">--}}
{{--                        @csrf--}}
{{--                        <input value="{{ !empty(Request::get('beds')) ? Request::get('beds') : '' }}" type="number" name="beds" class="filter-input" placeholder="All Beds" />--}}
{{--                        <input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />--}}
{{--                        <button type="submit" class="btn-default">Filter</button>--}}
{{--                    </form>--}}
                </div>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="buildings-active">
                        @include('admin.sections.verified_building')
                    </div>
                    <div class="tab-pane fade" id="buildings-inactive">
{{--                        @include('admin.sections.non_verified_building')--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Add Building--}}
    @include('owner.modals.add_building')
    {!! HTML::script('assets/js/listing.js') !!}
@endsection