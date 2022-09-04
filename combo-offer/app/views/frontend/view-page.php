<?php

//Product frontend page
function combo_after_product ()
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
                    $total_price += $product->get_price();
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

            <?php combo_product_add_to_cart (); ?>

        </td></tr></table>
    </div>
    <?php
}

           
?>
