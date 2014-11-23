<?php require_once("includes/functions.php"); ?>
<?php require("includes/dbconn.php"); ?>
<?php require("includes/session.php") ?>

<?php
	
	// check if the user has logged in
	if(!Has_Session())					
	{
		redirect_to("index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<title>All users</title>
</head>

<body>
<?php
	//Restrict viewing of the reports
	if(!isAdmin())
	{
		printErrorMessage("Access denied.");		
		exit;
	}
?>
	<div id="width_control">
        <div id="container">
            <div id="header">
            	<?php
					include_once 'includes/layout/header.php';
				?>
            </div>	<!--end of hearder-->
            
            <div id="sidebar">
                <?php
					include_once 'includes/layout/nav.php';
				?>
            </div>	<!--end of sidebar-->
            
            <div id="contents">
            	
                <h4>All Users</h4>
                
                <div id="contents_placeholder">
					<table id="rprtTable" border="1" cellpadding="0" cellspacing="0">
					  <tbody>
						<tr>
							<td id="formHeader" colspan="2">Employee List</td>
						</tr>
						<tr><td><b>Employee Number</b></td><td><b>Name</b></td></tr>
					
					<?php // include the file that defines (contains) the username and password

						
						// build query
						$qry = "Select Fname, Lname, emp_num from users";
						
						//execute query
						$users = mysqli_query($dbconn, $qry) or die('Query failed: ' . mysqli_error($dbconn));
					
						// write a loop to print out the results.
						while ($line = mysqli_fetch_array($users, MYSQL_ASSOC)) 
						{ 
							echo "<tr><td>";
							echo "<a href=update_user.php?usernum=" . $line['emp_num'] .
								">" . $line['emp_num'] . "</a></td>";
							echo "<td>" . $line['Fname'] . " "; 
							echo "" . $line['Lname'] . "</td></tr>";		
						}
						
						/*while ($line = mysqli_fetch_array($users, MYSQL_ASSOC)) 
						{ 
							echo "<tr><td size=30>";
							echo "<a href=#" .
								">" . $line['emp_num'] . "</a></td>";
							echo "<td>" . $line['Fname'] . " "; 
							echo "" . $line['Lname'] . "</td></tr>";		
						}*/

						// close connection	
						mysqli_close($dbconn);
					?>
					  </tbody>
					</table>
                </div>
                
            </div>	<!--end of contents-->
            
            <div id="footer">
                <p>Copyright&copy; 2014 OAG Investigation Unit</p>
            </div>	<!--end of footer-->
        </div>		<!--end of container-->
    </div>	<!--end of width_control-->
	<script type="text/javascript">
	    var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
    </script>
</body>
</html>