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

    	/*** set the form action ***/
    	$bookmarkform_action = 'addbookmark_submit.php';

    	/*** set the form submit button value ***/
    	$bookmarkform_submit_value = 'Add Bookmark';
    	
    	/*** include the user form ***/
    	include 'includes/bookmark_form.php';

    	/*** include the footer.php file  ***/
    	include 'includes/footer.php';
    }
?>