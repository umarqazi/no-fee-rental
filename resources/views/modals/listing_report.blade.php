
<div class="modal fade" id="flag-icon">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Report this listing <br>
                    <p>{{ $listing->display_address.', '.$listing->neighborhood->name }}</p>
                </h4>
                <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->

            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="profilecard-detaill">
                    <h3>Report Reason</h3>
                    {!! Form::model(mySelf(), ['url' => route('user.reportListing'), 'reset' => 'true' , 'method' => 'get',]) !!}
                    <div class="form-group">
                        {!! Form::text('username', authenticated() ? (mySelf()->first_name.' '.mySelf()->last_name) : null, ['class' => 'input-style', 'placeholder' => 'User Name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'input-style', 'placeholder' => 'email@example.com']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone Number']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('report_reason', config('formfields.listing.listing_report_reasons'), null, ['class' => 'input-style','id'=>'sel1']) !!}
                    </div>
                    <div class="form-group text-message">
                        {!! Form::textarea('message', null, ['class' => 'input-style', 'style' => 'resize:none;', 'placeholder' => 'Write Your Message']) !!}
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::button('Send', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                {!! Form::close() !!}
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
