
<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>
	
	
<?php //echo validation_errors(); ?>

<?php echo form_open('register'); ?>

Benutzername:
<p><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('username'); ?></font>

Passwort:
<p><input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('password'); ?></font>

Passwort wiederholen:
<p><input type="text" name="passwordconf" value="<?php echo set_value('passwordconf'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('passwordconf'); ?></font>

E-Mail:
<p><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('email'); ?></font>

Telefon:
<p><input type="text" name="phone" value="<?php echo set_value('phone'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('phone'); ?></font>

Name:
<p><input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('lastname'); ?></font>

Vorname:
<p><input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('firstname'); ?></font>

Adresse:
<p><input type="text" name="address" value="<?php echo set_value('address'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('address'); ?></font>

Postleitzahl:
<p><input type="text" name="zipcode" value="<?php echo set_value('zipcode'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('zipcode'); ?></font>

Ort:
<p><input type="text" name="location" value="<?php echo set_value('location'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('location'); ?></font>


<br><br>
<br>



<p><div><input type="submit" value="Senden" /></div></p>

</form>

</div>


