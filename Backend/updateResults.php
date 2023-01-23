<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string
 /*
    $decoder=array(
        array(
        'student_id'=> '6',
        'exam_name'=>'sampleExam2',
        'question_id'=> '1',
        'answer'=>'sample answer1',
        'points_obtained'=>'30',
        'comment'=>'updated comments 1 '
        
        ),
        array(
            'student_id'=> '6',
            'exam_name'=>'sampleExam2',
            'question_id'=> '2',
            'answer'=>'sample answer2',
            'points_obtained'=>'60',
            'comment'=>'updated comment 2'
            )
    );
 */
 //print_r($decoder);
  
        $exam_name=$decoder['exam_name'];
        $question_id=(int)$decoder['question_id'];
        $points_func=(float)$decoder['points_func'];
        $points_const=(float)$decoder['points_const'];
        $points1=(float)$decoder['points1'];
        $points2=(float)$decoder['points2'];
        $points3=(float)$decoder['points3'];
        $points4=(float)$decoder['points4'];
        $points5=(float)$decoder['points5'];
        $total_points=(float)$decoder['total_points'];
        $comment=$decoder['comment'];




      //  $visibility=(int)$decoder[$i]['visibility'];

        $sql = "UPDATE ResultsTable SET points_func=$points_func, points_const=$points_const, points1=$points1, points2=$points2, points3=$points3, points4=$points4, points5=$points5, total_points=$total_points, comment='$comment' WHERE exam_name='$exam_name' AND question_id=$question_id";

        $result = $conn->query($sql);
       // echo $sql;


  



 //echo $result->num_rows;

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