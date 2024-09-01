<?php
include('conn.php');
//initialize the session
session_start();
//Unset all of the session variables
$_SESSION = array();
//End the session
session_destroy();
//redirect to login page
header("Location: ../Homepage.php");
exit();
?>