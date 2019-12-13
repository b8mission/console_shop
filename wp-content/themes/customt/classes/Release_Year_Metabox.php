<?php
//metabox class

require_once 'Base_Metabox.php';
class Release_Year_Metabox extends Base_Metabox
{
    function render($post)
    {
        $value = get_post_meta($post->ID, 'release_year', true);
        ?>
        <label for="wporg_field">The Year </label>
        <input name="release-year" type="text" value="<?=$value?>">
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