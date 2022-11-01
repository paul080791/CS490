<?php

$dbServer="sql1.njit.edu";
$dbUsername="ct32";
$dbPassword="Fallsemester0615!";
$dbName="DbProject";

$conn=mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
    if($conn->connect_errno !=0){
        echo $conn->connect_error;
        exit();
    }
?>