<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
    $decoder = json_decode($response,true); 
// gets exam that have not been edited by professor
//$student_id=6;

//$student_id=$decoder['student_id'];

$sql="SELECT DISTINCT exam_name FROM StudentAnswers WHERE is_active=true";


$result= $conn->query($sql); 
   $arr= array();

   
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
          $arr[]= array(
               'exam_name'=> $row['exam_name'],
               'student_id'=>$row['student_id']
          );
      }    
   } else{
      echo "no result";
   }

    //print_r($arr);
  echo json_encode($arr, true);

  mysqli_close($conn);