
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

   $roll_number = $_POST['roll_number'];
   if(empty($roll_number)){
     $sqlcheck = "SELECT * FROM final_score inner join students on final_score.user_id=students.id";
   }else{
     $sqlcheck = "SELECT * FROM final_score inner join students on final_score.user_id=students.id where roll_number='".$roll_number."'";
   }
   $result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
   $newfun = [];
   while ($row = mysqli_fetch_array($result)) {
      $time = date('h:i:s',strtotime($row['submitted_date']));
      $strtime = strtotime($time);
      $new['user_id'] = $row['user_id'];
      $new['position'] = $row['position'];
      $new['roll_number'] = $row['roll_number'];
      $new['correct_answer'] = $row['correct_answer'];
      $new['name'] = $row['name'];
      $new['father_name'] = $row['father_name'];
      $new['address'] = $row['address'];
      $new['img_name'] = $row['img_name'];
      $new['submitted_date'] = $time;
      array_push($newfun,$new);
   }

   function sortByOrder($a, $b) {
      return $a['position'] - $b['position'];
   }
   usort($newfun, 'sortByOrder');
   echo json_encode($newfun);
   exit;

?>