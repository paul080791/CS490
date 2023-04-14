<?php
//$display = file_get_contents('php://input');
$id=$_REQUEST["Qid"];
$points=$_REQUEST["points"];
$name= $_REQUEST["examName"];
//echo $id ." - " . $points . " - ". $name;
$data = array(
  'question_id'=> $id,
  'exam_name'=> $name,
  'points'=> $points
);

$data=json_encode($data);
$url = 'https://afsaccess4.njit.edu/~ct32/CS490/createExam.php';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $resp = json_decode($response, true);
    curl_close($ch);

$resp_encoded = json_encode($resp, true); 
//echo "holaaaaaaa";
echo $resp_encoded; # echo back to front
?>