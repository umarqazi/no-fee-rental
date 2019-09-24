@extends('layouts.app') @section('title', 'No Fee Rental | Dashboard') @section('content')
<section class=" press-section wow fadeIn featured-properties neighborhood-search agent-listing-profile" data-wow-delay="0.2s"> 
    <div class="container-lg">
    <div class="agent-profile-view">
        <div class="img-holder">
            <img src="{{asset('assets/images/account-img.jpg')}}" alt="" />
        </div>
        <div class="agent-info">
            <h2>Jeff Clarke</h2>
            <p>Situated on the southernmost point of Manhattan, you will find the Financial District. As a district, it encompasses roughly the area south of City Hall Park, but does not include Battery Park or Battery Park City. The heart of the Financial District is considered to be the corner of Wall Street and Broad Street.</p>
            <p class="expertise"><strong>Neighborhood Expertise:</strong> <a href="#">Nolita,</a> <a href="#">Soho,</a> <a href="#">Greenwich Village</a></p>
            <div class="contact-info">
                <div>
                    <img src="assets/images/email.jpg" alt="" /> <a href="#">clarke@gmail.com</a>
                </div>
                <div>
                    <img src="assets/images/phone-icon.jpg" alt="" /> <a href="#">(123) 1233-456</a>
                </div>
                <div>
                    <img src="assets/images/map.jpg" alt="" /> <a href="#">1534 Some where st. san Diego, CA 92101</a>
                </div>
            </div>
            <div class="socail-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    </div>

<div class="profile-section-padding">

    <div class="container-lg ">
        <div class="search-result-wrapper">
            <div class="search-listing">
                <div class="row">
                    <div class="search-bdr-top col-lg-12">
                        <div class="mobile-view-dropdown">
                            <i class="fa fa-bars"></i> Filters
                        </div>
                        <div class="row profile-mbl-filter" id="mobile-tabs-collapse">
                            <div class="col-lg-9 col-12 ">
                                <div class="dropdown-wrap">
                                    <div class="radio-group-0">
                                        <div class="item">
                                            <label>Any
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>Studio
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>1
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>2
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>3
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        inputsToDropdown('.radio-group-0', 'Neighbourhood', 'radio', '.radio-group-0', '');
                                    </script>
                                    <div class="radio-group-1">
                                        <div class="item">
                                            <label>Any
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>Studio
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>1
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>2
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>3
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
                                    </script>

                                    <div class="radio-group-2 ">
                                        <div class="item">
                                            <label>Any
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>Studio
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>1
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>2
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>3
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
                                    </script>
                                    <div class="price-dropdown">
                                        <button class="btn btn-default" data-toggle="modal" data-target="#advance-search">More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
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
                    <div class="col-lg-12"></div>
                </div>
                <h3>Manhattan, NY Rental</h3>
                <span>328+ places available for rent </span>
                <div id="boxscroll2">
                    <div class="featured-properties" id="contentscroll2">
                        <div class="property-listing neighbourhood-listing">
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>
                            <div class="property-thumb">
                                <div class="check-btn">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </div>
                                <span class="heart-icon"></span>
                                <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                <div class="info">
                                    <div href="#" class="info-link-text">
                                        <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                        <p> Battery Park </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                </div>
                                <div class="feaure-policy-text">
                                    <p>$12444 / Month </p>
                                    <span>2 bed , 1 bath </span>
                                </div>
                            </div>

                            <div class="owl-slider">
                                <div class="owl-carousel owl-theme" id="carouselNeighbour">
                                    <div class="item">
                                        <div class="property-thumb">
                                            <div class="check-btn">
                                                <a href="">
                                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                                </a>
                                            </div>
                                            <span class="heart-icon"></span>
                                            <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img" />
                                            <div class="info">
                                                <div class="info-link-text">
                                                    <p> $12444 / Month </p> <small> $1565645641 / Month  </small>
                                                    <p> 2 bed , 1 bath </p>
                                                </div>
                                                <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                            </div>
                                            <div class="feaure-policy-text">
                                                <p>$12444 / Month </p>
                                                <span>2 bed , 1 bath </span>
                                            </div>

                                        </div>
                                    </div>
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
                                        <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                        <div class="info">
                                            <div href="#" class="info-link-text">
                                                <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                                <p> Battery Park </p>
                                            </div>
                                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                        </div>
                                        <div class="feaure-policy-text">
                                            <p>$12444 / Month </p>
                                            <span>2 bed , 1 bath </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-thumb">
                                        <div class="check-btn">
                                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                        </div>
                                        <span class="heart-icon"></span>
                                        <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                        <div class="info">
                                            <div href="#" class="info-link-text">
                                                <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                                <p> Battery Park </p>
                                            </div>
                                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                        </div>
                                        <div class="feaure-policy-text">
                                            <p>$12444 / Month </p>
                                            <span>2 bed , 1 bath </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-thumb">
                                        <div class="check-btn">
                                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                        </div>
                                        <span class="heart-icon"></span>
                                        <img src="{{asset('assets/images/gallery-img.jpg')}}" alt="" class="main-img">
                                        <div class="info">
                                            <div href="#" class="info-link-text">
                                                <p> $ 12444 </p> <small>  1 bed , 4 baths  </small>
                                                <p> Battery Park </p>
                                            </div>
                                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                                        </div>
                                        <div class="feaure-policy-text">
                                            <p>$12444 / Month </p>
                                            <span>2 bed , 1 bath </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clients-reviews-section">
    <div class="container-lg">
        <h3> What our clients say about us</h3>
        <div class="owl-slider">
