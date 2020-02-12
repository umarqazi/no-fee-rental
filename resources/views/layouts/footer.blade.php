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
                <h4 class="collapseabe-link">Renters <i class="fas fa-angle-down"></i></h4>
                <div class="collapse-menu">
                    <ul>
                        <li><a href="/blog/renter-guide" class="ft-links">Renters Guide</a></li>
                        <li><a href="/blog/help_and_answers" class="ft-links">Help and Answers</a></li>
                        <li><a href="/blog/rent-calculator" class="ft-links">Rent Calculator</a></li>
                        <li><a href="/blog" class="ft-links">Blog</a></li>
                    </ul>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.4s">
                <h4 class="collapseabe-link"> Support <i class="fas fa-angle-down"></i></h4>
                <div class="collapse-menu">
                    <ul>
                        <li><a href="{{ route('web.contactUs') }}" class="ft-links">Contact Us</a></li>
                        <li><a href="{{ route('web.siteMap') }}" class="ft-links">Site Map</a></li>
                        <li><a href="/blog/feed-back" class="ft-links">Feedback</a></li>
                        <li><a href="{{ route('web.advertise') }}" class="ft-links">Advertise with Us</a></li>
                    </ul>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.5s">
                <h4 class="collapseabe-link">Company <i class="fas fa-angle-down"></i></h4>
                <div class="collapse-menu">
                    <ul>
                        <li><a href="/blog/about-us" class="ft-links">Our Story</a></li>
                        <li><a href="/blog/press" class="ft-links">Press</a></li>
                        <li><a href="/blog/privacy-policy" class="ft-links">Privacy Policy </a></li>
                        <li><a href="/blog/terms" class="ft-links">Terms</a></li>
                    </ul>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.6s">
                <h4>Newsletter </h4>
                <div class="newsletter">
                    <div class="title">subscribe news letter</div>
                    <p>Enter your email address & get daily newsletter</p>
                    {!! Form::open([
                        'url' => route('web.newsletter'),
                        'id' => 'newsletter-form',
                        'class' => 'newsletter-form ajax',
                        'reset' => 'true',
                        'method' => 'post'])
                    !!}
                    {!! Form::text('email', null, ['class' => 'fld', 'placeholder' => 'Email Address', 'autocomplete' => 'off']) !!}
                    {!! Form::submit('Subscribe', ['class' => 'btn-default']) !!}
                    {!! Form::close() !!}
                </div>
            </li>
        </ul>
        <div class="copyright wow fadeIn " data-wow-delay="0.3s">
            <p><img src="{{ Storage::url('assets/images/home-icon.png') }}" /> Fair Housing & Equal Opportunity</p>
            <ul class="social-icons">
                <li>
                    <a href="#"><img src="{{ Storage::url('assets/images/fb-icon.png') }}" alt="" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ Storage::url('assets/images/twitter-icon.png') }}" alt="" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ Storage::url('assets/images/google-icon.png') }}" alt="" /></a>
                </li>
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
@include('modals.login')
{{--SignUp Modal--}}
@include('modals.signup')
{!! HTML::script('assets/js/login.js') !!}
<script type="text/javascript">
    function togglefooterlink() {
        if (window.matchMedia('(max-width: 1279px)').matches) {
            $(".collapseabe-link").click(function() {
                $(this).parent().find('.collapse-menu').slideToggle();
            });
        }
    }
    togglefooterlink();
</script>
