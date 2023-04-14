<?php

$question_data = file_get_contents('php://input');
//echo $question_data;
//$question_data =array('exam_name'=>"TestPy3",
  //                    'student_id'=>6  );
//echo "ksksk";
$url="https://afsaccess4.njit.edu/~ct32/CS490/updateResults.php";
$data = json_encode($question_data);


    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    $resp = json_decode($response);
    curl_close($ch);
    //return $r_decoded;
    
    $resp_encoded = json_encode($resp, true); # encode the response from sunny
    //echo "holaaaaaaa";
    echo $resp_encoded; # echo back to front


?>