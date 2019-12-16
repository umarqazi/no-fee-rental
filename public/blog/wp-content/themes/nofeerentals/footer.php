<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nofeerentals
 */

?>

    <footer>
        <div class="container-lg">
            <ul class="footer-wrapper">
                <li class="wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png" alt="" />
                    <div class="logo-text">
                        Is the easiest way to search all no fee rentals in one place.
                    </div>
                </li>
                <li class="wow fadeInLeft" data-wow-delay="0.3s">
                    <h4 class="collapseabe-link">Renters <i class="fas fa-angle-down"></i></h4>
                    <div class="collapse-menu">
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=49" class="ft-links">Renters Guide</a>
                        <a href="http://no-fee-rental.teamtechverx.com//blog/?page_id=68" class="ft-links">Help and Answers</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=233" class="ft-links">Rent Calculator</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog" class="ft-links">Blog</a>
                    </div>
                </li>
                <li class="wow fadeInLeft" data-wow-delay="0.4s">
                    <h4 class="collapseabe-link"> Support <i class="fas fa-angle-down"></i></h4>
                    <div class="collapse-menu">
                        <a href="http://no-fee-rental.teamtechverx.com/contact-us" class="ft-links">Contact Us</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=185" class="ft-links">Site Map</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=187" class="ft-links">Feedback</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=195" class="ft-links">Advertise with Us</a>
                    </div>
                </li>
                <li class="wow fadeInLeft" data-wow-delay="0.5s">
                    <h4 class="collapseabe-link">Company <i class="fas fa-angle-down"></i></h4>
                    <div class="collapse-menu">
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66" class="ft-links">Our Story</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=70" class="ft-links">Press</a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=3" class="ft-links">Privacy Policy </a>
                        <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=27" class="ft-links">Terms</a>
                    </div>
                </li>
                <li class="wow fadeInLeft" data-wow-delay="0.6s">
                    <h4>Newsletter </h4>
                    <div class="newsletter">
                        <div class="title">subscribe news letter</div>
                        <p>Enter your email address &amp; get daily newsletter</p>
                        <form method="POST" action="http://no-fee-rental.teamtechverx.com/api/newsletter-subscribe" accept-charset="UTF-8" id="newsletter-form" class="newsletter-form ajax" reset="true">
                            <input name="_token" type="hidden" value="0d93UMDvS4Sjfmoa9Lt7jJutbJVYodaQG0jcrRSF">
                            <input class="fld" placeholder="Email Address" name="email" type="text">
                            <label id="error" class="error email" for="email"></label>
                            <input class="btn-default" type="submit" value="Subscribe">
                        </form>
                    </div>
                </li>
            </ul>
            <div class="copyright wow fadeIn " data-wow-delay="0.3s">
                <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-icon.png" /> Fair Housing & Equal Oppurtunity</p>
                <ul class="social-icons">
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/fb-icon.png" alt="" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-icon.png" alt="" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-icon.png" alt="" /></a></li>
                </ul>
            </div>
        </div>
    </footer>


<?php wp_footer(); ?>

<div class="loader">
    <div class="loader-wrap"> </div>
    <div class="main-loader"></div>
</div>

<!-- Login Modal -->
    <div class="modal fade login-modal" id="login">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">

            <div class="modal-content">
                <img src="<?php bloginfo('template_url')?>/assets/images/modal-close-icon.png" alt="" class="close-modal close-signup-modal" data-dismiss="modal">
                <div class="logo-info-wrapper">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/modal-logo.png" alt="" class="logo">
                    <h3>Login</h3>
                    <ul>
                        <li>Save Your Searches</li>
                        <li>Never Pay A Broker Fee</li>
                        <li>Save Your Favorite Listings</li>
                        <li>Get Email Notifications For New Listings In Neighborhoods That You Like</li>
                    </ul>
                </div>
                <div class="login-form-wrapper">
                    <div class="login-heading login-after-line">
                        Login
                    </div>
                    <form method="POST" action="javascript:void(0);" accept-charset="UTF-8" id="login_form">
                        <input name="_token" type="hidden" value="wgtYrzIjKZeqRuv67Xf1mCwnwFUW8JlmJKzf0lre">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="input-style" placeholder="Email" name="email" type="email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="input-style" placeholder="Password" name="password" type="password" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="form-check col-lg-6 col-sm-6">
                                <div style="margin-left: 15px;">
                                    <input class="form-check-input" name="remember" type="checkbox">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 forgot-pass">
                                <a href="http://no-fee-rental.teamtechverx.com/forgot-password">Forgot Password.</a>
                            </div>

                            <div class="col-md-12">
                                <div class="text-center mt-5 mb-4">
                                    <input type="submit" class="btn-default" name="login">
                                        Login
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="footer-text">Don’t have an account? <span class="signup-modal-btn" id="signup-btn">Signup</span></p>
                </div>

            </div>
        </div>
    </div>

    <!-- Sign up -->

    <div class="modal fade login-modal show" id="signup">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">

            <div class="modal-content">
                <img src="<?php bloginfo('template_url')?>/assets/images/modal-close-icon.png" alt="" class="close-modal close-signup-modal" data-dismiss="modal">
                <div class="logo-info-wrapper">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/modal-logo.png" alt="" class="logo">

                    <ul class="create-client-listing">
