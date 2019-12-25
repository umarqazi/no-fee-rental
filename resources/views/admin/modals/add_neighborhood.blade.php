<div class="modal fade" id="add-neighborhood">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Neighborhood</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
			{!! Form::open(['method' => 'post', 'url' => route('admin.createNeighborhood'), 'enctype' => 'multipart/form-data']); !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Borough </label>
                            {!! Form::select('boro_id', config('formfields.boro'), null, ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Neighborhood </label>
                            {!! Form::text('neighborhood', '', ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Banner </label>
                            {!! Form::file('banner', ['class' => 'input-style']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            {!! Form::textarea('content', null, ['id' => 'neighborhood_content', 'class' => 'input-style']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                {!! Form::submit('Add Neighborhood', ['class' => 'btn-default']) !!}
            </div>
			<?php echo Form::close(); ?>
        </div>
    </div>
</div>
