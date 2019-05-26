<?php

/**
 * Define constants
 * These constants will be used globally
 */
define('BLOG_NAME', get_option('blogname'));
define('HOME_URL', home_url('/'));
define('TEMPLATE_URL', get_template_directory_uri());
define('TEMPLATE_PATH', get_template_directory());
define('ADMIN_AJAX_URL', admin_url('admin-ajax.php'));
define('IMAGE_URL', TEMPLATE_URL . '/assets/images');
define('NO_IMAGE_URL', IMAGE_URL.'/no-image.png');
define('TEXT_DOMAIN', 'tu');

/**
 * Constants for configuration
 */
define('FACEBOOK_APP_ID', '265896227245567');

/**
 * Including core stuffs
 */
include_once(TEMPLATE_PATH . '/includes/init.php');

/**
 * Including post-types files
 * You can create more post-types if you need but you should use the structure of existed files
 */
include_once(TEMPLATE_PATH . '/post-types/game.php');
include_once(TEMPLATE_PATH . '/post-types/contact.php');



function show_array($name) {
    echo "<pre>";
    print_r($name);
    echo "</pre>";
}
