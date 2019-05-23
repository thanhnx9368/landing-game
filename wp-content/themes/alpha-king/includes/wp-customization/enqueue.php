<?php

/**
 * Adding scripts and styles
 * All your scripts and styles will be included in wp_head()
 */
add_action('wp_enqueue_scripts', 'tu_enqueue_scripts_styles');

function tu_enqueue_scripts_styles() {
    
    if (wp_script_is('media')) {
        wp_enqueue_media();
    }

    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', TEMPLATE_URL.'/assets/bower_components/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('slick-slider2', TEMPLATE_URL.'/assets/bower_components/slick-carousel/slick/slick.css');
    wp_enqueue_style('slick-slider1', TEMPLATE_URL.'/assets/bower_components/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style('partials', TEMPLATE_URL.'/assets/stylesheets/sass/dist/partials.css');
    wp_enqueue_style('main', TEMPLATE_URL.'/assets/stylesheets/sass/dist/main.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('slick_slider', TEMPLATE_URL . '/assets/bower_components/slick-carousel/slick/slick.min.js', array(), '0.2', false);
    wp_enqueue_script('main', TEMPLATE_URL . '/assets/scripts/main.js', array(), '0.1', false);

    $wp_script_data = array(
        'ADMIN_AJAX_URL' => ADMIN_AJAX_URL,
        'HOME_URL' => HOME_URL
    );

    wp_localize_script('main-script', 'wp_vars', $wp_script_data);
}



