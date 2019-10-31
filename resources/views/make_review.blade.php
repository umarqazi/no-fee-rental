@extends('layouts.app')
@section('title', 'No Fee Rental | Profile')
@section('content')
    <section class=" press-section wow fadeIn featured-properties neighborhood-search agent-listing-profile"
             data-wow-delay="0.2s">
                <div class="profile-contact-section profile-section-padding">
                    <div class="container-lg">
                        <h3>Leave a review </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name">Your Name</label>
                                    <input type="text" name="firstName" class="form-control" placeholder="Write your name">
                                </div>

                                <div class="form-group">
                                    <label for="first-name">Your Email</label>
                                    <input type="email" name="firstName" class="form-control" placeholder="Write your email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Write a review </label>
                                    <textarea class="form-control" placeholder="Write your review here"></textarea>

                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="btn-default"> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

    </section>




@endsection
