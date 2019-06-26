
    @if(session('message'))
    	{!! toast(session('message'), session('alert_type')) !!}
    @endif
<script>
    @if (session('status'))
    toastr.success("{{ session('status') }}");
    @endif
</script>
