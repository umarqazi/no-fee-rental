
    @if(session('message'))
    	{!! toast(session('message'), session('alert_type')) !!}
    @endif

    {!! HTML::script('assets/js/recent-search.js') !!}
    {!! HTML::script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') !!}
    {!! HTML::script("assets/js/vendor/jquery-ui.min.js") !!}
    {!! HTML::script("assets/js/vendor/jquery.ui.touch-punch.min.js") !!}
    {!! HTML::script("assets/js/vendor/popper.min.js") !!}
    {!! HTML::script("assets/js/vendor/bootstrap.min.js") !!}
    {!! HTML::script("assets/js/vendor/wow.min.js") !!}
    {!! HTML::script("assets/js/vendor/jquery.validate.min.js") !!}
    {!! HTML::script("assets/js/custom.js") !!}
    {!! HTML::script("assets/js/vendor/lightslider.js") !!}
    <script>
        $(() => {
            let $disabledResults = $('.neighborhood-select-search');
            $disabledResults.select2();
            $('button[data-target="#check-availability"]').on('click', function() {
                @if(!authenticated())
                    $('#login').modal('show');
                @else
                    $('#check-availability').modal('show');
                @endif
            });
            @if(!empty($errors->all()))
                populateErrors($(this), "{{ $errors->all() }}");
            @endif

            $('.property-thumb > img').resizeToParent();
        });
    </script>
