<?php 
session_start();

require '../functions/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$id = $_GET["id"];

$gte = query("SELECT * FROM transaksi WHERE id = $id")[0];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../src/css/sidenav.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="../assets/TC.png">
    </head>
    <body onload="window.print()">
        <div class="d-flex" id="wrapper">
                <!-- Page content-->
                <div class="container-fluid d-flex align-items-center flex-column" style="margin-top: 150px;">
                   <div class="bg-light shadow-lg mx-auto my-auto" style="width: max-content; height: max-content;">
                        <div class="text-center text-bold h5 mt-3">Techno Cashier</div>
                        <ul class="d-flex flex-column list-unstyled mt-5" style="margin-left: 15px; margin-right: 15px;">
                            <li>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $gte["pembeli"]; ?></li>
                            <li>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $gte["tanggal"]; ?></li>
                            <li>Produk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $gte["produk"]; ?></li>
                            <li>Total Produk&nbsp;: <?= $gte["total"]; ?></li>
                            <hr>
                            <ul class="list-unstyled" style="margin-bottom: 150px;">
                                <li>Harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $gte["harga"]; ?></li>
                                <li>Pembayaran : <?= $gte["bayar"]; ?></li>
                                <li>Kembalian &nbsp;&nbsp;&nbsp;: <?= $gte["payback"]; ?></li>
                                <li>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $gte["total"] * $gte["harga"]; ?></li>
                                <li style="font-weight: 700; font-size: 15px; text-align: center; margin-top: 25px;">TERIMAKASIH TELAH BELANJA <br> DI TECHNO SMKN 2  BANJARMASIN</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
