{!! Form::open(['url' => route('web.letUsHelp'), 'method' => 'post']) !!}
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-help">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form" id="let-us-step1">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">What is your ideal move in date?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4">
                        <div id="multiple" class="article">
                            <div class="multi-select-calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default" data-target="let-us-step2">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step2">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">I can spend over____on rent every month</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::text('priceRange', null, ['class' => 'input-style rent-input-icon']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step1">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step3">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step3">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">How many bedrooms?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', 'studio', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-1']) !!}
                                    <label class="custom-control-label" for="bedrooms-1">Studio</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', '1', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-2']) !!}
                                    <label class="custom-control-label" for="bedrooms-2">1</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', '2', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-3']) !!}
                                    <label class="custom-control-label" for="bedrooms-3">2</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', '3', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-4']) !!}
                                    <label class="custom-control-label" for="bedrooms-4">3</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', '4', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-5']) !!}
                                    <label class="custom-control-label" for="bedrooms-5">4</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('beds[]', '5', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-6']) !!}
                                    <label class="custom-control-label" for="bedrooms-6">5</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step2">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step4">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step4">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">Whats your full name?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::text('username', null, ['class' => 'input-style', 'placeholder' => 'Full Name *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step3">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step5">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step5">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">How can we get in touch?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step4">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step6">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step6">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <h3 class="modal-title">For the fastest response, whats your phone number?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step5">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step7">Next</button>
                </div>
            </div>

            <div class="let-us-hlep-form" id="let-us-step7">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <img src="assets/images/popcorn-icon.jpg" alt="" class="popcorn-icon" />
                        <h3 class="mb-2 text-center">Thanks</h3>
                        <p class="text-center">We can help you even faster if you answer a few question about your search.</p>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    {!! Form::submit('Maybe Later', ['class' => 'btn-default', 'style' => 'cursor:pointer;']) !!}
                    <button class="btn-default ml-3" type="button" data-target="let-us-step8">Okay, let’s do this</button>
                </div>
            </div>

            <div class="let-us-hlep-form" id="let-us-step8">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">Do you have any location preferences?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location-preference', 1, false, ['class' => 'custom-control-input', 'id' => 'location-1']) !!}
                                    <label class="custom-control-label" for="location-1">Finding a Home ( Client )</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location-preference', 2, false, ['class' => 'custom-control-input', 'id' => 'location-2']) !!}
                                    <label class="custom-control-label" for="location-2">I have something very specific i’m looking for...</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location-preference', 3, false, ['class' => 'custom-control-input', 'id' => 'location-3']) !!}
                                    <label class="custom-control-label" for="location-3">No, I’m open to anything</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step9">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step9">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step9">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">Search for neighborhood</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::text('neighborhoods', null, ['class' => 'input-style', 'placeholder' => '+ Search for neighborhood']) !!}
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step10">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step8">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step10">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step10">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">Why are you moving?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move-reason', 1, false, ['class' => 'custom-control-input', 'id' => 'moving-1']) !!}
                                    <label class="custom-control-label" for="moving-1">Lease is up</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move-reason', 2, false, ['class' => 'custom-control-input', 'id' => 'moving-2']) !!}
                                    <label class="custom-control-label" for="moving-2">Moving from out of town</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move-reason', 3, false, ['class' => 'custom-control-input', 'id' => 'moving-3']) !!}
                                    <label class="custom-control-label" for="moving-3">Moving from out of state</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move-reason', 4, false, ['class' => 'custom-control-input', 'id' => 'moving-4']) !!}
                                    <label class="custom-control-label" for="moving-4">need more space</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move-reason', 5, false, ['class' => 'custom-control-input', 'id' => 'moving-5']) !!}
                                    <label class="custom-control-label" for="moving-5">Other...</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step11">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step9">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step11">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step11">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">Do you have any pets?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="catss-1" name="pets">
                                    <label class="custom-control-label" for="catss-1">Cats</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="dogs-01" name="pets">
                                    <label class="custom-control-label" for="dogs-01">Dogs</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="pets-3" name="pets">
                                    <label class="custom-control-label" for="pets-3">Other</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="pets-4" name="pets">
                                    <label class="custom-control-label" for="pets-4">No</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step12">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step10">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step12">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step12">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                    </ul>
                    <h3 class="modal-title">When does your lease end?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease-pay', 1, false, ['class' => 'custom-control-input', 'id' => 'lease-1']) !!}
                                    <label class="custom-control-label" for="lease-1">End of the month</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease-pay', 2, false, ['class' => 'custom-control-input', 'id' => 'lease-2']) !!}
                                    <label class="custom-control-label" for="lease-2">I’m month to month</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease-pay', 3, false, ['class' => 'custom-control-input', 'id' => 'lease-3']) !!}
                                    <label class="custom-control-label" for="lease-3">Choose a specific date...</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step13">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step11">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step13">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step13">
                <!-- Modal Header -->
                <div class="modal-header">
                    <ul class="steps-progress">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <h3 class="modal-title">When does your lease end?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-1" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-1">700+</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-2" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-2">650 - 700</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-3" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-3">600 - 650</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-4" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-4">550 - 600</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-5" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-5">500 - 550</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-6" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-6">below 500</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-7" name="lease-price">
                                    <label class="custom-control-label" for="lease-price-7">No credit score</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step12">Previous</button>
                    {!! Form::submit('Send', ['class' => 'btn-default ml-3', 'style' => 'cursor:pointer;']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}