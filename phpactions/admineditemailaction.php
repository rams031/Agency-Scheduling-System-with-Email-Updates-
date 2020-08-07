<?php
    include '../database/dbsql.php';
				
	$email = $_POST['email'];
	$emailpass = $_POST['emailpass'];
	$id = 1;
    
	$updateuser = (
		"UPDATE 
    	`tbl_email` 
    	SET 
    	`email`= '$email',
    	`password`='$emailpass' 
    	WHERE 
    	`emailid`='$id'");


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
