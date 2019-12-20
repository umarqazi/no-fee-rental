@extends('layouts.app')
@section('title', 'No Fee Rental | Home')
@section('content')
<header>
    {{--Normal Search--}}
    @include('sections.search')
</header>
<style>
    .header-wrapper{
        background-color: rgba(31, 46, 81, 0.14);
    }
</style>
<section class="need-help-container wow fadeIn " data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="wrapper">
            <h2>nEED hELP?</h2>
            <p>It’s easy: Just tell us what you’re looking for and we’ll do the rest. <br> How? We’ll put you in touch with one of our neighborhood experts based on your needs.</p>
            <button type="button" class="btn-default" data-toggle="modal" data-target="#need-help-step1">Get started</button>
        </div>
    </div>
</section>
<section class="about-us-container about-us-large-img">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-7 p-0">
                <img src="{{asset('assets/images/about-bg-small.jpg')}}" alt="" class="about-mb-img" />
            </div>
            <div class="col-lg-5 wow fadeInRight " data-wow-delay="0.2s">
                <h3>The NO-FEE Rentals NYC Philosophy</h3>
                <p>Driven by the belief that New Yorkers deserve better apartments, better tools, and that they shouldn’t have to pay more for it. <br><br> We’re here to make the entire apartment-hunting process easier and help navigate the challenges of creating a happy home in the big city with budget-friendly curated listings, tools, and expert guidance every step of the way.</p>
                <div class="text-center">
                    <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66" class="btn-default mt-5">Our Story</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{--Get Started--}}
@include('modals.get_started')

{{--Let us Help Modal--}}
@include('modals.let_us_help')

{{--Featured Listing--}}
@include('sections.feature_listing')

{{--Life Container--}}
@include('sections.life-container')

{{--Neighborhoods--}}
@include('sections.neighborhood')
@endsection





