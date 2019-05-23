<?php 

/*
* @function: metabox_input_normal
* @parameter: $item is array ( label, name, value )
* @note: This function hasn't validation and format
*/
function metabox_builder_radio($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = $item['value'];
    $options = $item['options'];
    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <ul class="field-options">

            <?php 
                foreach( $options as $k => $v) :
                $checked = ($k = $value) ? 'checked' : null;
            ?>
            <li class="_item">
                <div class="option">
                    <label for="<?php echo '_'.$name; ?>"><?php echo $v; ?></label>
                    <input type="radio" id="<?php echo '_'.$name; ?>" name="<?php echo $name; ?>" <?php echo $checked; ?> value="<?php echo $k; ?>">
                </div>
            </li>
            <?php endforeach; ?>

        </ul>
    </div>

    <?php
}
