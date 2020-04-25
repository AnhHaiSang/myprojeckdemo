<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Products extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'Products';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Products', 'plugin-name' );
    }
        /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
        public function get_icon() {
            return 'fab fa-product-hunt';
        }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'jws-elements' ];
    }


    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __( 'URL to embed', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'https://your-link.com', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'layout1',
                'options' => [
                    'layout1'  => __( 'layout1', 'plugin-domain' ),
                    'layout2' => __( 'layout2', 'plugin-domain' ),
                    'layout3' => __( 'layout3', 'plugin-domain' ),
                    'layout4' => __( 'layout4', 'plugin-domain' ),
                    'layout5' => __( 'layout5', 'plugin-domain' ),
                ],
            ]
        );
        $this->add_control( //option chỉ định category hiển thị theo cái gì (ví dụ: ở đây hiển thị theo default)
            'orderby',
            [
                'label'     => __( 'Order by', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'price',
                'options'   => [
                    'id'       => __( 'Id', 'fatcy' ),
                    'date'       => __( 'Date', 'fatcy' ),
                    'title'      => __( 'Title', 'fatcy' ),
                    'price'      => __( 'Price', 'fatcy' ),
                    'popularity' => __( 'Popularity', 'fatcy' ),
                    'rating'     => __( 'Rating', 'fatcy' ),
                    'rand'       => __( 'Random', 'fatcy' ),
                    'menu_order' => __( 'Menu Order', 'fatcy' ),
                ],
            ]
        );
        $this->add_control( //options sắp xếp hiển thị của category A-Z hoặc Z-A
            'order',
            [
                'label'     => __( 'Order', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'desc' => __( 'Descending', 'fatcy' ),//hiển thị theo chiều ngược Z-A
                    'asc'  => __( 'Ascending', 'fatcy' ),//hiển thị theo chiều thuận A-Z
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number product', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => __( '', 'plugin-domain' ),
                'min' => 0,
                'max' => 100,
            ]
        );

        $this->end_controls_section();
        //==================cotrol text
        $this->start_controls_section(
            'content_section2',
            [
                'label' => __( 'Title', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} a.woocommerce-loop-product.link-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography Titel', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} a.woocommerce-loop-product.link-title',
            ]
        );

        $this->end_controls_section();
        //==================price============================
        $this->start_controls_section(
            'content_section3',
            [
                'label' => __( 'Price', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_align_title',
            [
                'label' => __( 'Text Align', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugin-domain' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'plugin-domain' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugin-domain' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                 'selectors' => [
                    '{{WRAPPER}} li.product' => 'text-align: {{VALUE}}',
                ],
            ],
        );
        $this->add_control(
            'title_color_normal',
            [
                'label' => __( 'Price Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} span.woocommerce-Price-amount.amount.price-item' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_price',
                'label' => __( 'Typography Price', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} span.woocommerce-Price-amount.amount.price-item',
            ]
        );
        $this->add_control(
            'title_color_del',
            [
                'label' => __( 'Del Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} del.not-sale>span.woocommerce-Price-amount.amount.price-item' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography2',
                'label' => __( 'Typography Del', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} del.not-sale>span.woocommerce-Price-amount.amount.price-item',
            ]
        );

        $this->add_control(
            'title_color_ins',
            [
                'label' => __( 'Ins Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} ins.saled>span.woocommerce-Price-amount.amount.price-item span.woocommerce-Price-amount.amount.price-item' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography3',
                'label' => __( 'Typography Ins', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ins.saled>span.woocommerce-Price-amount.amount.price-item ',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        echo $settings['custom_html'];

        $html = wp_oembed_get( $settings['url'] );   ?>

        <div class="wapper-products woocommerce">
         <ul class="container-products <?php echo $settings['layout']; ?>">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $settings['posts_per_page'] , 
            );
            $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );
            $args['orderby'] = $ordering_args['orderby'];
            $args['order']   = $ordering_args['order'];
            $loop = new \WP_Query( $args );
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) : $loop->the_post();
                    if($settings['layout'] == 'layout2') {
                        wc_get_template_part( 'content', 'product2' ); 
                    }elseif($settings['layout'] == 'layout1'){
                       wc_get_template_part( 'content', 'product' );
                    }elseif($settings['layout'] == 'layout3'){
                       wc_get_template_part( 'content', 'product3' );
                    }elseif($settings['layout'] == 'layout4'){
                       wc_get_template_part( 'content', 'product4' );
                    }elseif($settings['layout'] == 'layout5'){
                       wc_get_template_part( 'content', 'product_petty_1' );
                    }
               endwhile;
           } else {
            echo __( 'No products found' );
        }
        wp_reset_postdata();
        ?>
    </ul><!--/.products-->
</div>
<?php
}
}