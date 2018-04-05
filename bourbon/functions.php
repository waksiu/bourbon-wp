<?php
/**
 * Bourbon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bourbon
 */

if ( ! function_exists( 'bourbon_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bourbon_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bourbon, use a find and replace
		 * to change 'bourbon' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bourbon', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bourbon' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bourbon_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'bourbon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bourbon_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bourbon_content_width', 640 );
}
add_action( 'after_setup_theme', 'bourbon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bourbon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bourbon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bourbon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bourbon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bourbon_scripts() {
	wp_enqueue_style( 'bourbon-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bourbon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bourbon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bourbon_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Elementor widget
 */
class ElementorCustomElement {

    private static $instance = null;

    public static function get_instance() {
        if ( ! self::$instance )
            self::$instance = new self;
        return self::$instance;
    }

    public function init(){
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
    }

    public function widgets_registered() {

        // We check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

            // We look for any theme overrides for this custom Elementor element.
            // If no theme overrides are found we use the default one in this plugin.

            $widget_file = get_template_directory() .'/blocks/elementor/my-widget.php';
            $template_file = locate_template($widget_file);
            if ( !$template_file || !is_readable( $template_file ) ) {
                $template_file = get_template_directory() . '/blocks/elementor/my-widget.php';
            }
            if ( $template_file && is_readable( $template_file ) ) {
                require_once $template_file;
            }
        }
    }
}

ElementorCustomElement::get_instance()->init();

function bourbon_style() {
    wp_enqueue_style( 'bg', get_template_directory_uri() . '/css/bootstrap-grid.min.css' );
    wp_enqueue_style( 'br', get_template_directory_uri() . '/css/bootstrap-reboot.min.css' );
    wp_enqueue_style( 'bm', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/css.css' );
    wp_enqueue_style( 'bourbon-sass', get_template_directory_uri() . '/sass-bourbon/style.css' );
    wp_enqueue_style( 'font-1', 'http://fonts.googleapis.com/css?family=Open+Sans:light:300italic,400italic,700italic,300,400,700' );
    wp_enqueue_style( 'font-2', 'http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' );
}
add_action( 'wp_enqueue_scripts', 'bourbon_style' );


//add_action('elementor/editor/after_enqueue_scripts', function() {
//    wp_enqueue_script( 'script_name', plugin_dir_url( __FILE__ ) . 'path/to/file.js' );
//    wp_enqueue_style( 'style_name', plugin_dir_url( __FILE__ ) . 'path/to/file.css' );
//});