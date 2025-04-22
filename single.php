<?php get_header(); ?>
    <div class="main-content">
        <div class="posts-wrapper">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full', array('class' => 'post-image')); ?>
                        </div>
                    <?php endif; ?>
                    <h2 class="post-title"><?php the_title(); ?></h2>
                    <div class="post-meta">
                        <span class="post-date"><?php echo get_the_date(); ?></span> |
                        <span class="post-author"><?php the_author_posts_link(); ?></span> |
                        <span class="post-categories"><?php the_category(', '); ?></span>
                    </div>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                    <div id="comments" class="comments-area">
                        <?php comments_template(); ?>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <p><?php _e('No posts found.', 'gamer-heaven'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>