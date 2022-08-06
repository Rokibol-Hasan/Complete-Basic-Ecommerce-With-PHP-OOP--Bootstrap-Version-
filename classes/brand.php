<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php

class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            $msg = "<h6 class='error'>Brand Name Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brandName)VALUES ('$brandName')";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                echo "<script>alert('Brand Added Successfully');window.location='brandlist.php'</script>";
            }
        }
    }


    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand";
        $getAllBrand = $this->db->select($query);
        return $getAllBrand;
    }


    public function getAllBrandById($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $getAllBrandById = $this->db->select($query);
        return $getAllBrandById;
    }


    public function brandUpdate($brandId, $brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            $msg = "<h6 class='error'>Brand Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "UPDATE 
            tbl_brand
            SET
            brandName = '$brandName'
            WHERE brandId = '$brandId'
            ";
            $brandUpdate = $this->db->update($query);
            if ($brandUpdate) {
                echo "<script>alert('Brand Updated Successfully');window.location='brandlist.php'</script>";
            }
        }
    }

    public function deleteBrandById($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $deleteBrand = $this->db->delete($query);
        return $deleteBrand;
    }
}



?>