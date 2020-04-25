 <?php 
    $i = 1;   
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
    $position = ($i == 2 || $i == 5 || $i == 8) ? esc_attr('between') : '';?>
    <li class="container-post <?php echo $position ?>">
        <div class="post_thumbnail">
            <?php
            $attach_id = get_post_thumbnail_id();
            $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "375x255", 'class' => 'attachment-large wp-post-image'));
            echo wp_kses_post($img['thumbnail']);
            ?>
            <div class="connet-services-single">
                <a href="<?php the_permalink(); ?>" class="link-single-services">
                    <span class="icon-connet"><i class="fas fa-link"></i></span>
                </a>
            </div>
        </div>
        <div class="title-description">
            <h2 class="post-title">
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2> 
            <p class="post-description"><?php echo get_the_excerpt(); ?></p>
            <div class="position-link">
                <a href="<?php the_permalink(); ?>" class="link-single-post a-single">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
            </div>
            
        </div>
    </li>
    <?php $i ++;?>
<?php endwhile; ?>
<!-- end of the loop -->
<!-- pagination here -->

<?php wp_reset_postdata(); ?>