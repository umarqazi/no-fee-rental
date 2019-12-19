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
                {!! Form::open(['url' => route($route ?? 'list.search', $param ?? null), 'method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-6 search-form-grou-mrg-btm">
                        <div class="form-group" id="advance-search-chkbox">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            <ul id="advance-search-beds">
                                <li> <input type="checkbox" value="studio" id="Checkbox" name="Checkbox">
                                    <label for="Checkbox"><span class="label-name">Studio</span></label>
                                </li>
                                <li> <input type="checkbox" value="1" id="Checkbox-1" name="beds[]">
                                    <label for="Checkbox-1"><span class="label-name">1</span></label>
                                </li>
                                <li> <input type="checkbox" value="2" id="Checkbox-2" name="beds[]">
                                    <label for="Checkbox-2"><span class="label-name">2</span></label>
                                </li>
                                <li> <input type="checkbox" value="3" id="Checkbox-3" name="beds[]">
                                    <label for="Checkbox-3"><span class="label-name">3</span></label>
                                </li>
                                <li> <input type="checkbox" value="4" id="Checkbox-4" name="beds[]">
                                    <label for="Checkbox-4"><span class="label-name">4</span></label>
                                </li>
                                <li> <input type="checkbox" value="5" id="Checkbox-5" name="beds[]">
                                    <label for="Checkbox-5"><span class="label-name">5+</span></label>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group" id="advance-search-chkbox">
                            <label class="label">Baths <span>(Select all that applies)</span></label>
                            <ul id="advance-search-baths">
                                <li> <input type="checkbox" value="any" id="Checkbox-6" name="baths[]">
                                    <label for="Checkbox-6"><span class="label-name">Any</span></label>
                                </li>
                                <li> <input type="checkbox" value="1" id="Checkbox-7" name="baths[]">
                                    <label for="Checkbox-7"><span class="label-name">1</span></label>
                                </li>
                                <li> <input type="checkbox" value="2" id="Checkbox-9" name="baths[]">
                                    <label for="Checkbox-9"><span class="label-name">2</span></label>
                                </li>
                                <li> <input type="checkbox" value="3" id="Checkbox-10" name="baths[]">
                                    <label for="Checkbox-10"><span class="label-name">3</span></label>
                                </li>
                                <li> <input type="checkbox" value="4" id="Checkbox-11" name="baths[]">
                                    <label for="Checkbox-11"><span class="label-name">4</span></label>
                                </li>
                                <li> <input type="checkbox" value="5" id="Checkbox-12" name="baths[]">
                                    <label for="Checkbox-12"><span class="label-name">5+</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{--Baths--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Price Range</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                {!! Form::number('priceRange[min_price]', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} -
                                {!! Form::number('priceRange[max_price]', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                            </div>
                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Square feet</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                {!! Form::number('squareRange[square_min]', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} -
                                {!! Form::number('squareRange[square_max]', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                                </div>
                                <div id="slider-range-2" class="price-filter-range" name="rangeInput"></div>
                            </div>
                        </div>
                    </div>
                    {{--Keywords--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Neighbourhoods</label>
                            {!! Form::select('neighborhoods', neighborhoods(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Open House</label>
                            {!! Form::text('openHouse', null, ['autocomplete' => 'off', 'id' => 'open_house', 'placeholder', 'Open House', 'class' => 'input-style']) !!}
                        </div>
                    </div>

                    {{--Pets--}}
                    {!! features_pet() !!}

                    {{--Apartment Features--}}
                    {!! features() !!}

                    {{-- Building Features--}}
                    <div class="col-md-12">
                        <div class="row">
                            {!! amenities() !!}
                        </div>
                    </div>
                </div>

                    <div class="col-md-12 text-left mt-4 mb-4 bdr-top-btn">
                        <button type="submit" class="btn-default">Search</button>
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
