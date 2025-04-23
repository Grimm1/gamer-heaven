<?php
/**
 * The template for displaying category archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamer_Heaven
 */

get_header(); ?>
    <div class="main-content">
        <?php if (have_posts()) : ?>


            <?php while (have_posts()) : the_post(); ?>
                <div class="post-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full', array('class' => 'post-image')); ?>
                        </div>
                    <?php else : ?>
                        <div class="post-thumbnail">
                            <img src="<?php echo esc_url(gamer_heaven_get_default_thumbnail()); ?>" alt="<?php esc_attr_e('Default Thumbnail', 'gamer-heaven'); ?>" class="post-image" />
                        </div>
                    <?php endif; ?>

                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-meta">
                        <?php _e('Posted on', 'gamer-heaven'); ?> <a href="<?php the_permalink(); ?>"><?php the_date(); ?></a>
                        <?php _e('by', 'gamer-heaven'); ?> <?php the_author(); ?>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read More', 'gamer-heaven'); ?></a>
                </div>
            <?php endwhile; ?>

            <div class="nav-links">
                <?php posts_nav_link(); ?>
            </div>
        <?php else : ?>
            <div class="no-results">
                <h1 class="page-title"><?php esc_html_e('No Posts Found', 'gamer-heaven'); ?></h1>
                <p><?php esc_html_e('Sorry, there are no posts in this category.', 'gamer-heaven'); ?></p>
            </div><!-- .no-results -->
        <?php endif; ?>
    </div>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>