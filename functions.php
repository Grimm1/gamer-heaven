<?php
/**
 * Gamer Heaven Theme Functions
 *
 * This file contains the theme's setup, enqueues, and custom functionality.
 *
 * @package Gamer_Heaven
 */

/**
 * Set up theme defaults and register support for various WordPress features.
 */
function gamer_heaven_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('automatic-feed-links');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'gamer-heaven'),
        'footer'  => __('Footer Menu', 'gamer-heaven'),
    ));

    // Register sidebar
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'gamer-heaven'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets in this area will be shown site-wide on the right-hand side. Supports shortcodes.', 'gamer-heaven'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    add_theme_support('post-formats', array('gallery', 'video'));
    load_theme_textdomain('gamer-heaven', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'gamer_heaven_setup');

/**
 * Enqueue styles and scripts
 */
function gamer_heaven_scripts() {
    wp_enqueue_style('gamer-heaven-style', get_stylesheet_uri(), array(), '1.0.8');
    wp_enqueue_style('gamer-heaven-fonts', 'https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Black+Ops+One&display=swap', array(), null);
    wp_enqueue_script('gamer-heaven-scrollbar', get_template_directory_uri() . '/js/scrollbar-detect.js', array(), '1.0', true);

    $color_scheme = get_theme_mod('gamer_heaven_color_scheme', 'sci-fi');
    $custom_css = ':root {';
    if ($color_scheme === 'military') {
        $custom_css .= '
            --primary-color: rgb(178, 188, 129);
            --accent-color: #D2B48C;
            --background-color: #2F4F4F;
            --content-background: #586653;
            --sidebar-background: #33382F;
            --gradient-start: #3C4033;
            --gradient-end: #4A4E3F;
            --border-color: #555;
            --text-color: #E8ECE0;
            --meta-color: #B0B8A0;
            --primary-color-rgb: 75, 83, 32;
            --accent-color-rgb: 210, 180, 140;
            --body-font: "Black Ops One", Arial, sans-serif;
        ';
    } elseif ($color_scheme === 'military-tan') {
        $custom_css .= '
            --primary-color: #D2B48C;
            --accent-color: #8B4513;
            --background-color: #2F4F4F;
            --content-background: #586653;
            --sidebar-background: #33382F;
            --gradient-start: #3C4033;
            --gradient-end: #4A4E3F;
            --border-color: #555;
            --text-color: #E8ECE0;
            --meta-color: #B0B8A0;
            --primary-color-rgb: 210, 180, 140;
            --accent-color-rgb: 139, 69, 19;
            --body-font: "Black Ops One", Arial, sans-serif;
        ';
    } elseif ($color_scheme === 'sci-fi-blue') {
        $custom_css .= '
            --primary-color: #00ccff;
            --accent-color: #ffcc00;
            --background-color: #1a1a1a;
            --content-background: #2e2e2e;
            --sidebar-background: #222;
            --gradient-start: #1c2526;
            --gradient-end: #2e3b3e;
            --border-color: #444;
            --text-color: #e0e0e0;
            --meta-color: #b0b0b0;
            --primary-color-rgb: 0, 204, 255;
            --accent-color-rgb: 255, 204, 0;
            --body-font: "Orbitron", Arial, sans-serif;
        ';
    } else {
        $custom_css .= '
            --primary-color: #00ffcc;
            --accent-color: #ff007a;
            --background-color: #1a1a1a;
            --content-background: #2e2e2e;
            --sidebar-background: #222;
            --gradient-start: #1c2526;
            --gradient-end: #2e3b3e;
            --border-color: #444;
            --text-color: #e0e0e0;
            --meta-color: #b0b0b0;
            --primary-color-rgb: 0, 255, 204;
            --accent-color-rgb: 255, 0, 122;
            --body-font: "Orbitron", Arial, sans-serif;
        ';
    }
    $custom_css .= '}';
    wp_add_inline_style('gamer-heaven-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'gamer_heaven_scripts');

/**
 * Enqueue login page styles
 */
function gamer_heaven_login_styles() {
    $login_css_path = get_template_directory() . '/css/login.css';
    if (file_exists($login_css_path)) {
        wp_enqueue_style('gamer-heaven-login', get_template_directory_uri() . '/css/login.css', array(), '1.0.8');
        error_log('Gamer Heaven: Login styles enqueued successfully');
    } else {
        error_log('Gamer Heaven: Login CSS file not found at ' . $login_css_path);
    }
    wp_enqueue_style('gamer-heaven-fonts', 'https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Black+Ops+One&display=swap', array(), null);

    // Inline CSS for login logo
    $login_logo_id = get_theme_mod('gamer_heaven_login_logo', '');
    $custom_css = '';
    if ($login_logo_id) {
        $login_logo_url = wp_get_attachment_image_url($login_logo_id, 'medium');
        if ($login_logo_url) {
            $custom_css .= '
                .login h1 a {
                    background-image: url(' . esc_url($login_logo_url) . ') !important;
                    background-size: contain !important;
                    width: 300px !important;
                    height: 100px !important;
                    display: block;
                    text-indent: -9999px;
                }
            ';
            error_log('Gamer Heaven: Custom login logo set to ' . $login_logo_url);
        } else {
            error_log('Gamer Heaven: Invalid login logo ID ' . $login_logo_id);
        }
    } else {
        error_log('Gamer Heaven: No login logo set in Customizer');
    }
    wp_add_inline_style('gamer-heaven-login', $custom_css);
}
add_action('login_enqueue_scripts', 'gamer_heaven_login_styles');

/**
 * Customize login page logo URL
 */
function gamer_heaven_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'gamer_heaven_login_logo_url');

/**
 * Customize login page logo title
 */
function gamer_heaven_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'gamer_heaven_login_logo_title');

