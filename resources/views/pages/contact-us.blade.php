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
                            <img src="assets/images/map-icon.png" alt="" />
                            <div class="title"><h6> Manhattan </h6>
                            <p>632 Broadway, 6th Floor New York, NY 10012 P 212.753.7702
                            </p></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info">
                            <img src="assets/images/email-icon.png" alt="" />
                            <div class="title"><h6> Marketing </h6>
                                <a href="mailto:marketing@nofeerentals.com">marketing@nofeerentals.com</a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info">
                            <img src="assets/images/careers-icon.png" alt="" />
                            <div class="title"><h6> Careers </h6>
                                <a href="#">careers@nofeerentals.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rowmt-5 row">
                    <div class="col-lg-6">
                        <h2 class="text-left">Contact Us</h2>
                        <p> Reach out to us for any enquery</p>
                        {!! Form::open(['url'=>route('contact-us'), 'class'=>'contact-form', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Your Name</label>
                                    {!! Form::text('first_name', null, ['class'=>'input-style', 'placeholder'=>'First Name']) !!}
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
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
                                    <label>Write a Message </label>
                                    {!! Form::textarea('comment', null, ['class'=>'input-style textArea', 'placeholder'=>'Comment']) !!}
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


<div class="container-lg">
<h3 class="text-center privacy-heading">About Us</h3>
<div class="press-row text-center">

"excellence is never an accident;  it is the result of high intention, since effort, intelligent direction, skillful execution and the vision to see the obstacles as opportunities."

</div>
<div class="press-row text-center">

No Fee Rental is a leading real estate brokerage firm with a mission to provide professional, top quality service to our clients. Our proven success is a true reflection of our dedication and clarity in vision towards our work keeping clients in mind.

</div>
</div>
<div class="after-terms-section sec-padding-p-after">
<div class="container-lg">
<div class="row">
<div class="col-lg-6 p-after-policy-section">
<h3></h3>
As a full service brokerage firm and with a vast reach and a dedicated team full of competency in technological and management training, market research, and transactional resources, we deliver unparalleled performance to provide an exceptional experience by building trusted relationships. We have vast knowledge of local neighborhoods and real estate market conditions. We are purely dedicated to guiding our clients to achieve their investment goals in the real estate market. We associate with agents who are passionate, knowledgeable and focused about their work and results.

</div>
<div class="col-lg-6">
<div class="after-terms-right-sec">
<h3>What is No Fee Rental ?</h3>
<ul>
    <li><span class="img-icon"><img src="http://no-fee-rental.teamtechverx.com/blog/wp-content/uploads/2019/09/check.png" alt="checkout" /> </span>
<label> No Fee Rental specializes in the buying, selling, and renting process and has created a network </label></li>
    <li><span class="img-icon"><img src="http://no-fee-rental.teamtechverx.com/blog/wp-content/uploads/2019/09/check.png" alt="checkout" /> </span>
<label>As a full service brokerage firm and with a vast reach and a dedicated </label></li>
    <li><img src="http://no-fee-rental.teamtechverx.com/blog/wp-content/uploads/2019/09/check.png" alt="checkout" />
<label> We have vast knowledge of local neighborhoods and real estate market conditions.</label></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="container-lg">
<div class="login-info sec-padding-p-after">
<div class="row">

<div class="col-lg-6">
<h3 class="text-center">Why Choose Us</h3>
No Fee Rental specializes in the buying, selling, and renting process and has created a network that brings a world-class intelligence and profound local expertise to each client. We offer assistance for each and every step through buying, selling, and renting by applying strategic advancements while using our unique expertise. By offering a complete sphere of real estate services, we ensure to meet your every requirement. We take pride in our services and also in the fact that clients return to us again and again with a healthy and satisfied smile on their faces.

The real estate business is very volatile and many of us have experienced the highs and lows for property values. Unlike traditional brokerages, we believe in delivering highest level of professional brokerage services to our clients and customers through the use of creative technologies, advancements and most knowledgeable agents in the real estate industry. We know you don't have your whole life to look for your dream home or property that is why No Fee Rental brings you the best price and terms.


<div class="clearfix"></div>
</div>
</div>
</div>
</div>