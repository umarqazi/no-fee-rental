<div class="col-sm-12">
    <label>Open House</label>
</div>
@if($action == 'Update' || $action == 'Copy')
    @foreach($listing->openHouses as $key => $value)
        <div class="col-md-12 datepicker-withtime">
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
@else
    <div class="col-md-12 datepicker-withtime">
        <div class="form-group">
            {!! Form::text('open_house[date][]', null, ['class' => 'input-style date']) !!}
        </div>
        <div class="form-group">
            <label for="start">Start @:</label>
            {!! Form::select('open_house[start_time][]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
        </div>
        <div class="form-group">
            <label for="sel1">End @:</label>
            {!! Form::select('open_house[end_time][]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
        </div>
        <div class="form-group">
            <label class="checkbox-inline"> {!! Form::checkbox('open_house[by_appointment][]') !!} By appt only</label>
        </div>
        <div class="form-group">
            <a href="javascript:void(0);">Add more</a>
        </div>
    </div>
@endif
