<?php
  $server = "localhost";
  $uzivatel = "root";
  $heslo = "";
  $databaze = "filipek_www3_cz";
  
  $db = mysqli_connect($server, $uzivatel, $heslo, $databaze);
  mysqli_query($db, "SET NAMES UTF8");
?>