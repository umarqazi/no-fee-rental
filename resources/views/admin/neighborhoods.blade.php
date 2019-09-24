@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Neighborhoods</h1>
            <a href="#" data-toggle="modal"  id="new-neighborhood"class="btn-default">New Neighborhood</a>
        </div>
        <div class="block">
            <div class="table-responsive">
                <table class="datatable dataTable table table-hover display" style="width: 100%;" id="neighborhoods_table">
                    <thead>
                    <tr>
                        <th>Neighborhood Id</th>
                        <th>Neighborhood Name</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        </div>
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
                                <label>Neighborhood Name </label>
                                <?php echo Form::text('neighborhood_name', '', ['class' => 'input-style', 'id' => 'neighborhood_name']); ?>

                                <?php echo e($errors->first('neighborhood_name')); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Neighborhood Content</label>
                                <?php echo Form::textarea('neighborhood_content', null, ['id' => 'neighborhood_content', 'class' => 'input-style']); ?>

                                <?php echo e($errors->first('neighborhood_content')); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <?php echo Form::submit('Add Neighborhood', ['class' => 'btn-default']); ?>

                </div>
                <?php echo Form::close(); ?>


            </div>
        </div>
    </div>
    <div class="modal fade" id="view-content">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Content</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <?php echo Form::open([]); ?>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Neighborhood Content</label>
                                <?php echo Form::textarea('neighborhood_content', null, ['id' => 'neighborhood_content_view','rows' => 4, 'cols' => 54, 'class' => 'input-style']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">

                </div>
                <?php echo Form::close(); ?>


            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/neighborhoods.js') !!}
@endsection

