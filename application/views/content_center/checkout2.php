<? 
$currency = $this->config->item('currency'); 
$i = 1;
?>

<div id="content_center">
	<p id="content_center_title">
		<h1> <?=$title?> </h1>
	</p>

Name:
<p><input type="text" name="lastname" value="<?php echo $costumer->name; ?>" size="50" /></p>

Vorname:
<p><input type="text" name="firstname" value="<?php echo $costumer->vorname; ?>" size="50" /></p>

Adresse:
<p><input type="text" name="address" value="<?php echo $costumer->adresse; ?>" size="50" /></p>

Postleitzahl:
<p><input type="text" name="zipcode" value="<?php echo $costumer->plz; ?>" size="50" /></p>

Ort:
<p><input type="text" name="location" value="<?php echo $costumer->ort; ?>" size="50" /></p>

Telefon:
<p><input type="text" name="phone" value="<?php echo $costumer->telefon; ?>" size="50" /></p>

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
          <br>
          <a href="<?=site_url('cart/checkoutsuccess')?>">Bestellen!</a>
          
</div>
