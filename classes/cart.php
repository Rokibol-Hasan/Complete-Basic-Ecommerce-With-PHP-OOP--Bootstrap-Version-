<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
include_once($filepath . "/../classes/supplier.php");
?>
<?php

class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        // $this->sup = new Supplier();
    }

    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $getRequireInfo = $this->db->select($query)->fetch_assoc();

        $productName = $getRequireInfo['productName'];
        $price = $getRequireInfo['price'];
        $image = $getRequireInfo['image'];

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $getProductMatch = $this->db->select($chquery);
        if ($getProductMatch) {
            $msg = "<span class = 'error mx-3'>This Product Added Already Go To Cart!</span>";
            return $msg;
        } else {
            $addCartQuery = "INSERT INTO tbl_cart (sId,productId,productName,price,quantity,image)VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
            $addCart = $this->db->insert($addCartQuery);
            if ($addCart) {
                header("Location: cart-user.php ");
            } else {
                header("Location: 404.php ");
            }
        }
    }
    public function getAllCartRow()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getAllCartRow = $this->db->select($query);
        return $getAllCartRow;
    }
    public function removeFromCartById($cartId)
    {
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $removeFromCart = $this->db->delete($query);
        return $removeFromCart;
    }
    public function updateCart($cartId, $quantity)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart
        SET
        quantity = '$quantity'
        WHERE cartId = '$cartId'
        ";
        $updateCart = $this->db->update($query);
        if ($quantity == '0') {
            $this->removeFromCartById($cartId);
        } else {
            if ($updateCart) {
                header("Location:cart-user.php");
            } else {
                $msg = "<h6 class='error'>Cart Not Updated</h6>";
                return $msg;
            }
        }
    }
    public function checkCartData()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getCartData = $this->db->select($query);
        return $getCartData;
    }
    public function orderAndClearCart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $clearCart = $this->db->delete($query);
        return $clearCart;
    }
    public function logoutAndClearCart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $clearCart = $this->db->delete($query);
        return $clearCart;
    }

    public function insertOrder($customerId)
    {
        $getCart = $this->getAllCartRow();
        if ($getCart) {
            while ($result = $getCart->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $query = "INSERT INTO tbl_order(customerId,productId,productName,quantity,price,image)VALUES('$customerId','$productId','$productName','$quantity','$price','$image')";
                $insertOrder = $this->db->insert($query);
            }
        }
    }
    public function getOrderedProduct($customerId)
    {
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY id DESC";
        $getOrderdProduct = $this->db->select($query);
        return $getOrderdProduct;
    }
    public function checkOrder($customerId)
    {
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId'";
        $getCartData = $this->db->select($query);
        return $getCartData;
    }
    public function deleteOrderById($id)
    {
        $query = "DELETE FROM tbl_order WHERE id = '$id'";
        $deleteOrder = $this->db->delete($query);
        if ($deleteOrder) {
            $msg = "<span class = 'success mx-3'>Removed Order Successfully!</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error mx-3'>Something Went Wrong</span>";
            return $msg;
        }
    }
    public function getAllOrderdProduct()
    {
        $query = "SELECT * FROM tbl_order ORDER BY DATE DESC";
        $getOrderdData = $this->db->select($query);
        return $getOrderdData;
    }
    public function updateStatus($id)
    {
        $orderId = mysqli_real_escape_string($this->db->link, $id);

        $getorder = "SELECT * FROM tbl_order WHERE id = '$id'";
        $getorder = $this->db->select($getorder)->fetch_assoc();
        $productId = $getorder['productId'];
        $quantity = $getorder['quantity'];
        
        $getstock = "SELECT * FROM tbl_stock WHERE productId = '$productId'";
        $getstock = $this->db->select($getstock);
        $getstock = mysqli_fetch_array($getstock);
        $convertedQty = $getstock['convertedQty'];

        $updatedQty = $convertedQty-$quantity; 

        $updatequery = "UPDATE tbl_stock SET 
        convertedQty = '$updatedQty'
        WHERE productId = '$productId'";
        $updateStock = $this->db->update($updatequery);
        $query = "UPDATE tbl_order
        SET
        status = 1
        WHERE id = '$orderId'
        ";
        $updateStatus = $this->db->update($query);
        if ($updateStatus && $updateStock) {
            $msg = "<span class = 'success mx-3'>Updated Successfully!</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error mx-3'>Something Went Wrong</span>";
            return $msg;
        }
    }
    public function getOrderById($id)
    {
        $query = "SELECT * FROM tbl_order WHERE id = $id";
        $getOrder = $this->db->select($query);
        return $getOrder;
    }
}
