<div class="col-sm-12">
    <div class="open-house-admin-section">
        <h3>Open House</h3>

    @if($action == 'Update' || $action == 'Copy')
        @foreach($listing->openHouses as $key => $value)
            <div class="datepicker-withtime">
                <div class="form-group">
                    {!! Form::text('open_house[date][]', $value->date, ['class' => 'input-style date']) !!}
                </div>
                <div class="form-group">
                    <label for="start">Start @:</label>
                    {!! Form::select('open_house[start_time][]', config('openHouse'), $value->start_time, ['class' => 'form-control', 'id' => 'start']) !!}
                </div>
                <div class="form-group">
                    <label for="sel1">End @:</label>
                    {!! Form::select('open_house[end_time][]', config('openHouse'), $value->end_time, ['class' => 'form-control', 'id' => 'start']) !!}
                </div>
                <div class="form-group">
                    <label class="checkbox-inline"> {!! Form::checkbox('open_house[by_appointment][]', $value->only_appt ?? null, $value->only_appt ?? false) !!} By appt only</label>
                </div>
                <div class="form-group">
                    <a href="javascript:void(0);">Add more</a>
                </div>
            </div>

        @endforeach
</div>
@else
    <div class="datepicker-withtime">
        <div class="row">
            <div class="col-md-6">
                <label>Date</label>
                {!! Form::text('open_house[date][]', null, ['class' => 'input-style open-house-date', 'autocomplete' => 'off']) !!}
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="start">Start @:</label>
                        {!! Form::select('open_house[start_time][]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="sel1">End @:</label>
                        {!! Form::select('open_house[end_time][]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'end']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2 mb-2">
                <div class="custom-control custom-checkbox by-add-only"><input class="custom-control-input" id="listitem1" name="amenities[]" type="checkbox" value="1"><label class="custom-control-label" for="listitem1"> By appt only</label>
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
