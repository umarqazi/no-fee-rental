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
                {!! Form::open(['url' => route('list.search'), 'method' => 'get', 'id' => 'search']) !!}
                <div class="row">
                        <div class="col-md-6 search-form-grou-mrg-btm">
                            <div class="form-group">
                                <label class="label">Beds <span>(Select all that applies)</span></label>
                                <ul class="select-bed-options" id="beds">
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 'studio', false, ['class' => 'custom-control-input', 'id' => 'studio']) !!}
                                            <label class="custom-control-label" for="studio">Studio</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 1, false, ['class' => 'custom-control-input', 'id' => 'beds1']) !!}
                                            <label class="custom-control-label" for="beds1">1</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 2, false, ['class' => 'custom-control-input', 'id' => 'beds2']) !!}
                                            <label class="custom-control-label" for="beds2">2</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 3, false, ['class' => 'custom-control-input', 'id' => 'beds3']) !!}
                                            <label class="custom-control-label" for="beds3">3</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 4, false, ['class' => 'custom-control-input', 'id' => 'beds4']) !!}
                                            <label class="custom-control-label" for="beds4">4</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('beds', 5, false, ['class' => 'custom-control-input', 'id' => 'beds5']) !!}
                                            <label class="custom-control-label" for="beds5">5+</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="form-group">
                                <label class="label">Baths <span>(Select all that applies)</span></label>
                                <ul class="select-bed-options" id="baths">
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 'studio', false, ['class' => 'custom-control-input', 'id' => 'studio']) !!}
                                            <label class="custom-control-label" for="studio">Studio</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 1, false, ['class' => 'custom-control-input', 'id' => '1']) !!}
                                            <label class="custom-control-label" for="1">1</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 2, false, ['class' => 'custom-control-input', 'id' => '2']) !!}
                                            <label class="custom-control-label" for="2">2</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 3, false, ['class' => 'custom-control-input', 'id' => '3']) !!}
                                            <label class="custom-control-label" for="3">3</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 4, false, ['class' => 'custom-control-input', 'id' => '4']) !!}
                                            <label class="custom-control-label" for="4">4</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('baths', 5, false, ['class' => 'custom-control-input', 'id' => '5']) !!}
                                            <label class="custom-control-label" for="5">5+</label>
                                        </div>
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
                                    {!! Form::number('priceRange[min_price_2]', null, ['min' => 0, 'max' => 9900, 'id' => 'min_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=0);']) !!} -
                                    {!! Form::number('priceRange[max_price_2]', null, ['min' => 0, 'max' => 10000, 'id' => 'max_price_2', 'class' => 'price-range-field input-style', 'oninput' => 'validity.valid||(value=10000);']) !!}
                                    </div>
                                    <div id="slider-range-2" class="price-filter-range" name="rangeInput"></div>
                                </div>
                            </div>
                        </div>
                        {{--Keywords--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Neighbourhoods</label>
                                {!! Form::text('neighborhoods', null, ['id' => 'neigh', 'class' => 'input-style', 'placeholder' => 'Enter Neighborhood']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Open House</label>
                                {!! Form::text('open_house', null, ['autocomplete' => 'off', 'id' => 'timepicker-actions-exmpl', 'placeholder', 'Open House', 'class' => 'input-style']) !!}
                            </div>
                        </div>
                        {{-- Building Features--}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">@php $i = 1; @endphp
                                    @foreach(features() as $key => $values)
                                        <div class="col-lg-3">
                                            <label class="label">{{ucwords(str_replace('_', ' ', $key))}}</label>
                                            <ul class="checkbox-listing">
                                                @foreach($values as $id => $f)@php $id += 1; $i += 1; @endphp
                                                @if($id == 6)
                                                    </ul></div><div class="col-lg-6"><ul class="checkbox-listing" style="margin-top: 28px;">
                                                @endif
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        {!! Form::checkbox('amenities['.$key.'][]', $id, null, ['class' => 'custom-control-input', 'id' => "listitem{$i}"]) !!}
                                                        <label class="custom-control-label" for="listitem{{$i}}">{{$f}}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
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
</div>
<script>
    // Create start date
    var start = new Date(),
        prevDay,
        startHours = 9;

    // 09:00 AM
    start.setHours(9);
    start.setMinutes(0);

    // If today is Saturday or Sunday set 10:00 AM
    if ([6, 0].indexOf(start.getDay()) != -1) {
        start.setHours(10);
        startHours = 10
    }

    $('#timepicker-actions-exmpl').datepicker({
        timepicker: true,
        language: 'en',
        startDate: start,
        minHours: startHours,
        maxHours: 18,
        onSelect: function (fd, d, picker) {
            // Do nothing if selection was cleared
            if (!d) return;

            var day = d.getDay();

            // Trigger only if date is changed
            if (prevDay != undefined && prevDay == day) return;
            prevDay = day;

            // If chosen day is Saturday or Sunday when set
            // hour value for weekends, else restore defaults
            if (day == 6 || day == 0) {
                picker.update({
                    minHours: 10,
                    maxHours: 16
                })
            } else {
                picker.update({
                    minHours: 9,
                    maxHours: 18
                })
            }
        }
    })
</script>
