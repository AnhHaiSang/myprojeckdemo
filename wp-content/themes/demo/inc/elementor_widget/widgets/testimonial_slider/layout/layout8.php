<div class="row row-eq-height">
        <div class="slider-display">
            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
            <div class="connet-video">
                <a class="link-video"  href="<?php echo $url ?>" <?php echo $target;?> <?php echo $nofollow;?> > <?php \Elementor\Icons_Manager::render_icon( $settings['icon_link_video'], [ 'aria-hidden' => 'true' ] ) ?></a>
            </div>
            <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
        </div>

    
</div> 