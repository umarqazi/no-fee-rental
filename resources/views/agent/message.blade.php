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
                            Inbox ({{ $data->appointments->active->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-4">
                            Checking Availability ({{ $data->availabilities->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">
                            Archived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">
                            Meeting Request ({{ $data->appointments->inactive->total() }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    {{--Inbox--}}
                    <div class="tab-pane active" id="tab-1">
                        @include('agent.message-tabs.inbox')
                    </div>
                    {{--Archive--}}
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
                        @include('agent.message-tabs.meeting_request')
                    </div>
                    {{--Availability--}}
                    <div class="tab-pane fade" id="tab-4">
                        @include('agent.message-tabs.availabilities')
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
