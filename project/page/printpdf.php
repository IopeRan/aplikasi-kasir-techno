<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../functions/functions.php';

$getTransaksi = query("SELECT * FROM transaksi");

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
        <table class="table table-dark shadow-lg mt-2 mx-auto" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="6">Riwayat Pembelian Techno Gallery</th>
                            </tr>
                            <tr class="text-center text-warning">
                                <!-- <th>ID</th> -->
                                <th width="400" scope="col">Pembeli</th>
                                <th scope="col" width="400">Tanggal Transaksi</th>
                                <th scope="col" width="400">Produk</th>
                                <th scope="col" width="200">Total Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="350">Pembayaran</th>
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
                                    <td><?= $gt["pembeli"]; ?></td>
                                    <td><?= $gt["tanggal"]; ?></td>
                                    <td><?= $gt["produk"]; ?></td>
                                    <td><?= $gt["total"]; ?></td>
                                    <td><?= $gt["hasil"]; ?></td>
                                    <td><?= $gt["bayar"]; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <tr class="text-center">
                                <td width="210">Produk Yang Terjual :</td>
                                <td><?= $sold; ?>&nbsp;&nbsp;unit</td>
                                <td></td>
                                <td></td>
                                <td width="250">| Total Pendapatan :</td>
                                <td>Rp.<?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        <!-- ------- -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sweetalert/sweetalert2.all.min.js"></script>
</body>
</html>