<div id="ClientCarousel" class="owl-carousel">
    <div class="item">
        <!-- <img src="/assest/images/check.png" alt="item-img"> -->
        <div class="item-first-img">
            <img src="{{asset('assets/images/check.png')}}"/> 
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
        <div class="item-profile-img">
            <img src="{{asset('assets/images/account-img.jpg')}}"/> 
        </div>
        <strong>Allan Collins</strong>
    </div>
    <div class="item">
        <!-- <img src="/assest/images/check.png" alt="item-img"> -->
        <div class="item-first-img">
            <img src="{{asset('assets/images/check.png')}}"/> 
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
        <div class="item-profile-img">
            <img src="{{asset('assets/images/account-img.jpg')}}"/> 
        </div>
        <strong>Allan Collins</strong>
    </div>
    <div class="item">
        <!-- <img src="/assest/images/check.png" alt="item-img"> -->
        <div class="item-first-img">
            <img src="{{asset('assets/images/check.png')}}"/> 
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
        <div class="item-profile-img">
            <img src="{{asset('assets/images/account-img.jpg')}}"/> 
        </div>
        <strong>Allan Collins</strong>
    </div>
    <div class="item">
        <!-- <img src="/assest/images/check.png" alt="item-img"> -->
        <div class="item-first-img">
            <img src="{{asset('assets/images/check.png')}}"/> 
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
        <div class="item-profile-img">
            <img src="{{asset('assets/images/account-img.jpg')}}"/> 
        </div>
        <strong>Allan Collins</strong>
    </div>
    <div class="item">
        <!-- <img src="/assest/images/check.png" alt="item-img"> -->
        <div class="item-first-img">
            <img src="{{asset('assets/images/check.png')}}"/> 
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
        <div class="item-profile-img">
            <img src="{{asset('assets/images/account-img.jpg')}}"/> 
        </div>
        <strong>Allan Collins</strong>
    </div>
</div>
</div>

    </div>
</div>

<div class="profile-contact-section profile-section-padding">
    <div class="container-lg">
        <h3>Leave a review </h3>
        <div class="row">
            <div class="col-sm-6">
           <div class="form-group">
            <label for="first-name">Your Name</label>
            <input type="text" name="firstName" class="form-control" placeholder="Write your name">
           </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
            <label for="first-name">Your email</label>
            <input type="email" name="emailName" class="form-control" placeholder="Write your email">
           </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Write a review </label>
                <textarea class="form-control" placeholder="Write your review here"></textarea>
                <button class="btn-default"> Post a review</button>
            </div>
        </div>
        </div>
    </div>
</div>
</section>



