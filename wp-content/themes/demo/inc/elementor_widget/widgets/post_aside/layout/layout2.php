<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="container-post">
        <div class="post_thumbnail">
            <div class="img-post-aside">
                <?php
                $attach_id = get_post_thumbnail_id();
                $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => "88x88", 'class' => 'attachment-large wp-post-image'));
                echo wp_kses_post($img['thumbnail']);
                ?>
            </div>
        </div>
        <div class="title">
            <h2 class="post-title" >
                <!--  tạo đường dẫn tới single post page  -->
                <a href="<?php the_permalink(); ?>" class="link-single-post">
                    <!-- title của post -->
                    <?php echo get_the_title(); ?>
                </a>
            </h2>
            <p class="date-post"><?php echo get_the_date(); ?></p>
        </div>
    </li>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>