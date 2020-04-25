<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();

			if ( '1' === $comments_number ) {
				/* translators: %s: Post title. */
				if($comments_number < '10'){
					// $format_number = $comments_number
					echo '<span>'  . $comments_number . '</span> ';
				}else{
					echo '<span>' . $comments_number . '</span> ';
				}
				printf( _x( 'Comments', 'comments', 'twentyseventeen' ), get_comments_number() ) ;
			} else {
				if($comments_number < '10'){
					// $format_number = $comments_number
					echo '<span>'  . $comments_number . '</span> ';
				}else{
					echo '<span>' . $comments_number . '</span> ';
				}
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_nx(
						'Comments',
						'Comments',
						$comments_number,
						'comments',
						'twentyseventeen',
						get_comments_number()
					),
					number_format_i18n( $comments_number ),
					get_the_title()
					
				);
			}
			?>
		</h2>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
						'callback' => 'jws_custom_comment',
						'reply_text'  => __( 'Reply', 'twentyseventeen' ),
					)
				);
			?>
		</ol>


		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
