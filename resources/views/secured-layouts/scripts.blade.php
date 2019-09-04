@if(session('message'))
	{!! toast(session('message'), session('alert_type')) !!}
@endif

{!! HTML::script('assets/js/notification.js') !!}
