<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';
    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string

   
        $student_id=$decoder['student_id'];
        $exam_name=$decoder['exam_name'];
        $final_grade=(int)$decoder['final_grade'];
        //$comment=$decoder['comment'];
      //  $visibility=(int)$decoder[$i]['visibility'];

        $sql = "UPDATE FinalGrade SET final_grade= $final_grade, visibility=true WHERE exam_name='$exam_name' AND student_id=$student_id";
        
        $result = $conn->query($sql);
   



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