@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
<div class="wrapper building-details-wrapper">
    <div class="heading-wrapper">
        <h1>{{ $status }} Building</h1>
        <a href="{{ route('owner.addApartment', $building->id) }}" class="btn-default" >Add Apartment</a>
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
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Neighbourhood</label>
                    {!! Form::select('neighborhood_id', neighborhoods(), null, ['class' => 'input-style']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> Address</label>
                    {!! Form::text('address', null, ['class' => 'input-style']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Contact Representative</label>
                    {!! Form::text('contact_representative', null, ['class' => 'input-style']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="radio">Building Action:</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio('building_action', OWNERONLY, true, ['class' => 'custom-control-input', 'id' => 'radio1']) !!}
                        <label class="custom-control-label" for="radio1">Owner Only</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio('building_action', ALLOWAGENT, false, ['class' => 'custom-control-input', 'id' => 'radio2']) !!}
                        <label class="custom-control-label" for="radio2">Allow Agent</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-holder">
            <img id="view_profile" src="{{ asset( $user->profile_image ?? DUI ) }}" alt="" />
            @if(!empty($user->profile_image))
                <input type="hidden" name="old_profile" value="{{ $user->profile_image }}">
            @endif
            <label @if($errors->isEmpty()) @endif id="image-picker">
                <i class="fa fa-edit edit-btn"></i>{!! Form::file('profile_image', ['class' => 'd-none']) !!}
            </label>
            <div class="col-12">
                @if ($errors->has('profile_image'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('profile_image') }}</strong>
                                </span>
                @endif
            </div>
        </div>
        <div class="amenities-section">
            <div class="row">
               {!! amenities() !!}
            </div>
        </div>
            <div class="after-amenities-inputs">
                {{--<div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Neighbourhood</label>
                            {!! Form::select('neighborhood_id', neighborhoods(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                </div>--}}
                {!! Form::submit($status, ['class' => 'btn-default']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
