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

            //Product data tabs
            add_filter('woocommerce_product_data_tabs',[$control, 'combo_tab']);

            //Product data panel
            add_action('woocommerce_product_data_panels',[$control, 'combo_tab_data']);

            
            //Save meta post
            add_action('save_post',[$control, 'combo_save_post']);

            //Add to cart
            add_action('wp',[$control, 'combo_product_add_to_cart']);
            
            //Product view page
            add_action('woocommerce_after_single_product',[$control, 'combo_after_product']);
  
    }
}
?>