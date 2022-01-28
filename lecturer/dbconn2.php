<?php
/**
 * Created by PhpStorm.
 * User: DANIEL OMAJALI
 * Date: 10/6/19
 * Time: 6:06 AM
 */
$dbName = "ttms";
$user = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=$dbName";
$pdo = new PDO($dsn,$user,$password);

?>