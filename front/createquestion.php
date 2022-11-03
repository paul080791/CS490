<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';
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
			<li><a href="createquestion.php">Add Question</a></li>
			<li><a href="questionbank.php">Question Bank</a></li>
			<li><a href="reviewexam.php">Review Exam</a></li>
			<li><a href="logout.php">Log Out</a></li>
			</li>
		</ul>
	</nav>
	<main>
		<form class="create_exam" method="post">
        <h2>Create a Question</h2>
			<ul>
				<li>
					<label for="question">Question:</label>
					<input type="text" id="question" name="question" />
				</li>
				<li>
					<label for="function">Function name:</label>
					<input type="text" id="function" name="function" />
				</li>
				<li>
					<label for="difficulty">Difficulty:</label>
					<select id="difficulty" name="difficulty">
						<option value="easy">Easy</option>
						<option value="mediun">Medium</option>
						<option value="hard">Hard</option>
					</select>
				</li>
				<li>
					<label for="category">Topic:</label>
					<select id="category" name="category">
						<option value="Arrays">Arrays</option>
						<option value="Condition">Condition</option>
						<option value="Loops">Loops</option>
						<option value="Strings">Strings</option>
					</select>
				<li>
					<label for="parameters">Function Parameters:</label>
					<input type="text" id="parameters" name="parameters" />
				</li>
				<li>
					<label for="case">Test Cases:</label>
                    <br>
					<input type="text" id="test_case1" name="test_case1" />
					<input type="text" id="output1" name="output1" />
					<br>
					<input type="text" id="test_case2" name="test_case2" />
					<input type="text" id="output2" name="output2" />
				</li>
                <button type="submit" name="submit" value="submit">Create</button>

			</ul>
		</form>
	</main>
</body>

</html>

<?php
if(isset($_POST['submit'])){
	//echo "<script> window.location.href='questionbank.php';</script>";	
	}

$question = $_POST['question'];
$function = $_POST['function'];
$parameters = $_POST['parameters'];
$difficulty = $_POST['difficulty'];
$category = $_POST['category'];
$test_case1 = $_POST['test_case1'];
$output1 = $_POST['output1'];
$test_case2 = $_POST['test_case2'];
$output2 = $_POST['output2'];



//Save data into an array and send it to the middle using json_encode
$test = array(
'question' => $question,
'function' => $function,
'parameters'=>$parameters,
'difficulty' => $difficulty,
'category' => $category,
'test_case1' => $test_case1,
'output1' => $output1,
'test_case2' => $test_case2,
'output2' => $output2,
);
//echo $test;
$test = json_encode($test);
// initialize a curl session to send the json using post method
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,'https://afsaccess4.njit.edu/~psg4/CS490/Middle/M_InsertQ_1.php');
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));//type of data front is sending to middle
curl_setopt($ch,CURLOPT_POSTFIELDS, $test);//sent the json
$response=curl_exec($ch);// get the response
$resp = json_decode($response);//decode the json response from middle
//echo $test;
curl_close($ch);
//echo $response;

?>