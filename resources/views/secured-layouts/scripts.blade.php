{!! HTML::script('assets/js/vendor/simple.money.format.js') !!}
@if(session('message'))
    {!! toast(session('message'), session('alert_type')) !!}
    @php session()->forget(['message', 'alert_type']) @endphp
@endif
