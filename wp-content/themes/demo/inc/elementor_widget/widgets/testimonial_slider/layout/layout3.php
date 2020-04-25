<div class="slider_content">  
                 <header>
                    <span class="testimonials_icon"><i class="fas fa-quote-right"></i></span>
                    <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
                 </header>
                 <footer>
                    <div class="testimonials_info">
                        <h3 class="testimonials_title"><?php echo wp_kses_post($item['list_name']); ?></h3>
                        <h6 class="testimonials_job"><?php echo wp_kses_post($item['list_job']); ?></h6>
                    </div>
                  </footer>       
</div>
