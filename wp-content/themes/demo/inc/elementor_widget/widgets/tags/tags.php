<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tags extends Widget_Base {

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
        return 'Tags';
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
        return __( 'Tags', 'plugin-name' );
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
            return 'fas fa-tags';
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
            'text_align',
            [
                'label' => __( 'Alignment', 'plugin-domain' ),
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
                'selector' => '{{WRAPPER}} .entry-title',
            ],
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
            'title_color',
            [
                'label' => __( 'Title Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .entry-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control( //option chỉ định category hiển thị theo cái gì (ví dụ: ở đây hiển thị theo default)
            'orderby',
            [
                'label'     => __( 'Post Order By', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'price',
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
            'posts_per_page',
            [
                'label' => __( 'Number Post Display', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => __( '1', 'plugin-domain' ),
                'min' => 0,
                'max' => 100,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography Title', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_2',
                'label' => __( 'Typography Post Description', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-meta',
            ]
        );
        $this->add_control(
            'title_color2',
            [
                'label' => __( 'Time and Comment Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .entry-meta, .mgct, time' => 'color: {{VALUE}}',
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
        ?>
        <div class="tags-container <?php echo $settings['layout']; ?>">
            <?php include( 'layout/'.$settings['layout'].'.php' );?>
        </div>
    <?php
    }
}