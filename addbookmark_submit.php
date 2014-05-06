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
		/*** check all fields have been posted ***/
		if(!isset($_POST['form_token'], $_POST['Title'], $_POST['URL'], $_POST['Tags']))
		{
    			$errors[] = 'All fields must be completed';
		}
		/*** check the form token is valid ***/
		elseif($_SESSION['form_token'] != $_POST['form_token'])
		{
    		$errors[] = 'You may only post once';
		}
		else
		{
			 /*** if we are here, include the db connection ***/
    		include 'includes/conn.php';
    		
    		if($sql)
    		{
    			/*** escape the strings ***/
    			$UserID= $_SESSION['UserID'];    			
    			$Title = mysqli_real_escape_string($sql,$_POST['Title']); 		    		
				$URL = mysqli_real_escape_string($sql,$_POST['URL']);
    			$Tags = mysqli_real_escape_string($sql,$_POST['Tags']);
    			
				/*** the sql query to insert into table bookmarklist ***/
				$stmt = "INSERT
                INTO
                BookmarkList(
                Title,
                URL,
                Tags)
                VALUES (
                '{$Title}',
                '{$URL}',
                '{$Tags}')";
                
                if (mysqli_query($sql,$stmt))
                {
                	 $result=mysqli_affected_rows($sql);
                	 //$inserteddata = mysqli_stmt($stmt);
                	 
					if($result > 0)
					{
						//printf ("New Record has id %d.\n", mysqli_insert_id($sql));
						$BookmarkID = mysqli_insert_id($sql);							
						$stmt2 = "SELECT * FROM Bookmark_User WHERE bookmarkID ='{$BookmarkID}'";
						$result2 = mysqli_query($sql,$stmt2);
						/*** the sql query to insert into table bookmark_user  ***/
						$stmt3 = "INSERT INTO Bookmark_User(BookmarkID,UserID) values ('{$BookmarkID}','{$UserID}')";
						if (mysqli_query($sql,$stmt3))
						{
							echo 'Bookmark Added';
							/*** unset the form token ***/
               				unset($_SESSION['form_token']);
                			/*** send user to index page ***/
                			$location = 'index.php';
						}
						else
						{
							echo 'Bookmark User Cannot be Added';
						}
						
					}
					else
					{
						// no record inserted, therefore error condition exists
          				echo "No record inserted. Cannot proceed.";
          				$error = TRUE;
					}
						
				}
				else
				{
					echo 'Bookmark Not Added' .mysqli_error();
				}
					                
			}
			
			else
			{
				echo 'Unable to process form';
			}
			
			
		}
		
		
	}
?>