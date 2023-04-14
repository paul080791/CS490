<?php
$r=file_get_contents('php://input');
$display = json_decode($r, true); 
//echo $data['exam_name'];
//$print(display);
//$print_r($data);
//print_r($data);
//echo $data['exam_name'];
//echo $data['student_id'];
//$r=array(
  //  'exam_name'=> "exam6",
    //'student_id'=> 6
//);

$r=json_encode($display);
//print_r($r);
//echo "tttt";
//echo "askdkaskd";
$url = 'https://afsaccess4.njit.edu/~ct32/CS490/getAnswersTest.php';

//print_r($r);


$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// get the answer back from the middle
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));//type of data front is sending to middle
curl_setopt($ch,CURLOPT_POSTFIELDS, $r);//sent the json
$response=curl_exec($ch);// get the response
$resp = json_decode($response,true);
curl_close($ch);
$max_points = 0;
$points_recieved_arr = array();
//echo count($resp);
//print_r($resp);



function InsertGrade($data_obj, $url){
    $ch1 = curl_init($url);
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_obj);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    $response1 = curl_exec($ch1);
    $r_decoded = json_decode($response1, true);
    curl_close($ch1);
   // print_r($response1);
    return $r_decoded;

}

function InsertFinalGrade($data_obj, $url){
    $ch1 = curl_init($url);
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_obj);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    $response1 = curl_exec($ch1);
    $r_decoded = json_decode($response1, true);
    curl_close($ch1);
    //print_r($response1);
    return $r_decoded;

}

function ChangeIsActive($data_obj, $url){
    $ch1 = curl_init($url);
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_obj);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    $response1 = curl_exec($ch1);
    $r_decoded = json_decode($response1, true);
    curl_close($ch1);
    //print_r($response1);
    return $r_decoded;

}



function writeFile($python_file, $student_res){
    $handle = fopen($python_file, 'w') or die("Can't open...");
    fwrite($handle, $student_res);
    fclose($handle);
}

function appendFile($python_file, $case_arr){
    $handle = fopen($python_file, 'a') or die("Can't append...");

   // echo "______" . count($case_arr);
    for ($case = 0; $case < count($case_arr); $case++){
        fwrite($handle,"\nprint(".$case_arr[$case]["TestCase"].")");
    }
    fclose($handle);
}


function compileMe($py_file){
    #$file ;
    $cmd = 'python ./'.$py_file;
    $output = array();
    exec($cmd, $output,$return_status);
    $output[] = $return_status;
    return $output;

}

