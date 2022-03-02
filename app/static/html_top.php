<!DOCTYPE html>
<html>
<head>
  <title>WEA Projekt - Půjčovna zvířat</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styl.css" type="text/css">
</head>
<body>
<header>
  <h1>Půjčovna zvířat</h1>
  <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
</header>

<nav>
<?php
  include 'navigace.php';
?>
</nav>
 
<div class="chyboveHlasky">
<?php
  if (isset($chybovaHlaska))
    echo "<p>".$chybovaHlaska."</p>";
?>
 </div>