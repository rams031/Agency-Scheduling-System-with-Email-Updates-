<?php
    include '../database/dbsql.php';
				
    $userid = $_POST['userid'];

    $deletejob = (
      "Delete from 
      tbl_user where
      `userid`='$userid'");

	  mysqli_query($conn, $deletejob) or die(mysqli_error($conn));
        
      if ($deletejob) {
		  $res="Data Deleted Successfully:";
		    echo json_encode($res);
		  }
		  else {
		  $error="Not Deleted,Some Problem occur.";
		    echo json_encode($error);
          }
?>
