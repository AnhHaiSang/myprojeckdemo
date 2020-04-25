<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="jws-container">
			<?php 
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} elseif ( is_front_page() && is_home() ) {
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}		
			?>
			<div class="jws-row">
				<div class="jws-col-7">
					<?php
					$attach_id = get_post_thumbnail_id();
					$img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "375x375", 'class' => 'attachment-large wp-post-image'));
					echo wp_kses_post($img['thumbnail']);
					?>
				</div><!-- .jws-col-7 -->
			</div><!-- .jws-row -->
		</div><!-- .jws-container -->
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
