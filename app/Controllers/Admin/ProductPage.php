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

namespace Combo\App\Controllers\Admin;

defined( 'ABSPATH' ) || exit;

use Combo\App\Helpers\Functions;

class ProductPage
{
    /**
     * Tab function
     * @param $tabs
     * @return mixed
     */
    public function tabMenu( $tabs ) {
        $tabs['combo_tab'] =
        array(
            'label'   => __( ' Combo Offer ' , 'combo' ),
            'target'  => 'combo_product_data' ,
            'class'   => array(),
            'priority'=> 70
        );
        return $tabs;
    }

    /**
     * Product edit tab
     * @return void
     */
    public function menuData() {
        global $post;
        $data = [
            'post' => $post
        ];
        
        Functions::view('Admin/Panel', $data, true);
    }

    /**
     * Save meta post
     * @return void
     */
    public function saveMetadata()
    {
        global $post;
        $post_id = $post->ID;
        if(isset($_POST['combo_ids'])){
            $combo_ids = $_POST['combo_ids'];
            foreach ($combo_ids as $key => $combo_id) {
                $combo_products[ $key ] = sanitize_text_field( $combo_id );
            }
            update_post_meta($post_id, "combo_ids", $combo_products);
        }
    }    
}