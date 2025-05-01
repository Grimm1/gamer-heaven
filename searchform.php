<?php
/**
 * The search form template.
 *
 * @link https://developer.wordpress.org/themes/functionality/search/
 *
 * @package Gamer_Heaven
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="s" class="screen-reader-text"><?php esc_html_e('Search for:', 'gamer-heaven'); ?></label>
    <input type="search" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e('Search...', 'gamer-heaven'); ?>" required>
    <input type="submit" value="<?php esc_attr_e('Search', 'gamer-heaven'); ?>">
</form>