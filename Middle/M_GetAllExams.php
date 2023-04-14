<?php
//$display = file_get_contents('php://input');


$url = 'https://afsaccess4.njit.edu/~ct32/CS490/getExamNames.php';

    $ch = curl_init($url);
    //curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $display);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $resp = json_decode($response, true);
    curl_close($ch);

   // foreach ($resp as $data)
     //   echo $data['id'] . ' ';
        
    
//print_r($response);    
$resp_encoded = json_encode($resp, true); # encode the response from sunny
//echo "holaaaaaaa";
echo $resp_encoded; # echo back to front
?>
