<?php
/**
 * INITIALIZE ----------- ----------- -----------
 */

add_action('init', 'tu_reg_post_type_game');

function tu_reg_post_type_game() {

    //Change this when creating post type
    $post_type_name = 'Cơ cấu giải thưởng';
    $post_type_name_lower = mb_strtolower($post_type_name, 'utf-8');
    $post_type_name_slug = tu_remove_accent($post_type_name, '-');
    $post_type_menu_position = 3;

    $labels = array(
        'name' => $post_type_name,
        'singular_name' => $post_type_name,
        'menu_name' => $post_type_name,
        'all_items' => 'Tất cả '.$post_type_name_lower,
        'add_new' => 'Thêm mới',
        'add_new_item' => 'Thêm mới '.$post_type_name_lower,
        'edit_item' => 'Chỉnh sửa '.$post_type_name_lower,
        'new_item' => $post_type_name,
        'view_item' => 'Xem chi tiết',
        'search_items' => 'Tìm kiếm',
        'not_found' => 'Không tìm thấy bản ghi nào',
        'not_found_in_trash' => 'Không có bản ghi nào trong thùng rác',
        'view' => 'Xem'.$post_type_name_lower,
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
        'menu_icon' => 'dashicons-welcome-write-blog',
        'supports' => array('title'),
        /*'rewrite' => array(
            'slug' => 'tin-tuc'
        ),*/

        //Use `Page Template` instead, it is more easy to custom
        'has_archive' => false
    );

    register_post_type('game', $args);

}

/**
 * RETRIEVING FUNCTIONS ----------- ----------- -----------
 */

/**
 * Get games
 *
 * @param int   $page
 * @param int   $post_per_page
 * @param array $custom_args
 *
 * @return WP_Query
 */
function tu_get_game_with_pagination($page = 1, $post_per_page = 10, $custom_args = array()) {

    $args = array(
        'post_type' => 'game',
        'posts_per_page' => $post_per_page,
        'paged' => $page,
        's' => '',
        'post_status' => 'publish',
        'tax_query' => array(),
        'meta_query' => array(),
    );
    // Push Taxonomy
    if (isset($custom_args['game_category'])) {

        array_push($args['tax_query'], array(
            'taxonomy' => 'game_category',
            'field' => 'id',
            'terms' => $custom_args['game_category']
        ));

        unset($custom_args['game_category']);
    }
    // Push game is hot
    if (isset($custom_args['game_is_hot'])) {

        array_push($args['meta_query'], array(
            'key'     => 'game_is_hot',
            'value'   => $custom_args['game_is_hot'],
            'compare' => '=',
        ));

        unset($custom_args['game_is_hot']);
    }

    if (isset( $custom_args['post__not_in'] ) && $custom_args['post__not_in'])  {
        $custom_args['post__not_in'] = $custom_args['post__not_in'];
    }

    if (isset($custom_args['s'])) {
        $args['s'] = $custom_args['s'];
    }

    $args = array_merge($args, $custom_args);

    $posts = new WP_Query($args);

    return $posts;
}



add_action('admin_init', 'tu_add_meta_box_game');
function tu_add_meta_box_game() {

    function tu_display_meta_box_prize_general($post) {
        $post_id = $post->ID;
        $game_prize_code = get_post_meta($post_id, 'game_prize_code', true);
        ?>
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="game_prize_code">Mã giải thưởng</label></th>
                <td>
                    <input type="text" class="regular-text" name="game_prize_code" value="<?php echo $game_prize_code; ?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <h3>Ví dụ:</h3>
                    <em>- 1 lọ (500 nghìn) thì nhập giá trị trong ô = 1</em>
                </th>
                <td>
                    <em></em>
                    <p>1 lọ (500 nghìn)</p> = <b>1</b>
                    <p>2 lọ (1 triệu)</p> = <b>2</b>
                    <p>5 lọ (2.5 triệu)</p> = <b>5</b>
                    <p>8 lọ (4 triệu)</p> = <b>8</b>
                    <p>10 lọ (5 triệu)</p> = <b>10</b>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
    }

    add_meta_box( 'tu_display_meta_box_prize_general', 'Thông tin giải thưởng', 'tu_display_meta_box_prize_general', 'game', 'normal', 'high' );
}

add_action('save_post', 'tu_save_meta_box_game');
function tu_save_meta_box_game($post_id) {

    // Autosave, do nothing
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    // AJAX? Not used here
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
    // Check user permissions
    if (!current_user_can('edit_post', $post_id))
        return;
    // Return if it's a post revision
    if (false !== wp_is_post_revision($post_id))
        return;

    if (isset($_POST['game_lat'])) {
        update_post_meta($post_id, 'game_lat', $_POST['game_lat']);
    }

    if (isset($_POST['game_lng'])) {
        update_post_meta($post_id, 'game_lng', $_POST['game_lng']);
    }

    if (isset($_POST['game_prize_code'])) {
        update_post_meta($post_id, 'game_prize_code', $_POST['game_prize_code']);
    }

}



function tu_is_game_register_exist($phone) {
    $args = array(
        'post_type' => 'game_register',
        'paged' => 1,
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'game_register_phone',
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



/*register form article single*/
add_action('wp_ajax_game_call_get_prize_ajax', 'game_call_get_prize_ajax');
add_action('wp_ajax_nopriv_game_call_get_prize_ajax', 'game_call_get_prize_ajax');

function game_call_get_prize_ajax()
{
    if (!isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'game_call_get_prize_nonce') )
    {
        echo json_encode( array('success' => false, 'msg' => 'Phiên làm việc đã hết, vui lòng tải lại trang và thử lại.') );
        exit;
    }
    $request = array();
    $request['player_phone'] = isset( $_POST['player_phone'] ) ? $_POST['player_phone'] : '';

    $game_price = tu_get_game_with_pagination(1, 1);
    $game_detail = [
        'code' => 1
    ];
    $post_id_to_delete = '';

    if (isset($game_price) && $game_price) :

        while ($game_price->have_posts()) : $game_price->the_post();
            $post_id = get_the_ID();
            $game_prize_code = get_post_meta($post_id, 'game_prize_code', true);



            if ( !$request['player_phone'] && $request['player_phone'] === '' ) {
                $game_prize_code = 1;
            } else {
                wp_trash_post($post_id);
            }

            $game_detail = [
                    'code' => $game_prize_code
            ];

             endwhile; ?>
    <?php endif;

    echo json_encode( array('success' => true, "code" => $game_detail['code'] ));
    exit;

}
