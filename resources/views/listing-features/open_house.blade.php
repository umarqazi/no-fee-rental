
<div class="col-sm-12">
    <label>Open House</label>
</div>
<div class="col-md-12 datepicker-withtime">
    <div class="form-group">
        {!! Form::text('date[]', null, ['class' => 'input-style date']) !!}
    </div>
    <div class="form-group">
        <label for="start">Start @:</label>
        {!! Form::select('start_time[]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
    </div>
    <div class="form-group">
        <label for="sel1">End @:</label>
        {!! Form::select('end_time[]', config('openHouse'), null, ['class' => 'form-control', 'id' => 'start']) !!}
    </div>
    <div class="form-group">
        <label class="checkbox-inline"> {!! Form::checkbox('by_appointment[]') !!} By appt only</label>
    </div>
    <div class="form-group">
        <a href="javascript:void(0);">Add more</a>
    </div>
</div>
