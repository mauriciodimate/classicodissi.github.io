<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'vogue-clone'); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'vogue-clone'); ?></p>

                    <?php get_search_form(); ?>

                    <div class="error-home-link">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                            <?php esc_html_e('Back to Homepage', 'vogue-clone'); ?>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php
get_footer();