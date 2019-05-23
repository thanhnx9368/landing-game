<?php
/**
 * Metabox Builder
 * @since 17/01/2018
 */

/* Contants */
define('WP_METABOX_COMPONENTS_URI', get_template_directory_uri() . '/includes/wp-libraries/wp-metabox-builder');
define('WP_METABOX_COMPONENTS_PATH', get_template_directory() . '/includes/wp-libraries/wp-metabox-builder');

/**
 * Adding scripts and styles to admin panel
 * All your scripts and styles will be included in wp_head()
 */
add_action('admin_enqueue_scripts', 'metabox_builder_admin_enqueue_scripts_styles');
function metabox_builder_admin_enqueue_scripts_styles() {
    wp_enqueue_style('metabox-buider-jquery-ui', WP_METABOX_COMPONENTS_URI . '/assets/bower_components/jquery-ui/themes/cupertino/jquery-ui.min.css');
    wp_enqueue_style('metabox-buider-style', WP_METABOX_COMPONENTS_URI . '/assets/css/style.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('metabox-buider-js', WP_METABOX_COMPONENTS_URI . '/assets/scripts/main.js', array(), '0.1', false);
}

require_once (WP_METABOX_COMPONENTS_PATH . '/components/checkbox.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/colorpicker.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/datepicker.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/editor.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/input.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/radio.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/selectbox.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/textarea.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/upload-image.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/upload-video.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/upload-document.php');
require_once (WP_METABOX_COMPONENTS_PATH . '/components/youtube-link.php'); 
require_once (WP_METABOX_COMPONENTS_PATH . '/components/data-list.php'); 

/**
 * Metabox Types
 * 
 * @param array $value
 */

function metaboxAnalyze( $value ) {

    switch ( $value['type'] ) : 

        case 'checkbox': 
            metabox_builder_checkbox( $value );
            break;

        case 'colorpicker': 
            metabox_builder_color_picker( $value );
            break;

        case 'datepicker': 
            metabox_builder_datepicker( $value );
            break;

        case 'editor': 
            metabox_builder_editor( $value );
            break;
            
        case 'input': 
            metabox_builder_input( $value );
            break;

        case 'textarea': 
            metabox_builder_textarea( $value );
            break; 
            
        case 'radio':
            metabox_builder_radio( $value );
            break;

        case 'selectbox':
            metabox_builder_selectbox( $value );
            break;

        case 'upload-image-single':
            metabox_builder_upload_image( $value );
            break;

        case 'upload-image-album':
            metabox_builder_upload_album_image( $value );
            break;

        case 'upload-video':
            metabox_builder_upload_video( $value );
            break;

        case 'upload-file': 
            metabox_builder_upload_file( $value );
            break;

        case 'input-link-youtube':
            metabox_builder_input_url_youtube( $value );
            break;

        case 'data-list':
            metabox_builder_data_list( $value );
            break;

        default:
            echo '<p class="note is-error">' . __('Config error.', TEXT_DOMAIN) . ' ' . $value['type'] . '</p>';
            break;

    endswitch;
    
}   

/**
 * Print Metabox Types
 * 
 * @param array $fields;
 */

function metaboxPrint( $fields = array() ) {

    if ( !is_array( $fields ) ) {
        return __('Input data is not array.', TEXT_DOMAIN);
    }

    if ( empty( $fields ) ) { 
        return __('Array is empty', TEXT_DOMAIN);
    }

    foreach ( $fields as $key => $item ) :
        metaboxAnalyze( $item );
    endforeach;

}