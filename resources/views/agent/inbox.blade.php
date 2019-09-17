@extends('secured-layouts.app')
@section('title', 'Messages')
@section('content')
    <div class="wrapper">
        <div class="user-info">
            <div>
                <h3 class="mb-2">{{ $collection->sender->first_name }}</h3>
                <p>E-mail: <strong>{{ $collection->sender->email }}</strong></p>
                <p>Phone: <strong>{{ $collection->sender->phone_number ?? 'N/A' }} </strong></p>
            </div>
            <div class="property-info">
                <img src="assets/images/listing-img.jpg" alt="">
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
                        @foreach($collection->msgs as $message)
                        @if($message->align === myId())
                        <li class="replies">
                            <img style="width: 35px;height: 35px;"
                                 src="{{ !empty(mySelf()->profile_image)
                                    ? asset('storage/'.mySelf()->profile_image)
                                    : asset('assets/images/agent-img.jpg') }}" alt="" />
                            <p>{{ $message->message }}</p>
                        </li>
                        @else
                        <li class="sent">
                            <img  style="width: 35px;height: 35px;"
                                  src="{{ !empty($collection->sender->profile_image)
                                       ? asset('storage/'.$collection->sender->profile_image)
                                        : asset('assets/images/agent-img.jpg') }}" alt="" />
                            <p>{{ $message->message }}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        {!! Form::open(['url' => route('agent.sendMessage', request()->segment(3)), 'class' => 'ajax', 'reset' => 'true']) !!}
                        <input name="message" type="text" placeholder="Write your message..." />
                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::style('assets/css/chat.css') !!}
    <script>
        window.onload = function() {
            $('.messages > ul').animate({scrollTop: $('.messages > ul')[0].scrollHeight});
        }
    </script>
@endsection
