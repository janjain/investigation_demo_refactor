<?php require_once("includes/functions.php"); ?>
<?php require("includes/session.php"); ?>

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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<title>Home</title>
</head>

<body>
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
            	
                <h4>Descriptions for the menu items go here</h4>
                
                <div>
                	
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