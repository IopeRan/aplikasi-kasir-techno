<?php
session_start();

require '../functions/functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

// pagination
// configuration pagination
$dataPerPage = 10;
$countData = count(query("SELECT * FROM produk"));
$countPage = ceil($countData / $dataPerPage);
$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
$earlyData = ($dataPerPage * $page) - $dataPerPage;
// var_dump($page);

$getproduk = query("SELECT * FROM produk LIMIT $earlyData, $dataPerPage");

// menu pencarian
// tombol findid ditekan
if (isset($_POST['findid'])) {
  $getproduk = findid($_POST["searchid"]);
}

// tombol findname ditekan
if (isset($_POST['findname'])) {
  $getproduk = findname($_POST["searchname"]);
}

// tombol findprice ditekan
if (isset($_POST['findprice'])) {
  $getproduk = findsearch($_POST["searchprice"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Menu Product</title>
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
        if (!in_array("cashier", $_SESSION['admin_akses'])) {
          echo "<div class='alert alert-danger mt-5' role='alert'>
          You dont have the permission to acces this page
        </div>";
          exit();
        }
        ?>
        <a href="add.php" class="btn btn-primary my-5">Tambah Produk</a>
        <div class="d-flex flex-column">
          <form class="d-flex flex-row" action="" method="post">
            <input class="shadow-lg w-100 my-1" autocomplete="off" style="height: 35px; border: none; outline: none;" type="number" id="searchid" name="searchid" placeholder="cari ID barang">
            <button class="btn rounded-0 btn-primary" style="height: 35px; margin-top: 4px;" name="findid" id="findid"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          <form class="d-flex flex-row" action="" method="post">
            <input class="shadow-lg w-100 my-1" autocomplete="off" style="height: 35px; border: none; outline: none;" type="text" id="searchname" name="searchname" placeholder="cari Nama barang">
            <button class="btn rounded-0 btn-primary" style="height: 35px; margin-top: 4px;" name="findname" id="findname"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          <form class="d-flex flex-row" action="" method="post">
            <input class="shadow-lg w-100 my-1" autocomplete="off" style="height: 35px; border: none; outline: none;" type="number" id="searchprice" name="searchprice" placeholder="cari Harga barang">
            <button class="btn rounded-0 btn-primary" style="height: 35px; margin-top: 4px;" name="findprice" id="findprice"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
        <table class="table my-2">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="bg-dark text-light text-center">ID</th>
              <th scope="col" class="bg-dark text-light text-center">Product</th>
              <th scope="col" class="bg-dark text-light text-center">Price</th>
              <th scope="col" class="bg-dark text-light text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($getproduk as $gp) : ?>
              <tr>
                <td class="bg-light text-center"><?= $gp["id"]; ?></td>
                <td class="bg-light text-center"><?= $gp["produk"]; ?></td>
                <td class="bg-light text-center"><?= $gp["harga"]; ?></td>
                <td class="bg-light text-center"><a style="margin-right: 15px;" href="transaksi.php?id=<?= $gp["id"]; ?>"><i class="h2 text-success fa-solid fa-cart-shopping"></i></a><a style="margin-right: 15px;" href="edit.php?id=<?= $gp["id"]; ?>"><i class="h2 fa-solid fa-pen-to-square"></i></a></a><a href="delete.php?id=<?= $gp["id"]; ?>" onclick="return confirm('yakin?')"><i class="h2 text-danger fa-sharp fa-solid fa-trash"></i></a></td>
              </tr>
            <?php endforeach; ?>
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