 <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="container-post">
        <div class="post_thumbnail">
            <?php the_post_thumbnail( 'medium' ); ?>
            <div class="date-like-cmt">
                <div class="date">
                    <?php echo get_the_date();?>
                </div>
                <div class="like-cmt">
                    <span class="cmt">
                        <i class="fas fa-comment-alt"></i>
                        <?php echo $comments_number; ?>
                    </span>
                    <span class="like">
                        <?php echo esc_attr(post_favorite());  ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="title">
            <h2 class="post-title">
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2>
            <p class="post-description"><?php echo get_the_excerpt(); ?></p>
        </div>
    </li>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>