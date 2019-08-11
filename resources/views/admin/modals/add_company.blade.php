<style type="text/css">
    .error {
        color: red;
        text-align: left;
        margin-top: 0px !important;
        font-size: 15px !important;
    }
</style>
<div class="modal fade" id="add-company">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <!-- <h4 class="modal-title">Add</h4> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="invites">
                    <label>Add Company:</label>
                    {!! Form::open(['url' => route('admin.createCompany'), 'class' => 'ajax', 'reset' => 'true', 'method' => 'post', 'id' => 'add_company']) !!}
                    {!! Form::text('company', null, ['class' => 'input-style']) !!}
                    {!! Form::hidden('status', 1, ['class' => 'input-style']) !!}
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        {{ $errors->first('email') }}
                    </span>
                    {!! Form::submit('Add', ['class' => 'btn-default large-btn mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>