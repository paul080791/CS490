<?php
$display = file_get_contents('php://input');
$display = json_decode($display);
print_r($display);
/*
$url = 'https://web.njit.edu/~sdp53/cs490/createTest.php';
$test = file_get_contents('php://input');
//$test_res
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $test);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $resp = json_decode($response, true);
    curl_close($ch);



$response_test = json_encode($resp, true); # encode the response from sunny
echo $response_test; # echo back to front
*/

?>