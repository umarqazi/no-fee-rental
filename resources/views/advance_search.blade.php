@extends('layouts.app')
@section('title', 'No Fee Rental | Search')
@section('content')
    <section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
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
{{--    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>--}}
{{--    <div class="header-bg inner-pages-banner"></div>--}}
{{--    <div class="clearfix"></div>--}}
{{--    <section class="property-wrap main-wrapper">--}}
{{--        <div class="container-lg">--}}
{{--            <div class='row'>--}}
{{--                <div class='col-md-3'>--}}
{{--                    <div class='search-box'>--}}
{{--                        <form class='search-form'>--}}
{{--                            <input class='form-control' placeholder='ex: Ruby, Rails,' type='text'>--}}
{{--                            <button class='btn btn-link search-btn'>--}}
{{--                                <i class="fas fa-search"></i>--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="dropdown dropdown-price-range">--}}
{{--                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">--}}
{{--                            Price Range--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu">--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="slider-wrapper">--}}
{{--                                    <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field input-style" />--}}
{{--                                    <div id="slider-range" class="price-filter-range slider-rangeadvance" name="rangeInput"></div>--}}
{{--                                    <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field input-style" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="dropdown dropdown-price-range">--}}
{{--                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">--}}
{{--                            Size--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu size-dropdown">--}}
{{--                            <label class="label">Beds</label>--}}
{{--                            <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                <button type="button" class="btn btn-secondary">Any</button>--}}
{{--                                <button type="button" class="btn btn-secondary">Studio</button>--}}
{{--                                <button type="button" class="btn btn-secondary">1</button>--}}
{{--                                <button type="button" class="btn btn-secondary">2</button>--}}
{{--                                <button type="button" class="btn btn-secondary">3</button>--}}
{{--                                <button type="button" class="btn btn-secondary">4+</button>--}}
{{--                            </div>--}}
{{--                            <label class="label">Beds</label>--}}
{{--                            <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                <button type="button" class="btn btn-secondary">Any</button>--}}
{{--                                <button type="button" class="btn btn-secondary">Studio</button>--}}
{{--                                <button type="button" class="btn btn-secondary">1</button>--}}
{{--                                <button type="button" class="btn btn-secondary">2</button>--}}
{{--                                <button type="button" class="btn btn-secondary">3</button>--}}
{{--                                <button type="button" class="btn btn-secondary">4+</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2">--}}
{{--                    <a href="#" class="btn update-btn">Update </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="container-lg new-found-results ">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-8 show-class">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-8">--}}
{{--                            <h4>{{ $results->total() }} Results found </h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="sel1" style="    position: absolute;margin-left: -80px;padding: 10px;">Sort By:</label>--}}
{{--                                <select class="form-control" id="sel1">--}}
{{--                                    <option>1</option>--}}
{{--                                    <option>2</option>--}}
{{--                                    <option>3</option>--}}
{{--                                    <option>4</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--List view listing-->--}}
{{--                    <div class="listing-wrapper ">--}}
{{--                        @foreach($results as $result)--}}
{{--                            <div class="listing-row">--}}
{{--                            <div class="img-holder">--}}
{{--                                <img src="{{ !empty($result->thumbnail)--}}
{{--                                    ? asset('storage/'.$result->thumbnail)--}}
{{--                                    : asset('storage/uploads/listing/thumbnails/default.jpg')--}}
{{--                                }}" alt="" class="main-img" />--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <label>${{ $result->rent }}/month</label>--}}
{{--                            </div>--}}
{{--                            <div class="info">--}}
{{--                                <p class="title">{{ $result->street_address }}</p>--}}
{{--                                <p><i class="fa fa-tag"></i> ${{ $result->rent }}</p>--}}
{{--                                <p>Freshness Score : 90%</p>--}}
{{--                                <ul>--}}
{{--                                    <li><i class="fa fa-bed"></i> {{ $result->bedrooms }} Bed</li>--}}
{{--                                    <li><i class="fa fa-bath"></i> {{ $result->baths }} Bath</li>--}}
{{--                                </ul>--}}
{{--                                <p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>--}}
{{--                                <p>Posted: {{ date('m/d/y h:m:i', strtotime($result->created_at)) }}</p>--}}

{{--                                <div class="actions-btns">--}}
{{--                                    <button type="button" class="border-btn">Appointment</button>--}}
{{--                                    <button type="button" class="border-btn">Check Availability</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                            {!! Form::hidden('map_location', $result->map_location, ['class' => 'map_location']) !!}--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                    {{ $results->render() }}--}}
{{--                </div>--}}
{{--                <div class="col-md-4 propertyy-map-sec">--}}
{{--                    <div id="map"></div>--}}
{{--                    <div class="minimize-button">--}}
{{--                        <i class="fa fa-arrow-left aroows"> </i>--}}
{{--                        <span class="fa fa-arrow-right aroows"> </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{!! HTML::script('assets/js/map.js') !!}
{!! HTML::script('assets/js/jquery.nicescroll.min.js') !!}
<script>
    $(document).ready(function() {
        $("#boxscroll2").niceScroll("#contentscroll2", {
            cursorcolor:"#223971",
            cursoropacitymax:0.9,
            boxzoom:true,
            touchbehavior:true
        });  // Second scrollable DIV
    });
</script>
@endsection
