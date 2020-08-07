<?php
    include '../database/dbsql.php';

    $scheduleid = $_POST['scheduleid'];
    $applicationid = $_POST['applicationid'];

    $sql = (
        "DELETE FROM 
        `tbl_forschedule` 
        WHERE
        schedid = $scheduleid");

    $result = mysqli_query($conn, $sql);

    if ($result) {

        $update = ("UPDATE 
                tbl_application 
                SET 
                status='forapproval'
                WHERE   
                appid = $applicationid");

        $updatestatus = mysqli_query($conn, $update);

        if ($updatestatus) {
            $res = "Data has change successfully";
            echo json_encode($res);
        } else {
            $error = "There is an error on changing data";
            echo json_encode($error);
        }
    } else {
        $error = "There is an error on changing data";
        echo json_encode($error);
    }
?>