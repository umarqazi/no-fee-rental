<div class="modal fade" id="view-content">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Neighborhood Content</label>
                            {!! Form::textarea('neighborhood_content', null, ['id' => 'neighborhood_content_view','rows' => 4, 'cols' => 54, 'class' => 'input-style']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
            </div>
        </div>
    </div>
</div>
