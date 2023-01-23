<?php

$dbServer="";
$dbUsername=" ";
$dbPassword="";
$dbName="DbProject";

$conn=mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
    if($conn->connect_errno !=0){
        echo $conn->connect_error;
        exit();
    }
?>