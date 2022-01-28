<?php
session_start();

if(isset($_SESSION['lecturer'])){
if((isset($_POST['addcourse'])) or (isset($_POST['updatecourse']))){
    
require("dbconn2.php");
include 'connection.php';

$formid = trim($_POST['formid']);
$arcid = trim($_POST['formarcid']);

$sql = "SELECT * FROM subjects WHERE subject_code=:SC";
$pds = $pdo->prepare($sql);
$pds->execute(array("SC"=>$_POST["SC"]));
$record = $pds->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM subjects WHERE subject_code=:SC and subject_name=:SN and course_type=:ST and department=:SD";
$pds = $pdo->prepare($sql);
$pds->execute(array("SC"=>$_POST["SC"], "SN"=>$_POST["SN"], "ST"=>$_POST["ST"], "SD"=>$_POST["SD"]));
$record2 = $pds->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['addcourse'])){
if (isset($_POST['SN']) && isset($_POST['SC']) && isset($_POST['SS']) && isset($_POST['SD']) && isset($_POST['ST'])) {
    $name = $_POST['SN'];
    $code = $_POST['SC'];
    $sem = $_POST['SS'];
    $course = $_POST['ST'];
    $dept = $_POST['SD'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $_SESSION['error'] = "Error";
    header("location: add-courses");
    die();
}

if($record){
    $_SESSION['error'] = "This course has been added already";
    header("location: add-courses");
}else{

$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO subjects VALUES ('$code','$name','$course','$sem','$dept',0,'','','')");
if ($q) {
    $_SESSION['success'] = "Courses added successfully!";
    header("location: add-courses");
} else {
    $_SESSION['error'] = "Course exists already";
    header("location: add-courses");
    // header("Location:index.php");

}
}
}


if(isset($_POST['updatecourse'])){
    if($formid != $arcid){
        $_SESSION['error'] = "Error!";
        header("location: courses");
    }else{
        if($record2){
            $_SESSION['notice'] = "No changes made";
            header("location: courses");
        }else{
            $sql = "UPDATE subjects SET subject_name=:SN, department=:SD WHERE subject_code = :formid";
            $pds = $pdo->prepare($sql);
            $pds->execute(array("formid"=>$_POST["formid"], "SN"=>$_POST["SN"], "SD"=>$_POST["SD"]));

            $_SESSION['success'] = "Course info updated successfully";
            header("location: courses");
        }
    }
}



}else{
    header("location: dashboard");
}
}else{
    header("location: ../login");
}
?>