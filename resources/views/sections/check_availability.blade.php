@if(!isAdmin() && !isAgent() && !isOwner())
    <div class="form-group">
        {!! Form::model(mySelf() ?? null, ['url' => route('web.listConversation'),'id'=> 'check-availability']) !!}
        {!! Form::hidden('listing_id', $listing->id) !!}
        {!! Form::hidden('to', $listing->agent->id) !!}
        {!! Form::hidden('type', AVAILABILITY) !!}
        {!! Form::text('username', mySelf()->first_name ?? null, ['class' => 'form-control', 'placeholder' => 'User Name']) !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com']) !!}
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
        {!! Form::textarea('message', null, ['class' => 'form-control', 'style' => 'resize:none;', 'placeholder' => 'Message']) !!}
        {!! Form::button('send', ['class' => 'btn btn-default text-center', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
@else
    <div class="not-allowed-appointment"> You are not allowed to sent availability request</div>
@endif
