
<style>
    #add-event {
        z-index: 20;
    }
    .modal-backdrop {
        z-index: 15;
    }
</style>
{!! HTML::style('assets/css/datepicker.min.css') !!}
<div class="modal fade" id="add-event">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {!! Form::open(['url' => route('renter.addEvent'),'id'=>'add_event']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label> Event Title</label>
                    {!! Form::text('title', null, ['class' => 'input-style']) !!}
                </div>
                <div class="form-group">
                    <label> Start Date</label>
                    {!! Form::text('start', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    <label> End Date</label>
                    {!! Form::text('end', null, ['class' => 'input-style', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Create Event', ['class' => 'btn btn-default']) !!}
                {!! Form::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{!! HTML::script('assets/js/datepicker.min.js') !!}
{!! HTML::script('assets/js/datepicker.en.js') !!}
