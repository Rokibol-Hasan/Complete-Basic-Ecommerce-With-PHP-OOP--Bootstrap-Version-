<?php
include "inc/header.php";
$login = Session::get("customerLogin");
if ($login == true) {
    header("Location:order.php");
}
?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg my-5 ">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="loginForm">
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $customerLogin = $customer->customerLogin($_POST);
                                    }
                                    ?>
                                    <?php
                                    if (isset($customerLogin)) {
                                        echo $customerLogin;
                                    }
                                    ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" type="text" name="email" placeholder="name@example.com" />
                                        <label for="email">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="pass" name="pass" type="password" placeholder="Password" />
                                        <label for="pass">Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input class="btn btn-primary" name="login" type="submit" value="Login" />
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="userregister.php">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include "inc/footer.php"; ?>