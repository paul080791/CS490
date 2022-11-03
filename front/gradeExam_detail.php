<?php
define('MAGICNUMBER', true);
include 'restrict.php';
?>
<?php

$name = $_REQUEST['name'];
$i = 1;

$test = array(
    'exam_name' => $name
);
    
$test1 = json_encode($test);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/Student/test.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
echo $resp;
curl_close($ch);

if (isset($_POST['submit'])) {
    $student = 6;
    $data = array();
    foreach ((array) $resp as $item) {
        $p = 'comment' . $item['question_id'];
        $g = 'points_obtained' . $item['question_id'];
        $a = 'question_id';
        $qid = $item[$a];
        $comment1 = $_POST[$p];
        $grade=$_POST[$g];
        $arr = array(
            'question_id' => $qid,
            'comment' => $comment1,
            'user_id' => $student,
            'exam_name' => $name,
            'points_obtained'=>$grade,
        );
        $data[] =  $arr;
    }

print_r( $data);
$data = json_encode($data);
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/updateResults.php');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data); //sent the json
$response1 = curl_exec($ch1); // get the response
$resp1 = json_decode($response1, true);
print_r($resp1);
//decode the json response from middle
curl_close($ch1);
//echo $resp;

}

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
        <form class="anwer" method="post" id="answer1">
            <h2>Exam: <?php echo $name ?></h2>
                <?php foreach ((array) $resp as $item) : ?>
                    <div class="question">
                    <p>Question: <?php echo $i ?>
                        <br>
                        <? echo $item['question']; ?>
                        <br>
                    <p>Grade:</p><input type="number" name="points_obtained<? echo $item['question_id'] ?>" value="<? echo $item['points_obtained']; ?>">
                    <br>
                    <br>
                    <label for="anwers">Answer:</label>
                    <br>
                    <textarea disabled rows="15" cols="51" ><? echo $item['answer']; ?></textarea>
                    <br>
                    </p>
                    <p>System Comments: </p>
                    <textarea disabled rows="15" cols="51" ><? echo $item['system_comments']; ?></textarea>
                    <p>Professor Comments: </p>
                    <textarea rows="15" cols="51" name="comment<? echo $item['question_id'] ?>"></textarea>
                <?php $i = $i + 1;
            endforeach; ?>
                <button type="submit" name="submit" value="submit">Release Grade</button>
        </form>

    </main>
</body>
</html>