<?php

$display = file_get_contents('php://input');
//print_r($display);
//$t=json_decode($display);
//$test=json_encode($t);
//print_r($test);
/*
$name="Paul1";

$test= array(
    'exam_name'=> $name
);
$test=json_encode($test);
*/

$url = 'https://afsaccess4.njit.edu/~ct32/CS490/getExam.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch, CURLOPT_POSTFIELDS, $display);
    $response = curl_exec($ch);
    $resp = json_decode($response, true);
    curl_close($ch);
    //print_r($resp);
    //print_r($resp);

   // foreach ($resp as $data)
     //   echo $data['id'] . ' ';
        
    
     //print_r ($response);
//print_r($response);    
$resp_encoded = json_encode($resp, true); 
//echo "holaaaaaaa";
echo $resp_encoded; # echo back to front


?>