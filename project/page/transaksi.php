<?php
session_start();

require '../functions/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// ambil data produk dengan id lewat url
$id = $_GET["id"];
// query data produk berdasarkan id
$gp = query("SELECT * FROM produk WHERE id = $id")[0];
// var_dump($gp);

// if (isset($_POST["save"])) {
//     // cek apakah tombol submit sudah ditekan atau belum
//     if (transaksi($_POST) > 0) {
//         echo "<script>
//                 alert('data berhasil ditambahkan');
//                 window.location = 'product.php';
//              </script>";
//     } else {
//         echo "<script>
//                 alert('data gagal ditambahkan');
//                 window.location = 'product.php';
//              </script>";
//     }
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Menu Transaksi</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../src/css/sidenav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        input {
            border: 0;
            outline: none;
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="schedulle.php"><i class="fa-solid fa-calendar"></i><span style="margin-left: 10px;">Schedulle</span></a>
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
                            <li class="nav-item"><a class="nav-link" href="#!"><i class="fa-brands fa-discord"></i><span>Discord</span></a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#coming-soon">Account</a>
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
                <div class="bg-light rounded shadow-lg mx-auto my-5 p-3" style="width: 100%; height: max-content;">
                    <div class="h4">Pembayaran</div>
                    <hr>
                    <div class="d-flex flex-column">
                            <?php
                            if (isset($_POST["save"])) {
                                // cek apakah tombol submit sudah ditekan atau belum
                                if (transaksi($_POST) > 0) {
                                    echo "<div class='alert alert-success' role='alert'>
                                            Transaksi Pembayaran Berhasil
                                         </div>";
                                }
                            }
                            ?>
                        <form action="" method="post">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="text" id="pembeli" name="pembeli" autocomplete="off" htmlspecialchars required placeholder="Nama Pembeli">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="text" id="tanggal" name="tanggal" autocomplete="off" readonly htmlspecialchars required placeholder="Tanggal Transaksi" value="<?= date('l, 8-M-Y'); ?>">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="text" id="produk" name="produk" autocomplete="off" readonly htmlspecialchars required placeholder="Nama Produk" value="<?= $gp["produk"]; ?>">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="number" id="harga" name="harga" autocomplete="off" readonly htmlspecialchars required placeholder="Harga Produk" value="<?= $gp["harga"]; ?>">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="number" id="total" name="total" autocomplete="off" htmlspecialchars required placeholder="Total Produk" min="1" max="1000" value="1">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="text" id="hasil" name="hasil" autocomplete="off" readonly required htmlspecialchars placeholder="Total Harga">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="number" id="bayar" name="bayar" autocomplete="off" htmlspecialchars required placeholder="masukkan nominal">
                            <input class="rounded border shadow-lg w-100 my-1" style="border: 0;" type="number" id="payback" name="payback" autocomplete="off" htmlspecialchars readonly required placeholder="kembalian">
                            <button type="submit" class="btn btn-success my-1 w-100" id="save" name="save">Simpan Transaksi</button>
                        </form>
                            <button class="btn btn-primary my-1 w-100" onclick="kali()">Hitung Total</button>
                            <button class="btn btn-danger my-1 w-100" onclick="kurang()">Hitung Kembalian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../src/javascripts/operator.js"></script>
</body>

</html>