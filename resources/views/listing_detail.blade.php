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
            <div class="col-lg-7">
                <div class="listing-info">
                    <div class="product-title">
                        <p> {{ is_exclusive($listing) }} </p>
                        <span>
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><img src="/assets/images/share-icon.png" alt="" />
                             <ul class="dropdown-menu">
                                <li> <a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i> Youtube</a></li>
                              </ul>
                            </a>
                            @if(!empty($listing->agent->favourite) && $listing->agent->favourite->listing_id === $listing->id)
                                <a href="javascript:void(0);" class="ml-2"><i class="fas fa-heart fill-heart"></i></a>
                            @else
                                <a href="javascript:void(0);" class="ml-2"><i class="far fa-heart empty-heart"></i></a>
                            @endif
                            <a href="javascript:void(0);" class="ml-2" data-toggle="modal" data-target="#flag-icon"><img src="/assets/images/flag-icon.png" alt="" class="flag-icon" /></a>
                        </span>
                    </div>
                    <p class="title-subtext">
                        {{ $listing->display_address.', '.$listing->neighborhood->name }}
                    </p>

                    <div class="available-btn">
                        <div class="">
                            <span>NO FEE</span>
                            @if(
                            $listing->availability !== false &&
                            carbon($listing->availability)->format('Y-m-d') <= now()->format('Y-m-d'))
                            <span>Available</span>
                            @else
                                <span style="background-color: red;">Unavailable</span>
                            @endif
                        </div>
                        <div class="estimation-time">
                            <i class="far fa-clock"></i>
                            <label> {{ dateReadable($listing->updated_at) }} since last update </label>
                        </div>
                    </div>

                </div>
                <div class="item">
                    <div class="clearfix" style="max-width:100%;">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @foreach($listing->images as $images)
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
            <div class="col-lg-5">
                <div class="listing-info Building-details">
                    <h3> Listing Details</h3>
                    <div class="appointment-iconDetails">
                        <ul>
                            <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><defs><style>.cls-1{fill:#e77817;}</style></defs><title>Asset 4</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M51.21,8.79a30,30,0,0,0-42.42,0,30,30,0,0,0,0,42.42,30,30,0,0,0,42.42,0,30,30,0,0,0,0-42.42ZM31.89,43.05h-.13V47a1.76,1.76,0,0,1-3.52,0v-3.9H24.35a1.76,1.76,0,1,1,0-3.51h7.54a3.89,3.89,0,1,0,0-7.78H28.13a7.41,7.41,0,1,1,0-14.81h.12v-3.9a1.76,1.76,0,0,1,3.52,0V17h3.89a1.76,1.76,0,1,1,0,3.51H28.13a3.89,3.89,0,1,0,0,7.78h3.76a7.41,7.41,0,0,1,0,14.81Z"/></g></g></svg>
                                <span>{{ ($listing->rent) ?   number_format($listing->rent,0) : 'Null' }}</span>
                            </li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 55"><defs><style>.cls-1{fill:#e77817;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M3.25,32.55l.5,0,52.69,0,.31,0h.14a1.25,1.25,0,0,0,1.25-1.25,1.19,1.19,0,0,0-.2-.68L55,21.06V6.25A6.25,6.25,0,0,0,48.75,0H11.25A6.25,6.25,0,0,0,5,6.25V21.06L2,30.94a1.25,1.25,0,0,0,1.29,1.61ZM8.75,20H10.9l1.16-4.66A3.75,3.75,0,0,1,15.7,12.5h8.05a3.75,3.75,0,0,1,3.75,3.75V20h5V16.25a3.75,3.75,0,0,1,3.75-3.75h8a3.75,3.75,0,0,1,3.64,2.84L49.1,20h2.15a1.25,1.25,0,0,1,0,2.5H49.06a3.61,3.61,0,0,1-.56,1.06,3.73,3.73,0,0,1-3,1.44h-9.3a3.75,3.75,0,0,1-3.52-2.5H27.27A3.75,3.75,0,0,1,23.75,25h-9.3a3.73,3.73,0,0,1-2.95-1.44,3.49,3.49,0,0,1-.56-1.06H8.75a1.25,1.25,0,0,1,0-2.5Z"/><path class="cls-1" d="M56.25,35H3.75A3.75,3.75,0,0,0,0,38.75v15A1.25,1.25,0,0,0,1.25,55h5A1.25,1.25,0,0,0,7.5,53.75V50h45v3.75A1.25,1.25,0,0,0,53.75,55h5A1.25,1.25,0,0,0,60,53.75v-15A3.75,3.75,0,0,0,56.25,35Z"/></g></g></svg> <span> {{ str_formatting($listing->bedrooms, 'Bedroom') }}</span>
                            </li>
                            <li> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.12 60"><defs><style>.cls-1{fill:#e77817;}</style></defs><title>Asset 2</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M7.84,38.82A3.39,3.39,0,0,0,4.45,42.2v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,7.84,38.82Z"/><path class="cls-1" d="M16.67,49.85a3.38,3.38,0,0,0-3.38,3.38v3.39a3.38,3.38,0,1,0,6.76,0V53.23A3.39,3.39,0,0,0,16.67,49.85Z"/><path class="cls-1" d="M7.8,49.85a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V53.23A3.39,3.39,0,0,0,7.8,49.85Z"/><path class="cls-1" d="M25.52,38.82a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,25.52,38.82Z"/><path class="cls-1" d="M38.72,0h-13a12.42,12.42,0,0,0-12.4,12.41v5.68A16.73,16.73,0,0,0,0,34.43a3.39,3.39,0,0,0,3.38,3.39H30a3.38,3.38,0,0,0,3.38-3.39,16.7,16.7,0,0,0-13.3-16.34V12.41a5.64,5.64,0,0,1,5.63-5.64h13a5.65,5.65,0,0,1,5.64,5.64V56.62a3.38,3.38,0,1,0,6.76,0V12.41A12.42,12.42,0,0,0,38.72,0Z"/><path class="cls-1" d="M16.69,38.82a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,16.69,38.82Z"/><path class="cls-1" d="M25.5,49.85a3.38,3.38,0,0,0-3.38,3.38v3.39a3.38,3.38,0,1,0,6.76,0V53.23A3.38,3.38,0,0,0,25.5,49.85Z"/></g></g></svg>
                                <span> {{ str_formatting($listing->baths, 'Bath') }}</span>
                            </li>
                            <li> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.67 60"><defs><style>.cls-1{fill:#e77817;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M55.87,0h-41a3.8,3.8,0,0,0-3.81,3.81V7.39h4V4H55.68V44.61H52.61v4h3.26a3.8,3.8,0,0,0,3.8-3.81v-41A3.8,3.8,0,0,0,55.87,0Z"/><path class="cls-1" d="M44.8,11.4h-41A3.8,3.8,0,0,0,0,15.2v41A3.8,3.8,0,0,0,3.81,60h41a3.8,3.8,0,0,0,3.8-3.81v-41A3.81,3.81,0,0,0,44.8,11.4ZM42.1,27.66a.63.63,0,0,1-.42.61.65.65,0,0,1-.73-.14l-3.2-3.21L13.61,49.22l3.2,3.2a.7.7,0,0,1,.15.74.68.68,0,0,1-.62.4H7.09a.67.67,0,0,1-.67-.66V43.65A.67.67,0,0,1,6.83,43a.68.68,0,0,1,.73.14l3.22,3.22L34.93,22.11l-3.22-3.22a.68.68,0,0,1-.14-.73.66.66,0,0,1,.61-.41h9.25a.67.67,0,0,1,.67.67Z"/></g></g></svg>
                                <span> {{ $listing->square_feet ?? '0' }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="Availability-date-sec">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-6 bdr-right">
                                <div class="lease-term-section">
                                    <span>Lease term: </span>
                                     <strong> 20-04-2019</strong>
                                </div>
                                <div class="lease-term-section">
                                   <span>Days on market:</span>
                                    <strong> {{ dateReadable($listing->created_at) }}</strong>
                                </div>
                                <div class="lease-term-section">
                                   <span>Free months: </span>
                                    <strong> None</strong>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="lease-term-section">
                                    <span>Application fee: </span>
                                     <strong>
                                         {{ ($listing->application_fee) ?  '$' . number_format($listing->application_fee,0) : 'Null' }}
                                     </strong>
                                </div>
                                <div class="lease-term-section">
                                    <span>Deposit: </span>
                                    <strong>{{ ($listing->deposit) ?  '$' . number_format($listing->deposit,0) : 'Null' }}</strong>
                                </div>
                                <div class="lease-term-section">
                                    <span>Availability: </span>
                                    <strong> {{ $listing->availability !== false ? dateReadable($listing->availability) : 'Not Available' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($listing->openHouses->isNotEmpty())
                        <div class="open-house-section">
                            <h3> Open House</h3>
                            @foreach($listing->openHouses as $openHouse)
                                @if($openHouse->date == now()->format('m/d/Y') &&
                                openHouseTimeSlot($openHouse->start_time)->format('h:i a') >
                                now()->format('h:i a'))
                                <div class="open-house-inner">
                                    <div class="open-timings">
                                        <p>{{
                                        formattedDate('D, M d' ,$openHouse->date). ' | '.
                                        openHouseTimeSlot($openHouse->start_time)->format('h:i a'). ' - ' .
                                        openHouseTimeSlot($openHouse->end_time)->format('h:i a')
                                        }}</p>
                                    </div>
                                    <div class="apointment-interest-section">
                                        @if($openHouse->only_appt)
                                            <span> (By appointment only)</span>
                                        @else
                                            <button class="btn btn-default">Interested</button>
                                        @endif
{{--                                        <div class="request-send">--}}
{{--                                        <i class="fas fa-check-circle"></i>Request Sent--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                @else
                                    <div>Closed</div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="appointment-section">
                        <a href="{{ route('web.agentProfile', $listing->agent->id) }}">
                            <ul>
                                <li>
                                    <img src="{{ asset($listing->agent->thumbnail ?? DUI) }}" alt="">
                                </li>
                                <li>
                                    <h5> {{ $listing->agent->first_name.' '.$listing->agent->last_name }}</h5>
                                    <p> {{ $listing->agent->company->company ?? 'None' }} </p>
                                    <i class="far fa-comments"></i> 2 Renter Reviews
                                </li>
                            </ul>
                        </a>
                    </div>

                    <div class="apointment-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Appointment</a></li>
                            <li><a data-toggle="tab" href="#menu1">Check Availability</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade active">
                                @if(!authenticated())
                                    <div class="login-signup-tab">
                                        <div class="login-signup">
                                            <h5> You have to need to login or sign up to send request</h5>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#login" class="btn-default"> login</a>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#signup" class="btn-default"> SignUp</a>
                                        </div>
                                        <div class="successfull-msg">
                                            <i class="fas fa-check-circle"></i>
                                            <h5> Your request has been sent sucessfully</h5>
                                        </div>
                                    </div>
                                @else
                                    {{--Calender--}}
                                    @include('sections.make_appointment')
                                @endif
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    {{--Check Availability--}}
                                    @include('sections.check_availability')
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-3 description-title">Description</h3>
        <p>{!! $listing->description ?? 'No description' !!}</p>
    </div>
    <div class="listing-aminities-sec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                <h3>Pet Policy</h3>
                    @php $pet = petPolicy($listing->features); @endphp
                    @if(count($pet) < 1)
                        None
                    @endif
                    @foreach($pet as $feature)
                        <ul class="second-ul">
                            <li>{{ $feature }}</li>
                        </ul>
                    @endforeach
                </div>

                <div class="col-md-3 col-sm-4">
                    <h3>Unit Feature</h3>
                    @php $unit = unitFeature($listing->features); @endphp
                    @if(count($unit) < 1)
                        None
                    @endif
                    @foreach($unit as $feature)
                        <ul class="second-ul">
                            <li>{{ $feature }}</li>
                        </ul>
                    @endforeach
                </div>

                <div class="col-md-3 col-sm-4">
                    <h3>Amenities</h3>
                    @if(count($listing->listingBuilding->amenities) < 1)
                        None
                    @endif
                    @foreach($listing->listingBuilding->amenities as $feature)
                        <ul class="second-ul">
                            <li>{{ $feature->amenities }}</li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="location-map-sec">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <h3> Transportation</h3>
                            <p> 51st St (0.25 mi) </p>
                            <span class="span-box text-s"> S </span>
                            <span class="span-box text-6"> 4 </span>
                            <span class="span-box text-6"> 5 </span>
                            <span class="span-box text-6"> 6 </span>
                            <span class="span-box text-7"> 7 </span>
                            <p> 42 Street - Grand Central (0.26 mi) </p>

                            <span class="span-box text-s"> S </span>
                            <span class="span-box text-6"> 4 </span>
                            <span class="span-box text-6"> 5 </span>
                            <span class="span-box text-6"> 6 </span>
                            <span class="span-box text-7"> 7 </span>
                            <p>Lexington Av-53 St (0.34 mi </p>

                            <span class="span-box text-e"> E </span>
                            <span class="span-box text-m"> M </span>
                            <span class="span-box text-6"> 6 </span>
                            <p> 51st St (0.25 mi) </p>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <h3>Nearby Schools</h3>
                            <ul class="second-ul">
                                <li> St Mary Church Christian Academy</li>
                                <li> Ciszek Hally</li>
                                <li>Sis. Fox House</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="nearbyapartment featured-properties ">
        <div class="container-lg tab-content">
            <h3> Nearby Apartments</h3>
            <div class="property-listing">
                <div class="desktop-listiing">
                    @if(count($listing->listingBuilding->building->listings) > 1)
                        @foreach($listing->listingBuilding->building->listings as $apartment)
                            @if($listing->id === $apartment->id) @continue @endif
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <a href="javascript:void(0);">
                                        <button class="btn-default" data-toggle="modal" data-target="#check-availability">
                                            Check Availability
                                        </button>
                                    </a>
                                </div>
                            <span class="heart-icon"></span>
                            <img src="{{ asset($apartment->thumbnail ?? DLI) }}" alt="" class="main-img">
                            <div class="info">
                                <div class="info-link-text">
                                    <p> ${{ $apartment->rent }} </p>
                                    <small>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }} </small>
                                    <p> {{ is_exclusive($apartment) }}</p>
                                </div>
                                <a href="{{ route('listing.detail', $apartment->id) }}" class="btn viewfeature-btn"> View </a>
                            </div>
                            <div class="feaure-policy-text">
                                <p>${{ $apartment->rent }} / Month </p>
                                <span>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }}</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        No nearby apartment found
                    @endif
                </div>

                <div class="owl-slider">
                    <div class="owl-carousel owl-theme" id="NearbyApartments">

                            <div class="item">
                                <div class="property-thumb">
                                <div class="check-btn">
                                    <a href="javascript:void(0);">
                                        <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                    </a>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="http://localhost:8000/storage/images/listing/thumbnails/CiUjEIe1GWdVVY7p6Rq1.jpg" alt="" class="main-img">
                                <div class="info">
                                    <div class="info-link-text">
                                        <p> $12444 </p>
                                        <small> 4 Beds ,3 Baths </small>
                                        <p> Fort Lauderdale, FL, USA</p>
                                    </div>
                                    <a href="http://localhost:8000/listing-detail/2" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>4 Beds ,3 Baths </span>
                                </div>
                            </div>
                            </div>
                            <div class="item">
                                <div class="property-thumb">
                                <div class="check-btn">
                                    <a href="javascript:void(0);">
                                        <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                    </a>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="http://localhost:8000/storage/images/listing/thumbnails/CiUjEIe1GWdVVY7p6Rq1.jpg" alt="" class="main-img">
                                <div class="info">
                                    <div class="info-link-text">
                                        <p> $12444 </p>
                                        <small> 4 Beds ,3 Baths </small>
                                        <p> Fort Lauderdale, FL, USA</p>
                                    </div>
                                    <a href="http://localhost:8000/listing-detail/2" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>4 Beds ,3 Baths </span>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
        <div class="modal fade" id="flag-icon">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Report this listing <br>
                        <p> 223 Park Slope, 223 4th Avenue</p>
                        </h4>
                        <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->

                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="profilecard-detaill">
                            <h3> Report reason</h3>
                            <div class="form-group">
                                <select class="form-control" id="sel1">
                                    <option>No longer available</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div class="form-group text-message">
                                <textarea placeholder="Write Your Message"></textarea>
                            </div>

                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Send</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
    mapWithNearbyLocations(@php echo $listing->map_location; @endphp, document.getElementById('map'), true ) ;
</script>
<script>
  $('.calendarCarasoule #calendar-slider').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:3
        },
        600:{
            items:6
        },
        768:{
            items:7
        },
        992:{
            items:4
        },
         1024:{
            items:4
        },
        1366:{
            items:5
        }
    }
})



  $(document).ready(function(){
  $(".after-radio-textarea a").click(function(){
    $(".calendar-wrap").hide();
    $(".successfull-msg").show();
  });
 $(".apointment-tabs ul li").click(function(){l
    $(".apointment-tabs ul li").removeClass('active');
    $(this).addClass('active');
 });
});
  </script>
@endsection



