<div class="modal fade" id="add-member">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            {!! Form::open(['method' => 'post', 'url' => route('admin.addUser'), 'id' => 'add_user', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name </label>
                            {!! Form::text('first_name', '', ['class' => 'input-style', 'id' => 'first_name']) !!}
                            {{ $errors->first('first_name') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name </label>
                            {!! Form::text('last_name', '', ['class' => 'input-style', 'id' => 'last_name']) !!}
                            {{ $errors->first('last_name') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            {!! Form::email('email', '', ['class' => 'input-style', 'id' => 'email']) !!}
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            {!! Form::text('phone_number', '', ['class' => 'input-style', 'id' => 'phone_number']) !!}
                            {{ $errors->first('phone_number') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type </label>
                            {!! Form::select('user_type', $roles, '', ['class' => 'input-style', 'id' => 'user_type']) !!}
                            {{ $errors->first('user_type') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                {!! Form::submit('Add User', ['class' => 'btn-default']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>