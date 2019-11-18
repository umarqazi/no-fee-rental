<div class="modal fade" id="add-neighborhood">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Neighborhood</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
			<?php echo Form::open(['method' => 'post', 'url' => route('neighborhood.create'), 'id' => 'add_neighborhood', 'class' => 'ajax', 'enctype' => 'multipart/form-data', 'reset' => 'true']); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name </label>
                            {!! Form::text('neighborhood_name', '', ['class' => 'input-style', 'id' => 'neighborhood_name']) !!}
                            {{ $errors->first('neighborhood_name') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            {!! Form::textarea('neighborhood_content', null, ['id' => 'neighborhood_content', 'class' => 'input-style']) !!}
                            {{ $errors->first('neighborhood_content') }}
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
