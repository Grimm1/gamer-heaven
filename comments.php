<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/functionality/comments/
 *
 * @package Gamer_Heaven
 */

if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area" role="complementary">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                _nx(
                    'One comment on "%2$s"',
                    '%1$s comments on "%2$s"',
                    get_comments_number(),
                    'comments title',
                    'gamer-heaven'
                ),
                number_format_i18n(get_comments_number()),
                get_the_title()
            );
            ?>
        </h2>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => 'gamer_heaven_comment_callback',
            ));
            ?>
        </ol>
        <?php the_comments_navigation(array(
            'prev_text' => __('Older Comments', 'gamer-heaven'),
            'next_text' => __('Newer Comments', 'gamer-heaven'),
        )); ?>
        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'gamer-heaven'); ?></p>
        <?php endif; ?>
    <?php endif; ?>
    <?php
    comment_form(array(
        'title_reply'         => __('Leave a Comment', 'gamer-heaven'),
        'comment_notes_after' => '<p class="comment-notes">' . __('Your comment is awaiting moderation.', 'gamer-heaven') . '</p>',
    ));
    ?>
</div>