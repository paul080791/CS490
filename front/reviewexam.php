<?php
define('MAGICNUMBER', true);
include 'restrict.php';
//Page to get exams automatic graded
?>


<?php

  // hacer middle para pasar student name

  // this page is to show the names of the exams per profesor..

  //Left to do the <a href ... > 
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetAllExams.php');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
  //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
  //curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
  $response = curl_exec($ch); // get the response
  $resp = json_decode($response, true); //decode the json response from middle
  curl_close($ch);
  //print_r($resp);


  //$studentName=StudentName(json_encode(array("ucid"=>6)),"https://afsaccess4.njit.edu/~psg4/CS490/M_GetName.php");
  //$ucid=$studentName[0]['ucid'];

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
        <li><a href="Exams.php">Edit Exam</a></li>
        <li><a href="questionbank.php">Question Bank</a></li>
        <li><a href="createquestion.php">Add Question</a></li>
        <li><a href="reviewexam.php">Grade Exam</a></li>
        <li><a href="logout.php">Log Out</a></li>
        </li>
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
    <h2 style="text-align: center;">Review the folloging exams</h2>
    <div class="container">
      <div class="row my-3">
        <div class="my-3">
          <table class="table" id="list-examCompleted" width="600">
            <thead>
              <tr>
                <th scope="col">Exam Name</th>
                <th scope="col">Student ID</th>
                <th scope="col">Review</th>

              </tr>
              </thead>
            <tbody>
            <?php foreach ((array) $resp as $item) : ?>
                          
                          <tr>
                              <td>  <?php echo $item['exam_name'];?></td>
                              <td> Sam </td>
                              <td><a href="ProfGradeExam.php?name=<?php echo $item['exam_name']; ?>"><button >AutoGrade</button></a></td>
                          </tr>
                      <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  </html>

  </html>
