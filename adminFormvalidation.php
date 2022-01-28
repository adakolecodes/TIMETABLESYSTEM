<?php

session_start();

include 'connection.php';
require "dbconn2.php";
if (isset($_POST['UN']) && isset($_POST['PASS'])) {
    $id = $_POST['UN'];
    $password = $_POST['PASS'];
} else {
    die();
}
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT name FROM admin WHERE name = '$id' and password = '$password' ");
$q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT faculty_number FROM teachers WHERE faculty_number = '$id' and contact_number = '$password' ");

$sql =  "SELECT * FROM teachers WHERE faculty_number = '$id' and contact_number = '$password'";
$pds = $pdo->prepare($sql);
$pds->execute(array());
$result = $pds->fetch(PDO::FETCH_ASSOC);

if (mysqli_num_rows($q) == 1) {
    header("Location: dashboard");
    $_SESSION['granted'] = "granted";
}elseif (mysqli_num_rows($q2) == 1){
    $_SESSION["lecturer"] = $result['faculty_number']." ".$result['contact_number'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['faculty_number'] = $result['faculty_number'];
    header("Location: lecturer/dashboard");
}elseif ($id == "student" and $password == "12345"){
    header("Location: student/dashboard");
    $_SESSION['student'] = "student";
} else {
    $_SESSION['error'] = "Username or password incorrect!";
    header("Location: login");
}
?>