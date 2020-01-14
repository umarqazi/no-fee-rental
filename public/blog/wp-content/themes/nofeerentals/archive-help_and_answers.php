<?php
  get_header();

  $banner_title = get_field('banner_title', 'options');
  $banner_sub_title = get_field('banner_sub_title', 'options');
  $banner_image = get_field('banner_image', 'options');
?>

<div class="blog-banner-img-wrapper">
  <div class="blog-banner-text">
    <?php if($banner_title){ ?>
      <h4><?php echo $banner_title; ?></h4>
    <?php } if($banner_sub_title){ ?>
      <h5><?php echo $banner_sub_title; ?></h5>
    <?php } ?>
  </div>
  <?php if($banner_image){ ?>
    <div class="banner-bg" style="background-image: url(<?php echo $banner_image; ?>)"></div>
  <?php } ?>
</div>

<?php

  if (have_posts()) {
    ?>
    <section class="inner-pages about-us">
      <div class="container">
        <?php while(have_posts()){ the_post(); ?>
          <div class="our-passion">
            <h3><?php the_title(); ?></h3>
            <?php the_excerpt(); ?>
            <p><a href="<?php the_permalink();?>">Read More</a></p>
          </div>
        <?php } ?>
      </div>
    </section>
    <?php
  }

  get_footer(); ?>
