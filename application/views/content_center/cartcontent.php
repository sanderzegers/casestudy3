<?
$currency = $this->config->item('currency');
$templateImage = $this->config->item('templateImage');

$i = 1;

$this->load->helper('form_helper');

?>

<div id="content_center">
<p id="content_center_title">
        <h1> <?=$title?> </h1>
        </p>
		<? foreach ($myCart->getContent() as $position): ?>
        
        <div id="content_center_wk">
          <table width="527" border="0">
            <tr>
              <td width="20"><? echo $i++;?></td>
              
              <td width="277"><?= $position["artikel"]->bezeichnung?></td>
              <? echo form_open('cart/action');?>
              <input type="hidden" name="article" value="<? echo htmlspecialchars(serialize($position["artikel"]))?>" />
			  <input type="hidden" name="currentSite" value="<?= current_url()?>" / >
              <input type="hidden" name="actionType" value="remove"/>
              <td width="20"><input type="image" src="<?= $templateImage ?>wk_delete.jpg" width="10" height="10"></td>
              <? echo form_close();?>
              <? echo form_open('cart/action');?>
              <input type="hidden" name="article" value="<? echo htmlspecialchars(serialize($position["artikel"]))?>" />
			  <input type="hidden" name="currentSite" value="<?= current_url()?>" / >
			  <input type="hidden" name="actionType" value="add"/>
              <td width="20"><input type="image" src="<?= $templateImage ?>wk_add.jpg" width="10" height="10"></td>
              <? echo form_close();?>
              <? echo form_open('cart/action');?>
              <input type="hidden" name="article" value="<? echo htmlspecialchars(serialize($position["artikel"]))?>" />
			  <input type="hidden" name="currentSite" value="<?= current_url()?>" / >
			  <input type="hidden" name="actionType" value="subtract"/>
              <td width="20"><input type="image" src="<?= $templateImage ?>wk_rem.jpg" width="10" height="10"></td>
              <? echo form_close();?>
              <td width="70"><?= $position["menge"]?>. Stk</td>
              <td width="70"><?= $currency." ".sprintf("%01.2f", $position["artikel"]->preis*$position["menge"])?></td>
            </tr>

          </table>
        </div>
        <div id="content_center_wk_footer">
        &nbsp;
        </div>
        <?php endforeach?>
          Total: <?= $currency." ".sprintf("%01.2f", $myCart->getTotalValue());?>
          <br><br>
          <a href="<?=site_url('cart/destroy')?>">Warenkorb leeren</a>
          <br>
          <a href="<?=site_url('cart/checkout')?>">Zur Kasse</a>
          
	  </div>
