<div class="single-sidebar">
    <h2 class="sidebar-title">Search Products</h2>
    <form action="#">
        <input type="text" placeholder="Search products...">
        <input type="submit" value="Search">
    </form>
</div>

<div class="single-sidebar">
    <h2 class="sidebar-title">Products</h2>
    <?php
    $sidebarProduct = $product->sidebarProduct();
    if ($sidebarProduct) {
        while ($result = $sidebarProduct->fetch_assoc()) { ?>
            <div class="thubmnail-recent">
                <img src="admin/<?php echo $result['image']; ?>" class="recent-thumb" alt="">
                <h2><a href="single-product.php?proId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a></h2>
                <div class="product-sidebar-price">
                    <span>$<?php echo $result['price']; ?></span>
                </div>
            </div>
    <?php }
    } ?>
</div>