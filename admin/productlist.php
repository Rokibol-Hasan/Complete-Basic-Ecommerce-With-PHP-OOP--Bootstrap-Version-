<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/product.php";
if (isset($_GET['editproduct'])) {
    $productId = $_GET['editProduct'];
}
$product = new Product();
$fm = new Format();
if (isset($_GET['del'])) {
    $deleteProduct = $_GET['del'];
    $deleteProductById = $product->deleteProductById($deleteProduct);
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row">
                <div class="page-header">
                    <h1 class="mt-4">Product List</h1>  
                    <a href="productadd.php" class="btn btn-primary pull-right">Add New</a>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Product List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Body</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x = 1;
                                $getAllProduct = $product->getAllProduct();
                                if ($getAllProduct) {
                                    while ($result = $getAllProduct->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $x;
                                                $x++; ?></td>
                                            <td><?php echo $result['productName']; ?></td>
                                            <td><?php echo $result['catName']; ?></td>
                                            <td><?php echo $result['brandName']; ?></td>
                                            <td><?php echo $fm->textshorten($result['body'], 20); ?></td>
                                            <td><?php echo $result['price'] ?></td>
                                            <td><img src="<?php echo $result['image'] ?>" height='40px' weight='40px'> </td>
                                            <td><?php
                                                if ($result['type'] == '0') {
                                                    echo "Featured";
                                                } else {
                                                    echo "General";
                                                }
                                                ?></td>

                                            <td>
                                                <span class="delete-anchor"><a onclick="return confirm('আসলেই উধাও করবেন?')" href="?del=<?php echo $result['productId'] ?>"> Delete </a>
                                                </span>
                                                <span class="edit-anchor"><a href="productedit.php?editProduct=<?php echo $result['productId'] ?>"> Edit </a>
                                                </span>
                                            </td>
                                    <?php }
                                } ?>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "inc/footer.php"; ?>