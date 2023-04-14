<?php

$question_data = file_get_contents('php://input');
print_r ($question_data);
//$question_data =array('exam_name'=>"TestPy2",
  //                  'student_id'=>6  );
//print($question_data);
$url="https://afsaccess4.njit.edu/~ct32/CS490/getResults.php";
//$data = json_decode($question_data,true);

$data = json_encode($question_data);

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    $resp = json_decode($response,true);
    curl_close($ch);
    //return $r_decoded;
    
    $resp_encoded = json_encode($resp); # encode the response from sunny
    //echo "holaaaaaaa";
    //echo $resp_encoded; # echo back to front



    $score=0;
   // echo count($resp);
    for ( $i=0; $i<count($resp);$i++)
    {
        $score=$score + intval($resp[$i]['points_obtained']);
    }
    $data1=array(
        'score'=> $score
    );
    echo json_encode($data1);



?>