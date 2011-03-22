
<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>
	

<?php echo form_open('register'); ?>

<h5>Benutzername:</h5>
<p><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('username'); ?></font>

<h5>Passwort:</h5>
<p><input type="password" name="password" value="" size="50" /></p>
<font color='red'><?php echo form_error('password'); ?></font>

<h5>Passwort wiederholen:</h5>
<p><input type="password" name="passwordconf" value="" size="50" /></p>
<font color='red'><?php echo form_error('passwordconf'); ?></font>

<h5>E-Mail:</h5>
<p><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('email'); ?></font>

<h5>Name:</h5>
<p><input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('lastname'); ?></font>

<h5>Vorname:</h5>
<p><input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('firstname'); ?></font>

<h5>Adresse:</h5>
<p><input type="text" name="address" value="<?php echo set_value('address'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('address'); ?></font>

<h5>Postleitzahl:</h5>
<p><input type="text" name="zipcode" value="<?php echo set_value('zipcode'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('zipcode'); ?></font>

<h5>Ort:</h5>
<p><input type="text" name="location" value="<?php echo set_value('location'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('location'); ?></font>

<h5>Telefon:</h5>
<p><input type="text" name="phone" value="<?php echo set_value('phone'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('phone'); ?></font>

<br><br>
<input type="submit" value="Senden" />

</form>

</div>











