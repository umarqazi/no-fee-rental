<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="modal fade need-help-modal check-availability-modal" id="check-availability">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Check Availability</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            {!! Form::model((!authenticated()) ?:mySelf(),['url' => route('send.message'), 'method' => 'post']) !!}
            <div class="modal-body">
                <div class="pt-4">
                    <div class="small-view">
                        <div>
                            <img
                                src = "{{ (!empty($listing->thumbnail))
                                        ? asset('storage/'.$listing->thumbnail)
                                        : asset('storage/uploads/listing/thumbnails/default.jpg') }}"
                                class="main-img" />
                        </div>
                        <div class="info">
                            <div class="title">
                                <p>{{$listing->street_address ?? null}}</p>
                                <p><span class="price">${{$listing->rent}}</span> For Rental</p>
                            </div>
                            <div class="additional-info">
                                <p><i class="fa fa-building"></i> {{$listing->baths}} bathroom</p>
                                <p><i class="fa fa-map-marker-alt"></i> Apartment in {{$listing->neighborhood}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::text('first_name', null, ['class' => 'input-style', 'placeholder' => 'User Name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone Number']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('appointment_at', null, [ 'autocomplete' =>'off', 'class' => 'input-style', 'id' => 'schedule']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('message', null, ['rows' => 5, 'class' => 'input-style text-area', 'placeholder' => 'Message']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                {!! Form::hidden('listing_id', $listing->id) !!}
                {!! Form::hidden('to', $listing->agent->id) !!}
                {!! Form::submit('Send Request', ['class' => 'btn-default']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{!! HTML::script('assets/js/message.js') !!}
