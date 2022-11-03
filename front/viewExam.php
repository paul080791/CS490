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
<main>
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
  <h2 style="text-align:center;" >Take the folloging exam</h2>
  <div class="container">
    <div class="row my-3">
      <div class="my-3">
        <table class="table" id="list-questions" width="800">
          <thead>
            <tr>
              <th scope="col">Test Name</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

</main>

</html>
<script>
  const tabla = document.querySelector('#list-questions tbody');

  function getQuestions() {
    fetch('https://afsaccess4.njit.edu/~ct32/CS490/getExamNames.php')
      .then(response => response.json())
      .then(qst => {
        qst.forEach(qst => {
          const row = document.createElement('tr');
          row.innerHTML += `
          <td><a href="takeExam.php?name=${qst.exam_name}">${qst.exam_name}</a></td>
                `;
          tabla.appendChild(row);
        });
      }) // here we show the information
      .catch(error => console.log('error : ' + error.message))
  }
  getQuestions();
</script>