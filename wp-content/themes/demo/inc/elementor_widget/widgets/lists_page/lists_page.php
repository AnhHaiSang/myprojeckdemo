<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Lists_Page extends Widget_Base {
 
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
        return 'Lists Page';
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
        return __( 'Lists Page', 'plugin-name' );
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
            return 'fas fa-eject';
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
        $this->add_control( //option chỉ định category hiển thị theo cái gì (ví dụ: ở đây hiển thị theo default)
            'orderby_page',
            [
                'label'     => __( 'Order by', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'menu_order',
                'options'   => [
                    'id'       => __( 'Id', 'fatcy' ),
                    'date'       => __( 'Date', 'fatcy' ),
                    'title'      => __( 'Title', 'fatcy' ),
                    'price'      => __( 'Price', 'fatcy' ),
                    'popularity' => __( 'Popularity', 'fatcy' ),
                    'rating'     => __( 'Rating', 'fatcy' ),
                    'rand'       => __( 'Random', 'fatcy' ),
                    'menu_order' => __( 'Menu Order', 'fatcy' ),
                ]            ]
        );
        $this->add_control( //options sắp xếp hiển thị của category A-Z hoặc Z-A
            'order_page',
            [
                'label'     => __( 'Order', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'asc',
                'options'   => [
                    'desc' => __( 'Descending', 'fatcy' ),//hiển thị theo chiều ngược Z-A
                    'asc'  => __( 'Ascending', 'fatcy' ),//hiển thị theo chiều thuận A-Z
                ]            ]
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
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_lists_page',
                'label' => __( 'Border', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} ul.container-lists_page li.container-post',
            ]
        );
       
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_lists_page',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} ul.container-lists_page li.container-post',
            ]
        );
        $this->add_control(
            'margin_lists_page',
            [
                'label' => __( 'Margin', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} ul.container-lists_page li.container-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'padding_lists_page',
            [
                'label' => __( 'Padding', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .container-lists_page li.container-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'content_section_2',
            [
                'label' => __( 'Title', 'plugin-name' ),
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
                    '{{WRAPPER}} .container-lists_page li.container-post' => 'text-align: {{VALUE}}',
                ],
            ],
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.container-lists_page li.container-post a.link-page' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_lists_page',
                'label' => __( 'Typography', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ul.container-lists_page li.container-post',
            ]
        );
        $this->add_control(
            'padding_title_page',
            [
                'label' => __( 'Padding', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} ul.container-lists_page li.container-post a.link-page' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

        $html = wp_oembed_get( $settings['url'] );   
        $args = array(
            'post_type' => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => $settings['posts_per_page'] ,

        );
        $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby_page'], $settings['order_page'] );
        $orderby = $settings['orderby_page'];
        $order = $settings['order_page'];
        $the_query = new \WP_Query( $args );
        $comments_number = get_comments_number();
        
        ?>
        <ul class="container-lists_page <?php echo $settings['layout']; ?>" id="lists_page">
   
            <?php if ( $the_query->have_posts() ) : ?>
                <?php 
                $i = 1;   
                while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $position = ($i == 2 || $i == 5 || $i == 8) ? esc_attr('between') : '';?>
                <li class="container-post <?php echo $position ?>">
                    <a href="<?php the_permalink(); ?>" class="link-page">
                        <!-- title của post -->
                        <span class="page-name"></span><?php echo get_the_title(); ?>
                    </a>
                </li>
            <?php $i ++;?>
        <?php endwhile; ?>
            <?php else : ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </ul>
    <?php 
    }
}