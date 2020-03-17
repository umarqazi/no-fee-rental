<style>
    #advance-search {
        z-index: 20;
    }
    .modal-backdrop {
        z-index: 15;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.min.css')}}"/>
<script src="{{asset('assets/js/datepicker.js')}}"></script>
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
                {!! Form::model(app('request')->all(), [
                    'url' => route($route ?? 'web.search', $params ?? null),
                    'method' => 'get',
                    'id' => 'modal-search-from'
                ]) !!}
                <div class="row">
                    <div class="col-md-6 search-form-grou-mrg-btm">
                        <div class="form-group advance-search-modal-beds search-beds ASBD" id="advance-search-chkbox">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            {!! multi_select_beds(5, app('request')->get('beds') ?? null) !!}
                        </div>
                        <div class="form-group advance-search-modal-baths search-bath ASBA" id="advance-search-chkbox">
                            <label class="label">Baths <span>(Select all that applies)</span></label>
                            {!! multi_select_baths(5, app('request')->get('baths') ?? null) !!}
                        </div>
                    </div>

                    <div class="col-md-6 price-range-advance-srch">
                        <div class="form-group">
                            <label class="label">Price Range</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                    {!! Form::text('min_price', null, ['id' => 'min_price', 'class' => 'input-style ASPm', 'placeholder' => '$ Min Price']) !!} -
                                    {!! Form::text('max_price', null, ['id' => 'max_price', 'class' => 'input-style ASPM', 'placeholder' => '$ Max Price']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Square feet</label>
                            <div class="slider-wrapper">
                                <div class="search-input-wrap">
                                    {!! Form::text('square_min', null, ['id' => 'min_price_2', 'oninput' => "this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');", 'class' => 'input-style', 'placeholder' => 'Min Square ft']) !!} -
                                    {!! Form::text('square_max', null, ['id' => 'max_price_2', 'oninput' => "this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');", 'class' => 'input-style', 'placeholder' => 'Max Square ft']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group search-neighborhood">
                            <label class="label">Neighbourhoods</label>
                            {!! multi_or_single_neighborhood_selector(isset($neigh_filter) ? $neigh_filter : null, app('request')->get('neighborhood')) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Open House</label>
                            {!! Form::text('openHouse', null, ['autocomplete' => 'off', 'id' => 'open_house', 'placeholder' => 'Open House', 'class' => 'input-style']) !!}
                        </div>
                    </div>

                    {{-- Building Features--}}
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            {!! buildingfeatures() !!}
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
    enableDatePicker('#open_house', false);
</script>
