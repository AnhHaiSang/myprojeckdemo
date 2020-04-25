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
				<div class="row row-single-post-custom">
					<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9-cus">
						<div class="post_thumbnail">
						 	<?php
						 		$attach_id = get_post_thumbnail_id();
						 		$img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "870x400", 'class' => 'attachment-large wp-post-image'));
						 		echo wp_kses_post($img['thumbnail']);
						 	?>
						</div>
								<?php
							 	/* Start the Loop */
							 	while ( have_posts() ) : the_post();
							 		get_template_part( 'template-parts/post/content', get_post_format() );
									// If comments are open or we have at least one comment, load up the comment template.
								?>
									<div class="tags-shares">
										<div class="tags">
											<span class="lable-tags">tags</span>
											<?php 
											$tags = get_tags(array(
												'hide_empty' => false
											));
											echo '<ul class="tag-lists">';
											foreach ($tags as $tag) {
												echo '<li class="list-item">' . $tag->name . '</li>';
											}
											echo '</ul>';?>
									</div>
							<div class="shares">
								<span class="share">share</span>
								<a class="link link-fb" href="#"><span class="pettyicon petty-icon021-facebook"></span></a>
								<a class="link link-pt" href="#"><span class="pettyicon petty-icon032-pinterest-logo"></span></a>
								<a class="link link-tw" href="#"><span class="pettyicon petty-icon023-twitter"></span></a>
								<a class="link link-ins" href="#"><span class="pettyicon petty-icon029-instagram-logo"></span></a>
								<a class="link link-gg" href="#"><span class="pettyicon petty-icon035-google"></span></a>
							</div>
						</div>
						<div class="about-author">
							<div class="container-about-author">
								<div class="about-author-row">
									<div class="avatar-author">
										<div class="img-author">
											<?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
										</div>
									</div>
									<div class="info-author">
										<div class="content">
											<h2 class="title">Author</h2>
											<h3 class="name-author">
												<a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="link-info-author">
													<span class="name"><?php echo get_the_author();?></span>
												</a>
											</h3>
											<p class="text"><?php $authorDesc = the_author_meta('description'); echo $authorDesc; ?></p>
											<div class="contact-with-author">
												<a class="link link-fb" href="#"><span class="pettyicon petty-icon021-facebook"></span></a>
												<a class="link link-pt" href="#"><span class="pettyicon petty-icon032-pinterest-logo"></span></a>
												<a class="link link-tw" href="#"><span class="pettyicon petty-icon023-twitter"></span></a>
												<a class="link link-ins" href="#"><span class="pettyicon petty-icon029-instagram-logo"></span></a>
												<a class="link link-gg" href="#"><span class="pettyicon petty-icon035-google"></span></a>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
							<?php jws_related_post() ?>
								<?php
						 		if ( comments_open() || get_comments_number() ) :
						 			comments_template();
						 		endif;

							endwhile; // End of the loop.
						?>
					</div>
					<aside class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3-cus">
						<?php  if ( is_active_sidebar( 'sidebar-4' ) ) {
							dynamic_sidebar( 'sidebar-4' );
						} ?>
					</aside>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .wrap -->

<?php
get_footer();
