<?php
include("dbconnect.inc");
include("include.inc");
$objFeature = new Feature();

  if(isset($_POST['txtName'])) 
  {
    $objFeature->ChangeFeature($_POST);
  }
  $strID = $_GET['ID'];  
        
  $rsSelect = mysql_query("SELECT * FROM feature WHERE FeatureID = '$strID'");
  $row = mysql_fetch_object($rsSelect);
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
        <h1>Kategorie bearbeiten</h1>
        </p><?php errorcheck(); ?>
		
		<FORM method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <table style="width: 100%">
		    <tr>
			  <td style="width: 181px">Feature Bezeichnung:</td>
			  <td>
				<input name="txtName" type="text" style="width: 220px" value="<?php echo $row->FeatureBezeichnung; ?>" /></td>
		   	</tr>
			<tr>
		      <td style="width: 181px">Zuweisung:</td>
			  <td><?php $objFeature->GetFeatureZuweisung($strID); ?></td>
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
	<input name="txtID" type="hidden" value="<?php echo $row->FeatureID; ?>" />
</form>

		
		
		
		
  
  
  	</div>
		
        <div id="footer">.:: Casestudy Internet und Intranettechnologien III :: Copyright 2010 by Z2H Design ::.</div></div>

</center>
</BODY>
</HTML>
