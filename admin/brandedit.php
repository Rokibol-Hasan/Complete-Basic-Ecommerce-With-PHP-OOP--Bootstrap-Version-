<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/brand.php";
$brand = new Brand();
if (isset($_GET['bid'])) {
    $id = $_GET['bid'];
}
if (isset($_POST['submit'])) {
    $brandName = $_POST['brandName'];
    $brandUpdate = $brand->brandUpdate($id, $brandName);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="brand-form">
                    <?php
                    if (isset($brandUpdate)) {
                        echo $brandUpdate;
                    }
                    ?>
                    <form action="" method="post">
                        <?php
                        $getBrandById = $brand->getAllBrandById($id);
                        if ($getBrandById) {
                            while ($result = $getBrandById->fetch_assoc()) { ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="brandName" id="inputBrand" value="<?php echo $result['brandName'] ?>">
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