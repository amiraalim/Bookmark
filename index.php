<?php include("includes/header.php");	
/*** include the database connection ***/
	include 'includes/conn.php';
	if(isset($_SESSION['Access_Level']) && $_SESSION['Access_Level'] == 1)
	{
		$Access_Level=$_SESSION['Access_Level'];
		$UserName= $_SESSION['UserName'];
		echo'Welcome to Bookmark App ','<b>'.$UserName.'</b>'; 
		
	}
?>

<?php include("includes/footer.php"); ?>