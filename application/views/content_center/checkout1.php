<? 
$currency = $this->config->item('currency'); 
$i = 1;

?>

<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>
	
<?php echo form_open('cart/checkout1'); ?>
<h2> Adresse</h2>
Name:
<p><input type="text" name="lastname" value="<?= set_value('lastname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('lastname'); ?></font>

Vorname:
<p><input type="text" name="firstname" value="<?= set_value('firstname'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('firstname'); ?></font>

Adresse:
<p><input type="text" name="address" value="<?= set_value('address'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('address'); ?></font>

Postleitzahl:
<p><input type="text" name="zipcode" value="<?= set_value('zipcode'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('zipcode'); ?></font>

Ort:
<p><input type="text" name="location" value="<?= set_value('location'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('location'); ?></font>

Telefon:
<p><input type="text" name="phone" value="<?= set_value('phone'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('telefon'); ?></font>

Email:
<p><input type="text" name="email" value="<?= set_value('email'); ?>" size="50" /></p>
<font color='red'><?php echo form_error('email'); ?></font>

<br>
<br>
<h2>Warenkorb</h2>

<? foreach ($myCart->getContent() as $position): ?>
        
        <div id="content_center_wk">
          <table width="527" border="0">
            <tr>
              <td width="20"><? echo $i++;?></td>
              
              <td width="277"><?= $position["artikel"]->bezeichnung?></td>

              <td width="70"><?= $position["menge"]?>. Stk</td>
              <td width="70"><? echo $currency." ".sprintf("%01.2f", $position["artikel"]->preis*$position["menge"])?></td>
            </tr>

          </table>
        </div>
        <div id="content_center_wk_footer">
        &nbsp;
        </div>
        <?php endforeach?>
         <div id="content_center_wk">
         <table width="527" border="0">
         <tr>
         <td width="20"><? echo $i++;?></td>
         <td width="277">Gratis Versand</td>
         <td width="70"><?= 1?>. Stk</td>
         <td width="70"><? echo $currency." ".sprintf("%01.2f", 0)?></td>
         </tr>
         </table>
         </div>
         <div id="content_center_wk_footer">
        &nbsp;
        </div>
         
              
          Total: <?= $currency." ".sprintf("%01.2f",$myCart->getTotalValue()) ?>
          <br><br>
          <input type="submit" value="Senden" />

</form>

          
</div>
