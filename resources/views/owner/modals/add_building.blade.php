<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
{{--<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->--}}
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src='https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js'></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.4.0/mapbox-gl-csp-worker.js.map"></script>
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
                        <div class="form-group selectAgent">
                            <label for="select-agent">Select Contact Representative:</label>
                            {!! Form::select('contact_representative', agents(), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="radio">Building Action:</label>
                            {!! Form::select('building_action', config('formfields.building_action'), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::file('thumbnail', null, ['class' => 'input-style']) !!}
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
