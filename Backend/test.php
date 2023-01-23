<?php
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);
print_r($data);
//$display = file_get_contents('php://input');
//print_r($display);
echo "works!";


?>