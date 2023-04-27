<?php 
session_start();

require '../functions/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Developer</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../src/css/sidenav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../assets/TC.png">
    <style>
        .social-item {
            background-color: #ff9c00;
            border-radius: 5px;
            width: 150px;
            height: 35px;
        }

        @media only screen and (max-width: 767px) {
            .social-item {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body style="background-color: #e6e6e6;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">Techno Cashier</div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="dashboard.php"><i class="fa-solid fa-gauge"></i><span style="margin-left: 13px;">Dashboard</span></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="revenue.php"><i style="margin-top: -10px;" style="margin-top: 10px;" class="fa-sharp fa-solid fa-chart-simple"></i><span style="margin-left: 15px;">Revenue</span></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="product.php"><i style="margin-top: -10px;" style="margin-top: 10px;" class="fa-solid fa-basket-shopping"></i><span style="margin-left: 10px;">Product</span></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="https://www.google.com/maps/place/Techno+Park/@-3.2959495,114.5899544,21z/data=!4m14!1m7!3m6!1s0x2de4211bbc1be42d:0xd93490f4e3d79a8e!2sSMK+Negeri+2+Banjarmasin!8m2!3d-3.2956862!4d114.5900279!16s%2Fg%2F11g__vfj2!3m5!1s0x2de423a0d2934103:0x4e32c230b154c815!8m2!3d-3.2959072!4d114.5898031!16s%2Fg%2F11h_sm3wgw" target="_blank"><i style="margin-top: -10px;" style="margin-top: 10px;" class="fa-solid fa-location-dot"></i><span style="margin-left: 15px;">Location</span></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="jadwal.php"><i class="fa-solid fa-calendar"></i><span style="margin-left: 10px;">Schedulle</span></a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-default" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link" href="#!"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="developer.php">About Developer</a>
                                    <a class="dropdown-item bg-danger text-light" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Something else here</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- script sidebar -->
            <script>
                window.addEventListener('DOMContentLoaded', event => {

                    // Toggle the side navigation
                    const sidebarToggle = document.body.querySelector('#sidebarToggle');
                    if (sidebarToggle) {

                        sidebarToggle.addEventListener('click', event => {
                            event.preventDefault();
                            document.body.classList.toggle('sb-sidenav-toggled');
                            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                        });
                    }
                });
            </script>
            <!-- /script sidebar -->
            <!-- Page content-->
            <div class="container-fluid">
                <div class="bg-light rounded shadow-lg mx-auto my-3 d-flex flex-column align-items-center text-center p-5" style="width: 100%;">
                    <div class="display-5">Developed By</div>
                    <img style="border: 3px solid #00ff5b" class="shadow-lg rounded-circle mx-auto mt-4 animate__animated animate__rotateIn" src="../assets/developer.jpg" alt="developer.jpg" width="200px" height="200px">
                    <div class="d-flex flex-column text-center">
                        <div class="h3">Erlang Andriyanputra</div>
                        <div class="h4">SMKN 2 Banjarmasin</div>
                        <div class="h5">X PPLG B</div>
                    </div>
                    <ul class="d-flex flex-wrap list-unstyled gap-3 mt-3">
                        <li class="social-item">
                            <a class="text-decoration-none text-light d-flex justify-content-center mt-1" href="https://www.instagram.com/lang_andp/" target="_blank">
                                <i class="mt-1 text-light fa-brands fa-instagram"></i>Instagram
                            </a>
                        </li>
                        <li class="social-item" style="background-color: #00ff5b;">
                            <a class="text-decoration-none text-dark d-flex justify-content-center mt-1" href="https://wa.me/+6285389172080" target="_blank">
                                <i class="mt-1 text-dark fa-brands fa-whatsapp"></i>WhatsApp
                            </a>
                        </li>
                        <li class="social-item" style="background-color: green;">
                            <a class="text-decoration-none text-light d-flex justify-content-center mt-1" href="https://line.me/ti/p/l3y41CTm8e" target="_blank">
                                <i class="mt-1 text-light fa-brands fa-line"></i>Line
                            </a>
                        </li>
                        <li class="social-item bg-dark">
                            <a class="text-decoration-none text-light d-flex justify-content-center mt-1" href="https://github.com/IopeRan" target="_blank">
                                <i class="mt-1 text-light fa-brands fa-github"></i>Github
                            </a>
                        </li>
                    </ul>
                    <div class="text-muted">Techno Cashier est.2023</div>
                    <hr style="border: 0.5px solid #222; width: 100%;">
                    <div class="mt-5 text-center">
                        <div class="display-5">Created by</div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6 mt-4">
                                <img src="../assets/mysql.png" alt="mysqli.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4"> <!--  -->
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="../assets/html.png" alt="html.png" class="img-fluid">
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <img style="margin-top: -10px;" src="../assets/css.png" alt="css.png" class="img-fluid">
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="../assets/javascript.png" alt="bootstrap.svg" class="img-fluid">
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="../assets/php.png" alt="php.png" class="img-fluid">
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="../assets/fontawesome.png" alt="php.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="../assets/bootstrap.svg" alt="bootstrap.svg" class="img-fluid">
                            </div>
                            <div class="col-6 col-md-8 col-lg-6">
                                <img src="../assets/sweetalert.png" alt="sweetalert.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script>

    </script>
</body>

</html>