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
                        @foreach($featured_listings->recommended as $key => $rl)
                            {!! property_thumbs($rl) !!}
                        @endforeach
                        @if($featured_listings->recommended->total() < 1)
                            No Recommended Lists Found
                        @endif
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-1">
                            @foreach($featured_listings->recommended as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                            @if($featured_listings->recommended->total() < 1)
                                No Recommended Lists Found
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab2">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @foreach($featured_listings->trending as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                        @if(count($featured_listings->trending) < 1)
                            <span>No Trending Lists Found</span>
                        @endif
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-2">
                            @foreach($featured_listings->trending as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                            @if(count($featured_listings->trending) < 1)
                                <span>No Trending Lists Found</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab3">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @foreach($featured_listings->price as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                        @if(count($featured_listings->price) < 1)
                            <span>No Lists Found</span>
                        @endif
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-1">
                            @foreach($featured_listings->price as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                            @if(count($featured_listings->price) < 1)
                                <span>No Lists Found</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane no-mobile-tabs" id="tab4">
                <div class="property-listing">
                    <div class="desktop-listiing">
                        @foreach($featured_listings->pet_policy as $key => $fl)
                            {!! property_thumbs($fl) !!}
                        @endforeach
                        @if(count($featured_listings->pet_policy) < 1)
                            <span>No Pets Friendly Lists Found</span>
                        @endif
                    </div>

                    <div class="owl-slider">
                        <div class="owl-carousel owl-theme" id="carousel-2">
                            @foreach($featured_listings->pet_policy as $key => $fl)
                                <div class="item">
                                    {!! property_thumbs($fl) !!}
                                </div>
                            @endforeach
                            @if(count($featured_listings->pet_policy) < 1)
                                <span>No Pets Friendly Lists Found</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--Check Availability--}}
@include('modals.check_availability')

<script type="text/javascript">
    $('.owl-slider #carousel-1, .owl-slider #carousel-2, .owl-slider #carousel-3').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        margin: 15,
        nav: true,
        dots:false,
        responsive: {
            0: {
                items: 1
            },

            577: {
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
