<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschema");

if(isset($_POST['submit'])) {
    $insert = $db->insertArticle($_POST['title'], $_POST['text'],$_POST['image_url'],  $_SESSION['userId']);

    if($insert) {
        header("Location: news_management.php");

    } else {
        header("Location: news_management.php?status=0");
    }
} else {
    header("Location: home.php");
}