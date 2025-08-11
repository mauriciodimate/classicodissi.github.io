<?php
/**
 * Vogue Clone Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vogue_clone_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'vogue_clone_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'vogue_clone_customize_partial_blogdescription',
            )
        );
    }

    // Add Theme Options Panel
    $wp_customize->add_panel('vogue_clone_theme_options', array(
        'title'       => esc_html__('Theme Options', 'vogue-clone'),
        'description' => esc_html__('Theme Options for Vogue Clone', 'vogue-clone'),
        'priority'    => 130,
    ));

    // Header Options Section
    $wp_customize->add_section('vogue_clone_header_options', array(
        'title'    => esc_html__('Header Options', 'vogue-clone'),
        'priority' => 10,
        'panel'    => 'vogue_clone_theme_options',
    ));

    // Sticky Header Option
    $wp_customize->add_setting('vogue_clone_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'vogue_clone_sanitize_checkbox',
    ));

    $wp_customize->add_control('vogue_clone_sticky_header', array(
        'label'    => esc_html__('Enable Sticky Header', 'vogue-clone'),
        'section'  => 'vogue_clone_header_options',
        'type'     => 'checkbox',
    ));

    // Footer Options Section
    $wp_customize->add_section('vogue_clone_footer_options', array(
        'title'    => esc_html__('Footer Options', 'vogue-clone'),
        'priority' => 20,
        'panel'    => 'vogue_clone_theme_options',
    ));

    // Footer Copyright Text
    $wp_customize->add_setting('vogue_clone_footer_copyright', array(
        'default'           => sprintf(esc_html__('© %s %s. All Rights Reserved.', 'vogue-clone'), date('Y'), get_bloginfo('name')),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('vogue_clone_footer_copyright', array(
        'label'    => esc_html__('Footer Copyright Text', 'vogue-clone'),
        'section'  => 'vogue_clone_footer_options',
        'type'     => 'textarea',
    ));

    // Homepage Options Section
    $wp_customize->add_section('vogue_clone_homepage_options', array(
        'title'    => esc_html__('Homepage Options', 'vogue-clone'),
        'priority' => 30,
        'panel'    => 'vogue_clone_theme_options',
    ));

    // Featured Posts Title
    $wp_customize->add_setting('vogue_clone_featured_title', array(
        'default'           => esc_html__('Featured Posts', 'vogue-clone'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('vogue_clone_featured_title', array(
        'label'    => esc_html__('Featured Posts Section Title', 'vogue-clone'),
        'section'  => 'vogue_clone_homepage_options',
        'type'     => 'text',
    ));

    // Latest Posts Title
    $wp_customize->add_setting('vogue_clone_latest_title', array(
        'default'           => esc_html__('Latest Stories', 'vogue-clone'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('vogue_clone_latest_title', array(
        'label'    => esc_html__('Latest Posts Section Title', 'vogue-clone'),
        'section'  => 'vogue_clone_homepage_options',
        'type'     => 'text',
    ));

    // Number of Featured Posts
    $wp_customize->add_setting('vogue_clone_featured_count', array(
        'default'           => 5,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('vogue_clone_featured_count', array(
        'label'    => esc_html__('Number of Featured Posts', 'vogue-clone'),
        'section'  => 'vogue_clone_homepage_options',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => 1,
        ),
    ));

    // Color Options Section
    $wp_customize->add_section('vogue_clone_color_options', array(
        'title'    => esc_html__('Color Options', 'vogue-clone'),
        'priority' => 40,
        'panel'    => 'vogue_clone_theme_options',
    ));

    // Primary Color
    $wp_customize->add_setting('vogue_clone_primary_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vogue_clone_primary_color', array(
        'label'    => esc_html__('Primary Color', 'vogue-clone'),
        'section'  => 'vogue_clone_color_options',
    )));

    // Secondary Color
    $wp_customize->add_setting('vogue_clone_secondary_color', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vogue_clone_secondary_color', array(
        'label'    => esc_html__('Secondary Color', 'vogue-clone'),
        'section'  => 'vogue_clone_color_options',
    )));
}
add_action('customize_register', 'vogue_clone_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function vogue_clone_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function vogue_clone_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vogue_clone_customize_preview_js() {
    wp_enqueue_script('vogue-clone-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'vogue_clone_customize_preview_js');

/**
 * Sanitize checkbox values
 */
function vogue_clone_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Generate CSS from customizer settings
 */
function vogue_clone_customizer_css() {
    $primary_color = get_theme_mod('vogue_clone_primary_color', '#000000');
    $secondary_color = get_theme_mod('vogue_clone_secondary_color', '#666666');
    
    $css = ''
        . ':root {'
        . '--primary-color: ' . esc_attr($primary_color) . ';'
        . '--secondary-color: ' . esc_attr($secondary_color) . ';'
        . '}'
        . 'a {color: var(--primary-color);}'
        . 'a:hover {color: var(--secondary-color);}'
        . '.section-title:after {background-color: var(--primary-color);}'
        . '.main-navigation a:hover {color: var(--primary-color);}'
        . '.search-submit {background-color: var(--primary-color);}'
        . '.search-submit:hover {background-color: var(--secondary-color);}'
        . '.entry-meta {color: var(--secondary-color);}'
        . '.tags-links a, .cat-links a {color: var(--primary-color);}'
        . '.tags-links a:hover, .cat-links a:hover {color: var(--secondary-color);}'
        . '.social-links a {color: var(--primary-color);}'
        . '.social-links a:hover {color: var(--secondary-color);}'
        . '.more-link {color: var(--primary-color);}'
        . '.more-link:hover {color: var(--secondary-color);}'
        . '.site-footer {border-top-color: var(--primary-color);}'
        . '.widget-title {border-bottom-color: var(--primary-color);}'
        . '.button, button, input[type="button"], input[type="reset"], input[type="submit"] {background-color: var(--primary-color);}'
        . '.button:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover {background-color: var(--secondary-color);}'
    ;
    
    // Sticky header
    if (get_theme_mod('vogue_clone_sticky_header', true)) {
        $css .= '.site-header {position: sticky; top: 0; z-index: 1000;}';
    }
    
    return $css;
}

/**
 * Enqueue customizer CSS
 */
function vogue_clone_enqueue_customizer_css() {
    wp_add_inline_style('vogue-clone-style', vogue_clone_customizer_css());
}
add_action('wp_enqueue_scripts', 'vogue_clone_enqueue_customizer_css', 20);