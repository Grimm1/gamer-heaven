<?php get_header(); ?>
<div class="container">
    <div class="main-content">
        <h2><?php printf(__('Search Results for: %s', 'gamer-heaven'), get_search_query()); ?></h2>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
        <?php endwhile; else: ?>
            <p><?php _e('Sorry, no results found.', 'gamer-heaven'); ?></p>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
