<?php
    $sql= (
        'SELECT 
        COUNT(appid) as newapplicant 
        FROM 
        tbl_application ');

    $set = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($set)) 
    { 
        $newapplicant = $row["newapplicant"];
    }

    $sql= (
        'SELECT 
        COUNT(eventid) as scheduledapplicant 
        FROM 
        tbl_events ');

    $set = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($set)) 
    { 
        $scheduledapplicant = $row["scheduledapplicant"];
    }
    $sql= (
        'SELECT 
        COUNT(jobid) as jobpositions 
        FROM 
        tbl_job ');

    $set = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($set)) 
    { 
        $jobpositions = $row["jobpositions"];  
    }
    
    $sql= (
        'SELECT 
        COUNT(userid) as numberofemployee 
        FROM 
        tbl_user');

    $set = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($set)) 
    { 
        $numberofemployee = $row["numberofemployee"];
    }

    $sql= (
        "SELECT 
        COUNT(eventid) as successfulappointments 
        FROM 
        tbl_events 
        where 
        color='#81DE99' ");

    $set = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($set)) 
    { 
        $successfulappointments = $row["successfulappointments"]; 
    }

?>