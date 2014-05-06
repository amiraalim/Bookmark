<?php
error_reporting(E_ALL);
    /*** begin output buffering ***/
    ob_start();

    /*** begin session ***/
    session_start();
    
 
	/*** if we are here, include the db connection ***/
        include 'includes/conn.php';
		
	$errors = array();
    /*** check the form has been posted and the session variable is set ***/
    if(!isset($_SESSION['form_token']))
    {
        $location = 'login.php';
    }
    /*** check all fields have been posted ***/
    elseif(!isset($_POST['form_token'], $_POST['UserName'], $_POST['UserPassword']))
    {
        $location = 'login.php';
    }
    /*** check the form token is valid ***/
    elseif($_SESSION['form_token'] != $_POST['form_token'])
    {
        $location = 'login.php';
    }
    /*** check the length of the user name ***/
    elseif(strlen($_POST['UserName']) < 2 || strlen($_POST['UserName']) > 25)
    {
    	$errors[] = 'Invalid User Name';
        $location = 'login.php';
    }
    /*** check the length of the password ***/
    elseif(strlen($_POST['UserPassword']) < 8 || strlen($_POST['UserPassword']) > 25)
    {
    	$errors[] = 'Password is too short. Your password must be 8 to 32 characters long and contain number.';
        $location = 'login.php';
    }
    else
    {
    	 
        /*** escape all vars for database use ***/
        $UserName = mysqli_real_escape_string($sql,$_POST['UserName']);

        /*** encrypt the password ***/
        //$UserPassword = sha1($_POST['UserName']);
        $UserPassword = mysqli_real_escape_string($sql,$_POST['UserPassword']);

       
        /*** test for db connection ***/
        if($sql)
        {
            /*** check for existing username and password ***/
            $stmt = "SELECT
            UserID,
            UserName,
            UserPassword,
            Access_Level
            FROM
            Users
            WHERE
            UserName = '{$UserName}'
            AND
            UserPassword = '{$UserPassword}'
            AND
            Access_Level=1";
            $result = mysqli_query($sql,$stmt);
            if(mysqli_num_rows($result) != 1)
            {
            	$errors[] = 'Incorrect username and password. Please try again using correct username and password.';
                $location = 'login.php';
            }
            else
            {
                /*** fetch result row ***/
                $row = mysqli_fetch_array($result);

                /*** set the access level ***/
                $_SESSION['Access_Level'] = $row[3];
                
                /*** set the user id ***/
				$_SESSION['UserID'] = $row[0];
				
				   /*** set the user name ***/
				$_SESSION['UserName'] = $row[1];

                /*** unset the form token ***/
                unset($_SESSION['form_token']);

                /*** send user to index page ***/
                $location = 'index.php';
            }
        }
    }
/*** check if there are any errors in the errors array ***/
if(sizeof($errors) > 0)
{
	foreach($errors as $err)
	{
		include 'includes/header.php';
		echo $err,'<br />';		
		/*** include the footer file ***/		
		include 'includes/footer.php';
		
	}
	
}
else
{
	 /*** redirect ***/
	header("Location: $location");
}
   

    /*** flush the buffer ***/
    ob_end_flush();

?>