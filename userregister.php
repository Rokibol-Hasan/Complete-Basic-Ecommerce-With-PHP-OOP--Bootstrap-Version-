<?php
include "inc/header.php";
?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg my-5 ">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Registration</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="loginForm">
                                    <span style="color:red;font-size:18px">
                                        <?php
                                        if (isset($_POST['register'])) {
                                            $customerRegistration = $customer->customerRegistration($_POST);
                                        }
                                        if (isset($customerRegistration)) {
                                            echo $customerRegistration;
                                        }
                                        ?>
                                    </span>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" type="text" name="name" placeholder="John Doe" />
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="address" type="text" name="address" placeholder="Your address" />
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="row justify-content-between form-group">
                                        <div class="form-floating mb-3 col-md-6 flex-column d-flex">
                                            <input class="form-control" id="email" type="text" name="email" placeholder="john@example.com" />
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6 flex-column d-flex">
                                            <input class="form-control" id="name" type="text" name="phone" placeholder="+880" />
                                            <label for="phone">Phone</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between form-group">
                                        <div class="form-floating mb-3 col-md-6 flex-column d-flex">
                                            <input class="form-control" id="country" type="text" name="country" placeholder="Dhaka" />
                                            <label for="country">Country</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6 flex-column d-flex">
                                            <input class="form-control" id="city" type="text" name="city" placeholder="Dhaka" />
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="zip" type="text" name="zip" placeholder="Zip Code" />
                                        <label for="zip">Zip Code</label>
                                    </div>


                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="pass" type="password" name="pass" placeholder="" />
                                        <label for="pass">Password</label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input class="btn btn-primary" name="register" type="submit" value="Register" />
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="userlogin.php">Already Have An Account? Sign in!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "inc/footer.php"; ?>