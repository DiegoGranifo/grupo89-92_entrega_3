<?php include('../Templates/header.html'); ?>
<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();

$_SESSION["user_id"] = null;
$_SESSION["user_name"] = null;
$_SESSION["user_type"] = null;
$_SESSION['loggedin'] = null;
// Destroy the session.
session_destroy();

 
// Redirect to login page
header("location: https://codd.ing.puc.cl/~grupo89/index.php");
exit;
?>