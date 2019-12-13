<?php
//metabox class

require_once 'Base_Metabox.php';
class Generation_Metabox extends Base_Metabox
{
    function render($post)
    {
        $value = get_post_meta($post->ID, 'generation', true);
        ?>
        <label for="wporg_field">Gen # </label>
        <input name="generation" type="text" value="<?=$value?>">
        <!--
        <select name="wporg_field" id="wporg_field" class="postbox">
            <option value="">Select something...</option>
            <option value="something">Something</option>
            <option value="else">Else</option>
        </select> -->
        <?php
    }

    function save($post_id)
    {

        if (array_key_exists('generation', $_POST)) {
            update_post_meta(
                $post_id,
                'generation',
                $_POST['generation']
            );
        }
    }

}