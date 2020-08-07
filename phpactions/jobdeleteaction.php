<?php
    include '../database/dbsql.php';
				
    $jobid = $_POST['jobid'];
    
	$deletejob = (
		"Delete From 
		tbl_job 
		where
		`jobid`='$jobid'");

	mysqli_query($conn, $deletejob) or die(mysqli_error($conn));
    	if ($deletejob) {
			$res="Data Deleted Successfully:";
		  	echo json_encode($res);
		}
		else {
			$error="Not Deleted,Some Problem occur.";
		  	echo json_encode($error);
        }
?>
