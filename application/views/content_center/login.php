
<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>
	
	
<?php echo validation_errors(); ?>

<?php echo form_open('login/send'); ?>


<h5>Username</h5>
<input type="text" name="username" value="" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</div>


