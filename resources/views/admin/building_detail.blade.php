@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
    {{--<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->--}}
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <script src='https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js'></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.4.0/mapbox-gl-csp-worker.js.map"></script>
<div class="wrapper building-details-wrapper">
    <div class="heading-wrapper">
        <h1>{{ $status }} Building</h1>
        <a href="{{ route('admin.addApartment', $building->id) }}" class="btn-default" >Add Apartment</a>
    </div>
    <!--Grid view listing-->
    <div class="grid-view-wrapper" style="display: block;">
        <div class="building-detail-header">
            <div class="building-address">
                <h3> Building Address: <small> {{ $building->address }}</small></h3>
            </div>
            <div class="building-appartments">
                <h3> Total Apartments: <small> {{ count($building->listings) }}</small></h3>
            </div>
            <div class="building-appartments">
                <h3> Building Type: <small> {{ ucfirst($building->type) }}</small></h3>
            </div>
            <div class="building-agents">
                <h3>Building Status: <small> {{ $building->is_verified ? 'Verified' : 'Not Verified' }}</small></h3>
            </div>
        </div>
        <div class="row">
            @foreach($building->listings as $apartment)
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="listing-thumb">
                        <img src="{{ asset( $apartment->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                        <div class="info">
                            <p><i class="fa fa-tag"></i> ${{ ($apartment->rent) ?   number_format($apartment->rent,0) : 'None' }}</p>
                            <ul>
                                <li><i class="fa fa-bed"></i> {{ str_formatting($apartment->bedrooms, 'Bed') }}</li>
                                <li><i class="fa fa-bath"></i> {{ str_formatting($apartment->baths, 'Bath') }}</li>
                            </ul>
                            <p>Posted On: {{ $apartment->created_at->format('m/d/y h:i a') }}</p>
                            @if($apartment->visibility === ACTIVE)
                                <span class="status">Active</span>
                            @elseif($apartment->visibility === DEACTIVE)
                                <span class="status" style="background: red;">Inactive</span>
                            @endif
                            @if($apartment->is_featured === APPROVEFEATURED)
                                <span class="status" style="background: blueviolet;right: 75px;">Featured</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! Form::model($building, ['url' => route($route, $building->id), 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="address">
                    <label> Address</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> Neighbourhood</label>
                    {!! Form::text('neighborhood', null, ['class' => 'input-style', 'readonly']) !!}
                </div>
            </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Building Thumbnail</label>
                {!! Form::file('thumbnail', null, ['class' => 'input-style']) !!}
            </div>
            @if(isset($building->thumbnail))
                {!! Form::hidden('old_thumbnail', $building->thumbnail) !!}
                {!! Form::hidden('map_location', null) !!}
            @endif
        </div>
        </div>

        <div class="amenities-section">
            <div class="row">
               {!! amenities() !!}
            </div>
        </div>
            <div class="col-md-12 mt-4 text-center">
                {!! Form::submit($status, ['class' => 'btn-default submit']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
    <div id="map" style="display: none"></div>
    {!! HTML::script('assets/js/listing.js') !!}
    <script>
        initMap('map');
        autoComplete('controls');
        setTimeout(() => {
            $('body').find('.mapboxgl-ctrl-geocoder--input').val("{{ $building->address }}");
            $('body').find('.mapboxgl-ctrl-geocoder--input').attr('readonly', 'readonly');
        }, 10);
    </script>
@endsection
