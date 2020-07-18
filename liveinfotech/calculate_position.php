
<?php
error_reporting(1);

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

   
   $sqlcheck = "SELECT * FROM score  ORDER BY score.correct_answer DESC ,score.strtotime ASC";
   $result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
   $i=1;
   $total_result = 0;
   while ($row = mysqli_fetch_array($result)) {
       $sql2 = "INSERT INTO final_score(user_id,correct_answer,position,submitted_date)VALUES ('".$row['user_id']."','".$row['correct_answer']."','".$i."','".$row['submitted_date']."')";
       $conn->query($sql2);
       $total_result = $total_result+1;
       $i++;
   }

   echo $total_result;die;

   

?>