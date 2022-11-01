<?php
   include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); 
    $decoder = json_decode($response,true); 



  if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}
    //inserting answers in table 

/*
    $decoder=array(
        array(
        'question_id'=> '1',
        'answer'=> 'func answer1',
        'user_id'=>'6',
        'exam_name'=>'Paul2'
        ),
        array(
            'question_id'=> '2',
            'answer'=> 'func answer2',
            'user_id'=>'6',
            'exam_name'=>'Paul2'
        )
    );

  */    
  //print_r($decoder);

 
  for($i=0; $i< count($decoder); $i++){
    $question_id= (int)$decoder[$i]['question_id'];
    $answer=$decoder[$i]['answer'];
    $user_id=(int)$decoder[$i]['user_id'];
    $exam_name=$decoder[$i]['exam_name'];
    $sql="INSERT INTO StudentAnswers(student_id, exam_name, question_id, answer) VALUES($user_id,'$exam_name', $question_id, '$answer')";
    $result=$conn->query($sql);
  }
  

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