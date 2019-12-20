@extends('secured-layouts.app')
@section('title', 'Messages')
@section('content')
    <div class="wrapper">
        <div class="user-info">
            <div class="property-info">
                <div class="img-wrap">
                    <img src="{{ asset($collection->listing->thumbnail ?? DLI ) }}" alt="">
                </div>
                <div class="info">
                    <div class="title">
                        <h3>{{ is_exclusive($collection->listing) }}</h3>
                        <small>{{ $collection->listing->street_address.' - '.$collection->listing->neighborhood->name }}</small>

                    </div>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><defs></defs><title>Asset 4</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M51.21,8.79a30,30,0,0,0-42.42,0,30,30,0,0,0,0,42.42,30,30,0,0,0,42.42,0,30,30,0,0,0,0-42.42ZM31.89,43.05h-.13V47a1.76,1.76,0,0,1-3.52,0v-3.9H24.35a1.76,1.76,0,1,1,0-3.51h7.54a3.89,3.89,0,1,0,0-7.78H28.13a7.41,7.41,0,1,1,0-14.81h.12v-3.9a1.76,1.76,0,0,1,3.52,0V17h3.89a1.76,1.76,0,1,1,0,3.51H28.13a3.89,3.89,0,1,0,0,7.78h3.76a7.41,7.41,0,0,1,0,14.81Z"></path></g></g></svg>
                            <span> {{ ($collection->listing->rent) ?   number_format($collection->listing->rent,0) : 'None' }}</span>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 55"><defs></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M3.25,32.55l.5,0,52.69,0,.31,0h.14a1.25,1.25,0,0,0,1.25-1.25,1.19,1.19,0,0,0-.2-.68L55,21.06V6.25A6.25,6.25,0,0,0,48.75,0H11.25A6.25,6.25,0,0,0,5,6.25V21.06L2,30.94a1.25,1.25,0,0,0,1.29,1.61ZM8.75,20H10.9l1.16-4.66A3.75,3.75,0,0,1,15.7,12.5h8.05a3.75,3.75,0,0,1,3.75,3.75V20h5V16.25a3.75,3.75,0,0,1,3.75-3.75h8a3.75,3.75,0,0,1,3.64,2.84L49.1,20h2.15a1.25,1.25,0,0,1,0,2.5H49.06a3.61,3.61,0,0,1-.56,1.06,3.73,3.73,0,0,1-3,1.44h-9.3a3.75,3.75,0,0,1-3.52-2.5H27.27A3.75,3.75,0,0,1,23.75,25h-9.3a3.73,3.73,0,0,1-2.95-1.44,3.49,3.49,0,0,1-.56-1.06H8.75a1.25,1.25,0,0,1,0-2.5Z"></path><path class="cls-1" d="M56.25,35H3.75A3.75,3.75,0,0,0,0,38.75v15A1.25,1.25,0,0,0,1.25,55h5A1.25,1.25,0,0,0,7.5,53.75V50h45v3.75A1.25,1.25,0,0,0,53.75,55h5A1.25,1.25,0,0,0,60,53.75v-15A3.75,3.75,0,0,0,56.25,35Z"></path></g></g></svg> <span> {{ str_formatting($collection->listing->bedrooms, 'Bed') }}</span>
                        </li>
                        <li> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.12 60"><defs></defs><title>Asset 2</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M7.84,38.82A3.39,3.39,0,0,0,4.45,42.2v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,7.84,38.82Z"></path><path class="cls-1" d="M16.67,49.85a3.38,3.38,0,0,0-3.38,3.38v3.39a3.38,3.38,0,1,0,6.76,0V53.23A3.39,3.39,0,0,0,16.67,49.85Z"></path><path class="cls-1" d="M7.8,49.85a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V53.23A3.39,3.39,0,0,0,7.8,49.85Z"></path><path class="cls-1" d="M25.52,38.82a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,25.52,38.82Z"></path><path class="cls-1" d="M38.72,0h-13a12.42,12.42,0,0,0-12.4,12.41v5.68A16.73,16.73,0,0,0,0,34.43a3.39,3.39,0,0,0,3.38,3.39H30a3.38,3.38,0,0,0,3.38-3.39,16.7,16.7,0,0,0-13.3-16.34V12.41a5.64,5.64,0,0,1,5.63-5.64h13a5.65,5.65,0,0,1,5.64,5.64V56.62a3.38,3.38,0,1,0,6.76,0V12.41A12.42,12.42,0,0,0,38.72,0Z"></path><path class="cls-1" d="M16.69,38.82a3.39,3.39,0,0,0-3.38,3.38v3.39a3.39,3.39,0,0,0,6.77,0V42.2A3.39,3.39,0,0,0,16.69,38.82Z"></path><path class="cls-1" d="M25.5,49.85a3.38,3.38,0,0,0-3.38,3.38v3.39a3.38,3.38,0,1,0,6.76,0V53.23A3.38,3.38,0,0,0,25.5,49.85Z"></path></g></g></svg>
                            <span> {{ str_formatting($collection->listing->baths, 'Bath') }}</span>
                        </li>
                        <li> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.67 60"><defs></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M55.87,0h-41a3.8,3.8,0,0,0-3.81,3.81V7.39h4V4H55.68V44.61H52.61v4h3.26a3.8,3.8,0,0,0,3.8-3.81v-41A3.8,3.8,0,0,0,55.87,0Z"></path><path class="cls-1" d="M44.8,11.4h-41A3.8,3.8,0,0,0,0,15.2v41A3.8,3.8,0,0,0,3.81,60h41a3.8,3.8,0,0,0,3.8-3.81v-41A3.81,3.81,0,0,0,44.8,11.4ZM42.1,27.66a.63.63,0,0,1-.42.61.65.65,0,0,1-.73-.14l-3.2-3.21L13.61,49.22l3.2,3.2a.7.7,0,0,1,.15.74.68.68,0,0,1-.62.4H7.09a.67.67,0,0,1-.67-.66V43.65A.67.67,0,0,1,6.83,43a.68.68,0,0,1,.73.14l3.22,3.22L34.93,22.11l-3.22-3.22a.68.68,0,0,1-.14-.73.66.66,0,0,1,.61-.41h9.25a.67.67,0,0,1,.67.67Z"></path></g></g></svg>
                            <span> {{ $collection->listing->square_feet ?? 'N/A' }}</span>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="clients-info">
                <h3 class="mb-2">{{ $collection->sender->first_name ?? $collection->username }}</h3>
                <p>E-mail: <strong>{{ $collection->sender->email ?? $collection->email }}</strong></p>
                <p>Phone: <strong>{{ $collection->sender->phone_number ?? $collection->phone_number }} </strong></p>
            </div>
        </div>
        <div id="frame">
            <div class="content">
                <div class="messages">
                    <ul>
                        @foreach($collection->messages as $message)
                            @if($message->align === myId())
                                <li class="replies">
                                    <img style="width: 25px;height: 25px;" src="{{ asset(mySelf()->profile_image ?? DUI) }}" alt="" />
                                    <p>{{ $message->message }}</p>
                                </li>
                            @else
                                <li class="sent">
                                    <img  style="width: 25px;height: 25px;" src="{{ asset($collection->sender->profile_image ?? DUI) }}" alt="" />
                                    <p>{{ $message->message }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        {!! Form::open(['id' => 'send-message', 'url' => route('renter.sendMessage', $collection->id)]) !!}
                        <span id="error" style="color: red ; padding-left:7px;display: none">Message Field is required.</span>
                        {!! Form::text('message', null, ['placeholder' => 'Write your message...', 'autocomplete' => 'off']) !!}
                        {!! Form::hidden('to', myId() == $collection->to ? $collection->from : $collection->to) !!}
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::style('assets/css/chat.css') !!}
    <script>
        // Scroll to end of chat area
        window.onload = function () {
            scrollDown($('.messages > ul'));
        };
    </script>
@endsection
