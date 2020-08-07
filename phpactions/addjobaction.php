<?php
    include '../database/dbsql.php';
		
	$jobname = $_POST['jobname'];
	$jobindustry =$_POST['jobindustry'];
	$jobtype =$_POST['jobtype'];
	$location = $_POST['location'];
	$salary = $_POST['salary'];
	$educattain = $_POST['educattain'];
	$exp = $_POST['explvl'];
	$educattain = $_POST['educattain'];
	$jobdesc = $_POST['jobdesc'];
	$address = $_POST['address'];
			
	$user_check_query = (
		"SELECT 
		* 
		FROM 
		tbl_job 
		WHERE 
		jobname='$jobname' 
		LIMIT 1");

	$result = mysqli_query($conn, $user_check_query )or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    
    if ($row['jobname'] === $_POST['jobname']) 
    {
		die ('Already in Job List');
	}
    else
    {
		$insertjob = (
		 	"INSERT INTO 
		 	tbl_job (`jobname`,`jobtype`,`jobindustry`,`exp`, `dateposted`, `jobdescription`,`jobsalary`, `joblocation`, `jobeduclvl`,`jobaddress`) 
		 	VALUES 
		 	('$jobname','$jobtype','$jobindustry','$exp',CURDATE(),'$jobdesc','$salary','$location','$educattain','$address')");

		mysqli_query($conn, $insertjob) or die(mysqli_error($conn));
			if ($insertjob) {
			  $res="Data Inserted Successfully:";
			  echo json_encode($res);
			  }
			  else {
			  $error="Not Inserted,Some Probelm occur.";
			  echo json_encode($error);
			  }		
	}

?>
