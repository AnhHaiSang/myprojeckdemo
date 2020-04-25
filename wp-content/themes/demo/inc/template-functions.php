<?php
/* Title Bar */
if ( ! function_exists( 'jws_title_bar' ) ) {
	function jws_title_bar() {
		global $jws_option;
        $page_titlebar = get_post_meta(get_the_ID(), 'page_select_titlebar', true);
		$delimiter = '<span class="delimiter"><i class="far fa-circle"></i></span>';
        
        if(!$jws_option['title-bar-switch'] && 'sfwd-courses' != get_post_type()) :
        
        if(isset($jws_option['select-titlebar']) && !empty($jws_option['select-titlebar'])) {
            
          echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar'] . '"]');
            
        }elseif((is_single() && 'projects' == get_post_type()) && (isset($jws_option['select-titlebar-projects']) && !empty($jws_option['select-titlebar-projects'])) ){

           echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar-projects'] . '"]');  
          
        }elseif((is_single() && 'studies' == get_post_type()) && (isset($jws_option['select-titlebar-studies']) && !empty($jws_option['select-titlebar-studies'])) ){

           echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar-studies'] . '"]');  
          
        }elseif((is_single() && 'post' == get_post_type()) && (isset($jws_option['select-titlebar-blog']) && !empty($jws_option['select-titlebar-blog'])) ){

           echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar-blog'] . '"]');  
          
        }elseif('academics' == get_post_type() && (isset($jws_option['select-titlebar-academics']) && !empty($jws_option['select-titlebar-academics'])) ){

           echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar-academics'] . '"]'); 
          
        }elseif((is_shop() || is_product()) && (isset($jws_option['select-titlebar-shop']) && !empty($jws_option['select-titlebar-shop'])) ){

           echo do_shortcode('[hf_template id="' . $jws_option['select-titlebar-shop'] . '"]'); 
          
        }elseif(isset($page_titlebar) && !empty($page_titlebar)){
            
           echo do_shortcode('[hf_template id="' . $page_titlebar . '"]'); 
            
        }else {
          ?>
          <div class="jws-title-bar-wrap">
          	<div class="container container-custom"> 
          		<div class="jws-title-bar">
          			<h2 class="jws-text-ellipsis"> <?php echo jws_page_title(); ?></h2>
          			<div class="jws-path">
          				<div class="jws-path-inner">
          					<?php echo jws_page_breadcrumb($delimiter); ?>
          				</div>
          			</div>
          		</div>
          	</div>
          </div>
	      <?php   
        }
        endif;
	}
}

