<?php 
$i = 1;
while ( $the_query->have_posts() ) : $the_query->the_post();
	$position = ($i == 2 || $i == 5 || $i == 8 || $i == 11) ? esc_attr('box-between') : 'box';
	if( !empty($categories) ){
		$item_cats = get_the_terms(get_the_ID(), 'category');
		$get_item = '';
		foreach ( $item_cats as $category )  {
			$get_item .= ' ' . $category->slug;
		}};
 ?>
	<li class="gallerys <?php echo $position ?><?php echo $get_item; ?>">
	    <div class="post_thumbnail">
	    	<div class="wrapper-image">
	    		 <?php
	        $attach_id = get_post_thumbnail_id();
	        $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "375x375", 'class' => 'attachment-large wp-post-image'));
	        echo wp_kses_post($img['thumbnail']);
	        ?>
	    	</div>
	       <div class="ellipse-2">
		       	<div class="wrapper-ellipse-2">
		       		<span class="icon"><i class="icons-c-u icon-s-c-u001-search-1"></i></span>
		       	</div>
	       </div>
        </div>
    </li>
    <?php $i ++;?>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>