<?php
/**
 * TODO:
 * Chức năng export ra Excel
 */

/**
 * INITIALIZE ----------- ----------- -----------
 */
add_action('init', 'tu_reg_post_type_contact');
function tu_reg_post_type_contact() {

    //Change this when creating post type
    $post_type_name = __('Liên hệ', TEXT_DOMAIN);
    $post_type_name_lower = mb_strtolower($post_type_name, 'utf-8');
    $post_type_menu_position = 3;

    $labels = array(
        'name' => $post_type_name,
        'singular_name' => $post_type_name,
        'menu_name' => $post_type_name,
        'all_items' => __('Tất cả', TEXT_DOMAIN).' '.$post_type_name_lower,
        'add_new' => __('Thêm mới', TEXT_DOMAIN),
        'add_new_item' => __('Thêm mới', TEXT_DOMAIN).' '.$post_type_name_lower,
        'edit_item' => __('Chỉnh sửa', TEXT_DOMAIN).' '.$post_type_name_lower,
        'new_item' => $post_type_name,
        'view_item' => __('Xem chi tiết', TEXT_DOMAIN),
        'search_items' => __('Tìm kiếm', TEXT_DOMAIN),
        'not_found' => __('Không tìm thấy bản ghi nào', TEXT_DOMAIN),
        'not_found_in_trash' => __('Không có bản ghi nào trong thùng rác', TEXT_DOMAIN),
        'view' => __('Xem', TEXT_DOMAIN).' '.$post_type_name_lower,
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_in_nav_menus' => false,
        'show_ui' => true,

        //Change this when creating post type
        'description' => $post_type_name,
        'menu_position' => $post_type_menu_position,
        'menu_icon' => 'dashicons-feedback',
        'supports' => array('title'),
        'rewrite' => null,
        'has_archive' => false
    );

    register_post_type('contact', $args);
}

add_action('admin_init', 'tu_contact_remove_sub_menu');
function tu_contact_remove_sub_menu(){
    global $submenu;

    if(isset($submenu['edit.php?post_type=contact'][10])){
        unset($submenu['edit.php?post_type=contact'][10]);
    }
}

/**
 * RETRIEVING FUNCTIONS ----------- ----------- -----------
 */

/**
 * Get contacts
 *
 * @param int   $page
 * @param int   $post_per_page
 * @param array $custom_args
 *
 * @return WP_Query
 */
function tu_get_contact_with_pagination($page = 1, $post_per_page = 10, $custom_args = array()) {

    $args = array(
        'post_type' => 'contact',
        'posts_per_page' => $post_per_page,
        'paged' => $page,
        'post_status' => 'pending',
        'tax_query' => array()
    );

    $args = array_merge($args, $custom_args);

    $posts = new WP_Query($args);

    return $posts;
}

/**
 * POST META BOXES ----------- ----------- -----------
 */
add_action('admin_init', 'tu_add_meta_box_contact');
function tu_add_meta_box_contact() {

    /** Meta box for general information */
    function tu_display_meta_box_contact_general($post) {
        $post_id = $post->ID;
        $contact_email = get_post_meta($post_id, 'contact_email', true);
        $contact_name = get_post_meta($post_id, 'contact_name', true);
        $contact_phone = get_post_meta($post_id, 'contact_phone', true);
        $contact_content = $post->post_content;
        ?>
        <table class="form-table">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('save_metabox_contact'); ?>">
            <tbody>
            <tr>
                <th scope="row"><label><?php _e('Họ tên', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_name; ?></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Email', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_email; ?></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('SĐT', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_phone; ?></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Nội dung', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_content; ?></td>
            </tr>
            </tbody>
        </table>
    <?php
    }

    add_meta_box(
        'tu_display_meta_box_contact_general', __('Thông tin liên hệ', TEXT_DOMAIN), 'tu_display_meta_box_contact_general', 'contact', 'normal', 'high'
    );
}

/**
 * NOTIFICATION ----------- ----------- -----------
 */
add_action('admin_menu', 'tu_contact_admin_menu_notification');
function tu_contact_admin_menu_notification() {
    global $menu;
    $contacts = get_posts(array('post_type' => 'contact', 'posts_per_page' => -1, 'post_status' => 'pending'));
    $menu[3][0] .= $contacts ? '&nbsp;<span class="update-plugins count-1" title="' .__('Bạn có', TEXT_DOMAIN).' '. count($contacts) .' '. __('thư chưa trả lời', TEXT_DOMAIN).'"><span class="update-count">' . count($contacts) . '</span></span>' : '';
}