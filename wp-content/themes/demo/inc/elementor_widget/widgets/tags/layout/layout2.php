<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <li class="container-post">
        <div class="post_thumbnail">
            <div class="img-post-aside">
                <?php the_post_thumbnail( 'medium' ); ?>
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