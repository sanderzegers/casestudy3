<?php
include("dbconnect.inc");
include("../config.inc");

session_start(); 
if(isset($_SESSION["Login"])<>1)
{
  Header("Location: index.php");
}
//Definition globale Error-Variable
global $strError;


//######################################################################################
//## Globale Funktion ERRORCHECK()
//## In dieser Funktion werden die Fehlermeldungen ausgegeben
//##
//######################################################################################

function errorcheck()
{
  if($GLOBALS["strError"] != "")
  {
    ECHO "<p style=\"color:red\"><strong>";
    switch ($GLOBALS["strError"])
    {
    Case "A01":
      ECHO "FEHLER $GLOBALS[strError]: Artikel nicht hinzugefügt - Sie haben keinen Artikelnamen, Beschreibung, Preis oder Bestand eingegeben";
      break;

    Case "A02":
      ECHO "FEHLER $GLOBALS[strError]: Artikel nicht geändert - Sie haben keinen Artikelnamen, Beschreibung, Preis oder Bestand eingegeben";
      break;
          
    Case "K01":
      ECHO "FEHLER $GLOBALS[strError]: Kategorie nicht hinzugefügt - Sie haben keinen Kategoriennamen eingegeben";
      break;

    Case "K02":
      ECHO "FEHLER $GLOBALS[strError]: Kategorie nicht geändert - Sie haben keinen Kategoriennamen eingegeben";
      break;
      
    Case "K03":
      ECHO "FEHLER $GLOBALS[strError]: Kategorie nicht gelöscht - Dieser Kategorie sind noch Artikel zugewiesen";
      break;

    Case "K04":
      ECHO "FEHLER $GLOBALS[strError]: Kategorie nicht geändert - Die Kategorie kann nicht sich selber als Oberkategorie zugewiesen werden";
      break;

    Case "K05":
      ECHO "FEHLER $GLOBALS[strError]: Kategorie nicht gelöscht - Die Kategorie besitzt noch Unterkategorien";
      break;
            
    Case "F01":
      ECHO "FEHLER $GLOBALS[strError]: Feature nicht gelöscht - Dieses Feature ist noch an Artikel zugewiesen";
      break;
      
    Case "F02":
      ECHO "FEHLER $GLOBALS[strError]: Feature nicht hinzugefügt - Sie haben keine Bezeichnung angegeben";
      break;
  
	Case "U01":
      ECHO "FEHLER $GLOBALS[strError]: User nicht hinzugefügt - Sie haben keinen Vornamen, Nachnamen, Loginnamen oder Passwort eingegeben";
      break;

	Case "U02":
      ECHO "FEHLER $GLOBALS[strError]: User nicht geändert - Sie haben keinen Vornamen, Nachnamen, Loginnamen oder Passwort eingegeben";
      break;

    }
	ECHO "</strong></p>";
	$GLOBALS["strError"] ="";
  }
}

//######################################################################################
//## Klasse Artikel
//## Diese Klasse beinhaltet sämtliche Funktionen rund um das Bearbeiten von Artikeln
//##
//######################################################################################
class Artikel
{

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt einen Artikel anhand der gesendeten Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateArtikel($_POST)
  {
    $txtName = $_POST['txtName'];
    $txtBeschreibung = $_POST['txtBeschreibung'];
    $txtKategorie = $_POST['cboKategorie'];
    $txtPreis = $_POST['txtPreis'];
    $txtBestand = $_POST['txtBestand'];
    $txtPreis = $_POST['txtPreis'];

	//Form-Check
	if($txtName=="" OR $txtBeschreibung=="" OR $txtBestand=="" OR $txtPreis=="")
	{
	  $GLOBALS["strError"] = "A01";
	}
	
    if(isset($_POST['cboStatus']))
    {
      $txtStatus = "1";
    } else {
      $txtStatus = "0";
    }
        
    if($GLOBALS["strError"]=="")
    {
      $rsInsert = mysql_query("INSERT INTO artikel (ArtikelBezeichnung, ArtikelBeschreibung, ArtikelKategorie, ArtikelPreis, ArtikelStatus, ArtikelBestand) VALUES ('$txtName', '$txtBeschreibung', '$txtKategorie', '$txtPreis', '$txtStatus', '$txtBestand')");
      $intID = mysql_insert_id();

      for ($i=1; $i<=6; $i++)
      {
        if($_POST['cboFeature' . $i] <> 0)
	    {
	      $this->AddArtikelFeature($intID, $_POST['cboFeature' . $i]);
        }
      }
		  
      $this->UploadArtikelImage($intID);
		 
      Header("Location: product_change.php");
    }
  }

  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht einen Artikel
  //
  // 13.01.11		1.0		Roland Hürlimann	Erstellung
  // 09.03.11		2.0		Roland Hürlimann	Error-Handling
  //////////////////////////////////////////////////////////////////////////////////////

