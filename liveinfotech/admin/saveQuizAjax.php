<?php 
    include 'function/database.php';
    session_start();

    if (isset($_SESSION['first_name'])) {
          $session = 0;
          $sqltoken = "select * from user_token where name = '".$_SESSION['first_name']."'";
          $resulttoken = mysqli_query($conn, $sqltoken) or die(mysqli_error($conn));
          $countToken = mysqli_num_rows($resulttoken);
          if ($countToken > 0) {
         
           $row = mysqli_fetch_array($resulttoken); 
           $token = $row['token']; 
           if($_SESSION['token'] != $token){
            session_destroy();
            $session =1;
           }
          }
    }

    

    if($session == 0) {
        $user_id = $_POST['user_id'];
        $arrCount = count($_POST['question_id']);
        $datetime = date('Y-m-d H:i:s');
        $fnArr = [];
        for ($i=0; $i < $arrCount ; $i++) { 
            $question_id = isset($_POST['question_id'][$i]) ? $_POST['question_id'][$i] : '';
            $ans = isset($_POST['ans'][$i]) ? $_POST['ans'][$i] : '';
            $data['question_id'] = $question_id;
            $data['answer'] = $ans;
            array_push($fnArr, $data);   
        }
        $jsonAns = json_encode($fnArr,true);
        $sql = "INSERT INTO results(user_id,answer,created_at)VALUES ('".$user_id."','".$jsonAns."','".$datetime."')";
        if(mysqli_query($conn, $sql)){
            //update quiz status
            $sqlquiz = "update students set quiz = '1' where id='".$user_id."'";
            mysqli_query($conn, $sqlquiz) or die(mysqli_error($conn));
            session_destroy();
            $mess = 'Quiz submitted Successfully!';
        }else{
            $mess = "Error: " . $sql . "" . mysqli_error($conn);
        }
    }else{
        $mess = 'Error';
    }
    echo json_encode($mess);
    exit;
    

?>