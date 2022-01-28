<?php
session_start();

if(isset($_SESSION['granted'])){
if(isset($_POST['addclassroom'])){
    
require("dbconn2.php");
include 'connection.php';

$sql = "SELECT * FROM classrooms WHERE name=:CN";
$pds = $pdo->prepare($sql);
$pds->execute(array("CN"=>$_POST["CN"]));
$record = $pds->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['CN'])) {
    $name = $_POST['CN'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $_SESSION['error'] = "Error";
    header("location: add-classrooms");
    die();
}

if($record){
    $_SESSION['error'] = "This classroom has been added already";
    header("location: add-classrooms");
}else{

$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO classrooms VALUES ('$name',0)");
if ($q) {
    $_SESSION['success'] = "Classroom added successfully!";
    header("location: add-classrooms");
} else {
    $_SESSION['error'] = "Classroom exists already";
    header("location: add-classrooms");
    // header("Location:index.html");

}
}

}else{
    header("location: dashboard");
}
}else{
    header("location: login");
}
?>