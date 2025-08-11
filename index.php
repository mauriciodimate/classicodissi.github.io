<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="featured-posts">
                <?php
                // Featured posts section
                $featured_args = array(
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                );
                $featured_query = new WP_Query($featured_args);

                if ($featured_query->have_posts()) :
                    $count = 0;
                    while ($featured_query->have_posts()) : $featured_query->the_post();
                        $count++;
                        if ($count === 1) :
                            // Main featured post
                            ?>
                            <div class="featured-main">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="featured-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="featured-content">
                                        <header class="entry-header">
                                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
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
                            </div>
                        <?php else : ?>
                            <div class="featured-secondary">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="featured-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="featured-content">
                                        <header class="entry-header">
                                            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                        </header>
                                    </div>
                                </article>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <div class="latest-posts">
                <h2 class="section-title">Latest Stories</h2>
                <div class="posts-grid">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
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

                        <?php the_posts_navigation(); ?>

                    <?php else : ?>

                        <p><?php esc_html_e('No posts found.', 'vogue-theme'); ?></p>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>