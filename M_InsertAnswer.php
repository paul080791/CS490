<?php
$display = file_get_contents('php://input');
//echo $display;
$t=json_decode($display);
$data=json_encode($t);
$url = 'https://afsaccess4.njit.edu/~ct32/CS490/insertAnswers.php';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $resp = json_decode($response, true);
    curl_close($ch);

$resp_encoded = json_encode($resp, true); 
//echo "holaaaaaaa";
echo $resp_encoded; # echo back to front
?>