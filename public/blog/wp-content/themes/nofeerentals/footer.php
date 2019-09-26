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
          <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=66" class="ft-links">About Us</a>
          <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=70" class="ft-links">Press</a>
          <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=3" class="ft-links">Privacy Policy </a>
          <a href="http://no-fee-rental.teamtechverx.com/blog/?page_id=27" class="ft-links">Terms</a>
          </div>
      </li>
    <li class="wow fadeInLeft" data-wow-delay="0.6s" >
                <h4>Newsletter </h4>
                <div class="newsletter">
                    <div class="title">subscribe news letter</div>
                    <p>Enter your email address &amp; get daily newsletter</p>
                    <form method="POST" action="http://no-fee-rental.teamtechverx.com/newsletter-subscribe" accept-charset="UTF-8" id="newsletter-form" class="newsletter-form ajax" reset="true"><input name="_token" type="hidden" value="0d93UMDvS4Sjfmoa9Lt7jJutbJVYodaQG0jcrRSF">
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


<!-- Login Modal -->
    <div class="modal fade login-modal" id="login">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        
        <div class="modal-content">
            <img src="<?php bloginfo('template_url')?>/assets/images/modal-close-icon.png" alt="" class="close-modal close-signup-modal" data-dismiss="modal">
            <div class="logo-info-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/modal-logo.png" alt="" class="logo">
                <h3>Login</h3>
                <ul>
                    <li>Save your searches</li>
                    <li>Save your favorite listings</li>
                    <li>Get email notifications for new listings in neighborhoods that you like Access to showing on demand</li>
                </ul>
            </div>
            <div class="login-form-wrapper">
                <div class="login-heading">
                    Login
                </div>
                <form method="POST" action="http://no-fee-rental.teamtechverx.com/login" accept-charset="UTF-8" id="login_form" class="ajax" novalidate="novalidate"><input name="_token" type="hidden" value="wgtYrzIjKZeqRuv67Xf1mCwnwFUW8JlmJKzf0lre">
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
                            <button type="submit" class="btn-default">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
                </form>
                <p class="footer-text">Don’t have an account? <span class="signup-modal-btn"  id="signup-btn">Signup</span></p>
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
                <h3>Create Account</h3>
                <ul>
                    <li>Save your searches</li>
                    <li>Save your favorite listings</li>
                    <li>Get email notifications for new listings in neighborhoods that you like Access to showing on demand</li>
                </ul>
            </div>

            <div class="login-form-wrapper">
                <div class="login-heading">
                    Signup
                </div>
                <form method="POST" action="http://no-fee-rental.teamtechverx.com/user-signup" accept-charset="UTF-8" class="ajax" reset="true" id="signup_form" novalidate="novalidate"><input name="_token" type="hidden" value="wgtYrzIjKZeqRuv67Xf1mCwnwFUW8JlmJKzf0lre">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="3" class="custom-control-input" id="signup-option1" name="user_type">
                                <label class="custom-control-label" for="signup-option1">Finding a Home ( Client )</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                                <label class="custom-control-label" for="signup-option2">Finding a Home ( Agent )</label>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="input-style agnet-input" id="email" placeholder="Email" name="email" type="text">
                                <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX, Nestio or OLR account.</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-12" id="phone_number">
                            <div class="form-group">
                                <input class="input-style agnet-input" placeholder="Phone Number" name="phone_number" type="text">
                            </div>
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
                    
                    <div class="col-md-12">
                        <div class="text-center mt-3 mb-4">
                            <input class="btn-default" type="submit" value="Signup">
                        </div>
                    </div>
                
                <p class="footer-text">Already have an account? <span class="signin-wrapper" id="login-btn">Login</span></p>
            </div></form>
        </div>
    </div>
</div>



<?php wp_footer(); ?>



<script>
  $( document ).ready(function() {
    $(".menu-btn").click(function () {
      $(".mobile-menu").slideDown();
    });

    $(".close-menu-btn").click(function () {
      $(".mobile-menu").slideUp();
    });
  });




</script>



</body>
</html>
