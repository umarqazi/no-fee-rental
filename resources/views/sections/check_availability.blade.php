
<div class="form-group">
    {!! Form::model(mySelf() ?? null, ['url' => route('web.checkAvailability')]) !!}
    {!! Form::hidden('listing_id', $listing->id) !!}
    {!! Form::hidden('to', $listing->agent->id) !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'User Name']) !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com']) !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
    {!! Form::textarea('message', null, ['class' => 'form-control', 'style' => 'resize:none;', 'placeholder' => 'Message']) !!}
    {!! Form::button('send', ['class' => 'btn btn-default text-center', 'type' => 'submit']) !!}
    {!! Form::close() !!}
</div>