<!-- search modal -->
<div class="modal fade" id="advance-search">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{--Modal Header--}}
            <div class="modal-header">
                <h4 class="modal-title">Advance Search</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{--Modal body--}}
            <div class="modal-body">
                {!! Form::open(['url' => route('list.search'), 'method' => 'get', 'id' => 'search']) !!}
                <div class="row">
                    <div class="col-md-6 search-form-grou-mrg-btm">
                        <div class="form-group">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            <ul class="select-bed-options" id="beds">
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 'studio', false, ['class' => 'custom-control-input', 'id' => 'studio']) !!}
                                        <label class="custom-control-label" for="studio">Studio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 1, false, ['class' => 'custom-control-input', 'id' => 'beds1']) !!}
                                        <label class="custom-control-label" for="beds1">1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 2, false, ['class' => 'custom-control-input', 'id' => 'beds2']) !!}
                                        <label class="custom-control-label" for="beds2">2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 3, false, ['class' => 'custom-control-input', 'id' => 'beds3']) !!}
                                        <label class="custom-control-label" for="beds3">3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 4, false, ['class' => 'custom-control-input', 'id' => 'beds4']) !!}
                                        <label class="custom-control-label" for="beds4">4</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('beds', 5, false, ['class' => 'custom-control-input', 'id' => 'beds5']) !!}
                                        <label class="custom-control-label" for="beds5">5+</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label class="label">Baths <span>(Select all that applies)</span></label>
                            <ul class="select-bed-options" id="baths">
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 'studio', false, ['class' => 'custom-control-input', 'id' => 'studio']) !!}
                                        <label class="custom-control-label" for="studio">Studio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 1, false, ['class' => 'custom-control-input', 'id' => '1']) !!}
                                        <label class="custom-control-label" for="1">1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 2, false, ['class' => 'custom-control-input', 'id' => '2']) !!}
                                        <label class="custom-control-label" for="2">2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 3, false, ['class' => 'custom-control-input', 'id' => '3']) !!}
                                        <label class="custom-control-label" for="3">3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 4, false, ['class' => 'custom-control-input', 'id' => '4']) !!}
                                        <label class="custom-control-label" for="4">4</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        {!! Form::radio('baths', 5, false, ['class' => 'custom-control-input', 'id' => '5']) !!}
                                        <label class="custom-control-label" for="5">5+</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{--Baths--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Price Range</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                    {!! Form::number('priceRange[min_price]', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} - {!! Form::number('priceRange[max_price]', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                                </div>
                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Square feet</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                    {!! Form::number('priceRange[min_price_2]', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} - {!! Form::number('priceRange[max_price_2]', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                                </div>
                                <div id="slider-range-2" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                    </div>
                    {{--Keywords--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Neighbourhoods</label>
                            {!! Form::text('neighborhoods', null, ['id' => 'neigh', 'class' => 'input-style', 'placeholder' => 'Enter Neighborhood']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Open House</label>
                            {!! Form::text('open_house', null, ['autocomplete' => 'off', 'id' => 'timepicker-actions-exmpl', 'placeholder', 'Open House', 'class' => 'input-style']) !!}
                        </div>
                    </div>
                    {{-- Building Features--}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">@php $i = 1; @endphp @foreach(features() as $key => $values)
                                <div class="col-lg-3">
                                    <label class="label">{{ucwords(str_replace('_', ' ', $key))}}</label>
                                    <ul class="checkbox-listing">
                                        @foreach($values as $id => $f)@php $id += 1; $i += 1; @endphp @if($id == 6)
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="checkbox-listing" style="margin-top: 28px;">
                                        @endif
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                {!! Form::checkbox('amenities['.$key.'][]', $id, null, ['class' => 'custom-control-input', 'id' => "listitem{$i}"]) !!}
                                                <label class="custom-control-label" for="listitem{{$i}}">{{$f}}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-left mt-4 mb-4 bdr-top-btn">
                        <button type="submit" class="btn-default">Search</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>
<!-- search modal -->


<script>
    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").click(function() {
    $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
    $(".neighborhood-search .search-result-wrapper .search-listing").toggleClass('hide-list');
    $(".neighborhood-search .search-result-wrapper .map-wrapper").toggleClass('full-map');
    });
    $(".mobile-view-dropdown").click(function(){
        $(this).find("i").toggleClass('fa-bars fa-times');
        $("#mobile-tabs-collapse").slideToggle();
    });
    $(".dropdown-wrap .btn-default").click(function(){
        $(".dropdown-wrap .btn-default").removeClass("active");
        $(this).addClass("active");
    });

    $('.owl-slider #carouselNeighbour , .owl-slider #ClientCarousel').owlCarousel({
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

    $('.owl-slider #ClientCarousel').owlCarousel({
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
@endsection {!! HTML::script('assets/js/input-to-dropdown.js') !!}
<!--  -->
