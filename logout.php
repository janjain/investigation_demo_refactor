<?php require_once("includes/functions.php"); ?>
<?php require("includes/dbconn.php"); ?>
<?php require("includes/session.php"); ?>

<?php
	
	// check if the user has logged in
	if(!Has_Session())
	{
		redirect_to("index.php");
		exit;
	}      
    else
	session_start();
	
	unset($_SESSION['UID']);
	session_destroy();
	
	redirect_to("index.php");

?>