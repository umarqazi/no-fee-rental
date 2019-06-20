@extends('admin.layouts.base')
@section('title', 'Users')
@section('content')

    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>User Accounts</h1>
            <a href="#" class="btn-default ml-auto" data-toggle="modal" data-target="#invite-user"><i class="fa fa-share"></i> Send Invites</a>
            <a href="#" class="btn-default ml-3" data-toggle="modal" data-target="#add-member"><i class="fa fa-plus"></i> Add Users</a>
        </div>
        <div class="block listing-container manage-accounts">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">Agent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">Renter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">Company</a>
                    </li>
                </ul>
                <div class="filter-wrapper">
                    <div class="search-user">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search" class="search-fld" />
                    </div>
                </div>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">

                        <div class="table-responsive">
                            @if(count($users) > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                <tr>
                                    <td>#{{$key + 1}}</td>
                                    <td>{{$user->first_name." ".$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->user_type == 1)
                                        Owner
                                        @elseif($user->user_type == 2)
                                        Agent
                                        @else
                                        Renter
                                        @endif
                                    </td>
                                    <td>{{!empty($user->phone_number) ? $user->phone_number : '---'}}</td>
                                    <td>
                                        <a href="/admin/visibility/{{$user->id}}"><i class="fa fa-eye{{($user->status) ? '-slash' : ''}} action-btn" data-toggle="modal" data-target="#user-modal"></i></a>
                                        <a href="#"><i class="fa fa-edit px-2 action-btn"></i></a>
                                        <a href="javascript:void(0);" onclick="confirm('Are you sure?') ? window.location.href='{{route("user.delete", $user->id)}}' : ''"><i class="fa fa-trash action-btn"></i></a>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            No Record Found
                            @endif
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab-2">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Customer Name</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Reply rate</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab-3">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Customer Name</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Reply rate</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#243654</td>
                                    <td>Quiche Hollandaise</td>
                                    <td>4693 White Oak Drive Kansas City, MO</td>
                                    <td>20 Jan 2019</td>
                                    <td>Agent</td>
                                    <td>90% / 2 hrs</td>
                                    <td>
                                        <i class="fa fa-eye action-btn" data-toggle="modal" data-target="#user-modal"></i>
                                        <i class="fa fa-edit px-2 action-btn"></i>
                                        <i class="fa fa-trash action-btn"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Member modal -->
<div class="modal fade" id="add-member">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="{{route('user.add')}}" enctype="multipart/form-data">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type </label>
                            <select class="input-style" name="user_type">
                                <option value="">Select</option>
                                <option value="1">Owner</option>
                                <option value="2">Agent</option>
                                <option value="3">Renter</option>
                            </select>
                            {{ $errors->first('user_type') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Password</label>
                        <input type="password" name="password" class="input-style">
                        {{ $errors->first('password') }}
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn-default">Add User</button>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Invite User modal -->
<div class="modal fade" id="invite-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Member</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="invites">
                    <h3>Team members will be able to engage with your leads.</h3>
                    <p>Please search using the agent's email. Team members must have an active Nofeerentals account. Please make sure that team member's profiles are filled out in order to fully optimize the Team feature. </p>
                    <label>Invite Member:</label>
                    <input type="text" class="input-style">
                    <button type="button" class="btn-default large-btn mt-4">Send</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Invite User modal -->
<div class="modal fade user-modal-wrapper" id="user-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Abraham Pigeon</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="user-thumb">
                    <img src="assets/images/team-img.png" alt="" class="main-img">
                    <div class="name">Abraham Pigeon</div>
                    <a href="#" class="team-mail">Abraham124@gmail.com</a>
                    <div class="actions-btns">
                        <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                        <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection