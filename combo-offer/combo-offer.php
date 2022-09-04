<?php
/*
  Plugin Name:      Combo
  Plugin URI:       http://wordpress.org
  Description:      Combo Offers on woocommerce plugin
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

//product edit tab function
function combo_tab( $combo_tabs ) {
  $combo_tabs['combo_tab'] = 
    array(
      'label'   => __( ' Combo Offer ' , 'combo' ),
      'target'  => 'combo_product_data' ,
      'class'   => array(),
      'priority'=> 70
    );
  return $combo_tabs;
}

//Save meta post
function combo_save_post() {
  global $post;
  $post_id = $post->ID;
  $combo_ids = $_POST['combo_ids'];
  update_post_meta( $post_id , "combo_ids" , $combo_ids );
}

//Add to cart
function combo_add_to_cart() { 
  $product_ids=get_post_meta( $_POST["product_id"] , "combo_ids" , true );
  
  foreach($product_ids as $product_id){
    WC()->cart->add_to_cart( $product_id); 
  }
  $url = get_permalink( $_POST["product_id"] );
  if (wp_safe_redirect( $url )){
    exit;
  }
}

//secure add to cart
function combo_product_add_to_cart ()
{
  if(!is_admin()){
    if(isset($_POST['combo_add_to_cart'])) {
      combo_add_to_cart();
    } 
  }      
}

//file paths
include plugin_dir_path(__FILE__) . '/app/views/frontend/view-page.php';
include plugin_dir_path(__FILE__) . '/app/controller/frontend/edit-page.php';
include plugin_dir_path(__FILE__) . '/app/Route.php';

?>