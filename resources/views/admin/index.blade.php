@extends('secured-layouts.app')
@section('title', 'Users')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>User Accounts</h1>
            <a href="#" class="btn-default ml-3" data-toggle="modal" id="add-user" data-target="#add-member"><i class="fa fa-plus"></i> Add Users</a>
        </div>
        <div class="block listing-container manage-accounts">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">Agent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">Owner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">Renter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-4">Company</a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    {{--Agent Table--}}
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
                    {{--Owner Table--}}
                    <div class="tab-pane fade" id="tab-2">
                        <div class="table-responsive">
                            <table class="datatable dataTable table table-hover display" style="width: 100%;" id="owners_table">
                                <thead>
                                <tr>
                                    <th>Owner Name</th>
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
                            <table class="datatable dataTable table table-hover display" style="width: 100%;" id="renters_table">
                                <thead>
                                <tr>
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
                    <div class="tab-pane fade" id="tab-4">
                        <div class="table-responsive">
                            <table class="datatable dataTable table table-hover display" style="width: 100%;" id="companies_table">
                                <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Business Name</th>
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
 {{--Add User Modal--}}
@include('admin.modals.add_user')
{{--User Page Script--}}
{!! HTML::script('assets/js/user.js') !!}
@endsection
