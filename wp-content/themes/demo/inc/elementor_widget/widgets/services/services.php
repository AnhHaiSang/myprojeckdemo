<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Services extends Widget_Base {

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
        return 'Services';
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
        return __( 'Services', 'plugin-name' );
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
            return 'far fa-newspaper';
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
       

        $this->add_control( //option chỉ định category hiển thị theo cái gì (ví dụ: ở đây hiển thị theo default)
            'orderby',
            [
                'label'     => __( 'Post Order By', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => [
                    'id'       => __( 'Id', 'fatcy' ),
                    'date'       => __( 'Date', 'fatcy' ),
                    'title'      => __( 'Title', 'fatcy' ),
                    'popularity' => __( 'Popularity', 'fatcy' ),
                ],
            ]
        );
        $this->add_control( //options sắp xếp hiển thị của category A-Z hoặc Z-A
            'order',
            [
                'label'     => __( 'Post Order', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'desc' => __( 'Descending', 'fatcy' ),//hiển thị theo chiều ngược Z-A
                    'asc'  => __( 'Ascending', 'fatcy' ),//hiển thị theo chiều thuận A-Z
                ],
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'colunms',
                'options' => [
                    'lists'  => __( 'lists', 'plugin-domain' ),
                    'colunms' => __( 'colunms', 'plugin-domain' ),
                    'layout3' => __( 'layout3', 'plugin-domain' ),
                    'layout4' => __( 'layout4', 'plugin-domain' ),
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number Post Display', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => __( '-1', 'plugin-domain' ),
                'min' => -1,
                'max' => 100,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_service',
                'label' => __( 'Background Service', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} li.wrapp-services',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} li.wrapp-services>.content',
            ]
        );

        $this->add_responsive_control(
            'title_margin_services',
            [
                'label' => __( 'Margin Services', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} li.wrapp-services' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_services',
            [
                'label' => __( 'Padding Services', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} li.wrapp-services' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //======================content================
        $this->start_controls_section(
            'content_section_content',
            [
                'label' => __( 'Title and Description', 'plugin-name' ),
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
                    '{{WRAPPER}} ul#slider_services' => 'text-align: {{VALUE}}',
                ],
            ],
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
                    '{{WRAPPER}} h2.post-title .link-single-post' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography Title', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h2.post-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin_title',
            [
                'label' => __( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h2.post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_title',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h2.post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_2',
                'label' => __( 'Typography Post Description', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .post-description',
            ]
        );
        $this->add_responsive_control(
            'title_margin_description',
            [
                'label' => __( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} p.post-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_description',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} p.post-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //=======================date-like-view-comment===================
        $this->start_controls_section(
            'content_section_link_single',
            [
                'label' => __( 'Link Single Services Comment', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'icon_color_like_view',
            [
                'label' => __( 'Icon Like View Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'font_size-icon',
            [
                'label' => __( 'Font Size', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} a.link-single-post.a-single>i' => 'font-size: {{SIZE}}{{UNIT}};',
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
            'post_type' => 'services',
            'post_status'    => 'publish',
            'posts_per_page' => $settings['posts_per_page'] ,
        );
        $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );
            $args['orderby'] = $ordering_args['orderby'];
            $args['order']   = $ordering_args['order'];
        $the_query = new \WP_Query( $args );
        $comments_number = get_comments_number();
        
        ?>
        <ul class="container-services <?php echo $settings['layout']; ?>" id="slider_services">
   
            <?php if ( $the_query->have_posts() ) : 
                 include( 'layout/'.$settings['layout'].'.php' );?>
                <!-- pagination here -->
             
                <!-- the loop -->
            
            <?php else : ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </ul>
    

    <?php 
    }
}