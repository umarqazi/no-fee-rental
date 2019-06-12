<?php
  /**
   * The header for our theme
   *
   * This is the template that displays all of the <head> section and everything up until <div id="content">
   *
   * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
   *
   * @package nofeerentals
   */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>

  <div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="user-avtar">
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/agent-img.jpg" alt="" class="avtar" /> Jhone Doe <i class="fa fa-angle-down"></i></a>
      <div class="user-dropdown">
        <a href="#">Dashboard </a>
        <a href="#">Profile Setting </a>
        <a href="#">Log Out </a>
      </div>
    </div>
    <div class="mobile-nav">
      <ul>
        <li><a href="#">Rent</a></li>
        <li><a href="#">Neighborhood </a></li>
        <li>
          <a class="" data-toggle="collapse" href="#menuToggle1" role="button" aria-expanded="false" aria-controls="menuToggle1">
            Renters <i class="fa fa-angle-down"></i>
          </a>
          <div class="collapse" id="menuToggle1">
            <ul>
              <li>
                <a href="#">Some Link</a>
              </li>
              <li>
                <a href="#">Some Link</a>
              </li>
              <li>
                <a href="#">Some Link</a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a class="" data-toggle="collapse" href="#menuToggle2" role="button" aria-expanded="false" aria-controls="menuToggle2">
            Company <i class="fa fa-angle-down"></i>
          </a>
          <div class="collapse" id="menuToggle2">
            <ul>
              <li>
                <a href="#">Some Link</a>
              </li>
              <li>
                <a href="#">Some Link</a>
              </li>
              <li>
                <a href="#">Some Link</a>
              </li>
            </ul>
          </div>
        </li>
        <li><a href="#">Login</a></li>
        <li><a href="#">signup</a></li>
      </ul>
    </div>
  </div>

  <div class="header-wrapper">
    <div class=" container-lg">
      <div class="header-container">
        <a href="/">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="logo" />
        </a>
        <?php
          if ( has_nav_menu( 'header-menu' ) ) {
            wp_nav_menu(
              array(
                'theme_location' => 'header-menu',
                'container' => 'false',
                'menu_class' => 'menu-links'
              )
            );
          }
        ?>
      </div>
    </div>
  </div>

  <div class="header-bg inner-pages-banner">
    <div class="banner-wrapper">
      <h1 class="mb-1">Our Blog</h1>
      <p>Our Blog on Apartments and Renting</p>
    </div>
  </div>

</header>
