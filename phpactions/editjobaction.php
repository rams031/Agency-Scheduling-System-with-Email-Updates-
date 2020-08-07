<?php
    include '../database/dbsql.php';

	$jobid = $_POST['jobid'];
	$jobname = $_POST['jobname'];
	$jobindustry =$_POST['jobindustry'];
	$jobtype = $_POST['jobtype'];
	$location = $_POST['location'];
	$salary = $_POST['salary'];
	$exp = $_POST['explvl'];
	$educattain = $_POST['educattain'];
	$jobdesc = $_POST['jobdesc'];
	$location = $_POST['location'];
	$salary = $_POST['salary'];
	$address = $_POST['address'];
	

	$updatejob = (
		"UPDATE 
		`tbl_job` 
		SET 
		`jobname`='$jobname',
		`jobtype`='$jobtype',
		`jobindustry`='$jobindustry',
		`exp`='$exp',
		`jobdescription`='$jobdesc',
		`jobeduclvl`='$educattain',
		`jobsalary`='$salary',
		`joblocation`='$location' ,
		`jobaddress`='$address' 
		WHERE 
		jobid='$jobid'");

	mysqli_query($conn, $updatejob) or die(mysqli_error($conn));
		if ($updatejob) {
		  $res="Data Updated Successfully:";
		  echo json_encode($res);
		}
		 else {
		  $error="Not Updated,Some Problem occur.";
		  echo json_encode($error);
        }
