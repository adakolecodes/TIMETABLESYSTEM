<?php
/**
 * Created by PhpStorm.
 * User: MSaqib
 * Date: 16-11-2016
 * Time: 14:46
 */
session_start();
include 'connection.php';
$id = $_GET['name'];
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "DELETE FROM classrooms WHERE name = '$id' ");
if ($q) {

    $_SESSION['success'] = "Classroom deleted successfully!";
    header("location: add-classrooms");

} else {
    $_SESSION['error'] = "Error";
    header("location: add-classrooms");
}