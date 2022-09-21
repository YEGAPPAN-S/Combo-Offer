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
        $adminpage= new Controllers\Admin\ProductPage();

        //Product data tabs
        add_filter('woocommerce_product_data_tabs', [$adminpage, 'tabMenu']);

        //Product data panel
        add_action('woocommerce_product_data_panels', [$adminpage, 'menuData']);

        //Save meta post
        add_action('save_post', [$adminpage, 'saveMetadata']);


        $productpage= new Controllers\Frontend\ProductPage();

        //Add to cart
        add_action('wp', [$productpage, 'addProduct']);

        //Product view page
        add_action('woocommerce_after_single_product', [$productpage, 'productPage']);

    }
}
?>