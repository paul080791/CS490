<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';


    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string

$sql    = "SELECT * FROM Questions";
$result = $conn->query($sql);
$arr= array();
if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                                $arr[] = array(
                                                'id' => $row['id'],
                                                'question' => $row['question'],
                                                'difficulty' => $row['difficulty'],
                                                'category' => $row['category'] );
                                             }
} else {
                echo "no results";
}
echo json_encode($arr, true);
mysqli_close($conn);
?>