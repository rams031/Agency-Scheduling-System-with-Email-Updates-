<?php

    $id = $_SESSION['userid'];

    $sql = (
        "SELECT 
        * 
        FROM 
        tbl_user 
        where 
        userid='$id' LIMIT 1");

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
    ?>
        <div class="sidenavlist">
            <div id="employeename">
                <?php echo $row['username']; ?>
               <!---->
            </div>
            <?php
            if ($row['usertype'] == "admin") {
                echo '<div id="employee-position" >Administrator</div>';
            } else {
                echo '<div id="employee-position">Human Resource Staff</div>';
            }
    }    
?>