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

<body onload="window.print()">
    <div class="d-flex" id="wrapper">
            <!-- Page content-->
            <div class="container-fluid">
                <?php
                if (!in_array("bendahara", $_SESSION['admin_akses'])) {
                    echo "<div class='alert alert-danger mt-5' role='alert'>
                        You dont have the permission to acces this page
                      </div>";
                    exit();
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-dark table-striped mt-2 mx-auto" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="7">Riwayat Pembelian Techno Gallery</th>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $data=$conn->query("SELECT * FROM transaksi");
                            $no = 1;
                            $total = 0;
                            $sold = 0;
                            // while($getTransaksi = $data->fetch_array()) {
                            foreach ($getTransaksi as $gt) :

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
                            <?php endforeach; ?>
                            <tr class="text-center">
                                <td width="210">Produk Yang Terjual :</td>
                                <td><?= $sold; ?>&nbsp;&nbsp;unit</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="200">| Total Pendapatan :</td>
                                <td>Rp.<?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sweetalert/sweetalert2.all.min.js"></script>
</body>
</html>