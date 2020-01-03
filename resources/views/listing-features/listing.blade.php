@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
    {!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
    {!! HTML::style('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css') !!}
    {!! HTML::script('https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js') !!}
    {!! HTML::script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js') !!}
    {!! HTML::script('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js') !!}

    <style>
        .marker {
            background-image: url('mapbox-icon.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .checkbox-listing { margin-bottom: 0px !important; }
    </style>

    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>{{$action}} Listing</h1>
        </div>
        <div class="block add-new-listing-wrapper">
            <div class="block-body">
                {!! Form::model($listing,
                    [
                        'id'  => 'listing-form',
                        'url' => ($action == 'Update')
                                ? route(whoAmI().'.updateListing', $listing->id)
                                : route(whoAmI().'.createListing'),
                        'method'  => 'post',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                <div class="row">
                    @if(isAdmin())
                        @if($action == 'Create' || isOwnerListing($listing->agent->id ?? null))
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>List Belongs To:</label>
                                {!! Form::select('owner_id', owners(), null, ['class' => 'input-style']) !!}
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="row">

                    {{--Listing Info--}}
                    @include('listing-features.listing_info')

                    {{--Hidden Fields--}}
                    @include('listing-features.hidden_fields')

                    {{--Pets Feature--}}
                    {!! features_pet() !!}

                    {{--Features--}}
                    {!! features() !!}

                    @if($action !== 'Building' || $action !== 'Update' || $action !== 'Copy')
                        <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px; text-transform: capitalize;" id="amenities">
                            <div class="row" style="display: none;">
                                {!! amenities() !!}
                            </div>
                        </div>
                    @endif

                    {{--Basic User Info--}}
                    @include('listing-features.basic_info')

                    {{--Map View--}}
                    <div class="col-md-12 mt-4">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        {!! Form::submit($action.' Listing', ['class' => 'btn-default submit']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
<script>
    window.onload = function() {
        enableDatePicker('#availability_date', false);
        enableDatePicker('.open-house-date', false);
        @if($action === 'Copy' || $action === 'Update' || $action === 'Building')
            setMap('map', JSON.parse($('input[name=map_location]').val()));
            setTimeout(() => {
                $('body').find('.mapboxgl-ctrl-geocoder--input').val("{!! $listing->street_address !!}");
                $('body').find('.mapboxgl-ctrl-geocoder--input').attr('readonly', 'readonly');
            }, 10);
        @else
            initMap('map');
        @endif
            autoComplete('controls');
    };
</script>
@endsection