<!--                        <h3>Let's started</h3>-->
                        <li>Save Your Searches</li>
                        <li>Mark Your Favorite Listings</li>
                        <li>Get Email Notification For New Listings In Neighborhoods That You Like</li>
                        <li>Access To Showing On Demand</li>
                        <li>Access To Our Neighborhood Specialists</li>
                        <h1 style="color: white;font-size: 16px; font-weight: 600; line-height: normal;">And much more
                            features!!</h1>
                    </ul>
                    <ul class="create-agent-listing">
                        <h3>join us</h3>
                        <li>Publish your listing</li>
                        <li>Syndicate Listing From Various Marketplaces</li>
                        <li>Unlimited Renting Potential To Thousand Of Renters</li>
                        <li>Access To Showing On Demand Clients</li>
                        <li> Access To Our Direct Clientele Through Neighborhood Specialists Program</li>
                        <h1 style="color:white; font-size: 16px; line-height: normal;font-weight: 600;">Info: We are NO
                            FEE
                            website
                            and any apartment deemed
                            as a fee untill will not be activated.</h1>
                    </ul>
                </div>

                <div class="login-form-wrapper">
                    <div class="login-heading">
                        CREATE ACCOUNT
                    </div>
                    <form method="POST" action="http://no-fee-rental.teamtechverx.com/api/user-signup" accept-charset="UTF-8" class="ajax" reset="true" id="signup_form" novalidate="novalidate">
                        <input name="_token" type="hidden" value="wgtYrzIjKZeqRuv67Xf1mCwnwFUW8JlmJKzf0lre">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="3" class="custom-control-input" id="signup-option1" name="user_type">
                                    <label class="custom-control-label" for="signup-option1">Find a Home ( Client )</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                                    <label class="custom-control-label" for="signup-option2">List With Us ( Agent )</label>
                                </div>
                                <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            </div>
                            <div class="col-sm-12 ">
                                <div class="row align-items-center license_num">
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input class="input-style" placeholder="License Number" name="license_number" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="license_valid-text">You must have a valid license to join No FEE Rentals NYC</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="input-style agnet-input" placeholder="First Name" name="first_name" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="input-style agnet-input" placeholder="Last Name" name="last_name" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="input-style agnet-input" id="email" placeholder="Email" name="email" type="text">

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="input-style agnet-input" placeholder="Phone Number" name="phone_number" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                    <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX..</p>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <i class="fa fa-eye"></i>
                                    <input class="input-style agnet-input" placeholder="Password" id="password" name="password" type="password" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group eye-form">
                                    <i class="fa fa-eye"></i>
                                    <input class="input-style agnet-input" placeholder="Confirm Password" name="password_confirmation" type="password" value="">
                                </div>
                            </div>
                        </div>

                    <div class="col-md-12 submit-clm">
                        <div class="text-center mt-3 mb-4">
                            <input class="btn-default" type="submit" value="Signup">
                        </div>
                    </div>

                <p class="footer-text">Already have an account? <span class="signin-wrapper" id="login-btn">Login</span></p>
            </div></form>
        </div>
    </div>
</div>


<script src="http://no-fee-rental.teamtechverx.com/assets/js/vendor/jquery.validate.min.js"></script>

<?php wp_footer(); ?>

    <script >
        $( document ).ready(function() {

        $(".menu-btn").click(function () {
          $(".mobile-menu").slideDown();
        });

        $(".close-menu-btn").click(function () {
          $(".mobile-menu").slideUp();
        });

      });

    </script>
<?php
    if(isset($_POST['login'])) {
        $credentials = [
            'email'    => $_POST['email'],
            'password' => $_POST['password']
        ];

        authenticate($credentials);
    }
?>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/vendor/toastr.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/signup.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/login.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/recent-search.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/global.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/validate.js"></script>
 </body>

</html>
