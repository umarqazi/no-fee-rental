<style>
    .ui-menu {
        max-width: 850px;
        width: 100%;
    }
</style>
<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        <div class="search-property">
            <i class="fas fa-search"></i>
{{--            {!! Form::open('') !!}--}}
            <input type="text" class="search-fld" name="neighborhood" placeholder="Enter Neighborhood" />
            <button class="search-btn">Search</button>
        </div>
        <a href="" class="advance-search" data-toggle="modal" data-target="#advance-search">+Advanced Search</a>
    </div>
</div>
{!! HTML::script('assets/js/vendor/autocomplete.js') !!}
<script>
    let neighbours = @php echo json_encode(config('neighborhoods')); @endphp;
    let $neighbour = $('input[name=neighborhood]');
    $neighbour.autocomplete({
        source: neighbours,
        select: function (event, ui) {
            $(this).val(ui.item ? ui.item : " ");
        },

        change: function (event, ui) {
            if (!ui.item) {
                this.value = '';
            }
        }
    });
</script>
