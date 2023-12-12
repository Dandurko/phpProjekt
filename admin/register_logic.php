<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");

if(isset($_POST['register'])) {
    $insert = $db->register($_POST['username'], $_POST['password']);

    if($insert) {
        header("Location: login.php?status=1");

    } else {
        header("Location: register.php?status=0");
    }
} else {
    header("Location: home.php");
}