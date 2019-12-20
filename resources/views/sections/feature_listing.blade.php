<section class="featured-properties">
    <div class="container-lg">
        <h2 class="text-center">Featured Properties</h2>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#tab1">Recommended</a>
            </li>
            <li class="nav-item no-mobile-tabs">
                <a class="nav-link" data-toggle="pill" href="#tab2">Trending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab3">Price</a>
            </li>
            <li class="nav-item no-mobile-tabs">
                <a class="nav-link" data-toggle="pill" href="#tab4">Pet Friendly</a>
            </li>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content wow fadeInUp" data-wow-delay="0.2s">
            <div class="tab-pane active" id="tab1">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @if(count($featured_listings['recent']) < 1)
                            <span>No List Found</span>
                        @endif
                        @foreach($featured_listings["recent"] as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-1">
                            @if(count($featured_listings['recent']) < 1)
                                <span>No List Found</span>
                            @endif
                            @foreach($featured_listings["recent"] as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab2">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @if(count($featured_listings['popular']) < 1)
                            <span>No List Found</span>
                        @endif
                        @foreach($featured_listings["popular"] as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-2">
                            @if(count($featured_listings['popular']) < 1)
                                <span>No List Found</span>
                            @endif
                            @foreach($featured_listings["popular"] as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab3">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @if(count($featured_listings['cheapest']) < 1)
                            <span>No List Found</span>
                        @endif
                        @foreach($featured_listings["cheapest"] as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-1">
                            @if(count($featured_listings['cheapest']) < 1)
                                <span>No List Found</span>
                            @endif
                            @foreach($featured_listings["cheapest"] as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab4">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @if(count($featured_listings['pet_policy']) < 1)
                            <span>No List Found</span>
                        @endif
                        @foreach($featured_listings["pet_policy"] as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-2">
                            @if(count($featured_listings['pet_policy']) < 1)
                                <span>No List Found</span>
                            @endif
                            @foreach($featured_listings["pet_policy"] as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @if(count($featured_listings['cheapest']) < 1)
                            <span>No List Found</span>
                        @endif
                        @foreach($featured_listings["cheapest"] as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                    </div>
                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-3">
                            @if(count($featured_listings['cheapest']) < 1)
                                <span>No List Found</span>
                            @endif
                            @foreach($featured_listings["cheapest"] as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
                            <!-- <small>For Rental</small> -->
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
{{--Check Availability--}}
@include('modals.check_availability')

<script type="text/javascript">
    $('.owl-slider #carousel-1, .owl-slider #carousel-2, .owl-slider #carousel-3').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: true,
        dots:false,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 2
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
