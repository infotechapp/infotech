<?php 
    include 'function/database.php';

    $user_id = $_POST['user_id'];
    $arrCount = count($_POST['question_id']);
    
    $fnArr = [];
    for ($i=0; $i < $arrCount ; $i++) { 
        $question_id = isset($_POST['question_id'][$i]) ? $_POST['question_id'][$i] : '';
        $ans = isset($_POST['ans'][$i]) ? $_POST['ans'][$i] : '';
        $data['question_id'] = $question_id;
        $data['answer'] = $ans;
        array_push($fnArr, $data);   
    }
    $jsonAns = json_encode($fnArr,true);
    $sql = "INSERT INTO results(user_id,answer)VALUES ('".$user_id."','".$jsonAns."')";
    if(mysqli_query($conn, $sql)){
        $mess = 'Quiz submitted Successfully!';
    }else{
        $mess = "Error: " . $sql . "" . mysqli_error($conn);
    }
    echo json_encode($mess);
    exit;
    

?>