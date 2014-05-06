<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PHP Bookmark</title>

<style type="text/css">


</style>
<h2><?php echo isset($heading) ? $heading : ''; ?></h2>
<form action="<?php echo isset($form_action) ? $form_action : ''; ?>" method="post">
<table>
	<tr>
		<td><label for="UserName">Username</label></td>
		<td><input type="text" id="UserName" name="UserName" value="<?php echo isset($UserName) ? $UserName : ''; ?>" maxlength="20" /></td>		
	</tr>
	<tr>
		<td><label for="lblPassword">Password</label></td>
		<td><input type="password" id="UserPassword" name="UserPassword" value="" maxlength="20" /></td>
		
	</tr>
	<tr>
	<td></td>
		<td><label>Password (8 characters or more, no spaces)</label></td>
	</tr>
	<tr>
		<td><label for="UserEmailAddress">Email Address</label></td>
		<td><input type="text" id="UserEmailAddress" name="UserEmailAddress" value="<?php echo isset($UserEmailAddress) ? $UserEmailAddress : ''; ?>" maxlength="254" /></td>
	</tr>
	<tr>
		<td><label for="FirstName">First Name</label></td>
		<td><input type="text" id="FirstName" name="FirstName" value="<?php echo isset($FirstName) ? $FirstName : ''; ?>"/></td>
	</tr>
	<tr>
		<td><label for="LastName">Last Name</label></td>
		<td><input type="text" id="LastName" name="LastName" value="<?php echo isset($LastName) ? $LastName: ''; ?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="<?php echo isset($submit_value) ? $submit_value : 'Submit'; ?>" /></td>
	</tr>
	
</table>

<input type="hidden" name="form_token" value="<?php echo isset($form_token) ? $form_token : ''; ?>" />