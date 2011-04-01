<?php
  session_start();
  unset($_SESSION["Login"]);
  unset($_SESSION["User"]);
  Header("Location: index.php"); 


?>
