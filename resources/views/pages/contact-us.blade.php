@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
    <section class="inner-pages contact-us wow fadeIn" data-wow-delay="0.2s">
        <div class="contact-banner"> </div>
        <div class="container-lg">
            <h2 class="text-center"></h2>
            <div class="contact-info">
                <div class="row">
                    <div class="col-lg-4 ">
                        <div class="info">
                            <div class="info-inner">
                                <img src="assets/images/location.png" alt="" />
                                <div class="title"><h6> Sales/Advertising </h6>
                                    <p> Info@nofeerentalsnyc.com </p>
                                    <p>632 Broadway, 6th Floor New York, NY 10012 P 212.753.7702
                                    </p>
                                </div>
                            </div>
                            <div class="description-text">
                            <p>Are you looking for a plan for your brokerage? Are you looking to advertise on our site
                                and want to purchase a plan? Question about different plans? Let our sales team help you!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info">
                            <div class="info-inner">
                                <img src="assets/images/close-envelope-new.png" alt="" />
                                <div class="title"><h6> Support/Billing </h6>
                                    <a href="mailto:marketing@nofeerentals.com">Support@nofeerentalsnyc.com</a>
                                </div>
                            </div>
                            <div class="description-text">
                                <p>Providing Easy-to-Access Customer Support is our top priority! Having problems with your listings? Technical porblems with your account?
                                    Questions about a charge or invoice? Don't worry - our dedicated support and billing team will help you out.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info">
                            <div class="info-inner">
                                <img src="assets/images/call-icon.png" alt="" />
                                <div class="title"><h6> Careers </h6>
                                    <a href="#">Careers@nofeerentalsnyc .com</a>
                                </div>
                            </div>

                            <div class="description-text">
                                <p>We're Hiring...</p>
                                <p>Technical support specialist, IOS Developer, Senior Desing and UX Lead, Database Engineer,
                                    Web Analytics Specialist, Sr. Account Manager and Brand Editorial Intern (Part-time). If you're interested in any of these
                                    positions please reach out to us.</p></div>
                        </div>
                    </div>
                </div>

                <div class="rowmt-5 row">
                    <div class="col-lg-6">
                        <h2 class="text-left">Contact Us</h2>
                        <p> Reach out to us for any enquery</p>
                        {!! Form::open(['url'=>route('contact-us'), 'class'=>'contact-form ajax', 'method'=>'post','reset'=> 'true' ,'id'=>'contact_us_form', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Your Name</label>
                                    {!! Form::text('name', null, ['class'=>'input-style', 'placeholder'=>'Name']) !!}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                     <label> Your Email </label>
                                    {!! Form::text('email', null, ['class'=>'input-style', 'placeholder'=>'Email']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Your Phone Number </label>
                                    {!! Form::text('phone_number', null, ['class'=>'input-style', 'placeholder'=>'Phone Number']) !!}
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Write a Message </label>
                                    {!! Form::textarea('comment', null, ['class'=>'input-style textArea', 'placeholder'=>'Message']) !!}
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class=" text-left contact-page">
                        <button class="btn-default">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                     <div class="col-lg-6 contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3403.3395820921846!2d74.27331331448124!3d31.459843557277523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1569249518976!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


