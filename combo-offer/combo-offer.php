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

include 'vendor/autoload.php';

Combo\App\Route::hooks();

?>