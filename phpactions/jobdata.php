<?php										
    $jobid=$_GET ['jid'];

    $user_check_query = (
        "SELECT 
        * 
        FROM 
        tbl_job
        WHERE 
        jobid='$jobid' 
        limit 1");

    $result = mysqli_query($conn, $user_check_query )or die(mysqli_error($conn));									  
    while($row=mysqli_fetch_assoc($result))
    {		
        $jobid = $row["jobid"];
        $jobname = $row["jobname"];
        $jobindustry = $row["jobindustry"];
        $jobsalary = $row["jobsalary"];
        $jobtype = $row["jobtype"];
        $exp = $row["exp"];
        $jobeduclvl = $row["jobeduclvl"];
        $joblocation = $row["joblocation"];
        $jobaddress = $row["jobaddress"];
        $jobdescription = $row["jobdescription"];
    }
?>