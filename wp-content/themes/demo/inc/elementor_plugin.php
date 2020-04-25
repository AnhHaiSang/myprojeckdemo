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
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/sign-in/sign-in.php');

        // Register Widgets

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Search_popup());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Sign_in());

        
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