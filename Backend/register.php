<?php

//include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
$dbServername= "sql1.njit.edu";
$dbUsername = "ct32";
$dbPassword="Fallsemester0615!";
$dbName= "ct32";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$password='hello123';
$hash = password_hash($password, PASSWORD_BCRYPT);
//$db = getDB();password





$sql ="
INSERT INTO users (`ucid`,`password` ) VALUES('John', '$hash');";

$sql ="
INSERT INTO users (`ucid`,`password` ) VALUES('Sam', '$hash');";
//mysql_query($sql);
//try {
  //  $stmt->execute([":email" => $email, ":password" => $hash]);
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  

  mysqli_close($conn);

?>