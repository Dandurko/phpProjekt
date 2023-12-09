<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschema");

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = $db->deleteArticle($id);
    if($delete) {
        header("Location: news_management.php");

    } else {
        header("Location: news_management.php?status=0");
    }
} else {
    header("Location: home.php");
}