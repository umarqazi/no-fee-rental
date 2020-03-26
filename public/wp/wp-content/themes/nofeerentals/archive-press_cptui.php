<?php
get_header();

$press_page_banner_title = get_field('press_page_banner_title', 'options');
$press_page_banner_sub_title = get_field('press_page_banner_sub_title', 'options');
$press_page_banner_image = get_field('press_page_banner_image', 'options');
?>

<div class="blog-banner-img-wrapper">
    <div class="blog-banner-text">
        <?php if($press_page_banner_title){ ?>
            <h4><?php echo $press_page_banner_title; ?></h4>
        <?php } if($press_page_banner_sub_title){ ?>
            <h5><?php echo $press_page_banner_sub_title; ?></h5>
        <?php } ?>
    </div>
    <?php if($press_page_banner_image){ ?>
        <div class="banner-bg" style="background-image: url(<?php echo $press_page_banner_image; ?>)"></div>
    <?php } ?>
</div>

<?php

if (have_posts()) { $press_counter = 2; ?>
    <section class="page-wraper-margin-bottom">
        <?php while(have_posts()){ the_post(); ?>
            <div class="sec-content-padd<?php if ($press_counter % 2 == 0) echo ' bg-color-section'; ?>">
                <div class="container">
                    <div class="our-passion">
                        <h3><?php the_title(); ?></h3>
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
            <?php
            $press_counter++;
        }

        wpbeginner_numeric_posts_nav();
        ?>
    </section>
    <?php
}


get_footer(); ?>
