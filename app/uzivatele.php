<?php
session_start();

 if (isset($_SESSION["uzivatel"])) {

  require 'static/db_pripojeni.php';
  
  if (isset($_POST["odstranit"]))
  {
    $dotaz = "
      DELETE FROM uzivatele
      WHERE IDu = {$_POST["odstranit"]}
    ";
    mysqli_query($db, $dotaz);
  }
  
  if (isset($_POST["jmeno"])) {
    if (   !empty($_POST["jmeno"]) 
        && !empty($_POST["prijmeni"])
        && !empty($_POST["login"])
		&& !empty($_POST["dat_nar"])
		&& !empty($_POST["email"])
       )
    {   
      if (!empty($_POST["IDu"]))
      {
        $dotaz = "
          UPDATE uzivatele
          SET 
          jmeno = '{$_POST["jmeno"]}',
          prijmeni = '{$_POST["prijmeni"]}',
		  login = '{$_POST["login"]}',
          ".
          ($_POST["heslo"] ? "heslo = '".sha1($_POST["heslo"])."'," : "")
          ."
          dat_nar = '{$_POST["dat_nar"]}',
		  email = '{$_POST["email"]}'
          WHERE IDu = {$_POST["IDu"]} 
        ";
        mysqli_query($db, $dotaz);
        header("Location: uzivatele.php");
      }
	  else
		$chybovaHlaska = "Nebyl vybrán uživatel k editaci! Prosím vyberte uživatele k editaci pomocí tlačítek v Administraci.";    
    }
    else
      $chybovaHlaska = "Všechna povinná pole musí být vyplněna!";    
  } 	 
  
  if (isset($_POST["editovat"]))
  {
    $dotaz = "
      SELECT *
      FROM uzivatele
      WHERE IDu = {$_POST["editovat"]}  
    ";
    $uzivatel = mysqli_query($db, $dotaz);
    $uzivatel = mysqli_fetch_assoc($uzivatel);
  }  
  
  else
   $uzivatel = array(
     "IDu" => "",
     "jmeno" => "",
     "prijmeni" => "",
     "login" => "",
     "heslo" => "",
     "dat_nar" => "",
	 "email" => "",
   );
   
  }
  
require 'static/html_top.php';  
?>

 
 <h1>Uživatelé</h1>
 
 <?php
      if (isset($_SESSION["uzivatel"])) {
 ?>

 <form method="post">
  <input type="hidden" name="IDu"
    value="<?= $uzivatel["IDu"] ?>"> 
	
  <div>
    <label for="jmeno">Jméno</label>
    <input type="text" name="jmeno" id="jmeno" required
     value="<?= $uzivatel["jmeno"] ?>">
  </div>
  <div>
    <label for="prijmeni">Příjmení</label>
    <input type="text" name="prijmeni" id="prijmeni" required
    value="<?= $uzivatel["prijmeni"] ?>">
  </div>
  <div>
    <label for="login">Login</label>
    <input type="text" name="login" id="login" required
    value="<?= $uzivatel["login"] ?>">
  </div>
  <div>
    <label for="heslo">Heslo</label>
    <input type="password" name="heslo" id="heslo" 
    <?= empty($uzivatel["IDu"]) ? "required" : ""?>>
  </div>
  <div>
    <label for="dat_nar">Datum narození</label>
    <input type="date" name="dat_nar" id="dat_nar" required
    value="<?= $uzivatel["dat_nar"] ?>">
  </div>
  <div>
	<label for="email">Email</label>
	<input type="email" name="email" id="email" required
	value="<?= $uzivatel["email"] ?>">
  </div>
  <input type="submit" value="Uložit" class="login">
</form>

<table class="adminVypis">
<tr>
  <th>Jméno</th>
  <th>Login</th>
  <th>Datum narození</th>
  <th>Email</th>
  <th>Role</th>
  <th>Administrace</th>
</tr>
<?php
  if($_SESSION["uzivatel"]["role"] == 'admin'){ 
	  $dotaz = "
		SELECT *
		FROM uzivatele
		ORDER BY prijmeni, jmeno
	  ";
	  $uzivatele = mysqli_query($db, $dotaz);
	  $uzivatele = mysqli_fetch_all($uzivatele, MYSQLI_ASSOC);
	  
	  foreach ($uzivatele as $uzivatel) {
		echo "<tr>
				<td>
				  {$uzivatel["prijmeni"]} {$uzivatel["jmeno"]}
				</td>
				<td>
				  {$uzivatel["login"]}
				</td>
				<td>
				  {$uzivatel["dat_nar"]}
				</td>
				<td>
				  {$uzivatel["email"]}
				</td>
				<td>
				  {$uzivatel["role"]}
				</td>
				<td>
				  <form method=\"post\">
				   <input type='hidden' name='editovat' value='{$uzivatel["IDu"]}'>
				   <input type='submit' value='Editovat' class='login'>
				  </form>
				  <form method=\"post\">
				   <input type='hidden' name='odstranit' value='{$uzivatel["IDu"]}'>
				   <input type='submit' value='Odstranit' class='login'
					 onclick=\"return window.confirm('Chcete opravdu uživatele {$uzivatel["prijmeni"]} {$uzivatel["jmeno"]} odstranit?')\">
				  </form>
				 </td> 
			  </tr>";
	  }
  }
  else{
	  $dotaz = "
	  SELECT *
	  FROM uzivatele
	  WHERE IDu = {$_SESSION["uzivatel"]["IDu"]}
	  ";
	  
	  $uzivatel = mysqli_query($db, $dotaz);
	  $uzivatel = mysqli_fetch_assoc($uzivatel);
	
	  echo "<tr>
			<td>
				{$uzivatel["prijmeni"]} {$uzivatel["jmeno"]}
			</td>
			<td>
				  {$uzivatel["login"]}
			</td>
			<td>
				  {$uzivatel["dat_nar"]}
			</td>
			<td>
				  {$uzivatel["email"]}
			</td>
			<td>
			  uzivatel
			</td>
			<td>
			  <form method=\"post\">
			   <input type='hidden' name='editovat' value='{$uzivatel["IDu"]}'>
			   <input type='submit' value='Editovat' class='login'>
			  </form>
			  <form method=\"post\">
			   <input type='hidden' name='odstranit' value='{$uzivatel["IDu"]}'>
			   <input type='submit' value='Odstranit' class='login'
			    onclick=\"return window.confirm('Chcete opravdu uživatele {$uzivatel["prijmeni"]} {$uzivatel["jmeno"]} odstranit?')\">
			  </form>
			</td> 
			</tr>";
	
	}
?>
</table>

<?php
  } else {
?>
  <p>Pro správu uživatelů se přihlašte!</p>
<?php
  }
?>

<?php
  require 'static/html_bottom.php';
?>