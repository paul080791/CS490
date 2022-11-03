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
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetGradedTest.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
curl_close($ch);
print_r($resp);

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
		</ul>
	</nav>
    <main>
        <form class="anwer" method="post" action="student.php" id="answer1">

            <h2>Exam: <?php echo $name ?></h2>
            <?php foreach ((array) $resp as $item) : ?>
                <div class="question">
                    <p>Question: <?php echo $i ?>
                        <br>
                        <? echo $item['question']; ?>
                        <br>
                    <p>Grade: <input type="number" disabled value="<? echo $item['points_obtained']; ?>"> </p>
                    <label for="anwers">Answer:</label>
                    <br>
                    <textarea disabled rows="15" cols="51"><? echo $item['answer']; ?></textarea>
                    <br>
                    </p>
                    <p>System Comments: </p>
                    <textarea disabled rows="15" cols="51"><? echo $item['system_comments']; ?></textarea>
                    <p>Professor Comments: </p>
                    <textarea disabled rows="15" cols="51"><? echo $item['comment']; ?></textarea>
                <?php $i = $i + 1;
            endforeach; ?>
                <button type="submit" name="submit" value="submit">Exit</button>

        </form>
        </div>

    </main>
</body>

</html>
