@extends('secured-layouts.app')
@section('title', 'Reviews')
@section('content')
    <div class="wrapper profile-contact-section">
        <div class="heading-wrapper">
            <h1>Listings</h1>
            <a href="http://localhost:8000/agent/add-listing" class="btn-default" data-toggle="modal"
               data-target="#request-review">Request a Review</a>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">
                            Reviews
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">
                            Team Review
                        </a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">

                    <div class="tab-pane active" id="tab-1">
                        <div class="profile-contact-section profile-section-padding">
                            <div class="container-lg">
                                <div class="your-reviews-section">
                                    <h3>Your Reviews</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="review-box-wrapper">
                                                <div class="review-inner-box-content">
                                                    <div class="agent-name">
                                                        <img src="/assets/images/default-image.jpeg" alt="user-icon">
                                                        <h4> I like that its a beautiful location </h4>
                                                    </div>
                                                    <div class="stars-icons">
                                                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                            class="fas fa-star"> </i> <i class="fas fa-star"> </i> <i
                                                            class="fas fa-star"> </i>
                                                    </div>
                                                </div>
                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                    veniam, quis nostrud
                                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute
                                                    irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                    Excepteur sint occaecat cupidatat non proident.</p>
                                                <span> By Ubaid 1 Hour ago</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mrg-top">
                                            <div class="review-box-wrapper">
                                                <div class="review-inner-box-content">
                                                    <div class="agent-name">
                                                        <img src="/assets/images/default-image.jpeg" alt="user-icon">
                                                        <h4> I like that its a beautiful location </h4>
                                                    </div>
                                                    <div class="stars-icons">
                                                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                            class="fas fa-star"> </i> <i class="fas fa-star"> </i> <i
                                                            class="fas fa-star"> </i>
                                                    </div>
                                                </div>
                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                    veniam, quis nostrud
                                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute
                                                    irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                    Excepteur sint occaecat cupidatat non proident.</p>
                                                <span> By Ubaid 1 Hour ago</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mrg-top">
                                            <div class="review-box-wrapper">
                                                <div class="review-inner-box-content">
                                                    <div class="agent-name">
                                                        <img src="/assets/images/default-image.jpeg" alt="user-icon">
                                                        <h4> I like that its a beautiful location </h4>
                                                    </div>
                                                    <div class="stars-icons">
                                                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                            class="fas fa-star"> </i> <i class="fas fa-star"> </i> <i
                                                            class="fas fa-star"> </i>
                                                    </div>
                                                </div>
                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                    veniam, quis nostrud
                                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute
                                                    irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                    Excepteur sint occaecat cupidatat non proident.</p>
                                                <span> By Ubaid 1 Hour ago</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mrg-top">
                                            <div class="review-box-wrapper">
                                                <div class="review-inner-box-content">
                                                    <div class="agent-name">
                                                        <img src="/assets/images/default-image.jpeg" alt="user-icon">
                                                        <h4> I like that its a beautiful location </h4>
                                                    </div>
                                                    <div class="stars-icons">
                                                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                            class="fas fa-star"> </i> <i class="fas fa-star"> </i> <i
                                                            class="fas fa-star"> </i>
                                                    </div>
                                                </div>
                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                    veniam, quis nostrud
                                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute
                                                    irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                    Excepteur sint occaecat cupidatat non proident.</p>
                                                <span> By Ubaid 1 Hour ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-2">
                        No Record Found
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    modal--}}
    <!-- The Modal -->
    <div class="modal fade" id="request-review">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Request a Review</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="input-style" placeholder="Write Email">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="input-style" placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Send Mail</button>
                </div>
            </div>
        </div>
    </div>

@endsection
