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
    for ($i = 0; $i < count($decoder); $i++) {
        $exam_name=$decoder[$i]['exam_name'];
        $question_id=(int)$decoder[$i]['question_id'];
        $comment=$decoder[$i]['comment'];
        $points=(int)$decoder[$i]['points_obtained'];
      //  $visibility=(int)$decoder[$i]['visibility'];

        $sql = "UPDATE Results SET comment='$comment', points_obtained=$points, visibility=true WHERE exam_name='$exam_name' AND question_id=$question_id";
        
        $result = $conn->query($sql);
    }



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