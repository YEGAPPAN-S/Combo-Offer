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


class Frontend
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
    ?>
      <div id="combo_product_data" class="panel woocommerce_options_panel">
          <p class="form-field">
              <label for="combo_ids">
                  <?php esc_html_e( 'Combo Products : ', 'combo' ); ?>
              </label>
              <select class="wc-product-search"
                      multiple="multiple"
                      style="width: 50%;"
                      id="combo_ids"
                      name="combo_ids[]"
                      data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'combo' ); ?>"
                      data-action="woocommerce_json_search_products_and_variations"
                      data-exclude="<?php echo intval( $post->ID ); ?>">
                      <?php
                        $post_ids=get_post_meta( $post->ID , "combo_ids" , true );
                        foreach( $post_ids as $post_id ){
                          $product = wc_get_product( $post_id );
                          if ( is_object( $product ) ) {
                            echo '<option value="' . esc_attr( $post_id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
                          }
                        }
                      ?>
              </select>
              <?php echo wc_help_tip( __( 'Enter your products to get combo packages' , 'combo' ) ); ?>
          </p>
      </div>
    <?php
  }
}