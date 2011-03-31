<? 
$imagePath = $this->config->item('articleImage') ;
$defaultPicture = $this->config->item('defaultArticleImage');
$templateImage = $this->config->item('templateImage');
$currency = $this->config->item('currency');

$this->load->helper('form_helper');
?>


<div id="content_center">

<p id="content_center_title" ></p>
<h1> <?= $h1[0]->KategorieName ?> </h1>
        
        
        <div id="content_center_item">

		<? foreach ($content as $artikel): ?>
        <div id="content_center_item_left">
        <div id="content_center_item_left_upper">
        <center><img id="<?= "picture".$artikel->nummer; ?>" src="<? if (!empty($artikel->bildname))
			echo $imagePath.$artikel->bildname[0]; else echo $defaultPicture; ?>" height="111"> 
		</center>
        </div>
        <div id="content_center_item_left_lower">
        <center>
        	<? for ($i=0; $i<count($artikel->bildname);$i++){
        		if ($i>0) print ' | ';
        		print ('<a class="a2" href=\'javascript:changePic("picture'.$artikel->nummer.'","'.$imagePath.$artikel->bildname[$i].'") \'>'.($i+1)."</a>");
        	}
        	?>

        </center>
        </div>
        </div>
        <div id="content_center_item_right">
          <table border="0">
            <tr>
              <th colspan="4"><h2 align="left"><?= $artikel->bezeichnung?></h2></th>
              </tr>
            <tr>
              <td width="10"><img src="<?= $templateImage ?>feature_point.jpg"></td>
              <td width="155">Feature 1</td>
              <td width="10"><img src="<?= $templateImage ?>feature_point.jpg"></td>
              <td width="155">Feature 2</td>
            </tr>
            <tr>
<? // TODO: Feature points in seperate Table and parsing here; 
;?>
              <td><img src="<?= $templateImage ?>feature_point.jpg"></td>
              <td>Feature 3</td>
              <td><img src="<?= $templateImage ?>feature_point.jpg"></td>
              <td>Feature 4</td>
            </tr>
            <tr>
              <td><img src="<?= $templateImage?>feature_point.jpg"></td>
              <td>Feature 5</td>
              <td><img src="<?= $templateImage?>feature_point.jpg"></td>
              <td>Feature 6</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
            </tr>
          </table>
          <table width="348" border="0">
            <tr>
              <td width="60">Preis</td>
              <td width="103"><? echo $currency." ".sprintf("%01.2f", $artikel->preis)?></td>
              <td width="60">Verf.</td>
              <td width="107">
              <? for ($i=1; $i <= $artikel->verfuegbarkeit; $i++){
              		echo '<img src="'.$templateImage.'feature_point.jpg" alt="">';
              }
              ?>
              </td>
            </tr>
            <tr>
              <td width="60">Details</td>
              <td width="103"><img src="<?= $templateImage?>lupe.gif" height="16" width="16"></td>
              <td width="60">Kaufen</td>
              <? echo form_open('cart/add');?>
              
              <input type="hidden" name="article" value="<? echo htmlspecialchars(serialize($artikel))?>" />
			  <input type="hidden" name="currentSite" value="<?= current_url()?>" / >

              <td width="107"><input type="image" src="<?= $templateImage?>warenkorb3.jpg" height="13" width="16"></td>
              <? echo form_close();?>
            </tr>
          </table>
          </div>
        <div id="content_center_item_finish">
		<p>&nbsp;<p>
        </div>
        <?php endforeach?>
        </div>
        
		</div>
		
		<?

		
