<?php

function metabox_builder_color_picker($item) {
    $name = $item['name'];
    $value = $item['value'];
    $label = $item['label'];
    ?>

        <div class="field-group">  
            <div class="field-label"><?php echo $label; ?></div>
            <div class="field-color">
                <input type="color" name="<?php echo $name; ?>" value="<?php echo $value ?>" />
            </div>
        </div>

    <?php
}