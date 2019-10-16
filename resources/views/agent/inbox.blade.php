@extends('secured-layouts.app')
@section('title', 'Messages')
@section('content')
    <div class="wrapper">
        <div class="user-info">
            <div>
                <h3 class="mb-2">{{ $collection->sender->first_name ?? $collection->username }}</h3>
                <p>E-mail: <strong>{{ $collection->sender->email ?? $collection->email }}</strong></p>
                <p>Phone: <strong>{{ $collection->sender->phone_number ?? $collection->phone_number }} </strong></p>
            </div>
            <div class="property-info">
                <img src="{{ asset($collection->listing->thumbnail ?? DLI ) }}" alt="">
                <div class="info">
                    <div class="title">
                        <p><i class="fa fa-tag"></i> ${{ $collection->listing->rent }}</p>
                    </div>
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ $collection->listing->bedrooms }} Bed</li>
                        <li><i class="fa fa-bath"></i> {{ $collection->listing->baths }} Bath</li>
                    </ul>
                    <p>{{ $collection->listing->street_address }}</p>
                </div>
            </div>
        </div>
        <div id="frame">
            <div class="content">
                <div class="messages">
                    <ul>
                        @foreach($collection->messages as $message)
                            @if($message->align === myId())
                                <li class="replies">
                                    <img style="width: 35px;height: 35px;" src="{{ asset(mySelf()->profile_image ?? DUI) }}" alt="" />
                                    <p>{{ $message->message }}</p>
                                </li>
                            @else
                                <li class="sent">
                                    <img  style="width: 35px;height: 35px;" src="{{ asset($collection->sender->profile_image ?? DUI) }}" alt="" />
                                    <p>{{ $message->message }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        {!! Form::open(['id' => 'send-message', 'loading' => 'false', 'url' => route('agent.sendMessage', $collection->id), 'class' => 'ajax', 'reset' => 'true']) !!}
                        {!! Form::text('message', null, ['placeholder' => 'Write your message...']) !!}
                        {!! Form::hidden('to', myId() == $collection->to ? $collection->from : $collection->to) !!}
                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::style('assets/css/chat.css') !!}
    {!! HTML::script('assets/js/message.js') !!}
    <script>
        // Scroll to end of chat area
        window.onload = function () {
            scrollDown($('.messages > ul'));
        };
    </script>
@endsection
