<?php
/**
 * Plugin Name: Plugin_One
 */


require('classes/class-settings-page.php');
new Settings_Page();

require_once ('classes/class-shortcode.php');
new Plugin_One_Shortcode();


