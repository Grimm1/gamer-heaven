<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamer_Heaven
 */
get_header(); ?>
    <main class="main-content" id="main-content" role="main">
        <div class="no-results">
            <h1 class="page-title"><?php _e('404 - Page Not Found', 'gamer-heaven'); ?></h1>
            <p><?php _e('Sorry, the page you are looking for does not exist. Try searching for something else.', 'gamer-heaven'); ?></p>
            <?php get_search_form(); ?>
        </div>
    </main>
    <div class="sidebar<?php echo is_active_sidebar('sidebar-1') ? ' has-scrollbar' : ''; ?>">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
<?php get_footer(); ?>