/**
 * Sanitize color scheme
 */
function gamer_heaven_sanitize_color_scheme($input) {
    $valid = array('sci-fi', 'sci-fi-blue', 'military', 'military-tan');
    return in_array($input, $valid) ? $input : 'sci-fi';
}

/**
 * Custom Social Repeater Control
 */
if (class_exists('WP_Customize_Control')) {
    class Gamer_Heaven_Social_Repeater_Control extends WP_Customize_Control {
        public $type = 'social-repeater';

        public function enqueue() {
            wp_enqueue_media();
            wp_enqueue_script(
                'gamer-heaven-social-repeater',
                get_template_directory_uri() . '/js/social-repeater.js',
                array('jquery', 'customize-controls'),
                '1.0.3',
                true
            );
            wp_enqueue_style(
                'gamer-heaven-social-repeater',
                get_template_directory_uri() . '/css/social-repeater.css',
                array(),
                '1.0.3'
            );
        }

        public function render_content() {
            $value = $this->value() ? $this->value() : json_encode(array(array('name' => '', 'url' => '', 'icon' => '')));
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            </label>
            <div class="social-repeater-container" data-control-id="<?php echo esc_attr($this->id); ?>">
                <div class="social-repeater-fields">
                    <?php
                    $links = json_decode($value, true);
                    if (!is_array($links) || empty($links)) {
                        $links = array(array('name' => '', 'url' => '', 'icon' => ''));
                    }
                    foreach ($links as $index => $link) {
                        $link = wp_parse_args($link, array('name' => '', 'url' => '', 'icon' => ''));
                        ?>
                        <div class="social-repeater-field" data-index="<?php echo esc_attr($index); ?>">
                            <div class="social-repeater SINGLE-row">
                                <label>
                                    <span><?php _e('Platform Name', 'gamer-heaven'); ?></span>
                                    <input type="text" class="social-repeater-name" value="<?php echo esc_attr($link['name']); ?>" />
                                </label>
                                <label>
                                    <span><?php _e('URL', 'gamer-heaven'); ?></span>
                                    <input type="url" class="social-repeater-url" value="<?php echo esc_url($link['url']); ?>" />
                                </label>
                                <label>
                                    <span><?php _e('Icon', 'gamer-heaven'); ?></span>
                                    <div class="social-repeater-icon-upload">
                                        <input type="hidden" class="social-repeater-icon" value="<?php echo esc_attr($link['icon']); ?>" />
                                        <img src="<?php echo $link['icon'] ? esc_url(wp_get_attachment_image_url($link['icon'], 'thumbnail')) : ''; ?>" class="social-repeater-icon-preview" style="max-width: 50px; <?php echo $link['icon'] ? '' : 'display: none;'; ?>" />
                                        <button type="button" class="button social-repeater-upload-button"><?php _e('Upload Icon', 'gamer-heaven'); ?></button>
                                        <button type="button" class="button social-repeater-remove-icon" style="<?php echo $link['icon'] ? '' : 'display: none;'; ?>"><?php _e('Remove Icon', 'gamer-heaven'); ?></button>
                                    </div>
                                </label>
                                <button type="button" class="button social-repeater-remove"><?php _e('Remove', 'gamer-heaven'); ?></button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <button type="button" class="button social-repeater-add"><?php _e('Add New Link', 'gamer-heaven'); ?></button>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($value); ?>" class="social-repeater-value" />
            </div>
            <?php
        }
    }
}

/**
 * Add Customizer settings
 */
function gamer_heaven_customizer_settings($wp_customize) {
    if (!isset($wp_customize)) return;

    // Theme Options Section
    $wp_customize->add_section('gamer_heaven_theme_options', array(
        'title'       => __('Theme Options', 'gamer-heaven'),
        'priority'    => 130,
        'capability'  => 'edit_theme_options',
    ));

    $wp_customize->add_setting('gamer_heaven_color_scheme', array(
        'default'           => 'sci-fi',
        'sanitize_callback' => 'gamer_heaven_sanitize_color_scheme',
        'capability'       => 'edit_theme_options',
    ));

    $wp_customize->add_control('gamer_heaven_color_scheme', array(
        'label'    => __('Color Scheme', 'gamer-heaven'),
        'section'  => 'gamer_heaven_theme_options',
        'type'     => 'select',
        'choices'  => array(
            'sci-fi'       => __('Sci-Fi', 'gamer-heaven'),
            'sci-fi-blue'  => __('Sci-Fi Blue', 'gamer-heaven'),
            'military'     => __('Military', 'gamer-heaven'),
            'military-tan' => __('Military Tan', 'gamer-heaven'),
        ),
        'priority' => 10,
    ));

    $wp_customize->add_setting('gamer_heaven_default_thumbnail', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'       => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gamer_heaven_default_thumbnail', array(
        'label'       => __('Default Post Thumbnail', 'gamer-heaven'),
        'section'     => 'gamer_heaven_theme_options',
        'mime_type'   => 'image',
        'description' => __('Select a default image for posts without a featured image.', 'gamer-heaven'),
        'priority'    => 20,
    )));

    // Login Page Section
    $wp_customize->add_section('gamer_heaven_login_page', array(
        'title'       => __('Login Page', 'gamer-heaven'),
        'priority'    => 135,
        'capability'  => 'edit_theme_options',
        'description' => __('Customize the WordPress login page.', 'gamer-heaven'),
    ));

    $wp_customize->add_setting('gamer_heaven_login_logo', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'       => 'edit_theme_options',
        'transport'        => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gamer_heaven_login_logo', array(
        'label'       => __('Login Page Logo', 'gamer-heaven'),
        'section'     => 'gamer_heaven_login_page',
        'mime_type'   => 'image',
        'description' => __('Upload a logo for the login page (recommended size: 300x100).', 'gamer-heaven'),
        'priority'    => 10,
    )));

    // Social Media Links Section
    $wp_customize->add_section('gamer_heaven_social_links', array(
        'title'       => __('Social Media Links', 'gamer-heaven'),
        'priority'    => 140,
        'capability'  => 'edit_theme_options',
        'description' => __('Add, remove, or edit social media links and icons for the footer.', 'gamer-heaven'),
    ));

    $wp_customize->add_setting('gamer_heaven_social_links_repeater', array(
        'default'           => json_encode(array(array('name' => '', 'url' => '', 'icon' => ''))),
        'sanitize_callback' => 'gamer_heaven_sanitize_social_repeater',
        'capability'       => 'edit_theme_options',
        'transport'        => 'postMessage',
    ));

    if (class_exists('Gamer_Heaven_Social_Repeater_Control')) {
        $wp_customize->add_control(new Gamer_Heaven_Social_Repeater_Control($wp_customize, 'gamer_heaven_social_links_repeater', array(
            'label'       => __('Social Media Links', 'gamer-heaven'),
            'section'     => 'gamer_heaven_social_links',
            'settings'    => 'gamer_heaven_social_links_repeater',
            'description' => __('Add platforms, their URLs, and icons to display in the footer.', 'gamer-heaven'),
            'priority'    => 10,
        )));
    }

    // Background Images Section
    $wp_customize->add_section('gamer_heaven_background_images', array(
        'title'       => __('Background Images', 'gamer-heaven'),
        'priority'    => 150,
        'capability'  => 'edit_theme_options',
        'description' => __('Upload and crop images to display at the bottom-left and bottom-right of the page.', 'gamer-heaven'),
    ));

    $wp_customize->add_setting('gamer_heaven_left_background_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'       => 'edit_theme_options',
        'transport'        => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'gamer_heaven_left_background_image', array(
        'label'       => __('Bottom Left Background Image', 'gamer-heaven'),
        'section'     => 'gamer_heaven_background_images',
        'mime_type'   => 'image',
        'description' => __('Upload and crop an image for the bottom-left corner. Suggested size: 1920x1080.', 'gamer-heaven'),
        'priority'    => 10,
        'width'       => 1920,
        'height'      => 1080,
        'flex_width'  => true,
        'flex_height' => true,
    )));

    $wp_customize->add_setting('gamer_heaven_right_background_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'       => 'edit_theme_options',
        'transport'        => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'gamer_heaven_right_background_image', array(
        'label'       => __('Bottom Right Background Image', 'gamer-heaven'),
        'section'     => 'gamer_heaven_background_images',
        'mime_type'   => 'image',
        'description' => __('Upload and crop an image for the bottom-right corner. Suggested size: 1920x1080.', 'gamer-heaven'),
        'priority'    => 20,
        'width'       => 1920,
        'height'      => 1080,
        'flex_width'  => true,
        'flex_height' => true,
    )));
}
add_action('customize_register', 'gamer_heaven_customizer_settings');

