<div class="modal fade message-modal-wrapper" id="message-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title request-type"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p class="mb-3">Renter choose to anonymize their contact info:</p>
                {!! Form::open(['id' => 'reply-back', 'class' => 'ajax', 'reset' => 'true']) !!}
                {!! Form::textarea('message', null, ['class' => 'text-area', 'placeholder' => 'Reply here...']) !!}
                {!! Form::hidden('to', '', ['id' => 'chat-room']) !!}
                <div class="actions-btns">
                    {!! Form::submit('Reply', ['class' => 'btn-default']) !!}
                    {{--<button type="submit" id="send-message" class="btn-default">Reply</button>--}}
                    <button class="archive">Archive Conversation</button>
                </div>
                {!! Form::close() !!}
                <div class="message-list">
                    <h3 id="user_name">{{ sprintf('%s %s', mySelf()->first_name, mySelf()->last_name) }}</h3>
                    <p></p>
                    <p class="date"></p>
                </div>
                <div class="user-info">
                    <p>Name: <strong></strong></p>
                    <p>E-mail: <strong><a href="#"></a></strong></p>
                    <p>Phone: <strong> </strong></p>
                    <p>Question/Comments: <strong></strong></p>
                    <div class="property-info">
                        <img src="" alt="" />
                        <div class="info">
                            <div class="title">
                                <p><i class="fa fa-tag"></i></p>
                                <div class="appointment"></div>
                            </div>
                            <ul>
                                <li></li>
                                <li></li>
                            </ul>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
