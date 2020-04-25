<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); jws_title_bar();?>

<div class="wrap">
	<div id="primary" class="content-area">
		<div class="container display-custom">
			<div class="row row-custom">
				<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-cus">
					
					<main id="main" class="site-main" role="main">
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/post/content-archive', get_post_format() );

								endwhile;

								the_posts_pagination(
									array(
										'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
										'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>',
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
									)
								);

							else :

								get_template_part( 'template-parts/post/content', 'none' );

							endif;
						?>
					</main><!-- #main -->
				</div>
				<aside class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3-cus">
					<?php  if ( is_active_sidebar( 'sidebar-4' ) ) {
                        dynamic_sidebar( 'sidebar-4' );
                    } ?>
				</aside>
			</div>
		</div>
	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php
get_footer();
