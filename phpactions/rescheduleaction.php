<?php
	include '../database/dbsql.php';
	
	$schedid=$_POST['sid'];
	$eventid=$_POST['eid'];
	$pros = 0;
	$applicant = "For Reschedule";

	$uploadapp = (
		"DELETE FROM 
		`tbl_events`
		WHERE 
		eventid = '$eventid'");
			
	mysqli_query($conn,$uploadapp) or die(mysqli_error($conn));
	if ($uploadapp) {
	
			$schedule = "UPDATE `tbl_forschedule`
			SET `fstatus` = '$applicant' , `process` = '$pros'
			WHERE `schedid` = '$schedid'";
			
			mysqli_query($conn,$schedule) or die(mysqli_error($conn));
				
				if ($schedule) {
				   	$res="Reschedule successfully";
					echo json_encode($res);
				}
				else
				{
				  $error="Some Problem occur.";
				  echo ($error);
				}

	}
	else{
		$error="Some Problem occur.";
		echo json_encode($error);
	}

?>