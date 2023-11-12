<?php 

/*
* @function: metabox_input_normal
* @parameter: $item is array ( label, name, value )
* @note: This function hasn't validation and format
*/
function metabox_builder_textarea($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <div class="field-textarea">
            <textarea name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></textarea>
        </div>
    </div>
    
    <?php
}