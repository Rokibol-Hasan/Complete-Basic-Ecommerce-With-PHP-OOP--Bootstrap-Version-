<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
// include_once($filepath . "/../classes/supplier.php");
?>
<?php

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == '' || $uploaded_image == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty</h6>";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "<h6 class='error'>Image Size Should Be Less Than 1MB</h6>";
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<h6 class='error'>You May Upload Only:-" . implode(', ', $permited) . "</h6>";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,image,body,price,type)VALUES('$productName','$catId','$brandId','$uploaded_image','$body','$price','$type')";
            $productInsert = $this->db->insert($query);
            if ($productInsert) {
                echo "<script>alert('Product Added Successfully');window.location='productlist.php'</script>";
            }
        }
    }
    public function getAllProduct()
    {
        $query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_category
        ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand
        ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId DESC";
        $getAllProduct = $this->db->select($query);
        return $getAllProduct;
    }
    public function getSpecCat($id)
    {
        $query = "SELECT tbl_product.*,tbl_category.catName
        FROM tbl_product
        INNER JOIN tbl_category
        ON tbl_product.catId = tbl_category.catId
        WHERE productId = $id
        ORDER BY tbl_product.productId DESC";
        $getSpecCat = $this->db->select($query);
        return $getSpecCat;
    }
    public function getAllRawProduct(){
        $query = "SELECT * FROM tbl_product";
        $getAllProduct = $this->db->select($query);
        return $getAllProduct;
    }
    public function selectProductById($productId)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $selectProductById = $this->db->select($query);
        return $selectProductById;
    }

    public function productUpdate($data, $file, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty</h6>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $msg = "<h6 class='error'>Image Size Should Be Less Than 1MB</h6>";
                } elseif (in_array($file_ext, $permited) === false) {
                    $msg = "<h6 class='error'>You May Upload Only:-" . implode(', ', $permited) . "</h6>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET
            productName = '$productName',
            catId = '$catId',
            brandId = '$brandId',
            body = '$body',
            price = '$price',
            image = '$uploaded_image',
            type = '$type'
            WHERE productId = $id";
                    $productUpdate = $this->db->update($query);
                    if ($productUpdate) {
                        $msg = "<h6 class='success'>Product Updated Successfully</h6>";
                        return $msg;
                    } else {
                        $msg = "<h6 class='error'>Product Not Updated</h6>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product SET
            productName = '$productName',
            catId = '$catId',
            brandId = '$brandId',
            body = '$body',
            price = '$price',
            type = '$type'
            WHERE productId = $id";
                $productUpdate = $this->db->update($query);
                if ($productUpdate) {
                    echo "<script>alert('Product Updated Successfully');window.location='productlist.php'</script>";
                }
            }
        }
    }


    public function deleteProductById($id)
    {
        $selImg = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $getImage = $this->db->select($selImg);
        if ($getImage) {
            while ($linkImage = $getImage->fetch_assoc()) {
                $linked = $linkImage['image'];
                unlink($linked);
            }
        }
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $deleteProduct = $this->db->delete($query);
        if ($deleteProduct) {
            $msg = "<h6 class='success'>Product Deleted Successfully</h6>";
            return $msg;
        } else {
            $msg = "<h6 class='error'>Product Not Deleted</h6>";
            return $msg;
        }
    }
    public function getFeaturedProduct()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $getFeaturedProduct = $this->db->select($query);
        return $getFeaturedProduct;
    }
    public function getNormalProducts()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '1' LIMIT 4";
        $getNormalProduct = $this->db->select($query);
        return $getNormalProduct;
    }
    public function selectProductForDetailsPage($id)
    {
        $query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_category
        ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand
        ON tbl_product.brandId = tbl_brand.brandId
        WHERE productId = '$id'
        ORDER BY tbl_product.productId DESC";
        $getProductDetails = $this->db->select($query);
        return $getProductDetails;
    }
    public function getLatestSamsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
        $getSamsungLatest = $this->db->select($query);
        return $getSamsungLatest;
    }
    public function getLatestApple()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '12' ORDER BY productId DESC LIMIT 1";
        $getAppleLatest = $this->db->select($query);
        return $getAppleLatest;
    }
    public function getLatestAcer()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '19' ORDER BY productId DESC LIMIT 1";
        $getAcerLatest = $this->db->select($query);
        return $getAcerLatest;
    }
    public function getLatestCanon()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
        $getCanonLatest = $this->db->select($query);
        return $getCanonLatest;
    }
    public function getProductByCategory($catId)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '$catId' ORDER BY productId DESC";
        $getProductByCat = $this->db->select($query);
        return $getProductByCat;
    }


    public function insertCompare($customerId,$cmprid){
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $productId = mysqli_real_escape_string($this->db->link, $cmprid);
        $query = "SELECT * FROM tbl_product WHERE productId = $productId";
        $getProduct = $this->db->select($query)->fetch_assoc();
        if ($getProduct) {
            $productName = $getProduct['productName'];
            $price = $getProduct['price'];
            $image = $getProduct['image'];

            $query = "INSERT INTO tbl_compare(customerId,productId,productName,price,image)VALUES('$customerId','$productId','$productName','$price','$image')";
            $insertCompare = $this->db->insert($query);
            if ($insertCompare) {
                $msg = "<h6 class='success'>Product added to compare successfully</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>Product Not Added To Compare</h6>";
                return $msg;
            }
        }
    }

}



?>