/**
 * Sanitize social repeater
 */
function gamer_heaven_sanitize_social_repeater($input) {
    if (!is_string($input)) {
        error_log('Gamer Heaven: Invalid social repeater input, not a string');
        return json_encode(array());
    }

    $decoded = json_decode($input, true);
    if (!is_array($decoded)) {
        error_log('Gamer Heaven: Invalid social repeater JSON');
        return json_encode(array());
    }

    $sanitized = array();
    foreach ($decoded as $item) {
        if (!isset($item['name']) || !isset($item['url']) || !isset($item['icon'])) {
            error_log('Gamer Heaven: Skipping incomplete social link: ' . json_encode($item));
            continue;
        }
        $sanitized[] = array(
            'name' => sanitize_text_field($item['name']),
            'url'  => esc_url_raw($item['url']),
            'icon' => absint($item['icon']),
        );
    }
    return json_encode($sanitized);
}

/**
 * Get default thumbnail
 */
function gamer_heaven_get_default_thumbnail() {
    $thumbnail_id = get_theme_mod('gamer_heaven_default_thumbnail', '');
    return $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : get_template_directory_uri() . '/images/default-thumbnail.jpg';
}

/**
 * Customizer preview JS
 */
function gamer_heaven_customizer_preview_js() {
    wp_enqueue_script(
        'gamer-heaven-customizer-preview',
        get_template_directory_uri() . '/js/customizer-preview.js',
        array('customize-preview', 'jquery'),
        '1.0.2',
        true
    );
    wp_localize_script(
        'gamer-heaven-customizer-preview',
        'gamer_heaven_customizer',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}
add_action('customize_preview_init', 'gamer_heaven_customizer_preview_js');

/**
 * AJAX handler for icon URL
 */
function gamer_heaven_get_icon_url() {
    if (isset($_POST['icon_id']) && is_numeric($_POST['icon_id'])) {
        $icon_id = absint($_POST['icon_id']);
        $url = wp_get_attachment_image_url($icon_id, 'full');
        if ($url) {
            wp_send_json_success($url);
        } else {
            error_log('Gamer Heaven: Invalid icon ID ' . $icon_id . ' in AJAX request');
            wp_send_json_error('Invalid icon ID');
        }
    }
    wp_send_json_error('Missing icon ID');
}
add_action('wp_ajax_gamer_heaven_get_icon_url', 'gamer_heaven_get_icon_url');

/**
 * Output background images in body
 */
function gamer_heaven_output_background_images() {
    $left_image_id = get_theme_mod('gamer_heaven_left_background_image', '');
    $right_image_id = get_theme_mod('gamer_heaven_right_background_image', '');

    if ($left_image_id) {
        $left_image_url = wp_get_attachment_image_url($left_image_id, 'full');
        if ($left_image_url) {
            echo '<img src="' . esc_url($left_image_url) . '" class="gamer-heaven-background-image gamer-heaven-left-background" alt="' . esc_attr__('Bottom Left Background', 'gamer-heaven') . '">';
        } else {
            error_log('Gamer Heaven: Invalid left background image ID ' . $left_image_id);
        }
    }

    if ($right_image_id) {
        $right_image_url = wp_get_attachment_image_url($right_image_id, 'full');
        if ($right_image_url) {
            echo '<img src="' . esc_url($right_image_url) . '" class="gamer-heaven-background-image gamer-heaven-right-background" alt="' . esc_attr__('Bottom Right Background', 'gamer-heaven') . '">';
        } else {
            error_log('Gamer Heaven: Invalid right background image ID ' . $right_image_id);
        }
    }
}
add_action('wp_footer', 'gamer_heaven_output_background_images');

/**
 * Add "Admin Only" checkbox to nav menu items in Menus screen and Customizer
 */
/**
 * Add "Admin Only" checkbox to nav menu items in Menus screen and Customizer
 */
function gamer_heaven_nav_menu_item_fields($item_id, $item, $depth, $args, $id) {
    // Validate $item_id to prevent errors
    if (!is_numeric($item_id) || $item_id <= 0) {
        error_log('Gamer Heaven: Invalid item_id in nav menu item fields: ' . print_r($item_id, true));
        return;
    }

    error_log('Gamer Heaven: Rendering nav menu item fields for item ' . $item_id . ' in context: ' . (wp_doing_ajax() ? 'AJAX' : (is_customize_preview() ? 'Customizer' : 'Menus screen')));

    $admin_only = get_post_meta($item_id, '_menu_item_admin_only', true);
    ?>
    <p class="field-admin-only description description-wide">
        <label for="edit-menu-item-admin-only-<?php echo esc_attr($item_id); ?>">
            <input type="checkbox" id="edit-menu-item-admin-only-<?php echo esc_attr($item_id); ?>" class="gamer-heaven-admin-only-checkbox" name="menu-item-admin-only[<?php echo esc_attr($item_id); ?>]" <?php checked($admin_only, '1'); ?> value="1" />
            <?php _e('Admin Only (Visible only to administrators)', 'gamer-heaven'); ?>
        </label>
    </p>
    <?php
    error_log('Gamer Heaven: Rendered admin-only checkbox for item ' . $item_id);
}
add_action('wp_nav_menu_item_custom_fields', 'gamer_heaven_nav_menu_item_fields', 10, 5);

/**
 * Save "Admin Only" checkbox value for Menus screen and Customizer
 */
function gamer_heaven_save_nav_menu_item_fields($menu_id, $menu_item_db_id, $args) {
    error_log('Gamer Heaven: Saving nav menu item ' . $menu_item_db_id);
    if (isset($_POST['menu-item-admin-only'][$menu_item_db_id]) && $_POST['menu-item-admin-only'][$menu_item_db_id] === '1') {
        update_post_meta($menu_item_db_id, '_menu_item_admin_only', '1');
        error_log('Gamer Heaven: Admin Only set to 1 for item ' . $menu_item_db_id);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_admin_only');
        error_log('Gamer Heaven: Admin Only unset for item ' . $menu_item_db_id);
    }
}
add_action('wp_update_nav_menu_item', 'gamer_heaven_save_nav_menu_item_fields', 10, 3);

/**
 * Filter menu items to hide "Admin Only" links from non-admins
 */
function gamer_heaven_filter_nav_menu_items($items, $args) {
    if (is_admin()) {
        return $items; // Don't filter in the admin area
    }

    $filtered_items = array();
    foreach ($items as $item) {
        $admin_only = get_post_meta($item->ID, '_menu_item_admin_only', true);
        if ($admin_only && !current_user_can('manage_options')) {
            continue; // Skip this item if it's admin-only and the user isn't an admin
        }
        $filtered_items[] = $item;
    }
    return $filtered_items;
}
add_filter('wp_nav_menu_objects', 'gamer_heaven_filter_nav_menu_items', 10, 2);

/**
 * Enqueue JavaScript for Customizer menu item checkbox
 */
function gamer_heaven_enqueue_customizer_menu_scripts() {
    wp_enqueue_script(
        'gamer-heaven-customizer-menu',
        get_template_directory_uri() . '/js/customizer-menu.js',
        array('jquery', 'customize-controls', 'nav-menu'),
        '1.0.5',
        true
    );
    wp_localize_script(
        'gamer-heaven-customizer-menu',
        'gamer_heaven_customizer',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
    error_log('Gamer Heaven: Customizer menu script enqueued');
}
add_action('customize_controls_enqueue_scripts', 'gamer_heaven_enqueue_customizer_menu_scripts');

/**
 * AJAX handler to get "Admin Only" checkbox HTML for Customizer
 */
function gamer_heaven_get_admin_only_checkbox() {
    if (isset($_POST['item_id']) && is_numeric($_POST['item_id'])) {
        $item_id = absint($_POST['item_id']);
        $admin_only = get_post_meta($item_id, '_menu_item_admin_only', true);
        ob_start();
        ?>
        <p class="field-admin-only description description-wide">
            <label for="edit-menu-item-admin-only-<?php echo esc_attr($item_id); ?>">
                <input type="checkbox" id="edit-menu-item-admin-only-<?php echo esc_attr($item_id); ?>" class="gamer-heaven-admin-only-checkbox" name="menu-item-admin-only[<?php echo esc_attr($item_id); ?>]" <?php checked($admin_only, '1'); ?> value="1" />
                <?php _e('Admin Only (Visible only to administrators)', 'gamer-heaven'); ?>
            </label>
        </p>
        <?php
        $html = ob_get_clean();
        error_log('Gamer Heaven: Generated admin-only checkbox HTML for item ' . $item_id);
        wp_send_json_success($html);
    }
    error_log('Gamer Heaven: Invalid item ID in get_admin_only_checkbox');
    wp_send_json_error('Invalid item ID');
}
add_action('wp_ajax_gamer_heaven_get_admin_only_checkbox', 'gamer_heaven_get_admin_only_checkbox');

?>