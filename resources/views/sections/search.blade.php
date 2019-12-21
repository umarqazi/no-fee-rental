<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        {!! Form::open(['url' => route('list.search'), 'method' => 'get', 'id' => 'search']) !!}
        <div class="search-property">
            <div style="position:relative;">
                <i class="fas fa-search"></i>
                {!! Form::text('neighborhoods', null, ['id' => 'neigh', 'placeholder' => 'Enter Neighborhood', 'class' => 'search-fld']) !!}
{{--                {!! Form::select('priceRange',  config('formfields.search.price') ,null, ['class' => 'custom-select-input','id' => 'main-search-priceRange']) !!}--}}
                {{--                {!! Form::select('beds', config('formfields.search.beds'),null, ['class' => 'custom-select-input size-input','id' => 'main-search-beds']) !!}--}}

            </div>
            <div class="price-range-dropdown">
               Price
                <div class="price-range-ul">
                    <ul>
                        <li><input type="text" class="form-control" placeholder="min"></li>
                        <li>To</li>
                        <li><input type="text" class="form-control" placeholder="max"> </li>
                    </ul>
                </div>
            </div>

            <div class="dropdown-beds" >
                <label id="show-beds"><span class="placeholder-text">Beds</span></label>
                <div id="advance-search-chkbox" class="beds-dropdown">
                    <div id="advance-search-beds" class="bed-advance-search">
                        <ul>
                            <li> <input type="checkbox" value="studio" id="Checkbox-ad-search" name="Checkbox">
                                <label for="Checkbox-ad-search"><span class="label-name">Studio</span></label>
                            </li>
                            <li> <input type="checkbox" value="1" id="Checkbox-1-ad-search" name="beds[]">
                                <label for="Checkbox-1-ad-search"><span class="label-name">1</span></label>
                            </li>
                            <li> <input type="checkbox" value="2" id="Checkbox-2-ad-search" name="beds[]">
                                <label for="Checkbox-2-ad-search"><span class="label-name">2</span></label>
                            </li>
                            <li> <input type="checkbox" value="3" id="Checkbox-3-ad-search" name="beds[]">
                                <label for="Checkbox-3-ad-search"><span class="label-name">3</span></label>
                            </li>
                            <li> <input type="checkbox" value="4" id="Checkbox-4-ad-search" name="beds[]">
                                <label for="Checkbox-4-ad-search"><span class="label-name">4</span></label>
                            </li>
                            <li> <input type="checkbox" value="5" id="Checkbox-5-ad-search" name="beds[]">
                                <label for="Checkbox-5-ad-search"><span class="label-name">5+</span></label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {!! Form::button('Search', ['class' => 'search-btn', 'type' => 'submit']) !!}
        </div>

        <span id="search-error-message"></span>
        {!! Form::close() !!}

        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}}
@include('modals.advance_search')
