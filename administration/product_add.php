<?php
include("dbconnect.inc");
include("include.inc");
$objArtikel = new Artikel();
$objKategorie = new Kategorie();
$objFeature= new Feature();

if(isset($_POST['txtName']))
{
  $objArtikel->CreateArtikel($_POST);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
	   "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="logitech, maus, tastatur, peripherie, audi, suzuki">
<meta name="description" content="Logitech">
<meta name="author" content="Z2H-Development">
<meta name="publisher" content="Z2H-Development">
<meta name="copyright" content="Z2H-Development">
<meta name="company" content="Z2H-Development">
<meta name="reply-to" content="mail@z2h-development.com">
<meta name="content-language" content="de">
<meta name="page-topic" content="Online-Shop">
<meta name="revisit-after" content="14 days">
<meta name="robots" content="index, follow">
<link href="Images/fav_icon.ico" rel="shortcut icon">
<link href="Images/fav_icon.ico" rel="icon">
<TITLE>Z2H-Design</TITLE>

<link rel="stylesheet" type="text/css" href="../style.css">

</HEAD>

<BODY>
<center>

<div id="container">

	<div id="top">
        <div id="top_left">
        </div>
        <div id="top_home">
       			<a class="a1" href="index.html">Home</a>
        </div>
        <div id="top_firma">
               	<a class="a1" href="index.html">Firma</a>
        </div>
        <div id="top_shop">
               	<a class="a1" href="index.html">Online Shop</a>
        </div>
        <div id="top_kontakt">
               	<a class="a1" href="index.html">Kontakt</a>
        </div>
	</div>
	
	<div id="banner">
	</div>
    
   	<div id="over_content">
	.:: Administrationswebsite ::.
	</div>
	
	<div id="content">

		<div id="content_left">

        <div id="content_left2">
        <div id="content_left3">

		<p id="text_content" class="level1l">Artikel</p>
        <p id="text_content" class="level2l"><a class="level2l" href="product_add.php">Hinzuf�gen</a></p>
        <p id="text_content" class="level2l"><a class="level2l" href="product_change.php">�ndern</a></p>
 		<p id="text_content" class="level1l">Kategorien</p>
        <p id="text_content" class="level2l"><a class="level2l" href="categories_add.php">Hinzuf�gen</a></p>
        <p id="text_content" class="level2l"><a class="level2l" href="categories_change.php">�ndern</a></p>
        <p id="text_content" class="level2l"><a class="level2l" href="categories_order.php">Ordnen</a></p>
 		<p id="text_content" class="level1l">Features</p>
        <p id="text_content" class="level2l"><a class="level2l" href="feature_add.php">Hinzuf�gen</a></p>
        <p id="text_content" class="level2l"><a class="level2l" href="feature_change.php">�ndern</a></p>
 		<p id="text_content" class="level1l">User-Verwaltung</p>
        <p id="text_content" class="level2l"><a class="level2l" href="user_add.php">Hinzuf�gen</a></p>
        <p id="text_content" class="level2l"><a class="level2l" href="user_change.php">�ndern</a></p>
 		<p id="text_content" class="level1l"><a class="level1l" href="logout.php">Logout</a></p>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
		</p>
		</div>
        </div>
        </div>	
        
		<div id="content_center">
        <p id="content_center_title">
        <h1>Artikel hinzuf�gen</h1>
        </p>
		<?php errorcheck(); ?>
		<FORM enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <table style="width: 100%">
		    <tr>
			  <td style="width: 181px">Artikelname:</td>
			  <td><input name="txtName" type="text" style="width: 220px" />&nbsp;</td>
		   	</tr>
			<tr>
		      <td style="width: 181px">Beschreibung:</td>
			  <td><textarea name="txtBeschreibung" rows="2" style="width: 220px"></textarea>&nbsp;</td>
			</tr>
			<tr>
			  <td style="width: 181px">Produktkategorie:</td>
			  <td><?php $objKategorie->CreateKategorieSelect(0,1,0)?></td>
			</tr>
		    <tr>
			  <td style="width: 181px">Preis:</td>
			  <td><input name="txtPreis" type="text" style="width: 220px" />&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Bestand:</td>
			  <td><input name="txtBestand" type="text" style="width: 220px" />&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Status:</td>
			  <td>
				<input name="cboStatus" type="checkbox" style="height: 20px" checked="checked" value="1">&nbsp;Aktiviert</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 1:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(1); ?></td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 2:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(2); ?></td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 3:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(3); ?></td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 4:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(4); ?></td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 5:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(5); ?></td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Feature 6:</td>
			  <td><?php $objFeature->CreateFeatureListSelect(6); ?></td>
		   	</tr>

		    <tr>
			  <td style="width: 181px">Bild 1:</td>
			  <td><input name="txtFile1" type="file">&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Bild 2:</td>
			  <td><input name="txtFile2" type="file">&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Bild 3:</td>
			  <td><input name="txtFile3" type="file">&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Bild 4:</td>
			  <td><input name="txtFile4" type="file">&nbsp;</td>
		   	</tr>
		    <tr>
			  <td style="width: 181px">Bild 5:</td>
			  <td><input name="txtFile5" type="file">&nbsp;</td>
		   	</tr>
			
			<tr>
			  <td style="width: 181px">&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
		      <td colspan="2">
			  <input name="Submit1" type="submit" value="Absenden" />&nbsp;<input name="Reset1" type="reset" value="Zur�cksetzen" /></td>
			</tr>
	</table>
</form>

		
		
		
		
  
  
  	</div>
		
        <div id="footer">.:: Casestudy Internet und Intranettechnologien III :: Copyright 2010 by Z2H Design ::.</div></div>

</center>
</BODY>
</HTML>
