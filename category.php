<?php
/**
 * The template for displaying category archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamer_Heaven
 */
get_header(); ?>
    <main class="main-content" id="main-content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', get_post_type()); ?>
        <?php endwhile; wp_reset_postdata(); else : ?>
            <p><?php _e('No posts found.', 'gamer-heaven'); ?></p>
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