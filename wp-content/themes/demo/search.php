<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); jws_title_bar(); ?>

<div class="wrap">
	<div class="container">
	
		<header class="page-header">
			<?php if ( have_posts() ) : ?>
				<h1 class="page-title">
				<?php
				/* translators: Search query. */
				printf( __( 'Search Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' );
				?>
				</h1>
			<?php else : ?>
				<h1 class="page-title"><?php _e( 'Nothing Found', 'twentyseventeen' ); ?></h1>
			<?php endif; ?>
		</header><!-- .page-header -->
		<div class="row">
			<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-cus">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/post/content', 'excerpt' );

						endwhile; // End of the loop.

						

					else :
						?>

						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
						<?php
							get_search_form();

					endif;
					?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3-cus">
				<?php  if ( is_active_sidebar( 'sidebar-4' ) ) {
					dynamic_sidebar( 'sidebar-4' );
				} ?>
			</div>
		</div>
	</div>	
</div><!-- .wrap -->

<?php
get_footer();
