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

if (!isset($_FILES['image'])){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$expensions)=== false){
        $errors['image']="Vui lòng chọn định dạng jpeg, jpg, png";
    }

    if($file_size > 2097152) {
        $errors['image']='Vui lòng nhập hình ảnh có độ dài nhỏ hơn 2MB';
    }
}
$_SESSION['error'] = $error;
return $error;
