
    <script>
        Window.Laravel = {user: "{{ authenticated() ? myId() : null }}"};
    </script>
    {!! HTML::script('assets/js/vendor/jquery-3.2.1.min.js') !!}
    {!! HTML::script('assets/js/vendor/toastr.js') !!}
    {!! HTML::script('assets/js/notification.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js') !!}
    {!! HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
    {!! HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') !!}
    {!! HTML::script('assets/js/vendor/jquery.validate.min.js') !!}
    {!! HTML::script('assets/js/global.js') !!}
    {!! HTML::script('assets/js/map.js') !!}
    {!! HTML::script('assets/js/validate.js') !!}
    {!! HTML::script('assets/js/jquery.nicescroll.min.js') !!}
    {!! HTML::script('assets/js/vendor/owl.carousel.min.js') !!}
    {!! HTML::script('assets/js/vendor/pignose.calendar.full.min.js') !!}
    {!! HTML::script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') !!}
    {!! HTML::script('assets/js/recent-search.js') !!}
    {!! HTML::script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') !!}
    {!! HTML::script("assets/js/vendor/jquery-ui.min.js") !!}
    {!! HTML::script("assets/js/vendor/jquery.ui.touch-punch.min.js") !!}
    {!! HTML::script("assets/js/vendor/popper.min.js") !!}
    {!! HTML::script("assets/js/vendor/bootstrap.min.js") !!}
    {!! HTML::script("assets/js/vendor/wow.min.js") !!}
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
        });
    </script>
