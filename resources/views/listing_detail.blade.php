@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
<style>
    .modal {
        z-index: 25;
    }
    .modal-backdrop {
        z-index: 20;
    }
</style>
<section class="listing-Details neighborhood-search wow fadeIn listing-detail-container" data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6">
                <div class="item">
                    <div class="clearfix" style="max-width:100%;">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @foreach($listing->listingImages as $images)
                                <li data-thumb="{{ asset($images->listing_image ?? DLI) }}" class="large-view">
                                    <a target="_blank" href="{{ asset($images->listing_image ??  DLI) }}">
                                        <img src="{{ asset($images->listing_image ?? DLI) }}" alt=""/>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="listing-info">
                    <div class="product-title">
                        <p> {{ is_exclusive($listing->listingTypes) ? $listing->street_address.' - '.$listing->unit : $listing->display_address }} </p>
                        <span>
                            <a href="javascript:void(0);"><img src="/assets/images/share-icon.png" alt="" /> </a>
                            <a href="javascript:void(0);" class="ml-2"><img src="/assets/images/fav-icon.png" alt="" /> </a>
                        </span>
                    </div>
                    <p class="title-subtext"></p>
                    @if($listing->availability)
                        <div class="available-btn">
                            <span>Available</span>
                            <i class="far fa-clock"></i>
                            <label> {{ dateReadable($listing->updated_at) }} since last update </label>
                        </div>
                    @else
                        <div class="unavailable-btn">
                            <span>Unavailable </span>
                            <i class="far fa-clock"></i>
                            <label> {{ dateReadable($listing->updated_at) }} since last update </label>
                        </div>
                    @endif
                    <div class="apartment-details">
                        <h4> ${{$listing->rent}} / month</h4>
                    </div>
                    <div class="appointment-iconDetails">
                        <ul>
                            <li> <i class="fas fa-bed"></i> {{ str_formatting($listing->bedrooms, 'Bed') }} </li>
                            <li> <i class="fas fa-bath"> </i> {{ str_formatting($listing->baths, 'Bath') }} </li>
                            <li> <i class="fas fa-ruler"> </i> {{$listing->square_feet}} ft </li>
                        </ul>
                    </div>
                    <div class="Availability-date-sec">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-6">
                                <div class="row">
                                    <div class="col-lg-8 col-8">
                                        <span>Availability date: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> Now</strong>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <span>Lease term: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> 1 year</strong>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <span>Days on market: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> 190 days</strong>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <span>Exposure: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> None</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="row">
                                    <div class="col-lg-8 col-8">
                                        <span>Application fee: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> $100.00</strong>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <span>Free months: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> None</strong>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <span>Deposit: </span>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <strong> $5,600.00</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="appointment-section">
                        <div class="appointment-agent-img-section">
                            <a href="#"><img src="/assets/images/careers-icon.png" alt="apointment"></a>
                            <p> 1 agent from <strong>{{$listing->agent->company[0]->company["company"]}} </strong></p>
                        </div>
                        <div class="appointment-buttons-section">
                            @if(compareDates($listing->open_house, now()) && !isAdmin())
                                <a href="javascript:void(0);" data-target="#make-appointment" data-toggle="modal" class="btn apointment-btn">
                                    Appointment
                                </a>
                            @endif
                            <a href="javascript:void(0);" data-target="#check-availability" data-toggle="modal" class="btn contct-agent-btn">Check Availability </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-3">Description</h3>
        <p>{!! $listing->description ?? 'No description' !!}</p>
        <div class="listing-aminities-sec">
            <h3>Amenities </h3>
            <div class="row">
                @php $amenities = features($listing->listingTypes, true); @endphp
                @foreach($amenities as $key => $amenity)
                    <div class="col-lg-3 col-sm-4 col-6">
                        <p> {{ $key }}</p>
                        <ul>
                            @foreach($amenity as $key => $value)
                                <li> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="location-map-sec">
        <div class="container-lg">
            <h3>Location </h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <label> TRANSPORTATION</label>
                            <ul class="second-ul"></ul>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label> Schools</label>
                            <ul class="second-ul"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--Check Availability--}}
@include('modals.check_availability')
{{--Make Appointment--}}
@include('modals.appointment')
<script>
    mapWithNearbyLocations(@php echo $listing->map_location; @endphp ,document.getElementById('map'), true);
</script>
@endsection
