<style>
    .modal-backdrop {
        z-index: 15;
    }
</style>
<div class="modal fade" id="building-popup" style="z-index: 20;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Building</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {!! Form::open(['url' => route('owner.addBuilding'), 'method' => 'post', 'id' => 'add_building', 'enctype' => 'multipart/form-data']) !!}
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label> Address:</label>
                            {!! Form::text('address', null, ['class' => 'input-style', 'id' => 'controls']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sel1">Neighborhood:</label>
                            {!! Form::select('neighborhood_id', neighborhoods(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group selectAgent">
                            <label for="select-agent">Select Contact Representative:</label>
                            {!! Form::select('contact_representative', agents(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="radio">Building Action:</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                {!! Form::radio('building_action', OWNERONLY, true, ['class' => 'custom-control-input', 'id' => 'radio1']) !!}
                                <label class="custom-control-label" for="radio1">Owner Only</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                {!! Form::radio('building_action', ALLOWAGENT, false, ['class' => 'custom-control-input', 'id' => 'radio2']) !!}
                                <label class="custom-control-label" for="radio2">Allow Agent</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::file('thumbnail', null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="amenities-section form-group">
                            <div class="row">
                                {!! amenities() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Add Building', ['class' => 'btn btn-default']) !!}
            </div>
        {!! Form::close() !!}
        <!-- Modal footer -->
        </div>
    </div>
</div>
<script>
    autoComplete(document.getElementById('controls'));
    $('#controls').on('input keydown', function(e) {
        if(e.keyCode === 13) {
            e.preventDefault();
        }
    });

    $('#add_building').on('submit', function(e) {
        if(!$('#add_building').valid()) {
            e.preventDefault();
        }
    });
</script>
