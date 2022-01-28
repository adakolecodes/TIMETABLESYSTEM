<?php
session_start();
if(
    isset($_SESSION['granted'])
){
if(isset($_GET['delete'])){

    require("dbconn2.php");

    $id = $_GET['delete'];

    $sql = "DELETE FROM teachers WHERE id = $id";
    $pds = $pdo->prepare($sql);
    $pds->execute(array("delete"=>$_GET["delete"]));

    $_SESSION['success'] = "Teacher deleted successfully!";
    header("location: teachers");
}else{
    header("location: dashboard");
}
}else{
    header("location: login");
}
?>