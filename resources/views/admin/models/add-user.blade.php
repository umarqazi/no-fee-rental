<div class="modal fade" id="add-member">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" id="add-user" action="{{ route('admin.addUser') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name </label>
                            <input type="text" name="first_name" class="input-style" />
                            {{ $errors->first('first_name') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name </label>
                            <input type="text" name="last_name" class="input-style" />
                            {{ $errors->first('last_name') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="input-style" />
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" class="input-style" />
                            {{ $errors->first('phone_number') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type </label>
                            <select class="input-style" name="user_type">
                                <option value="">Select User Type</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            {{ $errors->first('user_type') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="submit" id="add-user-button" class="btn-default">Add User</button>
            </div>
            </form>

        </div>
    </div>
</div>