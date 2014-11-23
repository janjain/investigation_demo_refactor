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
	
	// extract employee number
	$empnum = $_GET['usernum'];
	
	$qry="Select * from users where emp_num = '$empnum'";
	
	$result = mysqli_query($dbconn, $qry) or die('Query failed: ' . mysqli_error($dbconn));
	
	if (!$result or mysqli_num_rows($result)> 1)
	{
		echo "No such user";
		mysqli_close($dbconn);
		die();
	}
	
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<!--javascript function to check if fields are empty-->
<script language="javascript">
function Validate() {

	lastname = document.employeeupdate.lastname.value

	if (lastname == "")
	{
		Message = "Please enter the last name" + "\n"
		alert(Message)
		return false
	}
	else
	{
		Message = ""
		document.employeeadd.submit()
		return true
	}
}
</script>



<title>Update User Information</title>
</head>

<body>
	
	<?php
		//Restrict viewing of the reports		
		if(!isAdmin())
		{
			printErrorMessage("Access Denied.");
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
            	
                <h4>Update User Information</h4>
                
                <div id="contents_placeholder">
                	<form name="userAdd" action="userUpdate.php" method="post"> 
                        <table id="formTable" border="0" cellpadding="2" cellspacing="2">
                    		<tbody>
                    			<tr>
                    				<td style="font-family: Verdana; width: 237px;">User ID:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="30" name="userid" readonly value='<?php echo $row['UID']; ?>'></td>
                         		</tr>
								
                                <tr>
                    				<td style="font-family: Verdana; width: 237px;">Employee Number:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="30" name="usernum" value='<?php echo $row['emp_num']; ?>'></td>
                         		</tr>
                                
                                <tr>
                                    <td style="font-family: Verdana; width: 237px;">First Name:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="20" name="firstname" value='<?php echo $row['Fname']; ?>'></td>
                              	</tr>
                                
                          		<tr>
                                	<td style="font-family: Verdana; width: 237px;">Last Name:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="20" name="lastname" value='<?php echo $row['Lname']; ?>'></td>
                    	 		</tr> 
                                
                                <tr>
                                	<td style="font-family: Verdana; width: 237px;">Job Title:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="20" name="title" value='<?php echo $row['JobTitle']; ?>'></td>
                    	 		</tr>
								
								<tr>
                                	<td style="font-family: Verdana; width: 237px;">Department:</td>
                                    <td style="width: 460px;">
										<select size="1" name="department">
											<option value="1">Investigation</option>
											<option value="2">Performance</option>
											<option value="3">Financial</option>
										</select>
									</td>
                    	 		</tr>
                                
                                <tr>
                                	<td style="font-family: Verdana; width: 237px;">Permission Level:</td>
                                    <td style="width: 460px;">
                                    	<select size="1" name="permission">
                    						<?php // fill job list box with job titles 
                        					$permissions = mysqli_query($dbconn, "select * from permissions") or die('Query failed: ' . mysqli_error($dbconn));
                        
											while ($line = mysqli_fetch_array($permissions)) 
											{ 
												echo "<option value='" . $line['PID'] . "'>"; 
												echo $line['Description'] . "</option>"; 
											} 
											?>
                            			</select>
                                       </td>
                          		</tr>
                    			
                                <tr>
                                	<td style="font-family: Verdana; width: 237px;">Username:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="20" name="username" value='<?php echo $row['Username']; ?>'></td>
                               	</tr>
                    			
                                <tr>
                                	<td style="font-family: Verdana; width: 237px;">Password:</td>
                                    <td style="width: 460px;"><input maxlength="30" size="20" name="password"></td>
                               	</tr>
                    
              					<tr style="font-family: Verdana;">
                                	<td style="text-align: center; width: 440px;" colspan="2" rowspan="1"><input value="Reset" name="Reset " type="reset"> &nbsp;<input value="Save" name="Save" onclick="Validate();return false;" type="submit">&nbsp; </td>
                                </tr>
                     		</tbody>
                      </table>
              	</form>
                	
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