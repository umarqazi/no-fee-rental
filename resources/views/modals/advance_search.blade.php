<style>
    #advance-search {
        z-index: 20;
    }
    .modal-backdrop {
        z-index: 15;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.min.css')}}"/>
<script src="{{asset('assets/js/datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/datepicker.en.js')}}"></script>
<div class="modal fade" id="advance-search">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{--Modal Header--}}
            <div class="modal-header">
                <h4 class="modal-title">Advance Search</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{--Modal body--}}
            <div class="modal-body">
                {!! Form::model(app('request')->all(), ['url' => route($search_route ?? 'web.advanceSearch', $param ?? null), 'method' => 'get', 'id' => 'modal-search-from']) !!}
                <div class="row">
                    <div class="col-md-6 search-form-grou-mrg-btm">
                        <div class="form-group advance-search-modal-beds search-beds" id="advance-search-chkbox">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            {!! multi_select_beds(5, app('request')->get('beds') ?? null) !!}
                        </div>
                        <div class="form-group advance-search-modal-baths search-bath" id="advance-search-chkbox">
                            <label class="label">Baths <span>(Select all that applies)</span></label>
                            {!! multi_select_baths(5, app('request')->get('baths') ?? null) !!}
                        </div>
                    </div>
                    {{--Baths--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Price Range</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                {!! Form::number('min_price', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} -
                                {!! Form::number('max_price', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                            </div>
                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Square feet</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                {!! Form::number('square_min', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} -
                                {!! Form::number('square_max', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                                </div>
                                <div id="slider-range-2" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                    </div>
                    {{--Keywords--}}
                    <div class="col-md-6">
                        <div class="form-group search-neighborhood">
                            <label class="label">Neighbourhoods</label>
                            <select class="input-style" name="neighborhood">
                                {!! simple_neighborhood_select(app('request')->get('neighborhood') ?? null) !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Open House</label>
                            {!! Form::text('openHouse', null, ['autocomplete' => 'off', 'id' => 'open_house', 'placeholder', 'Open House', 'class' => 'input-style','data-date-format' => 'yyyy-mm-dd']) !!}
                        </div>
                    </div>

                    {{-- Building Features--}}
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            {!! amenities() !!}
                        </div>
                    </div>

                    {{--Apartment Features--}}
                    {!! features() !!}

                    {{--Pets--}}
                    {!! features_pet() !!}

                </div>

                    <div class="col-md-12 text-left mt-4 mb-4 bdr-top-btn">
                        <button type="submit" class="btn-default search">Search</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
<script>
    fetchNeighbours($('input[name=neighborhoods]'));
    enableDatePicker('#open_house', false);
</script>
