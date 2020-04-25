<?php 
$args = array(
            'post_type' => 'post',
            'post_status'    => 'publish',
            'posts_per_page' =>2,
        );
         $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );
            $args['orderby'] = 'date';
            $args['order']   = 'desc';
        $the_query = new \WP_Query( $args );
        $comments_number = get_comments_number(); 
        
        ?>
        <ul class="wapper-post <?php echo $settings['layout']; ?>">
            <?php 
                $i = 1;
                while ( $the_query->have_posts() ) : $the_query->the_post(); 
                $position = ($i%2 == 0) ? esc_attr('box-right') : esc_attr('box-left'); 
                ?>
                <li class="container-post <?php echo $position ?>">
                    <div class="post_thumbnail">
                        <?php
                                $attach_id = get_post_thumbnail_id();
                                $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "420x280", 'class' => 'attachment-large wp-post-image'));
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
                            <span class="pettyicon petty-icon005-visibility">
                               <span class="count-view"><?php echo getPostViews(get_the_ID()); ?></span>
                            </span>
                            <span class="divider">|</span>
                            <span class="like">
                                <span class="pettyicon petty-icon002-like"></span>
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
                <?php $i ++;?>
           <?php endwhile; ?>
            <!-- end of the loop -->

            <!-- pagination here -->
            
            <?php wp_reset_postdata(); ?>
           
        </ul>
