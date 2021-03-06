
<div class="custom-width">
    <div class="page-heading">
        <h1>Cart</h1>
    </div>

    <?php if (count($query) > 0) { ?>
        <div class="cart">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($query) > 0) {
                            $sub_tot = floatval(0);
                            $tot = floatval(0);
                            foreach ($query as $row) {
//                                        echo "<pre>";
//                                        print_R($row);
//                                        echo "</pre>";
                                ?>
                            <input type="hidden" name="p_id[]" value="<?php echo $row->p_id; ?>" />
                            <input type="hidden" name="varient[]" value='<?php echo $row->cart_attr; ?>' />
                            <input type="hidden" name="cart_id[]" value="<?php echo $row->cart_id ? $row->cart_id : 0; ?>" />
                            <tr>
                                <td><img height="100px" src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>"/></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->sku; ?></td>
                                <td><div class="product-quantity">
                                        <input data-min="1" data-max="0" type="text" id="quantity_<?php echo $row->p_id; ?>" name="quantity[]" value="<?php echo $row->cart_qty; ?>" readonly><div class="quantity-selectors-container">
                                            <div class="quantity-selectors">
                                                <button type="button" class="increment-quantity" data-id="<?php echo $row->p_id; ?>" aria-label="Add one" data-direction="1"><span>&#43;</span></button>
                                                <button type="button" class="decrement-quantity" data-id="<?php echo $row->p_id; ?>" aria-label="Subtract one" data-direction="-1" <?php if (floatval($row->cart_qty) <= 1) { ?> disabled="disabled" <?php } ?>><span>&#8722;</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="refresh-delete-btn-area">
                                        <button class="refresh-btn" onclick="updateCart(<?php echo $row->p_id; ?>);" data-id="<?php echo $row->p_id; ?>"><img src="<?php echo base_url(); ?>assets/front/images/refresh-btn.png"/></button>
                                        <button class="delete-btn" onclick="deleteCart(<?php echo $row->p_id; ?>);" ><img src="<?php echo base_url(); ?>assets/front/images/delete-btn.png"/></button>
                                    </div> 

                                </td>
                                <td>SR <?php echo $row->sell_price; ?></td>
                                <td>SR <?php echo floatval($row->sell_price * $row->cart_qty); ?></td>
                            </tr>
                            <?php
                            $sub_tot += floatval($row->sell_price * $row->cart_qty);
                            $tot += floatval($row->sell_price * $row->cart_qty);
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="">No Product Found</td>

                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="cart-table-below-area">
            <h4>What would you like to do next?</h4>

            <div class="row">
                <div class="col-sm-5 col-sm-offset-7">
                    <div class="cart-table-below-area-right">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><b>Subtotal</b></td>
                                        <td>SR <?php echo $sub_tot; ?></td>
                                    </tr>

    <!--                                            <tr>
                                                    <td><b>Tax</b></td>
                                                    <td>???0.00</td>
                                                </tr>-->
                                    </tr>

                                    <tr>
                                        <td class="borderbnone"><b>Total</b></td>
                                        <td class="borderbnone">SR <?php echo $tot; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="borderbnone">
                                            <a href="<?php echo base_url(); ?>" class="continue-shopping-btn">Continue
                                                Shopping</a>
                                        </td>
                                        <td class="borderbnone">
                                            <a href="<?php echo isset($url) ? $url : base_url('checkout'); ?>" class="continue-shopping-btn checkout-btn">PROCEED TO CHECKOUT</a>
                                        </td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <div class="cart-table-below-area empty-cart">

            <div class="row">
                <div class="col-sm-12">
                    <div class="cart-table-below-area-right">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr> 
                                        <td class="borderbnone">
                                            Your cart is empty.
                                        </td>


                                    </tr>
                                    <tr> 
                                        <td class="borderbnone">
                                            <img width="400px;" src="<?php echo base_url(); ?>assets/front/images/empty-shopping-cart.png" />
                                        </td>
                                        <td class="borderbnone"><a href="<?php echo base_url(); ?>" class="continue-shopping-btn">Continue Shopping</a></td>

                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>