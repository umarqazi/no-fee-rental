<style type="text/css">
    .error {
        color: red;
        text-align: left;
        margin-top: 0px !important;
        font-size: 15px !important;
    }
</style>
<div class="modal fade" id="invite-member">
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
                    {!! Form::open(['url' => route('agent.inviteMember'), 'method' => 'post', 'class' => 'ajax', 'reset' => 'true', 'id' => 'agent_invite']) !!}
                    {!! Form::email('email', null, ['class' => 'input-style']) !!}
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        {{ $errors->first('email') }}
                    </span>
                    {!! Form::submit('Send', ['class' => 'btn-default large-btn mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>
