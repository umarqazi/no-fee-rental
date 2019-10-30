@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
<div class="wrapper building-details-wrapper">
    <div class="heading-wrapper">
        <h1>{{ $status }} Building</h1>
        <a href="#" class="btn-default" data-toggle="modal" data-target="#invite-member">Add Member</a>
    </div>
    <!--Grid view listing-->
    <div class="grid-view-wrapper" style="display: block;">
        <div class="building-detail-header">
            <div class="building-address">
                <h3> Building Address: <small> {{ collect($building->listings)->first()->street_address }}</small></h3>
            </div>
            <div class="building-appartments">
                <h3> Total Apartments: <small> {{ count($building->listings) }}</small></h3>
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
                            <p><i class="fa fa-tag"></i> ${{ $apartment->rent }}</p>
                            <ul>
                                <li><i class="fa fa-bed"></i> {{ str_formatting($apartment->bedrooms, 'Bed') }}</li>
                                <li><i class="fa fa-bath"></i> {{ str_formatting($apartment->baths, 'Bath') }}</li>
                            </ul>
                            <p>Posted On: {{ $apartment->created_at->format('m/d/y h:i a') }}</p>
                            @if($apartment->is_featured === APPROVEFEATURED)
                                <span class="status" style="background: blueviolet;">Featured</span>
                            @endif
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route('listing.detail', $apartment->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! Form::model($building, ['url' => route($route, $building->id)]) !!}
        <div class="amenities-section">
            <div class="row">
                <ul class="col-md-3">
                    <h3>Amenities</h3>
                    {!! amenities() !!}
                </ul>
            </div>
        </div>
            <div class="after-amenities-inputs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Neighbourhood</label>
                            {!! Form::select('neighborhood', neighborhoods(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::submit($status, ['class' => 'btn-default']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
