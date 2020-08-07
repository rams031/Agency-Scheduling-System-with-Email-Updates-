<?php
    include '../database/dbsql.php';
				
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$userlastname =$_POST['userlastname'];
	$useremail = $_POST['useremail'];
	$userpassword = $_POST['userpassword'];
	$usertype = $_POST['usertype'];
	$contacts = $_POST['contacts'];

	$updateuser = (
		"UPDATE `tbl_user` SET 
    	`username`='$username',
    	`userlastname`='$userlastname',
    	`useremail`='$useremail',
    	`userpassword`='$userpassword',
		`usertype`='$usertype',
    	`contacts`='$contacts' 
    	WHERE userid='$userid'");

	mysqli_query($conn, $updateuser) or die(mysqli_error($conn));
		if ($updateuser) {
		    $res="Data Updated Successfully:";
		    echo json_encode($res);
		}
		else {
		    $error="Not Updated,Some Problem occur.";
		    echo json_encode($error);
		}		
?>
