<h2><?php echo isset($heading) ? $heading : ''; ?></h2>
<form action="<?php echo isset($bookmarkform_action) ? $bookmarkform_action : ''; ?>" method="post">	
	<table>
	<tr>
		<td><label for="Title">Title	: </label></td>
		<td><input type="text" id="Title" name="Title" value="<?php echo isset($Title) ? $Title : ''; ?>" /></td>
	</tr>
	<tr>
		<td><label for="URL">URL	:</label></td>
		<td><input type="text" id="URL" name="URL" value="<?php echo isset($URL) ? $URL : ''; ?>" /></td>
	</tr>
	<tr>
		<td><label for="Tags">Tags	:</label></td>
		<td><input type="text" id="Tags" name="Tags" value="<?php echo isset($Tags) ? $Tags : ''; ?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="<?php echo isset($bookmarkform_submit_value) ? $bookmarkform_submit_value : 'Submit'; ?>" /></td>
	</tr>
	
</table>
	<input type="hidden" name="form_token" value="<?php echo isset($form_token) ? $form_token : ''; ?>" />
	


