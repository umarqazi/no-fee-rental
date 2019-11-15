@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
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
        {!! Form::model($building, ['url' => route($route, $building->id)]) !!}
        <div class="amenities-section">
            <div class="row">
               {!! amenities() !!}
            </div>
        </div>
            <div class="after-amenities-inputs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Neighbourhood</label>
                            {!! Form::select('neighborhood_id', neighborhoods(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::submit($status, ['class' => 'btn-default']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
