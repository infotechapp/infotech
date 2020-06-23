<?php 
    include 'function/database.php';

    echo $_REQUEST['user_id'];die;
    
    // $sql = "INSERT INTO results(user_id,question_id,answer)VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobile_number"]."','".$_POST["city"]."','".$_POST["address"]."')";
    // if (mysqli_query($conn, $sql)) {
    //   if($_POST["vendor"] == 'vendor'){
    //     $last_id = $conn->insert_id;
    //     $sql2 = "INSERT INTO vendors(user_id,vendor_code)VALUES ('".$last_id."','".$_POST["vendor_code"]."')";
    //     mysqli_query($conn, $sql2);
    //   } 
    //    $mess = "Thank you for participating in our Quiz!";
    // } else {
    //    $mess = "Error: " . $sql . "" . mysqli_error($conn);
    // }
    

?>