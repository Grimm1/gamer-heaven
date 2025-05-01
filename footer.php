<?php
/**
 * The footer for the Gamer Heaven theme.
 *
 * @package Gamer_Heaven
 */
?>
</div><!-- .container -->
<footer role="contentinfo">
    <div class="footer-container">
        <div class="footer-content">
            <p><?php bloginfo('name'); ?> © <?php echo date('Y'); ?>. <?php _e('All rights reserved.', 'gamer-heaven'); ?></p>
            <div class="social-icons">
                <?php
                $social_links = json_decode(get_theme_mod('gamer_heaven_social_links_repeater', '[]'), true);
                if (!is_array($social_links)) {
                    if (defined('WP_DEBUG') && WP_DEBUG) {
                        error_log('Gamer Heaven: Invalid social links JSON in footer');
                    }
                    $social_links = array();
                }
                echo '<ul class="social-links">';
                foreach ($social_links as $link) {
                    if (empty($link['url']) || empty($link['name']) || empty($link['icon'])) {
                        continue;
                    }
                    $icon_url = wp_get_attachment_image_url($link['icon'], 'thumbnail');
                    if ($icon_url) {
                        $platform_class = sanitize_title($link['name']);
                        printf(
                            '<li><a href="%s" class="%s"><img src="%s" alt="%s" class="social-icon"><span class="screen-reader-text">%s</span></a></li>',
                            esc_url($link['url']),
                            esc_attr($platform_class),
                            esc_url($icon_url),
                            esc_attr($link['name']),
                            esc_html($link['name'])
                        );
                    } else {
                        if (defined('WP_DEBUG') && WP_DEBUG) {
                            error_log('Gamer Heaven: Invalid icon ID ' . $link['icon'] . ' for ' . $link['name'] . ' in footer');
                        }
                    }
                }
                echo '</ul>';
                ?>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>