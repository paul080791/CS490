<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
    $decoder = json_decode($response,true); 

    //inserting questions in table 

    $question=$decoder['question'];
    $difficulty=$decoder['difficulty'];
    $category=$decoder['category'];
    $constraints=$decoder['constraints'];
    $function_name=$decoder['function_name'];
    $test_case1=$decoder['test_case1'];
    $output1=$decoder['output1'];
    $test_case2=$decoder['test_case2'];
    $output2=$decoder['output2'];
    $test_case3=$decoder['test_case3'];
    $output3=$decoder['output3'];
    $test_case4=$decoder['test_case4'];
    $output4=$decoder['output4'];
    $test_case5=$decoder['test_case5'];
    $output5=$decoder['output5'];
    $count_cases=(int)$decoder['count_cases'];



  if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}
  $sql="INSERT INTO Questions(question, difficulty, category, constraints, function_name, test_case1, output1, test_case2, output2, test_case3, output3, test_case4, output4, test_case5, output5, count_cases) VALUES('$question', '$difficulty','$category', '$constraints', '$function_name', '$test_case1', '$output1', '$test_case2', '$output2', '$test_case3', '$output3', '$test_case4', '$output4', '$test_case5', '$output5', $count_cases)";

 // $sql="INSERT INTO Questions(question, difficulty, category, constraints, test_case1, output1, test_case2, output2, test_case3, output3, test_case4, output4, test_case5, output5) VALUES ('$question', '$difficulty', '$category' ,'$constraints','$test_case1', '$output1', '$test_case2', '$output2', '$test_case3', '$output3, '$test_case4', '$output4, '$test_case5', '$output5)";
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