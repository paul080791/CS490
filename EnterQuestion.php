<?php

$question = $_POST['question'];
$function_name = $_POST['function_name'];
$difficultyAdd = $_POST['difficulty'];
$categoryAdd = $_POST['category'];
$test_case1 = $_POST['test_case1'];
$output1 = $_POST['output1'];
$test_case2 = $_POST['test_case2'];
$output2 = $_POST['output2'];
$test_case3 = $_POST['test_case3'];
$output3 = $_POST['output3'];
$test_case4 = $_POST['test_case4'];
$output4 = $_POST['output4'];
$test_case5 = $_POST['test_case5'];
$output5 = $_POST['output5'];
$constraints = $_POST['constraints'];

$test_case = array();
    for ($i = 1; $i <=5; $i++) {
        if (($_POST['test_case'.$i]))
           $test_case[] = $_POST['test_case'.$i];
    }
$count_cases= count($test_case);

//Save data into an array and send it to the middle using json_encode
$test = array(
    'question' => $question,
    'function_name' => $function_name,
    'difficulty' => $difficultyAdd,
    'category' => $categoryAdd,
    'test_case1' => $test_case1,
    'output1' => $output1,
    'test_case2' => $test_case2,
    'output2' => $output2,
    'test_case3' => $test_case3,
    'output3' => $output3,
    'test_case4' => $test_case4,
    'output4' => $output4,
    'test_case5' => $test_case5,
    'output5' => $output5,
    'constraints' => $constraints,
    'count_cases'=>$count_cases
);
echo $test;
$test = json_encode($test);

if (!empty($_POST['question'])) {
    // initialize a curl session to send the json using post method
    //echo "hjihi";
    $ch = curl_init();

    //curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~ct32/CS490/insertQuestions.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
    curl_setopt($ch, CURLOPT_POSTFIELDS, $test); //sent the json
    $response = curl_exec($ch); // get the response
    $resp = json_decode($response); //decode the json response from middle
    echo $test;
    curl_close($ch);
    echo $response;
}

