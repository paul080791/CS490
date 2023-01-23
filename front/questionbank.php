<?php
define('MAGICNUMBER', true);
include 'restrict.php';
?>
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_showQuestions.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $test); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
curl_close($ch);
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
</body>
<style>
	table,
	th {
		border: 1px solid #c21212;
		border-collapse: collapse;
		background-color: #FF9999;
		text-align: center;
		margin-left: auto;
		margin-right: auto;

	}

	th {
		background-color: #c21212;
		color: white;
	}

	td {
		border: 1px solid #c21212;
		text-align: center;
		border-collapse: collapse;

	}

	tr:nth-child(even) {
		background-color: #FFCCCC;
	}
</style>
<main>
	<div class="container">
		<h1 style="text-align:center;">Questions</h1>
		<table class="table table-bordered" width="800">
			<tr>
				<th width="10%">Question id</th>
				<th width="40%">Question</th>
				<th width="20%">Difficulty</th>
				<th width="20%">Category</th>
			</tr>
			<tbody>
				<?php foreach ((array) $resp as $item) : ?>
					<tr>
						<td> <?php echo $item['id']; ?> </td>
						<td> <?php echo $item['question']; ?> </td>
						<td> <?php echo $item['difficulty']; ?> </td>
						<td> <?php echo $item['category']; ?> </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</main>

</html>
<?php
/*
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
	table,
	th,
	td {
		border: 1px solid black;
		background-color: white;
		text-align: center;
		width: 600px;
		margin-left: auto;
		margin-right: auto;

	}
</style>*/
?>