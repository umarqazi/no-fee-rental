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
                                <li data-thumb="{{ asset($images->listing_image ? $images->listing_image : DLI) }}" class="large-view">
                                    <a target="_blank" href="{{ asset($images->listing_image ? $images->listing_image : DLI) }}">
                                        <img src="{{ asset($images->listing_image ? $images->listing_image : DLI) }}" />
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
                        <p> {{$listing->display_address}} </p>
                        <span>
                            <a href="javascript:void(0);"><img src="/assets/images/share-icon.png" alt="" /> </a>
                            <a href="javascript:void(0);" class="ml-2"><img src="/assets/images/fav-icon.png" alt="" /> </a>
                        </span>
                    </div>
                    <p class="title-subtext">{{$listing->street_address}}</p>
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
                            <li> <i class="fas fa-bed"></i> {{$listing->bedrooms}} {{ $listing->bedrooms > 1 ? 'Beds' : 'Bed'}} </li>
                             <li> <i class="fas fa-bath"> </i> {{$listing->baths}} {{ $listing->baths > 1 ? 'Baths' : 'Bath' }} </li>
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
                            <p> 1 agent from <strong>Arraynyc </strong></p>
                        </div>
                        <div class="appointment-buttons-section">
                            @if(compareDates($listing->open_house, now()) && !isAdmin())
                                <a href="#check-availability" data-target="#check-availability" data-toggle="modal" class="btn apointment-btn">
                                    Appointment
                                </a>
                            @endif
                            <a href="#" class="btn contct-agent-btn">Check Availability </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-3">Description</h3>
        <p>{{$listing->description ?? 'N/A'}}</p>
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
                        <input type="hidden" value="{{$listing->map_location}}" name="map_location">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
{{--        <h3 class="mt-5 mb-3">Nearby Buildings </h3>--}}
{{--        <div class="related-carasoule-sec">--}}
{{--            <div class="owl-slider">--}}
{{--                <div id="carousel" class="owl-carousel">--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <img class="owl-lazy" data-src="/assets/images/large-view-6.jpg" alt="first-img"> <i class="fas fa-star"></i>--}}
{{--                        <label>$8,000 / month </label>--}}
{{--                        <div class="item-inner">--}}
{{--                            <p>195 Santon Street Lower East Side, Manhattan -#5B </p>--}}
{{--                            <p> <i class="fas fa-bed"> 4 Beds</i> <i class="fas fa-bath"> 2 Baths </i></p>--}}
{{--                            <p><i class="far fa-clock"> 6 days since last update</i> </p>--}}
{{--                            <a href="#" class="btn "> Quick Contact</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

</section>
{{--			<div class="featured-properties nearby-listing">--}}
{{--				<div class="property-listing ">--}}
{{--					<div class="property-thumb">--}}
{{--						<div class="check-btn">--}}
{{--							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>--}}
{{--						</div>--}}
{{--						<span class="heart-icon"></span>--}}
{{--						<img src="assets/images/gallery-img.jpg" alt="" class="main-img">--}}
{{--						<div class="info">--}}
{{--							<a href="#">--}}
{{--								<p>$3,200 / Month </p>--}}
{{--								<ul>--}}
{{--									<li><i class="fa fa-bed"></i> 2</li>--}}
{{--									<li><i class="fa fa-bath"></i> 2</li>--}}
{{--								</ul>--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="property-thumb">--}}
{{--						<div class="check-btn">--}}
{{--							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>--}}
{{--						</div>--}}
{{--						<span class="heart-icon"></span>--}}
{{--						<img src="/assets/images/gallery-img.jpg" alt="" class="main-img">--}}
{{--						<div class="info">--}}
{{--							<a href="#">--}}
{{--								<p>$3,200 / month </p>--}}
{{--								<ul>--}}
{{--									<li><i class="fa fa-bed"></i> 2</li>--}}
{{--									<li><i class="fa fa-bath"></i> 2</li>--}}
{{--								</ul>--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="property-thumb">--}}
{{--						<div class="check-btn">--}}
{{--							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>--}}
{{--						</div>--}}
{{--						<span class="heart-icon"></span>--}}
{{--						<img src="/assets/images/gallery-img.jpg" alt="" class="main-img">--}}
{{--						<div class="info">--}}
{{--							<a href="#">--}}
{{--								<p>$3,200 / Month </p>--}}
{{--								<ul>--}}
{{--									<li><i class="fa fa-bed"></i> 2</li>--}}
{{--									<li><i class="fa fa-bath"></i> 2</li>--}}
{{--								</ul>--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="property-thumb">--}}
{{--						<div class="check-btn">--}}
{{--							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>--}}
{{--						</div>--}}
{{--						<span class="heart-icon"></span>--}}
{{--						<img src="assets/images/gallery-img.jpg" alt="" class="main-img">--}}
{{--						<div class="info">--}}
{{--							<a href="#">--}}
{{--								<p>$3,200 / Month </p>--}}
{{--								<ul>--}}
{{--									<li><i class="fa fa-bed"></i> 2</li>--}}
{{--									<li><i class="fa fa-bath"></i> 2</li>--}}
{{--								</ul>--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
    {{--Check Availability--}}
    @include('features.message')
    {{--Messages JS--}}
    {!! HTML::script('assets/js/map.js') !!}
{{--    {!! HTML::script('assets/js/message.js') !!}--}}
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