$categoryF = $_POST["category"];
$difficultyF = $_POST["difficulty"];
$exam_name = $_POST["exam_name"];
echo $exam_name;
$test = array(
    'category' => $categoryF,
    'difficulty' => $difficultyF
);
//print_r($test);
$filter = json_encode($test);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afsaccess4.njit.edu/~psg4/Project490/M_showQuestions.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //type of data front is sending to middle
curl_setopt($ch, CURLOPT_POSTFIELDS, $filter); //sent the json
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
    <!--Jquery Link-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    <div>
        <form class="create_question" name="create_question" id="exam_case" method="post" style="float:left; margin-left: 100px; margin-right:10px;">
            <h2 id="demo" style="text-align:center;">Create a Question</h2>
            <ul>
                <li>
                    <label for="question">Question:</label><br>
                    <textarea rows="4" cols="50" type="text" id="question" name="question" placeholder="Write a question..."></textarea>
                </li>
                <li>
                    <label for="function">Function name:</label>
                    <input type="text" id="function" name="function_name" />
                </li>
                <li>
                    <label for="category">Category:</label>
                    <select id="category" name="category">
                        <option value="Arrays">Arrays</option>
                        <option value="Condition">Condition</option>
                        <option value="Loops">Loops</option>
                        <option value="Strings">Strings</option>
                    </select>
                </li>
                <li>
                    <label for="difficulty">Difficulty:</label>
                    <select id="difficulty" name="difficulty">
                        <option value="Easy">Easy
                        </option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>
                </li>
                <li>
                    <label for="constraints">Constraint:</label>
                    <select id="constraints" name="constraints">
                        <option value="none">None</option>
                        <option value="for">For</option>
                        <option value="while">While</option>
                        <option value="recursion">Recursion</option>
                    </select>
                </li>
                <li>
                    <label for="case">Test Cases:</label>
                    <div class="list_wrapper">
                        <div class="row">
                            <input type="text" name="test_case1" placeholder="Case 1" class="form-control" />
                            <input type="text" name="output1" placeholder="Output 1" class="form-control" />
                            <input type="text" name="test_case2" placeholder="Case 2" class="form-control" />
                            <input type="text" name="output2" placeholder="Output 2" class="form-control" />
                        </div>
                    </div>
                    <button class="btn btn-primary list_add_button" type="button">Add</button>

                </li>
                <button type="submit" name="submit" value="submit">Create</button>

            </ul>
        </form>
    </div>
    
    <form name="filter" method="post" style="margin-left: 780px;">
    <div id="filter-question" class="input-group">
        <div class="input-group-text">Sort by: </div>
        <label> Category: </label>
        <select id="category" name="category">
            <option value="">All</option>
            <option value="Arrays">Arrays</option>
            <option value="Condition">Condition</option>
            <option value="Loops">Loops</option>
            <option value="Strings">Strings</option>
        </select>
        <script>
            //quick fix to ensure proper value is selected since
            //value setting only works after the options are defined and php has the value set prior
            document.forms[0].category.value = "<?php echo $category ?>";
        </script>
        <label> Difficulty: </label>

        <select id="difficulty" name="difficulty">
            <option value="">All</option>
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
        </select>

        <script>
            //quick fix to ensure proper value is selected since
            //value setting only works after the options are defined and php has the value set prior
            document.forms[0].difficulty.value = "<?php echo $difficulty ?>";
        </script>
        <div>
            <div class="input-group">
                <button class="btn btn-primary" id="filter">Apply</button>
            </div>
        </div>
    </div>
    </form>


    <div class="createE">
        <style>
            table,
            th {
                border: 1px solid #c21212;
                border-collapse: collapse;
                background-color: #FF9999;
                text-align: center;
                margin-left: 700px;
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
            <button onclick="Done()" style="visibility:hidden;" class="btn btn-primary" id="doneE">Done</button>
            <br><br>
            <table id="tbstyle" style="visibility:visible;" width="700">

                <tbody>
                    <tr>
                        <th width="10%">Question id</th>
                        <th width="50%">Question</th>
                        <th width="20%">Difficulty</th>
                        <th width="20%">Category</th>
                    </tr>
                    <?php foreach ((array) $resp as $item) : ?>

                        <tr>
                            <td> <?php echo $item['id']; ?> </td>
                            <td> <?php echo $item['question']; ?> </td>
                            <td> <?php echo $item['difficulty']; ?> </td>
                            <td> <?php echo $item['category']; ?> </td>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function()

        {
            var x = 2; //Initial field counter
            var list_maxField = 5; //Input fields increment limitation

            //Once add button is clicked
            $('.list_add_button').click(function() {
                //Check maximum number of input fields
                if (x < list_maxField) {
                    x++; //Increment field counter
                    var list_fieldHTML = '<div class="row">\
                            <input type="text"  name="test_case' + x + '" placeholder="Case ' + x + '" class="form-control"/>\
                            <input type="text"  name="output' + x + '" placeholder="Output ' + x + '" class="form-control"/>\
                            <a href="javascript:void(0);" class="list_remove_button btn btn-danger"><button>Delete</button></a></div>'; //New input field html 
                    $('.list_wrapper').append(list_fieldHTML); //Add field html

                }
            });
            
            //Once remove button is clicked
            $('.list_wrapper').on('click', '.list_remove_button', function() {
                $(this).closest('div.row').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    

    function Filter() {
        //  if (str.length == 0) {
        var categoryF = document.getElementById("category").value;
        var difficultyF = document.getElementById("difficulty").value;


        const arr = {
            "category": categoryF,
            "difficulty": difficultyF
        };
        var myJson = JSON.stringify(arr);
        console.log(myJson);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.open("POST", "https://afsaccess4.njit.edu/~psg4/Project490/M_showQuestions.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/json");
        xmlhttp.send(myJson);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;

                console.log(this.responseText);

            }

        };

    }
</script>