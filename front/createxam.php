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

    <main>

        <div id=createExamname style="text-align:center">
            <br>
            <h2>Create Exam</h2>
            <br>
            <label for="Exam Name" class="ExamLabel ExamItems"><strong>Exam Name </strong></label>
            <input type="text" name="exam_name" placeholder="Exam Name" id="exam_name" />
            <button onclick="lockinput()" class="btn btn-primary" id="addq">Create Examn</button>
            <h2 id="message"></h2>
        </div>


        <p style="text-align:center" id="demo"> </p>
        <!--<h1>Add Questions</h1>-->
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
            <div class="container" style="text-align: center;">
                <button onclick="Done()" style="visibility:hidden;" class="btn btn-primary" id="doneE">Done</button>
                <br><br>
                <table id="tbstyle" style="visibility:hidden;" width="800">
                    <tbody>
                        <tr>
                            <th width="10%">Question id</th>
                            <th width="40%">Question</th>
                            <th width="15%">Difficulty</th>
                            <th width="15%">Category</th>
                            <th width="10%">Points</th>
                            <th width="10%">Add</th>
                        </tr>
                        <?php foreach ((array) $resp as $item) : ?>

                            <tr>
                                <td> <?php echo $item['id']; ?> </td>
                                <td> <?php echo $item['question']; ?> </td>
                                <td> <?php echo $item['difficulty']; ?> </td>
                                <td> <?php echo $item['category']; ?> </td>
                                <td><input type="number" name="questionPoints" value="25" id="questionPoints<?php echo $item['id']; ?>"></td>
                                <input type="hidden" id="questionId<?php echo $item["id"] ?>" value="<?php echo $item['id']; ?>">
                                <td><button onclick="addQuestion(<?php echo $item['id']; ?>)" class="btn btn-primary" id="addq">Add Question</button></td>
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
<script>
    function addQuestion(Qid) {
        //  if (str.length == 0) {

        document.getElementById("doneE").style.visibility = "visible";
        var name = document.getElementById("exam_name").value;
        var points = document.getElementById("questionPoints" + Qid).value;
        //document.getElementById("demo").innerHTML = name;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }

        };
        xmlhttp.open("GET", "https://afsaccess4.njit.edu/~psg4/CS490/M_insertExam.php?Qid=" + Qid + "&points=" + points + "&examName=" + name, true);
        xmlhttp.send();

    }

    function lockinput() {

        document.getElementById("exam_name").disabled = "true";
        document.getElementById("tbstyle").style.visibility = "visible";
    }

    function Done() {
        var name = document.getElementById("exam_name").value;
        window.location.href = "Exam_detail.php?name=" + name;

    }

    //}
</script>