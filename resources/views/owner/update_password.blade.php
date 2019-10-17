@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Password Update</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
            	{!! Form::open(
            	    [
            	        'url'    => route(/*'agent.updatePassword'*/),
            	        'method' => 'post',
            	        'id'     => 'update_password',
            	        'class'  => 'ajax'
            	    ]) !!}
            	 <div class="additional-info">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password</label>
                                {!! Form::password('password', ['class' => 'input-style', 'placeholder' => 'New Password']) !!}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                {!! Form::password('password_confirmation', ['class' => 'input-style', 'placeholder' => 'Confirm Password']) !!}
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                       		{!! Form::submit('Update Password', ['class' => 'btn-default large-btn']) !!}
                            <a href="{{ url()->previous() }}" class="btn-default large-btn">Back</a>
                        </div>

                        <div class="col-md-12 mt-4">
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>

        window.onload = function() {
            $(".additional-info .input-style").attr("disabled", false);
        }
    </script>
  @endsection