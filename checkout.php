<?php
include "inc/header.php";
include "inc/pagetitle.php";
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include "inc/sidebar.php"; ?>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">
                            <h3 id="order_review_heading">Your order</h3>

                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                Ship Your Idea <strong class="product-quantity">× 1</strong> </td>
                                            <td class="product-total">
                                                <span class="amount">£15.00</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£15.00</span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>

                                                Free Shipping
                                                <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                            </td>
                                        </tr>


                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">£15.00</span></strong> </td>
                                        </tr>

                                    </tfoot>
                                </table>


                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Direct Bank Transfer </label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">Cheque Payment </label>
                                            <div style="display:none;" class="payment_box payment_method_cheque">
                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </li>
                                        <li class="payment_method_paypal">
                                            <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                            <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                            </label>
                                            <div style="display:none;" class="payment_box payment_method_paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-row place-order">
                                        <input type="submit" data-value="Place order" value="Place order" id="place_order" name="submit" class="button alt">
                                    </div>

                                    <div class="clear"></div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>