/* Page breadcrumb */
if (!function_exists('jws_page_breadcrumb')) {
    function jws_page_breadcrumb($delimiter) {
		ob_start();

		$home = __('Home', 'paradise');

		global $post;
		$homeLink = home_url();
		if( is_home() ){
			_e('Home', 'paradise');
		}else{
			echo '<a href="' . $homeLink . '"><i class="fas fa-home"></i> ' . $home . '</a> ' . $delimiter . '</span>' . ' ';
		}

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo '<span class="current">' . __('Archive by category: ', 'paradise') . single_cat_title('', false) . '</span>';

		} elseif ( is_search() ) {
			echo '<span class="current">' . __('Search results for: ', 'paradise') . get_search_query() . '</span>';

		} elseif ( is_post_type_archive( 'product' ) ) {
			echo '<span class="current">' . __('Shop', 'paradise') . '</span>';

		} elseif ( is_day() ) {
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F').' '. get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<span class="current">' . get_the_time('d') . '</span>';

		} elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		} 
        elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		}
        elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				if(get_post_type() == 'portfolio'){
					$terms = get_the_terms(get_the_ID(), 'portfolio_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'portfolio_category', '' , ', ' );
						echo '' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' .esc_html('Portfolio Details', 'paradise'). '</span>';
					}
				}elseif(get_post_type() == 'jwsdonations'){
					$terms = get_the_terms(get_the_ID(), 'recipe_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'recipe_category', '' , ', ' );
						echo ' ' . '<span class="current">' .esc_html('Causes Details', 'paradise'). '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'team'){
					$terms = get_the_terms(get_the_ID(), 'team_category', '' , '' );
					if($terms) {
						//the_terms(get_the_ID(), 'team_category', '' , ', ' );
						echo '' . '<span class="current">'.esc_html('Team Details', 'paradise'). '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'testimonial'){
					$terms = get_the_terms(get_the_ID(), 'testimonial_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'testimonial_category', '' , ', ' );
						echo '' . '<span class="current">' .esc_html('Testimonial Details', 'paradise').  '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'story'){
						echo '<span class="current">' . get_the_title() . '</span>';
				}elseif(get_post_type() == 'product'){
					$terms = get_the_terms(get_the_ID(), 'product_cat', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'product_cat', ' ' , ', ' , '<span class="delimiter">'.' ' . $delimiter . ' ' . '</span>'  );
						echo ''  . '<span class="current">' .the_title(). '</span>';
					}else{
						echo '<span class="current">'.the_title().'</span>';
					}
				}else{
					if(is_singular( 'event' )) {
						echo '<span class="current">'.esc_html('Event Details', 'paradise').'</span>';
						
					} else {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}
				}

			} else {
				//$cat = get_the_category(); $cat = $cat[0];
				//$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				//echo ''.$cats;
				echo '<span class="current">' .esc_html('Blog Details', 'paradise'). '</span>';
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if($post_type) echo '<span class="current">' . $post_type->labels->singular_name . '</span>';
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif ( is_page() && !$post->post_parent ) {
			echo '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo ''.$breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' ' . $delimiter . ' ';
			}
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_tag() ) {
			echo '<span class="current">' . __('Posts tagged: ', 'paradise') . single_tag_title('', false) . '</span>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . __('Articles posted by ', 'paradise') . $userdata->display_name . '</span>';
		} elseif ( is_404() ) {
			echo '<span class="current">' . __('Error 404', 'paradise') . '</span>';
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo ' '.'<span class="delimiter">'.$delimiter.'</span> ' . ' '.'<span class="paged-number">'.__('Page', 'paradise') . ' ' . get_query_var('paged').'</span>';
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
			
		return ob_get_clean();
    }
}
/* Page title */
if (!function_exists('jws_page_title')) {
    function jws_page_title() { 
            ob_start();
			if( is_home() ){
				_e('Home', 'paradise');
			}elseif(is_search()){
                _e('Search Keyword: ', 'paradise'). '<span class="keywork">'. get_search_query( false ). '</span>';
            }elseif(is_post_type_archive( 'product' )){
                _e('Shop', 'paradise');
            }else {
                if (is_category()){
                    single_cat_title();
                }elseif(get_post_type() == 'event' || get_post_type() == 'jwsdonations'  || get_post_type() == 'testimonial' ){
                    single_term_title();
                }
                elseif (is_tag()){
                    single_tag_title();
                }elseif (is_author()){
                    printf(__('Author: %s', 'paradise'), '<span class="vcard">' . get_the_author() . '</span>');
                }elseif (is_day()){
                    printf(__('Day: %s', 'paradise'), '<span>' . get_the_date() . '</span>');
                }elseif (is_month()){
                    printf(__('Month: %s', 'paradise'), '<span>' . get_the_date() . '</span>');
                }elseif (is_year()){
                    printf(__('Year: %s', 'paradise'), '<span>' . get_the_date() . '</span>');
                }elseif (is_tax('post_format', 'post-format-aside')){
                    _e('Asides', 'paradise');
                }elseif (is_tax('post_format', 'post-format-gallery')){
                    _e('Galleries', 'paradise');
                }elseif (is_tax('post_format', 'post-format-image')){
                    _e('Images', 'paradise');
                }elseif (is_tax('post_format', 'post-format-video')){
                    _e('Videos', 'paradise');
                }elseif (is_tax('post_format', 'post-format-quote')){
                    _e('Quotes', 'paradise');
                }elseif (is_tax('post_format', 'post-format-link')){
                    _e('Links', 'paradise');
                }elseif (is_tax('post_format', 'post-format-status')){
                    _e('Statuses', 'paradise');
                }elseif (is_tax('post_format', 'post-format-audio')){
                    _e('Audios', 'paradise');
                }elseif (is_tax('post_format', 'post-format-chat')){
                    _e('Chats', 'paradise');
                }
                elseif(get_post_type() == 'product' && !is_single()){
                   single_term_title();
                }else{
                    the_title();
                }
            }
                
            return ob_get_clean();
    }
}

