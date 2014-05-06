<?php
/*** begin output buffering ***/
	ob_start();

	/*** include the header file ***/
	include 'includes/header.php';
	if(!isset($_SESSION['Access_Level']) || $_SESSION['Access_Level'] < 1)
	{
		/*** if not logged in, forward to login page ***/
		header("Location: login.php");
		exit;
	}
	
	else
	{
		/*** include the database connection ***/
		include 'includes/conn.php';
		$UserID= $_SESSION['UserID'];
		/*** check for valid database connection ***/
		if($sql)
		{
			/*** the SQL query to select last 5 blogs ***/
			$stmt = "SELECT BookmarkList.BookmarkID, BookmarkList.Title, BookmarkList.URL, BookmarkList.Tags 
			FROM Bookmark_User,BookmarkList
			where BookmarkList.BookmarkID = Bookmark_User.BookmarkID
			and Bookmark_User.UserID = {$UserID}";

			
			/*** run the query ***/
			$result = mysqli_query($sql,$stmt);
			$row = mysqli_fetch_row($result);
    
				if($result = mysqli_query($sql,$stmt))
				{
					$bookmark_array = array();
					$colNames = array();
					while($row = $result->fetch_assoc())
					{
						$bookmark_array[] = $row;
					}
					
					
				}
				else
				{
					echo 'No bookmark found';
				}
		}
			
		
		else
		{
			$errors[] = 'Unable to process form';
		}
		
		
	}

?>

<h3>My Bookmark List</h3>
<!DOCTYPE html>
<html>

<head>
<style>
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}
th,td
{
padding:5px;
}
</style>
</head>

<?php			
	/*** loop over the blog array and display blogs ***/
	?>
	<table style="width:400px">
		<tr>
  			<th>Title</th>
  			<th>URL</th>		
  			<th>Tags</th>
  			<th>Edit</th>
  			<th>Delete</th>
  			</tr>

    <?php
       //print the rows
      
       foreach($bookmark_array as $row)
       {
          echo'
  		<tr>
	   <tr>	   
		<td>'.$row['Title'].'</td>
		<td>'.$row['URL'].'</td>
		<td>'.$row['Tags'].'</td>
		<td><a href="edit_bookmark.php?bid='.$row['BookmarkID'].'">Edit</a></td>
		<td><a href="del_bookmark.php?bid='.$row['BookmarkID'].'" onclick="return confirm(\'Are you sure?\')">Delete</a></td>
	  </tr>
	  ';
       }
       
       				
		
    ?>
 </table>


