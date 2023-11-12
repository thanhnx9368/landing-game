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


function is_player_exist($phone) {
    $args = array(
        'post_type' => 'contact',
        'paged' => 1,
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'contact_phone',
                'value'   => $phone,
                'compare' => '=',
            ),
        ),
    );

    $posts = new WP_Query($args);

    if ( $posts->have_posts() ) return true;
    return false;
}


/**
 * AJAX HANDLE
 */

/*Insert subscriber user form*/
add_action( 'wp_ajax_check_is_exist_phone_number_ajax', 'check_is_exist_phone_number_ajax' );
add_action( 'wp_ajax_nopriv_check_is_exist_phone_number_ajax', 'check_is_exist_phone_number_ajax' );

function check_is_exist_phone_number_ajax() {

    if (!isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'check_is_exist_phone_number_nonce') )
    {
        echo json_encode( array('success' => false, 'msg' => 'Phiên làm việc đã hết, vui lòng tải lại trang và thử lại.') );
        exit;
    }
    $request = array();
    $request['player_phone'] = isset( $_POST['player_phone'] ) ? $_POST['player_phone'] : '';

    if ( is_player_exist($request['player_phone']) ) {
        echo json_encode(array('success' => false, 'msg' =>  'Liên hệ này đã đăng ký. Vui lòng thử lại!'));
        exit;
    }

    echo json_encode( array('success' => true, 'msg' => 'Done') );
    exit;

}



/**
 * AJAX HANDLE
 */

/*Insert subscriber user form*/
add_action( 'wp_ajax_call_post_info_player_ajax', 'call_post_info_player_ajax' );
add_action( 'wp_ajax_nopriv_call_post_info_player_ajax', 'call_post_info_player_ajax' );

function call_post_info_player_ajax() {

    if (!isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'call_post_info_player_nonce') )
    {
        echo json_encode( array('success' => false, 'msg' => 'Phiên làm việc đã hết, vui lòng tải lại trang và thử lại.') );
        exit;
    }
    $request = array();
    $request['contact_name'] = isset( $_POST['contact_name'] ) ? $_POST['contact_name'] : '';
    $request['contact_phone'] = isset( $_POST['contact_phone'] ) ? $_POST['contact_phone'] : '';
    $request['game_prize'] = isset( $_POST['game_prize'] ) ? $_POST['game_prize'] : '';

    /*insert post*/
    $post_data = array(
        'post_title' => $request['contact_name'] . ' - ' . $request['contact_phone'] . ' - ' . $request['game_prize'],
        'post_content' => '',
        'post_status' => 'pending',
        'post_type' => 'contact'
    );

    $player_new_post = wp_insert_post($post_data);

    if( !is_wp_error( $player_new_post ) ) {
        update_post_meta( $player_new_post, 'contact_name', $request['contact_name'] );
        update_post_meta( $player_new_post, 'contact_phone', $request['contact_phone'] );
        update_post_meta( $player_new_post, 'game_prize', $request['game_prize'] );


        $full_name = get_post_meta($player_new_post, 'contact_name', true);
        $contact_phone = get_post_meta($player_new_post, 'contact_phone', true);
        $game_prize = get_post_meta($player_new_post, 'game_prize', true);


        $subject = 'Alpha King\'s Charity: NGÀN HÀNH ĐỘNG NHỎ TRIỆU NGHĨA CỬ LỚN';

        $content = "<p style='font-size:16px'> Website của bạn vừa có lượt quay từ thiện mới: </p> <br/>";
        $content .= "<p style='font-size:14px'><b>Thông tin cơ bản</b></p>";
        $content .= "<p style='font-size:14px'>Họ & Tên: .$full_name .</p>";
        $content .= "<p style='font-size:14px'>Số điện thoại: .$contact_phone .</p>";
        $content .= "<p style='font-size:14px'>Đóng góp: .$game_prize .</p>";

        $content .= "<i style='font-size:14px'>Trân trọng!</i><br/>";

//        $send_mail = wp_mail('Alphacity.akr@gmail.com', $subject, $content);

        setcookie('userSave', 'success', time() + (1 * 365 * 24 * 60 * 60 ), '/');

        echo json_encode( array('success' => true, 'msg' => 'Done') );
        exit;
    }
    else {
        echo json_encode( array('success' => false, 'msg' => 'Có lỗi trong quá trình gửi thông tin. Vui lòng thử lại!') );
        exit;
    }

}



/**
 * POST META BOXES ----------- ----------- -----------
 */
add_action('admin_init', 'tu_add_meta_box_contact');
function tu_add_meta_box_contact() {

    /** Meta box for general information */
    function tu_display_meta_box_contact_general($post) {
        $post_id = $post->ID;
        $game_prize = get_post_meta($post_id, 'game_prize', true);
        $contact_name = get_post_meta($post_id, 'contact_name', true);
        $contact_phone = get_post_meta($post_id, 'contact_phone', true);
        ?>
        <table class="form-table">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('save_metabox_contact'); ?>">
            <tbody>
            <tr>
                <th scope="row"><label><?php _e('Họ tên', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_name; ?></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('SĐT', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $contact_phone; ?></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Mức đóng góp', TEXT_DOMAIN); ?></label></th>
                <td><?php echo $game_prize; ?></td>
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
    $menu[6][0] .= $contacts ? '&nbsp;<span class="update-plugins count-1" title="' .__('Bạn có', TEXT_DOMAIN).' '. count($contacts) .' '. __('thư chưa trả lời', TEXT_DOMAIN).'"><span class="update-count">' . count($contacts) . '</span></span>' : '';
}
