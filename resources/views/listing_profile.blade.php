@extends('layouts.app')
@section('title', 'Profile Listing')
@section('content')
    <section class="wow fadeIn featured-properties neighborhood-search agent-listing-profile"
             data-wow-delay="0.2s">
        <div class="container-lg">
            <div class="agent-profile-view">
                <div class="img-holder">
                    <img src="{{ is_realty_listing($agent->profile_image ?? DUI) }}" alt=""/>
                </div>
                <div class="agent-info">
                    <h2>{{ $agent->first_name.' '.$agent->last_name }}</h2>
                    <p>{{ $agent->description ?? 'No bio found' }}</p>
                    @if($agent->user_type != OWNER)
                        <p class="expertise"><strong>Languages:</strong>
                            <a href="javascript:void(0);">{{ $agent->languages !== '' ? $agent->languages : 'None' }}</a>
                        </p>
                        <p class="expertise"><strong>Neighborhood Expertise:</strong>
                            <a href="javascript:void(0);">{{ neighborhoodExpertise($agent->neighborExpertise) }}</a>
                        </p>
                    @endif
                    <div class="contact-info contact-info-mobile">
                        <div>
                            <img src="{{ Storage::url('assets/images/close-envelope-new.png') }}" alt=""/> <a
                                href="#">{{ $agent->email }}</a>
                        </div>
                        <div>
                            <img src="{{ Storage::url('assets/images/call-icon.png') }}" alt=""/>
                            <a href="javascript:void(0);">{{ $agent->phone_number ?? 'None' }}</a>
                        </div>
                        <div>
                            <img src="{{ Storage::url('assets/images/location.png') }}" alt=""/> <a
                                href="#">{{ $agent->address ?? 'None' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-section-padding">
            <div class="container-lg ">
                {{--Listing Results--}}
                @include('sections.search_results')
            </div>
        </div>
        <div class="clients-reviews-section">
            <div class="">
                <h3> What our clients say about him</h3>
                @if(sizeof($agent->reviews) > 0)
                <div class="owl-slider">
                    <div id="ClientCarousel" class="owl-carousel">
                        @foreach($agent->reviews as $key => $review)
                        <div class="item">
                            <!-- <img src="/assest/images/check.png" alt="item-img"> -->
                            <div class="item-first-img">
                                <img src="{{ Storage::url('assets/images/check-icon.png') }}"/>
                            </div>
                            <p>{{$review->review_message}}</p>
                            <div class="item-profile-img">
                                <img src="{{ is_realty_listing($review->from->profile_image ?? DUI) }}"/>
                            </div>
                            <strong>{{$review->from->first_name}} {{$review->from->last_name}}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                    <div style="text-align: center">No Reviews Found</div>
                @endif
            </div>
        </div>
    </section>
    <script>
        $('.owl-slider #carouselNeighbour , .owl-slider #ClientCarousel').owlCarousel({
            autoplay: true,
            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 7000,
            smartSpeed: 800,
            nav: true,
            dots: false,
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
            dots: false,
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
@endsection
