@if(session('message'))
	{!! toast(session('message'), session('alert_type')) !!}
@endif
