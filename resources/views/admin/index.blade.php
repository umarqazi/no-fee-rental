@extends('secured-layouts.app')
@section('title', 'Users')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>User Accounts</h1>
            <a href="#" class="btn-default ml-auto" data-toggle="modal" data-target="#invite-user"><i class="fa fa-share"></i> Send Invites</a>
            <a href="#" class="btn-default ml-3" data-toggle="modal" id="add-user" data-target="#add-member"><i class="fa fa-plus"></i> Add Users</a>
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
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">
                        <div class="table-responsive">
                            <table id="agents_table" style="width: 100%;" class="datatable dataTable table table-hover display">
                                <thead>
                                <tr>
                                    <th>Agent Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>License Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-2">
                        <div class="table-responsive">
                            <table class="datatable dataTable table table-hover display" style="width: 100%;" id="renters_table">
                                <thead>
                                <tr>
                                    <th>Renter Id</th>
                                    <th>Renter Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-3">
                        <div class="table-responsive">
                            <table class="datatable dataTable table table-hover display" style="width: 100%;" id="companies_table">
                                <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Name</th>
                                    <th>View Associated Agent</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- Add User Modal -->
@include('admin.modals.add_user')
<!-- Invite User Modal -->
@include('admin.modals.invite_agent')
<!-- Add Company Modal -->
@include('admin.modals.add_company')
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
</div>
{!! HTML::script('assets/js/user.js') !!}
@endsection
