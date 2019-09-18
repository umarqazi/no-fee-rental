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
    <header>
        <div class="header-bg inner-pages-banner"></div>
    </header>
<section class="neighborhood-search wow fadeIn listing-detail-container" data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6">
                <div class="item">
                    <div class="clearfix" style="max-width:100%;">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @for ($i = 0; $i < sizeof($listing->listingImages); $i++)
                                <li data-thumb="{{asset('storage/'.$listing->listingImages[$i]->listing_image)}}" class="large-view">
                                <a target="_blank" href="{{ asset('storage/'.$listing->listingImages[$i]->listing_image) }}"><img src="{{ asset('storage/'.$listing->listingImages[$i]->listing_image) }}" /></a>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="listing-info">
                    <div class="product-title">
                        <p> {{$listing->display_address}} </p>
                        <span>
                            <a href="#"><img src="/assets/images/share-icon.png" alt="" /> </a>
                            <a href="#" class="ml-2"><img src="/assets/images/fav-icon.png" alt="" /> </a>
                        </span>
                    </div>
                    <p class="title-subtext">{{$listing->street_address}}</p>
                    <div class="unavailable-btn">
                        <span>Unavailable </span>
                        <i class="far fa-clock"></i>
                        <label> 21 hours since last update </label>
                    </div>
                    <div class="apartment-details">
                        <h4> $ {{$listing->rent}}/ month</h4>
                    </div>
                    <div class="row after-apartment-icon">
                        <div class="col-lg-3 col-3">
                            <i class="fas fa-bed"></i> {{$listing->bedrooms}} Beds
                        </div>
                        <div class="col-lg-3 col-3">
                            <i class="fas fa-bath"> </i> {{$listing->baths}} bath
                        </div>
                        <div class="col-lg-3 col-3">
                            <i class="fas fa-ruler"> </i> {{$listing->square_feet}} ft
                        </div>
                    </div>
                    <div class="row Availability-date-sec">
                        <div class="col-lg-6">
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
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-8 col-8">
                                    <span>Broker fee: </span>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <strong> No fee</strong>
                                </div>
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
                    <div class="appointment-section">
                        <div class="row">
                            <div class="col-lg-5">
                                <a href="#"><img src="/assets/images/careers-icon.png" alt="apointment"></a>
                                <p> 1 agent from <strong>Arraynyc </strong></p>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @if(compareDates($listing->open_house, now()) && !isAdmin())
                                            <a href="#check-availability" data-target="#check-availability" data-toggle="modal" class="btn apointment-btn">
                                                Appointment
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#" class="btn contct-agent-btn">Check Availability </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-3">Description</h3>
        <p>{{$listing->description}}</p>
        <div class="listing-aminities-sec">
            <h3>Amenities </h3>
            <div class=" col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <p>Listing Aminities </p>
                        <ul>
                            <li> Dishwasher</li>
                            <li> Storage Available</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <p>&nbsp; </p>
                        <ul>
                            <li> Terrace</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <p>BUILDING AMENITIES</p>
                        <ul>
                            <li> Doorman</li>
                            <li> Gym</li>
                            <li> Pets Allowed</li>
                            <li> Elevator</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <p>&nbsp;</p>
                        <ul>
                            <li> Laundry in Building</li>
                            <li> Garage Parking</li>
                            <li> Parking Available</li>
                            <li> Roof Deck</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="location-map-sec">
            <h3>Location </h3>
            <div class="row">

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <label> TRANSPORTATION</label>
                            <p>Jay St & Willoughby St </p>
                            <span class="span-box text-a"> A </span>
                            <span class="span-box text-c"> C </span>
                            <span class="span-box text-f"> F </span>
                            <span class="span-box text-r"> R </span>

                            <p>Smith St & Bergen St </p>
                            <span class="span-box text-f"> F </span>
                            <span class="span-box text-g"> G </span>

                            <p>Smith St & Bergen St </p>
                            <span class="span-box text-f"> F </span>
                            <span class="span-box text-g"> G </span>

                            <p>Court Street & Montague Street </p>
                            <span class="span-box text-r"> R </span>
                            <span class="span-box text-2"> 2 </span>
                            <span class="span-box text-2"> 3 </span>
                            <span class="span-box text-4"> 4 </span>
                            <span class="span-box text-4"> 5 </span>

                            <p>Cadman Plaza West & Montague St</p>
                            <span class="span-box text-r"> R </span>
                            <span class="span-box text-2"> 2 </span>
                            <span class="span-box text-2"> 3 </span>
                            <span class="span-box text-4"> 4 </span>
                            <span class="span-box text-4"> 5 </span>

                        </div>
                        <div class="col-lg-6 mob-top-mrg">
                            <label> Schools</label>
                            <ul>
                                <li> Brooklyn Law School</li>
                            </ul>
                            <label class="city-bike"> City Bike</label>
                            <ul class="second-ul">
                                <li>Clinton St & Joralemon St</li>
                                <li>Henry St & Atlantic Ave</li>
                                <li>State St & Smith Stt</li>
                                <li>Cadman Plaza West & Montague St</li>
                                <li>Schermerhorn St & Court St</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3403.339582092198!2d74.27331331462928!3d31.459843557277164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391903e9fe073afd%3A0xcec14940bde5aec4!2sTechverx!5e0!3m2!1sen!2s!4v1566307863547!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-3">Nearby Buildings </h3>
        <div class="related-carasoule-sec">
            <div class="owl-slider">
                <div id="carousel" class="owl-carousel">
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>
                        <label>$8,000 / month </label>
                        <div class="item-inner">
                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>
                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>
                            <p><i class="far fa-clock"> 6 days since last update</i> </p>
                            <a href="#" class="btn "> Quick Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
			<div class="featured-properties nearby-listing">
				<div class="property-listing ">
					<div class="property-thumb">
						<div class="check-btn">
							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
						</div>
						<span class="heart-icon"></span>
						<img src="assets/images/gallery-img.jpg" alt="" class="main-img">
						<div class="info">
							<a href="#">
								<p>$3,200 / Month </p>
								<ul>
									<li><i class="fa fa-bed"></i> 2</li>
									<li><i class="fa fa-bath"></i> 2</li>
								</ul>
							</a>
						</div>
					</div>
					<div class="property-thumb">
						<div class="check-btn">
							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
						</div>
						<span class="heart-icon"></span>
						<img src="/assets/images/gallery-img.jpg" alt="" class="main-img">
						<div class="info">
							<a href="#">
								<p>$3,200 / Month </p>
								<ul>
									<li><i class="fa fa-bed"></i> 2</li>
									<li><i class="fa fa-bath"></i> 2</li>
								</ul>
							</a>
						</div>
					</div>
					<div class="property-thumb">
						<div class="check-btn">
							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
						</div>
						<span class="heart-icon"></span>
						<img src="/assets/images/gallery-img.jpg" alt="" class="main-img">
						<div class="info">
							<a href="#">
								<p>$3,200 / Month </p>
								<ul>
									<li><i class="fa fa-bed"></i> 2</li>
									<li><i class="fa fa-bath"></i> 2</li>
								</ul>
							</a>
						</div>
					</div>
					<div class="property-thumb">
						<div class="check-btn">
							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
						</div>
						<span class="heart-icon"></span>
						<img src="assets/images/gallery-img.jpg" alt="" class="main-img">
						<div class="info">
							<a href="#">
								<p>$3,200 / Month </p>
								<ul>
									<li><i class="fa fa-bed"></i> 2</li>
									<li><i class="fa fa-bath"></i> 2</li>
								</ul>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    {{--Check Availability--}}
    @include('features.message')
    {{--Messages JS--}}
    {!! HTML::script('assets/js/message.js') !!}
    <script>
        // Create start date
        var start = new Date(),
            prevDay,
            startHours = 9;

        // 09:00 AM
        start.setHours(9);
        start.setMinutes(0);

        // If today is Saturday or Sunday set 10:00 AM
        if ([6, 0].indexOf(start.getDay()) !== -1) {
            start.setHours(10);
            startHours = 10
        }

        $('#timepicker-actions-exmpl').datepicker({
            timepicker: true,
            language: 'en',
            startDate: start,
            minHours: startHours,
            maxHours: 18,
            onSelect: function (fd, d, picker) {
                // Do nothing if selection was cleared
                if (!d) return;

                var day = d.getDay();

                // Trigger only if date is changed
                if (prevDay != undefined && prevDay == day) return;
                prevDay = day;

                // If chosen day is Saturday or Sunday when set
                // hour value for weekends, else restore defaults
                if (day == 6 || day == 0) {
                    picker.update({
                        minHours: 10,
                        maxHours: 16
                    })
                } else {
                    picker.update({
                        minHours: 9,
                        maxHours: 18
                    })
                }
            }
        })
    </script>

@endsection
