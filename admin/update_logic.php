<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");
if (isset($_GET['content'])) {
    // Spracovanie AJAX volania pre aktualizáciu obsahu
    $content = urldecode($_GET['content']);
    $contentId = urldecode($_GET['contentId']);
    // Tu môžete robiť niečo s premennou $content, napr. vyhľadávanie v databáze, spracovanie a odoslanie odpovede
    $update = $db->updateContent($content, $contentId);
    if ($update) {
        echo "success"; // Odpoveď pre AJAX, ktorý sa použije na kontrolu úspešnosti
    }
} elseif (isset($_GET['category'])) {
    // Spracovanie AJAX volania pre aktualizáciu kategórie
    $category = urldecode($_GET['category']);
    $articleId = urldecode($_GET['articleId']);
    // Tu môžete robiť niečo s premennou $category
    $update = $db->updateCategory($articleId, $category);
    if ($update) {
        echo "success"; // Odpoveď pre AJAX, ktorý sa použije na kontrolu úspešnosti
    }
}


elseif (isset($_GET['article'])) {
    // Spracovanie AJAX volania pre aktualizáciu článku
    $title = urldecode($_GET['title']);
    $image_url = urldecode($_GET['image_url']);
    $articleId = urldecode($_GET['articleId']);
    // Tu môžete robiť niečo s premennými $title a $image_url
    echo "Článok aktualizovaný: Titulok - $title, URL obrázku - $image_url";
} else {
    // Ak nie je žiadne zistené AJAX volanie, presmerujte na domovskú stránku
    header("Location: home.php");
}
