@extends('layouts.app')
@section('title', 'No Fee Rental | Profile')
@section('content')
<section class=" press-section wow fadeIn featured-properties neighborhood-search agent-listing-profile" data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="agent-profile-view">
            <div class="img-holder">
                <img src="{{ asset($data->agent->thumbnail ?? DUI) }}" alt="" />
            </div>
            <div class="agent-info">
                <h2>{{ $data->agent->first_name.' '.$data->agent->last_name }}</h2>
                <p>{{ $data->agent->description ?? 'No description found' }}</p>
                <p class="expertise"><strong>Neighborhood Expertise:</strong> <a href="#">Nolita,</a>
                    <a href="#">Soho,</a>
                    <a href="#">Greenwich Village</a>
                </p>
                <div class="contact-info">
                    <div>
                        <img src="assets/images/email.jpg" alt="" /> <a href="#">{{ $data->agent->email }}</a>
                    </div>
                    <div>
                        <img src="assets/images/phone-icon.jpg" alt="" />
                        <a href="javascript:void(0);">{{ $data->agent->phone_number ?? 'Null' }}</a>
                    </div>
                    <div>
                        <img src="assets/images/map.jpg" alt="" /> <a href="#">1534 Some where st. san Diego, CA 92101</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="profile-section-padding">
    <div class="container-lg ">
        <div class="search-result-wrapper">
            <div class="search-listing">
                {{--Listing Results--}}
                @include('sections.search_results')
            </div>
        </div>
    </div>
</div>

<div class="clients-reviews-section">
    <div class="container-lg">
        <h3> What our clients say about him</h3>
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
{{--Search Modal--}}
{{--@include('modals.advance_search')--}}


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
