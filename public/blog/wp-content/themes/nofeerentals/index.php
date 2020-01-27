<?php
  /**
   * The template for displaying all posts
   *
   * This is the template that displays all pages by default.
   * Please note that this is the WordPress construct of pages
   * and that other 'pages' on your WordPress site may use a
   * different template.
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package nofeerentals
   */

  get_header();

  global $wp_query;
  if(have_posts()){
    ?>

    <section class="inner-pages rental-guides-container blog-page">

      <?php
        while(have_posts()) {
          the_post();
          $cls = "";
          $cls1 = "";
          if(($wp_query->current_post + 1) % 2 == 0){
            $cls = " right-content";
            $cls1 = " order-lg-5";
          }
          ?>
          <div class="rental-guides-row<?php echo $cls; ?>">
            <div class="row align-items-center">
              <div class="col-lg-7<?php echo $cls1; ?>">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""
                     class="main-img" />
              </div>
              <div class="col-lg-5">
                <div class="info">
                  <h3><?php the_title(); ?><br>
                    <span><?php echo get_the_date('j M Y'); ?></span>
                  </h3>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>">READ MORE</a>
                </div>
              </div>
            </div>
          </div>

          <?php
        }
      ?>

      <div class="text-center my-3">
        <!-- <a href="#" class="btn-default mt-5">View More</a> -->
        <?php wpbeginner_numeric_posts_nav(); ?>
      </div>

    </section>

    <?php
  }
  get_footer();
