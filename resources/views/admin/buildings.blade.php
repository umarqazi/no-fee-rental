@extends('secured-layouts.app')
@section('title', 'Buildings')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Buildings</h1>
        </div>
        <div class="block listing-container" id="app">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#buildings-no-fee">
                            No Fee ( {{ $buildings->no_fee->total() }} )
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#buildings-fee">
                            Fee ( {{ $buildings->fee->total() }} )
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#buildings-owner-only">
                            Owner Only ( {{ $buildings->owner_only->total() }} )
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#buildings-pending">
                            Pending Requests  ( {{ $buildings->non_verified->total() }} )
                        </a>
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
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="buildings-no-fee">
                        @include('admin.building-tabs.verified_buildings')
                    </div>
                    <div class="tab-pane" id="buildings-fee">
                        @include('admin.building-tabs.fee_buildings')
                    </div>
                    <div class="tab-pane" id="buildings-owner-only">
                        @include('admin.building-tabs.owner_only_building')
                    </div>
                    <div class="tab-pane" id="buildings-pending">
                        @include('admin.building-tabs.non_verified_buildings')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/tabs.js') !!}
@endsection
