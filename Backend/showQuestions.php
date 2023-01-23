<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';


$response = file_get_contents('php://input'); //helps receive JSON as string
$decoder = json_decode($response,true); //decodes JSON string

$category=$decoder['category'];
$difficulty=$decoder['difficulty'];
$search=$decoder['search'];
//$category="Strings";
//$difficulty="Easy";

$base_sql= "SELECT * FROM Questions";
/*

    if($category !="" && $difficulty !=""){
        $sql=" WHERE category='$category' AND difficulty='$difficulty'";
        
    }


    elseif($category != ""){
    $sql= " WHERE category='$category'";
    

    }
    elseif($difficulty !=""){
        $sql=" WHERE difficulty='$difficulty'";
        
    }
    elseif(!empty($search)){
        $sql=" WHERE question like '%$search%'";
    }

    else{
        $sql=" WHERE 1=1";
    }
*/
  $sql=" WHERE 1=1";

  if($category!= ""){
    $sql.=" AND category= '$category'";
  }
  if($difficulty!=""){
    $sql.=" AND difficulty='$difficulty'";
  }
  if($search != ""){
    $sql.=" AND question like '%$search%'";
  }


//echo $base_sql.$sql;

$result = $conn->query($base_sql.$sql);
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
//print_r($arr);
echo json_encode($arr, true);
mysqli_close($conn);
?>