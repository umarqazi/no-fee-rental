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
                  <div class="actions-btns">
                      <button type="button" class="signup-btn signup-modal-btn" data-toggle="modal" data-target="#signup">Signup</button>
                      <button type="button" class="signup-btn login-btn signin-modal-btn" data-toggle="modal" data-target="#login">Login</button>
                  </div>
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

    <div class="modal fade login-modal" id="signup">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        {{--Signup Container--}}
        <div class="modal-content">
            <img src="assets/images/modal-close-icon.png" alt="" class="close-modal close-signup-modal"  data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="assets/images/modal-logo.png" alt="" class="logo" />
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
                {!! Form::open(['url' => route('user.signup'), 'class' => 'ajax', 'reset' => 'true' , 'method' => 'post', 'id' => 'signup_form']) !!}
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
                                <strong>{{ $errors->first('user_type') }}</strong>
                            </span>
                        </div>
                        <div class="col-sm-12 license_num">
                             <div class="row align-items-center">
                                <div class="col-sm-6 ">
                                    <div class="form-group">
                                       <input class="input-style" placeholder="License Number" name="license_number" type="text">
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="input-style agnet-input" placeholder="First Name" name="first_name" type="text" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="input-style agnet-input" placeholder="Last Name" name="last_name" type="text" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                               <input class="input-style agnet-input" id="email" placeholder="Email" name="email" type="text" disabled="">
                                <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX, Nestio or OLR account.</p>
                            </div>
                        </div>

                        <div class="col-sm-6" id="phone_number">
                            <div class="form-group">
                                <input class="input-style agnet-input" placeholder="Phone Number" name="phone_number" type="text" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <i class="fa fa-eye"></i>
                                <input class="input-style agnet-input" placeholder="Password" id="password" name="password" type="password" value="" disabled="">
                                    
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group eye-form">
                                <i class="fa fa-eye"></i>
                                <input class="input-style agnet-input" placeholder="Confirm Password" name="password_confirmation" type="password" value="" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-4">
                        <input class="btn-default" type="submit" value="Signup" disabled="">
                    </div>
                <p class="footer-text">Already have an account? <span class="signin-wrapper" id = "login-btn">Login</span></p>
            </div>
        </div>
    </div>
</div>

{!! HTML::script('assets/js/signup.js') !!}

</header>
