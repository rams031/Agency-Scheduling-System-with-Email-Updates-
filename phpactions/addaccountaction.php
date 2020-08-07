<?php
    include '../database/dbsql.php';

    $username = $_POST['username'];
	$userlastname =$_POST['userlastname'];
	$useremail = $_POST['useremail'];
	$userpassword = $_POST['userpassword'];
	$usertype = $_POST['usertype'];
	$contacts = $_POST['contacts'];
	
	$user_check_query = (
		"SELECT * FROM 
    	tbl_user 
    	WHERE 
    	username='$username' 
    	LIMIT 1");

    $result = mysqli_query($conn, $user_check_query )or die(mysqli_error($conn));
    
	$row = mysqli_fetch_assoc($result);
		if ($row['useremail'] === $useremail) {
		    die ('Email already used');
		}
		else {
		 $insertuser = (
		 	"INSERT INTO 
         	`tbl_user` 
         	(`username`,`userlastname`,`useremail`,`userpassword`,`datecreated`,`contacts`,`usertype`)
		 	VALUES 
         	('$username','$userlastname','$useremail','$userpassword',CURDATE(),'$contacts','$usertype')");

		mysqli_query($conn, $insertuser) or die(mysqli_error($conn));
			if ($insertuser) {
			  $res="Data Inserted Successfully:";
			  echo json_encode($res);
			  }
			  else {
			  $error="Not Inserted,Some Problem occur.";
			  echo json_encode($error);
			  }		
		}
?>
