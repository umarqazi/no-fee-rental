<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        <div class="advce-search-form-wrapper" style="position: relative">
            {!! Form::model(app('request')->all(), ['url' => route('web.indexSearch'), 'method' => 'get', 'id' => 'index-search-from']) !!}
            <div class="search-property">
                <div style="position:relative;" class="search-neighborhood">
                    <i class="fas fa-search"></i>
                    <label class="search-fld">Neighborhood </label>
                </div>
                <div class="price-range-dropdown">
                    Price
                    <div class="price-range-ul">
                        <ul>
                            <li>
                                {!! Form::text('min_price', null, ['class' => 'form-control', 'placeholder' => 'min']) !!}
                            </li>
                            <li>To</li>
                            <li>
                                {!! Form::text('max_price', null, ['class' => 'form-control', 'placeholder' => 'max']) !!}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown-beds main-search-beds">
                    <label id="show-beds"><span class="placeholder-text">Beds</span></label>
                    <div id="advance-search-chkbox" class="beds-dropdown">
                        <div id="advance-search-beds" class="bed-advance-search search-beds">
                            {!! bedsDropDown() !!}
                        </div>
                    </div>
                </div>
                {!! Form::button('Search', ['class' => 'search-btn search', 'type' => 'submit']) !!}

            </div>
            <div class="neighborhood-search-advance">
            <div class="neighborhood-search-dropdown let-us-help-modal">
                <div class="modal-body search-neighborhood">
                    {!! neighborhood_let_us_help() !!}
                </div>
            </div>
            <span id="search-error-message"></span>
                {!! Form::close() !!}
        </div>
        </div>
        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
<script>
    $('.neighborhood-list > li > div').on('click', function() {
        $('.search-fld').text($(this).text());
    });
</script>
{{--Advance Search--}}
@include('modals.advance_search')
