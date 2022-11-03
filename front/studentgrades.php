<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';
?>
<?php
    $data = array(
    'student_id' => 6,
    );

    $data = json_encode($data);
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetExamNameTRUE.php');
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data); //sent the json
    $response1 = curl_exec($ch1); // get the response
    $resp1 = json_decode($response1, true);
    //echo $resp1;
	//print_r($resp1);
    //decode the json response from middle
    curl_close($ch1);
    //echo $resp;
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
</body>
<div id="gradesExam">
<style>
    table,
    th,
    td,tbody {
      border: 1px solid black;
      background-color: white;
      width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    h2 {
      text-align: center;
    }
  </style>
  <h2 style="text-align:center;">Grades</h2>
  <div class="container">
    <div class="row my-3">
      <div class="my-3">
        <table class="table" id="list-questions">
          <thead>
            <tr>
              <th scope="col">Test Name</th>
			  <th scope="col">Score</th>
			  <th scope="col">Review</th>
            </tr>
          </thead>
          <tbody>
		  <?php foreach ((array) $resp1 as $item) : ?>
					<tr>
						<td> <?php echo $item['exam_name']; ?> </td>
						<td> <?php echo $item['question']; ?> </td>
						<td><a href="viewGrade.php?name=<?php echo $item['exam_name']; ?>"><button>Review</button></a></td>
					</tr>
				<?php endforeach; ?>
		  </tbody>
        </table>
      </div>
    </div>

</div>
</html>

<script>
 /*
 const tabla = document.querySelector('#list-questions tbody');

  function getQuestions() {
    fetch('https://afsaccess4.njit.edu/~ct32/CS490/getExamNames.php')
      .then(response => response.json())
      .then(qst => {
        qst.forEach(qst => {
          const row = document.createElement('tr');
          row.innerHTML += `
          <td>${qst.exam_name}</td>
		  <td>${qst.exam_name}</td>
		  <td><a href="viewGrade.php?name=${qst.exam_name}"><button>Review</button></a></td>
                `;
          tabla.appendChild(row);
        });
      }) // here we show the information
      .catch(error => console.log('error : ' + error.message))
  }
  getQuestions();
*/
</script>