@extends('secured-layouts.app')
@section('title', currentPlan($currentPlan->plan))
@section('content')
    <link rel="stylesheet" type="text/css" href="http://no-fee-rental.teamtechverx.com/assets/css/datepicker.min.css">
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.min.js"></script>
    <script src="http://no-fee-rental.teamtechverx.com/assets/js/datepicker.en.js"></script>
    {{--basic plan page--}}
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Credits Plan</h1>
            <a href="{{ url()->previous() }}" class="btn-default">Back</a>
        </div>
        <div class="credit-plans basic-plan-wrapper">
            <h3>Current Plan - {{ currentPlan($currentPlan->plan) }}</h3>
            <div class="pg-header">
                <p>  Your billing cycle ends on <b>{{ billingCycle($currentPlan) }}</b>, and is currently set to renew.</p>
                <a href="javascript:void(0)" class="change-card"> Change Card </a>
            </div>
            <div class="switching-plans">
                <h3>Switching Plans</h3>
                <p> <b> Upgrades </b> take place immediately. You will be charged the difference between the two plans. The additional Pro Credits will be added to your account. Your billing cycle will remain the same.</p>
                <p> <b> Downgrades </b> don't take effect until the end of your billing cycle, at which point you will be downgraded to your new plan.
                    <br> You are currently subscribed to the <b> {{ currentPlan($currentPlan->plan) }}</b> </p>
            </div>
            <div class="switch-buttons">
                <div class="switch-gold {{ $currentPlan->plan == BASICPLAN ? 'hidden' : '' }}">
                    <a href="javascript:void(0)" class="btn btn-default switch-plan gold-btn-bg">Basic - $40 / month</a>
                    <p class="desc-gold"> Switch to Basic</p>
                </div>
                <div class="switch-gold {{ $currentPlan->plan == GOLDPLAN ? 'hidden' : '' }}">
                    <a href="javascript:void(0)" class="btn btn-default switch-plan gold-btn-bg">Gold - $70 / month</a>
                    <p class="desc-gold"> Switch to Gold</p>
                </div>
                <div class="switch-gold {{ $currentPlan->plan == PLATINUMPLAN ? 'hidden' : '' }}">
                    <a href="javascript:void(0)" class="btn btn-default switch-plan platinum-btn-bg">Platinum - $100 / month</a>
                    <p class="desc-platinum"> Switch to Platinum</p>
                </div>
            </div>
            <div class="switch-buttons">
                <h3> Cancellation</h3>
                <p> You can <a href="{{ route('agent.cancelPlan') }}" class="cancel-plan"> cancel your plan here. </a> <br />
                    You’ll be able to use your Pro Credits until the end of your billing cycle.
                </p>
            </div>
            <div class="switch-buttons">
                <h3>Subscription History </h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="plans-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amt Paid</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($currentPlan->transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                            <td>${{ $transaction->amt_paid }}</td>
                                            <td>{{ $transaction->txn_status }}</td>
                                            <td>
                                                <a href="{{ $transaction->receipt_url }}" class="desktop-table-td"> View Receipt </a>
                                                <a href="{{ $transaction->receipt_url }}" class="mobile-table-td"> <i class="far fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($currentPlan->transactions->count() < 1)
                                        <tr>
                                            <td class="text-center" colspan="4">No Transactions Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.payment_checkout')
    {!! HTML::script('assets/js/credit_plan.js') !!}
@endsection
