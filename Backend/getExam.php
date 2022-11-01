<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string
    

    //check if you need to get the names of the exam to get a response back'
   $exam_name =$decoder["exam_name"];
   

  // $exam_name="Caterine2";
  // echo $exam_name;
   //$exam_name="exam2";
   /*
    $sql="SELECT question_id, points FROM CreateExam WHERE exam_name='$exam_name'";
*/
$sql="SELECT CreateExam.question_id, CreateExam.points, Questions.question FROM CreateExam Join Questions ON Questions.id=CreateExam.question_id  WHERE CreateExam.exam_name='$exam_name'" ; 

$result= $conn->query($sql); 
   $arr= array();
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
          $arr[]= array(
                 // 'id'=> $row['id'],
                  //'exam_name'=> $row['exam_name'],
                  'question_id'=> $row['question_id'],
                  'question'=>$row['question'],
                  'points'=> $row['points']
          );
      }    
   } else{
      echo "no result";
   }
  
  //print_r($arr);
  echo json_encode($arr, true);

  mysqli_close($conn);