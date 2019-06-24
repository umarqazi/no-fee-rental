
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/pignose.calendar.full.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/toastr.js')}}"></script>
    @if(session('message'))
    	{!! toast(session('message'), session('alert_type')) !!}
    @endif
<script>
    @if (session('status'))
    toastr.success("{{ session('status') }}");
    @endif
</script>
