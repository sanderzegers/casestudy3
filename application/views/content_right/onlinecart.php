<? 
$templateImage = $this->config->item('templateImage');
$username = $this->session->userdata('name');
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
                <td colspan="3"><b><?= $username?></b></td>
              </tr>
                <tr>
                <td colspan="3"><a href="<?=site_url('login/logout')?>">Abmelden</a></td>
              </tr>
              </tr>
                <tr>
                <td colspan="3">Einstellungen ändern</td>
              </tr>
              </tr>
                <tr>
                <td colspan="3">---------------</td>
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