function compileTestCases($py_file){
    $cmd = 'python ./'.$py_file;
    $output = array();
    exec($cmd, $output);
    return $output;
}
function appendF($python_file, $case_arr){
    $handle = fopen($python_file, 'a') or die("Can't append...");

        fwrite($handle,"\n". $case_arr ."\n");
    fclose($handle);
}
function gradeMe($case, $std_ans, $func_case, $case_arr, $max_points,$constraint,$count_cases){
    $points = 0.0;
    $numCases=$count_cases;
    $feedback = '';
    $const1='';
    $const2='';
    $worth_func=round($max_points * 0.15,2);
    //echo $worth_func;
    $ratio_total=0.15;
    
    /*str_replace(' ', '', $std_ans)*/
    $strArr1 = explode("(", $std_ans);
    $func_name1=$strArr1[0];
    $fun = explode("def ", $func_name1);
    //echo $fun[1];
    writeFile('python1.py',$std_ans);
    //"def hello_name(name):\n\t return \"Hello \"+name+\"!\""
    appendF('test1.py',$std_ans);
    $output = compileMe('python1.py');
    //echo count($output);
    switch($constraint){
        case "none":
            break;
        case "for": 
            
            $const1='for ';
            if (strpos($std_ans, $const1) == true)
                $cons=true;
            else $cons=false;    
            $const2='for';
            $worth_const=round($max_points * 0.25,2);
            $ratio_total+=0.25;
            break;
        case "while":

            $const1='while ';
            if (strpos($std_ans, $const1) == true)
                $cons=true;
            else $cons=false;
            $const2='while';
            $worth_const=round($max_points * 0.25,2);
            $ratio_total+=0.25;
            break;
        case 'recursion':
            $const1=$func_case;
            $const2=$func_case;
            
            //echo substr_count($std_ans, $fun[1]) . "LLLLLLLL" ; 
            if (substr_count($std_ans, $fun[1])>1)
                $cons=TRUE;
            else $cons=FALSE;
            //echo $cons . "PPPPPPPP";
            $worth_const=round($max_points * 0.25,2);
            $ratio_total+=0.25;
            break;
            }// switch(constraint)
            //echo $const1;
    switch ($case){
        case 0://check if compile
            if(end($output) == 0 && $std_ans != null){
                // 3 points for compiling
                //$points=$points+3;
               //$points_Compile=3;
              // echo "holaaaa";
                $comment = $comment."Your program compiled!\t (+". $points.")\n";

            } else{
                $comment = $comment."Your program failed to compile.\t  (0 Points)";
                //$points_Compile=3;
                $points_func=0;
                $points_constraint=0;
                $points_constraint=0;
                $worth_const=round($max_points * 0.25,2);
                $worth_func=round($max_points * 0.15,2);
                $fun[1]="does not Compile";
                $output=array("Does not Compile","Does not Compile","Does not Compile","Does not Compile","Does not Compile");
                $Case_points=round(($max_points*(1-$ratio_total))/$numCases,2);
                echo $ratio_total . "-----";
                break;
            }
            
        case 1:
            // 2 points for match name func
            //print_r($func_case);
            //print_r($std_ans);

            if (strpos($std_ans, $func_case) == FALSE) {
                
              $points_func=0;
              
               
            //echo $fun[1];
            $std_ans=str_replace($fun[1],$func_case,$std_ans,$i);
            //echo $std_ans;
            writeFile('python1.py',$std_ans);
               
                
            } 
            else{
                
                
                $points+= $worth_func;
                $points_func=$worth_func;
                $comment = $comment."\nThe function name matches!\t (+ 2 points) \n";
                
            }
            if($constraint!="none" )
            if ($cons==FALSE)
            {   //echo $comment;
                $F_const="Not Use";
                $points_constraint=0;
                $comment = $comment."The constraint does not match the requirements.\t (- 3 points)"   ;
                
            }
            else {
                $points+= $worth_const;
                 $F_const=$constraint;
                //echo $comment;
                $points_constraint=$worth_const;
                $comment = $comment."\nConstraint Accepted name matches!\t (+ 3 points) \n";
                
            }

        case 2:
           // CHECK THISSSSSS with decimal

           $Case_points=round(($max_points*(1-$ratio_total))/$numCases,2);
            //echo $Case_points;
            
            appendFile('python1.py', $case_arr);
           // echo file_get_contents( "python1.py" );
            $output = compileTestCases('python1.py');
            //print_r($output);
         //print_r($output);
            for ($case = 0; $case < count($output); $case ++){
                //echo  $output[$case] . "=====" . $case_arr[$case]['Output'] . "======";

                if ($output[$case] == $case_arr[$case]['Output']){
                    
                        $points+=$Case_points;
                        $points_cases[$case]=$Case_points;
                        //echo "hhhhh".$points_cases[$case];
                   // $ratio ++;
                } else{
                    
                        $points_cases[$case]=0;
                        continue;
                }
            }
           
    }
    //echo $comment;

    
    //print_r($points_cases);
    $array = [
                'PointsCases' => $points_cases,
                'points'=> $points, 
                'comment' => $comment,
                'points_const'=> $points_constraint,
                'cases'=>$output,
                'points_func'=> $points_func,
                'worth_func'=>$worth_func,
                'worth_const'=>$worth_const,
                'worth_case'=>$Case_points,
                'total_worth'=>$max_points,
                'cases'=> $output,
                'function_name'=>$fun[1],
                'constraint'=>$F_const,
            
            ];
    //print_r($array);
    return $array;
}



