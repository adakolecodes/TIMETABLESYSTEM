<?php
session_start();

if(isset($_SESSION['granted'])){
if((isset($_POST['addteacher'])) or (isset($_POST['updateteacher']))){
    
require("dbconn2.php");
include 'connection.php';

$formid = trim($_POST['formid']);
$arcid = trim($_POST['formarcid']);

$sql = "SELECT * FROM teachers WHERE name=:TN and faculty_number=:TF";
$pds = $pdo->prepare($sql);
$pds->execute(array("TN"=>$_POST["TN"], "TF"=>$_POST["TF"]));
$record = $pds->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM teachers WHERE name=:TN and faculty_number=:TF and alias=:AL and designation=:TD and contact_number=:TP and emailid=:TE";
$pds = $pdo->prepare($sql);
$pds->execute(array("TN"=>$_POST["TN"], "TF"=>$_POST["TF"], "AL"=>$_POST["AL"], "TD"=>$_POST["TD"], "TP"=>$_POST["TP"], "TE"=>$_POST["TE"]));
$record2 = $pds->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['addteacher'])){
if (isset($_POST['TN']) && isset($_POST['TF']) && isset($_POST['TE']) && isset($_POST['TD']) && isset($_POST['AL']) && isset($_POST['TP'])) {
    $name = $_POST['TN'];
    $facno = $_POST['TF'];
    $designation = $_POST['TD'];
    $alias = $_POST['AL'];
    $contact = $_POST['TP'];
    $email = $_POST['TE'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $_SESSION['error'] = "Error";
    header("location: add-teachers");
    die();
}

if($record){
    $_SESSION['error'] = "This teacher has been added already";
    header("location: add-teachers");
}else{

$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO teachers VALUES ('$facno','$name','$alias','$designation','$contact','$email')");
$sql = "CREATE TABLE " . $facno . " (
day VARCHAR(10) PRIMARY KEY, 
period1 VARCHAR(30),
period2 VARCHAR(30),
period3 VARCHAR(30),
period4 VARCHAR(30),
period5 VARCHAR(30),
period6 VARCHAR(30)
)";
mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $sql);
$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
for ($i = 0; $i < 6; $i++) {
    $day = $days[$i];
    $sql = "INSERT into " . $facno . " VALUES('$day','','','','','','')";
    mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $sql);
}
if ($q) {
    $_SESSION['success'] = "Teacher added successfully!";
    header("location: add-teachers");
} else {
    $_SESSION['error'] = "Id exists already";
    header("location: add-teachers");
    // header("Location:index.php");

}
}
}


if(isset($_POST['updateteacher'])){
    if($formid != $arcid){
        $_SESSION['error'] = "Error!";
        header("location: teachers");
    }else{
        if($record2){
            $_SESSION['notice'] = "No changes made";
            header("location: teachers");
        }else{
            $sql = "UPDATE teachers SET name=:TN, alias=:AL, designation=:TD, contact_number=:TP, emailid=:TE WHERE faculty_number = :formid";
            $pds = $pdo->prepare($sql);
            $pds->execute(array("formid"=>$_POST["formid"], "TN"=>$_POST["TN"], "AL"=>$_POST["AL"], "TD"=>$_POST["TD"], "TP"=>$_POST["TP"], "TE"=>$_POST["TE"]));

            $_SESSION['success'] = "Teacher info updated successfully";
            header("location: teachers");
        }
    }
}



}else{
    header("location: dashboard");
}
}else{
    header("location: login");
}
?>












<?php

// if(isset($_POST['updatecourse'])){
//     if($coursecode == "" or $coursetitle == "" or $units == "" or $coursestatus == "" or $courselevel == "" or $semester == ""){
//         $_SESSION['error'] = "Fields required";
//         header("location: courses");
//     }else if($formid != $arcid){
//         $_SESSION['error'] = "Error!";
//         header("location: courses");
//     }else{
//         if($record2){
//             $_SESSION['notice'] = "No changes made";
//             header("location: courses");
//         }else{
//             $sql = "UPDATE courses SET coursecode=:coursecode, coursetitle=:coursetitle, units=:units, coursestatus=:coursestatus, courselevel=:courselevel, semester=:semester WHERE id = :formid";
//             $pds = $pdo->prepare($sql);
//             $pds->execute(array("formid"=>$_POST["formid"], "coursecode"=>$_POST["coursecode"], "coursetitle"=>$_POST["coursetitle"], "units"=>$_POST["units"], "coursestatus"=>$_POST["coursestatus"], "courselevel"=>$_POST["courselevel"], "semester"=>$_POST["semester"]));

//             $_SESSION['success'] = "Course updated successfully";
//             header("location: courses");
//         }
//     }
// }

?>