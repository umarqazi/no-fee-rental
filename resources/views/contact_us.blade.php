@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
    <section class="neighborhood-search neighbourhood-pd contact-us wow fadeIn" data-wow-delay="0.2s">
                <div class="blog-banner-img-wrapper">
                    <h4 class="blog-banner-text">Contact Us</h4>
            <div class="contact-banner"> </div>
        </div>
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
                                    positions please reach out to us.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rowmt-5 row">
                    <div class="col-lg-6">
                        <h2 class="text-left">Contact Us</h2>
                        <p> Reach out to us for any enquery</p>
                        {!! Form::open([
                            'url' => route('web.sendRequest'),
                            'class' => 'contact-form ajax',
                            'method' => 'post',
                            'reset' => 'true',
                            'id' => 'contact_us_form']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Your Name</label>
                                    {!! Form::text('username', null, ['class'=>'input-style', 'placeholder'=>'Name']) !!}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('username') !!}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <label> Your Email </label>
                                    {!! Form::text('email', null, ['class'=>'input-style', 'placeholder'=>'Email']) !!}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Your Phone Number </label>
                                    {!! Form::text('phone_number', null, ['class'=>'input-style', 'placeholder'=>'Phone Number']) !!}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('phone_number') !!}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Write a Message </label>
                                    {!! Form::textarea('message', null, ['class'=>'input-style textArea', 'placeholder'=>'Message']) !!}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('message') !!}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class=" text-left contact-page">
                            {!! Form::button('Submit', ['class' => 'btn-default', 'type' => 'submit']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                     <div class="col-lg-6 contact-map">
                        <div id="map"></div>
                             <div class="adress-text">
                                 <p class="description-text">NOFEERENTALSNYC.COM 447 BROADWAY 2nd FL #453 New York, NY 10013
                                 </p>
                             </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
    {!! HTML::script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js') !!}
    <script>
        setMap('map', { latitude: 41.552830, longitude: -73.968850 }, true, true, '<p>447 BROADWAY 2nd FL #453 New York, NY 10013</p>', 15);
    </script>
@endsection


