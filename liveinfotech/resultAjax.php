
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

   
   $sqlcheck = "SELECT * FROM score inner join students on score.user_id=students.id";
   $result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
   $newfun = [];
   while ($row = mysqli_fetch_array($result)) {

      $time = date('h:i:s',strtotime($row['submitted_date']));
      $strtime = strtotime($time);

      $new['user_id'] = $row['user_id'];
      $new['roll_number'] = $row['roll_number'];
      $new['correct_answer'] = $row['correct_answer'];
      $new['name'] = $row['name'];
      $new['father_name'] = $row['father_name'];
      $new['address'] = $row['address'];
      $new['img_name'] = $row['img_name'];
      $new['submitted_date'] = $time;
      $new['strtime'] = $strtime;

      array_push($newfun,$new);
   }

   function sortByOrder($a, $b) {
      return $a['correct_answer'] - $b['correct_answer'];
   }
   usort($newfun, 'sortByOrder');
   $rev = array_reverse($newfun);

   



   
   
   

   echo json_encode($rev);
   exit;

?>