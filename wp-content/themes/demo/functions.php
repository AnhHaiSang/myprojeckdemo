<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
if (!defined('JWS_ABS_PATH')) define('JWS_ABS_PATH', get_template_directory());
/*
   * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
   * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
   */
if (!defined('JWS_URI_PATH')) define('JWS_URI_PATH', get_template_directory_uri());
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'twentyseventeen' ),
			'social' => __( 'Social Links Menu', 'twentyseventeen' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);
	add_theme_support( 'woocommerce' );
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'twentyseventeen' ),
			'id'            => 'shop_sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Sidebar ShopDetail', 'twentyseventeen' ),
			'id'            => 'sidebar_shopdetail',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'twentyseventeen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'twentyseventeen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Aside Single Post Petty', 'twentyseventeen' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Add widgets here to appear in your section.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Aside Single Services Petty', 'twentyseventeen' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Add widgets here to appear in your section.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts() {
	// -----------------------------includes file .css của font--------------------------
	wp_enqueue_style( 'flaticon', JWS_URI_PATH . '/assets/font/fontflaticon/style.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file .css của font EarlyBrid--------------------------
	wp_enqueue_style( 'EarlyBrid', JWS_URI_PATH . '/assets/font/EarlyBrid/stylesheet.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file .css của font Poppin--------------------------
	wp_enqueue_style( 'Poppin', JWS_URI_PATH . '/assets/font/poppin/style.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file .css của font Rubik--------------------------
	wp_enqueue_style( 'Rubik', JWS_URI_PATH . '/assets/font/rubik/style.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file .css của mình--------------------------
	wp_enqueue_style( 'jws-style', JWS_URI_PATH . '/assets/css/style.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file bootstrap của mình--------------------------
	wp_enqueue_style( 'jws-bootstrap', JWS_URI_PATH . '/assets/css/slick/slick.css',  wp_get_theme()->get( 'Version' ), 'all' );
	wp_enqueue_style( 'jws-slick-theme', JWS_URI_PATH . '/assets/css/slick/slick-theme.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file slick của mình--------------------------
	wp_enqueue_style( 'jws-slick', JWS_URI_PATH . '/assets/css/bootstrap/bootstrap.css',  wp_get_theme()->get( 'Version' ), 'all' );
	// -----------------------------includes file .js của mình--------------------------
	wp_enqueue_script( 'main-js', get_theme_file_uri( '/assets/js/main.js' ), array(), '20161114', true );
	// -----------------------------includes file wishlist.js của mình--------------------------
	wp_enqueue_script( 'wishlist-js', get_theme_file_uri( '/assets/js/wishlist/wishlist.js' ), array(), true );
	// -----------------------------includes file slick.js của mình--------------------------
	wp_enqueue_script( 'slick-js', get_theme_file_uri( '/assets/js/slick/slick.js' ), array(), true );
	// -----------------------------includes file slick.min.js của mình--------------------------
	wp_enqueue_script( 'slick-min-js', get_theme_file_uri( '/assets/js/slick/slick.min.js' ), array(), true );
	// -----------------------------includes file slick.min.js của mình--------------------------
	wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/isotope/isotope.pkgd.js' ), array(), true );




	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentyseventeen-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20190328' );
	// Add custom fonts.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles' );




/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Elemtor Custom
 */
require get_parent_theme_file_path( '/inc/elementor_widget/elementor_plugin.php' );
/**
 * Like Custom
 */
require get_parent_theme_file_path( '/inc/like.php' );
/**
 * Theme Option
 */
require get_parent_theme_file_path( '/inc/theme-option.php' );
/**
 * Create Post Type Services
 */
require get_parent_theme_file_path( '/inc/services.php' ); 
/**
 *  Create Post Type The Veterinarians
 */
require get_parent_theme_file_path( '/inc/the_veterinarians.php' );
/**
 * Custom Menu 
 */
require get_parent_theme_file_path( '/inc/custom_walker.php' );






/**
@---------post type services---------------
**/
add_filter('pre_get_posts','lay_custom_post_type');
function lay_custom_post_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('post','services'));
    return $query;
}
/**
		 * Create a taxonomy category for job
		 *
		 * @uses  Inserts new taxonomy object into the list
		 * @uses  Adds query vars
		 *
		 * @param string  Name of taxonomy object
		 * @param array|string  Name of the object type for the taxonomy object.
		 * @param array|string  Taxonomy arguments
		 * @return null|WP_Error WP_Error if errors, otherwise null.
		 */
		
		$labels = array(
			'name'					=> _x('Services Categories', 'Taxonomy plural name', 'zahar' ),
			'singular_name'			=> _x('ServicesCategory', 'Taxonomy singular name', 'zahar' ),
			'search_items'			=> esc_html__( 'Search Categories', 'zahar' ),
			'popular_items'			=> esc_html__( 'Popular Job Categories', 'zahar' ),
			'all_items'				=> esc_html__( 'All Job Categories', 'zahar' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'zahar' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'zahar' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'zahar' ),
			'update_item'			=> esc_html__( 'Update Category', 'zahar' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'zahar' ),
			'new_item_name'			=> esc_html__( 'New Category', 'zahar' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'zahar' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'zahar' ),
			'menu_name'				=> esc_html__( 'Category', 'zahar' ),
		);
	
		$args = array(
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_cat' ),
		);
            register_taxonomy( 'services_cat', array( 'services' ), $args  );
        
/**
@---------post type the veterinarians---------------
**/
add_filter('pre_get_posts','lay_custom_post_type_the_veterinarians');
function lay_custom_post_type_the_veterinarians($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('post','the_veterinarians'));
    return $query;
}
/**
		 * Create a taxonomy category for job
		 *
		 * @uses  Inserts new taxonomy object into the list
		 * @uses  Adds query vars
		 *
		 * @param string  Name of taxonomy object
		 * @param array|string  Name of the object type for the taxonomy object.
		 * @param array|string  Taxonomy arguments
		 * @return null|WP_Error WP_Error if errors, otherwise null.
		 */
		
		$labels = array(
			'name'					=> _x('The Veterinaarians Categories', 'Taxonomy plural name', 'zahar' ),
			'singular_name'			=> _x('The Veterinaarian Category', 'Taxonomy singular name', 'zahar' ),
			'search_items'			=> esc_html__( 'Search Categories', 'zahar' ),
			'popular_items'			=> esc_html__( 'Popular Job Categories', 'zahar' ),
			'all_items'				=> esc_html__( 'All Job Categories', 'zahar' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'zahar' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'zahar' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'zahar' ),
			'update_item'			=> esc_html__( 'Update Category', 'zahar' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'zahar' ),
			'new_item_name'			=> esc_html__( 'New Category', 'zahar' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'zahar' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'zahar' ),
			'menu_name'				=> esc_html__( 'Category', 'zahar' ),
		);
	
		$args = array(
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'the_veterinarians_cat' ),
		);
            register_taxonomy( 'the_veterinarians_cat', array( 'the_veterinarians' ), $args  );
/**
@ Chèn CSS và Javascript vào theme
**/
function jwstheme_init() {
	global $jws_option;
	require_once JWS_ABS_PATH . '/inc/less_to_css.php';
}
add_action( 'init', 'jwstheme_init' );


// ---------------------------compare-----------------------------
/**
 * Add add compare 
 */
function tb_add_compare_link( $product_id = false, $args = array() ) {
	extract( $args );

	if ( ! $product_id ) { 
		global $product;
		$product_id = $product->get_id();
	}

	// return if product doesn't exist
	if ( empty( $product_id ) ) return;
	
	$action_add ='yith-woocompare-add-product';
	$url_args = array(
					'action' => 'yith-woocompare-add-product',
					'id' => $product_id
				);
	$add_product_url = wp_nonce_url( add_query_arg( $url_args ), $action_add );
	printf( '<div class="woocommerce product compare-button">
		<a href="%s" class="%s button" data-product_id="%d" title="%s"><span class="flaticon-repeat-2"></span></a>
		</div>', $add_product_url, 'compare', $product_id, 'Compare', 'Compare' );
}


// ---------------------------compare-----------------------------
/**
 * Add add compare 
 */
function tb_add_compare_link2( $product_id = false, $args = array() ) {
	extract( $args );

	if ( ! $product_id ) { 
		global $product;
		$product_id = $product->get_id();
	}

	// return if product doesn't exist
	if ( empty( $product_id ) ) return;
	
	$action_add ='yith-woocompare-add-product';
	$url_args = array(
					'action' => 'yith-woocompare-add-product',
					'id' => $product_id
				);
	$add_product_url = wp_nonce_url( add_query_arg( $url_args ), $action_add );
	printf( '<div class="woocommerce product compare-button">
		<a href="%s" class="%s button" data-product_id="%d" title="%s"><span class="fas fa-random"></span></a>
		</div>', $add_product_url, 'compare', $product_id, 'Compare', 'Compare' );
}
// ----------------------------quick view-------------------------------


/**
 * Add quick view button in wc product loop
 */
function tb_add_quick_view_button() {

	global $product;

	echo '<a href="#" class="button yith-wcqv-button" data-product_id="' . $product->get_id() . '"><span class="flaticon-magnifying-glass"></span></a>';
}


// --------------------------wishlist----------------------------------

if ( ! function_exists( 'jws_product_wishlist_button' ) ) {
	/**
	 * Add wishlist Button to Product Image
	 */
	function jws_product_wishlist_button() {
		$icon = get_theme_mod( 'wishlist_icon', 'heart' );
		if ( ! $icon ) $icon = 'heart';
		?>
		<div class="wishlist-icon">
			<button class="wishlist-button button is-outline circle icon" aria-label="<?php echo __( 'Wishlist', 'jws' ); ?>">
				<span class="lnr lnr-heart"><i class="far fa-heart"></i></span>
				<div class="add-to-wishlist">
					<span class="text">Add to Wishlist</span>
				</div>
			</button>
			<div class="wishlist-popup dark">
				<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
			</div>
			
		</div>
		<?php
	}
}
if ( ! function_exists( 'jws_update_wishlist_count' ) ) {
	/**
	 * Update Wishlist Count
	 */
	function jws_update_wishlist_count() {
		wp_send_json( YITH_WCWL()->count_products() );
	}
}
add_action( 'wp_ajax_jws_update_wishlist_count', 'jws_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_jws_update_wishlist_count', 'jws_update_wishlist_count' );

// -----------------------------------------------------------------------------------------

remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle',15);

function abChangeProductsTitle() {
            echo '<h2 class="woocommerce-loop-product__title"><a class="woocommerce-loop-product link-title" href="'.get_the_permalink().'">' . get_the_title() . '</a></h2>';
}

// -----------------------------------------------------------------------------------------
if( ! function_exists( 'jws_product_label' ) ) {
	function jws_product_label() {
		global $product;

		$output = array();

		if ( $product->is_on_sale() ) {

			$percentage = '';

			if ( $product->get_type() == 'variable' ) {

				$available_variations = $product->get_variation_prices();
				$max_percentage = 0;

				foreach( $available_variations['regular_price'] as $key => $regular_price ) {
					$sale_price = $available_variations['sale_price'][$key];

					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
					}
				}

				$percentage = $max_percentage;
			} elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) ) {
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}

			if ( $percentage ) {
				$output[] = '<span class="onsale jws_pr_label">-' . $percentage . '%' . '</span>';
			}else{
				$output[] = '<span class="onsale jws_pr_label">' . esc_html__( 'Sale', 'fatcy' ) . '</span>';
			}
		}
		
		if( !$product->is_in_stock() && $product->get_type() != 'variable' ){
			$output[] = '<span class="out-of-stock jws_pr_label">' . esc_html__( 'Sold out', 'fatcy' ) . '</span>';
		}

		if ( $product->is_featured()) {
			$output[] = '<span class="featured jws_pr_label">' . esc_html__( 'Hot', 'fatcy' ) . '</span>';
		}
		
		if ( get_post_meta( get_the_ID(), 'wiki_test_checkbox', true )) {
			$output[] = '<span class="new jws_pr_label">' . esc_html__( 'New', 'fatcy' ) . '</span>';
		}
		
		
		if ( $output ) {
			echo '<div class="jws_pr_labels">' . implode( '', $output ) . '</div>';
		}
	}
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'jws_product_label', 1 );
add_action( 'woocommerce_before_single_product_summary', 'jws_product_label', 1 );
add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );


/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'test_metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
		'name' => 'Test Checkbox',
		'desc' => 'field description (optional)',
		'id'   => 'wiki_test_checkbox',
		'type' => 'checkbox',
	) );
	// Add other metaboxes as needed
}

remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',10);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_rating', 10 );
/*------------------------------------------------------------------------------------------*/

if (!function_exists('jws_shop_page_link')) {
    function jws_shop_page_link($keep_query = false, $taxonomy = '')
    {
        // Base Link decided by current page
        if (defined('SHOP_IS_ON_FRONT')) {
            $link = home_url();
        } elseif (is_post_type_archive('product') || is_page(wc_get_page_id('shop'))) {
            $link = get_post_type_archive_link('product');

        } elseif (is_product_category()) {
            $link = get_term_link(get_query_var('product_cat'), 'product_cat');
        } elseif (is_product_tag()) {
            $link = get_term_link(get_query_var('product_tag'), 'product_tag');
        } else {
            $link = get_term_link(get_query_var('term'), get_query_var('taxonomy'));
        }

        if ($keep_query) {

            // Min/Max
            if (isset($_GET['min_price'])) {
                $link = add_query_arg('min_price', wc_clean($_GET['min_price']), $link);
            }

            if (isset($_GET['max_price'])) {
                $link = add_query_arg('max_price', wc_clean($_GET['max_price']), $link);
            }

            // Orderby
            if (isset($_GET['orderby'])) {
                $link = add_query_arg('orderby', wc_clean($_GET['orderby']), $link);

            }


            if (isset($_GET['columns'])) {
                $link = add_query_arg('columns', wc_clean($_GET['columns']), $link);
            }


            if (isset($_GET['container_shop'])) {
                $link = add_query_arg('container_shop', wc_clean($_GET['container_shop']), $link);
            }


            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if (get_search_query()) {
                $link = add_query_arg('s', rawurlencode(wp_specialchars_decode(get_search_query())), $link);
            }

            // Post Type Arg
            if (isset($_GET['post_type'])) {
                $link = add_query_arg('post_type', wc_clean($_GET['post_type']), $link);
            }

            // Min Rating Arg
            if (isset($_GET['min_rating'])) {
                $link = add_query_arg('min_rating', wc_clean($_GET['min_rating']), $link);
            }

            // All current filters
            if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) {

                foreach ($_chosen_attributes as $name => $data) {
                    if ($name === $taxonomy) {
                        continue;
                    }

                    $filter_name = sanitize_title(str_replace('pa_', '', $name));
                    if (!empty($data['terms'])) {
                        $link = add_query_arg('filter_' . $filter_name, implode(',', $data['terms']), $link);

                    }
                    if ('or' == $data['query_type']) {
                        $link = add_query_arg('query_type_' . $filter_name, 'or', $link);

                    }
                }
            }
        }

        return $link;
    }
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'jws_new_loop_shop_per_page', 20);

