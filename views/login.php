<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$DIR_FILE = '/var/www/Sun_Mini_Project_login';
if (isset($_SESSION["isLogon"])) {
    header("Location: /Sun_Mini_Project_login/views/admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <?php
    include($DIR_FILE . '/views/layouts/css.php');
    ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Sun* Inc</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập vào hệ thống</p>
            <small style="color: red; text-align: center"><?php echo isset($_SESSION['error']['fail']) ? $_SESSION['error']['fail'] : ''; ?>
            <form action="../controllers/LoginController.php" method="post">
                <small style="color: red; text-align: center"><?php echo isset($_SESSION['error']['email']) ? $_SESSION['error']['email'] : ''; ?>
                </small>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email"
                           value="<?php
                           if(isset($_COOKIE['email'])){
                               echo $_COOKIE['email'];
                           } else if(isset($_SESSION['data']) && !empty($_SESSION['data'])){
                               echo $_SESSION['data']['email'];
                           } else {
                               echo "";
                           }?>" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <small style="color: red; text-align: center"><?php echo isset($_SESSION['error']['password']) ? $_SESSION['error']['password'] : ''; ?>
                </small>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control"
                           value="<?php
                           if(isset($_COOKIE['password'])){
                               echo $_COOKIE['password'];
                           } else if(isset($_SESSION['data']) && !empty($_SESSION['data'])){
                               echo $_SESSION['data']['password'];
                           } else {
                               echo "";
                           }?>"
                           placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember"
                                   name="remember" <?php echo (isset($_COOKIE['email'])) ? "checked" : "" ?>>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->

<?php
include($DIR_FILE . '/views/layouts/script.php');
?>
</body>
</html>