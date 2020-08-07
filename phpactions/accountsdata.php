<?php									
    $uid=$_GET ['uid'];

    $user_check_query = (
        "SELECT 
        * 
        FROM 
        tbl_user 
        WHERE 
        userid='$uid' 
        limit 1" );

    $result = mysqli_query($conn, $user_check_query )or die(mysqli_error($conn));									  
    while($row=mysqli_fetch_assoc($result))
    {
        $userid = $row["userid"];
        $username = $row["username"];
        $userlastname = $row["userlastname"];
        $useremail = $row["useremail"];
        $userpassword = $row["userpassword"];
        $contacts = $row["contacts"];
        $usertype = $row["usertype"];
    }
?>
