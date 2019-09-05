@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
<script src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#223971",cursoropacitymax:0.9,boxzoom:true,touchbehavior:true});  // Second scrollable DIV
  });
  
</script>

<section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
		<div class="container-lg">
			<div class="sorting-listing">
				<select class="custom-select-list">
					<option>Neighborhood</option>
					<option>Neighborhood</option>
					<option>Neighborhood</option>
					<option>Neighborhood</option>
				</select>
				<div class="bettery-park">Battery Park</div>
			</div>
			<p>Situated on the southernmost point of Manhattan, you will find the Financial District. As a district, it encompasses roughly the area south of City Hall Park, but does not include Battery Park or Battery Park City. The heart of the Financial District is considered to be the corner of Wall Street and Broad Street, both of which are contained entirely within the district. The offices and headquarters of many of New York City’s financial institutions are located here, including the New York Stock Exchange. While it is primarily known as the home of financial institutions, the Financial District is becoming increasingly a residential district, as many of those who work in the area now look for opportunities to live near their offices. You will find here hundreds of high raises, ranging from the new to landmark buildings, with some of the most spectacular and impressive architecture to be found anywhere in New York City. And in this district, luxury and top quality is a given...</p>
		</div>
		<div class="search-result-wrapper">
			<div class="search-listing">
				<div class="row">
					<div class="search-bdr-top col-lg-12">
						<div class="row">
					<div class="col-lg-8 col-8" id="search-tabs-sec">
						<!-- Nav pills -->
					  <ul class="nav nav-pills" role="tablist">
					    <li class="nav-item">
					      <a class="nav-link active" data-toggle="pill" href="#home">Neighbourhood</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="pill" href="#menu1">Beds</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="pill" href="#menu2">Baths</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="pill" href="#menuPrice">Price</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="pill" href="#menuMore">More</a>
					    </li>
					  </ul>
					</div>
					<div class="col-lg-4 col-4">
						<div class="sort-by-wrapper">
							<div class="sort-by">
								<span>Sort By: </span>
								<select class="custom-select-list">
									<option>Square Feet</option>
									<option>Select</option>
									<option>Select</option>
									<option>Select</option>
								</select>
							</div>
							<!-- <i class="fa fa-th-large listing-large-view"></i> -->
						</div>
					</div>
					</div>
				</div>
					<div class="col-lg-12" >
						 <!-- Tab panes -->
					  <div class="tab-content">
					    <div id="home" class=" tab-pane active"><br>
					      <h4>HOME</h4>
					      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					    </div>
					    <div id="menu1" class=" tab-pane fade"><br>
					      <h4>Menu 1</h4>
					      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					    </div>
					    <div id="menu2" class=" tab-pane fade"><br>
					      <h4>Menu 2</h4>
					      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
					    </div>
					    <div id="menuPrice" class=" tab-pane fade"><br>
					      <h4>Menu 2</h4>
					      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
					    </div>
					    <div id="menuMore" class=" tab-pane fade"><br>
					      <h4>Menu 2</h4>
					      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
					    </div>
					  </div>
					</div>
				</div>
				<h3>Manhattan, NY Rental</h3>
				<span>328+ places available for rent </span>
				<div id="boxscroll2">
				<div class="featured-properties" id="contentscroll2">
					<div class="property-listing desktop-listing">
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

					<div class="property-listing mobile-listing">
						<div class="owl-carousel owl-theme">
							<div class="item">
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
							<div class="item">
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
							<div class="item">
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
				</div>
			</div>
			</div>

			<div class="map-wrapper">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4816.459725725764!2d-1.5508326210331098!3d52.87227474539793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4879f73fd75747e9%3A0xccb1537b184bcded!2sFindern%2C+Derby%2C+UK!5e0!3m2!1sen!2s!4v1557903251137!5m2!1sen!2s" width="100%" height="95%" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			
		</div>

	</section>
@endsection


