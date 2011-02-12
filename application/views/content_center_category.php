<div id="content_center">

<p id="content_center_title" ></p>
<h1> <? echo $h1[0]->KategorieName ?> </h1>
        
        
        <div id="content_center_item">

		<? foreach ($content as $artikel): ?>
        <div id="content_center_item_left">
        <div id="content_center_item_left_upper">
        <center><img src="<? if (!empty($artikel->BildName))
			echo "/articleimages/".$artikel->BildName; else echo "/Images/products/mouse1.jpg"; ?>" height="111"> 
		</center>
        </div>
        <div id="content_center_item_left_lower">
        <center>
        	<a class="a2" href="products.html">1</a> | 
            <a class="a2" href="products.html">2</a> | 
            <a class="a2" href="products.html">3</a>
        </center>
        </div>
        </div>
        <div id="content_center_item_right">
          <table border="0">
            <tr>
              <th colspan="4"><h2 align="left"><? echo $artikel->ArtikelBezeichnung?></h2></th>
              </tr>
            <tr>
              <td width="10"><img src="/Images/feature_point.jpg"></td>
              <td width="155">Feature 1</td>
              <td width="10"><img src="/Images/feature_point.jpg"></td>
              <td width="155">Feature 2</td>
            </tr>
            <tr>
              <td><img src="/Images/feature_point.jpg"></td>
              <td>Feature 3</td>
              <td><img src="/Images/feature_point.jpg"></td>
              <td>Feature 4</td>
            </tr>
            <tr>
              <td><img src="/Images/feature_point.jpg"></td>
              <td>Feature 5</td>
              <td><img src="/Images/feature_point.jpg"></td>
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
              <td width="103"><? echo sprintf("%01.2f", $artikel->ArtikelPreis)?></td>
              <td width="60">Verf.</td>
              <td width="107"><img src="/Images/feature_point.jpg" alt=""><img src="/Images/feature_point.jpg" alt=""><img src="/Images/feature_point.jpg" alt=""><img src="/Images/feature_point.jpg" alt=""><img src="/Images/feature_point.jpg" alt=""></td>
            </tr>
            <tr>
              <td width="60">Details</td>
              <td width="103"><img src="/Images/lupe.gif" height="16" width="16"></td>
              <td width="60">Kaufen</td>
              <td width="107"><img src="/Images/warenkorb3.jpg" height="13" width="16"></td>
            </tr>
          </table>
          </div>
        <div id="content_center_item_finish">
		<p>&nbsp;<p>
        </div>
        <?php endforeach?>
        </div>
        
		</div>
		
		
		
