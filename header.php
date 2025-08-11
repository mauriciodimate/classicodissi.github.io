<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'vogue-clone'); ?></a>

    <header id="masthead" class="site-header">
        <!-- Top announcement bar -->
        <div class="announcement-bar">
            <div class="container">
                <div class="announcement-bar-content">
                    <div class="announcement-text">The August issue is here</div>
                    <div class="announcement-action">
                        <a href="#" class="subscribe-link">SUBSCRIBE</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main header with logo and search -->
        <div class="container">
            <div class="header-inner">
                <div class="header-search">
                    <button class="search-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
                
                <div class="site-branding vogue-logo">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php else : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">VOGUE</a></h1>
                    <?php endif; ?>
                </div>

                <div class="header-actions">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Main navigation menu -->
        <nav id="site-navigation" class="main-navigation vogue-navigation">
            <div class="container">
                <?php
                // If menu exists, display it
                if (has_nav_menu('menu-1')) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'container_class' => 'vogue-menu-container',
                        )
                    );
                // If no menu is set, display default Vogue-style categories
                else :
                ?>
                <div class="vogue-menu-container">
                    <ul id="primary-menu" class="menu">
                        <li class="menu-item"><a href="#">FASHION</a></li>
                        <li class="menu-item"><a href="#">RUNWAY</a></li>
                        <li class="menu-item"><a href="#">SHOPPING</a></li>
                        <li class="menu-item"><a href="#">BEAUTY</a></li>
                        <li class="menu-item"><a href="#">CULTURE</a></li>
                        <li class="menu-item"><a href="#">LIVING</a></li>
                        <li class="menu-item"><a href="#">WEDDINGS</a></li>
                        <li class="menu-item"><a href="#">VOGUE BUSINESS</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </nav>
        
        <!-- Search form container -->
        <div class="search-form-container" style="display: none;">
            <div class="container">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">