<?php
    include '../database/dbsql.php';	

	$schedid = $_POST['schedid'];
	$start= $_POST["start"];
	$end = $_POST["end"];
	$title = $_POST["title"];
	$reminder = $_POST["reminder"];
	$process = 1;
	
	$insertevent = (
		"INSERT INTO 
		`tbl_events`( `schedid`, `start_time`, `end_time`, `title`,`color`,`reminder`) 
		VALUES 
		('".$schedid."','".$start."','".$end."','".$title."','#5499C7','".$reminder."')");
	
	mysqli_query($conn,$insertevent) or die(mysqli_error($conn));
	if ($insertevent) {
		$updateprocess = "UPDATE tbl_forschedule
		SET process = '$process'
		WHERE schedid = '$schedid'";
		
		mysqli_query($conn,$updateprocess) or die(mysqli_error($conn));
			
			if ($updateprocess) {
			   	$res="Updated successfully";
				echo json_encode($res);
			}
			else
			{
			  $error="Not schedule,Some Problem occur.";
			  echo ($error);
			}
	}
	else{
		$error="event Not Registered,Some Problem occur.";
		echo json_encode($error);
	}

?>