function jws_new_loop_shop_per_page($cols)
{
    global $jws_option;
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = $jws_option['shop_post_number'];
    return $cols;
}


add_action( 'woocommerce_single_product_summary', 'wc_product_sold_count', 11 );
function wc_product_sold_count() {
 global $product;
 $units_sold = get_post_meta( $product->get_id(), 'total_sales', true );
 
}


function get_level($category, $level = 0){
    if ($category->parent == 0) {
        return $level;
    }else{
        $level++;
        $category = get_term($category->parent);
        return get_level($category, $level);
    }
}
function display_cat_level( $taxonomy = 'category', $level = 0 , $parent = NULL){
    $output = array();      
    $catArgs = array( 'hide_empty' => false);
    if( $parent != NULL ){
        $catArgs['child_of'] = $parent;
    }       
    $catArgs['taxonomy'] = $taxonomy;
     
    $cats = get_terms( $catArgs );
             
    if( $cats && !is_wp_error($cats) ){
        $stt = 0;
        foreach($cats as $cat){
            $current_cat_level = get_level($cat);
            if( $current_cat_level == $level ){
                $output[$stt]['name'] = $cat->name;
                $output[$stt]['link'] = get_term_link($cat->term_id);
                $output[$stt]['id'] = $cat->term_id;
            }
            $stt++;
        }
    }
    return $output;
}
//=======================pagination===========================
if (!function_exists('jws_query_pagination')) {
    function jws_query_pagination($pages = '', $range = 100)
    {
        $showitems = ($range * 2);

        global $paged;
  
        if (empty($paged)) $paged = 1;

        if ($pages == '') {
            global $wp_query ;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }
 
        if (1 != $pages) {
            echo "<div class='jws-pagination-number' id='jws-pagination'>";
            echo "<ul class='lists'>";
            echo "<li class='item'><a class='prev criptal-link' href='" . get_pagenum_link($paged - 1) . "'>" . '<i class="fas fa-chevron-left"></i>' . "</a></li>";
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo wp_kses_post(($paged == $i) ? "<li class='item'><span class='item current criptal-link'><span>" . $i . "</span></span></li>" : "<li class='item'><a href='" . get_pagenum_link($i) . "' class='inactive item criptal-link' ><span>" . $i . "</span></a></li>");
                }
            }
            echo "<li class='item'><a class='next criptal-link' href='" . get_pagenum_link($paged + 1) . "'>" . '<i class="fas fa-chevron-right"></i>' . "</a></li>";
            echo "</ul>";
            echo "</div>\n";
        }
    }
}