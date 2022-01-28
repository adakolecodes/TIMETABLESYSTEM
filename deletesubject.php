<?php
/**
 * Created by PhpStorm.
 * User: MSaqib
 * Date: 30-09-2016
 * Time: 22:44
 */
session_start();
include 'connection.php';
$id = $_GET['name'];
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "DELETE FROM subjects WHERE subject_code = '$id' ");
if ($q) {

    $_SESSION['success'] = "Course deleted successfully!";
    header("location: courses");

} else {
    $_SESSION['error'] = "Error";
    header("location: courses");
}
?>

