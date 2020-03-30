@extends('secured-layouts.app')
@section('title', 'Calendar')
@section('content')
    {!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css') !!}

<div class="wrapper">
    <div class="heading-wrapper">
        <h1>Calendar</h1>
        {{--<a href="javascript:void(0);" class="btn btn-default" data-toggle="modal" data-target="#add-event"><i class="fa fa-plus"></i> Add Event</a>--}}
    </div>
    {!! $calendar !== null ? $calendar->calendar() : 'No Event Found' !!}
    {!! $calendar !== null ? $calendar->script() : '' !!}
</div>
    {{--@include('owner.modals.add_event')--}}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js') !!}
    <script>
        enableDatePicker('input[name=start]', true);
        enableDatePicker('input[name=end]', true);
    </script>
@endsection
