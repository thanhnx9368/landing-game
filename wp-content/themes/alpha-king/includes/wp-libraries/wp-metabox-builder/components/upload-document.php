<?php
    function metabox_builder_upload_file($item) {
        $label = $item['label'];
        $name = $item['name'];
        $files_id = $item['value'];

        $file_object = get_post($files_id);  

        if ($file_object && $file_object->post_type == 'attachment') {
            $file_name = basename($file_object->guid);
        } else {
            $file_name = __('No file select', TEXT_DOMAIN);
        }
        ?>

        <div class="js-file-upload field-group">  
            <div class="field-label"><?php echo $label; ?></div>
            <input class="js-file-id" type="hidden" name="<?php echo $name; ?>" value="<?php echo $files_id; ?>">
            <div class="field-input">
                <p class="js-file-name _title"><?php echo $file_name ; ?></p>
                <button type="button" class="js-btn-upload button"><?php _e('Upload', TEXT_DOMAIN); ?></button>
                <button type="button" class="js-btn-delete-file button" id="sale_data_delete_file" class="button"><?php _e('Delete', TEXT_DOMAIN); ?></button>    
            </div>
        </div>
        <?php
    }
