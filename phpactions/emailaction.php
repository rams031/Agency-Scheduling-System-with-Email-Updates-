<?php
	session_start();
	include '../database/dbsql.php';

	$schedid = $_POST['schedid'];
	$time = $_POST['time'];

	$applicantcheck = (
		"SELECT 
		* 
		FROM 
		tbl_forschedule 
		INNER JOIN tbl_application ON tbl_application.appid = tbl_forschedule.appid 
		INNER JOIN tbl_job ON tbl_application.jobid = tbl_job.jobid 
		where 
		tbl_forschedule.schedid = '$schedid'" );
								
	$res_data = mysqli_query($conn, $applicantcheck)or die(mysqli_error($conn));	
	while($row = mysqli_fetch_array($res_data)){

		$appjname = $row["jobname"];
		$appfname = $row["fname"]; 
		$applname = $row["lname"];
		$appemail = $row["email"];

	}

	$user_check_query = 
		"SELECT 
		* 
		FROM 
		`tbl_email`";

	$res_data = mysqli_query($conn, $user_check_query )or die(mysqli_error($conn));	
	while($rowi = mysqli_fetch_array($res_data))
	{
		
		$name = $_SESSION['name'];
	    $lastname = $_SESSION['lastname'];
		$email = $rowi['email'];
		$password = $rowi['password'];
		$letter = "<div>Dear $appfname $applname Applicant,</div><br><br>

		<div>Thank you for applying for the position of ($appjname)  .</div><br>

		<div>We would like to invite you to come to our office to interview for the position.
		Your interview has been scheduled for '$time'. at  Unit 2, Felisa Building, 1 Gov. 
		Santiago Corner Mc Arthur Hi-Way, Valenzuela, 1440 Metro Manila. Kindly look for HR Staff '$name' '$lastname'</div><br>

		<div>Please call me at (02) 8293 0477 if you have any questions or need to reschedule.</div><br>

		<div>Sincerely,</div>
		<div>HR Staff</div>
		<div>$name $lastname </div>";
		
	}

   	require '../modules/PHPMailer-master/PHPMailerAutoload.php';
   	$mail = new PHPMailer();
   	$mail ->IsSmtp();
   	$mail ->SMTPDebug = 1;
   	$mail ->SMTPAuth = true;
   	$mail ->SMTPSecure = 'ssl';
   	$mail ->Host = "smtp.gmail.com";
   	$mail ->Port = 465; // or 587
   	$mail ->IsHTML(true);
   	$mail ->Username = $email;
   	$mail ->Password = $password;
   	$mail ->SetFrom($email);
   	$mail ->Subject = 'Invitation to Interview';
   	$mail ->Body = $letter;
   	$mail ->AddAddress($appemail);

   	if(!$mail->Send())
   	{
   	    echo "Mail Not Sent";
   	}
   	else
   	{
   	    echo "Mail Sent";
   	}
