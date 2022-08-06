<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/category.php";
$category = new Category();
if (isset($_GET['cid'])) {
    $id = $_GET['cid'];
}
if (isset($_POST['submit'])) {
    $catName = $_POST['catName'];
    $catUpdate = $category->catUpdate($id, $catName);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="brand-form">
                    <?php
                    if (isset($catUpdate)) {
                        echo $catUpdate;
                    }
                    ?>
                    <form action="" method="post">
                        <?php
                        $getCatById = $category->getAllCatById($id);
                        if ($getCatById) {
                            while ($result = $getCatById->fetch_assoc()) { ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="catName" id="inputBrand" value="<?php echo $result['catName'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary my-3" value="Save">
                                </div>
                        <?php }
                        } ?>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </main>
    <?php include "inc/footer.php"; ?>