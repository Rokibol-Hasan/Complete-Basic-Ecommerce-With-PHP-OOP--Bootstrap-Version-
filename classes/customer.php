<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php

class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function customerRegistration($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<span class='error'>   Email Is Not Valid </span>";
            return $msg;
        }
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if ($name == '' || $city == '' || $zip == '' || $email == '' || $address == '' || $country == '' || $phone == '' || $pass == '') {
            $msg = "<span class='error'>   Field Must Not Be Empty </span>";
            return $msg;
        }
        $mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck != false) {
            $msg = "<span class='error'>   This Email Already Exist </span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer (name,city,zip,email,address,country,phone,pass)VALUES('$name','$city','$zip','$email','$address','$country','$phone', '" . MD5($pass) . "' )";
            $insertCustomer = $this->db->insert($query);
            if ($insertCustomer) {
                echo "<script>alert('Registration successfull, Please login to your account.');window.location='userlogin.php'</script>";
            }
        }
    }

    public function customerLogin($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = md5($data['pass']);
        if ($email == '' || $pass == '') {
            $msg = "<span class='error'> Field Must Not Be Empty </span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '" . MD5($pass) . "'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("customerLogin", true);
            Session::set("customerId", $value['id']);
            Session::set("customerName", $value['name']);
            header("Location:cart-user.php");
        } else {
            $msg = "<span class='error'>   Email Or Password Not Matched </span>";
            return $msg;
        }
    }
    public function updateCustomerById($id, $data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $pass = md5($data['pass']);
        if ($name == '' || $city == '' || $zip == '' || $email == '' || $address == '' || $country == '' || $phone == '' || $pass == '') {
            $msg = "<span class='error'>   Field Must Not Be Empty </span>";
            return $msg;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<span class='error'>   Email Is Not Valid </span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_customer SET
            name = '$name',
            city = '$city',
            zip = '$zip',
            email = '$email',
            address = '$address',
            country = '$country',
            phone = '$phone',
            pass = '" . MD5($pass) . "'
            WHERE id = '$id' ";
            $updateCustomer = $this->db->update($query);
            if ($updateCustomer) {
                header("Location:profile.php");
            } else {
                $msg = "<span class='success'>Profile Not Updated </span>";
                return $msg;
            }
        }
    }
    public function getCustomerById($customerId)
    {
        $customerId = Session::get("customerId");
        $query = "SELECT * FROM tbl_customer WHERE id = '$customerId'";
        $getCustomerInfo = $this->db->select($query);
        return $getCustomerInfo;
    }
    public function getCustomerInfo()
    {
        $customerId = Session::get("customerId");
        $query = "SELECT * FROM tbl_customer WHERE id = '$customerId'";
        $getCustomerInfo = $this->db->select($query);
        return $getCustomerInfo;
    }
}
