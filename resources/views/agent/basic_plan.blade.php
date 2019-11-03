@extends('secured-layouts.app')
@section('title', 'Basic Plan')
@section('content')
    {{--basic plan page--}}
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Credits Plan</h1>
            <a href="http://localhost:8000/agent/add-listing" class="btn-default" data-toggle="modal"
               data-target="#request-review">Back</a>
        </div>
        <div class="credit-plans basic-plan-wrapper">
            <h3>Current Plan - Pro/Silver</h3>
            <div class="pg-header">
                <p>  Your billing cycle ends on Jun 5, 2019 1:06 am, and is currently set to renew.The current payment method is: American Express ending with 8000
                </p>
                <a href="javascript:void(0)" class="change-card"> Change Card </a>

            </div>
            <div class="switching-plans">
                <h3>Switching Plans</h3>
                <p> <b> Upgrades </b> take place immediately. You will be charged the difference between the two plans. The additional Pro Credits will be added to your account. Your billing cycle will remain the same.</p>
                <p> <b> Downgrades </b> don't take effect until the end of your billing cycle, at which point you will be downgraded to your new plan.
                    <br> You are currently subscribed to the <b> Pro/Silver plan.</b> </p>
            </div>
            <div class="switch-buttons">
                <div class="switch-gold">
                    <a href="javascript:void(0)" class="btn btn-default gold-btn-bg">Gold - $60 / month</a>
                    <p class="desc-gold"> Switch to Gold</p>
                </div>
                <div class="switch-gold">
                    <a href="javascript:void(0)" class="btn btn-default platinum-btn-bg">Platinum - $100 / month</a>
                    <p class="desc-platinum"> Switch to Platinum</p>
                </div>
            </div>
            <div class="switch-buttons">
                <h3> Cancellation</h3>
                <p> You can <a href="javascript:void(0)" class="change-card"> cancel your plan here. </a> <br />
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
                                    <th>Amt Due</th>
                                    <th>Amt Paid</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2019-05-05 </td>
                                    <td>$69.00 </td>
                                    <td>$69.00 </td>
                                    <td>Paid  </td>
                                    <td><a href="javascript:void(0)" class="desktop-table-td"> View Receipt </a>
                                        <a href="javascript:void(0)" class="mobile-table-td"> <i class="far fa-eye"></i> </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>2019-05-05 </td>
                                    <td>$69.00 </td>
                                    <td>$69.00 </td>
                                    <td>Paid  </td>
                                    <td><a href="javascript:void(0)" class="desktop-table-td"> View Receipt </a>
                                        <a href="javascript:void(0)" class="mobile-table-td"> <i class="far fa-eye"></i> </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>2019-05-05 </td>
                                    <td>$69.00 </td>
                                    <td>$69.00 </td>
                                    <td>Paid  </td>
                                    <td><a href="javascript:void(0)" class="desktop-table-td"> View Receipt </a>
                                        <a href="javascript:void(0)" class="mobile-table-td"> <i class="far fa-eye"></i> </a>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
