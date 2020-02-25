@extends('layouts.app')
@section('title', 'Advertise with us')
@section('content')
    <section class="advertise-banner">
        <h1>Advertise With us</h1>
    </section>
    <section class="advertise-intro">
        <div class="container">
            <ul class="bullet-list">
                <li>We stand behind our name in giving our advertises quality leads without watering down our product &amp;
                    service you confidence! Our goal is to provide top-quality leads at a fraction of a cost to the agent.</li>
                <li>For a limited time we are offering the 1st month of advertising at no cost. In addition once you are on our plan if for
                    any reason you are not completely satisfied we will refund your monthly subscription with no question asked.</li>
                <li class="li-last-child"><strong>Welcome to the nofeerentalsnyc.com family!!</strong></li>
            </ul>
        </div>
    </section>
    <section class="advertise-pg wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center mb-2">Features, Plan Pricing and Signup</h2>
            <p class="light-text text-center">Get started in under two minutes!</p>
            <div class="plan-listing justify-content-center h-100">
                <div class="clm basic-plan platinum-plan">
                    <div class="plan-header ">
                        <div class="title"><i class="fa fa-star"></i> BASIC <i class="fa fa-star"></i></div>
                        <p class="subtext">A great start!</p>
                    </div>
                    <div class="price-title">
                        $40/<span>Month</span>
                    </div>
                    <ul>
                        <p>Perfect for first-time listers.</p>
                        <li>20 listing slots  </li>
                        <li>5 featured listing </li>
                        <li>30 Reposts   </li>

                    </ul>
                    @if(!isMRGAgent())
                        <div class="text-center action-btn">
                            @if($currentPlan != null && $currentPlan->plan == BASICPLAN)
                                <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                    Current Plan
                                </a>
                            @elseif ($currentPlan != null)
                                <button type="button" class="btn-default switch-plan">Switch Plan</button>
                            @else
                                <button type="button" class="btn-default credit-plan">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="clm plus-plan platinum-plan">
                    <div class="plan-header ">
                        <div class="title"><i class="fa fa-star"></i> GOLD <i class="fa fa-star"></i></div>
                        <p class="subtext">Stand out from the crowd!</p>
                    </div>
                    <div class="price-title">
                        $70/<span>Month</span>
                    </div>
                    <ul>
                        <p>Get ahead with more client views </p>
                        <li>40 listing slots</li>
                        <li>10 featured listings</li>
                        <li>60 Reposts</li>
                        <li>Premier reach to more potential clients.  </li>
                        <li>Featured listing in our weekly news letter</li>

                    </ul>
                    @if(!isMRGAgent())
                        <div class="text-center action-btn">
                            @if($currentPlan != null && $currentPlan->plan == GOLDPLAN)
                                <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                    Current Plan
                                </a>
                            @elseif ($currentPlan != null)
                                <button type="button" class="btn-default switch-plan">Switch Plan</button>
                            @else
                                <button type="button" class="btn-default credit-plan">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="clm premium-plan platinum-plan">
                    <div class="plan-header ">
                        <div class="title"><i class="fa fa-star"></i> PREMIUM <i class="fa fa-star"></i></div>
                        <p class="subtext">Supercharge your business!</p>
                    </div>
                    <div class="price-title">
                        $100/<span>Month</span>
                    </div>
                    <ul>
                        <p> Ultimate Visibility</p>
                        <li>70 listings slots</li>
                        <li>25 featured listings</li>
                        <li>100 Reposts</li>
                        <li>Close more deals than ever before.</li>
                        <li>Verified client leads based on your expertise </li>
                        <li>Direct leads from our client questioner form</li>
                        <li>Featured listing in our weekly news letter</li>
                    </ul>
                    @if(!isMRGAgent())
                        <div class="text-center action-btn">
                            @if($currentPlan != null && $currentPlan->plan == PLATINUMPLAN)
                                <a href="{{ route('agent.plan') }}" class="btn btn-default">
                                    Current Plan
                                </a>
                            @elseif ($currentPlan != null)
                                <button type="button" class="btn-default switch-plan">Switch Plan</button>
                            @else
                                <button type="button" class="btn-default credit-plan">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('modals.payment_checkout')
    @if(!authenticated())
        <script>
            $('.credit-plan').on('click', function() {
                $('#signup').modal('show');
            });
        </script>
    @else
        {!! HTML::script('assets/js/credit_plan.js') !!}
    @endif
@endsection
