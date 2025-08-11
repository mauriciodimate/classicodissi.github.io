<?php
/**
 * Generate a theme screenshot
 *
 * This file creates a simple theme screenshot using PHP GD library.
 * You can run this file once to generate the screenshot.png file,
 * then delete this file as it's not needed for the theme to function.
 */

// Set the width and height of the screenshot
$width = 1200;
$height = 900;

// Create the image
$image = imagecreatetruecolor($width, $height);

// Define colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$gray = imagecolorallocate($image, 240, 240, 240);
$dark_gray = imagecolorallocate($image, 100, 100, 100);

// Fill the background
imagefill($image, 0, 0, $white);

// Draw header
imagefilledrectangle($image, 0, 0, $width, 100, $white);

// Draw logo/site title
$font_path = __DIR__ . '/arial.ttf'; // You'll need to have this font file
$site_title = 'VOGUE CLONE';

// If the font file exists, use it, otherwise use a simple rectangle
if (file_exists($font_path)) {
    imagettftext($image, 40, 0, $width / 2 - 150, 70, $black, $font_path, $site_title);
} else {
    // Draw a placeholder for the logo
    imagefilledrectangle($image, $width / 2 - 150, 30, $width / 2 + 150, 70, $black);
    imagestring($image, 5, $width / 2 - 70, 45, $site_title, $white);
}

// Draw navigation
imagefilledrectangle($image, 0, 100, $width, 140, $white);
$nav_items = ['FASHION', 'BEAUTY', 'CULTURE', 'LIFESTYLE', 'RUNWAY', 'SHOPPING'];
$nav_width = $width / count($nav_items);

for ($i = 0; $i < count($nav_items); $i++) {
    $x = $i * $nav_width + ($nav_width / 2) - 30;
    imagestring($image, 3, $x, 115, $nav_items[$i], $black);
}

// Draw featured post area
imagefilledrectangle($image, 50, 170, $width - 50, 500, $gray);
imagestring($image, 5, $width / 2 - 100, 330, 'FEATURED POST IMAGE', $dark_gray);

// Draw featured post title
imagefilledrectangle($image, 50, 510, $width - 50, 570, $white);
imagestring($image, 5, 60, 530, 'Featured Post Title', $black);
imagestring($image, 2, 60, 550, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', $dark_gray);

// Draw grid posts
$grid_items = 3;
$grid_width = ($width - 100) / $grid_items;
$grid_margin = 50;

for ($i = 0; $i < $grid_items; $i++) {
    $x = $i * $grid_width + $grid_margin;
    
    // Post thumbnail
    imagefilledrectangle($image, $x, 600, $x + $grid_width - 20, 700, $gray);
    imagestring($image, 3, $x + 20, 650, 'POST IMAGE', $dark_gray);
    
    // Post title
    imagestring($image, 3, $x, 720, 'Post Title ' . ($i + 1), $black);
    
    // Post excerpt
    imagestring($image, 2, $x, 740, 'Lorem ipsum dolor sit amet...', $dark_gray);
}

// Draw footer
imagefilledrectangle($image, 0, $height - 100, $width, $height, $gray);
imagestring($image, 3, $width / 2 - 100, $height - 60, 'VOGUE CLONE FOOTER', $black);
imagestring($image, 2, $width / 2 - 150, $height - 40, '© 2023 Vogue Clone. All Rights Reserved.', $dark_gray);

// Save the image
imagepng($image, __DIR__ . '/screenshot.png');
imagedestroy($image);

echo "Screenshot generated successfully!\n";