<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/brand.php";
$brand = new Brand();
if (isset($_POST['submit'])) {
    $brandName = $_POST['brandName'];
    $insertBrand = $brand->brandInsert($brandName);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form">
                    <?php
                    if (isset($insertBrand)) {
                        echo $insertBrand;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="brandName" id="inputBrand" placeholder="Enter Brand Name">
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