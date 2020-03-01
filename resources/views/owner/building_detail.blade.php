@extends('secured-layouts.app')
@section('title', 'Building Details')
@section('content')
    {!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
    {!! HTML::style('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css') !!}
    {!! HTML::script('https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js') !!}
    {!! HTML::script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js') !!}
    {!! HTML::script('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js') !!}
<div class="wrapper building-details-wrapper">
    <div class="heading-wrapper">
        <h1>{{ $status }} Building</h1>
        <a href="{{ route('owner.addApartment', $building->id) }}" class="btn-default" ><i class="fa fa-plus"></i> Add Apartment</a>
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
                        <img src="{{ Storage::url( $apartment->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                        <div class="info">
                            <p><i class="fa fa-tag"></i> ${{ ($apartment->rent) ? number_format($apartment->rent) : 'None' }}</p>
                            <ul>
                                <li><i class="fa fa-bed"></i> {{ str_formatting($apartment->bedrooms, 'Bed') }}</li>
                                <li><i class="fa fa-bath"></i> {{ str_formatting($apartment->baths, 'Bath') }}</li>
                            </ul>
                            <p>Posted On: {{ $apartment->created_at->format('m/d/y h:i a') }}</p>
                            @if(is_available($apartment->availability))
                                <span class="status">Available</span>
                            @else
                                <span class="status" style="background: red;">Not Available</span>
                            @endif
                            @if($apartment->is_featured === APPROVEFEATURED)
                                <span class="status" style="background: blueviolet;right: 75px;">Featured</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! Form::model($building, ['url' => route($route, $building->id), 'enctype' => 'multipart/form-data', 'id' => 'update_building']) !!}
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
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group selectAgent">
                    <label for="select-agent">Select Contact Representative:</label>
                    {!! Form::select('contact_representative', agents(), null, ['class' => 'input-style']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="radio">Building Action:</label>
                    {!! Form::select('building_action', config('formfields.building_action'), null, ['class' => 'input-style']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div>
                        <img class="img-thumbnail" src="{{isset($building->thumbnail) ? Storage::url($building->thumbnail ?? DLI ) : Storage::url(DLI) }}" id="img" style="width: 180px;height: 145px;margin-bottom: 15px;">
                    </div>
                    {!! Form::file('thumbnail', ['id' => 'file-3']) !!}
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
    {!! HTML::script('assets/js/listing.js') !!}
    <div id="map" style="display: none;"></div>
    <script>
        initMap('map');
        autoComplete('controls');
        setTimeout(() => {
            $('body').find('.mapboxgl-ctrl-geocoder--input').val("{{ $building->address }}");
            $('body').find('.mapboxgl-ctrl-geocoder--input').attr('readonly', 'readonly');
        }, 10);
    </script>
@endsection
