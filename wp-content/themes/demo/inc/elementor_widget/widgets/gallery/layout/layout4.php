<div class="slider_content">  
                 <header>
                    <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
                 </header>
                 <footer class="row-eq-height">
                    <div class="testimonials_info">
                        <span class="testimonials_image">
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                        </span>
                        <span class="testimonials_title"><?php echo wp_kses_post($item['list_name']); ?></span>
                        <span class="testimonials_job"><?php echo wp_kses_post($item['list_job']); ?></span>
                    </div>
                  </footer>       
</div>