  function DeleteArtikel($ArtikelNummer)
  {
    $strSQL = "DELETE FROM artikel_feature WHERE FK_ArtFeaArtikel = '$ArtikelNummer'";
    $rsDelete = mysql_query($strSQL);
    
    $strSQL = "SELECT * FROM bild WHERE BildArtikel = '$ArtikelNummer'";
    $rsBilder = mysql_query($strSQL);
    
    while($row = mysql_fetch_object($rsBilder))
    {
      $this->DeleteArtikelImage($row->id, $ArtikelNummer);
    }

    $strSQL = "DELETE FROM artikel WHERE ArtikelNummer = '$ArtikelNummer'";
    $rsDelete = mysql_query($strSQL);

    //Header("Location: product_change_detail.php?ID=$ArtikelNummer");

  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Artikelliste
  //
  // 06.01.11		1.0		Roland Hürlimann	Erstellung
  // 10.03.11		2.00	Roland Hürlimann	Implementation Artikel-Filter
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateArtikelListe($_POST)
  {
    if(isset($_POST['txtSuchbegriff']))
    {    
      $strSuchbegriff = $_POST['txtSuchbegriff'];
    } else {
      $strSuchbegriff = "";
    }

    if(isset($_POST['cboStatus']))
    {    
      if($_POST['cboStatus'] != "99")
      {   
        $strStatus = " AND ArtikelStatus = '" . $_POST['cboStatus'] . "'";
      } else {
        $strStatus = "";
      }
    } else {
      $strStatus = "";
    }
    
    
    if(isset($_POST['cboKategorie']))
    {    
      if($_POST['cboKategorie'] != "0")
      {
        $strKategorie = " AND ArtikelKategorie = '" . $_POST['cboKategorie'] . "'";
      } else {
        $strKategorie = "";
      }
    } else {
      $strKategorie = "";
    }

    
	$strSQL = "SELECT * FROM artikel WHERE ArtikelBezeichnung like '%$strSuchbegriff%' $strStatus $strKategorie ORDER BY ArtikelKategorie";    
	//echo $strSQL;
    $rsArtikel = mysql_query($strSQL);

  
    echo "<table style=\"width: 100%\">";
    echo "<tr>";
    echo "<td><strong>Nr.</strong></td>";
    echo "<td><strong>Kategorie</strong></td>";
    echo "<td><strong>Bezeichnung</strong></td>";
    echo "<td><strong>Preis</strong></td>";
    echo "<td><strong>Stk</strong></td>";
    echo "<td><strong>Status</strong></td>";
    echo "<td><strong></strong></td>";
    echo "<td><strong></strong></td>";
    echo "</tr>";

    while($row = mysql_fetch_object($rsArtikel))
    {
      echo "<tr>";
      echo "<td>$row->ArtikelNummer</td>";
    
      $rsKategorie = mysql_query("SELECT * FROM kategorie WHERE KategorieID = '$row->ArtikelKategorie'");
      $kategorie = mysql_fetch_object($rsKategorie);
    
      echo "<td>$kategorie->KategorieName</td>";
      echo "<td>$row->ArtikelBezeichnung</td>";
      echo "<td>$row->ArtikelPreis</td>";
      echo "<td>$row->ArtikelBestand</td>";
      echo "<td>$row->ArtikelStatus</td>";
      echo "<td><a href=\"product_change_detail.php?ID=$row->ArtikelNummer\"><img alt=\"\" src=\"images/change.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
      echo "<td><a href=\"?ProdDel=$row->ArtikelNummer\"><img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";

      echo "</tr>";
    }
    echo "</table>";
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt den Artikelfilter
  //
  // 10.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateArtikelFilter()
  {

    echo "<FORM method=\"post\" action=\"product_change.php\">";
    echo "<table style=\"width: 100%\">";
    echo "<tr>";
    echo "<td><strong>Kategorienfilter</strong></td>";
    echo "<td><strong>Statusfilter</strong></td>";
    echo "<td><strong>Freitext</strong></td>";
    echo "<td></td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<td>";
    $objKategorie = new Kategorie();
    $objKategorie->CreateKategorieSelect(0,1,1);
    echo "</td>";
    echo "<td><select name=\"cboStatus\"><option selected=\"selected\" value=\"99\">Keine</option><option value=\"1\">Aktive Produkte</option><option value=\"0\">Inaktive Produkte</option></select></td>";
    echo "<td><input name=\"txtSuchbegriff\" type=\"text\" style=\"width: 120px\" value=\"\" /></td>";
    echo "<td><input name=\"Submit\" type=\"submit\" value=\"Filtern\" /></td>";
    echo "</tr>";

    echo "</table>";
    echo "</form>";
    echo "<p>";
    echo "<hr>";
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ordnet dem Artikel ein Feature zu
  //
  // 23.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function AddArtikelFeature($ArtikelID, $FeatureID)
  {
    
   $strSQL = "DELETE FROM artikel_feature WHERE ArtFeaID = '$ArtikelID'";
   $rsDelete = mysql_query($strSQL);
 
   $strSQL = "INSERT INTO artikel_feature (FK_ArtFeaArtikel, FK_ArtFeaFeature) VALUES ('$ArtikelID', '$FeatureID')";
   $rsSelect = mysql_query($strSQL);
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion bereitet die Feature-Liste in der Artikel-Änderungsseite auf
  //
  // 22.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
 
  function CreateArtikelFeatureList($strID)
  {
    $rsSelect = mysql_query("SELECT * FROM artikel_feature WHERE FK_ArtFeaArtikel = '$strID'");
  	$i = 1;
    while($row_feature = mysql_fetch_object($rsSelect))
	{
	  echo "<tr>";
	  echo "<td style=\"width: 181px\">Feature " . $i . ":</td>";
	  echo "<td>";
		        
	  $rsFeature = mysql_query("SELECT * FROM feature WHERE FeatureID = '$row_feature->FK_ArtFeaFeature'");
	  $row_fbez = mysql_fetch_object($rsFeature);
	  echo $row_fbez->FeatureBezeichnung;
	  echo "  <a href=\"?ID=" . $strID . "&FeatureDel=$row_feature->ArtFeaID\"><img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\"/></a>";
	  echo "</td>";
	  echo "</tr>";
	  $i++;
	}	
			  
	$objFeature = new Feature();
	while($i<=6)
	{
	  echo "<tr>";
	  echo "<td style=\"width: 181px\">Feature " . $i . ":</td>";
	  echo "<td>";
	  $objFeature->CreateFeatureListSelect($i);
	  echo "</td>";
	  echo "</tr>";
	  $i++;
	}
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht die Zuordnung des Feature zu einem Artikel in der Datenbank
  //
  // 22.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function DeleteArtikelFeature($FeatureID, $ProductID)
  {
    $strSQL = "DELETE FROM artikel_feature WHERE ArtFeaID = '$FeatureID'";
    $rsDelete = mysql_query($strSQL);

    Header("Location: product_change_detail.php?ID=$ProductID");
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht Bilder physisch und in der DB
  //
  // 01.01.11		1.0		Roland Hürlimann	Erstellung
  // 04.03.11		2.0		Roland Hürlimann	Implementation Pfad-Variable
  //////////////////////////////////////////////////////////////////////////////////////

  function DeleteArtikelImage($BildID, $ProductID)
  {
    $strSQL = "SELECT * FROM bild Where ID = $BildID";
    $rsSelect = mysql_query($strSQL);
  
    $row = mysql_fetch_object($rsSelect);
  
    unlink("../" . $GLOBALS["strImagePath"] . $row->BildName);

  
    $strSQL = "DELETE FROM bild WHERE id = '$BildID'";
    $rsDelete = mysql_query($strSQL);

    //Header("Location: product_change_detail.php?ID=$ProductID");
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion organisiert den Bilder-Upload
  //
  // 06.01.11		1.0		Roland Hürlimann	Erstellung
  // 04.03.11		2.0		Roland Hürlimann	Implementation Pfad-Variable
  //////////////////////////////////////////////////////////////////////////////////////

  function UploadArtikelImage($ArtikelID)
  {
    $anzahl = 3;

 
    for($count=1; $count<6; $count++)
    {
	  $zufall = rand(1000000000,9999999999);
      $target = "../" . $GLOBALS["strImagePath"]. $ArtikelID . "_$zufall.jpg";    
	
	  if(isset($_FILES['txtFile' . $count]))
	  {
        if(move_uploaded_file($_FILES['txtFile' . $count]['tmp_name'], $target))
        {
          $strSQL = "INSERT INTO bild (BildName, BildArtikel) VALUES ('$ArtikelID" . "_$zufall.jpg', $ArtikelID)";
          $rsInsert = mysql_query($strSQL);
        }
      }
    }
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt das CBO für die Statusauswahl
  //
  // 04.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateArtikelStatusCBO($strArtikelStatus)
  {
    if($strArtikelStatus==1)
    { 
      echo "<input name=\"cboStatus\" type=\"checkbox\" style=\"height: 20px\" checked=\"checked\" value=\"1\">&nbsp;Aktiviert";
    } else { 
      echo "<input name=\"cboStatus\" type=\"checkbox\" style=\"height: 20px\" value=\"1\">&nbsp;Aktiviert";
    }
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion zeigt entweder Vorschaubild oder Upload-Feld an
  //
  // 07.01.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateArtikelImageBox($strID)
  {
	$rsSelect = mysql_query("SELECT * FROM Bild WHERE BildArtikel = '$strID'");
  			  
	for($count=1; $count<6; $count++)
	{
	  $image = mysql_fetch_object($rsSelect);
	  echo "<tr>";
	  echo "<td style=\"width: 181px\">Bild " . $count . ":</td>";

	  if(isset($image->id))
	  {
	    echo "<td><img alt=\"\" src=\"../$GLOBALS[strImagePath]$image->BildName\" width=\"25\" />";
		echo "<a href=\"?ID=" . $strID . "&ImageDel=$image->id\"><img alt=\"\" src=\"images/delete.jpg\" width=\"25\" height=\"25\" border=\"0\"/></a>";
		echo "</td>";		    	
	  } else{
	    echo "<td><input name=\"txtFile" . $count . "\" type=\"file\">&nbsp;</td>";
	  }
      echo "</tr>";
	}
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ändert einen Artikel anhand der Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function ChangeArtikel($_POST)
  {
	$txtName = $_POST['txtName'];
	$txtBeschreibung = $_POST['txtBeschreibung'];
	$txtKategorie = $_POST['cboKategorie'];
	$txtBestand = $_POST['txtBestand'];
	$txtPreis = $_POST['txtPreis'];
	

    
    if(isset($_POST['cboStatus'])) {
	  $txtStatus = "1";
	} else {
	  $txtStatus = "0";
    }
	$txtID = $_POST['txtID'];

	//Form-Check
	if($txtName=="" OR $txtBeschreibung=="" OR $txtBestand=="" OR $txtPreis=="")
	{
	  $GLOBALS["strError"] = "A02";
	}

    if($GLOBALS["strError"]=="")
    {    
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelBezeichnung = '$txtName' WHERE ArtikelNummer = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelBeschreibung = '$txtBeschreibung' WHERE ArtikelNummer = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelKategorie = '$txtKategorie' WHERE ArtikelNummer = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelBestand = '$txtBestand' WHERE ArtikelNummer = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelPreis = $txtPreis WHERE ArtikelNummer = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE artikel SET ArtikelStatus = '$txtStatus' WHERE ArtikelNummer = '$txtID'");
 
	  $this->UploadArtikelImage($txtID);

      for ($i=1; $i<=6; $i++)
	  {
	    if(isset($_POST['cboFeature' . $i]))
	    {
	      if(($_POST['cboFeature' . $i]) <> 0)
		  {
		    $this->AddArtikelFeature($txtID, $_POST['cboFeature' . $i]);
		  }
	    }
	  }
	  Header("Location: product_change.php");
    } 
  }
}

//######################################################################################
//## Klasse Kategorie
//## Diese Klasse beinhaltet sämtliche Funktionen rund um das Bearbeiten von Kategorien
//##
//######################################################################################

class Kategorie
{

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt eine Kategorie anhand der Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateKategorie($_POST)
  {
	$txtName = $_POST['txtName'];
	$txtBeschreibung = $_POST['txtBeschreibung'];
    $txtOberkategorie = $_POST['cboKategorie'];
 
 
 	$strSQL = "SELECT * FROM kategorie WHERE KategorieOberkategorie = '$txtOberkategorie'";
 	$rsSelect = mysql_query($strSQL);
	$intAnzahl = mysql_num_rows($rsSelect);
 	$intAnzahl++;
 
	//Form-Check
	if($txtName=="")
	{
	  $GLOBALS["strError"] = "K01";
	}
       
    if ($GLOBALS["strError"]=="")
    {
      $rsInsert = mysql_query("INSERT INTO kategorie (KategorieName, KategorieBezeichnung, KategorieOberkategorie, KategorieOrder) VALUES ('$txtName', '$txtBeschreibung', '$txtOberkategorie', '$intAnzahl')");        
      Header("Location: categories_change.php");
    }
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ändert eine Kategorie anhand der gesendeten Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  // 09.03.11		2.0		Roland Hürlimann	Error-Handling
  //////////////////////////////////////////////////////////////////////////////////////
  
  function ChangeKategorie($_POST)
  {
  	$txtName = $_POST['txtName'];
	$txtBeschreibung = $_POST['txtBeschreibung'];
	$txtOberkategorie = $_POST['cboKategorie'];
	$txtID = $_POST['txtID'];
 
	//Form-Check
	if($txtName=="")
	{
	  $GLOBALS["strError"] = "K02";
	}
	
	if($txtID==$txtOberkategorie)
	{
	  $GLOBALS["strError"] = "K04";
	}
    
	if ($GLOBALS["strError"]=="")
	{   
	  $rsUpdate = mysql_query("UPDATE kategorie SET KategorieName = '$txtName' WHERE KategorieID = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE kategorie SET KategorieBezeichnung= '$txtBeschreibung' WHERE KategorieID = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE kategorie SET KategorieOberkategorie = '$txtOberkategorie' WHERE KategorieID = '$txtID'");

	  Header("Location: categories_change.php");
	}
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Kategorieliste
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateKategorieList()
  {
    ECHO "<table style=\"width: 100%\">";

	$rsKategegorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = 0 ORDER BY KategorieName");
	while($row = mysql_fetch_object($rsKategegorie))
	{
	  $strKategoriename = $row->KategorieName;
	  echo "<tr>";
	  echo "<td>$strKategoriename</td>";

	  echo "<td><a href=\"categories_change_detail.php?Cat=$row->KategorieID\">";
	  echo "<img alt=\"\" src=\"images/change.jpg\" width=\"20\" height=\"20\" border=\"0\"/></a></td>";
	  echo "<td><a href=\"?CatDel=$row->KategorieID\"><img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
	  echo "</tr>";
  
	  $rsUnterkategorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = ($row->KategorieID)");
	  while($reihe = mysql_fetch_object($rsUnterkategorie))
	  {
	    $strKategoriename = $reihe->KategorieName;  
	    echo "<tr>";
	    echo "<td>--$strKategoriename</td>";
		echo "<td>";
	    echo "<a href=\"categories_change_detail.php?Cat=$reihe->KategorieID\">";
	    echo "<img alt=\"\" src=\"images/change.jpg\" width=\"20\" height=\"20\" border=\"0\"/>";
		echo "</a>";
		echo "</td>";
		echo "<td>";
	    echo "<a href=\"?CatDel=$reihe->KategorieID\">";
	    echo "<img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\" />";
		echo "</a>";
		echo "</td>";
		echo "</tr>";
	  }
	}
  	echo "</table>";
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht die entsprechende Kategorie
  //
  // 03.01.11		1.0		Roland Hürlimann	Erstellung
  // 09.03.11		2.0		Roland Hürlimann	Error Handling
  //////////////////////////////////////////////////////////////////////////////////////
  
  function DeleteKategorie($intCatID)
  {

	$strSQL = "SELECT * FROM kategorie WHERE KategorieOberkategorie = '$intCatID'";
	$rsSelect = mysql_query($strSQL);

	if(mysql_num_rows($rsSelect)!=0)
	{
	  $GLOBALS["strError"] = "K05";
	}

    if ($GLOBALS["strError"]=="")
    {
      $strSQL = "SELECT * FROM artikel WHERE ArtikelKategorie = '$intCatID'";
      $rsSelect = mysql_query($strSQL);

      if(mysql_num_rows($rsSelect)== 0)
      {
	    $strSQL = "SELECT * FROM kategorie WHERE KategorieID = '$intCatID'";      
        $rsSelect = mysql_query($strSQL);
        $row = mysql_fetch_object($rsSelect);
        $intOrder = $row->KategorieOrder;
        $intOberKategorie = $row->KategorieOberkategorie;
      
        $strSQL = "SELECT * FROM Kategorie WHERE KategorieOberkategorie = '$intOberKategorie' AND KategorieOrder > '$intOrder'";
        $rsSelect = mysql_query($strSQL);
        while($row = mysql_fetch_object($rsSelect))
        {
          $strSQL = "UPDATE kategorie SET KategorieOrder = $row->KategorieOrder-1 WHERE KategorieID = $row->KategorieID";
          mysql_query($strSQL);
        }

        $rsDelete = mysql_query("DELETE FROM kategorie WHERE KategorieID = $intCatID");
      } else {
	    $GLOBALS["strError"] = "K03";     
      }
    }
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Auswahlliste mit den Kategorien
  //
  // 04.01.11		1.0		Roland Hürlimann	Erstellung
  // 04.03.11		2.0		Roland Hürlimann	Hinzufügen eines Übergabeparameters
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateKategorieSelect($intSelectedCat, $intSubCat, $intNone)
  {
    echo "<select name=\"cboKategorie\" style=\"width: 220px\">";
    
    if($intNone == 1)
    {
      echo "<option value=\"0\">Keine</option>";
    }

    $rsKategegorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = 0 ORDER BY KategorieName");
    while($row = mysql_fetch_object($rsKategegorie))
    {
      $strKategoriename = $row->KategorieName;
	
	  if(($row->KategorieID) == $intSelectedCat)
	  {
	    echo "<option value=\"$row->KategorieID\" selected=\"selected\">$strKategoriename</option>\n";
	  } else {
	    echo "<option value=\"$row->KategorieID\">$strKategoriename</option>\n";
      }
      $rsUnterkategorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = ($row->KategorieID)");
    
      if($intSubCat==1)
      {
        while($reihe = mysql_fetch_object($rsUnterkategorie))
        {
          $strKategoriename = $reihe->KategorieName;
      
          if(($reihe->KategorieID) == $intSelectedCat)
          {
	        echo "<option value=\"$reihe->KategorieID\" selected=\"selected\">...$strKategoriename</option>\n";      
          } else {
	        echo "<option value=\"$reihe->KategorieID\">...$strKategoriename</option>\n";
	      }
        }
      }
    }
    echo "</select>";
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Auswahlliste mit den Kategorien für das Ordnen
  //
  // 23.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateKategorieOrderList()
  {
    ECHO "<table style=\"width: 100%\">";
    echo "<tr>";
    echo "<td><strong>Kategorie</strong></td>";
    echo "<td></td>";
    echo "<td></td>";    
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";

    $rsKategorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = 0 ORDER BY KategorieOrder");
    while($row = mysql_fetch_object($rsKategorie))
    {
      $strKategoriename = $row->KategorieName;
      echo "<tr>";
      echo "<td>$strKategoriename</td>";
      echo "<td>($row->KategorieOrder)</td>";
      echo "<td></td>";      
  	  echo "<td><a href=\"categories_order.php?Order=Up&ID=$row->KategorieID\">";  
	  if($row->KategorieOrder != 1)
	  {
  	    echo "<img alt=\"\" src=\"images/up.jpg\" width=\"22\" height=\"20\" border=\"0\"/>";
  	  }
  	  echo "</td></a>";
	  
	  echo "<td><a href=\"categories_order.php?Order=Down&ID=$row->KategorieID\">";
	  $result = mysql_num_rows($rsKategorie);
	  if($row->KategorieOrder != $result)
	  {
	    echo "<img alt=\"\" src=\"images/down.jpg\" width=\"22\" height=\"20\" border=\"0\" />";
	  }
	  
	  echo "</td></a>";
      echo "</tr>";
    
  	  $rsUnterkategorie = mysql_query("SELECT * FROM kategorie WHERE KategorieOberkategorie = ($row->KategorieID) ORDER BY KategorieOrder");
	  while($reihe = mysql_fetch_object($rsUnterkategorie))
	  {
	    $strKategoriename = $reihe->KategorieName;  
	    echo "<tr>";
	    echo "<td>=> $strKategoriename</td>";
        echo "<td></td>";
        echo "<td>($reihe->KategorieOrder)</td>"; 	    
  	    echo "<td><a href=\"categories_order.php?Order=Up&ID=$reihe->KategorieID\">";

  	    if($reihe->KategorieOrder != 1)
	    {
  	    echo "<img alt=\"\" src=\"images/up.jpg\" width=\"22\" height=\"20\" border=\"0\"/>";
  	    }    
  	    echo "</td></a>";

	    echo "<td><a href=\"categories_order.php?Order=Down&ID=$reihe->KategorieID\">";

	    $result = mysql_num_rows($rsUnterkategorie);
	    if($reihe->KategorieOrder != $result)
	    {
		  echo "<img alt=\"\" src=\"images/down.jpg\" width=\"22\" height=\"20\" border=\"0\"/>";
		}
		echo "</td></a>";
		echo "</tr>";
      }
    }
    echo "</table>";
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ordnet die entsprechene Kategorie höher oder tiefer
  //
  // 07.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function OrderKategorie($KategorieID, $Direction)
  {
    $strSQL = "SELECT * FROM kategorie WHERE KategorieID = '$KategorieID'";
    $rsKategorie = mysql_query($strSQL);
    $row = mysql_fetch_object($rsKategorie);
    $intOrder = $row->KategorieOrder;
    $intOberKategorie = $row->KategorieOberkategorie;
    
    if($Direction == "Up")
    {     
	  $strSQL = "UPDATE kategorie SET KategorieOrder = $intOrder WHERE KategorieOberkategorie = $intOberKategorie AND KategorieOrder=$intOrder-1";
	  $rsUpdate = mysql_query($strSQL);
	  
      $strSQL = "UPDATE kategorie SET KategorieOrder = $intOrder-1 WHERE KategorieID = '$KategorieID'";
	  $rsUpdate = mysql_query($strSQL);
	  
	  
    } else {
	  
	  $strSQL = "UPDATE kategorie SET KategorieOrder = $intOrder WHERE KategorieOberkategorie = $intOberKategorie AND KategorieOrder=$intOrder+1";
	  $rsUpdate = mysql_query($strSQL);
      
      $strSQL = "UPDATE kategorie SET KategorieOrder = $intOrder+1 WHERE KategorieID = '$KategorieID'";
	  $rsUpdate = mysql_query($strSQL); 
    }
  
  }
}

//######################################################################################
//## Klasse Feature
//## Diese Klasse beinhaltet sämtliche Funktionen rund um das Bearbeiten von Features
//##
//######################################################################################

class Feature
{
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt ein Feature anhand der gesendeten Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateFeature($_POST)
  {        
    $txtFeatureBezeichnung = $_POST['txtFeatureBezeichnung'];

	//Form-Check
	if($txtFeatureBezeichnung =="")
	{
	  $GLOBALS["strError"] = "F02";
	}        
    
    if($GLOBALS["strError"]=="")
    {
      $rsInsert = mysql_query("INSERT INTO feature (FeatureBezeichnung) VALUES ('$txtFeatureBezeichnung')");
	  Header("Location: feature_change.php");
	}

  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ändert ein Feature anhand der gesendeten Formulardaten
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function ChangeFeature($_POST)
  {
  	$txtName = $_POST['txtName'];
	$txtID = $_POST['txtID'];
        
	$rsUpdate = mysql_query("UPDATE feature SET FeatureBezeichnung = '$txtName' WHERE FeatureID = '$txtID'");

	Header("Location: feature_change.php");
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Auswahlliste mit den Features
  //
  // 22.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateFeatureList()
  {      
    echo "<table style=\"width: 100%\">";
    echo "<tr>";
    echo "<td><strong>ID</strong></td>";
    echo "<td><strong>Feature</strong></td>";
    echo "<td><strong></strong></td>";
    echo "<td><strong></strong></td>";
    echo "</tr>";

    $rsFeature = mysql_query("SELECT * FROM feature ORDER BY FeatureBezeichnung");

    while($row = mysql_fetch_object($rsFeature))
    {
      echo "<tr>";
      echo "<td>$row->FeatureID</td>";
      echo "<td>$row->FeatureBezeichnung</td>";
      echo "<td><a href=\"feature_change_detail.php?ID=$row->FeatureID\"><img alt=\"\" src=\"images/change.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
      echo "<td><a href=\"?DeleteFeature=$row->FeatureID\"><img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht ein Feature aus der Datenbank
  //
  // 23.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function DeleteFeature($FeatureID)
  {
    $strSQL = "SELECT * FROM artikel_feature WHERE FK_ArtFeaFeature = '$FeatureID'";
    $rsSelect = mysql_query($strSQL);
    
    if(mysql_num_rows($rsSelect)== 0)
    {
      $strSQL = "DELETE FROM feature WHERE FeatureID = '$FeatureID'";
      $rsDelete = mysql_query($strSQL);
    } else {
  	  $GLOBALS["strError"] = "F01";     
    }
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ermittelt die Zuweisung eines Features
  //
  // 03.03.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function GetFeatureZuweisung($FeatureID)
  {
	$strSQL = "SELECT * FROM artikel_feature WHERE FK_ArtFeaFeature = '$FeatureID'";
    $rsSelect = mysql_query($strSQL);

	while($row = mysql_fetch_object($rsSelect))
	{
      $strSQL = "SELECT * FROM artikel WHERE ArtikelNummer = '$row->FK_ArtFeaArtikel'";
      $rsArtikel = mysql_query($strSQL);
      $Artikel = mysql_fetch_object($rsArtikel);
      ECHO "- " . $Artikel->ArtikelBezeichnung;
      ECHO "<br>";
    }       
  }
  
  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Auswahlliste mit den Features
  //
  // 22.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
    
  function CreateFeatureListSelect($ListID)
  {
    echo "<select name=\"cboFeature$ListID\" style=\"width: 220px\"><option value=\"0\">Kein</option>";

    $rsFeature = mysql_query("SELECT * FROM feature ORDER BY FeatureBezeichnung");
    while($row = mysql_fetch_object($rsFeature ))
    {
      $strFeatureBezeichnung = $row->FeatureBezeichnung;
	  echo "<option value=\"$row->FeatureID\">$strFeatureBezeichnung</option>";
    }
    echo "</select>";
  }

}

//######################################################################################
//## Klasse User
//## Diese Klasse beinhaltet sämtliche Funktionen rund um die Userverwaltung
//##
//######################################################################################
class User
{

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt einen User anhand der gesendeten Formulardaten
  //
  // 03.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateUser($_POST)
  {
    $txtVorname = $_POST['txtVorname'];
    $txtNachname = $_POST['txtNachname'];
    $txtLogin = $_POST['txtLogin'];
    $txtPasswort = $_POST['txtPasswort'];

	//Form-Check
	if($txtVorname=="" OR $txtNachname =="" OR $txtLogin =="" OR $txtPasswort =="")
	{
	  $GLOBALS["strError"] = "U01";
	}

    if($GLOBALS["strError"]=="")
    {	        
      $rsInsert = mysql_query("INSERT INTO admins (AdminVorname, AdminNachname, AdminLogin, AdminPasswort) VALUES ('$txtVorname', '$txtNachname', '$txtLogin', '$txtPasswort')");
	  Header("Location: user_change.php");
	}
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion ändert einen User anhand der gesendeten Formulardaten
  //
  // 03.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function ChangeUser($_POST)
  {
    $txtVorname = $_POST['txtVorname'];
    $txtNachname = $_POST['txtNachname'];
    $txtLogin = $_POST['txtLogin'];
    $txtPasswort = $_POST['txtPasswort'];
	$txtID = $_POST['txtID'];

	//Form-Check
	if($txtVorname=="" OR $txtNachname =="" OR $txtLogin =="" OR $txtPasswort =="")
	{
	  $GLOBALS["strError"] = "U02";
	}

    if($GLOBALS["strError"]=="")
    {	                     
	  $rsUpdate = mysql_query("UPDATE admins SET AdminVorname = '$txtVorname' WHERE AdminID = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE admins SET AdminNachname = '$txtNachname' WHERE AdminID = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE admins SET AdminLogin = '$txtLogin' WHERE AdminID = '$txtID'");
	  $rsUpdate = mysql_query("UPDATE admins SET AdminPasswort = '$txtPasswort' WHERE AdminID = '$txtID'");
	  Header("Location: user_change.php");
	}
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt die Userliste
  //
  // 03.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  function CreateUserList()
  {
    echo "<table style=\"width: 100%\">";
    echo "<tr>";
    echo "<td><strong>ID</strong></td>";
    echo "<td><strong>Nachname</strong></td>";
    echo "<td><strong>Vorname</strong></td>";
    echo "<td><strong>Username</strong></td>";
    echo "<td><strong></strong></td>";
    echo "<td><strong></strong></td>";
    echo "</tr>";

    $rsFeature = mysql_query("SELECT * FROM admins ORDER BY AdminNachname");

    while($row = mysql_fetch_object($rsFeature))
    {
      echo "<tr>";
      echo "<td>$row->AdminID</td>";
      echo "<td>$row->AdminNachname</td>";
      echo "<td>$row->AdminVorname</td>";
      echo "<td>$row->AdminLogin</td>";
      echo "<td><a href=\"user_change_detail.php?ID=$row->AdminID\"><img alt=\"\" src=\"images/change.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
      echo "<td><a href=\"?DeleteUser=$row->AdminID\"><img alt=\"\" src=\"images/delete.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";
      echo "</tr>";
    }
    echo "</table>";
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion löscht einen User
  //
  // 03.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////

  
  function DeleteUser($UserID)
  {
    $strSQL = "DELETE FROM admins WHERE AdminID = '$UserID'";
    $rsDelete = mysql_query($strSQL);
    
    //Header("Location: user_change.php");
  }

  //////////////////////////////////////////////////////////////////////////////////////
  // Diese Funktion erstellt das Änderungsformular um einen User zu ändern
  //
  // 03.02.11		1.0		Roland Hürlimann	Erstellung
  //////////////////////////////////////////////////////////////////////////////////////
  
  function CreateUserChangeForm($UserID)
  {
    $rsSelect = mysql_query("SELECT * FROM admins WHERE AdminID = '$UserID'");
    $row = mysql_fetch_object($rsSelect);
  				
    echo "<FORM method=\"post\" action=\"user_change_detail.php?ID=$UserID\">";
	echo "<table style=\"width: 100%\">";
	echo "<tr>";
	echo "<td style=\"width: 181px\">Vorname:</td>";
	echo "<td>";
	echo "<input name=\"txtVorname\" type=\"text\" style=\"width: 220px\" value=\"$row->AdminVorname\" /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style=\"width: 181px\">Nachname:</td>";
	echo "<td>";
	echo "<input name=\"txtNachname\" type=\"text\" style=\"width: 220px\" value=\"$row->AdminNachname\" /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style=\"width: 181px\">Loginname:</td>";
	echo "<td>";
	echo "<input name=\"txtLogin\" type=\"text\" style=\"width: 220px\" value=\"$row->AdminLogin\" /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style=\"width: 181px\">Passwort:</td>";
	echo "<td>";
	echo "<input name=\"txtPasswort\" type=\"password\" style=\"width: 220px\" value=\"$row->AdminPasswort\" /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style=\"width: 181px\">&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"2\">";
	echo "<input name=\"Submit\" type=\"submit\" value=\"Absenden\" />&nbsp;<input name=\"Reset\" type=\"reset\" value=\"Zurücksetzen\" /></td>";
	echo "</tr>";
	echo "</table>";
	echo "<input name=\"txtID\" type=\"hidden\" value=\"$row->AdminID\" />";
	echo "</form>";
  }

}
?>