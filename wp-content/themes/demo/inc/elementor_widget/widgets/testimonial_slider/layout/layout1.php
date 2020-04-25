<div class="row row-eq-height">
    <div class="col-xl-8 col-lg-7 col-12">
        <div class="slider_content">
            <p class="testimonials_icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></p>
            <h2 class="testimonials_title"><?php echo wp_kses_post($item['title']); ?></h2>
            <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
            <h3 class="testimonials_name"><?php echo wp_kses_post($item['list_name']); ?></h3>
            <h6 class="testimonials_job"><span class="average-rating">
                        <span class="jws-star-rating"><span class="jws-star-rated" style="width:<?php echo esc_attr(( ( $item['star'] / 5 ) * 100 )); ?>%"></span></span>
                    </span><?php echo wp_kses_post($item['list_job']); ?></h6>
                 <?php if($settings['navigation'] == 'dots' || $settings['navigation'] == 'both'): ?>
                    <div class="custom_dots"></div><?php endif; ?>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5 col-12">
        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
    </div>
</div> 