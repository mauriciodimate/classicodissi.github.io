<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vogue_clone_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'vogue_clone_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vogue_clone_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'vogue_clone_pingback_header');

/**
 * Modify the "Read More" link text
 */
function vogue_clone_modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">' . esc_html__('Continue Reading', 'vogue-clone') . '</a>';
}
add_filter('the_content_more_link', 'vogue_clone_modify_read_more_link');

/**
 * Add a wrapper around the site title
 */
function vogue_clone_wrap_site_title($title) {
    if (is_home() || is_front_page()) {
        return '<span class="title-wrap">' . $title . '</span>';
    }
    return $title;
}
add_filter('the_title', 'vogue_clone_wrap_site_title');

/**
 * Add a class to the first paragraph of the content
 */
function vogue_clone_first_paragraph($content) {
    if (is_singular() && is_main_query()) {
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead-paragraph">', $content, 1);
    }
    return $content;
}
add_filter('the_content', 'vogue_clone_first_paragraph');