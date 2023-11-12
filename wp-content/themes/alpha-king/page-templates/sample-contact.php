<?php //  Template Name: Sample Contact ?>

<?php get_header(); ?>

<?php
/** Current Page Info */
$current_page_object = $wp_query->get_queried_object();
$current_page_id = $current_page_object->ID;
$current_page_title = $current_page_object->post_title;
$current_page_excerpt = $current_page_object->post_excerpt;
$current_page_content = $current_page_object->post_content;
$current_page_thumbnail_url = get_the_post_thumbnail_url($current_page_id);
?>

<?php
/** Retrieving Options */
$contact_information = array(
    'company' => get_option('option_company', 'Time Universal Communication JSC'),
    'masothue' => get_option('option_masothue', 'xxxx xxxx xxxx'),
    'address' => get_option('option_address', 'Số 1 Lương Yên'),
    'phone' => get_option('option_phone', '0965995568'),
    'email' => get_option('option_email', 'toanna@timevn.com'),
    'hotline' => get_option('option_hotline', '0965995568'),
    'fax' => get_option('option_fax', '043xxxxxxx')
);
?>

<div class="container">

    <h2><?php echo $current_page_title; ?></h2>

    <div class="the-excerpt"><?php echo $current_page_excerpt; ?></div>

    <div class="the-content"><?php echo $current_page_content; ?></div>

    <div class="row">

        <div class="col-md-5 col-sm-6 col-xs-12">

            <h3><?php _e('Thông tin liên hệ'); ?></h3>

            <?php if($contact_information['address']): ?>
                <p><strong><?php echo $contact_information['company']; ?></strong></p>
            <?php endif; ?>

            <?php if($contact_information['address']): ?>
                <p><strong><?php _e('Địa chỉ', TEXT_DOMAIN); ?></strong>: <?php echo $contact_information['address']; ?></p>
            <?php endif; ?>

            <?php if($contact_information['phone']): ?>
                <p><strong><?php _e('Điện thoại', TEXT_DOMAIN); ?></strong>: <a href="tel:<?php echo tu_trim_space($contact_information['address']); ?>"><?php echo $contact_information['address']; ?></a></p>
            <?php endif; ?>

            <?php if($contact_information['email']): ?>
                <p><strong>Email</strong>: <a href="mailto:<?php echo $contact_information['email']; ?>"><?php echo $contact_information['email']; ?></a></p>
            <?php endif; ?>

            <?php if($contact_information['hotline']): ?>
                <p><strong>Holine</strong>: <a href="tel:<?php echo tu_trim_space($contact_information['hotline']); ?>"><?php echo $contact_information['hotline']; ?></a></p>
            <?php endif; ?>

            <?php if($contact_information['fax']): ?>
                <p><strong>Fax</strong>: <a href="tel:<?php echo tu_trim_space($contact_information['fax']); ?>"><?php echo $contact_information['fax']; ?></a></p>
            <?php endif; ?>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php get_template_part('partials/forms/contact'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>