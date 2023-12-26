<?php

    include "php/dbconnect.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Purchase - Page</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">BuildoRama</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="purchase.php">Purchase</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="user_services.php">User Services</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header style="background-color: #0085a1; height: 80px; ">
            
        </header>

        
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        
                        <div class="my-5">
                        
                        <form id="categorySelectForm" method="get">
                                <fieldset>
                                    <legend>Select Product Category</legend>
                                    <div>
                                        <label for="selected_catg" style="color: #6c757d; padding-bottom: 13px;">Product Categories</label>
                                        <select class="form-control" name="selected_catg" id="selected_catg">
                                            <option value=" "> Select Category </option>
                                            <?php

                                                error_reporting(E_ALL);
                                                ini_set('display_errors', 0);
                                                $logFilePath = 'D:/error.log';
                                                ini_set('log_errors', 1);
                                                ini_set('error_log', $logFilePath);


                                                $sql = "SELECT DISTINCT Category FROM products";
                                                $catgResult = mysqli_query($conn, $sql);

                                                while ($prod = mysqli_fetch_array($catgResult)) {
                                                    ?>
                                                        <option value="<?php echo $prod['Category'] ?>"> <?php echo $prod['Category'] ?> </option>
                                                    <?php
                                                }

                                            ?>
                                        </select>
                                        <br>

                                        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Select</button>
                                    </div>
                                </fieldset>
                            </form>

                            <?php

                            $message = urldecode($_GET['data']);

                            if($message != "") {
                                
                            ?>

                            <p style="text-align: center;"> <?php echo $message ?> </p>

                            <?php

                            }

                            ?>

                            <br>

                            <?php

                                if(isset($_GET['selected_catg']) and $_GET['selected_catg'] !== " "){

                                    $catg = $_GET['selected_catg'];

                                    
                            ?>

                            <form id="PurchaseForm" method="post" action="php/orderconfirm.php">
                                
                                <fieldset>
                                    <legend>Bulk Product Purchase - Category: <?php echo $catg ?></legend>

                                        <div>
                                            <label for="selected_prod" style="color: #6c757d; padding-bottom: 13px;">Products</label>
                                            <select class="form-control" name="selected_prod" id="selected_prod">

                                            <?php
                                                
                                                $prodSql = "SELECT * FROM products WHERE Category = '$catg' ";
                                                $prodResult = mysqli_query($conn, $prodSql);

                                                while ($prod = mysqli_fetch_array($prodResult)) {
                                                    ?>
                                                        <option value="<?php echo $prod['ProductID'] ?>"> <?php echo $prod['ProductName']." &nbsp;&nbsp; | &nbsp;&nbsp; Available Quanity: ".$prod['StockQuantity']." &nbsp;&nbsp; | &nbsp;&nbsp; Price/unit: $".$prod['Price']?> </option>
                                                    <?php
                                                }
                                            ?>

                                            </select>
                                        </div>
                                        <br>
    
                                    <div class="form-floating">
                                        <input class="form-control" id="quantity" name="quantity" type="number" min="1" placeholder="Enter your quantity you want to purchase..." required/>
                                        <label for="quantity">Purchase Quantity</label>
                                    </div>
    
                                    <div class="form-floating">
                                        <input class="form-control" id="mem_num" name="mem_num" type="text" placeholder="Enter your Member Ship number..." required/>
                                        <label for="first_name">MemberShip Number</label>
                                    </div>

                                </fieldset>

                                <br>

                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Order</button>
                            </form>

                            <?php

                                }

                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; BuildoRama by Harjinder Singh</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
