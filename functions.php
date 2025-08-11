<?php
/**
 * Vogue Clone theme functions and definitions
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function vogue_clone_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('vogue-clone', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'vogue-clone'),
            'menu-2' => esc_html__('Footer', 'vogue-clone'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'vogue_clone_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'vogue_clone_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vogue_clone_content_width() {
    $GLOBALS['content_width'] = apply_filters('vogue_clone_content_width', 1200);
}
add_action('after_setup_theme', 'vogue_clone_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vogue_clone_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'vogue-clone'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'vogue-clone'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'vogue_clone_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function vogue_clone_scripts() {
    wp_enqueue_style('vogue-clone-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('vogue-clone-style', 'rtl', 'replace');

    wp_enqueue_script('vogue-clone-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'vogue_clone_scripts');

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
 * Create directory structure if it doesn't exist
 */
function vogue_clone_create_directories() {
    $directories = array(
        '/inc',
        '/js',
        '/languages',
    );
    
    foreach ($directories as $dir) {
        $path = get_template_directory() . $dir;
        if (!file_exists($path)) {
            wp_mkdir_p($path);
        }
    }
}
add_action('after_switch_theme', 'vogue_clone_create_directories');

/**
 * Custom excerpt length
 */
function vogue_clone_custom_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'vogue_clone_custom_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function vogue_clone_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vogue_clone_excerpt_more');

/**
 * Add custom image sizes
 */
function vogue_clone_add_image_sizes() {
    add_image_size('vogue-featured-large', 1200, 800, true);
    add_image_size('vogue-featured-medium', 600, 400, true);
    add_image_size('vogue-grid-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'vogue_clone_add_image_sizes');