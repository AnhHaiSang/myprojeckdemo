<div class="slider_content"> 
    <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>> 
                 <header>
                     <span class="testimonials_image">
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                      </span>
                 </header>
                 <footer>
                    <div class="testimonials_info">
                        <span class="testimonials_title"><?php echo wp_kses_post($item['list_name']); ?></span>
                        <span class="testimonials_job"><?php echo wp_kses_post($item['list_job']); ?></span>
                    </div>
                 </footer>  
     </a>                 
</div>
