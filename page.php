<?php
/**
 * The template for displaying all pages in the Gamer Heaven theme.
 *
 * @package Gamer_Heaven
 */
get_header(); ?>
    <main class="main-content" id="main-content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-item">
                    <div class="featured-image">
                        <?php the_post_thumbnail('full', array('class' => 'featured-img', 'alt' => get_the_title())); ?>
                    </div>
                </div>
            <?php endif; ?>
            <h2><?php echo esc_html(get_the_title()); ?></h2>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; wp_reset_postdata(); else: ?>
            <p><?php _e('Sorry, no pages matched your criteria.', 'gamer-heaven'); ?></p>
        <?php endif; ?>
    </main>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>