<?php 
include "include/database.php";
$fp = fopen(__DIR__."/question.csv", 'r') or die("Can't open file");
$i = 1;
$count = 0;
$datetime = date("Y-m-d H:i:s", strtotime("+330 minutes"));
while ($csv_line = fgetcsv($fp, 2000)) {
    if ($i == 1) {
		$i++;
        continue;
    }
    $question = array("question"=>$csv_line[1]);
    $json_question = json_encode($question);
    //save the question start
    $sql = "INSERT INTO questions(question,created_at)VALUES ('".$json_question."','".$datetime."')";
    //save the question end
    if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		//save answers start
		$answers = array("ans1"=>$csv_line[2],"ans2"=>$csv_line[3],"ans3"=>$csv_line[4],"ans4"=>$csv_line[5]);
		$right_answers = array("right_answers"=>$csv_line[6]);
		$json_right_answers = json_encode($right_answers);
    	$json_answers = json_encode($answers);
    	$sql2 = "INSERT INTO answers(question_id,answers,right_answers)VALUES ('".$last_id."','".$json_answers."','".$json_right_answers."')";
    	//save answers end
    	if ($conn->query($sql2) === TRUE) {
    		$count = $count+1;
    	}
	} else {
	  	echo "Error: " . $sql . "<br>" . $conn->error;
	}	

}
echo $count.' Record Inserted!';