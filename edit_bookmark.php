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
		/*** set the token to prevent multiple posts ***/
		$form_token = uniqid();
		$_SESSION['form_token'] = $form_token;

		/*** check the bookmark id is set and is a number ***/
		if(isset($_GET['bid']) && is_numeric($_GET['bid']))
		{
			/*** get the categories from the database ***/
			include 'includes/conn.php';

			/*** check for database connection ***/
			if($sql)
			{
				$BookmarkID = mysqli_real_escape_string($sql,$_GET['bid']);
				$stmt = "SELECT
					bookmarklist.BookmarkID,
					bookmarklist.Title,
					bookmarklist.URL,
					bookmarklist.Tags					
					FROM
					bookmarklist,		
					bookmark_user					
					WHERE
					bookmarklist.BookmarkID = $BookmarkID";				

				/*** run the query ***/
				$result = mysqli_query($sql,$stmt) or die(mysqli_error());

				/*** check for a valid resource ***/
				if(!is_resource($result))
				{
					echo 'Unable to fetch bookmark record';
				}
				else
				{
					/*** check there is a blog entry ***/
					if(mysqli_num_rows($result) != 0)
					{
						while($row = mysqli_stmt_num_rows($result))
						{
							$heading = 'Edit Bookmark';	
							$bookmarkform_action = 'edit_bookmark_submit.php';
							$selected = $row['BookmarkID'];	
							$BookmarkID =$row['BookmarkID'];			
							$Title = $row['Title'];
							$URL = $row['URL'];
							$Tags = $row['Tags'];
							$bookmarkform_submit_value = 'Update';
						}
						/*** include the blog form ***/
						include 'includes/editbookmark_form.php';
					}
					else
					{
						echo 'No bookmark found';
					}
				}
			}
		}
		else
		{
			/*** if we are here the database connection has failed ***/
			echo 'Unable to complete request';
		}
	
		/*** include the footer ***/
		include 'includes/footer.php';
	}
?>