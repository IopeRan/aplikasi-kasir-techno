<?php 
session_start();

require '../functions/functions.php';
require '../page/link.php';

$id = $_GET["id"];

if (!in_array("cashier", $_SESSION['admin_akses'])) {
  echo "<script>
      Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Anda Tidak Memiliki Akses Sebagai Kasir',
      }).then(() => {
          window.location.href = 'product.php';
      });
  </script>";
  exit();
}

if (delete($id) > 0) {
  echo "<script>
          Swal.fire({
            title: 'Data Produk Berhasil dihapus',
            icon: 'success'
          }).then(() => {
            window.location.href = 'product.php';
          });
        </script>";
} else {
  echo "<script>
          Swal.fire({
            title: 'Data Produk Gagal dihapus',
            icon: 'error'
          }).then(() => {
            window.location.href = 'product.php';
          });
        </script>";
}
                            

         


?>