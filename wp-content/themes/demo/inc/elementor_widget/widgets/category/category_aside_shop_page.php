<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Category_Aside_Shop_Page extends Widget_Base {
 
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
        return 'Category aside shop page';
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
        return __( 'Category aside shop page', 'plugin-name' );
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
            'orderby_product',
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
            'order_product',
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
                    '{{WRAPPER}} .list-category' => 'color: {{VALUE}}',
                ],
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
                'selector' => '{{WRAPPER}} .list-category',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-category',
            ]
        );
       
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .item',
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
        $html = wp_oembed_get( $settings['url'] );
        
        ?>
        <ul class="list-cat"> 
            <!-- options -->
            <?php 
            $orderby = $settings['orderby_product'];
            $order = $settings['order_product'];
            $hide_empty = true ;
            $cat_args = array(
                'orderby'   => $orderby,
                'order'   => $order,
                'hide_empty' => $hide_empty,
            );
            $product_categories = get_terms( 'product_cat', $cat_args );

            if( !empty($product_categories) ){
                ?>  <?php
                foreach ($product_categories as $key => $category) {
                //var_dump($category);
            ?> 
                <li class="items" >
                    <p class="cat-name">
                        <a href="<?php echo get_term_link($category);?>" class="woocommerce list-category">
                            <span class="checked">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="category_name"><?php echo $category->name ?></span>
                            <span class="count"><?php echo $category->count ?></span>
                        </a>
                    </p>
                </li>
                <?php
                }
            ?>
        </ul>
        <?php

        }
    }
}