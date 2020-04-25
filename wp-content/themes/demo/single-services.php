<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); jws_title_bar(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php $the_query = new \WP_Query( $args );?>
			<div class="container display-custom">
				<div class="row row-single-services-custom">
					<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-services-cus">
								<?php
							 	/* Start the Loop */
							 	while ( have_posts() ) : the_post();

							 		get_template_part( 'template-parts/post/content-services', get_post_format() );

									// If comments are open or we have at least one comment, load up the comment template.
							endwhile; // End of the loop.
						?>
					</div><!-- col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9-cus -->
					<aside class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3-services-cus">
						<?php  if ( is_active_sidebar( 'sidebar-5' ) ) {
                        			     dynamic_sidebar( 'sidebar-5' );
                        		   } ?>
						
					</aside><!-- col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3-cus -->
				</div><!-- row -->
			</div><!-- container display-custom -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
