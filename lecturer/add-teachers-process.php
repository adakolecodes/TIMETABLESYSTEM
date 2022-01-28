<?php
session_start();

if(isset($_SESSION['lecturer'])){
if((isset($_POST['updateteacher']))){
    
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


if(isset($_POST['updateteacher'])){
    if($formid != $arcid){
        $_SESSION['error'] = "Error!";
        header("location: profile");
    }else{
        if($record2){
            $_SESSION['notice'] = "No changes made";
            header("location: profile");
        }else{
            $sql = "UPDATE teachers SET name=:TN, alias=:AL, designation=:TD, contact_number=:TP, emailid=:TE WHERE faculty_number = :formid";
            $pds = $pdo->prepare($sql);
            $pds->execute(array("formid"=>$_POST["formid"], "TN"=>$_POST["TN"], "AL"=>$_POST["AL"], "TD"=>$_POST["TD"], "TP"=>$_POST["TP"], "TE"=>$_POST["TE"]));

            $_SESSION['success'] = "Profile updated successfully";
            header("location: profile");
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