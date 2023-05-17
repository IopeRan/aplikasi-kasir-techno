<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../functions/functions.php';

$dari = $_GET["dari"];
$sampai = $_GET["sampai"];

$getTransaksi = query("SELECT * FROM transaksi WHERE tanggal BETWEEN '$dari' AND '$sampai'");

// $getTransaksi = query("SELECT * FROM transaksi BETWEEN $dari AND $sampai");

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
</head>
<body onload="window.print()">
    <div>
        <!-- Header -->
        <div class="d-flex flex-column align-items-center justify-content-center p-3" style="border-bottom: 10px double #222;">
            <div>
                <img src="../assets/smkn2bjm.png" alt="smkn2 logo" width="100" height="100">
            </div>
            <div class="h4 fw-bold">
                Laporan Penjualan Techno Gallery
            </div>
            <div class="h5 fw-bold">
                SMKN 2 Banjarmasin
            </div>
        </div>
        <!-- ------ -->  
        <!-- Content -->
        <div class="container">
        <table class="table table-dark table-striped mt-2 mx-auto fw-normal shadow-sm" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="7">Riwayat Pembelian Techno Gallery</th>
                            </tr>
                            <tr class="text-center text-warning">
                                <!-- <th>ID</th> -->
                                <th scope="col">ID</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Total Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $total = 0;
                            $sold = 0;
                            foreach ($getTransaksi as $transaksi) : 
                                $total += $transaksi["harga"];
                                $sold += $transaksi["total"];
                            ?>
                                    <tr class="text-center">
                                        <td scope="row"><?= $transaksi["id"]; ?></td>
                                        <td><?= $transaksi["pembeli"]; ?></td>
                                        <td><?= $transaksi["tanggal"]; ?></td>
                                        <td><?= $transaksi["produk"]; ?></td>
                                        <td><?= $transaksi["total"]; ?></td>
                                        <td><?= $transaksi["hasil"]; ?></td>
                                        <td><?= $transaksi["bayar"]; ?></td>
                                    </tr>
                            <?php endforeach; ?>
                            <tr class="text-center">
                                <td>Produl Terjual : <?= $sold; ?>&nbsp;&nbsp;unit</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>| Total Pendapatan : Rp.<?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </table>
                </div>
        <!-- ------- -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sweetalert/sweetalert2.all.min.js"></script>
</body>
</html>