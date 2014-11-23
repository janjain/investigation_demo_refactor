<?php

    function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed.");
        }
    }

    function mysql_prep($string) {
        global $db;

        $escaped_string = mysqli_real_escape_string($db, $string);
        return $escaped_string;
    }

    function redirect_to($new_location) {
        header("Location: " . $new_location);
        exit;
    }

    
    //function to clean all submitted data
    function clean_it($str)
    {
        $str=trim($str);
        $str=addslashes($str);
        return $str;
    }
    // start the session - this has to be done in all scripts that use $_SESSION array
    //session_start();

    // function to check if the user has logged in. If user has loged in then this function
    // returns a true
    function Has_Session()
    {
        if(!isset($_SESSION['UserID']) or
            $_SESSION['UserID'] == "")
        {
            return false;
        }
        else if(!isset($_SESSION['permission']) or
            $_SESSION['permission'] == "")
        {
            return false;
        }
        else if(!isset($_SESSION['Username']) or
            $_SESSION['Username'] == "")
        {
            return false;
        }
		else if(!isset($_SESSION['department']) or
            $_SESSION['department'] == "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //function to check whether the current is an administrator
    function isAdmin()
    {
        if($_SESSION['permission'] == '3' || $_SESSION['permission'] == '4')
            return true;
        else
            return false;
    }

    function isSuperAdmin()
    {
        if( $_SESSION['permission'] =='1')
            return true;
        else
            return false;
    }

    /*function isAccountant()
    {
        if($_SESSION['jobid'] =='J01' || $_SESSION['jobid'] == 'J03')
            return true;
        else
            return false;
    }*/

    //function to print message
    function printErrorMessage($message)
    {
        echo "<center><table><tr><td><b>$message" .
            "</b></td></tr></table></center>";
    }

?>