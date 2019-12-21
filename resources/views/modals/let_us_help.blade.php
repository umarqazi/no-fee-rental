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
                        {!! Form::text('priceRange', null, ['class' => 'input-style']) !!}
                    </div>
                    <p id="price-err"style="color:red; display: none">Rent is required.</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step1">Previous</button>
                    <button class="btn-default ml-3" id="price-btn" type="button" data-target="let-us-step3" >Next</button>
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
{{--                        <ul class="bedroom-listing">--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', 'studio', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-1']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-1">Studio</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', '1', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-2']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-2">1</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', '2', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-3']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-3">2</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', '3', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-4']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-4">3</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', '4', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-5']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-5">4</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    {!! Form::checkbox('beds[]', '5', null, ['class' => 'custom-control-input', 'id' => 'bedrooms-6']) !!}--}}
{{--                                    <label class="custom-control-label" for="bedrooms-6">5</label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <div class="form-group" id="advance-search-chkbox">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            <ul id="beds">
                                <li> <input type="checkbox" value="studio" id="bed-Checkbox" name="Checkbox">
                                    <label for="bed-Checkbox"><span class="label-name">Studio</span></label>
                                </li>
                                <li> <input type="checkbox" value="1" id="bed-Checkbox-1" name="beds[]">
                                    <label for="bed-Checkbox-1"><span class="label-name">1</span></label>
                                </li>
                                <li> <input type="checkbox" value="2" id="bed-Checkbox-2" name="beds[]">
                                    <label for="bed-Checkbox-2"><span class="label-name">2</span></label>
                                </li>
                                <li> <input type="checkbox" value="3" id="bed-Checkbox-3" name="beds[]">
                                    <label for="bed-Checkbox-3"><span class="label-name">3</span></label>
                                </li>
                                <li> <input type="checkbox" value="4" id="bed-Checkbox-4" name="beds[]">
                                    <label for="bed-Checkbox-4"><span class="label-name">4</span></label>
                                </li>
                                <li> <input type="checkbox" value="5" id="bed-Checkbox-5" name="beds[]">
                                    <label for="bed-Checkbox-5"><span class="label-name">5+</span></label>
                                </li>
                            </ul>
                        </div>
                        <p id="bed-err"style="color:red; display: none">Bedroom is required.</p>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step2">Previous</button>
                    <button class="btn-default ml-3" id="bed-btn" type="button" data-target="let-us-step4">Next</button>
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
                    <p id="name-err"style="color:red; display: none">Name is required.</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step3">Previous</button>
                    <button class="btn-default ml-3" id="name-btn" type="button" data-target="let-us-step5">Next</button>
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
                        {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email *','id'=>'let-us-help-email']) !!}
                    </div>
                    <p id="email-err"style="color:red; display: none">Email is required.</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step4">Previous</button>
                    <button class="btn-default ml-3" id="email-btn" type="button" data-target="let-us-step6">Next</button>
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
                        {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone *','id'=>'let-us-us-help-phone_number']) !!}
                    </div>
                    <p id="phone-err"style="color:red; display: none">Phone Number is required.</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default" type="button" data-target="let-us-step5">Previous</button>
                    <button class="btn-default ml-3" id="phone-btn" type="button" data-target="let-us-step7">Next</button>
                </div>
            </div>

            <div class="let-us-hlep-form" id="let-us-step7">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        <img src="assets/images/popcorn-icon.jpg" alt="" class="popcorn-icon" />
                        <h3 class="mb-2 text-center">Thanks {{authenticated() ? mySelf()->first_name : ''}}</h3>
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
                                    {!! Form::radio('location-preference', 1, false, ['class' => 'custom-control-input', 'id' => 'location-1','onclick'=>'openSpecificModal(this)']) !!}
                                    <label class="custom-control-label" for="location-1">Yes, I'm interested in certain neighborhoods...</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location-preference', 2, false, ['class' => 'custom-control-input', 'id' => 'location-2','onclick'=>'openSpecificModal(this)']) !!}
                                    <label class="custom-control-label" for="location-2">I have something very specific i’m looking for...</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location-preference', 3, false, ['class' => 'custom-control-input', 'id' => 'location-3','onclick'=>'openSpecificModal(this)']) !!}
                                    <label class="custom-control-label" for="location-3">No, I’m open to anything</label>
                                </div>
                            </li>
                            <p id="location-preference-err"style="color:red; display: none">Location Preference is required.</p>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" id="location-preference-button" >Next</button>
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
                    <h3 class="modal-title">Do you have any location / neighborhood preferences?</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {{--{!! Form::text('neighborhood', null, ['class' => 'input-style', 'placeholder' => '+ Search for neighborhood']) !!}--}}
                        {!! Form::textarea('location_or_neighborhood', null, ['class' => 'input-style text-area', 'style' => 'resize:none;','placeholder' => 'What are you looking for?']) !!}
                    </div>
                    <div class="text-center"><button type="button" class="btn-default skip-btn" data-target="let-us-step10">Skip</button></div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" data-target="let-us-step8">Previous</button>
                    <button class="btn-default ml-3" type="button" data-target="let-us-step10">Next</button>
                </div>

            </div>

            <div class="let-us-hlep-form" id="let-us-step14">
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
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-4 -b-4">
                        {!! Form::text('neighborhood', null, ['class' => 'input-style', 'placeholder' => '+ Search for neighborhood']) !!}
                    </div>

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#tab-1">All <span>308</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#tab-2">Selected <span>4</span></a>
                        </li>
                        <span class="deselect">Deselect All</span>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1">
                            <ul class="neighborhood-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cities-1" name="cities">
                                        <label class="custom-control-label" for="cities-1">2</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
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
                    <button class="btn-default ml-3" type="button" data-target="let-us-step8">Previous</button>
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
                    <h3 class="modal-title">What is your credit score?</h3>
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
<script>
    enableDatePicker($('#lease-3'), false);
    $('#datepickers-container').css('z-index','10000');
    $('input[name=priceRange]:last').on('input', function () {
        if ($('input[name=priceRange]:last').val() !== '') {
            $('#price-err').css({'display': 'none'});
            $('#price-btn').prop('disabled', false);
        }
    });
    $('#price-btn').on('click', function () {
        if ($('input[name=priceRange]:last').val() == '') {
            setTimeout(() => {
                $('#let-us-step2').show();
                $('#let-us-step3').hide();
            }, 5);
            $('#price-err').css({'display': 'block'});
            $('#price-btn').prop('disabled', true);
        }
    });

    $('#let-us-step3 > .modal-body > .pt-4 > .form-group > ul#beds >li > input[name="beds[]"]').on('change', function () {
        if ($('#let-us-step3 > .modal-body > .pt-4 > .form-group > ul#beds >li > input[name="beds[]"]').is(':checked')) {
            $('#bed-err').css({'display': 'none'});
            $('#bed-btn').prop('disabled', false);
        }
    });
    $('#bed-btn').on('click', function () {
        if (!$('#let-us-step3 > .modal-body > .pt-4 > .form-group > ul#beds >li > input[name="beds[]"]').is(':checked')) {
            setTimeout(() => {
                $('#let-us-step3').show();
                $('#let-us-step4').hide();
            }, 5);
            $('#bed-err').css({'display': 'block'});
            $('#bed-btn').prop('disabled', true);
        }
    });

    $('input[name=username]').on('input', function () {
        if ($('input[name=username]').val() !== '') {
            $('#name-err').css({'display': 'none'});
            $('#name-btn').prop('disabled', false);
        }
    });
    $('#name-btn').on('click', function () {
        if ($('input[name=username]').val() == '') {
            setTimeout(() => {
                $('#let-us-step4').show();
                $('#let-us-step5').hide();
            }, 5);
            $('#name-err').css({'display': 'block'});
            $('#name-btn').prop('disabled', true);
        }
    });

    $('#let-us-help-email').on('change', function () {
        if ($('#let-us-help-email').val() !== '') {
            $('#email-err').css({'display': 'none'});
            $('#email-btn').prop('disabled', false);
        }
    });
    $('#email-btn').on('click', function () {
        if ($('#let-us-help-email').val() == '') {
            setTimeout(() => {
                $('#let-us-step5').show();
                $('#let-us-step6').hide();
            }, 5);
            $('#email-err').css({'display': 'block'});
            $('#email-btn').prop('disabled', true);
        }
    });
    $('#let-us-us-help-phone_number').on('input', function () {
        if ($('#let-us-us-help-phone_number').val() !== '') {
            $('#phone-err').css({'display': 'none'});
            $('#phone-btn').prop('disabled', false);
        }
    });
    $('#phone-btn').on('click', function () {
        if ($('#let-us-us-help-phone_number').val() == '') {
            setTimeout(() => {
                $('#let-us-step6').show();
                $('#let-us-step7').hide();
            }, 5);
            $('#phone-err').css({'display': 'block'});
            $('#phone-btn').prop('disabled', true);
        }
    });
    function openSpecificModal($this){
      if($($this).attr('id') == 'location-1'){
          $('#location-preference-button').attr('data-target','let-us-step14');
      }
      if($($this).attr('id') == 'location-2'){
          $('#location-preference-button').attr('data-target','let-us-step9');
      }
      if($($this).attr('id') == 'location-3'){
          $('#location-preference-button').attr('data-target','let-us-step10');
      }
    }

    $('input[name="location-preference"]').on('change', function () {
        if ($('input[name="location-preference"]').is(':checked')) {
            $('#location-preference-err').css({'display': 'none'});
            $('#location-preference-button').prop('disabled', false);
        }
    });

    $('body').on('click', '#location-preference-button', function (e) {

        if (!$('input[name="location-preference"]').is(':checked')) {
            setTimeout(() => {
                $('#let-us-step8').show();
            }, 5);
            $('#location-preference-err').css({'display': 'block'});
            $('#location-preference-button').prop('disabled', true);
        }

    if ($(this).attr('data-target') == 'let-us-step14') {
               setTimeout(() => {
            $('#let-us-step14').show();
            $('#let-us-step8').hide();
        }, 5);
               setTimeout(() => {
            $('#let-us-step9').hide();
            $('#let-us-step10').hide()
        }, 10);
        }

    if ($(this).attr('data-target') == 'let-us-step9') {
        setTimeout(() => {
            $('#let-us-step9').show();
            $('#let-us-step8').hide();
        }, 5);
        setTimeout(() => {
            $('#let-us-step10').hide();
            $('#let-us-step14').hide();
        }, 10);
        }

    if ($(this).attr('data-target') == 'let-us-step10') {
        setTimeout(() => {
            $('#let-us-step10').show();
            $('#let-us-step8').hide();
        }, 5);
        setTimeout(() => {
            $('#let-us-step9').hide();
            $('#let-us-step14').hide();
        }, 10);
        }

    });
</script>
