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
                <h4 class="collapseabe-link">Renters <i class="fas fa-sort-down"></i></h4>
                <div class="collapse-menu">
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=49" class="ft-links">Renters Guide</a>
                <a href="http://no-fee-rental.teamtechverx.com//blog/?page_id=68" class="ft-links">Help and Answers</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=198" class="ft-links">Rent Calculator</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog" class="ft-links">Blog</a>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.4s">
                <h4 class="collapseabe-link"> Support <i class="fas fa-sort-down"></i></h4>
                <div class="collapse-menu">
                <a href="{!! route('contact-us') !!}" class="ft-links">Contact Us</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=185" class="ft-links">Site Map</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=187" class="ft-links">Feedback</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=195" class="ft-links">Advertise with Us</a>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.5s">
                <h4 class="collapseabe-link">Company <i class="fas fa-sort-down"></i></h4>
                <div class="collapse-menu">
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66" class="ft-links">About Us</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=70" class="ft-links">Press</a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=3" class="ft-links">Privacy Policy </a>
                <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=27" class="ft-links">Terms</a>
                </div>
            </li>
            <li class="wow fadeInLeft" data-wow-delay="0.6s">
                <h4>Newsletter </h4>
                <div class="newsletter">
                    <div class="title">subscribe news letter</div>
                    <p>Enter your email address & get daily newsletter</p>
                    {!! Form::open(['url' => route('newsLetter-subscription'), 'id' => 'newsletter-form', 'class' => 'newsletter-form ajax', 'reset' => 'true', 'method' => 'post']) !!}
                    {!! Form::text('email', null, ['class' => 'fld', 'placeholder' => 'Email Address']) !!}
                    <label id="error" class="error email" for="email"></label>
                    {!! Form::submit('Subscribe', ['class' => 'btn-default']) !!}
                    {!! Form::close() !!}
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
@include('modals.login')
{{--SignUp Modal--}}
@include('modals.signup')

{!! HTML::script('assets/js/login.js') !!}
<script type="text/javascript">
    function togglefooterlink() {
        if (window.matchMedia('(max-width: 1279px)').matches) {
            $(".collapseabe-link").click(function(){
                $(this).parent().find('.collapse-menu').slideToggle();
            });
        }
    }
    togglefooterlink();
</script>
