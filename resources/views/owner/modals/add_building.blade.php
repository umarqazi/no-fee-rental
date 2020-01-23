{!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
{!! HTML::style('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css') !!}
{!! HTML::script('https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js') !!}
{!! HTML::script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js') !!}
{!! HTML::script('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js') !!}
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
                        <div class="form-group" id="address">
                            <label> Address:</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sel1">Neighborhood:</label>
                            {!! Form::text('neighborhood', null, ['class' => 'input-style', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="radio">Building Action:</label>
                            {!! Form::select('building_action', config('formfields.building_action'), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="open-house-admin-section">
                            <label>Contact Representative</label>
                            <div class="row">
                                <div class="col-md-4 selectAgent">
                                    <label for="select-agent">Email</label>
                                    {!! Form::email('contact_representative', null, ['class' => 'input-style']) !!}
                                </div>
                                <div class="col-md-4 selectAgent">
                                    <label for="select-agent">Username:</label>
                                    {!! Form::text('username', null, ['class' => 'input-style']) !!}
                                </div>
                                <div class="col-md-4 selectAgent">
                                    <label for="select-agent">Phone Number:</label>
                                    {!! Form::text('phone_number', null, ['class' => 'input-style']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <img class="img-thumbnail" src="{{isset($building->thumbnail) ? asset($building->thumbnail ?? DLI ) : asset(DLI) }}" id="img" style="width: 180px;height: 145px;margin-bottom: 15px;">
                            </div>
                            {!! Form::file('thumbnail', ['id' => 'file-3']) !!}
                            {!! Form::hidden('map_location', null) !!}
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
<div id="map" style="display: none;"></div>
<script>
    initMap('map');
    autoComplete('controls');
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
