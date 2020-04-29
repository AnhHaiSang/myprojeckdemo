<div class="slider_content">  
        <div class="testimonials_image">
            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
        </div>
       <div class="connet-video"> 
       	<span class="curl"></span>
       	<a class="link-video"  href="<?php echo $url ?>" target="_blank" <?php echo $nofollow; ?> > <?php \Elementor\Icons_Manager::render_icon( $settings['icon_link_video'], [ 'aria-hidden' => 'true' ] ) ?></a>
       </div>
</div>

