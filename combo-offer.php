<?php
/*
  Plugin Name:      Combo Offer
  Plugin URI:       http://wordpress.org
  Description:      Combo Offers for Woocommerce Plugin
  Author:           Yegappan
  Author URI:       http://cartrabbit.io/
  Text Domains:     combo
  Version:          1.0
  Requires at least:5.2
  Requires PHP:     7.2
  License:          GPL v2 or later
  License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) || exit;

defined('COMBO_PLUGIN_FILE') or define('COMBO_PLUGIN_FILE', __FILE__);
defined('COMBO_PLUGIN_PATH') or define('COMBO_PLUGIN_PATH', plugin_dir_path(__FILE__));

// To load PSR4 autoloader
if (file_exists(COMBO_PLUGIN_PATH . '/vendor/autoload.php')) {
  require COMBO_PLUGIN_PATH . '/vendor/autoload.php';
} else {
  wp_die('Combo Offer Plugin is unable to find the autoload file.');
}

// To check class exists
if (class_exists('Combo\App\Route')) {
  global $combo_app;
  $combo_app = Combo\App\Route::hooks();
} else {
  wp_die(__('Combo Offer Plugin is unable to find the Route class.'));
}

?>