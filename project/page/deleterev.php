<?php 

require '../functions/functions.php';

$id = $_GET["id"];

if(deleterev($id)) {
    echo "<script>
            alert('Data Produk Berhasil dihapus');
            document.location.href = 'revenue.php';
          </script>";
} else {
    echo "<script>
                alert('Data Produk Berhasil dihapus');
            document.location.href = 'revenue.php';
          </script>";
}

?>