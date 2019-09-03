
    @if(session('message'))
    	{!! toast(session('message'), session('alert_type')) !!}
    @endif

{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') !!}
<script src="{{asset('assets/js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/wow.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/pignose.calendar.full.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/vendor/lightslider.js')}}"></script>
