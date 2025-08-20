<?php
/**
 * The header for the Gamer Heaven theme.
 *
 * @package Gamer_Heaven
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#main-content"><?php _e('Skip to content', 'gamer-heaven'); ?></a>
    <header role="banner">
        <div class="header-container">
            <div class="site-branding">
                <?php if (has_custom_logo()): ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
            </div>
            <div class="header-right">
                <div class="site-text">
                    <<?php echo is_front_page() && is_home() ? 'h1' : 'p'; ?> class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </<?php echo is_front_page() && is_home() ? 'h1' : 'p'; ?>>
                    <div class="header-desc-cont"><?php if (get_bloginfo('description')): ?>
                            <p class="site-description"><?php bloginfo('description'); ?></p>
                        <?php endif; ?>
                        <?php if (get_theme_mod('gamer_heaven_show_header_search', true)): ?>
                            <div class="header-search">
                                <?php get_search_form(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="header-navigation">
                    <nav class="main-navigation"
                        aria-label="<?php esc_attr_e('Primary Navigation', 'gamer-heaven'); ?>">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                            'fallback_cb' => 'wp_page_menu',
                            'depth' => 3,
                        ));
                        ?>
                    </nav>
                </div>

            </div>
        </div>
    </header>
    <div class="container">