<?php
include 'function/database.php';
//session_start();
if (isset($_SESSION['first_name'])) {
  $sqltoken = "select * from user_token where name = '".$_SESSION['first_name']."'";
  $resulttoken = mysqli_query($conn, $sqltoken) or die(mysqli_error($conn));
  $countToken = mysqli_num_rows($resulttoken);
  if ($countToken > 0) {
 
   $row = mysqli_fetch_array($resulttoken); 
   $token = $row['token']; 
   if($_SESSION['token'] != $token){
    session_destroy();
    header("Location: index.php?message=alreadyLogin");
   }
  }
}