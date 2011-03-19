<? 
$currency = $this->config->item('currency');
$costumer = $this->session->userdata('costumer');
$templateImage = $this->config->item('templateImage');

?>
		
		<div id="content_right">
			<div id="content_right_top">
				<div id="content_right_top_title">
				Product of the Day
				</div>
			<div id="content_right_top_image">
				<IMG SRC="<?= $templateImage ?>potd/potd2.jpg">				
			</div>
		</div>
				
		<div id="content_right_center">
		</div>
		<div id="content_right_bottom1">
			<div id="content_right_bottom2">
				<div id="content_right_bottom3">
					<p id="text_content">
						<p id="text_content" class="level1r">Warenkorb</p>
							<table width="130" border="0" align="center">
              				  <tr>
                <td colspan="3">&nbsp;</td>
                </tr>

              <tr>
                <td colspan="3">Angemeldet als:</td>
              </tr>
               <tr>
                <td colspan="3"><b><?= $costumer->benutzername?></b></td>
              </tr>
                <tr>
                <td colspan="3"><a href="<?=site_url('login/logout')?>">Abmelden</a></td>
              </tr>
                <tr>
                <td colspan="3">Einstellungen ändern</td>
              </tr>
               </tr>
                
              <tr>
                <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="3"><a href="<?=site_url('cart/show')?>">Warenkorb</a></td>
              </tr>
              
                <tr>
                <td colspan="3">---------------</td>
              </tr>
            
              
                           
              
              <? foreach ($myCart->getContent() as $position): ?>
              
              
            
             
              <tr>
              <td colspan="3"><?= $position["artikel"]->bezeichnung?></td>
              </tr>
               <tr>

                
                <td><?= $position["menge"]?> Stk</td>
                <td><?= $currency." ".sprintf("%01.2f", $position["artikel"]->preis*$position["menge"])?></td>
              </tr>
              
              <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
              
              <?php endforeach?>
               </tr>
                <tr>
                <td colspan="3">---------------</td>
              </tr>
			  <tr>
			  <td colspan="3"> Total: <?= $currency." ".sprintf("%01.2f", $myCart->getTotalValue());?> </td></tr>
				<tr>
                <td colspan="3">&nbsp;</td>
              </tr>
                 <tr>
                <td colspan="3"><a href="<?=site_url('cart/checkout')?>">Zur Kasse</a></td>
              </tr>
							</table>
							</p>
							
						</p>
					</p>
				</div> 
			</div>  
		</div>  
	   	</div>
		</div>
