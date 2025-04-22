<?php get_header(); ?>
    <div class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full', array('class' => 'post-image')); ?>
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
        <?php endwhile; else : ?>
            <p><?php _e('No posts found.', 'gamer-heaven'); ?></p>
        <?php endif; ?>
        <div class="nav-links">
            <?php posts_nav_link(); ?>
        </div>
    </div>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>