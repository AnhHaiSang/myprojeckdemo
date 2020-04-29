<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Posts extends Widget_Base {

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
        return 'Posts';
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
        return __( 'Posts', 'plugin-name' );
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

        $this->add_control(
            'widget_title',
            [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default title', 'plugin-domain' ),
                'placeholder' => __( 'Type your title here', 'plugin-domain' ),
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
                'default' => 'layout1',
                'options' => [
                    'layout1'  => __( 'layout1', 'plugin-domain' ),
                    'layout2' => __( 'layout2', 'plugin-domain' ),
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
        
        $this->add_control(
            'icon_like',
            [
                'label' => __( 'Icon Like', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
         $this->add_control(
            'icon_view',
            [
                'label' => __( 'Icon View', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .content',
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
                    '{{WRAPPER}} .title .content' => 'text-align: {{VALUE}}',
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
        $this->end_controls_section();
        //=======================date-like-view-comment===================
        $this->start_controls_section(
            'content_section_date_like_view_comment',
            [
                'label' => __( 'Date Time View Comment', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title_color_date',
            [
                'label' => __( 'Date Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .categories-date , a.link-post-cat, span.date, .categories-date>span.divider, span.cat-post-name, span.name, a.link-cat, span.cat-post-name, a.link-info-author, span.name, .entry-meta>span.line-column' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_date',
                'label' => __( 'Typography Date', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} li.container-post .content .categories-date span.post-cat a.link-post-cat, li.container-post .content .categories-date span.date, .entry-meta, a.link-cat>span.cat-post-name, a.link-date>span.date, a.link-info-author>span.name',
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
                    '{{WRAPPER}} span.view, span.like, .view-like>span.divider, 
                    {{WRAPPER}} span.like a.jws-btn.jws-love, 
                    {{WRAPPER}} .view-favorite-comment>span.line-column, span.view, span.view>i , span.count , span.favorite, span.favorite>i, span.favorite>a, span.comment, span.comment>i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_like_view',
                'label' => __( 'Typography Like View', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .view-like, span.view, span.like, .view-favorite-comment>span.line-column, span.view, span.view>i , span.count-view, span.count , span.favorite, span.favorite>i, span.favorite>a, span.comment, span.comment>i',
            ]
        );
        $this->end_controls_section();
        //=======================read more===================
        $this->start_controls_section(
            'content_section_read_more',
            [
                'label' => __( 'Read More Comment', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title_color_read',
            [
                'label' => __( 'Read More Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} span.text-redm, i.fas.fa-angle-double-right' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_read_more',
                'label' => __( 'Typography Date', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} span.text-redm',
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
            'post_type' => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $settings['posts_per_page'] ,

        );
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
        $args['paged'] = $paged;
        $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );
            $args['orderby'] = $ordering_args['orderby'];
            $args['order']   = $ordering_args['order'];
        $the_query = new \WP_Query( $args );
        $comments_number = get_comments_number();  
        ?>
        <ul class="wapper-post <?php echo $settings['layout']; ?>">
   
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