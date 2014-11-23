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
	
	// extract form values
	$userid = clean_it($_POST['userid']);
	$usernum = clean_it($_POST['usernum']);
	$firstname  = clean_it($_POST['firstname']);
	$lastname = clean_it($_POST['lastname']);
	$title = clean_it($_POST['title']);
	$department = clean_it($_POST['department']);
	$permission = clean_it($_POST['permission']);
	$username = clean_it($_POST['username']);
	$password = clean_it($_POST['password']);
	
	// build query
	// build query
	$qry = "UPDATE users SET UID='$userid', " .
		"Fname='$firstname', Lname='$lastname', " .
		"JobTitle='$title', PID='$permission', Username='$username', ";
		if(trim($password) != "")
		{
			$qry = $qry . " Password=PASSWORD('$password'), ";
		}
		
		$qry = $qry . "emp_num = '$usernum', department = '$department' where UID='$userid'";
		
	// execute query
	$added = mysqli_query($dbconn, $qry);
	
	// report results
	if(trim($added) != "")
		echo  "Record added successfully." . "<br>";
	else
	{
		echo "ERROR: Record could not be added<br>" . 
			 mysqli_error($dbconn);
	}
	// close connection
	mysqli_close($dbconn);

?>