<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
    $decoder = json_decode($response,true); 

    //to delete a question from an exam


$exam_name=$decoder['exam_name'];
$question_id=$decoder['question_id'];

echo $question_id;
echo $exam_name;
$sql ="DELETE FROM CreateExam WHERE exam_name='$exam_name' AND question_id=$question_id"; 
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