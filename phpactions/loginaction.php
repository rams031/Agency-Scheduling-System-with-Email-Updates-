<?php
	session_start();
	include '../database/dbsql.php';
	$admin = 1;
	$hrstaff = 2;
	if (isset($_POST["email"])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$sql = (
			"SELECT 
			* 
			FROM 
			tbl_user 
			where 
			useremail='$email' 
			and 
			userpassword='$pass' 
			LIMIT 1");

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) == 1) {
			$_SESSION['userid'] = $row['userid'];
			$_SESSION['name'] = $row['username'];
			$_SESSION['lastname'] = $row['userlastname'];
			if ($row['usertype'] == "admin") {
				echo json_encode('admin');
			} else {
				echo json_encode('hrstaff');
			}
		} else {
			echo json_encode('3');;
		}
	}
?>
