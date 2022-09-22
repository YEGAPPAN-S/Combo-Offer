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
        $admin_page = new Controllers\Admin\ProductPage();

        //Product data tabs
        add_filter('woocommerce_product_data_tabs', [$admin_page, 'tabMenu']);

        //Product data panel
        add_action('woocommerce_product_data_panels', [$admin_page, 'menuData']);

        //Save meta post
        add_action('save_post', [$admin_page, 'saveMetadata']);


        $product_page = new Controllers\Frontend\ProductPage();

        //Add to cart
        add_action('wp', [$product_page, 'addProduct']);

        //Product view page
        add_action('woocommerce_after_single_product', [$product_page, 'productTemplete']);

    }
}