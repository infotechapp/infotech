
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

   $email =  $_POST["email"];
   $sqlcheck = "SELECT id FROM students WHERE email='".$email."'";
   $result = mysqli_query($conn, $sqlcheck) or die(mysqli_error($conn));
   $count = mysqli_num_rows($result);
   echo json_encode($count);
   exit;
   

?>