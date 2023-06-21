<?php 
session_start();

require '../functions/functions.php';
require 'link.php';

$id = $_GET["id"];

$gpe = query("SELECT * FROM produk WHERE id = $id")[0];
//  

if (!in_array("admin", $_SESSION['admin_akses'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Anda Tidak Memiliki Akses Sebagai Admin',
        }).then(() => {
            window.location.href = 'product.php';
        });
    </script>";
    exit();
}   

if(isset($_POST["edit"])) {
    if(edit($_POST) > 0 ) {
        echo "<script>
                swal.fire({
                    title: 'Data berhasil di edit',
                    icon: 'success',
                    timer: 2000,
                    buttons: false
                }).then(function(){
                    document.location.href = 'product.php';
                });
             </script>";
    } else {
        echo "<script>
                swal.fire({
                    title: 'Data gagal di edit',
                    text: 'Silakan coba lagi!',
                    icon: 'error',
                    timer: 2000,
                    buttons: false
                }).then(function(){
                    document.location.href = 'product.php';
                });
             </script>"; 
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../src/css/sidenav.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="../assets/tcs.svg">
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
                                <li class="nav-item active"><a class="nav-link" href="dashboard.php"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
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
                   <div class="bg-light mx-auto my-3 shadow-lg rounded p-3" style="width: 100%; height: max-content;">
                    <div class="h3">Edit Data Produk</div>
                    <hr>
                    <form class="d-flex flex-column " action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?= $gpe["id"]; ?>">
                        <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $gpe["gambar"]; ?>">
                        <input class="my-3 rounded shadow-lg" type="text" name="kode" id="kode" placeholder="Kode Produk" required htmlspecialchars style="border: none; outline: none;" value="<?= $gpe["kode"]; ?>">
                        <input class="my-3 rounded shadow-lg" type="text" name="produk" id="produk" placeholder="Nama Produk" required htmlspecialchars style="border: none; outline: none;" value="<?= $gpe["produk"]; ?>">
                        <input class="my-3 rounded shadow-lg" type="number" name="harga" id="harga" placeholder="Harga Produk" required htmlspecialchars style="border: none; outline: none;" value="<?= $gpe["harga"]; ?>">
                        <input class="my-3 rounded shadow-lg" type="date" name="tanggal_masuk" id="tanggal_masuk" placeholder="Harga Produk" required htmlspecialchars style="border: none; outline: none;" value="<?= $gpe["tanggal_masuk"]; ?>">
                        <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Lama :</label>
                        <img src="../assets/img/<?= $gpe["gambar"]; ?>" alt="product" width="100" class="mb-3">
                        <input class="form-control" type="file" id="gambar" name="gambar">
                        </div>
                        <button class="btn btn-primary my-3" id="edit" name="edit">Edit Data</button>
                    </form>
                   </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
    </body>
</html>
