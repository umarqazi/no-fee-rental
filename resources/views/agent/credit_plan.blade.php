@extends('secured-layouts.app')
@section('title', 'Credit Plan')
@section('content')
    {!! HTML::style('assets/css/credit.css') !!}
    <link rel="stylesheet" type="text/css" href="http://no-fee-rental.teamtechverx.com/assets/css/datepicker.min.css">
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.min.js"></script>
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.en.js"></script>
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Credits Plan</h1>
        </div>
        <div class="credit-plans">
            <h3>NOFE Rental Plans</h3>
            <p>We stand behind our name in giving our advertises quality leads without watering down our product & service you confidence!
                Our goal is to provide top-quality leads at a fraction of a cost to the agent.</p><br>
            <p>For a limited time we are offering the 1st month of advertising at no cost. In addition once your on our plan if for any reason you are not
                completely satisfied we will refund your monthly subscription with no question asked.</p><br>
            <p>Welcome to the nofeerentalsnyc.com family!!</p>
            <div class="plans-wrapper">
                <div class="inner-plans-wrapper">
                    <div class="current-plans">
                        <h3> Basic Plan</h3>
                        <h2>$40</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <p style="text-align: center">Perfect for first-time listers.</p>
                                <li>20 listing slots</li>
                                <li>5 featured listing</li>
                                <li>30 Reposts</li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-default credit-plan" data-toggle="modal" data-target="#myModal-currentPlan" id="30"> Current plan </a>
                    </div>
                    <div class="current-plans gold-plan">
                        <h3> Gold Plan</h3>
                        <h2>$70</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <p style="text-align: center">Get ahead with more client views.</p>
                                <li>40 listing slots</li>
                                <li>10 featured listings</li>
                                <li>Premier reach to more potential clients.</li>
                                <li>60 Reposts</li>
                                <li>Featured listing in our weekly news letter</li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-default credit-plan" data-toggle="modal" data-target="#myModal-currentPlan" id="60"> Get Started </a>
{{--                        <a href="#" class="btn btn-default"> Get started </a>--}}
                    </div>
                    <div class="current-plans platinum-plan">
                        <h3> Platinum Plan</h3>
                        <h2>$100</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <p style="text-align: center">Ultimate Visibility</p>
                                <li>25 featured listings</li>
                                <li>100 Reposts</li>
                                <li>70 listings slots</li>
                                <li>Close more deals than ever before.</li>
                                <li>Varified client leads based on your expertise</li>
                                <li>Direct leads from our client questioner form</li>
                                <li>Featured listing in our weekly news letter</li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-default credit-plan" data-toggle="modal" data-target="#myModal-currentPlan" id="100"> Get Started </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Checkout Modal--}}
    @include('agent.modals.payment_checkout')

    <script>
        enableDatePicker('#exp_year', false);
        enableDatePicker('#exp_month', false);
        let plan;
        let creditPlan;
        $('.credit-plan').on('click', function() {
            plan = $(this).attr('id');

            if(plan === '30') {
                creditPlan = 1;
            } else if (plan === '60') {
                creditPlan = 2;
            } else {
                creditPlan = 3;
            }

            let plan_name = $(this).closest('.current-plans').find('h3').text();
            $('.modal-header > h4').text(`Purchase ${plan_name}`);
            $('.modal-footer > input').attr('value', `Checkout ($${plan})`);
        });

        $('form').on('submit', function() {
            $('.amount').attr('value', plan);
            $('.credit_plan').attr('value', creditPlan);
        });
    </script>
@endsection
