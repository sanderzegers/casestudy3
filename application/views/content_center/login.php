
<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>
	
	
<?php echo form_open('login'); ?>


<h5>Benutzername</h5>
<input type="text" name="username" value="<?= set_value('username')?>" size="50"/>

<h5>Passwort</h5>
<input type="password" name="password" value="" size="50" />


<p><div><input type="submit" value="Senden" /></div></p>

<br>
<p><font color='red'> <?= validation_errors() ?> </font></p>

</form>

</div>


