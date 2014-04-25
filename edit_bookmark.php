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
				$stmt = "SELECT BookmarkList.BookmarkID, BookmarkList.Title, BookmarkList.URL, BookmarkList.Tags					
					FROM
					BookmarkList Join Bookmark_User					
					ON BookmarkList.BookmarkID = Bookmark_User.BookmarkID
					AND
					Bookmark_User.BookmarkID = $BookmarkID";				

				/*** run the query ***/
				$result = mysqli_query($sql,$stmt);
				$row = mysqli_num_rows($result);

					/*** check there is a bookmark details ***/
					if(mysqli_num_rows($result) != 0)
					{
						while($row = $result->fetch_assoc())
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
		
	
		/*** include the footer ***/
		include 'includes/footer.php';
	}
?>