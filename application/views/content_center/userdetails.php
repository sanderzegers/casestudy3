
<div id="content_center">
	<p id="content_center_title">
		<h1>Benutzer einstellungen </h1>
	</p>
	


<h2>Passwort ändern</h2>

<?php echo form_open('register/userdetails/password'); ?>

<input type="hidden" name="username" value ="<?= $costumer->benutzername?>" />
<h5>Altes Password:</h5>
<p><input type="password" name="password" value="" size="50" /></p>
<font color='red'><?php echo form_error('password'); ?></font>
<font color='red'><?php echo form_error('username'); ?></font>

<h5>Passwort:</h5>
<p><input type="password" name="newpassword" value="" size="50" /></p>
<font color='red'><?php echo form_error('newpassword'); ?></font>

<h5>Passwort wiederholen:</h5>
<p><input type="password" name="newpasswordconf" value="" size="50" /></p>
<font color='red'><?php echo form_error('newpasswordconf'); ?></font>
<br>
<input type="submit" value="Senden" />
</form>
<br><br>



<h2>Adresse ändern</h2>

<?php echo form_open('register/userdetails/address'); ?>


<h5>E-Mail:</h5>
<p><input type="text" name="email" value="<?php echo set_value('email',$costumer->email); ?>" size="50" /></p>
<font color='red'><?php echo form_error('email'); ?></font>

<h5>Name:</h5>
<p><input type="text" name="lastname" value="<?php echo set_value('lastname',$costumer->name); ?>" size="50" /></p>
<font color='red'><?php echo form_error('lastname'); ?></font>

<h5>Vorname:</h5>
<p><input type="text" name="firstname" value="<?php echo set_value('firstname',$costumer->vorname); ?>" size="50" /></p>
<font color='red'><?php echo form_error('firstname'); ?></font>

<h5>Adresse:</h5>
<p><input type="text" name="address" value="<?php echo set_value('address',$costumer->adresse); ?>" size="50" /></p>
<font color='red'><?php echo form_error('address'); ?></font>

<h5>Postleitzahl:</h5>
<p><input type="text" name="zipcode" value="<?php echo set_value('zipcode',$costumer->plz); ?>" size="50" /></p>
<font color='red'><?php echo form_error('zipcode'); ?></font>

<h5>Ort:</h5>
<p><input type="text" name="location" value="<?php echo set_value('location',$costumer->ort); ?>" size="50" /></p>
<font color='red'><?php echo form_error('location'); ?></font>

<h5>Telefon:</h5>
<p><input type="text" name="phone" value="<?php echo set_value('phone',$costumer->telefon); ?>" size="50" /></p>
<font color='red'><?php echo form_error('phone'); ?></font>

<br>
<input type="submit" value="Senden" />

</form>

</div>



