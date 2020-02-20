<div class="col-sm-12">
    <div class="open-house-admin-section">
    <h3>Open House</h3>
    @if(isset($listing->openHouses) && count($listing->openHouses) > 0)
        <div class="datepicker-withtime">
            @foreach($listing->openHouses as $key => $value)
                <div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        {!! Form::text("open_house[{$key}][date]", $value->date, ['class' => 'input-style open-house-date', 'autocomplete' => 'off', 'data-date-format' => 'mm-dd-yyyy']) !!}
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start">Start @:</label>
                                {!! Form::select("open_house[{$key}][start_time]", config('openHouse'), reverseTimeSlot($value->start_time), ['class' => 'form-control', 'id' => 'start']) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="sel1">End @:</label>
                                {!! Form::select("open_house[{$key}][end_time]", config('openHouse'), reverseTimeSlot($value->end_time), ['class' => 'form-control', 'id' => 'end']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="custom-control custom-checkbox by-add-only">
                            <div class="custom-control custom-checkbox by-add-only">
                                {!! Form::checkbox("open_house[{$key}][by_appointment]", null, $value->only_appt ? true : false,
                                ['class' => "custom-control-input", 'id' => $key]) !!}
                                <label class="custom-control-label" for="{{ $key }}"> By appt only</label>
                            </div>
                            <div class="remove-btn-wrapper remove-btnn ">
                                <span class="remove-open-house">Remove</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="add-more-btn">
                <a href="javascript:void(0);" class="btn-default add-more">Add more</a>
            </div>
        </div>
    @else
    <div class="datepicker-withtime">
        <div class="row">
            <div class="col-md-4">
                <label>Date</label>
                {!! Form::text('open_house[0][date]', null, ['class' => 'input-style open-house-date', 'autocomplete' => 'off', 'data-date-format' => 'mm-dd-yyyy']) !!}
            </div>
            <div class="col-md-4">
                <label for="start">Start @:</label>
                {!! Form::select('open_house[0][start_time]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
            </div>
            <div class="col-md-4">
                <label for="sel1">End @:</label>
                {!! Form::select('open_house[0][end_time]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'end']) !!}
            </div>
            <div class="col-md-12">
                <div class="custom-control custom-checkbox by-add-only">
                    <div class="custom-control custom-checkbox by-add-only">
                        {!! Form::checkbox('open_house[0][by_appointment]', null, false,
                            ['class' => "custom-control-input", 'id' => '0']) !!}
                        <label class="custom-control-label" for="0"> By appt only</label>
                    </div>
                    <div class="remove-btn-wrapper remove-btnn ">
                        <span class="remove-open-house">Remove</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-more-btn">
            <a href="javascript:void(0);" class="btn-default add-more">Add more</a>
        </div>
    </div>
@endif
</div>
{!! HTML::script('assets/js/open_house.js') !!}
