<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php

class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<h6 class='error'>Category Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName)VALUES ('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                echo "<script>alert('Category Added Successfully');window.location='catlist.php'</script>";
            }
        }
    }


    public function getAllCat()
    {
        $query = "SELECT * FROM tbl_category";
        $getAllCat = $this->db->select($query);
        return $getAllCat;
    }


    public function getAllCatById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $getAllCatById = $this->db->select($query);
        return $getAllCatById;
    }


    public function catUpdate($catId, $catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<h6 class='error'>Category Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "UPDATE 
            tbl_category
            SET
            catName = '$catName'
            WHERE catId = '$catId'
            ";
            $catUpdate = $this->db->update($query);
            if ($catUpdate) {
                echo "<script>alert('Category Updated Successfully');window.location='brandlist.php'</script>";
            }
        }
    }

    public function deleteCatById($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $deleteCat = $this->db->delete($query);
        return $deleteCat;
    }
}



?>