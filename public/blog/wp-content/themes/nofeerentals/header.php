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
  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>

  <div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="mobile-nav">
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
            </div>

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

</header>
