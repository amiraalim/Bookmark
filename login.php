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
<input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
<dl>
<dt>Username</dt>
<dd><input type="text" name="UserName" id="UserName" value="<?php echo isset($UserName) ? $UserName : ''; ?>" /></dd>

<dt>Password</dt>
<dd><input type="password" id="UserPassword" name="UserPassword" value="" /></dd>
<dd><input type="submit" value="Login" /></dd>
</dl>
</form>
<form></form>
<?php include 'includes/footer.php'; ?>
