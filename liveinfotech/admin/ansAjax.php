<?php 
    include 'function/database.php';
    session_start();
    $user_id = $_SESSION['login_id'];
    $sqlinner = "SELECT * FROM questions INNER JOIN answers ON questions.id = answers.question_id";
    $result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));  
    $fnArr = [];
    while ($rowGet = mysqli_fetch_array($result2)) {
       $qus = json_decode($rowGet['question'], true);
       $question = $qus['question'];
       $ans = json_decode($rowGet['answers'], true);
       $new = array();
       $new['user_id'] = $user_id;
       $new['question_id'] = $rowGet['question_id'];
       $new['question'] = $question;
       $new['answers'] = $ans;
       array_push($fnArr, $new);
    }

    echo json_encode($fnArr);
    exit;

?>