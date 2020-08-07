<?php
	include '../database/dbsql.php';

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'docx', 'ppt');
	$path = '../assets/uploads/';
	if (
		!empty($_POST['jobid']) || !empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['age']) ||
		!empty($_POST['gender']) || !empty($_POST['contact']) || !empty($_POST['emailsub']) || !empty($_POST['address'])
	) 
	{

	$img = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];

	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

	$final_image = rand(1000, 1000000) . $img;

	if (in_array($ext, $valid_extensions)) {
		$path = $path . strtolower($final_image);
		if (move_uploaded_file($tmp, $path)) {
			$jobid = $_POST['jobid'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['emailsub'];
			$contact = $_POST['contact'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$address = $_POST['address'];
			$status = "forapproval";

			$sql = (
				"SELECT 
				* 
				FROM 
				`tbl_application` 
				where 
				contact='$contact' and email='$email' LIMIT 1");

			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$row = mysqli_fetch_assoc($result);
			if ($row['contact'] == $contact) {
				if ($row['email'] == $emailsub) {
					die('Already in Userlist');
				}
			} else {
				$uploadapp = (
					"INSERT INTO 
					`tbl_application`( `jobid`, `fname`, `lname`, `email`, `contact` , `age`, `gender`, `address`, `imgid` , `date` ,`status`) 
					VALUES 
					('" . $jobid . "','" . $firstname . "','" . $lastname . "','" . $email . "','" . $contact . "','" . $age . "','" . $gender . "','" . $address . "','" . $path . "',CURDATE(),'" . $status . "')");

				mysqli_query($conn, $uploadapp) or die(mysqli_error($conn));
				if ($uploadapp) {
					$res = "Registered Successfully:";
					echo json_encode($res);
				} else {
					$error = "Not Registered,Some Problem occur.";
					echo json_encode($error);
				}
			}
		}
	} else {
		echo 'invalid';
	}
}
