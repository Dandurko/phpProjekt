<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $article = $db->getArticleById($id);
    $delete = $db->deleteArticle($id);
    $deleteContent = $db->deleteContent($article[0]['articles_content_id']);
    if($delete) {
        header("Location: news_management.php");

    } else {
        header("Location: news_management.php?status=0");
    }
} else {
    header("Location: home.php");
}