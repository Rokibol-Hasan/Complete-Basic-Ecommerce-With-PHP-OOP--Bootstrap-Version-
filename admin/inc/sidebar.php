        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Shop Management</div>
                        <div class="accordion" id="accordion-acc">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="management-acc-one">
                                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-acc-one" aria-expanded="true" aria-controls="#collapse-acc-one">
                                        <i class="fa-solid fa-shop"></i>UOM Option
                                    </div>
                                </h2>
                                <div id="collapse-acc-one" class="accordion-collapse collapse" aria-labelledby="management-acc-one" data-bs-parent="#accordion-acc">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a class="" href="uomlist.php">UOM List</a></li>
                                            <li> <a class="" href="uomadd.php">Add UOM</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="management-acc-two">
                                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-acc-two" aria-expanded="true" aria-controls="#collapse-acc-two">
                                        <i class="fa-solid fa-cubes"></i>Stock Option
                                    </div>
                                </h2>
                                <div id="collapse-acc-two" class="accordion-collapse collapse" aria-labelledby="management-acc-two" data-bs-parent="#accordion-acc">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a class="" href="stocklist.php">Stock List</a></li>
                                            <li> <a class="" href="stocklist.php">Add Stock</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa-solid fa-copyright"></i>Brand Option
                                    </div>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a class="" href="brandlist.php">Brand List</a></li>
                                            <li> <a class="" href="brandadd.php">Add Brand</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa-solid fa-table-list"></i>Category Option
                                    </div>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a class="" href="catlist.php">Category List</a></li>
                                            <li> <a class="" href="catadd.php">Add Category</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa-brands fa-product-hunt"></i>Product Option
                                    </div>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a class="" href="productlist.php">Product List</a></li>
                                            <li> <a class="" href="productadd.php">Add Product</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            <?php echo Session::get("adminName"); ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>