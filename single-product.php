<?php
include "inc/header.php";
include "inc/pagetitle.php";
if (isset($_GET['proId'])) {
    $productId = $_GET['proId'];
}
if (isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addToCart = $cart->addToCart($quantity, $productId);
    
}
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
                    <div class="product-breadcroumb">
                        <a href="index.php">Home</a>
                        <?php
                        if (isset($_GET['proId'])) {
                            $productId = $_GET['proId'];
                            $getSpecCat = $product->getSpecCat($productId);
                            $getSpecCat = mysqli_fetch_array($getSpecCat); ?>
                            <a href=""> <?php echo $getSpecCat['catName']; ?>
                            </a>
                        <?php } ?>
                        <?php
                        if (isset($_GET['proId'])) {
                            $productId = $_GET['proId'];
                            $getProductById = $product->selectProductById($productId);
                            $getProductById = mysqli_fetch_array($getProductById); ?>
                            <a href=""><?php echo $getProductById['productName']; ?></a>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            if (isset($_GET['proId'])) {
                                $productId = $_GET['proId'];
                                $getProductById = $product->selectProductById($productId);
                                if ($getProductById) {
                                    while ($result = $getProductById->fetch_assoc()) { ?>
                                        <div class="product-images">
                                            <div class="product-main-img">
                                                <img src="admin/<?php echo $result['image']; ?>" alt="">
                                            </div>
                                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="product-inner">
                                <?php
                                if(isset($addToCart)){
                                    echo $addToCart;
                                }
                                ?>
                                <h2 class="product-name"><?php echo $result['productName']; ?></h2>
                                <div class="product-inner-price">
                                    <span>$<?php echo $result['price']; ?></span>
                                </div>

                                <form action="" method="post" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <input class="add_to_cart_button" type="submit" name="submit" value="Add to Cart" />
                                </form>

                                <div class="product-inner-category">
                                    <?php
                                        if (isset($_GET['proId'])) {
                                            $productId = $_GET['proId'];
                                            $getSpecCat = $product->getSpecCat($productId);
                                            $getSpecCat = mysqli_fetch_array($getSpecCat); ?>
                                        <p>Category: <a href="shop.php?catId=<?php echo $result['catId']; ?>"><?php echo $getSpecCat['catName']; ?></a>Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                                    <?php } ?>
                                </div>

                                <div>
                                    <div class="product-description">
                                        <h2>Product Description</h2>
                                        <p><?php echo $result['body']; ?></p>
                                    </div>
                                </div>

                            </div>
                <?php }
                                }
                            } ?>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="related-products-wrapper">
                    <h2 class="related-products-title">Related Products</h2>
                    <div class="related-products-carousel">
                        <?php
                        if (isset($_GET['proId'])) {
                            $productId = $_GET['proId'];
                            $getProductById = $product->selectProductById($productId);
                            $getProductById = mysqli_fetch_array($getProductById);
                            $catId = $getProductById['catId'];
                            $getProductByCategory = $product->getProductByCategory($catId);
                            if ($getProductByCategory) {
                                while ($result = $getProductByCategory->fetch_assoc()) { ?>
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <img src="admin/<?php echo $result['image']; ?>" alt="">
                                            <div class="product-hover">
                                                <a href="cart-user.php?proId=<?php echo $result['productId']; ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                                <a href="single-product.php?proId=<?php echo $result['productId']; ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                            </div>
                                        </div>

                                        <h2><a href=""><?php echo $result['productName']; ?></a></h2>

                                        <div class="product-carousel-price">
                                            <span>$<?php echo $result['price']; ?></span>
                                        </div>
                                    </div>
                        <?php }
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>