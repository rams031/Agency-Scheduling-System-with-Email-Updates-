<?php
	session_start();
    include '../database/dbsql.php';
    
	$ids = $_SESSION['userid'];
	$start = $_POST['start'];
	$end =  $_POST['end'];
	
	$sql= (
		"SELECT 
		* 
		FROM 
		tbl_events 
		JOIN tbl_forschedule ON tbl_forschedule.schedid = tbl_events.schedid 
		JOIN tbl_user ON tbl_forschedule.userid = tbl_user.userid 
		JOIN tbl_application ON tbl_application.appid = tbl_forschedule.appid 
    	where
		tbl_events.start_time='$start' and tbl_events.end_time='$end' and tbl_forschedule.userid=$ids");
    
	$res_data = mysqli_query($conn, $sql )or die(mysqli_error($conn));	
    $rowcount= mysqli_num_rows($res_data);
    
	if($rowcount > 0) 
	{ 	
		echo json_encode ("occupied"); 
	}
	else
	{		
		echo json_encode ("notoccupied");  

	}
			
?>
