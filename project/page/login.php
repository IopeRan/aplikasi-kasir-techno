<?php
session_start();


if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}

require '../functions/functions.php';

// Login Sistem
$username = "";
$password = "";
$err = "";
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username == '' or $password == ''){
        $err .= "<div class='alert alert-danger mx-auto' role='alert' style='width: 373px; height: 55px;'>
        Username atau Password kosong
    </div>";
    }
    if(empty($err)) {
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if($r1['password'] != md5($password)) {
            $err .= "<div class='alert alert-danger mx-auto' role='alert' style='width: 373px; height: 55px;'>
            Password salah
        </div>";
        }
    }
    if(empty($err)) {
        $login_id = $r1['login_id'];
        $sql1 = "SELECT * FROM admin_akses WHERE login_id = '$login_id'";
        $q1 = mysqli_query($conn, $sql1);
        while($r1 = mysqli_fetch_array($q1)){
            $akses[] = $r1['akses_id']; 
        }
        // if(empty($akses)) {
        //     $err .= "<div class='alert alert-danger mx-auto' role='alert' style='width: 373px; height: 55px;'>
        //     You dont have permission
        // </div>";
        // }
    }
    if(empty($err)) {
        $_SESSION['login'] = true;
        $_SESSION['admin_akses'] = $akses;
        header("location: dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="../assets/TC.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap');
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="background-color: #e6e6e6; width: 100%; height: 100vh;">
    <div class="bg-light rounded mx-auto d-flex shadow-lg d-flex flex-column" style="width: 400px; height: max-content">
        <div class="h3 mt-2 mx-5 p-2" style="font-family: 'Ubuntu', sans-serif; width: 400px;">Techno Cashier Login</div>
        <hr class="mx-auto" style="width: 90%; margin-top: -10px;">
        <?php 
        if($err) {
            echo $err;
        }
        ?>
        <form action="" method="post" class="d-flex flex-column gap-4">
            <input class="rounded mx-auto shadow-lg text-center" value="<?= $username; ?>" style="width: 373px; height: 36px; outline: none; border: none;" type="text" autocomplete="off" htmlspecialchars id="username" name="username" placeholder="Username">
            <input class="rounded mx-auto shadow-lg text-center" style="width: 373px; height: 36px; outline: none; border: none;" type="password" autocomplete="off" htmlspecialchars id="password" name="password" placeholder="Password">
            <button class="btn btn-primary mx-auto shadow-lg" style="width: 373px; height: 36px;" id="login" name="login">LOGIN</button>
            <hr class="mx-auto mt-1" style="width: 90%;">
            <div class="mx-auto" style="font-size: 14px; margin-top: -35px; margin-bottom: 50px;"><span>don't have an account?</span><a class="text-decoration-none" href="register.php">create account</a></div>
        </form>
    </div>
</body>

</html>