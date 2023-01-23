<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string


    // gets the results for student to view 
$exam_name=$decoder['exam_name'];
//$exam_name='Caterine';
//change visibility to 1
//$sql="SELECT r.student_id, r.exam_name, r.question_id, q.question, r.answer, r.constraints , r.case1, r.points1, r.case2, r.points2, r.case3, r.points3, r.case4, r.points4,, r.case5, r.points5, r.comment FROM ResultsTable r JOIN Questions q ON q.id=r.question_id WHERE r.exam_name='$exam_name' AND r.visibility=1";
$sql="SELECT r.student_id, r.exam_name, r.question_id, q.question, r.answer, r.function_name, r.points_func, r.worth_func, r.worth_const, r.constraints , r.points_const , r.case1, r.points1, r.case2, r.points2, r.case3, r.points3, r.case4, r.points4, r.case5, r.points5, r.worth_case, r.total_worth, r.comment, r.total_points  FROM ResultsTable r JOIN Questions q ON q.id=r.question_id WHERE r.exam_name='$exam_name' AND r.visibility=1";

$result = $conn->query($sql);
    $arr= array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
                      $arr[] = array(
                        'student_id' => $row['student_id'],
                        'question_id'=>$row['question_id'],
                        'question' => $row['question'],
                        'answer'=>$row['answer'],
                        'function_name' => $row['function_name'],
                        'points_func'=> $row['points_func'],
                        'worth_func'=> $row['worth_func'],
                        'worth_const'=> $row['worth_const'],
                        'constraints'=> $row['constraints'],
                        'points_const'=> $row['points_const'],
                        'case1' =>$row['case1'],
                        'points1'=>$row['points1'],
                        'case2' =>$row['case2'],
                        'points2'=>$row['points2'], 
                        'case3' =>$row['case3'],
                        'points3'=>$row['points3'],
                        'case4' =>$row['case4'],
                        'points4'=>$row['points4'],
                        'case5' =>$row['case5'],
                        'points5'=>$row['points5'],
                        'worth_case'=>$row['worth_case'],
                        'total_worth'=>$row['total_worth'],
                        'comment'=>$row['comment'],
                        'total_points'=>$row['total_points']
                      );}
} else {
      echo "no results";
}
   // print_r($arr);
 echo json_encode($arr, true);

  mysqli_close($conn);