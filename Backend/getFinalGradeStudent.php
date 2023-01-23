<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string


    // gets the final grade and professor's comment for student to view 

$exam_name=$decoder['exam_name'];
$student_id=$decoder['student_id'];
/*    
$exam_name=$decoder['exam_name'];
$student_id=$decoder['student_id'];
*/


$sql="SELECT final_grade FROM FinalGrade WHERE exam_name='$exam_name' AND student_id ='$student_id' AND visibility=1"; 
$result = $conn->query($sql);
    $arr= array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
                      $arr[] = array(
                        'final_grade' => $row['final_grade'],
                       // 'comment'=>$row['comment'],
                        //'exam_name' => $row['exam_name'],                        
                      );}
} else {
      echo "no results";
}
   // print_r($arr);
 echo json_encode($arr, true);

  mysqli_close($conn);