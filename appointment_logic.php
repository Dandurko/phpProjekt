<?php
session_start();
require_once(__DIR__ . '/admin/DB.php');

use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");

if(isset($_POST['submit'])) {

$menoArray = explode(' ', $_POST['name']);
$firstName = isset($menoArray[0]) ? $menoArray[0] : '';
$lastName = isset($menoArray[1]) ? $menoArray[1] : '';


$email = isset($_POST['email']) ? $_POST['email'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$dateString = $_POST['date'];
$date = new DateTime($dateString);
$formattedDate = $date->format('Y-m-d');
$phoneNumber = isset($_POST['phone']) ? $_POST['phone'] : '';

$insert = $db->makeAppointment($firstName, $lastName, $formattedDate, $phoneNumber, $message, $department);
    if($insert!=null) {
        header("Location: index.php?status=1#appointment");

    } else {
        header("Location: index.php?status=0#appointment");
    }
} else {
    header("Location: home.php");
}