$FinalPoints=0;
for ($i=0; $i < count($resp); $i++){
    //echo inval($resp[$i]['count_cases']);
   $get_cases=array();
    for($j=1;$j <= intval($resp[$i]['count_cases']); $j++)
    {
        array_push($get_cases, array('TestCase'=>$resp[$i]['test_case'. $j], 
        'Output'=>$resp[$i]['output'.  $j]));

    }
   //echo "---------";
   // print_r($get_cases);
    $max_points += $resp[$i]['points']; # points possible on test
    //$str = $resp[$i]['test_case1']; // Pass Product name here
    //$str = $resp[$i]['test_case1'];
    //$strArr = explode("(", $str);
    //$func_name=$strArr[0];
    
  // check constraint!!!!!---------------------------------
  //echo "-----";
 //print_r($resp[$i]['points']);
    $grade_res = gradeMe(0, $resp[$i]['answer'], $resp[$i]['function_name'], $get_cases, $resp[$i]['points'],$resp[$i]['constraints'],$resp[$i]['count_cases']);

   $FinalPoints+=$grade_res['points'];
  // echo $FinalPoints . "aaaaaaaaaaa";
  

    $points_recieved_arr [] = $grade_res['Points']; # tally of points recieved
    $Points_cases= $grade_res['PointsCases'];
    //print_r($Points_cases);
        
        if($grade_res['points']>$grade_res['total_worth'])
           $p= floor($grade_res['points']);
        else 
            $p=ceil($grade_res['points']);
            
    $data = array();

    $std_test = array(
        'student_id'=>$display['student_id'],
        'exam_name'=> $display['exam_name'],
        'question_id' => $resp[$i]['question_id'],
        'answer' => $resp[$i]['answer'],
        'function_name'=>$grade_res['function_name'],
        'points_func'=> $grade_res['points_func'],
        'constraints'=> $grade_res['constraint'],
        'points_const'=> $grade_res['points_const'],// is inside func grade
     
        'points'=> $Points_cases,
        'cases'=> $grade_res['cases'],// have to return
        'worth_func'=>$grade_res['worth_func'],
        'worth_const'=>$grade_res['worth_const'],
        'worth_case'=>$grade_res['worth_case'],
        'total_worth'=>$grade_res['total_worth'],
        'total_points'=>$p,// round it up in favor of the student
        //'final_grade'=>$grade_res['points'],
        
    );
    
        //print_r( $std_test);
       // print_r( $std_test['points']);
        
// send the outputs
//points por output

        $data[] =  $std_test;
        //print_r($data);
        $Graded = json_encode($data);
       // print_r($Graded);
        $Insert_Grade_url='https://afsaccess4.njit.edu/~ct32/CS490/insertTableResults.php';
        
$handIn_res = InsertGrade($Graded, $Insert_Grade_url);


$url_IsActive = 'https://afsaccess4.njit.edu/~ct32/CS490/updateisActive.php';
$changeIsActive= ChangeIsActive($r,$url_IsActive);        
}
//echo "----". $FinalPoints;
$Insert_Final_Grade_url='https://afsaccess4.njit.edu/~ct32/CS490/insertFinalGrade.php';
$Final=array(
    'student_id'=> $display['student_id'],
    'exam_name'=>$display['exam_name'],
    'final_grade'=>$FinalPoints,
    'comment'=>"",
);
$final_encoded=json_encode($Final);
$handIn_res = InsertFinalGrade($final_encoded, $Insert_Final_Grade_url);
//echo "----".count($data);


echo json_encode($handIn_res, true);
?>