<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        {!! Form::model(app('request')->all(), ['url' => route('web.indexSearch'), 'method' => 'get', 'id' => 'index-search-from']) !!}
        <div class="search-property">
            <div style="position:relative;">
                <i class="fas fa-search"></i>
                {!! Form::text('neighborhood', null, ['id' => 'neigh', 'placeholder' => 'Enter Neighborhood', 'class' => 'search-fld']) !!}
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
            <div class="dropdown-beds" >
                <label id="show-beds"><span class="placeholder-text">Beds</span></label>
                <div id="advance-search-chkbox" class="beds-dropdown">
                    <div id="advance-search-beds" class="bed-advance-search">
                        {!! bedsDropDown() !!}
                    </div>
                </div>
            </div>
            {!! Form::button('Search', ['class' => 'search-btn search', 'type' => 'submit']) !!}
        </div>

        <span id="search-error-message"></span>
        {!! Form::close() !!}
        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}}
@include('modals.advance_search')
