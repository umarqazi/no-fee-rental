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
                                <li><a href="{{ route('web.ListsByRent') }}">Rent</a> </li>
                                <li><a href="{{ route('web.neighborhood') }}">Neighborhood</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=49">Renter Guide</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=233">Rent Calculator</a> </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <ul class="neighborhood-list">
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?post_type=help_and_answers">Help and Answers</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/">Blog</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=187">Feedback</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66">Our Story</a> </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <ul class="neighborhood-list">
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=70">Press</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=3">Privacy Policy</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=27">Terms</a> </li>
                                <li><a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=195">Advertise with us</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
