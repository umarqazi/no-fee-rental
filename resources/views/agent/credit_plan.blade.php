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
                        <a href="javascript:void(0);" class="btn btn-default credit-plan" data-toggle="modal" data-target="#myModal-currentPlan" id="30"> Current plan </a>
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
                        <a href="javascript:void(0);" class="btn btn-default credit-plan" data-toggle="modal" data-target="#myModal-currentPlan" id="60"> Get Started </a>
{{--                        <a href="#" class="btn btn-default"> Get started </a>--}}
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
