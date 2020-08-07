<?php
    include '../database/dbsql.php';
    
    $appid = $_POST['appid'];
    $userid = $_POST['userid'];
    $status = "forschedule";
    $pros = 0;
    
    $uploadapp = (
        "INSERT INTO 
        `tbl_forschedule`
        ( `appid`, 
        `userid`, 
        `dateapproved`,
        `process`) 
        VALUES 
        ('" . $appid . "',
        '" . $userid . "',
        CURDATE(),
        '" . $pros . "')");
    
    mysqli_query($conn, $uploadapp) or die(mysqli_error($conn));
    if ($uploadapp) {
    
    
        $schedule = "UPDATE tbl_application
    			SET status = '$status'
    			WHERE appid = '$appid'";
    
        mysqli_query($conn, $schedule) or die(mysqli_error($conn));
    
        if ($schedule) {
            $res = "Move to schedule successfully";
            echo json_encode($res);
        } else {
            $error = "Not schedule,Some Problem occur.";
            echo ($error);
        }
    } else {
        $error = "Not Registered,Some Problem occur.";
        echo json_encode($error);
    }
    
?>
