<?php
define('MAGICNUMBER', true);
include 'restrict.php';
?>
<?

// this page is to show the names of the exams per profesor..
// Caterine needs to send all the names (Select Distinct)
//When user clicks on name goes to Exam_detail
//Left to do the <a href ... > 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/CS490/M_GetAllExams.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
//curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
curl_close($ch);
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

<main>
    <p id="demo"></p>
    <h1 style="text-align: center;">Exams</h1>
    <div class="createE">
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
        <div class="container">
            <table class="table table-bordered" width="500">
                <tbody>
                    <tr>
                        <th colspan="2">Exam names</th>
                    </tr>
                    <?php foreach ((array) $resp as $item) : ?>

                        <tr>
                            <td><?php echo $item['exam_name']; ?></a></td>
                            <td> <a href="Exam_detail.php?name=<?php echo $item['exam_name']; ?>"><button>View Exam</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

</html>