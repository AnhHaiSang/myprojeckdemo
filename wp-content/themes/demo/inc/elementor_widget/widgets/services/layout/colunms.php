
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="wrapp-services">
        <div class="services_thumbnail">
             <?php
            $attach_id = get_post_thumbnail_id();
            $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "370x250", 'class' => 'attachment-large wp-post-image'));
            echo wp_kses_post($img['thumbnail']);
            ?>
            <div class="service-price">
            	<span class="schedule">from <span class="price">$30</span>/day</span>
            </div>
        </div>
        <div class="content">
            <h2 class="post-title">
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2>
            <p class="post-description"><?php echo get_the_excerpt(); ?></p>
        
	        <a href="<?php the_permalink(); ?>" class="link-single-post a-single">
	            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
	        </a>
        </div>
    </li>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>