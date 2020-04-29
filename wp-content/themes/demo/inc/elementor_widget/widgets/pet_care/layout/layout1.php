<div class="row row-eq-height">
    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <div class="pet_care_content">
            <h2 class="testimonials_title"><?php echo wp_kses_post($item['list_title']); ?></h2>
            <div class="testimonials_description"><?php echo wp_kses_post($item['list_description']); ?></div>
        </div>
    </div>
</div> 