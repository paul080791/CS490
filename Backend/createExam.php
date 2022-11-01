<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string


/*
$decoder = array("exam_name"=> "exam2",
    array("question_id"=> "1",
         "points"=>"40"),
    array("question_id"=> "2",
           "points"=>"20" ),
    array("question_id"=> "118",
         "points"=> "40")
            
);
*/

//print_r($decoder);
//echo "<br/>";

//add question 
$exam_name= $decoder["exam_name"]; 
$question_id=$decoder["question_id"];
$points=$decoder["points"];
//$counter=count($decoder)-1;

$sql = "INSERT INTO CreateExam (exam_name, question_id, points) VALUES('$exam_name',$question_id,$points)";

$result=$conn->query($sql);


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