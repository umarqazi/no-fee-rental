@extends('layouts.app')
@section('title', 'Site Map')
@section('content')
    <section class="neighborhood-search neighbourhood-pd contact-us site-map-wrapper wow fadeIn" data-wow-delay="0.2s">
        <div class="site-map-banner">
            <h4 class="blog-banner-text">Site Map</h4>
        </div>
        <div class="site-map-content">
            <ul class="steps-progress">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="container">
            <div class="let-us-help-modal">
                {!! neighborhood_site_map() !!}
            </div>

            <div class="links-section">
                <h3>Links</h3>
                <div class="links-section-content">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <ul class="neighborhood-list">
                                <li><a href="{{ route('web.listsByRent') }}">Rent</a> </li>
                                <li><a href="{{ route('web.listsByNeighborhood') }}">Neighborhood</a> </li>
                                <li><a href="{{ route('web.renterGuide') }}">Renter Guide</a> </li>
                                <li><a href="{{ route('web.rentCalculator') }}">Rent Calculator</a> </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <ul class="neighborhood-list">
                                <li><a href="{{ route('web.helpAndAnswer') }}">Help and Answers</a> </li>
                                <li><a href="{{ route('web.blog') }}">Blog</a> </li>
                                <li><a href="{{ route('web.feedback') }}">Feedback</a> </li>
                                <li><a href="{{ route('web.aboutUs') }}">Our Story</a> </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <ul class="neighborhood-list">
                                <li><a href="{{ route('web.press') }}">Press</a> </li>
                                <li><a href="{{ route('web.privacyPolicy') }}">Privacy Policy</a> </li>
                                <li><a href="{{ route('web.terms') }}">Terms</a> </li>
                                <li><a href="{{ route('web.advertise') }}">Advertise with us</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
