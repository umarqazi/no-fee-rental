<?php
get_header();

if (have_posts()) {
?>
<section class="inner-pages about-us">
	<div class="container-lg">
		<?php while(have_posts()){ the_post(); ?>
			<div class="our-passion">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
			</div>
		<?php } ?>
	</div>
</section>
<?php
}

get_footer(); ?>
