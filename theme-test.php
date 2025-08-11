<?php
/**
 * Theme Test File
 *
 * This file helps test the WordPress theme outside of a full WordPress installation.
 * It simulates the WordPress environment by defining necessary constants and functions
 * that are commonly used in WordPress themes.
 */

// Try to load WordPress if available
if (file_exists(__DIR__ . '/wp-load.php')) {
    include_once(__DIR__ . '/wp-load.php');
}

// If WordPress is not loaded, define essential functions and constants
if (!function_exists('add_action')) {
    // Define WordPress constants
    if (!defined('ABSPATH')) {
        define('ABSPATH', __DIR__ . '/');
    }
    
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', true);
    }
    
    // Define essential WordPress functions if they don't exist
    if (!function_exists('get_header')) {
        function get_header() { echo "<header>Header would be loaded here</header>\n"; }
    }
    
    if (!function_exists('get_footer')) {
        function get_footer() { echo "<footer>Footer would be loaded here</footer>\n"; }
    }
    
    if (!function_exists('get_sidebar')) {
        function get_sidebar() { echo "<aside>Sidebar would be loaded here</aside>\n"; }
    }
    
    if (!function_exists('get_template_part')) {
        function get_template_part($slug, $name = null) {
            $file = $name ? "$slug-$name.php" : "$slug.php";
            if (file_exists(__DIR__ . "/template-parts/$file")) {
                include(__DIR__ . "/template-parts/$file");
            } else {
                echo "Template part '$file' would be loaded here\n";
            }
        }
    }
    
    if (!function_exists('wp_head')) {
        function wp_head() { echo "<!-- wp_head() would output here -->\n"; }
    }
    
    if (!function_exists('wp_footer')) {
        function wp_footer() { echo "<!-- wp_footer() would output here -->\n"; }
    }
    
    if (!function_exists('language_attributes')) {
        function language_attributes() { echo 'lang="en-US"'; }
    }
    
    if (!function_exists('bloginfo')) {
        function bloginfo($show = '') {
            $info = [
                'name' => 'Vogue Clone',
                'description' => 'A WordPress theme inspired by Vogue.com',
                'charset' => 'UTF-8',
                'url' => '/',
                'stylesheet_url' => '/style.css',
                'template_url' => '/',
            ];
            echo isset($info[$show]) ? $info[$show] : '';
        }
    }
    
    if (!function_exists('wp_title')) {
        function wp_title() { echo 'Vogue Clone'; }
    }
    
    if (!function_exists('body_class')) {
        function body_class() { echo 'home blog'; }
    }
    
    if (!function_exists('have_posts')) {
        function have_posts() { return true; }
    }
    
    if (!function_exists('the_post')) {
        function the_post() { /* Do nothing */ }
    }
    
    if (!function_exists('the_title')) {
        function the_title($before = '', $after = '', $echo = true) {
            $title = 'Sample Post Title';
            if ($echo) {
                echo $before . $title . $after;
            } else {
                return $before . $title . $after;
            }
        }
    }
    
    if (!function_exists('the_content')) {
        function the_content() {
            echo '<p>This is sample content that would normally be the content of a WordPress post.</p>';
        }
    }
    
    if (!function_exists('the_excerpt')) {
        function the_excerpt() {
            echo '<p>This is a sample excerpt that would normally be generated from a WordPress post.</p>';
        }
    }
    
    if (!function_exists('get_template_directory_uri')) {
        function get_template_directory_uri() {
            return '.';
        }
    }
    
    if (!function_exists('get_template_directory')) {
        function get_template_directory() {
            return __DIR__;
        }
    }
    
    if (!function_exists('get_stylesheet_uri')) {
        function get_stylesheet_uri() {
            return './style.css';
        }
    }
    
    if (!function_exists('wp_nav_menu')) {
        function wp_nav_menu($args = []) {
            echo "<nav><ul><li><a href='#'>Home</a></li><li><a href='#'>About</a></li><li><a href='#'>Contact</a></li></ul></nav>\n";
        }
    }
    
    if (!function_exists('dynamic_sidebar')) {
        function dynamic_sidebar($index) {
            echo "<div>Widget area '$index' would be displayed here</div>\n";
            return true;
        }
    }
    
    if (!function_exists('is_active_sidebar')) {
        function is_active_sidebar($index) {
            return true;
        }
    }
    
    if (!function_exists('comments_template')) {
        function comments_template() {
            echo "<div>Comments would be displayed here</div>\n";
        }
    }
    
    if (!function_exists('the_posts_navigation')) {
        function the_posts_navigation() {
            echo "<nav>Posts navigation would be displayed here</nav>\n";
        }
    }
    
    if (!function_exists('post_class')) {
        function post_class() {
            echo 'post';
        }
    }
    
    if (!function_exists('get_post_type')) {
        function get_post_type() {
            return 'post';
        }
    }
    
    if (!function_exists('is_singular')) {
        function is_singular() {
            return false;
        }
    }
    
    if (!function_exists('is_home')) {
        function is_home() {
            return true;
        }
    }
    
    if (!function_exists('is_archive')) {
        function is_archive() {
            return false;
        }
    }
    
    if (!function_exists('is_search')) {
        function is_search() {
            return false;
        }
    }
    
    if (!function_exists('get_search_query')) {
        function get_search_query() {
            return 'sample search';
        }
    }
    
    if (!function_exists('the_search_query')) {
        function the_search_query() {
            echo 'sample search';
        }
    }
    
    if (!function_exists('get_search_form')) {
        function get_search_form() {
            echo "<form role='search' method='get' class='search-form'><input type='search' class='search-field' placeholder='Search...' value='' name='s'><button type='submit' class='search-submit'>Search</button></form>\n";
        }
    }
    
    if (!function_exists('the_post_thumbnail')) {
        function the_post_thumbnail($size = 'post-thumbnail', $attr = '') {
            echo "<img src='placeholder.jpg' alt='Featured Image' />\n";
        }
    }
    
    if (!function_exists('has_post_thumbnail')) {
        function has_post_thumbnail() {
            return true;
        }
    }
    
    if (!function_exists('esc_url')) {
        function esc_url($url) {
            return $url;
        }
    }
    
    if (!function_exists('esc_html')) {
        function esc_html($text) {
            return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
    }
    
    if (!function_exists('esc_html__')) {
        function esc_html__($text, $domain = 'default') {
            return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
    }
    
    if (!function_exists('esc_attr')) {
        function esc_attr($text) {
            return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
    }
    
    if (!function_exists('esc_attr__')) {
        function esc_attr__($text, $domain = 'default') {
            return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
    }
    
    if (!function_exists('__')) {
        function __($text, $domain = 'default') {
            return $text;
        }
    }
    
    if (!function_exists('_e')) {
        function _e($text, $domain = 'default') {
            echo $text;
        }
    }
    
    if (!function_exists('apply_filters')) {
        function apply_filters($tag, $value) {
            return $value;
        }
    }
    
    if (!function_exists('add_filter')) {
        function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
            // Do nothing
        }
    }
    
    if (!function_exists('add_action')) {
        function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
            // Do nothing
        }
    }
    
    if (!function_exists('do_action')) {
        function do_action($tag, $arg = '') {
            // Do nothing
        }
    }
    
    if (!function_exists('wp_enqueue_style')) {
        function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {
            echo "<!-- Style $handle would be enqueued from $src -->\n";
        }
    }
    
    if (!function_exists('wp_enqueue_script')) {
        function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {
            echo "<!-- Script $handle would be enqueued from $src -->\n";
        }
    }
    
    if (!function_exists('wp_style_add_data')) {
        function wp_style_add_data($handle, $key, $value) {
            // Do nothing
        }
    }
    
    if (!function_exists('load_theme_textdomain')) {
        function load_theme_textdomain($domain, $path) {
            // Do nothing
        }
    }
    
    if (!function_exists('add_theme_support')) {
        function add_theme_support($feature, $args = array()) {
            // Do nothing
        }
    }
    
    if (!function_exists('register_nav_menus')) {
        function register_nav_menus($locations = array()) {
            // Do nothing
        }
    }
    
    if (!function_exists('register_sidebar')) {
        function register_sidebar($args = array()) {
            // Do nothing
        }
    }
    
    if (!function_exists('comments_open')) {
        function comments_open() {
            return true;
        }
    }
    
    if (!function_exists('get_option')) {
        function get_option($option, $default = false) {
            $options = [
                'thread_comments' => true,
                'blogname' => 'Vogue Clone',
                'blogdescription' => 'A WordPress theme inspired by Vogue.com',
            ];
            return isset($options[$option]) ? $options[$option] : $default;
        }
    }
    
    if (!function_exists('wp_mkdir_p')) {
        function wp_mkdir_p($path) {
            return mkdir($path, 0777, true);
        }
    }
    
    if (!function_exists('add_image_size')) {
        function add_image_size($name, $width, $height, $crop = false) {
            // Do nothing
        }
    }
    
    // Add missing functions from header.php
    if (!function_exists('wp_body_open')) {
        function wp_body_open() {
            echo "<!-- wp_body_open() would output here -->\n";
        }
    }
    
    if (!function_exists('esc_html_e')) {
        function esc_html_e($text, $domain = 'default') {
            echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
    }
    
    if (!function_exists('has_custom_logo')) {
        function has_custom_logo() {
            return false; // Default to false for testing
        }
    }
    
    if (!function_exists('the_custom_logo')) {
        function the_custom_logo() {
            echo '<img src="logo.svg" alt="Vogue Logo" class="custom-logo" />';
        }
    }
    
    if (!function_exists('home_url')) {
        function home_url($path = '') {
            return '/' . ltrim($path, '/');
        }
    }
    
    if (!function_exists('has_nav_menu')) {
        function has_nav_menu($location) {
            return false; // Default to false for testing
        }
    }
    
    // Add missing functions from footer.php
    if (!function_exists('get_categories')) {
        function get_categories($args = []) {
            // Return sample categories
            $categories = [];
            $sample_categories = ['Fashion', 'Beauty', 'Culture', 'Lifestyle', 'Travel', 'Food'];
            
            foreach ($sample_categories as $index => $name) {
                $category = new stdClass();
                $category->term_id = $index + 1;
                $category->name = $name;
                $categories[] = $category;
            }
            
            return $categories;
        }
    }
    
    if (!function_exists('get_category_link')) {
        function get_category_link($category_id) {
            return '#category-' . $category_id;
        }
    }
    
    if (!function_exists('wp_get_recent_posts')) {
        function wp_get_recent_posts($args = []) {
            // Return sample recent posts
            $recent_posts = [];
            $sample_posts = [
                'The Latest Fashion Trends for Summer',
                'Beauty Tips for Every Skin Type',
                'Cultural Events You Shouldn\'t Miss',
                'Lifestyle Changes for Better Health',
                'Travel Destinations for Your Next Vacation'
            ];
            
            foreach ($sample_posts as $index => $title) {
                $recent_posts[] = [
                    'ID' => $index + 1,
                    'post_title' => $title
                ];
            }
            
            return $recent_posts;
        }
    }
    
    if (!function_exists('get_permalink')) {
        function get_permalink($post_id) {
            return '#post-' . $post_id;
        }
    }
    
    if (!function_exists('wp_reset_postdata')) {
        function wp_reset_postdata() {
            // Do nothing
        }
    }
}

// Include the theme's index.php file
include_once(__DIR__ . '/index.php');