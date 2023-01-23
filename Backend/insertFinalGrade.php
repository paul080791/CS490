<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
   $decoder = json_decode($response,true); 

   if ($conn->connect_error)
   {
   die("Connection failed: " . $conn->connect_error);
   }
   $student_id=$decoder['student_id'];
   $exam_name=$decoder['exam_name'];
   $final_grade=$decoder['final_grade'];
   $comment=$decoder['comment'];

   $sql="INSERT INTO FinalGrade(student_id, exam_name, final_grade, comment ) VALUES ($student_id, '$exam_name', $final_grade , '$comment')";
   $result=$conn->query($sql);

   echo $result->num_rows;

   if ($result) {
       $arr = array(
                       "Response" => "ok"
       );
       echo json_encode($arr, true);
} else {
       $arr = array(
                       "Response" => "not"
       );
      echo json_encode($arr, true);


}


   mysqli_close($conn);