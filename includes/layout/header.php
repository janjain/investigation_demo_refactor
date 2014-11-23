<?php
	if(isset($_SESSION['Username']))
	{
		echo "Welcome," . " " . $_SESSION['Username'] . "<br />"; 
		echo "Did you know that today is " . date("m/d/Y") . "?" . "<br />";
		echo "You IDIOT!";
	}
	else
	{
		echo "";
	}
?>