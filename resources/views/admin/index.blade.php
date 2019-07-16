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
                <div class="filter-wrapper">
                    <div class="search-user">
                        {!! Form::open(['url' => route('admin.searchUser'), 'method' => 'post']) !!}
                        <button type="submit" style="background: none; border:none; outline: none; cursor:pointer;">
                        <i class="fa fa-search"></i>
                        </button>
                        {!! Form::text('keywords', Request::get('keywords'), ['class' => 'search-fld', 'placeholder' => 'Search']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">

                        <div class="table-responsive">
                            @if(count($agents) > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Agent Id</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($agents as $key => $agent)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$agent->first_name." ".$agent->last_name}}</td>
                                            <td>{{$agent->email}}</td>
                                            <td>{{$agent->phone_number ?? '---'}}</td>
                                            <td>
                                                <a href="{{route('admin.statusUser', $agent->id)}}">
                                                    <i class="fa fa-eye{{($agent->status) ? '-slash' : ''}} action-btn" data-toggle="modal" data-target="#agent-modal"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="updateUser('{{$agent->id}}');">
                                                    <i class="fa fa-edit px-2 action-btn"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteUser('{{ route('admin.deleteUser', $agent->id) }}')">
                                                    <i class="fa fa-trash action-btn"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            No Record Found
                            @endif
                            {!! $agents->render() !!}
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab-2">

                        <div class="table-responsive">
                            @if(count($renters) > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Renter Id</th>
                                    <th>Renter Name</th>
                                    <th>Property</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($renters as $key => $renter)
                                        <tr>
                                            <td>{{$key + 1}}</td>

                                            <td>{{$renter->first_name." ".$renter->last_name}}</td>
                                            <td>4693 White Oak Drive Kansas City, MO</td>
                                            <td>
                                                <a href="{{ route('admin.statusUser', $renter->id) }}">
                                                    <i class="fa fa-eye{{($renter->status) ? '-slash' : ''}} action-btn" data-toggle="modal" data-target="#renter-modal"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="updateUser('{{$renter->id}}');">
                                                    <i class="fa fa-edit px-2 action-btn"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteUser('{{ route('admin.deleteUser', $renter->id) }}')">
                                                    <i class="fa fa-trash action-btn"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            No Record Found
                            @endif
                            {!! $renters->render() !!}
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

@include('admin.models.add-user')

<!-- Invite User modal -->
@include('admin.models.invite-agent')

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
</div>
@endsection