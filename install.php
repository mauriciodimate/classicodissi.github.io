<?php
/**
 * Vogue Clone WordPress Theme Installation Helper
 *
 * This script helps users install the Vogue Clone theme in a WordPress environment.
 * It checks for WordPress installation, provides guidance, and helps with theme installation.
 */

// Set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to check if WordPress is installed
function check_wordpress_installation() {
    $possible_paths = array(
        // Common local development paths
        $_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php',
        $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php',
        dirname(__FILE__) . '/../../../wp-load.php',
        dirname(__FILE__) . '/../../wp-load.php',
        dirname(__FILE__) . '/../wp-load.php',
    );
    
    foreach ($possible_paths as $path) {
        if (file_exists($path)) {
            return $path;
        }
    }
    
    return false;
}

// Function to check if this directory is inside a WordPress themes directory
function is_in_themes_directory() {
    $current_path = dirname(__FILE__);
    return (strpos($current_path, 'wp-content/themes') !== false);
}

// Function to get theme information
function get_theme_info() {
    $style_css = file_get_contents(dirname(__FILE__) . '/style.css');
    preg_match('/Theme Name:\s*(.+?)\n/', $style_css, $name_matches);
    preg_match('/Description:\s*(.+?)\n/', $style_css, $desc_matches);
    
    return array(
        'name' => isset($name_matches[1]) ? trim($name_matches[1]) : 'Vogue Clone',
        'description' => isset($desc_matches[1]) ? trim($desc_matches[1]) : 'A WordPress theme inspired by Vogue.com',
    );
}

// Get theme information
$theme_info = get_theme_info();

// Check WordPress installation
$wordpress_path = check_wordpress_installation();
$in_themes_dir = is_in_themes_directory();

// HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $theme_info['name']; ?> - Installation Helper</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            color: #23282d;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .card h2 {
            margin-top: 0;
            color: #23282d;
        }
        
        .status {
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 20px;
        }
        
        .status-success {
            background-color: #ecf7ed;
            border-left: 4px solid #46b450;
        }
        
        .status-warning {
            background-color: #fff8e5;
            border-left: 4px solid #ffb900;
        }
        
        .status-error {
            background-color: #fbeaea;
            border-left: 4px solid #dc3232;
        }
        
        .button {
            display: inline-block;
            background-color: #0073aa;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }
        
        .button:hover {
            background-color: #005177;
        }
        
        code {
            background-color: #f5f5f5;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: monospace;
        }
        
        ul {
            padding-left: 20px;
        }
        
        .steps {
            counter-reset: step-counter;
            list-style-type: none;
            padding-left: 0;
        }
        
        .steps li {
            position: relative;
            padding-left: 40px;
            margin-bottom: 15px;
        }
        
        .steps li:before {
            content: counter(step-counter);
            counter-increment: step-counter;
            position: absolute;
            left: 0;
            top: 0;
            width: 25px;
            height: 25px;
            background-color: #0073aa;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 25px;
        }
    </style>
</head>
<body>
    <h1><?php echo $theme_info['name']; ?> Installation Helper</h1>
    
    <div class="card">
        <h2>Theme Information</h2>
        <p><strong>Name:</strong> <?php echo $theme_info['name']; ?></p>
        <p><strong>Description:</strong> <?php echo $theme_info['description']; ?></p>
    </div>
    
    <?php if ($wordpress_path): ?>
        <div class="status status-success">
            <p><strong>WordPress Found!</strong> WordPress installation detected at: <code><?php echo dirname($wordpress_path); ?></code></p>
        </div>
    <?php else: ?>
        <div class="status status-error">
            <p><strong>WordPress Not Found!</strong> This theme requires WordPress to function properly.</p>
        </div>
    <?php endif; ?>
    
    <?php if ($in_themes_dir): ?>
        <div class="status status-success">
            <p><strong>Correct Location!</strong> This theme is located in a WordPress themes directory.</p>
        </div>
    <?php else: ?>
        <div class="status status-warning">
            <p><strong>Incorrect Location!</strong> This theme should be installed in a WordPress themes directory.</p>
        </div>
    <?php endif; ?>
    
    <div class="card">
        <h2>Installation Instructions</h2>
        
        <?php if (!$wordpress_path): ?>
            <h3>Install WordPress First</h3>
            <ol class="steps">
                <li>Download WordPress from <a href="https://wordpress.org/download/" target="_blank">wordpress.org</a></li>
                <li>Set up a local development environment using one of these options:
                    <ul>
                        <li><a href="https://localwp.com/" target="_blank">Local by Flywheel</a></li>
                        <li><a href="https://www.apachefriends.org/" target="_blank">XAMPP</a></li>
                        <li><a href="https://www.mamp.info/" target="_blank">MAMP</a></li>
                        <li><a href="https://hub.docker.com/_/wordpress/" target="_blank">Docker with WordPress</a></li>
                    </ul>
                </li>
                <li>Install and configure WordPress</li>
            </ol>
        <?php endif; ?>
        
        <h3>Install the Theme</h3>
        <ol class="steps">
            <?php if (!$in_themes_dir): ?>
                <li>Copy this entire directory to your WordPress themes directory:
                    <code>wp-content/themes/vogue-clone/</code>
                </li>
            <?php endif; ?>
            <li>Log in to your WordPress admin dashboard</li>
            <li>Go to Appearance > Themes</li>
            <li>Find "<?php echo $theme_info['name']; ?>" and click "Activate"</li>
            <li>Customize your theme via Appearance > Customize</li>
        </ol>
    </div>
    
    <div class="card">
        <h2>Quick Test</h2>
        <p>You can preview the theme structure (with limited functionality) without WordPress:</p>
        <p><a href="theme-preview.html" class="button" target="_blank">View Theme Preview</a></p>
        <p>Or test with simulated WordPress functions:</p>
        <p><a href="theme-test.php" class="button" target="_blank">Run Theme Test</a></p>
    </div>
    
    <div class="card">
        <h2>Need Help?</h2>
        <p>For more information, please refer to the <a href="README.md" target="_blank">README.md</a> file.</p>
    </div>
</body>
</html>
<?php
// End of file