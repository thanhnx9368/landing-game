<?php
/**
 * Checkbox
 * @param array $item
 */

function metabox_builder_checkbox($item = array()) {
    $label = $item['label'];
    $name = $item['name'];
    $value = is_array($item['value']) ? $item['value'] : [];
    $options = $item['options'];

    ?>

    <div class="field-group">  
        <div class="field-label"><?php echo $label; ?></div>
        <ul class="field-options">

            <?php
                $checked = null;
                $i = 0;
                $value_count = count($value);

                foreach ( $options as $k => $v ) :

                    if ( $value_count > 0 ) {
                        $checked = in_array($k, $value) ? 'checked' : null; 
                    }
            ?>

            <li class="field-options-item">
                <div class="option">
                    <input type="checkbox" id="<?php echo '_item-'.$k; ?>" name="<?php echo $name.'['. $k .']'; ?>" <?php echo $checked; ?> value="<?php echo $k; ?>">
                    <label for="<?php echo '_item-'.$k; ?>"><?php echo $v; ?></label>
                </div>
            </li>

            <?php endforeach; ?>

        </ul>
    </div>

    <?php
}