<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
//require_once('connection.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'Login';
    $action = 'Login';
}
require_once('routes.php');