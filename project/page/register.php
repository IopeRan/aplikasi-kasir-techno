<?php 

// require 'functions.php';

// if(isset($_POST['register'])) {
    
//     if( registrasi($_POST) > 0 ) {
//         echo "<script>
//               alert('registrasi anda berhasil!');
//               </script>";
//     } else {
//         echo mysqli_error($conn);
//     }

// }

require '../functions/functions.php';

if(isset($_POST['register'])) {
    $username = stripslashes($_POST['username']);
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];

    $users_check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
    $users_login = mysqli_num_rows($users_check);

    if($users_login > 0) {
        echo "<script>
              alert('Username tidak tersedia, silahkan gunakan username lain');
              window.location = 'register.php';
              </script>";
    } else {
        if($password != $conpass) {
            echo "<script>
            alert('konfirmasi password salah, silahkan ketikkan password ulang');
            window.location = 'register.php';
            </script>";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
            echo "<script>
                  alert('Akun Berhasil dibuat');
                  window.location = 'dashboard.php';
                  </script>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../src/css/register.css">
</head>
<body>
<div class="fContainer">
        <div class="wrapper">
            <div class="box-form">
                <div class="header-text">
                    TECHNO REGISTER AREA
                    <hr>
                </div>
                <form action="" method="post">
                    <div class="col-input">
                        <input type="text"
                               placeholder="Username"
                               autocomplete="off"
                               required
                               htmlspecialchars
                               id="username"
                               name="username" 
                        >
                        <input type="password"
                               placeholder="Password"
                               autocomplete="off"
                               required
                               htmlspecialchars
                               id="password"
                               name="password" 
                        >
                        <input type="password"
                               placeholder="Confirm Password"
                               autocomplete="off"
                               required
                               htmlspecialchars
                               id="conpass"
                               name="conpass"  
                        >
                    </div>
                    <div class="reg-button">
                        <button name="register" id="register">REGISTER</button>
                    </div>
                </form>
                <div class="row-hr">
                    <hr>or<hr>
                </div>
                <div class="create">
                    have an account?<span><a href="../page/login.php">back to login</a></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>