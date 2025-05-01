<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamer_Heaven
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="post-thumbnail">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium', array('class' => 'post-image')); ?>
        <?php else : ?>
            <?php
            $default_thumbnail_url = gamer_heaven_get_default_thumbnail();
            // Debug: Log URL in search context
            if (is_search()) {
                error_log('Search Default Thumbnail URL for post ' . get_the_ID() . ': ' . $default_thumbnail_url);
            }
            // Default image dimensions (match 'medium' size, e.g., 300x169)
            $default_width = 300;
            $default_height = 169;
            ?>
            <img
                src="<?php echo esc_url($default_thumbnail_url); ?>"
                alt="<?php esc_attr_e('Default Thumbnail', 'gamer-heaven'); ?>"
                class="post-image"
                width="<?php echo esc_attr($default_width); ?>"
                height="<?php echo esc_attr($default_height); ?>"
                decoding="async"
            />
        <?php endif; ?>
    </div>
    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="post-meta">
        <?php esc_html_e('Posted on', 'gamer-heaven'); ?> <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
        <?php esc_html_e('by', 'gamer-heaven'); ?> <?php the_author(); ?>
    </div>
    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'gamer-heaven'); ?></a>
</article>