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

$conn = mysqli_connect("localhost", "root", "", "technoarea");
// ----------------

// ambil data produk
$getproduk = mysqli_query($conn, "SELECT * FROM produk");
// -----------------

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


// Login Sistem
if(isset($_POST['login'])) {

    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $getacc = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");

    if(mysqli_num_rows($getacc) === 1 ) {
        $data = mysqli_fetch_assoc($getacc);

        if(password_verify($password, $data['password'])) {
            // set session
            $_SESSION["login"] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>
                  alert('Username atau Password salah!!!');  
                  window.location = 'login.php'; 
                  </script>";
        }

    } else {
        echo "<script>
              alert('Username atau Password salah!!!');  
              window.location = 'login.php'; 
              </script>";
    }

}
// ------------

// tambah data
function tambah($data) {

    global $conn;

    // mengambil data dari tiap elemen dalam form
    $produk = $data["produk"];
    $harga = $data["harga"];

    $query = "INSERT INTO produk VALUES ('', '$produk', '$harga')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>