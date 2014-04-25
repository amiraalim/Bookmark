<?php
error_reporting(E_ALL);

/*** begin session ***/
session_start();

/*** include the header file ***/

include 'includes/header.php';

/*** an array to hold errors ***/
$errors = array();

/*** check the form has been posted and the session variable is set ***/
if(!isset($_SESSION['form_token']))
{
    $errors[] = 'Invalid Form Token';
}
/*** check all fields have been posted ***/
elseif(!isset($_POST['form_token'], $_POST['UserName'], $_POST['UserPassword'], $_POST['UserEmailAddress'], $_POST['FirstName'],$_POST['LastName']))
{
    $errors[] = 'All fields must be completed';
}
/*** check the form token is valid ***/
elseif($_SESSION['form_token'] != $_POST['form_token'])
{
    $errors[] = 'You may only post once';
}
/*** check the length of the user name ***/
elseif(strlen($_POST['UserName']) < 2 || strlen($_POST['UserName']) > 25)
{
    $errors[] = 'Invalid User Name';
}
/*** check the length of the UserPassword ***/
elseif(strlen($_POST['UserPassword']) <= 8 || strlen($_POST['UserPassword']) > 25)
{
    $errors[] = 'Invalid Password';
}
/*** check the length of the users email ***/
elseif(strlen($_POST['UserEmailAddress']) < 4 || strlen($_POST['UserEmailAddress']) > 254)
{
    $errors[] = 'Invalid Email';
}
/*** check for email valid email address ***/
elseif(!preg_match("/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU", $_POST['UserEmailAddress']))
{
	$errors[] = 'Email Invalid';
}

else
{
	
    /*** if we are here, include the db connection ***/
    include 'includes/conn.php';
    /*** escape all vars for database use ***/
    $UserName = mysqli_real_escape_string($sql,$_POST['UserName']);
    /*** encrypt the password ***/
   /** $UserPassword = sha1($_POST['UserPassword']);***/
    $UserPassword = mysqli_real_escape_string($sql,$_POST['UserPassword']);
    /*** strip injection chars from email ***/   
	$UserEmailAddress =  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $_POST['UserEmailAddress'] );
	$UserEmailAddress = mysqli_real_escape_string($sql,$UserEmailAddress); 
    $FirstName = mysqli_real_escape_string($sql,$_POST['FirstName']);
    $LastName = mysqli_real_escape_string($sql,$_POST['LastName']);
    $Access_Level=1;

    if($sql)
{
	 /*** the sql query ***/
            $stmt = "INSERT
                INTO
                Users(
                UserName,
                UserPassword,
                UserEmailAddress,
                FirstName,
                LastName,
                Access_Level)
                VALUES (
                '{$UserName}',
                '{$UserPassword}',
                '{$UserEmailAddress}',
                '{$FirstName}',
                '{$LastName}',
                {$Access_Level})";
                
                
        	
			/*** run the query ***/
			if(mysqli_query($sql,$stmt))
			{
				/*** unset the session token ***/
				unset($_SESSION['token']);
				printf("%d Row inserted.\n", mysqli_affected_rows($sql));
				echo 'User Added.';
				/*** unset the form token ***/
				unset($_SESSION['form_token']);
			}
			else
			{
				$errors[] = 'User Not Added';
			}
			
	}
	else
	{
		$errors[] = 'Unable to process form';
	}
 }
/*** check if there are any errors in the errors array ***/
if(sizeof($errors) > 0)
{
	foreach($errors as $err)
	{
		echo $err,'<br />';
	}
}
else
{
	echo ' Sign up complete<br />';	
}

	
	


    
           
		
	


/*** include the footer file ***/
include 'includes/footer.php';

?>