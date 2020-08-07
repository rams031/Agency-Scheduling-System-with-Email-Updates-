<?php
	include '../database/dbsql.php';	

	$id = $_POST['id'];						
	
	$sql= (
		"UPDATE 
		tbl_events 
		SET 
		color='#81DE99' 
		WHERE 
		eventid = $id");

	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

	if($sql)
	{
		$res="Change color successfully";
		echo json_encode($res);
	}
	else
	{
		$error="Error changing color,Some Problem occur.";
		echo json_encode($error);
	}
?>