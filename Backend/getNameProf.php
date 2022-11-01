<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input');
    $decoder = json_decode($response,true); 
 

//send student name to prof
$student_id=$decoder['student_id'];
$sql="SELECT ucid FROM users where id=$student_id";

$result= $conn->query($sql); 
   $arr= array();
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
          $arr[]= array(
            'ucid'=> $row['ucid']
                  
          );
      }    
   } else{
      echo "no result";
   }
  

      //print_r($arr);
echo json_encode($arr, true);

  mysqli_close($conn);