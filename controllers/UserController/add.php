<?php
require("../../models/User.php");
$data = $_POST;
$user = new User();
if (empty($data['id'])){
    $user->createUser($data);
} else {
    $user->editUser($data);
}
?>
