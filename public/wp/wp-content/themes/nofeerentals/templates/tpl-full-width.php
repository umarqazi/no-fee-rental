<?php
/**
 * Template Name: Full Width Template
 *
 */
//
//  get_header();

/*$page_data = get_page( 554 );
print_r($page_data);*/

if (have_posts()) {
    while (have_posts()) {
        the_post();

        $title = get_field('title');
        $sub_title = get_field('sub_title');
        $banner_img = get_the_post_thumbnail_url();

        ?>

        <div class="blog-banner-img-wrapper">
            <div class="blog-banner-text">
                <?php if($title){ ?>
                    <h4><?php echo $title; ?></h4>
                <?php } if($sub_title){ ?>
                    <h5><?php echo $sub_title; ?></h5>
                <?php } ?>
            </div>
            <?php if($banner_img){ ?>
                <div class="banner-bg" style="background-image: url(<?php echo $banner_img; ?>)"></div>
            <?php } ?>
        </div>

        <?php

        the_content();
    }
}

$add_js_code_here = get_field('add_js_code_here');
?>

<?php if($add_js_code_here){ ?>

    <script type="text/javascript">
        <?php echo $add_js_code_here; ?>
    </script>

<?php } //get_footer(); ?>
