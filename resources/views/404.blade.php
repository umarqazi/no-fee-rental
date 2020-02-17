@extends('layouts.app')
@section('title', '404')
@section('content')
    <style>
        #advance-search {
            z-index: 100 !important;
        }
    </style>
    <section class="neighborhood-search neighbourhood-pd wow fadeIn neighborhood-banner-page" data-wow-delay="0.2s">
        <div class="four-o-four-wrapper">
            <h4>Page Not found</h4>
        </div>
        <div class="four-o-four-inner-content">
            <img src="{{ Storage::url('assets/images/404.png') }}" alt="404" />
            <p>We can't find the page you're looking for.</p>
            <div class="go-to-home"><a href="{{ route('web.index') }}" class="btn btn-default"> Go to Home Page</a></div>
        </div>
        <div class="container-lg">
        </div>
    </section>
@endsection
