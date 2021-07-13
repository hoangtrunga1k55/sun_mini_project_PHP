<?php
require("../../models/User.php");
$user = new User();
$id = $_GET['id'];
$user->deleteUser($id);