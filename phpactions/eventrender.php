<?php
    include '../database/dbsql.php';
	
	$sql= (
	"SELECT 
	tbl_events.title ,tbl_events.start_time as start,
	tbl_events.end_time as end,tbl_events.color ,
	tbl_events.reminder as rem,tbl_application.fname,
	tbl_events.schedid, tbl_events.eventid,
	tbl_application.lname, tbl_job.jobname,
	tbl_user.username,tbl_user.userlastname
	FROM 
	`tbl_events` 
	JOIN tbl_forschedule ON tbl_forschedule.schedid = tbl_events.schedid 
	JOIN tbl_user ON tbl_forschedule.userid = tbl_user.userid
	JOIN tbl_application ON tbl_application.appid = tbl_forschedule.appid 
	JOIN tbl_job ON tbl_job.jobid = tbl_application.jobid where tbl_user.userid");
		
	$set = mysqli_query($conn, $sql);
								
	while($row=mysqli_fetch_assoc($set)) 
	{
		 
		  $events[] = $row; 
		 
	}
    echo json_encode($events); 
?>