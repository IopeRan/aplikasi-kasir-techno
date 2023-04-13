<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../functions/functions.php';

$dataPerPage = 10;
$countData = count(query("SELECT * FROM transaksi"));
$countPage = ceil($countData / $dataPerPage);
$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
$earlyData = ($dataPerPage * $page) - $dataPerPage;

$getTransaksi = query("SELECT * FROM transaksi LIMIT $earlyData, $dataPerPage");

// tombol cari di klik
if(isset($_POST["cari"])) {
    $getTransaksi = cari($_POST["keyword"]);
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Revenue</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../src/css/sidenav.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            @media (max-width: 600px) {
                .hidden {
                    display: none;
                }

                th {
                    width: max-content;
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
                    <?php 
                    if(!in_array("bendahara", $_SESSION['admin_akses'])) {
                        echo "<div class='alert alert-danger mt-5' role='alert'>
                        You dont have the permission to acces this page
                      </div>";
                        exit();
                    }
                    ?>
                    <form action="" method="post"class="d-flex flex-row">
                        <input class="w-100 mx-auto mt-4 shadow-lg" style="height: 35px; border: none; border-radius: none; outline: none;" st type="text" name="keyword" autofocus placeholder="Cari Data Transaksi" autocomplete="off">
                        <button type="submit" name="cari" class="bg-primary" style="border: none; outline: none; width: 40px; height: 35px; margin-top: 24px;"><i class="fa-solid fa-magnifying-glass text-light"></i></button>
                    </form>
                   <table class="table table-dark table-striped mt-2 mx-auto" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="8" class="hidden">Riwayat Pembelian Techno Gallery</th>
                            </tr>
                            <tr class="text-center text-warning">
                                <!-- <th>ID</th> -->
                                <th scope="col" width="400" class="hidden">ID</th>
                                <th width="400" scope="col">Pembeli</th>
                                <th scope="col" width="400" class="hidden">Tanggal Transaksi</th>
                                <th scope="col" width="400">Produk</th>
                                <th scope="col" width="200" class="hidden">Total Produk</th>
                                <th scope="col" class="hidden">Harga</th>
                                <th scope="col" width="350">Pembayaran</th>
                                <th scope="col" width="300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $data=$conn->query("SELECT * FROM transaksi");
                            $no=1;
                            $total = 0;
                            $sold = 0;
                            // while($getTransaksi = $data->fetch_array()) {
                                foreach($getTransaksi as $gt) :

                                $total += $gt["harga"];
                                $sold += $gt["total"];
                            ?>
                            <tr class="text-center">
                                <td scope="row" class="hidden"><?= $gt["id"]; ?></td>
                                <td><?= $gt["pembeli"]; ?></td>
                                <td class="hidden"><?= $gt["tanggal"]; ?></td>
                                <td><?= $gt["produk"]; ?></td>
                                <td class="hidden"><?= $gt["total"]; ?></td>
                                <td class="hidden"><?= $gt["hasil"]; ?></td>
                                <td><?= $gt["bayar"]; ?></td>
                                <td><a href="deleterev.php?id=<?= $gt["id"]; ?>" style="margin-right: 10px;"><i class="h3 text-danger fa-solid fa-trash" onclick="return confirm('Yakin?')"></i></a><a href="revedit.php?id=<?= $gt["id"]; ?>"><i class="h3 text-primary fa-solid fa-pen-to-square"></i></a><a href="struk.php?id=<?= $gt["id"]; ?>" style="margin-left: 10px;"><i class="h3 text-success fa-solid fa-file-invoice-dollar"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="text-center">
                                <td width="210">Produk Yang Terjual :</td>
                                <td><?= $sold; ?>&nbsp;&nbsp;unit</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="200">| Total Pendapatan :</td>
                                <td>Rp.<?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                          <!-- Navigasi Pagination -->
        <nav aria-label="Page navigation example d-flex" style="display: flex; justify-content: center;">
          <ul class="pagination">
            <li class="page-item">
              <?php if ($page > 1) : ?>
                <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">&laquo;</a>
              <?php endif; ?>
            </li>
            <?php for ($i = 1; $i <= $countPage; $i++) : ?>
              <?php if ($i == $page) : ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
              <?php else : ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>
            <li class="page-item">
              <?php if ($page < $countPage) : ?>
                <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">&raquo;</a>
              <?php endif; ?>
            </li>
          </ul>
        </nav>
        <!-- /Navigasi Pagination -->
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
