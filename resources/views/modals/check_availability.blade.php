<div class="modal fade" id="check-availability">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <img src="{{ Storage::url('assets/images/modal-close-icon.png') }}" alt="" class="close-modal close-signup-modal closemodal-check-availablility" data-dismiss="modal">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4" id="listing-image">
                        <img src="{{ Storage::url('assets/images/modal-logo.png') }}" alt="" class="logo" />
                    </div>
                    <div class="col-lg-8 padding-leftt-0">
                        <h3 id="address"></h3>
                        <strong id="availability-rent"></strong> <small>For Rental</small>
                        <div class="after-border"></div>
                        <div class="bedroms-baths-text">
                            <i class="fas fa-home"></i> <span id="availability-beds"></span>, <span id="availability-baths"></span>
                        </div>
                    </div>
                </div>
                @if(isRenter())
                <div  class="form-group">
                    {!! Form::model(mySelf() ?? null, ['url' => route('web.listConversation'), 'class' => 'ajax', 'reset' => 'true']) !!}
                    {!! Form::hidden('listing_id','' , ['id' => 'listing_id']) !!}
                    {!! Form::hidden('to', '',['id' => 'agent_id']) !!}
                    {!! Form::hidden('type', AVAILABILITY) !!}
                <div class="form-group">
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'User Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'style' => 'resize:none;', 'placeholder' => 'Message']) !!}
                </div>
                    <div class="row">
                <div class="form-group col-lg-6">
                    {!! Form::button('send', ['class' => 'btn send-availablity-btn', 'type' => 'submit']) !!}
                </div>
                     <div class="col-lg-6">
                          <a href="#" class="btn " data-dismiss='modal'> Cancel</a>
                     </div>
                    </div>
                {!! Form::close() !!}
                </div>
                @else
                    {{ ucfirst(whoAmI()) }}'s are not allowed to send request.
                @endif
            </div>
        </div>
    </div>
</div>
