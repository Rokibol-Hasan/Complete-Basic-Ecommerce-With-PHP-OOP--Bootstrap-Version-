<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/session.php");
Session::checkLogin();
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>

<?php
class adminLogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function adminLogin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        if (empty($adminUser) || empty($adminPass)) {
            $loginmsg = "Username Or Password Must Not Be Empty";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '" . md5($adminPass) . "' ";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                header("Location:dashboard.php");
            } else {
                $loginmsg = "Username Or Password Not Matched";
                return $loginmsg;
            }
        }
    }
}


?>