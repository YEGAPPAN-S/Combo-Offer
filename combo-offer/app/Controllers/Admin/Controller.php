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


class Controller
{
    /**
     * Tab function
     * @param $combo_tabs
     * @return mixed
     */
    public function combo_tab( $combo_tabs ) {
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
    public function combo_tab_data() {
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
    
    /**
     * Save meta post
     * @return void
     */
    public function combo_save_post()
    {
        global $post;
        $post_id = $post->ID;
        $combo_ids = $_POST['combo_ids'];
        update_post_meta($post_id, "combo_ids", $combo_ids);
    }

    /**
     * Add to cart
     * @return void
     */
    public function combo_add_to_cart()
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
     * Secure way to add cart
     * @return void
     */
    public function combo_product_add_to_cart()
    {
        if (!is_admin()) {
            if (isset($_POST['combo_add_to_cart'])) {
                $this->combo_add_to_cart();
            }
        }
    }

    /**
     * Product frontend page
     * @return void
     */
    public function combo_after_product ()
    {
        ?>
        <div>
            <table><tr><td><br>
                <h4>Combo products</h4><br>
                <?php
                global $post;
                $total_price = 0;
                $post_ids=get_post_meta( $post->ID , "combo_ids" , true );
                foreach ($post_ids as $post_id) {
                    ?>
                    <table><tr><td>
                        <?php
                        $product = wc_get_product($post_id);
                        echo $product->get_image(); echo "<br><br>";
                        echo "<b>"; echo $product->get_name(); echo "</b><br><br>";
                        $total_price =$total_price + $product->get_price();
                        echo "Price "; echo $product->get_price_html();
                        ?><br><br>
                    </td></tr></table>
                    <?php
                }
                echo "Total Amount = "; echo wc_price($total_price);
                echo "<br><br>";
                ?>

                <form action="#" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $post->ID;?>">
                    <input type="submit" name="combo_add_to_cart" value="Add To Cart">
                </form>

                <?php $this->combo_product_add_to_cart(); ?>

            </td></tr></table>
        </div>
        <?php
    }
}
?>
