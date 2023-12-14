<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");
if (isset($_GET['content'])) {

    $content = urldecode($_GET['content']);
    $contentId = urldecode($_GET['contentId']);
    $update = $db->updateContent($content, $contentId);
    if ($update) {
        echo "success"; 
    }
} elseif (isset($_GET['category'])) {

    $category = urldecode($_GET['category']);
    $articleId = urldecode($_GET['articleId']);

    $update = $db->updateCategory($articleId, $category);
    if ($update) {
        echo "success";
    }
}


elseif (isset($_GET['article'])) {

    $title = urldecode($_GET['title']);
    $image_url = urldecode($_GET['image_url']);
    $articleId = urldecode($_GET['articleId']);

    $update = $db->updateArticle($title, $image_url,$articleId);
    if ($update) {
        echo "success";
    }
} else {

    header("Location: home.php");
}
