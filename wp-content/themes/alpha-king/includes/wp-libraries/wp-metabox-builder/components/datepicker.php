<?php 

function metabox_builder_datepicker($item) {
    $name = $item['name'];
    $value = $item['value'];
    $label = $item['label'];

    ?>
        <div class="field-group">  
            <div class="field-label"><?php echo $label; ?></div>
            <div class="field-date">
                <input type="text" name="<?php echo $name; ?>" class="js-datepicker" value="<?php echo $value; ?>"/>
            </div>
        </div> 

    <?php
}