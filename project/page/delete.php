<?php 

require '../functions/functions.php';



$id = $_GET["id"];

if(delete($id) > 0 ) {
    echo "<script>
            alert('Data Produk Berhasil dihapus');
            document.location.href = 'product.php';
          </script>";
} else {
    echo "<script>
         alert('Data Produk Berhasil dihapus');
         document.location.href = 'product.php';
         </script>";  
}

?>