@extends('secured-layouts.app')
@section('title', 'Credit Plan')
@section('content')
    <link rel="stylesheet" type="text/css" href="http://no-fee-rental.teamtechverx.com/assets/css/datepicker.min.css">
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.min.js"></script>
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.en.js"></script>
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Credits Plan</h1>
            {{--            <a href="http://localhost:8000/agent/add-listing" class="btn-default" data-toggle="modal"--}}
            {{--               data-target="#request-review">Request a Review</a>--}}
        </div>
        <div class="credit-plans">
            <h3>NOFE Rental Plans</h3>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries.</p>
            <div class="plans-wrapper">
                <div class="inner-plans-wrapper">
                    <div class="current-plans">
                        <h3> Basic Plan</h3>
                        <h2>$30</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <li>0  Featured Listings </li>
                                <li>20 reposts monthly</li>
                            </ul>
                        </div>
                        <a href="{{route('agent.basicPlan')  }}" class="btn btn-default" data-toggle="modal" data-target="#myModal-currentPlan"> Current plan </a>
                    </div>
                    <div class="current-plans gold-plan">
                        <h3> Gold Plan</h3>
                        <h2>$60</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <li>0  Featured Listings </li>
                                <li>100 reposts monthly</li>
                            </ul>
                        </div>
                        <a href="#" class="btn btn-default"> Get started </a>
                    </div>
                    <div class="current-plans platinum-plan">
                        <h3> Platinum Plan</h3>
                        <h2>$100</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <li>50  Featured Listings </li>
                                <li>500 reposts monthly</li>
                            </ul>
                        </div>
                        <a href="#" class="btn btn-default"> Get started </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    checkout Modal--}}
    <!-- The Modal -->
    <div class="modal fade" id="myModal-currentPlan">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Purchase Basic Plan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cardholder Name</label>
                        <input type="text" class="input-style" />
                    </div>
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" class="input-style" />
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expiration date</label>
                                <input autocomplete="off" id="open_checkout-calendar" class="input-style" name="opencheckout" type="text">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cw</label>
                                <input type="text" class="input-style" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default checkout-popup-btn" data-dismiss="modal">Checkout</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        enableDatePicker('#open_checkout-calendar', false);
    </script>
@endsection
