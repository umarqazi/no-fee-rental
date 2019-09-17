<section class="featured-properties">
    <div class="container-lg">
        <h2 class="text-center">Featured Properties</h2>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#tab1">Recent</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab2">Cheapest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab3">Popular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab4">Pet Policy</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content wow fadeInUp" data-wow-delay="0.2s">
            <div class="tab-pane active" id="tab1">
                <div class="property-listing">
                    @foreach($featured_listings as $key => $fl)
                    <div class="property-thumb">
                        <div class="check-btn">
                            <a href="{{ route('listing.detail', $fl->id) }}">
                                <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                            </a>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="{{ asset('storage/'.$fl->thumbnail) }}" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $ {{ $fl->rent }} </p> <small> {{ $fl->bedrooms }} {{ $fl->bedrooms > 1 ? 'beds' : 'bed' }} , {{ $fl->baths }} {{ $fl->baths > 1 ? 'baths' : 'bath' }} </small>
                                <p> {{ $fl->display_address }} </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>${{ $fl->rent }} / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="tab2">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        <div class="property-thumb">
                            <div class="check-btn">
                                <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                            </div>
                            <span class="heart-icon"></span>
                            <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                            <div class="info">
                                <a href="#" class="info-link-text">
                                    <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                    <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                </a>
                                <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                            </div>
                            <div class="feaure-policy-text">
                                <p>$3,200 / Month </p>
                                <span>2 bed , 1 bath </span>
                            </div>
                        </div>
                        <div class="property-thumb">
                            <div class="check-btn">
                                <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                            </div>
                            <span class="heart-icon"></span>
                            <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                            <div class="info">
                                <a href="#" class="info-link-text">
                                    <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                    <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                </a>
                                <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                            </div>
                            <div class="feaure-policy-text">
                                <p>$3,200 / Month </p>
                                <span>2 bed , 1 bath </span>
                            </div>
                        </div>
                        <div class="property-thumb">
                            <div class="check-btn">
                                <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                            </div>
                            <span class="heart-icon"></span>
                            <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                            <div class="info">
                                <a href="#" class="info-link-text">
                                    <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                    <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                </a>
                                <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                            </div>
                            <div class="feaure-policy-text">
                                <p>$3,200 / Month </p>
                                <span>2 bed , 1 bath </span>
                            </div>
                        </div>
                    </div>
                    <div class="owl-slider">
                        <div id="carousel-1" class="owl-carousel">
                            <div class="item">
                                <div class="property-thumb">
                                    <div class="check-btn">
                                        <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                                    </div>
                                    <span class="heart-icon"></span>
                                    <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                                    <div class="info">
                                        <a href="#" class="info-link-text">
                                            <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                            <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                        </a>
                                        <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                    </div>
                                    <div class="feaure-policy-text">
                                        <p>$3,200 / Month </p>
                                        <span>2 bed , 1 bath </span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-thumb">
                                    <div class="check-btn">
                                        <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                                    </div>
                                    <span class="heart-icon"></span>
                                    <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                                    <div class="info">
                                        <a href="#" class="info-link-text">
                                            <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                            <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                        </a>
                                        <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                    </div>
                                    <div class="feaure-policy-text">
                                        <p>$3,200 / Month </p>
                                        <span>2 bed , 1 bath </span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-thumb">
                                    <div class="check-btn">
                                        <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                                    </div>
                                    <span class="heart-icon"></span>
                                    <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                                    <div class="info">
                                        <a href="#" class="info-link-text">
                                            <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                            <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                                        </a>
                                        <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                    </div>
                                    <div class="feaure-policy-text">
                                        <p>$3,200 / Month </p>
                                        <span>2 bed , 1 bath </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tab3">
                <div class="property-listing">
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab4">
                <div class="property-listing">
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#appointmentModal">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="btn-default">view all</a>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- The Modal -->
    <div class="modal" id="appointmentModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="assets/images/large-view-9.jpg">
                        </div>
                        <div class="col-lg-8 padding-leftt-0">
                            <h3> 345 SOUTH END AVENUE, #5P</h3>
                            <strong> $2,815 </strong>
                            <!--  <small>For Rental</small> -->
                            <div class="after-border"></div>
                            <div class="bedroms-baths-text">
                                <i class="fas fa-home"></i> <span> 2 Bedrooms, 3 Rooms, 2 Baths</span>

                            </div>
                        </div>

                    </div>
                    <textarea placeholder="Message"></textarea>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="#" class="btn "> Send Request</a>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" class="btn " data-dismiss='modal'> Cancel</a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal footer -->

        </div>
    </div>
</div>

<script type="text/javascript">
    $('.owl-slider #carousel-1').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 1
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });
</script>