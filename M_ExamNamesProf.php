<?php
// need student id
// get the names of exams and students for professor page where visibily =false 


$question_data = file_get_contents('php://input');
//$question_data =array('exam_name'=>"sampleExam");
$url="https://afsaccess4.njit.edu/~ct32/CS490/getExamProf.php";
$data = json_encode($question_data);


    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $question_data);
    $response = curl_exec($ch);
    $resp = json_decode($response);
    curl_close($ch);
    //return $r_decoded;
    
 echo $response  ;







?>