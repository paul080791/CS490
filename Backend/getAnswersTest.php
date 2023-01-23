<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    header("Content-Type:application/json");

    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string

   $exam_name=$decoder['exam_name'];

  //echo $exam_name;
 //$exam_name='Paul1';

   //gets student_id, exam name, question_id, answer and points , test cases and outputs from specific exam
//    $sql="SELECT StudentAnswers.student_id, StudentAnswers.exam_name, StudentAnswers.question_id, StudentAnswers.answer, CreateExam.points FROM StudentAnswers JOIN CreateExam ON CreateExam.question_id= StudentAnswers.question_id WHERE StudentAnswers.exam_name='$exam_name' AND CreateExam.exam_name='$exam_name'";
  
    //echo $exam_name;
    $sql="SELECT StudentAnswers.student_id, StudentAnswers.exam_name, StudentAnswers.question_id, StudentAnswers.answer, CreateExam.points, Questions.constraints, Questions.function_name, Questions.test_case1, Questions.output1, Questions.test_case2, Questions.output2, Questions.test_case3, Questions.output3, Questions.test_case4, Questions.output4, Questions.test_case5, Questions.output5, Questions.count_cases FROM StudentAnswers JOIN CreateExam ON CreateExam.question_id= StudentAnswers.question_id JOIN Questions ON Questions.id=StudentAnswers.question_id WHERE StudentAnswers.exam_name='$exam_name' AND CreateExam.exam_name='$exam_name'";


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
                                          'constraints'=>$row['constraints'],
                                          'function_name'=>$row['function_name'],
                                          'test_case1' =>$row['test_case1'],
                                           'output1'=> $row['output1'],
                                          'test_case2' =>$row['test_case2'],
                                          'output2'=> $row['output2'],
                                          'test_case3' =>$row['test_case3'],
                                          'output3'=> $row['output3'],
                                          'test_case4' =>$row['test_case4'],
                                          'output4'=> $row['output4'],
                                          'test_case5' =>$row['test_case5'],
                                          'output5'=> $row['output5'],
                                          'count_cases'=>$row['count_cases']
                                        );
                                   }
    } else {
          echo "no results";
    }
    // print_r($arr);
    echo json_encode($arr, true);

    mysqli_close($conn);