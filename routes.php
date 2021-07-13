<?php
$controllers = array(
    'Login' => array("Login"),
    'User' => array("create","update","destroy","index"),
);
//var_dump(in_array("update", $controllers['User']));
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'Login';
    $action = 'Login';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . 'Controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = $controller. 'Controller';
$controller = new $klass;
$controller->$action();