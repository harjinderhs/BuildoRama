<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Service - Page</title>
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
                        <br>
                        <h3 style="text-align: center;">Subscribe to become a Member of our Store</h3>
                        <p>Unlock exclusive savings and benefits – become a BuildoRama member today and enjoy privileged access to a world of quality tools and supplies for your projects!</p>
                        <div class="my-5">
                            
                            <form id="registerForm" method="post" action="php/addBuyer.php">
                                <div class="form-floating">
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Enter your first name..." required/>
                                    <label for="first_name">First Name</label>
                                    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Enter your last name..." required/>
                                    <label for="last_name">Last Name</label>
                                    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email..." required />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Enter your phone number..." required />
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter your Address here..." style="height: 12rem" required></textarea>
                                    <label for="address">Address</label>
                                </div>
                                <br />
                            
                                <!-- Submit Button-->
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Subscribe</button>
                            </form>

                            <br>
                            <br>
                            
                            <br>


                            <form id="generateInvoiceForm" method="post" action="php/generateInvoice.php">
                                <fieldset>
                                    <legend>Generate Invoice</legend>

                                    <div class="form-floating">
                                        <input class="form-control" id="mem_num" name="mem_num" type="text" placeholder="Enter your Member Ship number..." required/>
                                        <label for="first_name">MemberShip Number</label>
                                    </div>

                                    <br>

                                    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Generate</button>             

                                </fieldset>
                            </form>


                        </div>

                        <?php

                            error_reporting(E_ALL);
                            ini_set('display_errors', 0);

                            $message = urldecode($_GET['data']);

                            if($message != "") {
                                
                                ?>

                                    <?php echo $message ?>

                                <?php

                            }

                        ?>

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
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
