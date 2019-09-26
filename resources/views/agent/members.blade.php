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
                        @foreach($team as $member)
                        <li>
                            <img src="{{ asset($member->friends->profile_image ?? DUI)}}" alt="" class="main-img" />
                            <div class="name">{{ $member->friends->first_name.' '.$member->friends->last_name }}</div>
                            <a href="#" class="team-mail">{{ $member->friends->email }}</a>
                            <div class="actions-btns">
                                <a href="#" class="btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="#" class="btn-default"><i class="fa fa-envelope"></i> Contact</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-pane fade" id="agent-invites">
                       <table class="table" id="agent_invites_table" style="width: 100%;">
                           <thead>
                           <th>Id</th>
                           <th>Email</th>
                           <th>Invited On</th>
                           <th>Request</th>
                           </thead>
                       </table>
                    <tbody></tbody>
                </div>

            </div>
        </div>
    </div>
</div>

{{--Invite Member--}}
@include('agent.modals.invite_member')

{{--Agent Members Script--}}
{!! HTML::script('assets/js/members.js') !!}

@endsection
