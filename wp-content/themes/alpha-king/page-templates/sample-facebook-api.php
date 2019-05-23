<?php //  Template Name: Sample Facebook API Page ?>
<?php

/** Current Page Info */
$current_page_object = $wp_query->get_queried_object();
$current_page_url = $current_page_object->guid;
$current_page_id = $current_page_object->ID;
$current_page_title = $current_page_object->post_title;
$current_page_excerpt = $current_page_object->post_excerpt;
$current_page_content = $current_page_object->post_content;
$current_page_thumbnail_url = get_the_post_thumbnail_url($current_page_id);

/** Facebook Initialize */

$fb = new Facebook\Facebook([
    'app_id' => FACEBOOK_APP_ID,
    'app_secret' => FACEBOOK_APP_SECRET,
    'default_graph_version' => 'v2.5',
]);
echo '<pre>';
print_r($fb);

$fb_login_helper = $fb->getRedirectLoginHelper();
$fb_login_permissions = ['email', 'user_likes'];
$fb_login_callback_url = add_query_arg(array('action' => 'callback'), $current_page_url);
$fb_login_url = $fb_login_helper->getLoginUrl($fb_login_callback_url, $fb_login_permissions);

/** Facebook Login Callback */

if(isset($_GET['action']) && $_GET['action'] == 'callback'){

    //View these links:
    // https://developers.facebook.com/docs/php/gettingstarted
    // Graph: https://developers.facebook.com/docs/graph-api/overview/
}
?>

<a href="<?php echo $fb_login_url; ?>" class="btn btn-default">Facebook Login</a>