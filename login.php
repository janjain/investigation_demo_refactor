<?php require("includes/dbconn.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>

<?php

	// extract form values	
	$username = clean_it($_POST['username']);
	$password = clean_it($_POST['password']);
		
	// build query
	$qry = "SELECT * FROM users WHERE Username='$username' AND " .
		"Password=PASSWORD('$password')";
	
	// execute query
	$result = mysqli_query($dbconn, $qry) or die('Query failed: ' . mysqli_error($dbconn));
	
	// if the username and password is correct
	// there will be exactly one record in employee table matching
	// this username and password
	if(mysqli_num_rows($result)==1)
	{		
		// get the employee details out
		$row = mysqli_fetch_assoc($result);			
		
		// add a new session variable and store the employee's
		//ID, Permission Level and Username to be used later
		/*$ID = $row[0];
		$Permission = $row[4];
		$User = $row[5];*/
		
		$_SESSION['UserID'] = $row['UID'];
		$_SESSION['permission'] = $row['PID'];
		$_SESSION['Username'] = $row['Username'];
		$_SESSION['department'] = $row['department'];
		
		// open the page where the employee can login.
		redirect_to("home.php");
		
		// stop execution of this page
		exit;
	}
	else
	{
		// go back to login form
		redirect_to("index.php");
		// stop this script here
		exit;
	}

    // free the result
    mysqli_free_result($result);
	// close the db connection
	mysqli_close($dbconn);


?>