<?php

function metabox_builder_upload_image($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $image_id = $item['value']; 

    $image_url = tu_get_images_html_by_attachment_ids(esc_attr($image_id));
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <div class="field-image">
            <div class="upload-row">
                <button type="button" class="button upload-button"><?php _e('Select photo', TEXT_DOMAIN); ?></button>
                <ul class="tu-meta-box-photo-list">
                    <li>
                        <span class="js-btn-remove remove album_images-remove dashicons dashicons-no-alt" title"remove"=""></span>
                        <div class="upload-files-preview"><?php echo $image_url; ?></div>
                        <input type="hidden" class="upload-files-ids" name="<?php echo $name; ?>" value="<?php echo $image_id; ?>">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <?php
}


if ( !function_exists('tu_metabox_get_images') ) {
    function tu_metabox_get_images( $image_array ) {
        
        if ( $image_array ) {
    
            foreach ( $image_array as $k => $image ) {
                $image['url'] = tu_get_image_src_by_attachment_id($image['id'], 'full');
                $image_array[$k] = $image;
            }
    
            return $image_array;
        }
    
        return array();
    }
}

function metabox_builder_upload_album_image($item = array()) {

    $label = $item['label'];
    $name = $item['name'];
    $image_id = $item['value']; 

    $unicode = uniqid();
?>
<div class="field-group">  
    <div class="field-label"><?php echo $label; ?></div>
    <div id="album-wrap-<?php echo $unicode; ?>" class="_image-group">
        <input type="hidden" value="<?php echo tu_json_encode(tu_metabox_get_images($image_id)); ?>">
        <div class="album-container">
            <button class="album_images-button button" type="button"><?php _e('Select photo list', TEXT_DOMAIN); ?></button>
            <ul class="album_images-list tu-meta-box-photo-list ui-sortable"></ul>
        </div>

        <div id="album_images_edit_popup_container" class="hidden">
            <table id="album_images_edit_popup" class="form-table" data-title="<?php _e('Image details', TEXT_DOMAIN); ?>">
                <tr>
                    <th><?php _e('Image', TEXT_DOMAIN); ?></th>
                    <td><img class="attachment" style="width: auto; max-width: 100%;"></td>
                </tr>
                <tr>
                    <th><?php _e('Title', TEXT_DOMAIN); ?></th>
                    <td><input class="title large-text" type="text" /></td>
                </tr>
                <tr>
                    <th><?php _e('Path', TEXT_DOMAIN); ?></th>
                    <td><input class="external_url large-text" type="text" /></td>
                </tr>
                <tr>
                    <th><?php _e('Excerpt', TEXT_DOMAIN); ?></th>
                    <td><textarea class="description large-text" rows="6"></textarea>
                </tr>
                <tr>
                    <th><input class="guid" type="hidden"></th>
                    <td><button class="button button-primary button-large" type="button"><?php _e('Save', TEXT_DOMAIN); ?></button></td>
                </tr>
            </table>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
            
                /* Init variables */
                var album_wrap = $('#album-wrap-<?php echo $unicode; ?>');
                var album_images_container = album_wrap.find(".album-container");
                var album_images_list = album_wrap.find(".album_images-list");
                var album_images_button = album_wrap.find('.album_images-button');
                var album_images_edit_popup = album_wrap.find('#album_images_edit_popup');

                /* Sortable handles*/
                album_images_list.each(function (index, el) {
                    $(this).sortable({
                        stop: function () {
                            album_images_update_list_items_name();
                        }
                    }).disableSelection();
                });

                album_images_render_list(JSON.parse('<?php echo tu_json_encode(tu_metabox_get_images($image_id)); ?>'));
                
                /* Choosing images handles */
                album_images_button.click(function (evt) {
                    var _this = $(this);

                    var fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: 'Select image',
                        library: {type: 'image'},
                        button: {text: 'Select'},
                        multiple: true
                    });

                    fileFrame.on('select', function () {

                        var attachments = fileFrame.state().get('selection').toJSON();

                        $.each(attachments, function (index, item) {
                            album_images_list.append(album_images_get_html_list_item(item));
                            album_images_update_list_items_name();
                        });

                        $(_this).siblings('ul').sortable();
                    });

                    fileFrame.open();
                });

                /* Replace one image handles */
                album_images_list.delegate('.album_images-photo', 'click', function () {

                    var _this = $(this);

                    var fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: 'Select image',
                        library: {type: 'image'},
                        button: {text: 'Select'},
                        multiple: false
                    });

                    var _this_attachment_id = $(_this).siblings('.photo').val();

                    if (_this_attachment_id) {
                        fileFrame.on('open', function () {
                            var selection = fileFrame.state().get('selection');
                            var attachment = wp.media.attachment(_this_attachment_id);
                            attachment.fetch();
                            selection.add(attachment ? [attachment] : []);
                        });
                    }

                    fileFrame.on('select', function () {

                        var attachments = fileFrame.state().get('selection').toJSON();

                        $.each(attachments, function (index, item) {
                            $(_this).attr('src', item.url);
                            $(_this).attr('value', item.id);
                            $(_this).siblings('.attachment').val(item.id);
                        });
                    });

                    fileFrame.open();
                });

                /* Remove image handles */
                album_images_container.delegate('.album_images-remove', 'click', function (evt) {
                    $(this).parent('li').remove();
                    album_images_update_list_items_name();
                });

                /* Edit popup handles */
                $(album_images_list).delegate('.album_images-edit', 'click', function () {

                    album_images_edit_popup.find('.guid').val($(this).parent('li').attr('id'));
                    album_images_edit_popup.find('.attachment').attr('src', $(this).siblings('img').attr('src'));
                    album_images_edit_popup.find('.title').val($(this).siblings('.title').val());
                    album_images_edit_popup.find('.external_url').val($(this).siblings('.external_url').val());
                    album_images_edit_popup.find('.description').val($(this).siblings('.description').val());

                    if ( tb_show != undefined ) {
                        tb_show(album_images_edit_popup.attr('data-title'), '#TB_inline?width=600&height=550&inlineId=album_images_edit_popup_container');
                    }
                });
                $(album_images_edit_popup).find('button').click(function (evt) {

                    var guid = album_images_edit_popup.find('.guid').val();
                    $('#' + guid).children('.title').val(album_images_edit_popup.find('.title').val());
                    $('#' + guid).children('.external_url').val(album_images_edit_popup.find('.external_url').val());
                    $('#' + guid).children('.description').val(album_images_edit_popup.find('.description').val());
                    tb_remove();
                });

                /* Function - Update list item's name */
                function album_images_update_list_items_name() {
                    album_images_list.find('li').each(function (index, el) {
                        $(this).attr('id', '<?php echo $name; ?>_' + index);
                        $(this).find('.attachment').attr('name', '<?php echo $name; ?>[' + index + '][id]');
                        $(this).find('.title').attr('name', '<?php echo $name; ?>[' + index + '][title]');
                        $(this).find('.external_url').attr('name', '<?php echo $name; ?>[' + index + '][external_url]');
                        $(this).find('.description').attr('name', '<?php echo $name; ?>[' + index + '][description]');
                    });
                }

                /* Function - Render the list */
                function album_images_render_list(attachments) {

                    var attachment_html_forms = '';

                    jQuery.each(attachments, function (index, item) {
                        attachment_html_forms += album_images_get_html_list_item(item);
                    });

                    album_images_list.html(attachment_html_forms);
                    album_images_update_list_items_name();
                }

                function album_images_get_html_list_item(item) {
                    var item_title = item.title || '';
                    var item_external_url = item.external_url || '';
                    var item_description = item.description || '';

                    var html = '<img src="' + item.url + '" class="album_images-photo" title="Change photo" value="' + item.id + '">';
                    html += '<input class="attachment" type="hidden" value="' + item.id + '" />';
                    html += '<input class="title" type="hidden" value="' + item_title + '" />';
                    html += '<input class="external_url" type="hidden" value="' + item_external_url + '" />';
                    html += '<textarea class="description hidden">' + item_description + '</textarea>';
                    html += '<span class="edit album_images-edit dashicons dashicons-edit" title="Edit"></span>';
                    html += '<span class="remove album_images-remove dashicons dashicons-no-alt" title"Remove"></span>';

                    return '<li>' + html + '</li>';
                }
            });
        </script>
    </div>
</div>
<?php
}
?>