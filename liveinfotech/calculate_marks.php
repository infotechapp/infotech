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

$newCount= 0;
$sqlcheck = "SELECT * FROM results";
$result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);
if($count > 0){
    while($row = mysqli_fetch_array($result)){


       $user_id = $row['user_id'];
       $time = date('h:i:s',strtotime($row['created_at']));
       $strtime = strtotime($time);
       $answer = $row['answer'];
       $ansArr = explode("$$", $answer);
       array_pop($ansArr);
       $correct_answer = 0;
       $wrong_answer = 0;
       $not_attemped  = 0;

   
       $i = 0;    
       foreach ($ansArr as $key => $value) {
            $arr = explode(',', $value);
            if($i == 0){
              $qus_id = $arr[0];
              $ans_given_by_stu = $arr[1];
            }else{
              $qus_id = $arr[1];
              $ans_given_by_stu = $arr[2];
            }

           $sqlans = "SELECT right_answers FROM answers WHERE question_id='".$qus_id."'";
           $anscheck = mysqli_query($conn, $sqlans) or die(mysqli_error($conn));
           $row2 = mysqli_fetch_array($anscheck);
           $right_answers = $row2[0];
           
           if(empty($ans_given_by_stu)){
                $not_attemped = $not_attemped+1;
           }else{
               if($ans_given_by_stu == $right_answers){
                    $correct_answer  = $correct_answer+1;
               }else{
                    $wrong_answer = $wrong_answer+1;
               }
           }

           $i++;
       }
       //After calculate the result insert details start
       $sql2 = "INSERT INTO score(user_id,correct_answer,wrong_answer,not_attemped,submitted_date,strtotime)VALUES ('".$user_id."','".$correct_answer."','".$wrong_answer."','".$not_attemped."','".$row['created_at']."','".$strtime."')";
       $conn->query($sql2);
       //After calculate the result insert details start

       $newCount = $newCount+1;
    }
}

echo $newCount;die;


?>
