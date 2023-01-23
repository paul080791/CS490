<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string


    /* DO NOT USE*/
    //$decoder = json_decode($response,true); //decodes JSON string

   // $exam_name=$decoder['exam_name'];
//$exam_name='Paul5';

   //gets student_id, exam name, question_id, answer and points , test cases and outputs from specific exam
//    $sql="SELECT StudentAnswers.student_id, StudentAnswers.exam_name, StudentAnswers.question_id, StudentAnswers.answer, CreateExam.points FROM StudentAnswers JOIN CreateExam ON CreateExam.question_id= StudentAnswers.question_id WHERE StudentAnswers.exam_name='$exam_name' AND CreateExam.exam_name='$exam_name'";
  
 //   echo $exam_name;
    $sql="SELECT StudentAnswers.student_id, StudentAnswers.exam_name, StudentAnswers.question_id, StudentAnswers.answer, CreateExam.points, Questions.test_case1, Questions.output1, Questions.test_case2, Questions.output2 FROM StudentAnswers JOIN CreateExam ON CreateExam.question_id= StudentAnswers.question_id JOIN Questions ON Questions.id=StudentAnswers.question_id WHERE StudentAnswers.exam_name='$exam_name' AND CreateExam.exam_name='$exam_name'";


    $result = $conn->query($sql);
        $arr= array();
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                          $arr[] = array(
                                          'student_id' => $row['student_id'],
                                          'exam_name' => $row['exam_name'],
                                          'question_id' => $row['question_id'],
                                          'answer'=>$row['answer'],
                                          'points' => $row['points'],
                                          'test_case1' =>$row['test_case1'],
                                           'output1'=> $row['output1'],
                                          'test_case2' =>$row['test_case2'],
                                          'output2'=> $row['output2']);
                                   }
    } else {
          echo "no results";
    }
    // print_r($arr);
 //    echo json_encode($arr, true);

    mysqli_close($conn);