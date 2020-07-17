<?php 
$servername = "148.66.145.21";
$username = "infotechapp";
$password = "eG7GN!A$3Lh9";
$dbname = "infotechapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$sqlcheck = "SELECT * FROM results";
$result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);
if($count > 0){
    $arr = [];
    while($row = mysqli_fetch_array($result)){
       $user_id = $row['user_id'];
       $time = date('h:i:s',strtotime($row['created_at']));
       $strtime = strtotime($time);
       $answer = $row['answer'];
       $ansArr = json_decode($answer, true);
       $correct_answer = 0;
       $wrong_answer = 0;
       $not_attemped  = 0;
       foreach ($ansArr as $key => $value) {
           $qus_id = $value['question_id'];
           $ans_given_by_stu = $value['answer'];
           $sqlans = "SELECT right_answers FROM answers WHERE question_id='".$qus_id."'";
           $anscheck = mysqli_query($conn, $sqlans) or die(mysqli_error($conn));
           $row2 = mysqli_fetch_array($anscheck);
           $right_answers = json_decode($row2[0], true); 

           if(empty($ans_given_by_stu)){
                $not_attemped = $not_attemped+1;
           }else{
               if($ans_given_by_stu == $right_answers['right_answers']){
                    $correct_answer  = $correct_answer+1;
               }else{
                    $wrong_answer = $wrong_answer+1;
               }
           }
       }

       $fnarr['user_id'] = $user_id;
       $fnarr['correct_answer'] = $correct_answer;
       $fnarr['wrong_answer'] = $wrong_answer;
       $fnarr['not_attemped'] = $not_attemped;
       $fnarr['time'] = $time;
       $fnarr['strtime'] = $strtime;
       array_push($arr, $fnarr);
       // //After calculate the result insert details start
       // $sql2 = "INSERT INTO score(user_id,correct_answer,wrong_answer,not_attemped,submitted_date)VALUES ('".$user_id."','".$correct_answer."','".$wrong_answer."','".$not_attemped."','".$submitted_date."')";
       // $conn->query($sql2);
       // //After calculate the result insert details start
    }


    
   foreach ($arr as $key => $row) {
    $correct_answer[$key]  = $row['correct_answer'];
    $strtime[$key] = $row['strtime'];
   }

   //print_r($strtime);die;

   $sorted = array_orderby($arr, 'correct_answer', SORT_ASC, 'strtime', SORT_ASC);

   echo "<pre>";
   print_r($sorted);die;


    

    
}


?>
