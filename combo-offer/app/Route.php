<?php 
//Product data tabs 
add_filter( 'woocommerce_product_data_tabs' , 'combo_tab' );

//Product data panel
add_action( 'woocommerce_product_data_panels' , 'combo_tab_data' );

//Save meta post
add_action( 'save_post' , 'combo_save_post' );

//Product view page
add_action( 'woocommerce_after_single_product' , 'combo_after_product' );

//add to cart 
add_action( 'wp' , 'combo_product_add_to_cart' );
?>