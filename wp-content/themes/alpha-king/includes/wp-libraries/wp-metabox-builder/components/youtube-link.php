<?php
function metabox_builder_input_url_youtube($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];

    $youtube_url_regex = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value, $match);
    $youtube_id = $youtube_url_regex != 0 ? $match[1] : null;
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <div class="field-input">
            <input type="text" name="<?php echo $name; ?>" placeholder="<?php _e('Insert Link Youtube', TEXT_DOMAIN); ?>" value="<?php echo $value; ?>">
        </div>
        <div class="field-video">
            <?php echo $iframe = $value ? '<iframe src="http://youtube.com/embed/' . $youtube_id . '" width="300px" height="100px"></iframe>' : null ?>
        </div>
    </div>
    
    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                     
}