 <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="container-post">
        <div class="post_thumbnail">
            <?php
            $attach_id = get_post_thumbnail_id();
            $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "270x270", 'class' => 'attachment-large wp-post-image'));
            echo wp_kses_post($img['thumbnail']);
            ?> 
        </div>
        <div class="content">
            <div class="categories-date">
                <span class="post-cat"><?php 
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<a class="link-post-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                    }
                    ?></span>
                    <span class="divider">|</span>
                <span class="date"><?php echo get_the_date();?></span>
            </div>
            <h2 class="post-title">
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2>
            <p class="post-description">
                <?php echo get_the_excerpt(); ?>
            </p>
             <div class="view-like">
                <span class="view">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon_view'], [ 'aria-hidden' => 'true' ] ); ?><span class="count-view"><?php echo getPostViews(get_the_ID()); ?></span>
                </span>
                <span class="divider">|</span>
                <span class="like">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon_like'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php echo esc_attr(post_favorite());  ?>
                </span>
            </div>
            <div class="read-more">
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <span class="text-redm">Read More</span>
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </li>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>