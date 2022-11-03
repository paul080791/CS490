<?php
define('MAGICNUMBER', true);
include 'restrict.php';
?>
<?php

$name = $_REQUEST['name'];
$i = 1;
//echo $name;
$test = array(
    'exam_name' => $name
);

$test1 = json_encode($test);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/Back/getTest.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
curl_close($ch);


if (isset($_POST['submit'])) {
    $student = 6;
    $data = array();
    foreach ((array) $resp as $item) {
        $p = 'Answer' . $item['question_id'];
        //echo $p ;
        $a = 'question_id';
        $qid = $item[$a];
        //echo $qid . "jajaja";
        $answ = $_POST[$p];
        $_translated_text = nl2br($answ);
        //echo  $_translated_text;
        $sp=array(' ',"\n");
        $nl=array('[sp]','[nl]');
        $newtex=str_replace($sp,$nl,$_translated_text);
        //echo $newtex;
        $arr = array(
            'question_id' => $qid,
            'answer' => $answ,
            'user_id' => $student,
            'exam_name' => $name,
        );
        $data[] =  $arr;
    }
    //print_r( $data);
    $data = json_encode($data);
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_InsertAnswer.php');
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
        <h2> Welcome Student</h2>
    </header>
    <nav id="nav_menu">
        <ul>
            <li><a href="student.php">Home</a></li>
            <li><a href="viewExam.php">View Exams</a></li>
            <li><a href="studentgrades.php">Grades</a></li>
            <li><a href="logout.php">Log Out</a></li>
            </li>
        </ul>
    </nav>
        <main>
            <form class="anwer" method="post" id="answer1">

                <h2>Exam: <?php echo $name ?></h2>
                <?php foreach ((array) $resp as $item) : ?>
                    <div class="question">

                        <p>Question <?php echo $i ?>
                            <br>
                            <? echo $item['question']; ?>
                            <br>
                            <label for="anwers">Answer:</label>
                            <br>
                            <textarea style="white-space:pre" id='userAnswer' rows="15" cols="51" name='Answer<? echo $item['question_id'] ?>'></textarea>
                            <br>
                        </p>
                    <?php $i = $i + 1;
                endforeach; ?>
                    <button type="submit" name="submit" value="submit">submit</button>

            </form>
            </div>

        </main> 
</body>

</html>