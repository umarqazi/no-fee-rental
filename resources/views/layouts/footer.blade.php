<footer>
    <div class="container-lg">
        <ul class="footer-wrapper">
            <li class="wow fadeInLeft" data-wow-delay="0.2s">
                <img src="{!! asset('assets/images/footer-logo.png') !!}" alt="" />
                <div class="logo-text">
                    Is the easiest way to search all no fee rentals in one place.
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.3s">
                <h4>Renters </h4>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=49" class="ft-links">Renters Guide</a>
                <a href="#" class="ft-links">Help and Answers</a>
                <a href="#" class="ft-links">Rent Calculator</a>
                <a href="#" class="ft-links">Blog</a>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.4s">
                <h4>Support </h4>
                <a href="{!! route('contact-us') !!}" class="ft-links">Contact Us</a>
                <a href="#" class="ft-links">Site Map</a>
                <a href="#" class="ft-links">Feedback</a>
                <a href="#" class="ft-links">Advertise with Us</a>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.5s">
                <h4>Company </h4>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66" class="ft-links">About Us</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=70" class="ft-links">Press</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=3" class="ft-links">Privacy Policy </a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=27" class="ft-links">Terms</a>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.6s">
                <h4>Newsletter </h4>
                <div class="newsletter">
                    <div class="title">subscribe news letter</div>
                    <p>Enter your email address & get daily newsletter</p>
                    <form method="post" action="javascript:void(0);" class="newsletter-form" id="newsletter-form">
                        @csrf
                        <img src="{{asset('assets/images/ajax-loader.gif')}}" class="ajax-loader" />
                        <input type="email" class="fld" placeholder="Email Address" name="email" />
                        <label id="error" class="error email" for="email"></label>
                        <button type="submit" class="btn-default" id="subscribe">Subscribe</button>
                    </form>
                </div>
            </li>
        </ul>
        <div class="copyright wow fadeIn " data-wow-delay="0.3s">
            <p><img src="{{ asset('assets/images/home-icon.png') }}" /> Fair Housing & Equal Oppurtunity</p>
            <ul class="social-icons">
                <li><a href="#"><img src="{{ asset('assets/images/fb-icon.png') }}" alt="" /></a></li>
                <li><a href="#"><img src="{{ asset('assets/images/twitter-icon.png') }}" alt="" /></a></li>
                <li><a href="#"><img src="{{ asset('assets/images/google-icon.png') }}" alt="" /></a></li>
            </ul>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{--Login Modal--}}
@include('features.login')
{{--SignUp Modal--}}
@include('features.signup')
{!! HTML::script('assets/js/login.js') !!}
