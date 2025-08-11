<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf(esc_html__('Search Results for: %s', 'vogue-clone'), '<span>' . get_search_query() . '</span>');
                        ?>
                    </h1>
                </header>

                <div class="posts-grid">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
                            <div class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-content">
                                <header class="entry-header">
                                    <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                </header>
                                <div class="entry-meta">
                                    <?php
                                    echo '<span class="posted-on">' . get_the_date() . '</span>';
                                    ?>
                                </div>
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_navigation(); ?>

            <?php else : ?>
                <div class="no-results">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'vogue-clone'); ?></h1>
                    </header>

                    <div class="page-content">
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vogue-clone'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php
get_sidebar();
get_footer();