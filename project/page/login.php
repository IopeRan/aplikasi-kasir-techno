<?php 
session_start();


if( isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}

require '../functions/functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../src/css/login.css">
</head>
<body>
    <div class="fContainer">
        <div class="wrapper">
            <div class="box-form">
                <div class="header-text">
                    TECHNO LOGIN AREA
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
                               maxlength="13"
                        >
                        <input type="password"
                               placeholder="Password"
                               autocomplete="off"
                               required
                               htmlspecialchars
                               id="password"
                               name="password" 
                        >
                    </div>
                    <div class="login-button">
                        <button name="login" id="login">LOGIN</button>
                    </div>
                </form>
                <div class="row-hr">
                    <hr>or<hr>
                </div>
                <div class="create">
                    don't have an account?<span><a href="../page/register.php">create account</a></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>