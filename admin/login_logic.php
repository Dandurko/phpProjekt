<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");

if(isset($_POST['login'])) {
    $insert = $db->logIn($_POST['username'], $_POST['password']);

    if($insert!=null) {
        $_SESSION['login'] = true;
        $_SESSION['userId'] = $insert;
        header("Location: news_management.php");

    } else {
        header("Location: login.php?status=0");
    }
} else {
    header("Location: home.php");
}