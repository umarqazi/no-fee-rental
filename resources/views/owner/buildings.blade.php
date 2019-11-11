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
                    <div class="tab-pane" id="buildings-active">
                        @include('owner.sections.verified_buildings')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Add Building--}}
    @include('owner.modals.add_building')
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
