<?php
$name=$_REQUEST['name'];
//echo $name;
$test= array(
    'exam_name'=> $name
);
$test1=json_encode($test);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/Back/getTest.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $test1); //sent the json
$response = curl_exec($ch); // get the response
$resp = json_decode($response, true); //decode the json response from middle
echo $test1;
curl_close($ch);
echo $resp;


$qid=$_POST['question_id'];

$delete=array(
    'exam_name'=>$name,
    'question_id'=>$qid
);

$delete1=json_encode($delete);
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/deleteQuestion.php');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch1, CURLOPT_POSTFIELDS, $delete1); //sent the json
$response1 = curl_exec($ch1); // get the response
$resp1 = json_decode($response1, true); 
//echo $resp1;
//decode the json response from middle
curl_close($ch1);

//echo $qid;
//echo "hola";
//$resp_encoded = json_encode($resp, true);
//echo $resp_encoded;


//$questionPoints =$_REQUEST["id"];

//echo $questionPoints . "holaaa";
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
        <p id="demo"></p>
        <h1 style="text-align: center;">Exam: <?php echo $name; ?> </h1>
        <div class="createE" >
            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    background-color: white;
                    width: 800px;
                    margin-left: auto;
                    margin-right: auto;
                }
            </style>
            <div class="container">
                <table id="tbstyle" >
                    <tbody>
                        <tr>
                            <th>Question id</th>
                            <th>Question</th>
                            <th>Points</th>
                            <th>Delete</th>
                        </tr>
                        <?php foreach ((array) $resp as $item) : ?>
                         
                            <tr>
                                <td> <?php echo $item['question_id']; ?> </td>
                                <td><?php echo $item['question']; ?></td>
                                <td><?php echo $item['points']; ?>
                                
                                <td>
                                    <form  method="POST">
                                        <input type="hidden" name="question_id" value="<?php echo $item['question_id']; ?>"/>
                                        <input type="submit" class="btn btn-warning" name="delete" value="Delete Item"/> 
                                    </form>
                                </td>
                            </tr>
                                   
                            
                        <?php endforeach; ?>
                                
                    
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
