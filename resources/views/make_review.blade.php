@extends('layouts.app')
@section('title', 'No Fee Rental | Make Review')
@section('content')
    <section class=" press-section wow fadeIn featured-properties neighborhood-search agent-listing-profile"
             data-wow-delay="0.2s">
                <div class="profile-contact-section profile-section-padding">
                    <div class="container-lg">
                        <h3>Leave a review </h3>
                        {!! Form::open(['url' => route('web.createReview') , 'method' => 'post', 'class' => 'ajax', 'reset' => 'true']) !!}

                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                          <br>
                        <input name = "ReviewToken" type="hidden" value="{{$token}}">
                        <input name = "rating" type="hidden" value="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    {!! Form::text('name', null, ['class' => 'input-style','placeholder' => 'Write your name']) !!}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Your Email</label>
                                        {!! Form::text('email', null, ['class'=>'input-style','placeholder' => 'Write your name']) !!}
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Write a review here </label>
                                    {!! Form::textarea('review', null, ['class'=>'input-style', 'placeholder' => 'Write your review here','style' => 'resize:none; height:131px;']) !!}
                                    @if ($errors->has('review'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('review') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="btn-default"> Submit</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>



    </section>




@endsection
