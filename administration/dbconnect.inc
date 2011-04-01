<?php
include("../config.inc");

mysql_connect($strDBHost,$strDBUser,$strDBPassword);
mysql_select_db($strDBName);

mysql_connect($strDBHost,$strDBUser,$strDBPassword) or die ("Keine Verbindung moeglich");
mysql_select_db($strDBName) or die ("Die Datenbank existiert nicht.");
?>