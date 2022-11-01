<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
    $decoder = json_decode($response,true); 

    //inserting questions in table 

    $question=$decoder['question'];
    $difficulty=$decoder['difficulty'];
    $category=$decoder['category'];
    //$points=$decoder['points'];
    $test_case1=$decoder['test_case1'];
    $output1=$decoder['output1'];
    $test_case2=$decoder['test_case2'];
    $output2=$decoder['output2'];




  if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}


  $sql="INSERT INTO Questions(question, difficulty, category, test_case1, output1, test_case2, output2) VALUES ('$question', '$difficulty', '$category' ,'$test_case1', '$output1', '$test_case2', '$output2')";
   $result=$conn->query($sql);
   echo $result->num_rows;

    if ($result) {
        $arr = array(
                        "Response" => "ok"
        );
        echo json_encode($arr, true);
} else {
        $arr = array(
                        "Response" => "not"
        );
        echo json_encode($arr, true);


}

      mysqli_close($conn);