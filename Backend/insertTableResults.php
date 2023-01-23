<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
   $decoder = json_decode($response,true); 

//inserting results
/*
    $decoder=array(
        array(
        'student_id'=> '6',
        'exam_name'=>'Paul5',
        'question_id'=> '1',
        'answer'=>'sample answer1',
        'function_name'=>'not_string',
        'points_func'=>'10',
        'constraints'=>'none',
        'points_constraint'=>'',
        'constraints'=>'none',
        array(
            'cases'=> '
        )
        'case1'=>'not_string("candy")',
        'points1'=>'40',
        'case2'=>'not_string("not bad")',
        'points2'=>'40',
        'worth_case'
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
  if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}


//echo (count($cases));
//$pointsArr=$decoder[$i]['points'];
print_r($decoder);

for($i=0; $i < count($decoder); $i++){
    $student_id= (int)$decoder[$i]['student_id'];
    $exam_name=$decoder[$i]['exam_name'];
    $question_id= (int)$decoder[$i]['question_id'];
    $answer=$decoder[$i]['answer'];
    $function_name=$decoder[$i]['function_name'];
    $points_func=(float)$decoder[$i]['points_func'];
    $worth_func=(float)$decoder[$i]['worth_func'];
    $constraints=$decoder[$i]['constraints'];
    $points_const=(float)$decoder[$i]['points_const'];
    $worth_const=(float)$decoder[$i]['worth_const'];
    $cases=$decoder[$i]['cases'];
    $pointsArr=$decoder[$i]['points'];
  
    for($j=1; $j<=5;$j++){
        ${'case'.$j} ='';
        ${'points'.$j}=0;
    }
    if(count($cases)>1){
        
        for($j=1; $j<=count($cases); $j++){
            ${'case'.$j} =$cases[$j-1];
            ${'points'.$j} =(float)$pointsArr[$j-1];
            echo $points3;
        }
    }
    $worth_case=(float)$decoder[$i]['worth_case'];
    $total_worth=(float)$decoder[$i]['total_worth'];
    $total_points=(float)$decoder[$i]['total_points'];
    $comment=$decoder['comment'];
  
   $sql="INSERT INTO ResultsTable(student_id, exam_name, question_id, answer, function_name, points_func, worth_func, constraints, points_const, worth_const , case1, points1, case2, points2, case3, points3, case4, points4, case5, points5, worth_case, total_worth, total_points , comment) VALUES ($student_id, '$exam_name',  $question_id ,'$answer', '$function_name', $points_func, $worth_func , '$constraints', $points_const, $worth_const , '$case1', $points1, '$case2', $points2, '$case3', $points3, '$case4', $points4, '$case5', $points5, $worth_case, $total_worth , $total_points, '$comment')";
    $result=$conn->query($sql);
}
//    echo $result->num_rows;

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