/* Add Function Crop Images   */
function jws_getImageBySize($params = array())
{
    $params = array_merge(array(
        'post_id' => null,
        'attach_id' => null,
        'thumb_size' => 'thumbnail',
        'class' => '',
    ), $params);

    if (!$params['thumb_size']) {
        $params['thumb_size'] = 'thumbnail';
    }

    if (!$params['attach_id'] && !$params['post_id']) {
        return false;
    }

    $post_id = $params['post_id'];

    $attach_id = $post_id ? get_post_thumbnail_id($post_id) : $params['attach_id'];
    $attach_id = apply_filters('jws_object_id', $attach_id);
    $thumb_size = $params['thumb_size'];
    $thumb_class = (isset($params['class']) && '' !== $params['class']) ? $params['class'] . ' ' : '';

    global $_wp_additional_image_sizes;
    $thumbnail = '';

    if (is_string($thumb_size) && ((!empty($_wp_additional_image_sizes[$thumb_size]) && is_array($_wp_additional_image_sizes[$thumb_size])) || in_array($thumb_size, array(
                'thumbnail',
                'thumb',
                'medium',
                'large',
                'full',
            )))
    ) {
        $attributes = array('class' => $thumb_class . 'attachment-' . $thumb_size);
        $thumbnail = wp_get_attachment_image($attach_id, $thumb_size, false, $attributes);
    } elseif ($attach_id) {
        if (is_string($thumb_size)) {
            preg_match_all('/\d+/', $thumb_size, $thumb_matches);
            if (isset($thumb_matches[0])) {
                $thumb_size = array();
                $count = count($thumb_matches[0]);
                if ($count > 1) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][1]; // height
                } elseif (1 === $count) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][0]; // height
                } else {
                    $thumb_size = false;
                }
            }
        }
        if (is_array($thumb_size)) {
            // Resize image to custom size
            $p_img = wpb_resize2($attach_id, null, $thumb_size[0], $thumb_size[1], true);
            $alt = trim(strip_tags(get_post_meta($attach_id, '_wp_attachment_image_alt', true)));
            $attachment = get_post($attach_id);
            if (!empty($attachment)) {
                $title = trim(strip_tags($attachment->post_title));

                if (empty($alt)) {
                    $alt = trim(strip_tags($attachment->post_excerpt)); // If not, Use the Caption
                }
                if (empty($alt)) {
                    $alt = $title;
                } // Finally, use the title
                if ($p_img) {

                    $attributes = jws_stringify_attributes(array(
                        'class' => $thumb_class,
                        'src' => $p_img['url'],
                        'width' => $p_img['width'],
                        'height' => $p_img['height'],
                        'alt' => $alt,
                        'title' => $title,
                    ));

                    $thumbnail = '<img ' . $attributes . ' />';
                }
            }
        }
    }

    $p_img_large = wp_get_attachment_image_src($attach_id, 'large');

    return apply_filters('jws_wpb_getimagesize', array(
        'thumbnail' => $thumbnail,
        'p_img_large' => $p_img_large,
    ), $attach_id, $params);
}

