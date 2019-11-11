@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
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
                {!! Form::hidden('visibility') !!}
                {!! Form::hidden('user_id') !!}
                @if(isAdmin() && $action == 'Create' ? true : isset($listing->id) && is_created_by_owner($listing->id) )
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>List Belongs To:</label>
                                {!! Form::select('user_id', owners(), null,
                                [
                                    'class'        => 'input-style',
                                    'autocomplete' => 'off'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    {{--Listing Info--}}
                    @include('listing-features.listing_info')
                    {{--Features--}}
                    {!! features() !!}
                    {{--Basic User Info--}}
                    @include('listing-features.basic_info')
                    <div class="col-md-12 mt-4">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <button type="button" class="btn-default submit">{{ $action }} Listing</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
<script>
    $(document).ready(function() {
        enableDatePicker('#availability_date');
        enableDatePicker('#lease_term');
        enableDatePicker('.open-house-date', false);
        autoComplete(document.getElementById('controls'));

        @if($action === 'Copy' || $action === 'Update')
            ZOOM = 15;
            setMap($('input[name=map_location]').val(), document.getElementById('map'));
        @else
            initMap(document.getElementById('map'), 17);
        @endif
    });
</script>
@endsection
