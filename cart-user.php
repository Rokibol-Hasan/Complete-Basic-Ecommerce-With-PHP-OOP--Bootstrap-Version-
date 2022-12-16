<?php
include "inc/header.php";
include "inc/pagetitle.php";
if (isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $cart->updateCart($cartId, $quantity);
}
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <?php
                        if (isset($updateCart)) {
                            echo $updateCart;
                        }
                        ?>
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <?php
                                    $checkCart = $cart->checkCartData();
                                    if ($checkCart) { ?>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (isset($_GET['remove'])) {
                                            $cartId = $_GET['remove'];
                                            $removeFromCart = $cart->removeFromCartById($cartId);
                                            if ($removeFromCart) {
                                                echo "<script>alert('Removed Item From Cart Successfully');</script>";
                                            }
                                        }
                                        $sum = 0;
                                        $qty = 0;
                                        $getAllCartRow = $cart->getAllCartRow();
                                        if ($getAllCartRow) {
                                            while ($result = $getAllCartRow->fetch_assoc()) { ?>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="?remove=<?php echo $result['cartId']; ?>">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="single-product.php?productId=<?php echo $result['productId']; ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="admin/<?php echo $result['image']; ?>"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="single-product.php?productId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount"><?php echo $result['price']; ?></span>
                                                </td>


                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        <form method="post" action="">
                                                            <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
                                                            <input type="number" size="4" class="input-text qty text" title="Qty" name="quantity" value="<?php echo $result['quantity']; ?>" min="0" step="1">
                                                            <input type="submit" value="Update Cart" name="submit" class="button">
                                                        </form>
                                                    </div>
                                                </td>


                                                <td class="product-subtotal">
                                                    <span class="amount"><?php echo $indPrice = $result['quantity'] * $result['price']; ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                                $qty = $qty + $result['quantity'];
                                                $sum = $indPrice + $sum;
                                                Session::set("sum", $sum);
                                                Session::set("qty", $qty);
                                            ?>
                                    <?php }
                                        } ?>
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <div class="cart_totals ">
                            <h2>Cart Totals</h2>

                            <table cellspacing="0">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount"><?php echo $sum . "$"; ?></span></td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Vat</th>
                                        <td>5%</td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">
                                                    <?php
                                                    $vat = $sum * 0.05;
                                                    $grandTotal = $sum + $vat;
                                                    Session::set("grandTotal", $grandTotal);
                                                    echo $grandTotal . "$";
                                                    ?>
                                                </span></strong> </td>
                                    </tr>
                                </tbody>
                            <?php } else {
                                        echo "Cart Is Empty";
                                    } ?>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php include "inc/sidebar.php"; ?>
            </div>

        </div>
    </div>
</div>
<?php
include "inc/footer.php";
?>