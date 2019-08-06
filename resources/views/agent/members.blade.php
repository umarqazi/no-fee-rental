@extends('secured-layouts.app')
@section('title', 'NoFee Rental Members')
@section('content')
<div class="wrapper">
    <div class="heading-wrapper">
        <h1>Current Team</h1>
        <a href="#" class="btn-default" data-toggle="modal" data-target="#invite-member">Add Member</a>
    </div>
    <div class="block listing-container teams-container">
        <div class="heading-wrapper pl-0">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#listing-active">Current Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#agent-invites">Invites</a>
                </li>
            </ul>

        </div>
        <div class="block-body">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="listing-active">

                    <ul class="team-listing">
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/team-img.png" alt="" class="main-img" />
                            <div class="name">Abraham Pigeon</div>
                            <a href="#" class="team-mail">Abraham124@gmail.com</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="tab-pane fade" id="agent-invites">
                       <table class="table" id="agent_invites_table">
                           <thead>
                           <th>Id</th>
                           <th>Email</th>
                           <th>Invited On</th>
                           <th>Request</th>
                           </thead>
                       </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{--Invite Member--}}
@include('agent.modals.invite_member')

<script>

    window.onload = () => {
        $('#agent_invites_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{route('agent.getInvites')}}",
            },
            columns: [
                {"data": "id"},
                {"data": "email"},
                {"data": "invited_on"},
                {"data": "request"},
            ],
            columnDefs: [
                {
                    render: (data, type, row) => {
                        // retur
                    },
                    targets: 2
                }
            ]
        });
    };
</script>
@endsection
