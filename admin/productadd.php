<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/category.php";
include "../classes/brand.php";
include "../classes/supplier.php";
include "../classes/product.php";
$category = new Category();
$brand = new Brand();
$supplier = new Supplier();
$product = new Product();
if (isset($_POST['submit'])) {
    $insertProduct = $product->productInsert($_POST, $_FILES);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="page-header mt-3">  
                    <h3 class="page-title text-center">Add Product</h3>
                </div>
                <div class="form">
                    <?php
                    if (isset($insertProduct)) {
                        echo $insertProduct;
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6 flex-column d-flex">
                            <label class="form-control-label">Product Name<span class="text-danger"> *</span></label>
                            <input type="text" id="productName" name="productName" placeholder="Enter Product Name">
                        </div>

                        <div class="row justify-content-between form-group">
                            <div class="col-md-6 flex-column d-flex">
                                <label class="form-control-label ">Select Category<span class="text-danger"> *</span></label>
                                <select id="select" name="catId">
                                    <option>Select Category</option>
                                    <?php
                                    $cat = new Category();
                                    $getAllCat = $cat->getAllCat();
                                    if ($getAllCat) {
                                        while ($result = $getAllCat->fetch_assoc()) { ?>
                                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                    <?php  }
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-6 flex-column d-flex">
                                <label class="form-control-label ">Select Brand<span class="text-danger"> *</span></label>
                                <select id="select" name="brandId">
                                    <option>Select Brand</option>
                                    <?php
                                    $brand = new Brand();
                                    $getAllBrand = $brand->getAllBrand();
                                    if ($getAllBrand) {
                                        while ($getBrand = $getAllBrand->fetch_assoc()) { ?>
                                            <option value="<?php echo $getBrand['brandId'] ?>"><?php echo $getBrand['brandName'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md flex-column d-flex">
                            <label class="form-control-label">Product Description<span class="text-danger"> *</span></label>
                            <textarea class="tinymce" id="tinymce" placeholder="Enter Product Description" name="body"></textarea>
                        </div>

                        <div class="form-group col-md-6 flex-column d-flex">
                            <label class="form-control-label">Product Price<span class="text-danger"> *</span></label>
                            <input type="text" id="productName" name="price" placeholder="Enter Product Price">
                        </div>

                        <div class="row justify-content-between form-group">
                            <div class="form-group col-md-6 flex-column d-flex">
                                <label class="form-control-label">Product Image<span class="text-danger"> *</span></label>
                                <input type="file" id="productimage" name="image">
                            </div>
                            <div class="form-group col-md-6 flex-column d-flex">
                                <label class="form-control-label">Product Type<span class="text-danger"> *</span></label>
                                <select id="select" name="type">
                                    <option>Select Type</option>
                                    <option value="0">Featured</option>
                                    <option value="1">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary my-3" value="Save">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </main>

    <?php include "inc/footer.php"; ?>