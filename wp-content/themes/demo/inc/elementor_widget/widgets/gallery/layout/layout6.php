<div class="slider_content">  
                 <header class="row-eq-height">
                    <div class="testimonials_image">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                    </div>
                    <div class="testimonials_info">
                        <span class="testimonials_title"><?php echo wp_kses_post($item['list_name']); ?></span>
                        <span class="testimonials_job"><?php echo wp_kses_post($item['list_job']); ?></span>
                    </div>
                 </header>
                 <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
                 <footer>
                    <span class="average-rating">
                        <span class="jws-star-rating"><span class="jws-star-rated" style="width:<?php echo esc_attr(( ( $item['star'] / 5 ) * 100 )); ?>%"></span></span>
                    </span>
                    <span class="testimonials_icon"><i class="fas fa-quote-left"></i></span>
                 </footer>       
</div>

