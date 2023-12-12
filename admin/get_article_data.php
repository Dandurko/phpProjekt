<?php
session_start();
include_once "DB.php";

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $articleData = $db->getArticleWithContentById($id);
    if($articleData) {
        echo json_encode($articleData);
    } else {
        // Článok neexistuje
        echo json_encode(['error' => 'Článok neexistuje']);
    
    }
} else {
    header("Location: home.php");
}