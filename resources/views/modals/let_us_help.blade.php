{!! Form::open(['url' => route('web.letUsHelp'), 'method' => 'post','id'=>'let_us_help']) !!}
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <div id="multiple" class="article">
                            <div class="multi-select-calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn-default next-modal" data-dismiss="modal" data-toggle="modal" data-target="let-us-step2">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step2">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <h3 class="modal-title">I can't spend over</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-3 mb-3 text-center" style="max-width: 100%;">
                         <span id="invest">
                                {!! Form::text('min_price', null, ['class' => 'input-style', 'placeholder' =>
                                '$', 'style' => 'margin:10px 0px; width:100%; text-align:center;
                                font-size:25px;'])
                                !!}</span>
                            <br/>  <h4 style="color: #223971;font-size: 24px; font-weight: 700; text-align:left">on rent
                            every
                            month</h4>

                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default let_us_help_prev_btn" type="button" current="let-us-step2" prev="let-us-step1">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="let-us-step2" next="let-us-step3">Next</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step3">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <div class="form-group" id="advance-search-chkbox">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            <ul id="beds">
                                <li> <input type="checkbox" value="studio" id="bed-Checkbox" name="beds[]">
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
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default let_us_help_prev_btn" type="button" current="let-us-step3" prev="let-us-step2">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" id="bed-btn" type="button"current="let-us-step3" next="let-us-step4">Next</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step4">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
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
                    <div class="pt-3 mb-3">
                        {!! Form::text('username', null, ['class' => 'input-style', 'placeholder' => 'Full Name *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default let_us_help_prev_btn" type="button" current="let-us-step4" prev="let-us-step3">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" id="name-btn" type="button" current="let-us-step4" next="let-us-step5">Next</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step5">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default let_us_help_prev_btn" type="button" current="let-us-step5" prev="let-us-step4">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" id="email-btn" type="button" current="let-us-step5" next="let-us-step6">Next</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step6">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        {!! Form::text('phone_number', null, ['class' => 'input-style', 'placeholder' => 'Phone *']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default let_us_help_prev_btn" type="button" current="let-us-step6" prev="let-us-step5">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" id="phone-btn" type="button" current="let-us-step6" next="let-us-step7">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step7">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pt-3 mb-3">
                        <img src="assets/images/popcorn-icon.jpg" alt="" class="popcorn-icon" />
                        <h3 class="mb-2 text-center" id="thanks-name"></h3>
                        <p class="text-center">We can help you even faster if you answer a few question about your search.</p>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    {!! Form::submit('Maybe Later', ['class' => 'btn-default', 'style' => 'cursor:pointer;']) !!}
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="let-us-step7" next="let-us-step8">Okay, let’s do this</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step8">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location_preference', 1, false, ['class' => 'custom-control-input', 'id' => 'location-1']) !!}
                                    <label class="custom-control-label" for="location-1">Yes, I'm interested in certain neighborhoods...</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location_preference', 2, false, ['class' => 'custom-control-input', 'id' => 'location-2']) !!}
                                    <label class="custom-control-label" for="location-2">I have something very specific i’m looking for...</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('location_preference', 3, false, ['class' => 'custom-control-input', 'id' => 'location-3']) !!}
                                    <label class="custom-control-label" for="location-3">No, I’m open to anything</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3" type="button" id="location-preference-button" >Next</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="location-1-modal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    {!! neighborhood_let_us_help() !!}
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" type="button" current="location-1-modal" prev="let-us-step8">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="location-1-modal" next="let-us-step11">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="location-2-modal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        {!! Form::textarea('location_or_neighborhood', null, ['class' => 'input-style text-area', 'style' => 'resize:none;','placeholder' => 'What are you looking for?']) !!}
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" type="button" current="location-2-modal" prev="let-us-step8">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="location-2-modal" next="let-us-step11">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="location-3-modal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move_reason', 1, false, ['class' => 'custom-control-input', 'id' => 'moving-1']) !!}
                                    <label class="custom-control-label" for="moving-1">Lease is up</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move_reason', 2, false, ['class' => 'custom-control-input', 'id' => 'moving-2']) !!}
                                    <label class="custom-control-label" for="moving-2">Moving from out of town</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move_reason', 3, false, ['class' => 'custom-control-input', 'id' => 'moving-3']) !!}
                                    <label class="custom-control-label" for="moving-3">Moving from out of state</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('move_reason', 4, false, ['class' => 'custom-control-input', 'id' => 'moving-4']) !!}
                                    <label class="custom-control-label" for="moving-4">need more space</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" type="button" current="location-3-modal" prev="let-us-step8">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="location-3-modal" next="let-us-step11">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step11">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cats" name="pets" value="1">
                                    <label class="custom-control-label" for="cats">Cats</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="dogs" name="pets" value="2">
                                    <label class="custom-control-label" for="dogs">Dogs</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="other" name="pets" value="3">
                                    <label class="custom-control-label" for="other">Other</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="no" name="pets" value="4">
                                    <label class="custom-control-label" for="no">No</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn-default skip-btn let_us_help_next_btn" current="let-us-step11" next="let-us-step12">Skip</button>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" id="set-prev" type="button" current="let-us-step11" prev="">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="let-us-step11" next="let-us-step12">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step12">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease_pay', 1, false, ['class' => 'custom-control-input', 'id' => 'lease-1']) !!}
                                    <label class="custom-control-label" for="lease-1">End of the month</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease_pay', 2, false, ['class' => 'custom-control-input', 'id' => 'lease-2']) !!}
                                    <label class="custom-control-label" for="lease-2">I’m month to month</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('lease_pay', 3, false, ['class' => 'custom-control-input', 'id' => 'lease-3']) !!}
                                    <label class="custom-control-label" for="lease-3">Choose a specific date...</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn-default skip-btn let_us_help_next_btn" current="let-us-step12" next="let-us-step13">Skip</button>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" type="button" current="let-us-step12" prev="let-us-step11">Previous</button>
                    <button class="btn-default ml-3 let_us_help_next_btn" type="button" current="let-us-step12" next="let-us-step13">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade need-help-modal let-us-help-modal" id="let-us-step13">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="let-us-hlep-form">
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
                    <div class="pt-3 mb-3">
                        <ul class="bedroom-listing">
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-1" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-1">700+</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-2" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-2">650 - 700</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-3" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-3">600 - 650</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-4" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-4">550 - 600</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-5" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-5">500 - 550</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-6" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-6">below 500</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="lease-price-7" name="lease_price">
                                    <label class="custom-control-label" for="lease-price-7">No credit score</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn-default ml-3 let_us_help_prev_btn" type="button" current="let-us-step13" prev="let-us-step12">Previous</button>
                    {!! Form::submit('Send', ['class' => 'btn-default ml-3', 'style' => 'cursor:pointer;']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
{!! HTML::script('assets/js/let_us_help.js') !!}
<script>
    enableDatePicker($('#lease-3'), false);
</script>
