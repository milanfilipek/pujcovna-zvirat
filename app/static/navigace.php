<ul>
  <li class="<?=($activePage == 'index') ? 'active':''; ?>"><a href="index.php">Úvod</a></li>
  <li class="<?= ($activePage == 'zvirata') ? 'active':''; ?>"><a href="zvirata.php">Zvířata</a></li>
  <li class="<?= ($activePage == 'vypujcky') ? 'active':''; ?>"><a href="vypujcky.php">Výpujčky</a></li>
  <li class="<?= ($activePage == 'uzivatele') ? 'active':''; ?>"><a href="uzivatele.php">Uživatelé</a></li>
  <li class="<?= ($activePage == 'about') ? 'active':''; ?>"><a href="about.php">O nás</a></li>
  <?php
    include 'panelUzivatele.php';
  ?>
</ul>