<?php
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0
 */
class Plugin {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get_scripts($name_js_ccs) {
        wp_enqueue_script($name_js_ccs);
    }
    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        
        // Its is now safe to include Widgets files

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search_popup/search_popup.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/sign_in/sign_in.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/cart_use/cart_use.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/products/products.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/category/categories_services.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/category/category_aside_shop_page.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/category/category_posts_petty.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/category/category_posts_services.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/post/posts.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/video/video.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/post_aside/post_aside.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/filter_atribute/filter_atribute.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/filter_price/filter_price.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/call_us_petty/call_us_petty.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/ellipse_wellcome_petty/ellipse_wellcome_petty.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/services/services.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/comment_review/comment_review.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/testimonial_slider/testimonial_slider.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/the_veterinarians/the_veterinarians.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/pet_care/pet_care.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/gallery/gallery.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tags/tags.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/send_us_and_call_us/send_us_and_call_us.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/infomation/infomation.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/logo_under_title/logo_under_title.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/lists_page/lists_page.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/category_product/category_product.php');
        


        // Register Widgets

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Search_popup());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Sign_in());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Cart_use());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Products());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Categories_Services());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Posts());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Video());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Posts_aside());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Category_Aside_Shop_Page());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Category_Posts_Petty());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Category_Posts_Services());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Call_us_petty());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Ellipse_wellcome_petty());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Services());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Comment_review());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Pet_Cares());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Gallery());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Testimonial_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\The_veterinarians());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Tags());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Send_Us_And_Call_Us());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Infomation());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Logo_Under_Title());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Lists_Page());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Category_Product());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Product_Atribute_Filter());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Product_Price_Filter());
        
    }
    public function register_categoris() {
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-elements', ['title' => esc_html__('JWS Themes Widget', 'fatcy'), 'icon' => 'fa fa-plug', ], 1);
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-education', ['title' => esc_html__('JWS Education', 'fatcy'), 'icon' => 'fa fa-plug', ], 1);
    }
    
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {

        add_action('init', array($this, 'register_categoris'));
        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

    }
}
// Instantiate Plugin Class
Plugin::instance();