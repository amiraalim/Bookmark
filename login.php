<?php
		include 'includes/conn.php';
        /*** start the session ***/
        	//session_start();

        /*** include the header file ***/
        include 'includes/header.php';

        /*** set a form token ***/
        $_SESSION['form_token'] = md5(rand(time(), true));
        
      
?>

<h1>Login</h1>
<p>
Please enter your username and password.
</p>


<form action="login_submit.php" method="post">

<table>
	<tr>
		<td><input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" /></td>
		
	</tr>
	<tr>
		<td>Username</td>
		<td><input type="text" name="UserName" id="UserName" value="<?php echo isset($UserName) ? $UserName : ''; ?>" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" id="UserPassword" name="UserPassword" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Login" /></td>
	</tr>
</table>

</form>

<?php include 'includes/footer.php'; ?>
