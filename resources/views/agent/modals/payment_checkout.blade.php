<style>
    .error {
        color: red !important;
    }
</style>
<div class="modal fade" id="myModal-currentPlan">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Purchase Basic Plan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        {!! Form::open(['url' => route('agent.purchasePlan'), 'method' => 'post', 'class' => 'ajax', 'reset' => 'true', 'id' => 'stripe-checkout']) !!}
        {!! Form::hidden('amount', null, ['class' => 'amount']) !!}
        {!! Form::hidden('credit_plan', null, ['class' => 'credit_plan']) !!}
        <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Cardholder Name</label>
                    {!! Form::text('card_holder_name', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    {!! Form::text('card_number', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Expiration Month</label>
                            {!! Form::text('exp_month', null, ['class' => 'input-style', 'id' => 'exp_month', 'data-min-view' => "months",
   'data-view' => "months", 'data-date-format' => "mm", 'autocomplete' => 'off']) !!}
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Expiration Year</label>
                            {!! Form::text('exp_year', null, ['class' => 'input-style', 'data-min-view' => "years",
   'data-view' => "years", 'id' => 'exp_year', 'data-date-format' => "yyyy", 'autocomplete' => 'off']) !!}
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>CVC</label>
                            {!! Form::text('cvc', null, ['class' => 'input-style', 'maxlength' => '3', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::submit('Checkout', ['class' => 'btn btn-default checkout-popup-btn']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{!! HTML::script('assets/js/vendor/credit.js') !!}
<script type="text/javascript">
    $("input[name=card_number]").credit();
</script>
