<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); jws_title_bar(); ?>
<div class="container services-container">
	<div class="row row-custom">
		<div class="wrap">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="container display-custom">
						<div class="row row-single-services-custom">
							<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-services-cus">
								<?php
								if ( have_posts() ) :
									?>
									<?php
									/* Start the Loop */
									while ( have_posts() ) :
										the_post();
										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/post/content-services', get_post_format() );

									endwhile;
								else :
									get_template_part( 'template-parts/post/content-services', 'none' );

								endif;
								?>

							</div><!-- col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-services-cus-->
							<aside class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3-services-cus">
								<?php  if ( is_active_sidebar( 'sidebar-5' ) ) {
									dynamic_sidebar( 'sidebar-5' );
								} ?>
							</aside><!-- col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3-cus -->
						</div><!-- row row-single-services-custom-->
					</div><!-- container display-custom -->
					
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrap -->
	</div>
</div>
<?php
get_footer();
