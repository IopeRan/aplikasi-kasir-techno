<?php 
// koneksi ke database
// $conn = mysqli_connect("localhost", "root", "", "technoarea");

// // function registrasi
// function registrasi($data) {
//     global $conn;

//     $username = strtolower(stripslashes($data["username"]));
//     $password = mysqli_real_escape_string($data["password"]);
//     $password2 = mysqli_real_escape_string($data["conpass"]);

//     // cek konfirmasi password
//     if( $password !== $password2 ) {
//         echo "<script>
//               alert('Konfirmasi password tidak sesuai!');
//               </script>";
//     }

// }

// Koneksi ke DBMS
// $hostname = "localhost";
// $user = "root";
// $password = "";
// $db_name = "technoarea";

$conn = mysqli_connect('localhost', 'root', '', 'technoarea');
// ----------------

// ambil data produk
$getproduk = mysqli_query($conn, "SELECT * FROM produk");
// -----------------

// ambil data transaksi
$getTransaksi = mysqli_query($conn, "SELECT * FROM transaksi");
// --------------------

// koneksi user user
if(!$conn) {
    die("failed");
}
// ----------

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


// tambah data produk
function tambah($data) {

    global $conn;

    // mengambil data dari tiap elemen dalam form
    $kode = $data["kode"];
    $produk = $data["produk"];
    $harga = $data["harga"];
    $tanggal = $data["tanggal_masuk"];

    // upload gambar
    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    $query = "INSERT INTO produk VALUES ('', '$kode', '$produk', '$harga', '$tanggal', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // check
    if($error === 4) {
        echo "<script>
                alert('Anda Tidak Menambahkan Gambar');
             </script>";
        return false;
    }

        // check
    $extensionValidImage = ['jpg', 'jpeg', 'png'];
    $extensionImage = explode('.', $fileName);
    $extensionImage = strtolower(end($extensionImage));

    if(!in_array($extensionImage, $extensionValidImage)) {
        echo "<script>
            alert('Yang Anda Upload Bukan Gambar');
        </script>";
        return false;
    }

    // check[size]
    if($fileSize > 5000000 ) {
        echo "<script>
            alert('Size Gambar Terlalu Besar');
        </script>";
    return false;
    }

    //Generate New Name
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $extensionImage;

    // Ready to Upload
    move_uploaded_file($tmpName, '../assets/img/' .$newFileName);
    return $newFileName;

}

// transaksi 
function transaksi($data) {

    global $conn;

    // mengambil data dari tiap elemen dalam form
    $pembeli = htmlspecialchars($data["pembeli"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $produk = htmlspecialchars($data["produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $total = htmlspecialchars($data["total"]);
    $hasil = htmlspecialchars($data["hasil"]);
    $bayar = htmlspecialchars($data["bayar"]);
    $payback = htmlspecialchars($data["payback"]);

    $query = "INSERT INTO transaksi 
                       VALUES 
                       (
                        '', '$pembeli', '$tanggal', '$produk', '$harga', '$total', '$hasil', '$bayar', '$payback'
    )
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// searching function
// for searching product id
function findid($keyword) {
    $query = "SELECT * FROM produk 
                        WHERE 
              id = '$keyword'
             ";
    return query($query);
}

// for searching product name
function findname($keyword) {
    $query = "SELECT * FROM produk 
                        WHERE 
              produk LIKE '%$keyword%'
             ";
    return query($query);
}

// for searching product price
function findsearch($keyword) {
    $query = "SELECT * FROM produk 
                        WHERE 
              harga LIKE '%$keyword%'
             ";
    return query($query);
}

// function delete
function delete($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
    return mysqli_affected_rows($conn);
}




function edit($data) {
    global $conn; 
 
    $id = $data["id"];
    $kode = htmlspecialchars($data["kode"]);
    $produk = htmlspecialchars($data["produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $tanggal = htmlspecialchars($data["tanggal_masuk"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // check
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // $gambar = htmlspecialchars($data["gambar"]);
 
    $query = "UPDATE produk SET 
                  id = '$id',
                  kode = '$kode',
                  produk = '$produk',
                  harga = '$harga',
                  tanggal_masuk = '$tanggal',
                  gambar = '$gambar'

             WHERE id = $id
    ";
 
     mysqli_query($conn, $query);
 
     return mysqli_affected_rows($conn);
 
 }

function revedit($data) {
    global $conn; 
 
    $id = $data["id"];
    $pembeli = htmlspecialchars($data["pembeli"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $produk = htmlspecialchars($data["produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $total = htmlspecialchars($data["total"]);
    $hasil = htmlspecialchars($data["hasil"]);
    $bayar = htmlspecialchars($data["bayar"]);
    $payback = htmlspecialchars($data["payback"]);
 
    $query = "UPDATE transaksi SET 
                  id = '$id',
                  pembeli = '$pembeli',
                  tanggal = '$tanggal',
                  produk = '$produk',
                  harga = '$harga',
                  total = '$total',
                  hasil = '$hasil',
                  bayar = '$bayar',
                  payback = '$payback' 
             WHERE id = $id
    ";
 
     mysqli_query($conn, $query);
 
     return mysqli_affected_rows($conn);
 
 }

function deleterev($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
    return mysqli_affected_rows($conn);
  }

  

function cari($keyword) {
    $query = "SELECT * FROM transaksi 
                    WHERE
                -- id = '$keyword',
                id LIKE '%$keyword%' OR
                pembeli LIKE '%$keyword%' OR
                tanggal LIKE '%$keyword%' OR
                produk LIKE '%$keyword%' OR
                harga LIKE '%$keyword%' OR
                total LIKE '%$keyword%' OR
                hasil LIKE '%$keyword%' OR
                bayar LIKE '%$keyword%' OR
                payback LIKE '%$keyword%' 
             ";
    return query($query);
}

?>