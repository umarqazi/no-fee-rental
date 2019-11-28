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
    ob_start();
    session_start();

    function doLogin() {
        $ch = curl_init('http://no-fee-rental.teamtechverx.com/api/login');

    }
?>
    <!doctype html>
    <html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/css/toastr.css">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>
        <header>

            <div class="mobile-menu">
                <i class="fa fa-times close-menu-btn"></i>
                <div class="mobile-nav">
                    <ul id="menu-header-menu" class="menu-links">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-29">
                            <a href="http://no-fee-rental.teamtechverx.com/rent">Rent</a>
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-33">
                            <a href="http://no-fee-rental.teamtechverx.com/neighborhood">Neighborhood</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#login" class="signin-modal-btn close-menu">Login</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#signup" class="signup-modal-btn close-menu">Signup</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header-wrapper">
                <div class=" container-lg">
                    <div class="header-container">
                        <a href="/">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="logo" />
        </a>

                        <div class="header-right-wrapper">
                            <i class="fa fa-bars menu-btn"></i>
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
                          <div class="recent-search-dropdown">
                    <a href="#">Recent Searches<i class="fa fa-angle-down"></i></a>
                    <div class="dropDown">
                        <ul class="neighborhoods_amenities">
                            <li></li>
                        </ul>

                        <ul class="ul-border-top">
                            <li></li>
                        </ul>
                    </div>
                </div>

                          <div class="actions-btns">
                              <button type="button" class="signup-btn signup-modal-btn" data-toggle="modal" data-target="#login">Login</button>
                              <button type="button" class="signup-btn login-btn signin-modal-btn" data-toggle="modal" data-target="#signup"> Signup</button>

                    </div>
                </div>
            </div>

            <?php

    $featured_image = $title = $sub_title = "";

    if(is_front_page()) {

      $featured_image = get_the_post_thumbnail_url(6) ? get_the_post_thumbnail_url(6) : 'http://nofeerentalsblog.wp/blog/wp-content/themes/nofeerentals/assets/images/banner-bg.jpg';

      $title = get_field('title', 6) ? get_field('title', 6) : get_the_title(6);

      $sub_title = get_field('sub_title', 6);

    } else {

      $featured_image = get_the_post_thumbnail_url(get_the_ID()) ? get_the_post_thumbnail_url(get_the_ID()) : 'http://nofeerentalsblog.wp/blog/wp-content/themes/nofeerentals/assets/images/banner-bg.jpg';

      $title = get_field('title', get_the_ID()) ? get_field('title', get_the_ID()) : get_the_title(get_the_ID());

      $sub_title = get_field('sub_title', get_the_ID());

    }

    if(!is_singular('post')){
      ?>

                <!-- <div class="header-bg inner-pages-banner" style="background: url(<?php echo $featured_image; ?>) no-repeat center center;"> -->
                <!-- <div class="banner-wrapper">
          <h1 class="mb-1"><?php echo $title; ?></h1>
          <?php if($sub_title){ ?>
            <p><?php echo $sub_title; ?></p>
          <?php } ?>
        </div> -->
                <!-- </div> -->

                <?php } ?>

                    </div>
                    <script src="http://no-fee-rental.teamtechverx.com/assets/js/vendor/jquery.validate.min.js"></script>

        </header>


