<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Sign_in extends Widget_Base {

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
        return 'Sign-in';
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
        return __( 'Sign-in', 'plugin-name' );
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
            return 'far fa-user';
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
            'icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-user',
                    'library' => 'solid',
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
                    '{{WRAPPER}} .my-icon-wrapper' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'widget_title',
            [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default title', 'plugin-domain' ),
                'placeholder' => __( 'Type your title here', 'plugin-domain' ),
            ],

        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'plugin-domain' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .widget_title',
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

        <div class="login">
          <a class="jws-sign-in" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); //-->cái này link tới trang Acount?>">       
            <?php
            echo '<span class="widget_title">' . $settings['widget_title'] . '</span>';
            echo ( $html ) ? $html : $settings['url'];   
            ?>
            <span class="my-icon-wrapper">
                <?php 
                \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                ?>
            </span>
        </a>
        <?php  if(!get_current_user_id()) {  //-->kiểm tra đã đang nhập hay chưa?>
            <div id="from-login">
                <span id="close-login">X</span>
                <?php  wc_get_template( 'myaccount/form-login.php'); //-->nếu chưa có sẽ hiên from này?>
            </div>
        <?php  }else { //nếu có rồi thì hiện My Acount và Logout?>
            <div class="form-loged">
                <ul class="menu-acuont">
                    <li class="item-acount"><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); //-->cái này link tới trang Acount?>" class="link-acount logout">My Accout</a></li>
                    <li class="item-acount"><a href="<?php echo wp_logout_url(); //-->code này dùng để đăng xuất khỏi Acount?>" class="link-acount logout">Logout</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
    <?php
}
}