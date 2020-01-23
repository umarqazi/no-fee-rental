@extends('secured-layouts.app')
@section('title', 'Credit Plan')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Credits Plan</h1>
        </div>
        <div class="credit-plans">
            <h3>NOFEE Rental Plans</h3>
            <p>We stand behind our name in giving our advertises quality leads without watering down our product & service you confidence!
                Our goal is to provide top-quality leads at a fraction of a cost to the agent.</p><br>
            <p>For a limited time we are offering the 1st month of advertising at no cost. In addition once your on our plan if
                for any reason you are not completely satisfied we will refund your monthly subscription with no question asked.</p><br>
            <p>Welcome to the nofeerentalsnyc.com family!!</p>
            <div class="plans-wrapper">
                <div class="inner-plans-wrapper">
                    <div class="current-plans {{ isset($currentPlan) && $currentPlan->plan == BASICPLAN ? '' : 'platinum-plan' }}">
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
                        @if(isset($currentPlan) && $currentPlan->plan == BASICPLAN)
                            <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                Current Plan
                            </a>
                        @else
                            <a href="javascript:void(0);" class="btn btn-default credit-plan">
                                Get Started
                            </a>
                        @endif
                    </div>
                    <div class="current-plans {{ isset($currentPlan) && $currentPlan->plan == GOLDPLAN ? '' : 'platinum-plan' }}">
                        <h3> Gold Plan</h3>
                        <h2>$70</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <p style="text-align: center">Get ahead with more client views.</p>
                                <li>40 listing slots</li>
                                <li>10 featured listings</li>
                                <li>60 Reposts</li>
                                <li>Premier reach to more potential clients.</li>
                                <li>Featured listing in our weekly news letter</li>
                            </ul>
                        </div>
                        @if(isset($currentPlan) && $currentPlan->plan == GOLDPLAN)
                            <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                Current Plan
                            </a>
                        @else
                            <a href="javascript:void(0);" class="btn btn-default credit-plan">
                                Get Started
                            </a>
                        @endif
                    </div>
                    <div class="current-plans {{ isset($currentPlan) && $currentPlan->plan == PLATINUMPLAN ? '' : 'platinum-plan' }}">
                        <h3> Platinum Plan</h3>
                        <h2>$100</h2> <small>/Month</small>
                        <div class="text-with-tick-image">
                            <ul>
                                <p style="text-align: center">Ultimate Visibility</p>
                                <li>70 listings slots</li>
                                <li>25 featured listings</li>
                                <li>100 Reposts</li>
                                <li>Close more deals than ever before.</li>
                                <li>Varified client leads based on your expertise</li>
                                <li>Direct leads from our client questioner form</li>
                                <li>Featured listing in our weekly news letter</li>
                            </ul>
                        </div>
                        @if(isset($currentPlan) && $currentPlan->plan == PLATINUMPLAN)
                            <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                Current Plan
                            </a>
                        @else
                            <a href="javascript:void(0);" class="btn btn-default credit-plan">
                                Get Started
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Checkout Modal--}}
    @include('modals.payment_checkout')
    {!! HTML::script('assets/js/credit_plan.js') !!}
@endsection
