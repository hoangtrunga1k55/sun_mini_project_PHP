<?php
session_start();
$error = array();
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

if (empty($data['email'])){
    $error['email'] = 'Bạn chưa nhập email';
}
else if (!is_email($data['email'])){
    $error['email'] = 'Email không đúng định dạng';
}

if (empty($data['password'])){
    $error['password'] = 'Bạn chưa nhập password';
}
$_SESSION['error'] = $error;
