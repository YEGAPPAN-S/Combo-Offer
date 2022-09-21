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

namespace Combo\App\Controllers\Frontend;

defined( 'ABSPATH' ) || exit;

use Combo\App\Helper\Functions as HelperFunctions;


class ProductPage
{
  /**
   * Add to cart
   * @return void
   */
  public function addMultipleProduct()
  {
    $product_ids = get_post_meta($_POST["product_id"], "combo_ids", true);
      foreach ($product_ids as $product_id) {
        WC()->cart->add_to_cart($product_id);
      }
      $url = get_permalink($_POST["product_id"]);
      if (wp_safe_redirect($url)) {
        exit;
      }
  }

  /**
   * Secure way to call add to cart
   * @return void
   */
  public function addProduct()
  {
    if (!is_admin()) {
      if (isset($_POST['combo_add_to_cart'])) {
        $this->addMultipleProduct();
      }
    }
  }

  /**
   * Product frontend page
   * @return void
   */
  public function productPage ()
  {
    global $post;
    $post_ids=get_post_meta( $post->ID , "combo_ids" , true );
    $data = [
      'post_ids' => $post_ids,
      'post' => $post
    ];

    if(!empty($post_ids)) {
      HelperFunctions::view('Frontend/Product',$data,true);
    }
  }

}