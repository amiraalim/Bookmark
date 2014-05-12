<?php
/*** begin output buffering ***/
	ob_start();

	/*** include the header file ***/
	include 'includes/header.php';

	/*** check access level ***/
	if(!isset($_SESSION['Access_Level'], $_SESSION['UserID']))
	{
		header("Location: login.php");
		exit;
	}
	else
	{
		/*** check the form has been posted and the session variable is set ***/
		if(isset($_SESSION['form_token'], $_POST['BookmarkID'], $_POST['Title'], $_POST['URL'], $_POST['Tags']))
		{
				
				/*** if we are here, include the db connection ***/
				include 'includes/conn.php';

				/*** test for db connection ***/
				if($sql)
				{
					/*** escape the strings ***/
					$BookmarkID = mysqli_real_escape_string($sql,$_POST['BookmarkID']);
					$Title = mysqli_real_escape_string($sql,$_POST['Title']);
					$URL = mysqli_real_escape_string($sql,$_POST['URL']);
					$Tags = mysqli_real_escape_string($sql,$_POST['Tags']);
	
					/*** the sql query ***/
					$stmt = "UPDATE
						BookmarkList
						SET						
						Title = '{$Title}',
						URL = '{$URL}',
						Tags='{$Tags}'
						WHERE
						BookmarkID = $BookmarkID";

					/*** run the query ***/
					if(mysqli_query($sql,$stmt))
					{
						/*** unset the session token ***/
						unset($_SESSION['form_token']);

						echo 'Bookmark Updated Successfully';
					}
					else
					{
						echo 'Unable To Update Bookmark';
					}
				}
				else
				{
					echo 'Unable to process form';
				}
			
		}
		else
		{
			echo 'Invalid Submission';
		}
	}
	/*** include the footer.php file  ***/
    	include 'includes/footer.php';
?>