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
      <h4 class="collapseabe-link">Renters <i class="fas fa-sort-down"></i></h4>
      <div class="collapse-menu">
        <a href="<?php echo get_template_directory_uri(); ?>/?page_id=49" class="ft-links">Renters Guide</a>
        <a href="<?php echo get_template_directory_uri(); ?>/?page_id=68" class="ft-links">Help and Answers</a>
        <a href="<?php echo get_template_directory_uri(); ?>/?page_id=198" class="ft-links">Rent Calculator</a>
        <a href="<?php echo get_template_directory_uri(); ?>/blog" class="ft-links">Blog</a>
      </div>
    </li>
      <li class="wow fadeInLeft" data-wow-delay="0.4s">
                <h4 class="collapseabe-link"> Support <i class="fas fa-sort-down"></i></h4>
                <div class="collapse-menu">
                <a href="{!! route('contact-us') !!}" class="ft-links">Contact Us</a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=185" class="ft-links">Site Map</a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=187" class="ft-links">Feedback</a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=195" class="ft-links">Advertise with Us</a>
                </div>
            </li>
      <li class="wow fadeInLeft" data-wow-delay="0.5s">
                <h4 class="collapseabe-link">Company <i class="fas fa-sort-down"></i></h4>
                <div class="collapse-menu">
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=66" class="ft-links">About Us</a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=70" class="ft-links">Press</a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=3" class="ft-links">Privacy Policy </a>
                <a href="<?php echo get_template_directory_uri(); ?>/?page_id=27" class="ft-links">Terms</a>
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



<?php wp_footer(); ?>

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

<script type="text/javascript">
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
