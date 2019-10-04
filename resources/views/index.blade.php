@extends('layouts.app')
@section('title', 'No Fee Rental | Dashboard')
@section('content')
<header>
    {{--Normal Search--}}
    @include('sections.search')
</header>
<section class="need-help-container wow fadeIn " data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="wrapper">
            <h2>nEED hELP?</h2>
            <p>It’s easy: Just tell us what you’re looking for and we’ll do the rest. <br> How? We’ll put you in touch with one of our neighborhood experts based on your needs.</p>
            <button type="button" class="btn-default" data-toggle="modal" data-target="#need-help-step1">Get started</button>
        </div>
    </div>
</section>
<section class="about-us-container">
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

  <!--Need help modal-->
    <div class="modal fade need-help-modal" id="need-help-step1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Neighborhood</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="text-center mb-0">Where would you love to live?</h4>
                    <div class="pt-4">
                        <input type="text" class="input-style" />
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step2" id="need-help-btn2">Next</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade need-help-modal" id="need-help-step2">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Bedrooms</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="text-center mb-0">How many bedrooms?</h4>
                    <div class="py-4">
                        <ul class="select-bed-options">
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-1" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-1">Any</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-2" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-2">Studio</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-3" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-3">1</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-4" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-4">2</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-5" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-5">3</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="beds-6" name="select-bedromms">
                                    <label class="custom-control-label" for="beds-6">4+</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step1">Previous</button>
                    <button type="button" class="btn-default" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step3" id="need-help-step-3">Next</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade need-help-modal" id="need-help-step3">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Budget</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="text-center mb-0">What is your Budget?</h4>
                    <div class="pt-4">
                        <input type="text" class="input-style" />
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step2">Previous</button>
                    <button type="button" class="btn-default" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step4">Next</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade need-help-modal" id="need-help-step4">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Timeline</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="text-center mb-0">When would you like move in?</h4>
                    <div class="pt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="custom-select-list">
                                    <option>DD</option>
                                    <option>DD</option>
                                    <option>DD</option>
                                    <option>DD</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="custom-select-list">
                                    <option>MM</option>
                                    <option>MM</option>
                                    <option>MM</option>
                                    <option>MM</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="custom-select-list">
                                    <option>YY</option>
                                    <option>YY</option>
                                    <option>YY</option>
                                    <option>YY</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step3">Previous</button>
                    <button type="button" class="btn-default" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step5" id="need-help-step-5">Next</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade need-help-modal" id="need-help-step5">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Timeline</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="text-center mb-0">When would you like move in?</h4>
                    <div class="pt-4 row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="input-style" type="text" placeholder="First Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="input-style" type="text" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="input-style" type="tel" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="input-style" type="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea placeholder="Comments" rows="5" class="input-style text-area"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step4">Previous</button>
                    <button type="button" class="btn-default">Next</button>
                </div>
            </div>

        </div>
    </div>

    <!--Your life pop up-->
    <div class="modal fade need-help-modal let-us-help-modal" id="let-us-help">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">

            <div class="modal-content">

                <form class="let-us-hlep-form" id="let-us-step1">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">What is your ideal move in date?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4">
                            <div id="multiple" class="article">
                                <div class="multi-select-calendar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn-default" data-target="let-us-step2">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step2">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">I can spend over____on rent every month</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <input type="text" class="input-style rent-input-icon" />
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-target="let-us-step1">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step3">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step3">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">How many bedrooms?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bedrooms-1" name="bedrooms">
                                        <label class="custom-control-label" for="bedrooms-1">Studio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bedrooms-2" name="bedrooms">
                                        <label class="custom-control-label" for="bedrooms-2">1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bedrooms-3" name="bedrooms">
                                        <label class="custom-control-label" for="bedrooms-3">2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bedrooms-4" name="bedrooms">
                                        <label class="custom-control-label" for="bedrooms-4">3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bedrooms-5" name="bedrooms">
                                        <label class="custom-control-label" for="bedrooms-5">4</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-target="let-us-step2">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step4">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step4">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">Whats your full name?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <input type="text" class="input-style" placeholder="Full name *" />
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-target="let-us-step3">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step5">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step5">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">How can we get in touch?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <input type="email" class="input-style" placeholder="Email *" />
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-target="let-us-step4">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step6">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step6">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                        </ul>
                        <h3 class="modal-title">For the fastest response, whats your phone number?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <input type="email" class="input-style" placeholder="Phone *" />
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-target="let-us-step5">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step7">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step7">

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <img src="assets/images/popcorn-icon.jpg" alt="" class="popcorn-icon" />
                            <h3 class="mb-2 text-center">Thanks Danielle!</h3>
                            <p class="text-center">We can help you even faster if you answer a few question about your search.</p>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default" type="button" data-dismiss="modal" data-target="">Maybe later</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step8">Okay, let’s do this</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step8">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">Do you have any location preferences?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="location-1" name="location">
                                        <label class="custom-control-label" for="location-1">Finding a Home ( Client )</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="location-2" name="location">
                                        <label class="custom-control-label" for="location-2">I have something very specific i’m looking for...</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="location-3" name="location">
                                        <label class="custom-control-label" for="location-3">No, I’m open to anything</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step9">Skip</button></div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step9">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step9">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">Search for neighborhood</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <input type="text" class="input-style" placeholder="+ Search for neighborhood" />

                            <!-- Nav pills -->
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#tab-1">All <span>308</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab-2">Selected <span>4</span></a>
                                </li>
                                <span class="deselect">Deselect All</span>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <ul class="cities-list">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-1" name="cities">
                                                <label class="custom-control-label" for="cities-1">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-2" name="cities">
                                                <label class="custom-control-label" for="cities-2">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-3" name="cities">
                                                <label class="custom-control-label" for="cities-3">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-4" name="cities">
                                                <label class="custom-control-label" for="cities-4">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-5" name="cities">
                                                <label class="custom-control-label" for="cities-5">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-6" name="cities">
                                                <label class="custom-control-label" for="cities-6">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-7" name="cities">
                                                <label class="custom-control-label" for="cities-7">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-9" name="cities">
                                                <label class="custom-control-label" for="cities-9">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-10" name="cities">
                                                <label class="custom-control-label" for="cities-10">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-11" name="cities">
                                                <label class="custom-control-label" for="cities-11">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-12" name="cities">
                                                <label class="custom-control-label" for="cities-12">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-13" name="cities">
                                                <label class="custom-control-label" for="cities-13">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-14" name="cities">
                                                <label class="custom-control-label" for="cities-14">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-15" name="cities">
                                                <label class="custom-control-label" for="cities-15">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-16" name="cities">
                                                <label class="custom-control-label" for="cities-16">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-17" name="cities">
                                                <label class="custom-control-label" for="cities-17">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-18" name="cities">
                                                <label class="custom-control-label" for="cities-18">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-19" name="cities">
                                                <label class="custom-control-label" for="cities-19">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-20" name="cities">
                                                <label class="custom-control-label" for="cities-20">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-21" name="cities">
                                                <label class="custom-control-label" for="cities-21">2</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cities-22" name="cities">
                                                <label class="custom-control-label" for="cities-22">2</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="tab-2">...</div>
                            </div>

                        </div>
                        <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step10">Skip</button></div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step8">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step10">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step10">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">Why are you moving?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="moving-1" name="moving">
                                        <label class="custom-control-label" for="moving-1">Lease is up</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="moving-2" name="moving">
                                        <label class="custom-control-label" for="moving-2">Moving from out of town</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="moving-3" name="moving">
                                        <label class="custom-control-label" for="moving-3">Moving from out of state</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="moving-4" name="moving">
                                        <label class="custom-control-label" for="moving-4">need more space</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="moving-5" name="moving">
                                        <label class="custom-control-label" for="moving-5">Other...</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step11">Skip</button></div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step9">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step11">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step11">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">Do you have any pets?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="catss-1" name="pets">
                                        <label class="custom-control-label" for="catss-1">Cats</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="dogs-01" name="pets">
                                        <label class="custom-control-label" for="dogs-01">Dogs</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pets-3" name="pets">
                                        <label class="custom-control-label" for="pets-3">Other</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pets-4" name="pets">
                                        <label class="custom-control-label" for="pets-4">No</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step12">Skip</button></div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step10">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step12">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step12">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                        </ul>
                        <h3 class="modal-title">When does your lease end?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-1" name="lease">
                                        <label class="custom-control-label" for="lease-1">End of the month</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-2" name="lease">
                                        <label class="custom-control-label" for="lease-2">I’m month to month</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-3" name="lease">
                                        <label class="custom-control-label" for="lease-3">Choose a specific date...</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step13">Skip</button></div>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step11">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="let-us-step13">Next</button>
                    </div>

                </form>

                <form class="let-us-hlep-form" id="let-us-step13">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <ul class="steps-progress">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                        </ul>
                        <h3 class="modal-title">When does your lease end?</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="pt-4 -b-4">
                            <ul class="bedroom-listing">
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-1" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-1">700+</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-2" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-2">650 - 700</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-3" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-3">600 - 650</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-4" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-4">550 - 600</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-5" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-5">500 - 550</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-6" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-6">below 500</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="lease-price-7" name="lease-price">
                                        <label class="custom-control-label" for="lease-price-7">No credit score</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn-default ml-3" type="button" data-target="let-us-step12">Previous</button>
                        <button class="btn-default ml-3" type="button" data-target="">Next</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
{{--Featured Listing--}}
@include('sections.feature_listing')
{{--Life Container--}}
@include('sections.life-container')
{{--Neighborhoods--}}
@include('sections.neighborhood')
@endsection





