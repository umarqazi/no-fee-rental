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
    <div class="modal fade login-modal show" id="signup">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        
        <div class="modal-content">
            <img src="<?php bloginfo('template_url')?>/assets/images/modal-close-icon.png" alt="" class="close-modal close-signup-modal" data-dismiss="modal">
            <div class="logo-info-wrapper">
                <img src="assets/images/modal-logo.png" alt="" class="logo">
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

<script src="http://no-fee-rental.teamtechverx.com/assets/js/signup.js"></script>

<script src="http://no-fee-rental.teamtechverx.com/assets/js/login.js"></script>
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

                    </div>

        </header>
