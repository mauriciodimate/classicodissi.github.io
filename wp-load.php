<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the wp-config.php file. The wp-config.php
 * file will then load the wp-settings.php file, which
 * will then set up the WordPress environment.
 *
 * This file is used to load WordPress core when the theme
 * is being previewed outside of a WordPress installation.
 */

// Define the path to the WordPress installation
if (!defined('ABSPATH')) {
    // Try to find WordPress installation in common locations
    $possible_paths = array(
        // Common local development paths
        $_SERVER['DOCUMENT_ROOT'] . '/wordpress/',
        $_SERVER['DOCUMENT_ROOT'] . '/',
        dirname(__FILE__) . '/../../../',
        dirname(__FILE__) . '/../../',
        dirname(__FILE__) . '/../',
        // Add more possible paths as needed
    );
    
    foreach ($possible_paths as $path) {
        if (file_exists($path . 'wp-load.php')) {
            define('ABSPATH', $path);
            break;
        }
    }
    
    // If WordPress installation not found, display an error
    if (!defined('ABSPATH')) {
        die('WordPress installation not found. This theme requires WordPress to function properly. Please install WordPress in a standard location or update this file with the correct path to your WordPress installation.');
    }
}

// Load WordPress
require_once(ABSPATH . 'wp-load.php');