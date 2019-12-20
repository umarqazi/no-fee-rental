
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
                    <h3>User</h3>
                    {!! Form::open(['url' => route('user.reportListing'), 'reset' => 'true' , 'method' => 'get',]) !!}
                    {!! Form::text('username', mySelf()->first_name.' '.mySelf()->last_name ?? null, ['class' => 'form-control', 'placeholder' => 'User Name']) !!}
                    <br>
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com']) !!}
                    <br>
                    {!! Form::text('phone_number', mySelf()->phone_number, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
                    <br>
                    <h3> Report reason</h3>

                    <div class="form-group">
                        {!! Form::select('listing_report_reason', config('formfields.listing.listing_report_reasons'), null, ['class' => 'form-control','id'=>'sel1']) !!}
                    </div>
                    <div class="form-group text-message">
                        {!! Form::textarea('message', null, ['class' => 'form-control', 'style' => 'resize:none;', 'placeholder' => 'Write Your Message']) !!}
                    </div>

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                {{--<button type="submit" class="btn btn-danger" data-dismiss="modal">Send</button>--}}
                {!! Form::button('Send', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                {!! Form::close() !!}
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
