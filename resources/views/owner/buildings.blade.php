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
                        <a class="nav-link" data-toggle="pill" href="#no-fee-buildings">
                            No Fee ( {{ $buildings->no_fee->total() }} )
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="pill" href="#fee-buildings">
                            Fee ( {{ $buildings->fee->total() }} )
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="pill" href="#owner-only-buildings">
                            Owner Only ( {{ $buildings->owner_only->total() }} )
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
                    <div class="tab-pane" id="no-fee-buildings">
                        @include('owner.building-tabs.no_fee_buildings')
                    </div>
                    <div class="tab-pane" id="fee-buildings">
                        @include('owner.building-tabs.fee_buildings')
                    </div>
                    <div class="tab-pane" id="owner-only-buildings">
                        @include('owner.building-tabs.owner_only_building')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Add Building--}}
    @include('owner.modals.add_building')
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
