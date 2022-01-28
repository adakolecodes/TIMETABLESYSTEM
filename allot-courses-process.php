<?php
session_start();

if(isset($_SESSION['granted'])){
if(isset($_POST['allotcourse'])){
    
include 'connection.php';

if (isset($_POST['tobealloted'])) {
    $subject = $_POST['tobealloted'];
    $teacher = $_POST['toalloted'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $_SESSION['error'] = "Error";
    header("location: allot-courses");
    die();
}
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "UPDATE subjects SET isAlloted=1, allotedto='$teacher' WHERE subject_code='$subject'");

if ($q) {
    $_SESSION['success'] = "Alloted successfully!";
    header("location: allot-courses");
} else {
    $_SESSION['error'] = "Error";
    header("location: allot-courses");
    // header("Location:index.html");

}

}else{
    header("location: dashboard");
}
}else{
    header("location: login");
}
?>