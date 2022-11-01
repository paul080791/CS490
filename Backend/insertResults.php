<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
   $decoder = json_decode($response,true); 

//inserting results

/*
    $decoder=array(
        array(
        'student_id'=> '6',
        'exam_name'=>'sampleExam3',
        'question_id'=> '1',
        'answer'=>'sample answer1',
        'points_obtained'=>'50',
        'comment'=>'wrong parameters',
        'system_comments'=>'sys comment'
        
        ),
        array(
            'student_id'=> '6',
            'exam_name'=>'sampleExam3',
            'question_id'=> '2',
            'answer'=>'sample answer2',
            'points_obtained'=>'50',
            'comment'=>'wrong function name',
            'system_comments'=>'sys comment2'
            )
    );
 */
  //print_r($decoder);
  if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}

for($i=0; $i< count($decoder); $i++){
    $student_id= (int)$decoder[$i]['student_id'];
    $exam_name=$decoder[$i]['exam_name'];
    $question_id= (int)$decoder[$i]['question_id'];
    $answer=$decoder[$i]['answer'];
    $points_obtained=(int)$decoder[$i]['points_obtained'];
    $comment=$decoder[$i]['comment'];
    $system_comments=$decoder[$i]['system_comments'];
  //  $comment=$decoder[$i]['comment'];
  
    $sql="INSERT INTO Results(student_id, exam_name, question_id, answer, points_obtained, comment, system_comments) VALUES ($student_id, '$exam_name',  $question_id ,'$answer', $points_obtained, '$comment', '$system_comments')";
    $result=$conn->query($sql);
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