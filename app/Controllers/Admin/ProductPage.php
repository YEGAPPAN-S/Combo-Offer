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

use Combo\App\Helper\Functions as HelperFunctions;


class ProductPage
{    
    /**
     * Tab function
     * @param $combo_tabs
     * @return mixed
     */
    public function tabMenu( $combo_tabs ) {
        $combo_tabs['combo_tab'] =
        array(
            'label'   => __( ' Combo Offer ' , 'combo' ),
            'target'  => 'combo_product_data' ,
            'class'   => array(),
            'priority'=> 70
        );
        return $combo_tabs;
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
        
        HelperFunctions::view('Admin/Panel',$data,true);
    }

    /**
     * Save meta post
     * @return void
     */
    public function saveMetadata()
    {
        global $post;
        $post_id = $post->ID;
        $combo_ids = $_POST['combo_ids'];
        update_post_meta($post_id, "combo_ids", $combo_ids);
    }
    
}
?>
