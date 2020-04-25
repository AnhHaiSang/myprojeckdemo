
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="wrapp-the-veterinarians">
        <div class="the-veterinarians-thumbnail">
            <?php the_post_thumbnail( 'medium' ); ?>
            <div class="contact-the-veterinarians">
                <div class="wrapp-the-veterinarians-icon">
                    <span class="icon-item icon-fb"><?php \Elementor\Icons_Manager::render_icon( $settings['icon_fb'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <span class="icon-item icon-tw"><?php \Elementor\Icons_Manager::render_icon( $settings['icon_tw'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <span class="icon-item icon-gg"><?php \Elementor\Icons_Manager::render_icon( $settings['icon_gg'], [ 'aria-hidden' => 'true' ] ); ?></span>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="description">
                <h2 class="post-title">
                    <!--  tạo đường dẫn tới single post page  -->
                    <a href="<?php the_permalink(); ?>" class="link-single-post">
                        <!-- title của post -->
                        <?php echo get_the_title(); ?>
                    </a>
                </h2>
                <p class="post-description"><?php echo get_the_excerpt(); ?></p>
                <div class="position-a-link">
                   <a href="<?php the_permalink(); ?>" class="link-single-post a-single">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                </div>
               
            </div>
            <div class="appointment">
                <button type="button" class="button-appointment"><?php echo $settings['text_button'] ?></button>
            </div>
        </div>
    </li>
<?php endwhile; ?>
<!-- end of the loop -->
<!-- pagination here -->
<?php wp_reset_postdata(); ?>