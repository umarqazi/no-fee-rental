@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
<header>
	<div class="header-bg inner-pages-banner"></div>
</header>
<section class="neighborhood-search wow fadeIn listing-detail-container" data-wow-delay="0.2s">
		<div class="container-lg">
			<div class="row">
				<div class="col-lg-7">
					<div class="item">
						<div class="clearfix" style="max-width:100%;">
							<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
								@foreach($listing->listingImages as $li)
									<li data-thumb="{{asset('storage/'.$li->listing_image)}}">
										<img src="{{asset('storage/'.$li->listing_image)}}" />
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-5 ">
					<div class="listing-info">
						<div class="product-title">
							<p>$5,500 • Two Bedrooms </p>
							<span>
							<a href="#"><img src="assets/images/share-icon.png" alt="" /> </a>
							<a href="#" class="ml-2"><img src="assets/images/fav-icon.png" alt="" /> </a>
						</span>
						</div>
						<p class="title-subtext">{{ $listing->street_address }}</p>
						<div class="apartment-details">
							Apartment Details <br>
							<span>${{ $listing->rent }}, {{ $listing->bedrooms.' '.(($listing->bedrooms > 1) ? 'Bedrooms' : 'Bedroom') }}, {{ $listing->baths.' '.(($listing->baths > 1) ? 'Baths' : 'Bath') }}</span>
						</div>
						<ul class="info-listing">
							<li>
								<p>
									<strong>Last Updated</strong><br>
									<span>{{ $listing->updated_at->diffForHumans() }}</span>
								</p>
							</li>
							<li>
								<p>
									<strong>Availble</strong><br>
									<span>{{ (config('constants.available'))[$listing->available] }}</span>
								</p>
							</li>
							<li>
								<p>
									<strong>Listed For</strong><br>
									<span>29 days</span>
								</p>
							</li>
							@foreach(features($listing->listingTypes, true) as $type => $values)
							<li>
								<p>
									<strong>{{ $type }}</strong><br>
									@foreach($values as $value)
										<span><i class="fa fa-angle-right"></i> {{$value}}</span>
									@endforeach
								</p>
							</li>
							@endforeach
							<li>
								<p>
									<img src="assets/images/sq-icon.png" alt="" class="mr-2" />
									<span>{{ $listing->square_feet }} Sq. Ft</span>
								</p>
							</li>
							<li>
								<p>
									<img src="assets/images/web-icon.png" alt="" class="mr-2" />
									<span>Web Id : 00123</span>
								</p>
							</li>
						</ul>
						<div class="near-by">
							Near By Subway Stations
						</div>
						<div class="near-by-info">
							<div>
								<img src="assets/images/numbers.png" alt="" />
							</div>
							<div>
								<p> 51st St (0.25 mi) </p>
								<p>42 Street - Grand Central (0.26 mi) </p>
								<p>Lexington Av-53 St (0.34 mi </p>
								<p>5th Av (0.5 mi) </p>
							</div>
						</div>
						<div class="text-center mt-5">
							<button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
						</div>
						<div class="interested-title">
							Interested in this apartment? Listings
						</div>
						<div class="agent-appointment">
							<div class="agent-info">
								<img src="assets/images/agent-img.jpg" alt="" />
								<p>Jeff Clarke<br><span>646-470-7445</span></p>
							</div>
							<button class="btn-default">Make an appointment</button>
						</div>
					</div>
				</div>
			</div>
			<h3 class="mt-5 mb-3">Description</h3>
			<p>
				{{ $listing->description }}</p>
			<h3 class="mt-5 mb-3">Nearby Buildings </h3>

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
@endsection
