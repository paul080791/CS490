<?php

// make if visibility ==1 then exam already graded!!!!
$name=$_REQUEST['name'];
//echo $name;
$test=array(
    'exam_name'=>$name,
    'student_id'=>6,
);
//$update=0;
$test1=json_encode($test);
print_r($test1);

$ch2 = curl_init($url_Grade);
curl_setopt($ch2, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_Grade.php');
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $test1); //sent the json
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
$response1 = curl_exec($ch2); // get the response
$resp = json_decode($response1, true); //decode the json response from middle
curl_close($ch2);
//print_r($resp);
echo $response1;

$url = 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetGradedTest.php';
    
    $ch3 = curl_init($url);
    curl_setopt($ch3, CURLOPT_POST, true);
    curl_setopt($ch3, CURLOPT_POSTFIELDS, $test1);
    curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($ch3);
    $resp1 = json_decode($response2, true);
    curl_close($ch3);
    print_r($resp1);
    //echo count($resp1);
    if (isset($_POST['submit'])) {
        $student = 6;
        //echo $student;
        $data = array();
        //print_r($resp1);
        foreach ((array) $resp1 as $item) {
            
            $p = 'comment' . $item['question_id'];
            //echo $p;
            $g = 'points_obtained' . $item['question_id'];
            $a = 'question_id';
            $qid = $item[$a];
            $comment1 = $_POST[$p];
           // echo $comment1;
            
            $grade=$_POST[$g];
            //echo $$_POST[$g];
            $arr = array(
                'question_id' => $qid,
                'comment' => $comment1,
                'user_id' => $student,
                'exam_name' => $name,
                'points_obtained'=>$grade,
            );
            $data[] =  $arr;
        }
    
    //print_r( $data);
    $data = json_encode($data);
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/updateResults.php');
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data); //sent the json
    $response1 = curl_exec($ch1); // get the response
    $resp2 = json_decode($response1, true);
    //print_r($resp2);
    //decode the json response from middle
    curl_close($ch1);
    //echo $resp;
    }
    

 /* 
    $url = 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetScore.php';
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $test1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $resp2 = json_decode($response, true);
    curl_close($ch);

    print_r($resp2);
    */

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Portal NJIT</title>
</head>

<body>

    <header>
        <h2> Welcome Professor</h2>
    </header>
    <nav id="nav_menu">
        <ul>
            <li><a href="teacher.php">Home</a></li>
            <li><a href="createxam.php">Create Exam</a></li>
            <li><a href="Exams.php">Exams</a></li>
            <li><a href="questionbank.php">Question Bank</a></li>
            <li><a href="createquestion.php">Add Question</a></li>
            <li><a href="reviewexam.php">Review Exam</a></li>
            <li><a href="logout.php">Log Out</a></li>
            </li>
        </ul>
    </nav>
    <main>
        <form class="anwer" name="submit1" method="POST"   id="answer1">
            <h2>Exam: <?php echo $name ?></h2>

                <?php foreach ((array) $resp1 as $item) : ?>
                    <div class="question">
                    <p>Question: <?php echo $i ?>
                        <br>
                        <?php echo $item['question']; ?>
                        <br>
                    <p>Grade:</p><input type="number" name="points_obtained<?php echo $item['question_id'] ?>" value="<?php echo $item['points_obtained']; ?>">
                    <br>
                    <br>
                    <label for="anwers">Answer:</label>
                    <br>
                    <textarea disabled rows="15" cols="51" ><?php echo $item['answer']; ?></textarea>
                    <br>
                    </p>
                    <p>System Comments: </p>
                    <textarea disabled rows="15" cols="51" ><?php echo $item['system_comments']; ?></textarea>
                    <p>Professor Comments: </p>
                    <textarea rows="15" cols="51" name="comment<?php echo $item['question_id'] ?>"> <?php echo $item['comment']; ?></textarea>
                   
                <?php $i = $i + 1;
            endforeach; ?>
                <button type="submit"   name="submit" value="submit" >Save  </button>
                <button onclick="Done()"  class="btn btn-primary" id="Save">Release!</button>
                <script>

                     function Done(){
                        
                        window.location.href="GradedExams.php";

                        }



                    </script>
        </form>

    </main>
</body>
</html>