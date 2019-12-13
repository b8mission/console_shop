<?php
//metabox class

require 'Base_Metabox.php';
class My_Metabox extends Base_Metabox
{
    function render($post)
    {
        $value = get_post_meta($post->ID, 'release_year', true);
        ?>
        <label for="wporg_field">Description for this field</label>
        <input name="release-year" type="text" value="<?=$value?>">
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

        if (array_key_exists('release-year', $_POST)) {
            update_post_meta(
                $post_id,
                'release_year',
                $_POST['release-year']
            );
        }
    }

}