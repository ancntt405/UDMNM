<?php
function mytheme_enqueue_assets() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');

   // Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');

    // Theme CSS (riêng)
    wp_enqueue_style('mytheme-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');

    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);

    // Theme JS (riêng)
    wp_enqueue_script('mytheme-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);

}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');


function mytheme_setup() {
    // Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Title & Description
    add_theme_support('title-tag');

    // Favicon
    add_theme_support('site-icon');

    // Menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
    ));

    // Ảnh đại diện cho bài viết
    add_theme_support('post-thumbnails');

}
add_action('after_setup_theme', 'mytheme_setup');

// navbar Bootstrap 
class Bootstrap_Navwalker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent  = str_repeat("\t", $depth);
        $submenu = $depth > 0 ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent  = str_repeat("\t", $depth);
        $classes = (array) $item->classes;
        
        // Thêm class cho <li>
        $classes[] = 'nav-item';
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }
        $class_names = ' class="' . esc_attr(implode(' ', array_filter($classes))) . '"';
        $id_attr     = ' id="menu-item-' . esc_attr($item->ID) . '"';

        $output .= $indent . "<li$id_attr$class_names>";

        // Thuộc tính cho <a>
        $atts = [
            'title'  => $item->attr_title ?: '',
            'target' => $item->target ?: '',
            'rel'    => $item->xfn ?: '',
            'href'   => $item->url ?: '',
            'class'  => 'nav-link'
        ];

        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $atts['class']          .= ' dropdown-toggle';
            $atts['data-bs-toggle']  = 'dropdown';
            $atts['aria-haspopup']   = 'true';
            $atts['aria-expanded']   = 'false';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if ($value) {
                $value = $attr === 'href' ? esc_url($value) : esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $title       = apply_filters('the_title', $item->title, $item->ID);
        $item_output = $args->before
                        . "<a$attributes>"
                        . $args->link_before . $title . $args->link_after
                        . '</a>'
                        . $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

//footer
// Thêm section Contact vào Customizer
function theme_customize_register($wp_customize) {

    // Section Liên hệ
    $wp_customize->add_section('contact_section', array(
        'title'       => __('Footer (Dưới)', 'textdomain'),
        'priority'    => 30,
        'description' => 'Cập nhật thông tin liên hệ hiển thị ở footer'
    ));

    // Address
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Điền địa chỉ',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_address', array(
        'label' => __('Địa chỉ', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('contact_email', array(
        'default' => 'Điền email',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('contact_email', array(
        'label' => __('Email', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'email',
    ));

    // Phone
    $wp_customize->add_setting('contact_phone', array(
        'default' => 'Điền số điện thoại',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_phone', array(
        'label' => __('Số điện thoại', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'text',
    ));

        // Facebook
    $wp_customize->add_setting('social_facebook', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_facebook', array(
        'label' => __('Facebook', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'url',
    ));

    // Twitter(X)
    $wp_customize->add_setting('social_twitter', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_twitter', array(
        'label' => __('Twitter', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'url',
    ));

    // TikTok
    $wp_customize->add_setting('social_tiktok', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('social_tiktok', array(
        'label' => __('TikTok', 'textdomain'),
        'section' => 'contact_section',
        'type' => 'url',
    ));
}
add_action('customize_register', 'theme_customize_register');


?>
