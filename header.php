<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header<?php echo is_admin_bar_showing() ? ' class="has-admin-bar"' : ''; ?>>
        <div class="header-container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
            </div>
            <div class="header-right">
                <div class="site-text">
                    <<?php echo is_front_page() && is_home() ? 'h1' : 'p'; ?> class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </<?php echo is_front_page() && is_home() ? 'h1' : 'p'; ?>>
                    <?php if (get_bloginfo('description')) : ?>
                        <p class="site-description"><?php bloginfo('description'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="header-navigation">
                    <nav class="main-navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'gamer-heaven'); ?>">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                            'fallback_cb' => 'wp_page_menu',
                            'depth' => 2,
                        ));
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container<?php echo is_admin_bar_showing() ? ' has-admin-bar' : ''; ?>">