//-------------custom size image-------------
if (!function_exists('wpb_resize2')) {
    /**
     * @param int $attach_id
     * @param string $img_url
     * @param int $width
     * @param int $height
     * @param bool $crop
     *
     * @since 4.2
     * @return array
     */
    function wpb_resize2($attach_id = null, $img_url = null, $width, $height, $crop = false)
    {
        // this is an attachment, so we have the ID
        $image_src = array();
        if ($attach_id) {
            $image_src = wp_get_attachment_image_src($attach_id, 'full');
            $actual_file_path = get_attached_file($attach_id);
            // this is not an attachment, let's use the image url
        } elseif ($img_url) {
            $file_path = parse_url($img_url);
            $actual_file_path = rtrim(ABSPATH, '/') . $file_path['path'];
            $orig_size = getimagesize($actual_file_path);
            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }
        if (!empty($actual_file_path)) {
            $file_info = pathinfo($actual_file_path);
            $extension = '.' . $file_info['extension'];

            // the image path without the extension
            $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

            // checking if the file size is larger than the target size
            // if it is smaller or the same size, stop right here and return
            if ($image_src[1] > $width || $image_src[2] > $height) {

                // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
                if (file_exists($cropped_img_path)) {
                    $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);
                    $vt_image = array(
                        'url' => $cropped_img_url,
                        'width' => $width,
                        'height' => $height,
                    );

                    return $vt_image;
                }

                if (false == $crop) {
                    // calculate the size proportionaly
                    $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                    // checking if the file already exists
                    if (file_exists($resized_img_path)) {
                        $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

                        $vt_image = array(
                            'url' => $resized_img_url,
                            'width' => $proportional_size[0],
                            'height' => $proportional_size[1],
                        );

                        return $vt_image;
                    }
                }

                // no cache files - let's finally resize it
                $img_editor = wp_get_image_editor($actual_file_path);

                if (is_wp_error($img_editor) || is_wp_error($img_editor->resize($width, $height, $crop))) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }

                $new_img_path = $img_editor->generate_filename();

                if (is_wp_error($img_editor->save($new_img_path))) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }
                if (!is_string($new_img_path)) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }

                $new_img_size = getimagesize($new_img_path);
                $new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

                // resized output
                $vt_image = array(
                    'url' => $new_img,
                    'width' => $new_img_size[0],
                    'height' => $new_img_size[1],
                );

                return $vt_image;
            }

            // default output - without resizing
            $vt_image = array(
                'url' => $image_src[0],
                'width' => $image_src[1],
                'height' => $image_src[2],
            );

            return $vt_image;
        }

        return false;
    }
}
//-------------author name-------------
function jws_stringify_attributes($attributes)
{
    $atts = array();
    foreach ($attributes as $name => $value) {
        $atts[] = $name . '="' . esc_attr($value) . '"';
    }
    return implode(' ', $atts);
}
/*Custom comment list*/
function jws_custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div ';
        $add_below = 'comment';
    } else {
        $tag = 'li ';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo wp_kses_post($tag) ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>

    <div class="comment-avatar">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
    </div>
    <div class="comment-info">
        <div class="comment-header-info">
            <span class="comment-author"><?php printf(esc_html__('%s', 'zahar'), get_comment_author()); ?></span>
            <span class="divider">|</span>
            <span class="comment-date">at <?php echo get_comment_time( 'h : a' ); ?> on <?php printf(esc_html__('%1$s ', 'zahar'), get_comment_date()); ?></span>
            <span class="divider">|</span>
            <span class="comment-time"></span>
            <span class="reply">
                <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </span>
        </div>
        <?php comment_text(); ?>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'zahar'); ?></em>
            <br/>
        <?php endif; ?>
    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}
//----------------function đổi vị trí comment xuống dưới----------
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );


//---------------------------------------------------------------------
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/**
 * Render related post based on post tags.
 *
 * @since 1.0.0
 */
if (!function_exists('jws_related_post')) {

    function jws_related_post()
    {
        $cats = get_the_category(get_the_ID());
        $first_cat = $cats[0]->term_id;
        $first_cat_count = $cats[0]->category_count;
        $args = array(
            'category__in' => array($first_cat),
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 2,
            'ignore_sticky_posts' => 4
        );
       
        $my_query = new WP_Query($args);
        $count = $my_query->post_count;
        if ($first_cat_count > 1) :
            ?>

            <div class="post-related">
                <?php if($count == 1 ) : ?>
                <h1 class="related_post_title"><?php echo esc_html__('RELATED POST', 'aishe'); ?></h1>
                <?php else: ?>
                <h1 class="related_post_title"><?php echo esc_html__('RELATED POSTS', 'aishe'); ?></h1>
                <?php endif; ?>
                <div class="jws-post-related-slider row"
                     data-slick='{"slidesToShow": 3 ,"slidesToScroll": 1,  "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2}},{"breakpoint": 767,"settings":{"slidesToShow": 1}}]}'>
                    <?php if ($my_query->have_posts()) {
                        
                            get_template_part( 'template-parts/post_related/post_related', get_post_format() );
                        
                    }
                    wp_reset_query(); ?>
                </div>
            </div>
        <?php
        endif;
  }
}


/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.8
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// -------------
// 1. Show Buttons
 
// add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
        
// function bbloomer_display_quantity_plus() {
//    echo '<button type="button" class="plus" >+</button>';
// }
// add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
// function bbloomer_display_quantity_minus() {
//    echo '<button type="button" class="minus" >-</button>';
// }
// // Note: to place minus @ left and plus @ right replace above add_actions with:
// add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
// add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
  
// -------------
// 2. Trigger jQuery script
  
add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
  
function bbloomer_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if (  is_product() ||  is_cart() ||  is_shop() ) {


   ?>
      <script type="text/javascript">
           
      jQuery(document).ready(function($){   
           // console.log('test');
         $('form.cart, form.woocommerce-cart-form').on( 'click', 'button.plus, button.minus', function() {
  
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart, form.woocommerce-cart-form' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
           
      });
           
      </script>
   <?php  }
}