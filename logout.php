<?php
// INITIALISE THE SESSION
session_start();
 
// UNSET ALL OF THE SESSION VARIABLES
$_SESSION = array();
 
// DESTROY THE SESSION
session_destroy();
 
// REDIRECT TO LOGIN PAGE
header("location: login.php");
exit;
?>