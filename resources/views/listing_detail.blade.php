@extends('layouts.app') @section('title', 'No Fee Rental') @section('content')
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
                            <a href="javascript:void(0);" class="ml-2"><img src="/assets/images/fav-icon.png" alt="" /> </a>
                            <a href="javascript:void(0);" class="ml-2" data-toggle="modal" data-target="#flag-icon"><img src="/assets/images/flag-icon.png" alt="" class="flag-icon" /> </a>

                        </span>
                    </div>{{--
                    <p class="title-subtext">
                        555 10th Avenue, New York, NY 10036
                    </p>--}}

                    <div class="available-btn">
                        <div class="">
                            <span>NO FEE</span>
                        <span>Available</span>
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
                    <h3> Building Details</h3>
                    <div class="appointment-iconDetails">
                        <ul>
                            <!-- <li> <i class="fas fa-bed"></i> {{ str_formatting($listing->bedrooms, 'Bed') }} </li>
                            <li> <i class="fas fa-bath"> </i> {{ str_formatting($listing->baths, 'Bath') }} </li>
                            <li> <i class="fas fa-ruler"> </i> {{$listing->square_feet}} ft </li> -->
                            <li> <img src="/assets/images/price-icon.png" alt="" /> <span> ${{ $listing->rent }}</span></li>
                            <li> <img src="/assets/images/bed-icon.png" alt="" /> <span> {{ $listing->bedrooms }} Bedrooms</span></li>
                            <li> <img src="/assets/images/bath-icon.png" alt="" /> <span> {{ $listing->baths }} Baths</span></li>
                            <li> <img src="/assets/images/size-icon.png" alt="" /> <span> {{ $listing->square_feet}}</span></li>
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
                                    <strong> 0 Days</strong> 
                                </div>
                                <div class="lease-term-section">
                                   <span>Free months:: </span>
                                    <strong> None</strong>
                                </div>
                            </div>
                       
                            <div class="col-lg-6 col-sm-6">
                                <div class="lease-term-section">
                                    <span>Application fee: </span>
                                     <strong> $100.00</strong>
                                </div>
                                <div class="lease-term-section">
                                    <span>Deposit: </span>
                                    <strong> $5,600.00</strong>
                                </div>
                                <div class="lease-term-section">
                                    <span>Availability: </span>
                                    <strong> Yes</strong>
                                </div>
                              
                            </div>
                        </div>
                    </div>

                    <div class="open-house-section">
                        <h3> Open House</h3>
                        <div class="open-house-inner">
                            <div class="open-timings">
                                <p>Fri, Sep 27 | 8:00am - 9:00am </p>
                                <p>Set, Sep 28 | 12:00pm - 3:00pm </p>

                            </div>
                            <div class="apointment-interest-section">
                                <span> (By appointment only)</span>
                                <div class="request-send"><i class="fas fa-check-circle"></i>Request Sent </div>
                                <button class="btn btn-default">Interested</button>
                            </div>
                        </div>
                    </div>
                    <div class="appointment-section">
                        <ul>
                            <li>
                                <a href="#"><img src="/assets/images/account-img.jpg" alt="apointment"></a>
                            </li>
                            <li>
                                <h5> {{ $listing->agent->first_name.' '.$listing->agent->last_name }}</h5>
                                <p> {{ $listing->agent->company->company ?? 'None' }} </p>
                                <i class="far fa-comments"></i> 2 Renter Reviews </li>
                        </ul>
                    </div>

                    <div class="apointment-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Appointment</a></li>
                            <li><a data-toggle="tab" href="#menu1">Check Availability</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade active">
                                <div class="login-signup-tab">
                                    <div class="login-signup">
                                        <h5> You have to need to login or sign up to send request</h5>
                                        <a href="#" class="btn-default"> login</a>
                                        <a href="#" class="btn-default"> Signup</a>
                                    </div>
                                    <div class="successfull-msg">
                                        <i class="fas fa-check-circle"></i>
                                        <h5> Your request has been sent sucessfully</h5>
                                    </div>
                                </div>

                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Jeff Clark" />
                                    <input type="email" name="email" class="form-control" placeholder="jeffclark@gmail.com" />
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                    <button class="btn btn-default text-center"> Send</button>
                                </div>
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
                <div class="col-sm-3">
                    @dd($listing)
                    <h3>Listing Type </h3>
                    <ul class="second-ul"> 
                        <li> Exclusive </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h3>Amenities </h3>
                    <ul class="second-ul"> 
                        <li> Furnished </li>
                        <li> In-Unit Laundry </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h3>Unit Furnature </h3>
                    <ul class="second-ul"> 
                        <li> Outdoor Space </li>  
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h3>Pet Policy </h3>
                    <ul class="second-ul"> 
                        <li> Pet Allowed</li>  
                    </ul>
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
                    <div class="property-thumb">
                        <div class="check-btn">
                            <a href="javascript:void(0);">
                                <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                            </a>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="http://localhost:8000/storage/images/listing/thumbnails/J8Zn8iCVOXTkvClFPICE.jpg" alt="" class="main-img">
                        <div class="info">
                            <div class="info-link-text">
                                <p> $2323 </p>
                                <small> 1 Bed ,1 Bath </small>
                                <p> Utrecht, Netherlands - 1</p>
                            </div>
                            <a href="http://localhost:8000/listing-detail/1" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$2323 / Month </p>
                            <span>1 Bed ,1 Bath </span>
                        </div>
                    </div>
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
        <div class="modal" id="flag-icon">
            <div class="modal-dialog">
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
{{--Check Availability--}} @include('modals.check_availability') {{--Make Appointment--}} @include('modals.appointment')
<script>
    mapWithNearbyLocations(@php echo $listing -> map_location; @endphp, document.getElementById('map'), true ) ;
</script>


<script type="text/javascript">
  
</script>
@endsection



