<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="container-post">
        <div class="post_thumbnail">
            <?php
            $attach_id = get_post_thumbnail_id();
            $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "875x405", 'class' => 'attachment-large wp-post-image'));
            echo wp_kses_post($img['thumbnail']);
            ?>
        </div>
        <div class="content">
            <h2 class="post-title" >
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2>
            <div class="jws-row">
                <div class="jws-col-7">
                    <?php
                    if ( 'post' === get_post_type() ) {
                        echo '<div class="entry-meta">';
                        ?>
                        <?php 
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<a class="link-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span class="cat-post-name">' . esc_html( $categories[0]->name ) . '</span></a>';
                        }
                        ?>
                        <span class="line-column">|</span>

                        <?php 
                        $archive_year  = get_the_time( 'Y' ); 
                        $archive_month = get_the_time( 'm' ); 
                        $archive_day   = get_the_time( 'd' ); 
                        ?>
                        <a class="link-date" href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                            <span class="date"><?php echo get_the_date();?></span>
                        </a>

                        <span class="line-column">|</span>

                        <a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="link-info-author">
                            <span class="name"><?php echo get_the_author();?></span>
                        </a>
                        <?php
                        echo '</div><!-- .entry-meta -->';
                    }; ?>
                </div><!-- .jws-col-10 -->

                <div class="jws-col-5">
                    <div class="container-view-favorite-comment">
                        <div class="wrapp-view-favorite-comment">   
                            <div class="view-favorite-comment">
                                <span class="view"><i class="pettyicon petty-icon005-visibility"></i><span class="count"><?php echo getPostViews(get_the_ID()); ?></span></span>
                                <span class="line-column">|</span>
                                <span class="favorite"><i class="pettyicon petty-icon002-like"></i><?php echo esc_attr(post_favorite());  ?></span>
                                <span class="line-column">|</span>
                                <span class="comment"><i class="icons-c-u icon-s-c-uth-list-1"></i><span class="count"><?php echo get_comments_number(); ?></span></span>
                            </div><!-- .view-favorite-commnet -->
                        </div><!-- .wrapp-view-favorite-commnet -->
                    </div><!-- .container-view-favorite-commnet -->
                </div><!-- .jws-col-2 -->
            </div><!-- .jws-row --->
            <p class="post-description"><?php echo get_the_excerpt(); ?></p>
            
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
<?php jws_query_pagination($the_query->max_num_pages) ;?>

<?php wp_reset_postdata(); ?>