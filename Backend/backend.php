<?php

    include_once '/afs/cad/u/c/t/ct32/public_html/CS490/db.php';

    $response = file_get_contents('php://input'); //helps receive JSON as string
    $decoder = json_decode($response,true); //decodes JSON string
    $userUcid= $decoder['ucid']; //assigning ucid received to userUcid
    $userPassword =$decoder['pw']; //assigning password received to userPassword

    $sql="SELECT * FROM users WHERE ucid = '$userUcid';" ; //selects all from users table for the ucid we received
    $result= $conn->query($sql); //performing the query on the database
    
    if ($result->num_rows == 1) { //checks that the result was returned
    
        $row = mysqli_fetch_assoc($result); //fetching results 
        $user_id=$row["id"]; //obtaing user id
        //hashing password
        

        if (password_verify($userPassword, $row["password"])) { //verifies hashed password received matches the one in the database
            
             try{
                $sql="SELECT Roles.name FROM Roles JOIN UserRoles on Roles.id = UserRoles.role_id 
                WHERE UserRoles.user_id = $user_id and Roles.is_active = 1 and UserRoles.is_active = 1"; //selects role that matches user
                
                $result=$conn->query($sql); //performs the query on the database
                $row=mysqli_fetch_assoc($result); //fetches the results
                $role=$row["name"]; // saving the role (teacher or student)
                  $log = array("Response"=>"Valid", 
                                "Role"=>$role); 
                echo json_encode($log,true); // encoding data in JSON string to send to middle
             }catch (Exception $e) { //catches error
                error_log(var_export($e, true));
            }
             
        } else {
             $log = array("Response"=>"INVALID");//if password doesn't match  
            
            echo json_encode($log,true);       
        } 
    } else {
            $log = array("Response"=>"INVALID2"); //if user not in database
            
            echo json_encode($log,true);           
        } 
        
    mysqli_close($conn);



  

?>

