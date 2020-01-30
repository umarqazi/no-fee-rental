<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package nofeerentals
 */

get_header();
<<<<<<< HEAD

$search_page_banner = get_field('search_page_banner', 'options');
$search_page_title = get_field('search_page_title', 'options');

?>
    <div class="blog-banner-img-wrapper">
<!--        <div class="blog-banner-text">-->
<!--            --><?php //if($search_page_title){ ?><!--<h4>--><?php //echo $search_page_title; ?><!--</h4>-->
<!--        </div>-->
        <?php if($search_page_banner){ ?>
            <div class="banner-bg" style="background-image: url(<?php echo $search_page_banner; ?>)"></div>
        <?php } ?>
            <div class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'nofeerentals' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </div>
    </div>

    <section id="primary" class="content-area inner-pages blog-page single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php if ( have_posts() ) :
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', 'search' );
                        endwhile;
                        the_posts_navigation();
                    else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                    ?>
                </div>
                <div class="col-lg-3">
                    <?php dynamic_sidebar(); ?>
                </div>
            </div>
        </div>

    </section><!-- #primary -->
<script>
    $(document).ready(function () {
       alert();
        $('#categories-2 ul li > a:contains("Uncategorized")').each(function() {
            if ($(this).text() === 'Uncategorized') {
                $(this).parent().remove();
            }
        });
    });
</script>
=======

$search_page_banner = get_field('search_page_banner', 'options');
$search_page_title = get_field('search_page_title', 'options');

?>
    <div class="blog-banner-img-wrapper">
<!--        <div class="blog-banner-text">-->
<!--            --><?php //if($search_page_title){ ?><!--<h4>--><?php //echo $search_page_title; ?><!--</h4>-->
<!--        </div>-->
        <?php if($search_page_banner){ ?>
            <div class="banner-bg" style="background-image: url(<?php echo $search_page_banner; ?>)"></div>
        <?php } ?>
            <div class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'nofeerentals' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </div>
    </div>

    <section id="primary" class="content-area inner-pages blog-page single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php if ( have_posts() ) :
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', 'search' );
                        endwhile;
                        the_posts_navigation();
                    else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                    ?>
                </div>
                <div class="col-lg-3">
                    <?php dynamic_sidebar(); ?>
                </div>
            </div>
        </div>

    </section><!-- #primary -->
>>>>>>> 82033415f159e04281af71a3c705123665c8ec3b
<?php
get_footer();
