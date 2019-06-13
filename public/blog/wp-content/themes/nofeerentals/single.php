<?php
  /**
   * The template for displaying all single posts
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
   *
   * @package nofeerentals
   */

  get_header();

  if(have_posts()) {
    while(have_posts()) {
      the_post();
      ?>

      <section class="inner-pages rental-guides-container blog-page mt-5 single-post">
        <div class="container-lg">
          <div class="text-center">
            <h3><?php the_title(); ?> <br> <span><?php echo get_the_date('j M Y'); ?></span></h3>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="" class="featured-img">
            <?php the_content(); ?>
          </div>
          <div class="text-center">
            <a href="<?php bloginfo('url'); ?>" class="btn-default mt-5">Back</a>
          </div>
        </div>

        <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if(comments_open() || get_comments_number()) {
            comments_template();
          }
        ?>
      </section>

      <?php
    }
  }

  get_footer();
