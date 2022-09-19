<?php 
/**
 * Combo Offer
 *
 * @package   combo-offer
 * @author    Yegappan
 * @copyright 2022 Flycart
 * @license   GPL v2 or later
 * @link      https://flycart.org
 */

namespace Combo\App;

defined( 'ABSPATH' ) || exit;

class Route
{
    /**
     * Plugin hooks
     */
    public static function hooks()
    {
        $control= new Controllers\Admin\Controller();

        //Save meta post
        add_action('save_post',[$control, 'saveMetadata']);

        //Add to cart
        add_action('wp',[$control, 'addProduct']);

        $frontend= new Controllers\Frontend\Frontend();

        //Product data tabs
        add_filter('woocommerce_product_data_tabs',[$frontend, 'tabMenu']);

        //Product data panel
        add_action('woocommerce_product_data_panels',[$frontend, 'menuData']);

        $store= new Controllers\Frontend\Store\Store();

        //Product view page
        add_action('woocommerce_after_single_product',[$store, 'productPage']);
    }
}
?>