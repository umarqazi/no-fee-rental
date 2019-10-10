@extends('secured-layouts.app')
@section('title', 'Calendar')
@section('content')

    {!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css') !!}

<div class="wrapper">
    <div class="heading-wrapper">
        <h1>Calendar</h1>
        <a href="javascript:void(0);" class="btn btn-default" data-toggle="modal" data-target="#add-event">Add Event</a>
    </div>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
</div>
    {{--Add Event Modal--}}
    @include('agent.modals.add_event')
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js') !!}
    <script>
        enableDatePicker('input[name=start]', false);
        enableDatePicker('input[name=end]', false);
    </script>
@endsection