
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/pignose.calendar.full.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/toaster.js')}}"></script>
<script>
    @if(session('message'))
    toastr.{!! session('alert_type') !!}("{{ session('message') }}");
    @endif
    @if (session('status'))
    toastr.success("{{ session('status') }}");
    @endif
</script>
