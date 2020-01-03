<style>
    #need-help-step4 {
        z-index: 20;
    }

    #need-help-step1 {
        z-index: 20;
    }

    .modal-backdrop {
        z-index: 15;
    }
</style>
{!! Form::open(['url' => route('web.getStarted'),'id' => 'get_started']) !!}
<div class="modal fade need-help-modal" id="need-help-step1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Neighborhood</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="text-center mb-0">Where would you love to live?</h4>
                <div class="pt-4">
                    {!! multi_or_single_neighborhood_selector(isset($neigh_filter) ? $neigh_filter : null, null) !!}
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn-default get_started_next_btn" data-toggle="modal" current="need-help-step1" next="need-help-step2">Next</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade need-help-modal" id="need-help-step2">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Bedrooms</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="text-center mb-0">How many bedrooms?</h4>
                <div class="py-4">
                    <div class="form-group" id="advance-search-chkbox">
                        <label class="label">Bedrooms <span>(Select all that applies)</span></label>
                        <ul id="baths">
                            <li>
                                {!! Form::checkbox('beds[]', 'studio', false, ['id' => 'checkbox-111']) !!}
                                <label for="checkbox-111"><span class="label-name">Studio</span></label>
                            </li>
                            <li>
                                {!! Form::checkbox('beds[]', 1, false, ['id' => 'checkbox-112']) !!}
                                <label for="checkbox-112"><span class="label-name">1</span></label>
                            </li>
                            <li>
                                {!! Form::checkbox('beds[]', 2, false, ['id' => 'checkbox-113']) !!}
                                <label for="checkbox-113"><span class="label-name">2</span></label>
                            </li>
                            <li>
                                {!! Form::checkbox('beds[]', 3, false, ['id' => 'checkbox-114']) !!}
                                <label for="checkbox-114"><span class="label-name">3</span></label>
                            </li>
                            <li>
                                {!! Form::checkbox('beds[]', 4, false, ['id' => 'checkbox-115']) !!}
                                <label for="checkbox-115"><span class="label-name">4</span></label>
                            </li>
                            <li>
                                {!! Form::checkbox('beds[]', 5, false, ['id' => 'checkbox-116']) !!}
                                <label for="checkbox-116"><span class="label-name">5+</span></label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step1">Previous</button>
                <button type="button" class="btn-default get_started_next_btn" data-toggle="modal" current="need-help-step2" next="need-help-step3">Next</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade need-help-modal" id="need-help-step3">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Budget</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="text-center mb-0">What is your Budget?</h4>
                <div class="pt-4">
                    {!! Form::text('price', null, ['class' => 'input-style', 'placeholder' => 'Budget']) !!}
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step2">Previous</button>
                <button type="button" class="btn-default budget get_started_next_btn" data-toggle="modal" current="need-help-step3" next="need-help-step4">Next</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade need-help-modal" id="need-help-step4">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Timeline</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="text-center mb-0">When would you like move in?</h4>
                <div class="pt-4">
                    {!! Form::text('move_in_date', null, ['class' => 'input-style', 'placeholder' => 'Move in date', 'data-date-format' => 'yyyy-mm-dd']) !!}
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn-default mr-2" data-dismiss="modal" data-toggle="modal" data-target="#need-help-step3">Previous</button>
                <button type="button" class="btn-default get_started_next_btn" data-toggle="modal" current="need-help-step4" next="need-help-step5">Next</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade need-help-modal" id="need-help-step5">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Timeline</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="text-center mb-0">When would you like move in?</h4>
                <div class="pt-4 row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::text('first_name', null, ['class' => 'input-style', 'placeholder' => 'First Name']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::text('last_name', null, ['class' => 'input-style', 'placeholder' => 'Last Name']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone Number']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::textarea('description', null, ['style' => 'resize:none', 'class' => 'input-style text-area', 'placeholder' => 'Comment']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn-default mr-2" data-dismiss="modal"  data-toggle="modal" data-target="#need-help-step4">Previous</button>
                {!! Form::submit('Send', ['class' => 'btn-default let-us-help-submit', 'style' => 'cursor:pointer;']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
{!! HTML::script('assets/js/get_started.js') !!}
<script>
    enableDatePicker($('input[name=move_in_date]'), false);
</script>
