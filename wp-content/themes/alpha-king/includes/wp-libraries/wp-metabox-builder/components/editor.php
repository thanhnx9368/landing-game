<?php 

/*
* @function: metabox_editor
* @parameter: $item is array ( label, name, value )
* @note: This function hasn't validation and format
*/
function metabox_builder_editor($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <div class="field-editor">
            <?php wp_editor($value, $name); ?>
        </div>
    </div>
    
    <?php
}
