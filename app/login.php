<?php
session_start();
require 'static/db_pripojeni.php';
  
  if (isset($_POST["login"]))
  {
    $dotaz = "
      SELECT *
      FROM uzivatele
      WHERE login = '{$_POST["login"]}'
      AND heslo = '".sha1($_POST["heslo"])."'  
    ";
    $uzivatel = mysqli_query($db, $dotaz);
    $uzivatel = mysqli_fetch_assoc($uzivatel);
    
    if ($uzivatel)
    {
      // přihlásit uživatele do aplikace
      $_SESSION["uzivatel"] = $uzivatel;
      header("Location: index.php");
    }
    else
    {
      // chybné údaje
      $chybovaHlaska = "Chybné přihlašovací údaje";
    }
  }  

require 'static/html_top2.php'; 
?>
<body class="bg2">
 <h1>Přihlášení uživatele</h1>

 <form method="post">
  <div>
    <label for="login">Login</label>
    <input type="text" name="login" id="login" required>
  </div>
  <div>
    <label for="heslo">Heslo</label>
    <input type="password" name="heslo" id="heslo" required>
  </div>
  <input type="submit" value="Přihlásit se" class="login">
</form>
</body>
<?php
  require 'static/html_bottom.php';
?>