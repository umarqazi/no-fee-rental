<div class="modal fade" id="request-review">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Request a Review</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        {!! Form::open(['url' => route('agent.requestReview'),'class' => 'ajax','reset' => 'true','id' => 'review-request']) !!}
        <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            {!! Form::select('review_from', renters(), null, ['class' => 'input-style','id' => 'renter_email']) !!}
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            {!! Form::textarea('message', null, ['class' => 'input-style', 'placeholder' => 'Message']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::submit('Send Request', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>