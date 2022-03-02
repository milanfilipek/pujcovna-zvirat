<?php
session_start();

if (isset($_SESSION["uzivatel"])) {

  require 'static/db_pripojeni.php';
  
  if (isset($_POST["odstranit"]))
  {
    $dotaz = "
      DELETE FROM vypujcky
      WHERE IDv = {$_POST["odstranit"]}
    ";
    mysqli_query($db, $dotaz);
  }
  
  if (isset($_POST["vratit"]))
  {
	$datum_vyp=date("Y-m-d");
	
    $dotaz = "
      UPDATE vypujcky
	  SET datum_vraceni = '$datum_vyp'
      WHERE IDv = {$_POST["vratit"]}  
    ";
    $vypujcky = mysqli_query($db, $dotaz);
  }  
}
require 'static/html_top.php';
?>

  <h1>Výpujčky</h1>
 <?php
      if (isset($_SESSION["uzivatel"])) {
 ?> 
  <p>Zde se můžete kouknout na historii vašich výpůjček.</p>

	<table class="adminVypis">
		<tr>
			<th>Uživatel</th>
			<th>Zvíře</th>
			<th>Datum vypůjčení</th>
			<th>Datum expirace</th>
			<th>Datum vrácení</th>
			<th>Administrace</th>
		</tr>
<?php
  if($_SESSION["uzivatel"]["role"] == 'admin'){ 
	  $dotaz = "
		SELECT v.*, z.*, u.jmeno AS jmenouziv, u.prijmeni
		FROM vypujcky v INNER JOIN zvirata z ON v.IDz = z.IDz INNER JOIN uzivatele u ON v.IDu = u.IDu
	  ";
	  $vypujcky = mysqli_query($db, $dotaz);
	  $vypujcky = mysqli_fetch_all($vypujcky, MYSQLI_ASSOC);
	  
	  foreach ($vypujcky as $vypujcka) {
		echo "<tr>
				<td>
				  {$vypujcka["prijmeni"]} {$vypujcka["jmenouziv"]}
				</td>
				<td>
				  {$vypujcka["jmeno"]}
				</td>
				<td>
				  {$vypujcka["datum_vyp"]}
				</td>
				<td>
				  {$vypujcka["datum_exp"]}
				</td>
				<td>
				  {$vypujcka["datum_vraceni"]}
				</td>
				<td>
				  <form method=\"post\">
				   <input type='hidden' name='vratit' value='{$vypujcka["IDv"]}'>
				   <input type='submit' value='Vrátit' class='login'>
				  </form>
				  <form method=\"post\">
				   <input type='hidden' name='odstranit' value='{$vypujcka["IDv"]}'>
				   <input type='submit' value='Odstranit' class='login'
	  onclick=\"return window.confirm('Chcete opravdu výpujčku zviřete {$vypujcka["jmeno"]} od uživatele {$vypujcka["prijmeni"]} {$vypujcka["jmenouziv"]} odstranit?')\">
				  </form>
				 </td> 
			  </tr>";
	  }
  }
  else{
	  $dotaz = "
		SELECT v.*, z.*, u.jmeno AS jmenouziv, u.prijmeni
		FROM vypujcky v INNER JOIN zvirata z ON v.IDz = z.IDz INNER JOIN uzivatele u ON v.IDu = u.IDu
		WHERE v.IDu = {$_SESSION["uzivatel"]["IDu"]}
	  ";
	  $vypujcky = mysqli_query($db, $dotaz);
	  $vypujcky = mysqli_fetch_all($vypujcky, MYSQLI_ASSOC);
	
	  
	  foreach ($vypujcky as $vypujcka) {
		echo "<tr>
				<td>
				  {$vypujcka["prijmeni"]} {$vypujcka["jmenouziv"]}
				</td>
				<td>
				  {$vypujcka["jmeno"]}
				</td>
				<td>
				  {$vypujcka["datum_vyp"]}
				</td>
				<td>
				  {$vypujcka["datum_exp"]}
				</td>
				<td>
				  {$vypujcka["datum_vraceni"]}
				</td>
				<td>
				  <form method=\"post\">
				   <input type='hidden' name='vratit' value='{$vypujcka["IDv"]}'>
				   <input type='submit' value='Vrátit' class='login'>
				  </form>
				 </td> 
			  </tr>";
	  }
	
	}
?>
</table>
<?php
  } else {
?>
  <p>Pro vypsání výpůjček se přihlašte!</p>
<?php
  }
?>


<?php
	require 'static/html_bottom.php';
?>