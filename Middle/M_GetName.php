<?php

$test = array(
    'student_id' => 6,
    //'pw' => $pw,
);
//echo $test;
$test = json_encode($test);

// initialize a curl session to send the json using post method
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,'https://afsaccess4.njit.edu/~ct32/CS490/getNameProf.php');
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));//type of data front is sending to middle
curl_setopt($ch,CURLOPT_POSTFIELDS, $test);//sent the json
$response=curl_exec($ch);// get the response
$resp = json_decode($response,true);//decode the json response from middle
print_r($resp) ;
curl_close($ch);
?>

