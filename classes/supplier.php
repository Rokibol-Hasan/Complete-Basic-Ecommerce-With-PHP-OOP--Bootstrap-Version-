<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php

class Supplier
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function insertSupplier($data)
    {
        $supplierName = mysqli_real_escape_string($this->db->link, $data['supplierName']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $mail = $data['mail'];
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $msg = "<h6 class='error'>Invalid Mail</h6>";
            return $msg;
        }
        if ($supplierName == '' || $address == '' || $phone == '' || $mail == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty</h6>";
            return $msg;
        } else {
            $getSupplier = $this->getAllSupplier();
            $row = mysqli_fetch_array($getSupplier);
            $insertedName = $row['supplierName'];
            $insertedMail = $row['mail'];
            if ($supplierName == $insertedName || $mail == $insertedMail) {
                $msg = "<h6 class='error'>Vendor Already Added</h6>";
                return $msg;
            } else {
                $query = "INSERT INTO tbl_supplier(supplierName,address,phone,mail)VALUES ('$supplierName','$address','$phone','$mail')";
                $insertSupplier = $this->db->insert($query);
                if ($insertSupplier) {
                    $msg = "<h6 class='success'>Supplier Inserted Successfully</h6>";
                    return $msg;
                } else {
                    $msg = "<h6 class='error'>Supplier Not Inserted!!</h6>";
                    return $msg;
                }
            }
        }
    }
    public function getAllSupplier()
    {
        $query = "SELECT * FROM tbl_supplier ORDER BY supplierId DESC";
        $getSupplier = $this->db->select($query);
        return $getSupplier;
    }
    public function getSupplierById($id)
    {
        $query = "SELECT * FROM tbl_supplier WHERE supplierId = '$id'";
        $getSupplierById = $this->db->select($query);
        return $getSupplierById;
    }

    public function updateSupplier($id, $data)
    {
        $supplierName = mysqli_real_escape_string($this->db->link, $data['supplierName']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $mail = $data['mail'];
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $msg = "<h6 class='error'>Invalid Mail</h6>";
            return $msg;
        }
        if ($supplierName == '' || $address == '' || $phone == '' || $mail == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty</h6>";
            return $msg;
        } else {
            $query = "UPDATE tbl_supplier SET
            supplierName = '$supplierName',
            address = '$address',
            phone = '$phone',
            mail = '$mail'
            WHERE supplierId = '$id'
            ";
            $updateSupplier = $this->db->update($query);
            if ($updateSupplier) {
                $msg = "<h6 class='success'>Supplier Updated Successfully</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>Supplier Not Updated!!</h6>";
                return $msg;
            }
        }
    }

    public function deleteSupplierById($id)
    {
        $query = "DELETE FROM tbl_supplier WHERE supplierId = $id";
        $deleteSupplier = $this->db->delete($query);
        if ($deleteSupplier) {
            $msg = "<h6 class='success'>Supplier Deleted Successfully</h6>";
            return $msg;
        } else {
            $msg = "<h6 class='error'>Supplier Not Deleted!!</h6>";
            return $msg;
        }
    }

    public function insertUom($data)
    {
        $shortCode = mysqli_real_escape_string($this->db->link, $data['shortCode']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $relativeFactor = mysqli_real_escape_string($this->db->link, $data['rf']);
        if ($shortCode == '' || $description == '' || $relativeFactor == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_uom (shortCode,description,rf)VALUES('$shortCode','$description','$relativeFactor')";
            $insertUom = $this->db->insert($query);
            if ($insertUom) {
                $msg = "<h6 class='success'>UOM Added Successfully</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>UOM Not Added!!</h6>";
                return $msg;
            }
        }
    }
    public function getAllUom()
    {
        $query = "SELECT * FROM tbl_uom ORDER BY uomId DESC";
        $getAllUom = $this->db->select($query);
        return $getAllUom;
    }
    public function delUomById($id)
    {
        $query = "DELETE FROM tbl_uom WHERE uomId = '$id'";
        $delUom = $this->db->delete($query);
        if ($delUom) {
            $msg = "<h6 class='success'>UOM Deleted Successfully</h6>";
            return $msg;
        } else {
            $msg = "<h6 class='error'>UOM Not Deleted!!</h6>";
            return $msg;
        }
    }
    public function getUomById($id)
    {
        $query = "SELECT * FROM tbl_uom WHERE uomId = '$id'";
        $getUomById = $this->db->select($query);
        return $getUomById;
    }

    public function updateUom($id, $data)
    {
        $shortCode = mysqli_real_escape_string($this->db->link, $data['shortCode']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $relativeFactor = mysqli_real_escape_string($this->db->link, $data['rf']);
        if ($shortCode == '' || $description == '' || $relativeFactor == '') {
            $msg = "<h6 class='error'>Field Must Not Be Empty!!</h6>";
            return $msg;
        } else {
            $query = "UPDATE tbl_uom SET
            shortCode = '$shortCode',
            description = '$description',
            rf = '$relativeFactor'
            WHERE uomId = '$id'";
            $updateUom = $this->db->update($query);
            if ($updateUom) {
                $msg = "<h6 class='success'>UOM updated successfully</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>UOM Not updated!!</h6>";
                return $msg;
            }
        }
    }
    public function uomIdSuggestion($search)
    {
        $query = "SELECT * FROM tbl_uom WHERE shortCode LIKE '%$search%'";
        $getSugg = $this->db->select($query);
        if ($getSugg) {
            $data = '';
            while ($row = $getSugg->fetch_assoc()) {
                $data .= '
                <table>
                    <tbody>
                        <td>
                            <h1>' . $row['shortCode'] . '</h1>
                        </td>
                    </tbody 
                </table>';
            }
            echo $data;
        } else {
            echo "Data Not Found";
        }
    }

    public function insertStock($data)
    {
        $uomId = mysqli_real_escape_string($this->db->link, $data['uomId']);
        $supplierId = mysqli_real_escape_string($this->db->link, $data['supplierId']);
        $rf = mysqli_real_escape_string($this->db->link, $data['rf']);
        $suppQty = mysqli_real_escape_string($this->db->link, $data['suppQty']);
        $convertedQty = mysqli_real_escape_string($this->db->link, $data['convertedQty']);
        $suppPrice = mysqli_real_escape_string($this->db->link, $data['suppPrice']);
        $convertedPrice = mysqli_real_escape_string($this->db->link, $data['convertedPrice']);
        $sellPrice = mysqli_real_escape_string($this->db->link, $data['sellPrice']);
        $productId = mysqli_real_escape_string($this->db->link, $data['productId']);
        if ($uomId == '' || $supplierId == '' || $suppQty == '' || $convertedQty == '' || $suppPrice == '' || $convertedPrice == '' || $sellPrice == '' || $rf == '' || $productId == '') {
            $msg = "<h6 class='error'>Field must not be empty</h6>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_stock(uomId,supplierId,rf,suppQty,convertedQty,suppPrice,convertedPrice,sellPrice,productId)VALUES('$uomId','$supplierId','$rf','$suppQty','$convertedQty','$suppPrice','$convertedPrice','$sellPrice','$productId')";
            $insertStock = $this->db->insert($query);
            if ($insertStock) {
                $msg = "<h6 class='success'>Stock Inserted</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>Stock not Inserted</h6>";
                return $msg;
            }
        }
    }

    public function selectAllStock()
    {
        $query = "SELECT tbl_stock.*,tbl_uom.shortCode,tbl_supplier.supplierName,tbl_product.productName
        FROM tbl_stock
        INNER JOIN tbl_uom
        ON tbl_stock.uomId = tbl_uom.uomId
        INNER JOIN tbl_supplier
        ON tbl_stock.supplierId = tbl_supplier.supplierId
        INNER JOIN tbl_product
        ON tbl_stock.productId = tbl_product.productId
        ORDER BY tbl_stock.stockId DESC";
        $getAllStock = $this->db->select($query);
        return $getAllStock;
    }
    public function deleteStockById($deleteStock) 
    {
        $query = "DELETE FROM tbl_stock WHERE stockId = '$deleteStock'";
        $deleteStock = $this->db->delete($query);
        return $deleteStock;
    }

    public function updateStockById($editStockId,$data)
    {
        $uomId = mysqli_real_escape_string($this->db->link, $data['uomId']);
        $supplierId = mysqli_real_escape_string($this->db->link, $data['supplierId']);
        $rf = mysqli_real_escape_string($this->db->link, $data['rf']);
        $suppQty = mysqli_real_escape_string($this->db->link, $data['suppQty']);
        $convertedQty = mysqli_real_escape_string($this->db->link, $data['convertedQty']);
        $suppPrice = mysqli_real_escape_string($this->db->link, $data['suppPrice']);
        $convertedPrice = mysqli_real_escape_string($this->db->link, $data['convertedPrice']);
        $sellPrice = mysqli_real_escape_string($this->db->link, $data['sellPrice']);
        $productId = mysqli_real_escape_string($this->db->link, $editStockId);
        if ($uomId == '' || $supplierId == '' || $suppQty == '' || $convertedQty == '' || $suppPrice == '' || $convertedPrice == '' || $sellPrice == '' || $rf == '' || $productId == '') {
            $msg = "<h6 class='error'>Field must not be empty</h6>";
            return $msg;
        } else {
            $query = "UPDATE
            tbl_stock SET
            uomId = '$uomId',
            supplierId = '$supplierId',
            rf = '$rf',
            suppQty = '$suppQty',
            convertedQty = '$convertedQty',
            suppPrice = '$suppPrice',
            convertedPrice = '$convertedPrice',
            sellPrice = '$sellPrice',
            productId = '$productId'
            WHERE stockId = '$editStockId'
            ";
            $updateStock = $this->db->update($query);
            if ($updateStock) {
                $msg = "<h6 class='success'>Stock Updated</h6>";
                return $msg;
            } else {
                $msg = "<h6 class='error'>Stock Not Updated</h6>";
                return $msg;
            }
        }
    }

    public function getStockById($getStockId)
    {
        $query = "SELECT * FROM tbl_stock WHERE stockId = '$getStockId' LIMIT 1";
        $getStockById = $this->db->select($query);
        return $getStockById;
    }
}



?>