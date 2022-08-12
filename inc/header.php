<?php
ob_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/session.php");
Session::init();
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();
$product = new Product();
$cart = new Cart();
$category = new Category();
$brand = new brand();
$customer = new Customer();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora Demo</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                            <li><a href="cart-user.php"><i class="fa fa-user"></i> My Cart</a></li>
                            <li>
                                <?php
                                if (isset($_GET['cid'])) {
                                    $clearCart = $ct->logoutAndClearCart();
                                    Session::destroy();
                                    header("Location:userlogin.php");
                                }
                                ?>
                                <?php
                                $login = Session::get("customerLogin");
                                if ($login == false) { ?>
                                    <a href="userlogin.php">Login</a>
                                <?php } else { ?>
                                    <a href="?cid=<?php echo Session::get("customerId") ?>">Logout</a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="">
                            <!-- Example single danger button -->
                            <div class="currency">
                                <a type="" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Language
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>
                </div>

                <div class="col-sm-6">
                    <?php 
                    $getAllCartRow = $cart->getAllCartRow();
                    if (!empty($getAllCartRow)) {?>
                    <div class="shopping-item">
                        <a href="cart-user.php">Cart - <span class="cart-amunt">$<?php echo Session::get("grandTotal"); ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count">
                                <?php
                                $checkCart = $cart->checkCartData();
                                if ($checkCart) {
                                    echo Session::get("qty");
                                } else {
                                    echo "(0)";
                                }

                                ?>
                            </span></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>