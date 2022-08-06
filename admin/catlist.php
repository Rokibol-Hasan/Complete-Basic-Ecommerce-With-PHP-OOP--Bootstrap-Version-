<?php
include "inc/header.php";
include "inc/sidebar.php";
include "../classes/category.php";
$category = new Category();
if (isset($_GET['del'])) {
    $delBrandId = $_GET['del'];
    $deleteCategory = $category->deleteCatById($delBrandId);
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="container-fluid px-4">
                <h1 class="mt-4">Brand List</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Brand List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x = 1;
                                $getAllCat = $category->getAllCat();
                                if ($getAllCat) {
                                    while ($result = $getAllCat->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $x;
                                                $x++; ?></td>
                                            <td><?php echo $result['catName']; ?></td>
                                            <td>
                                                <span class="delete-anchor"><a onclick="return confirm('আসলেই উধাও করবেন?')" href="?del=<?php echo $result['catId'] ?>"> Delete </a>
                                                </span>
                                                <span class="edit-anchor"><a href="catedit.php?cid=<?php echo $result['catId'] ?>"> Edit </a>
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