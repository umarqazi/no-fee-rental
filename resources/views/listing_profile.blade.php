@extends('layouts.app')
@section('title', 'No Fee Rental | Profile')
@section('content')
    <section class="wow fadeIn featured-properties neighborhood-search agent-listing-profile"
             data-wow-delay="0.2s">
        <div class="container-lg">
            <div class="agent-profile-view">
                <div class="img-holder">
                    <img src="{{ asset($data->agent->profile_image ?? DUI) }}" alt=""/>
                </div>
                <div class="agent-info">
                    <h2>{{ $data->agent->first_name.' '.$data->agent->last_name }}</h2>
                    <p>{{ $data->agent->description ?? 'No description found' }}</p>
                    <p class="expertise"><strong>Neighborhood Expertise:</strong>
                        <a href="javascript:void(0);">{{ neighborhoodExpertise($data->agent->neighborExpertise) }}</a>
                    </p>
                    <p class="expertise"><strong>Languages:</strong> <a
                            href="javascript:void(0);">{{ $data->agent->languages  ?? 'None' }}</a>
                    </p>
                    <div class="contact-info contact-info-mobile">
                        <div>
                            <img src="{{ asset('assets/images/close-envelope-new.png') }}" alt=""/> <a
                                href="#">{{ $data->agent->email }}</a>
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/call-icon.png') }}" alt=""/>
                            <a href="javascript:void(0);">{{ $data->agent->phone_number ?? 'None' }}</a>
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/location.png') }}" alt=""/> <a
                                href="#">{{ $data->agent->address ?? 'None' }}</a>
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
                @if(sizeof($data->reviews) > 0)
                <div class="owl-slider">
                    <div id="ClientCarousel" class="owl-carousel">
                        @foreach($data->reviews as $key => $review)
                        <div class="item">
                            <!-- <img src="/assest/images/check.png" alt="item-img"> -->
                            <div class="item-first-img">
                                <img src="{{asset('assets/images/check.png')}}"/>
                            </div>
                            <p>{{$review->review_message}}</p>
                            <div class="item-profile-img">
                                <img src="{{asset($review->from->profile_image)}}"/>
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
