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
if (isset($_POST["cari"])) {
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
    <link rel="icon" href="../assets/TC.png">
    <style>
        @media (max-width: 600px) {
            .hidden {
                display: none;
            }

            th {
                width: max-content;
            }

            .column-items {
                display: flex;
                flex-direction: column;
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
                <?php
                if (!in_array("bendahara", $_SESSION['admin_akses']) && !in_array("manager", $_SESSION['admin_akses'])) {
                    echo "<div class='alert alert-danger mt-5' role='alert'>
                        You dont have the permission to acces this page
                      </div>";
                    exit();
                }
                ?>
                <div class="py-2"></div>
                <div class="card p-3 shadow-lg fw-bold">
                <form action="" method="post" class="d-flex flex-row mb-2">
                    <input class="w-100 mx-auto mt-4 shadow-lg border" style="height: 35px; outline: none;" st type="text" name="keyword" autofocus placeholder="Cari Data Transaksi" autocomplete="off">
                    <button type="button" name="cari" class="bg-primary shadow-lg" style="border: none; outline: none; width: 40px; height: 35px; margin-top: 24px;"><i class="fa-solid fa-magnifying-glass text-light"></i></button>
                </form>
                    <div>
                        Filter Tanggal Riwayat Pembelian Techno Gallery
                    </div>
                    <form action="" method="post" class="text-center">
                        <div class="table-responsive">
                            <table class="table">
                            <thead class="bg-dark text-white">
                                <tr>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="col-md-4 col-sm-12 mb-2">
                                    <input type="date" id="dari_tanggal" name="dari_tanggal" required class="form-control py-1 shadow-lg">
                                </td>
                                <td class="col-md-4 col-sm-12 mb-2">
                                    <input type="date" id="sampai_tanggal" name="sampai_tanggal" required class="form-control py-1 shadow-lg">
                                </td>
                                <td class="col-md-4 col-sm-12">
                                    <input type="submit" id="filter" name="filter" class="btn btn-primary w-100 shadow-lg" value="Filter">
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="fw-bold">DATA RIWAYAT TRANSAKSI TECHNO GALLERY</div>
                    <div class="table-responsive">
                    <table id="table" class="table table-dark table-striped mt-2 mx-auto fw-normal shadow-sm" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="8">Riwayat Pembelian Techno Gallery</th>
                            </tr>
                            <tr class="text-center text-warning">
                                <!-- <th>ID</th> -->
                                <th scope="col" width="400">ID</th>
                                <th width="400" scope="col">Pembeli</th>
                                <th scope="col" width="400">Tanggal Transaksi</th>
                                <th scope="col" width="400">Produk</th>
                                <th scope="col" width="200">Total Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="350">Pembayaran</th>
                                <th scope="col" width="300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $data=$conn->query("SELECT * FROM transaksi");
                            $no = 1;
                            $total = 0;
                            $sold = 0;
                            // filter
                            if(isset($_POST["filter"])) {
                                $dari_tanggal = mysqli_real_escape_string($conn, $_POST["dari_tanggal"]);
                                $sampai_tanggal = mysqli_real_escape_string($conn, $_POST["sampai_tanggal"]);
                                $data_barang = mysqli_query($conn, "SELECT * FROM transaksi WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
                            } else {
                                $data_barang = mysqli_query($conn, "SELECT * FROM transaksi WHERE tanggal");
                            }
                            // while($getTransaksi = $data->fetch_array()) {
                            while ($gt = mysqli_fetch_array($data_barang)) :

                                $total += $gt["harga"];
                                $sold += $gt["total"];
                            ?>
                                <tr class="text-center">
                                    <td scope="row"><?= $gt["id"]; ?></td>
                                    <td><?= $gt["pembeli"]; ?></td>
                                    <td><?= $gt["tanggal"]; ?></td>
                                    <td><?= $gt["produk"]; ?></td>
                                    <td><?= $gt["total"]; ?></td>
                                    <td><?= $gt["hasil"]; ?></td>
                                    <td><?= $gt["bayar"]; ?></td>
                                    <td class="column-items"><a href="deleterev.php?id=<?= $gt["id"]; ?>" class="delete-link" style="margin-right: 10px;"><i class="h3 text-danger fa-solid fa-trash"></i></a><a href="revedit.php?id=<?= $gt["id"]; ?>"><i class="h3 text-primary fa-solid fa-pen-to-square"></i></a><a href="struk.php?id=<?= $gt["id"]; ?>" style="margin-left: 10px;"><i class="h3 text-success fa-solid fa-file-invoice-dollar"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                            <div class="d-flex flex-row gap-3 flex-wrap">
                                <div class="card border bg-success text-white p-3 d-flex flex-row align-items-center gap-2" style="width: max-content;"><i class="h1 fa-brands fa-sellsy"></i>Produk Yang Terjual : <?= $sold; ?>&nbsp;&nbsp;unit</div>
                                <div class="card border bg-warning text-black p-3 d-flex flex-row align-items-center gap-2" style="width: max-content;"><i class="h1 fa-solid fa-coins"></i>Total Pendapatan : Rp.<?= $total; ?></div>
                            </div>
                        </tbody>
                    </table>
                </div>

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
                <a href="printpdf.php?dari=<?= $dari_tanggal; ?>&&sampai=<?= $sampai_tanggal; ?>" target="_blank" style="width: 150px;" class="btn btn-danger shadow-lg">Cetak Tabel(PDF)</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sweetalert/sweetalert2.all.min.js"></script>
</body>
<script>
  const deleteLinks = document.querySelectorAll('.delete-link');

  deleteLinks.forEach(deleteLink => {
    deleteLink.addEventListener('click', (event) => {
      event.preventDefault();

      Swal.fire({
        title: 'Yakin Mau Hapus Data Produk?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = deleteLink.getAttribute('href');
        }
      })
    });
  });
</script>

</html>