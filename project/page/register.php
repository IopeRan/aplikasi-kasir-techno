<?php 

require '../functions/functions.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="../assets/tcs.svg">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap');
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="background-color: #e6e6e6; width: 100%; height: 100vh;">
    <div class="bg-light rounded mx-auto d-flex shadow-lg d-flex flex-column" style="width: 400px; height:450px;">
        <div class="h3 mt-2 text-center p-2" style="font-family: 'Ubuntu', sans-serif; width: 400px;">Techno Cashier Register</div>
        <hr class="mx-auto" style="width: 90%; margin-top: -10px;">
        <?php 
        if(isset($_POST['register'])) {
            $username = stripslashes($_POST['username']);
            $password = $_POST['password'];
            $conpass = $_POST['conpass'];
        
            $users_check = mysqli_query($conn, "SELECT * FROM developer WHERE username = '$username' ");
            $users_login = mysqli_num_rows($users_check);
        
            if($users_login > 0) {
                echo "<script>
                      alert('Username tidak tersedia, silahkan gunakan username lain');
                      window.location = 'register.php';
                      </script>";
            } else {
                if($password != $conpass) {
                    echo  "<div class='alert alert-danger mx-auto' role='alert' style='width: 373px; height: 55px;'>
                           Password Salah!
                           </div>";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_query($conn, "INSERT INTO developer VALUES('', '$username', '$password')");
                    echo "<script>
                          alert('Akun Berhasil dibuat');
                          window.location = 'dashboard.php';
                          </script>";
                }
            }
        
        }
        ?>
        <form action="" method="post" class="d-flex flex-column gap-4">
            <input class="rounded mx-auto shadow-lg text-center" style="width: 373px; height: 36px; outline: none; border: none;" type="text" autocomplete="off" required htmlspecialchars id="username" name="username" placeholder="Username">
            <input class="rounded mx-auto shadow-lg text-center" style="width: 373px; height: 36px; outline: none; border: none;" type="password" autocomplete="off" required htmlspecialchars id="password" name="password" placeholder="Password">
            <input class="rounded mx-auto shadow-lg text-center" style="width: 373px; height: 36px; outline: none; border: none;" type="password" autocomplete="off" required htmlspecialchars id="conpass" name="conpass" placeholder="Confirm Password">
            <button class="btn btn-primary mx-auto" style="width: 373px; height: 36px;" id="register" name="register">REGISTER</button>
            <hr class="mx-auto mt-1" style="width: 90%;">
            <div class="mx-auto" style="font-size: 14px; margin-top: -35px;"><span>have an account?</span><a class="text-decoration-none" href="login.php">login to account</a></div>
        </form>
    </div>
</body>

</html>