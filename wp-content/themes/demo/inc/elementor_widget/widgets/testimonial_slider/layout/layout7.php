<div class="slider_content">  
                 <header>
                 
                    <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
                 </header>
                 <footer class="row-eq-height">
                    <div class="testimonials_image">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                    </div>
                    <div class="testimonials_info">
                        <h3 class="testimonials_title"><?php echo wp_kses_post($item['list_name']); ?></h3>
                        <h6 class="testimonials_job"><?php echo wp_kses_post($item['list_job']); ?></h6>
                    </div>
                  </footer>       
</div>
