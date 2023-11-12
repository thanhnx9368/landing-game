<?php //  Template Name: Sample Article ?>

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
/** Retrieving Items */
$article_query = tu_get_article_with_pagination(get_query_var('paged'), 10);
$article_paginate_links = tu_paginate_links($article_query)
?>

    <div class="container">

        <h2><?php echo $current_page_title; ?></h2>

        <div class="the-excerpt"><?php echo $current_page_excerpt; ?></div>

        <div class="the-content"><?php echo $current_page_content; ?></div>

        <div class="row">

            <?php if($article_query->have_posts()): ?>

                <?php while ($article_query->have_posts()): $article_query->the_post(); ?>

                    <?php tu_display_each_article(); ?>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

                <?php echo $article_paginate_links; ?>

            <?php else: ?>
                <p class="text-center"><?php _e('Nội dung đang được cập nhật..',TEXT_DOMAIN); ?></p>
            <?php endif; ?>

        </div>

    </div>

<?php get_footer(); ?>