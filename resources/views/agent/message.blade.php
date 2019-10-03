@extends('secured-layouts.app')
@section('title', 'Messages')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Messages</h1>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">
                            Inbox ({{ $data->totalInbox }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">
                            Archived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">
                            Meeting Request ({{ $data->totalRequests }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    {{--Inbox--}}
                    <div class="tab-pane active" id="tab-1">
                        @if( $data->totalInbox < 1)
                            No Record Found
                        @endif
                        @foreach ($data->inbox as $inbox)
                        <div class="message-row row">
                            <div class="col-sm-10">
                            <h3>{{ $inbox->sender->first_name }}</h3>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ route('agent.loadChat', $inbox->id) }}" class="view-chat"> View</a>
                            </div>
                            <div class="property">
                                <img src="{{ asset($inbox->listing->thumbnail ?? DLI) }}" alt="" />
                                <div class="info">
                                    <ul>
                                        <li><i class="fa fa-bed"></i> {{ $inbox->listing->bedrooms }} Bed</li>
                                        <li><i class="fa fa-bath"></i> {{ $inbox->listing->baths }} Bath</li>
                                    </ul>
                                    <p>{{ $inbox->listing->street_address }}</p>
                                    <div class="price"><i class="fa fa-tag"></i> ${{ $inbox->listing->rent }}</div>
                                </div>
                            </div>
                            <div class="date-text"> {{ formattedDate('D, d/m/y', $inbox->appointment_at) }} 10:14 am</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="tab-2">

                        <div class="message-row">
                            <h3>Elitan</h3>
                            <p>Reminder from nofeerentals: You have still not replied to Ethan in regards Reminder from RentHop: You have still not replied to... <a href="" data-toggle="modal" data-target="#message-modal">Read More</a></p>
                            <div class="property">
                                <img src="assets/images/listing-img.jpg" alt="" />
                                <div class="info">
                                    <ul>
                                        <li><i class="fa fa-bed"></i> 2 Bed</li>
                                        <li><i class="fa fa-bath"></i> 1 Bath</li>
                                    </ul>
                                    <p>at West 96th Street,</p>
                                    <div class="price"><i class="fa fa-tag"></i> $5,870</div>
                                </div>
                            </div>
                            <div class="date-text"> Sun, 05/5/19, 10:14 am</div>
                        </div>
                    </div>

                    {{--Request Meeting--}}
                    <div class="tab-pane fade" id="tab-3">
                        @if( $data->totalRequests < 1)
                            No Record Found
                        @endif
                        @foreach ($data->meeting_requests as $meeting)
                        <div class="message-row">
                            <h3>{{ $meeting->sender->first_name }}</h3>
                            <p>Reminder from nofeerentals: You have still not replied to {{ $meeting->sender->first_name }} in regards Reminder from RentHop<a href="" data-toggle="modal" data-target="#message-modal">Read More</a></p>
                            <div class="property">
                                <img src="{{ asset($meeting->listing->thumbnail ?? DLI ) }}" alt="" />
                                <div class="info">
                                    <ul>
                                        <li><i class="fa fa-bed"></i> {{ $meeting->listing->bedrooms ?? null }} Bed</li>
                                        <li><i class="fa fa-bath"></i> {{ $meeting->listing->baths }} Bath</li>
                                    </ul>
                                    <p>{{ $meeting->listing->street_address }}</p>
                                    <div class="price"><i class="fa fa-tag"></i> ${{ $meeting->listing->rent }}</div>
                                </div>
                            </div>
                            <div class="date-text">{{ $meeting->appointment_at }}</div>
                            <div class="actions-btns">
                                <button class="border-btn" meeting_id="{{ $meeting->id }}" id="reply">Reply</button>
                                <button class="border-btn">Deny</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Agent Messaging Modal--}}
    @include('agent.modals.message')

    {{--Messaging Script--}}
    {!! HTML::script('assets/js/message.js') !!}
@endsection
