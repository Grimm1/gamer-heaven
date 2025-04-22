<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                _nx('One comment on “%2\”', '%1\ comments on “%2\”', get_comments_number(), 'comments title', 'gamer-heaven'),
                number_format_i18n(get_comments_number()),
                get_the_title()
            );
            ?>
        </h2>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
            ));
            ?>
        </ol>
        <?php the_comments_navigation(); ?>
    <?php endif; ?>
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'gamer-heaven'); ?></p>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>
