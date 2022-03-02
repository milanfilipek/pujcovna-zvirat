<div class="panelUzivatel">
    <?php
      if (isset($_SESSION["uzivatel"])) {
    ?>
      <li>Přihlášený uživatel: <?= $_SESSION["uzivatel"]["jmeno"] ?> <?= $_SESSION["uzivatel"]["prijmeni"] ?></li>
	  <li><a href="logout.php">Odhlásit se</a></li>
    <?php
      } else {
    ?>
      <li class="<?=($activePage == 'login') ? 'active':''; ?>"><a href="login.php">Přihlásit se</a></li>
	  <li class="<?=($activePage == 'registrace') ? 'active':''; ?>"><a href="registrace.php">Registrovat se</a></li>
    <?php
      }
    ?>
 </div>