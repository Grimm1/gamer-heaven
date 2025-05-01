<?php
/**
 * The template for displaying search results.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamer_Heaven
 */
get_header(); ?>
    <main class="main-content" id="main-content" role="main">
        <?php if (have_posts()) : ?>
            <header class="search-header">
                <h1 class="search-title"><?php printf(esc_html__('Search Results for: %s', 'gamer-heaven'), '<span>' . get_search_query() . '</span>'); ?></h1>
            </header>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_type()); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <section class="no-results">
                <h1 class="no-results-title"><?php esc_html_e('No Results Found', 'gamer-heaven'); ?></h1>
                <p class="no-results-message"><?php esc_html_e('Sorry, we couldn’t find any results for your search. Try a different term or check out some of our suggestions below!', 'gamer-heaven'); ?></p>
                <?php get_search_form(); ?>
                <div class="no-results-suggestions">
                    <h2><?php esc_html_e('Try These Instead', 'gamer-heaven'); ?></h2>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Visit the Homepage', 'gamer-heaven'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Browse Our Blog', 'gamer-heaven'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/category/gaming/')); ?>"><?php esc_html_e('Explore Gaming Content', 'gamer-heaven'); ?></a></li>
                    </ul>
                </div>
            </section>
        <?php endif; ?>
        <nav class="navigation pagination" aria-label="<?php esc_attr_e('Posts navigation', 'gamer-heaven'); ?>">
            <?php
            the_posts_pagination(array(
                'prev_text' => __('Previous', 'gamer-heaven'),
                'next_text' => __('Next', 'gamer-heaven'),
            ));
            ?>
        </nav>
    </main>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>