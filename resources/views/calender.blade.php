@extends('secured-layouts.app')
@section('title', 'Calendar')
@section('content')
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<div class="wrapper">
    <div class="heading-wrapper">
        <h1>Calendar</h1>
    </div>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
</div>
@endsection
