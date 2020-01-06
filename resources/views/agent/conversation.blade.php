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
                            Inbox ({{ $conversations->active->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">
                            Archived ({{ $conversations->archived->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">
                            Meeting Request ({{ $conversations->inactive->total() }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    {{--Inbox--}}
                    <div class="tab-pane active" id="tab-1">
                        @include('agent.conversation-tabs.inbox')
                    </div>
                    {{--Archive--}}
                    <div class="tab-pane fade" id="tab-2">
                        @include('agent.conversation-tabs.archived')
                    </div>
                    {{--Request Meeting--}}
                    <div class="tab-pane fade" id="tab-3">
                        @include('agent.conversation-tabs.meeting_request')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Agent Messaging Modal--}}
    @include('agent.modals.message')

    {{--Messaging Script--}}
{{--    {!! HTML::script('assets/js/message.js') !!}--}}
@endsection
