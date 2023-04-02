<?php 
// Session setelah login
session_start();

require '../functions/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Session sebelum login
session_start();


if( isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}

// Session untuk logout

session_start();
session_unset();
session_destroy();
header("location:login.php");


?>