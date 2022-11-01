<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string


    // Gets exam when visibility is 0 only meaning before its graded
$exam_name=$decoder['exam_name'];
//$exam_name='porfavor';
//change visibility to 1
$sql="SELECT r.student_id, r.exam_name, r.question_id, q.question, r.answer, r.points_obtained , r.comment, r.system_comments  FROM Results r JOIN Questions q ON q.id=r.question_id WHERE r.exam_name='$exam_name' AND r.visibility=0";

$result = $conn->query($sql);
    $arr= array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
                      $arr[] = array(
                                      'student_id' => $row['student_id'],
                                      'question_id'=>$row['question_id'],
                                      //'exam_name' => $row['exam_name'],
                                      'question' => $row['question'],
                                      'answer'=>$row['answer'],
                                      'points_obtained' => $row['points_obtained'],
                                      'comment' =>$row['comment'],
                                      'system_comments'=>$row['system_comments']
                                      //'visibility'=>$row['visibility']);
                      );}
} else {
      echo "no results";
}
   // print_r($arr);
 echo json_encode($arr, true);

  mysqli_close($conn);