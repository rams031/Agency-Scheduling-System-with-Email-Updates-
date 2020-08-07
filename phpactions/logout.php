<?php
session_start();
session_destroy();
header("Location: ../adminwebpages/loginportal.php");
?>