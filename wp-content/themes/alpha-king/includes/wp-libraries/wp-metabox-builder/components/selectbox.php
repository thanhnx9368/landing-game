<?php

/*
* @function: metabox_input_normal
* @parameter: $item is array ( label, name, value )
* @note: This function hasn't validation and format
*/
function metabox_builder_selectbox($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];
    $options = $item['options'];
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <select name="<?php echo $name; ?>" class="field-options">

            <?php 
                foreach( $options as $k => $v) :
                $checked = ($k == $value) ? 'selected' : null;
            ?>

            <option value="<?php echo $k; ?>" <?php echo $checked; ?>><?php echo $v; ?></option>

            <?php endforeach; ?> 
            
        </select>
    </div>

    <?php
}
?>