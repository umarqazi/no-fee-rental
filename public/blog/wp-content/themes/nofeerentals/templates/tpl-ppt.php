<?php
/*
*
* Template Name: Privacy Policy & Terms Template
*
*/
?>

<?php get_header();?>

<style type="text/css">
	.inner-pages-banner {
		width: 100%;
	    object-fit: cover;
	    position: relative;
	}
	.banner-wrapper h1{
		display: none;
	}
</style>

<?php
$privacy_banner = get_field('privacy_banner');
$banner_title = get_field('banner_title');
$last_update = get_field('last_update')
$content_before_middle_section = get_field('content_before_middle_section');
$background_image = get_field('background_image');
$title = get_field('title');
$description = get_field('description');
$content_after_middle_section = get_field('content_after_middle_section');
?>
<section class="inner-pages press-section wow fadeIn inner-page-terms" data-wow-delay="0.2s">
    <div class="blog-banner-img-wrapper">
        <div class="blog-banner-text">
            <h4> <?php  echo $banner_title;?></h4>
            <span><?php echo $last_update; ?> </span>
        </div>
        <div class="privacy-policy-banner" style="background-image: url('<?php echo $privacy_banner; ?>')"> </div>

    </div>
    <?php echo $content_before_middle_section; ?>
    <div class=" sec-padiing-terms <?php if($_GET['page_id']==27) echo 'entire-agreement-bg';elseif($_GET['page_id']==3) echo 'info-collect-bg'; else echo 'info-collect-bg' ?>" style="background-image: url(<?php echo $background_image; ?>);">
        <div class="container-lg">
            <div class="entire-agreement-text">
                <h3><?php echo $title; ?></h3>
                <?php echo $description; ?>
            </div>
        </div>
    </div>

    <?php echo $content_after_middle_section; ?>
</section>

<?php get_footer(); ?>



