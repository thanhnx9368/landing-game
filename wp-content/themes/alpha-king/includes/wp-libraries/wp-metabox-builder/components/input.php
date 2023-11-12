<?php

function metabox_builder_input($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <div class="field-input">
            <input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
        </div>
    </div>
    
    <?php
}