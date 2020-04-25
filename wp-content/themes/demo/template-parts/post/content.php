<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress

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
					if ( 'post' === get_post_type() ) {
						echo '<div class="entry-meta">';
						?>
						<?php 
						$categories = get_the_category();
						if ( ! empty( $categories ) ) {
							echo '<a class="link-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span class="cat-post-name">' . esc_html( $categories[0]->name ) . '</span></a>';
						}
						?>
						<span class="line-column">|</span>

						<?php 
						$archive_year  = get_the_time( 'Y' ); 
						$archive_month = get_the_time( 'm' ); 
						$archive_day   = get_the_time( 'd' ); 
						?>
						<a class="link-date" href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
							<span class="date"><?php echo get_the_date();?></span>
						</a>

						<span class="line-column">|</span>

						<a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="link-info-author">
							<span class="name"><?php echo get_the_author();?></span>
						</a>
					<?php
					echo '</div><!-- .entry-meta -->';
				}; ?>
				</div><!-- .jws-col-10 -->

				<div class="jws-col-5">
					<div class="container-view-favorite-comment">
						<div class="wrapp-view-favorite-comment">	
							<div class="view-favorite-comment">
								<span class="view"><i class="pettyicon petty-icon005-visibility"></i><span class="count"><?php echo getPostViews(get_the_ID()); ?></span></span>
								<span class="line-column">|</span>
								<span class="favorite"><i class="pettyicon petty-icon002-like"></i><?php echo esc_attr(post_favorite());  ?></span>
								<span class="line-column">|</span>
								<span class="comment"><i class="icons-c-u icon-s-c-uth-list-1"></i><span class="count"><?php echo get_comments_number(); ?></span></span>
							</div><!-- .view-favorite-commnet -->
						</div><!-- .wrapp-view-favorite-commnet -->
					</div><!-- .container-view-favorite-commnet -->
				</div><!-- .jws-col-2 -->
			</div><!-- .jws-row -->
		</div><!-- .jws-container -->
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
