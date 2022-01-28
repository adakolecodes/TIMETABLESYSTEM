<?php
/**
 * Created by PhpStorm.
 * User: MSaqib
 * Date: 16-11-2016
 * Time: 14:13
 */
session_start();
include 'connection.php';
$id = $_GET['name'];
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "UPDATE subjects  SET isAlloted = '0' , allotedto = '',allotedto2 = '',allotedto3 = '' WHERE subject_code = '$id' ");
if ($q) {

    $_SESSION['success'] = "Allotment removed successfully!";
    header("location: allot-courses");

} else {
    $_SESSION['error'] = "Error";
    header("location: allot-courses");
}