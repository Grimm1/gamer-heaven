<?php get_header(); ?>
    <div class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-item">
                    <div class="featured-image">
                        <?php the_post_thumbnail('full', array('class' => 'featured-img')); ?>
                    </div>
                </div>
            <?php endif; ?>
            <h2><?php the_title(); ?></h2>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; else: ?>
            <p><?php _e('Sorry, no pages matched your criteria.', 'gamer-heaven'); ?></p>
        <?php endif; ?>
    </div>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>