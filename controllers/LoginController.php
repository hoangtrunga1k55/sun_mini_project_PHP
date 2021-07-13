<?php
session_start();
//require("/var/www/Sun_Mini_Project_login/connection.php");
require("/var/www/Sun_Mini_Project_login/models/User.php");
$user = new User();
$data = $_POST;
$email = $data['email'];
$password = md5($data['password']);
$result = $user->auth($email, $password)->num_rows;

require("Requests/LoginRequest.php");
if (isset($data['remember'])){
    setcookie("email",$data['email'],time()+ (86400*30),"/");
    setcookie("password",$data['password'],time()+ (86400*30),"/");
} else {
    setcookie("email",$data['email'],time()- (86400*30),"/");
    setcookie("password",$data['password'],time()- (86400*30),"/");
}
if($result > 0){
    $_SESSION["isLogon"] = $data['email'];
    $_SESSION["email"] = $data['email'];
    $_SESSION["password"] = $data['password'];
    header("Location: /Sun_Mini_Project_login/views/admin/index.php");
}else{
    $error['fail'] = "Thông tin bạn nhập không đúng";
    $_SESSION['error'] = $error;
    $_SESSION['data'] = $data;
    header("Location: /Sun_Mini_Project_login/views/login.php");
}

class LoginController{
    public function Login(){
        header("location:/Sun_Mini_Project_login/views/login.php");
    }
}