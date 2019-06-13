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
        <h4>Renters </h4>
        <a href="#" class="ft-links">Renters Guide</a>
        <a href="#" class="ft-links">Help and Answers</a>
        <a href="#" class="ft-links">Rent Calculator</a>
        <a href="#" class="ft-links">Blog</a>
      </li>
      <li class="wow fadeInLeft" data-wow-delay="0.4s">
        <h4>Support </h4>
        <a href="#" class="ft-links">Contact Us</a>
        <a href="#" class="ft-links">Site Map</a>
        <a href="#" class="ft-links">Feedback</a>
        <a href="#" class="ft-links">Advertise with Us</a>
      </li>
      <li class="wow fadeInLeft" data-wow-delay="0.5s">
        <h4>Company </h4>
        <a href="#" class="ft-links">About Us</a>
        <a href="#" class="ft-links">Press</a>
        <a href="#" class="ft-links">Privacy Policy </a>
        <a href="#" class="ft-links">Terms</a>
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

</body>
</html>
