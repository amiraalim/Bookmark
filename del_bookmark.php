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
		if(isset($_GET['bid']) && is_numeric($_GET['bid']))
		{
			/*** if we are here, include the db connection ***/
			include 'includes/conn.php';

			/*** test for db connection ***/
			if($sql)
			{
				/*** excape the string ***/
				$BookmarkID = mysqli_real_escape_string($sql,$_GET['bid']);
				$UserID = mysqli_real_escape_string($sql,$_SESSION['UserID']);
				/*** the sql query ***/
				$stmt = "DELETE	FROM BookmarkList,Bookmark_User WHERE BookmarkList.BookmarkID=Bookmark_User.BookmarkID AND	BookmarkList.BookmarkID = $BookmarkID AND Bookmark_User.UserID = $UserID";				
				

				/*** run the query ***/
				if(mysqli_query($sql,$stmt))
				{
					/*** affected rows ***/
					$affected = mysqli_affected_rows($sql);
					header("Location: list_bookmark.php");
				}
				else
				{
					echo 'Bookmark Not Deleted';
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
?>
