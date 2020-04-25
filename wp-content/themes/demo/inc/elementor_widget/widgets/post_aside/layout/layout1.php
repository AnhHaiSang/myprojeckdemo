  <!-- pagination here -->
             
                <!-- the loop -->
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li class="item">
                        <?php
                            if ( 'post' === get_post_type() ) {
                                echo '<div class="entry-meta">';
                                echo get_the_date();
                                echo '<span class="mgct">&nbsp;/</span>';?>
                                <span class="cmt">
                                    comments &nbsp;:&nbsp;
                                    <?php echo get_comments_number(); ?>
                                </span>
                                
                                <?php
                                echo '</div><!-- .entry-meta -->';
                            };

                            if ( is_single() ) {
                                the_title( '<h1 class="entry-title">', '</h1>' );
                            } elseif ( is_front_page() && is_home() ) {
                                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            } else {
                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                            }
                        ?>
                    </li>
                <?php endwhile; ?>
                <!-- end of the loop -->
             
                <!-- pagination here -->
             
                <?php wp_reset_postdata(); ?>