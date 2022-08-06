<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/category.php";
$category = new Category();
if (isset($_POST['submit'])) {
    $catName = $_POST['catName'];
    $insertCat = $category->catInsert($catName);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form">
                    <?php
                    if (isset($insertCat)) {
                        echo $insertCat;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="catName" id="inputBrand" placeholder="Enter Category Name">
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