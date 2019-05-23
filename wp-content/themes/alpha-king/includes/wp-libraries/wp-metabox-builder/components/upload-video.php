<?php  
    function metabox_builder_upload_video($item) {
        $label = $item['label'];
        $name = $item['name'];
        $files_id = $item['value'];

        $file_object = get_post($files_id);

        $check_file = $file_object && $file_object->post_type == 'attachment';

        if ( $check_file ) {
            $file_path = $file_object->guid;
            $file_name = basename($file_path);
        } else {
            $file_name = __('Video has not been uploaded yet.', TEXT_DOMAIN);
        }

        ?>

        <div class="js-video-upload field-group">  
            <div class="field-label"><?php echo $label; ?></div>
            <input class="js-file-id" type="hidden" name="<?php echo $name; ?>" value="<?php echo $files_id; ?>">
            <div class="field-input">
                <p class="js-file-name _title"><?php echo $file_name ; ?></p>
                <button type="button" class="js-btn-upload button"><?php _e('Upload', TEXT_DOMAIN); ?></button>
                <button type="button" class="js-btn-delete-file button" id="sale_data_delete_file" class="button"><?php _e('Delete', TEXT_DOMAIN); ?></button>    
            </div>

            <?php if ( $check_file ) : ?>
            <div class="video-preview">
                <video width="320" height="240" controls>
                    <source src="<?php echo $file_path; ?>" type="video/mp4" />
                </video>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
