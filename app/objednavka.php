<?php
session_start();
require 'static/db_pripojeni.php';

require 'static/html_top.php';

  $dotaz = "
    SELECT *, DATEDIFF(CURTIME(), dat_nar) as vek
    FROM zvirata
	WHERE IDz = {$_GET['id']};
  ";
  $zvirata = mysqli_query($db, $dotaz);
  $zvirata = mysqli_fetch_all($zvirata, MYSQLI_ASSOC);
?>

  <h1>Objednávka</h1>
  <p>Před půjčením zvířete zkontrolujte, zda-li fakt chcete si zapůjčit toto zvíře.</p>	

<?php
  if(isset($_POST['order_zvire'])) {
	$userID = $_SESSION["uzivatel"]["IDu"];
	
	$datum_vyp=date("Y-m-d");
	
	$datum_exp=date_create(date("Y-m-d"));
	date_add($datum_exp,date_interval_create_from_date_string("1 month"));
	$datum_exp=date_format($datum_exp,"Y-m-d");

	$query = "INSERT INTO vypujcky(IDz, IDu, datum_vyp, datum_exp) 
  			  VALUES('{$_GET['id']}', '$userID', '$datum_vyp', '$datum_exp')";
			  
  	mysqli_query($db, $query);
	header('Location: vypujcky.php');
  }
  foreach ($zvirata as $zvire) {
	$days = $zvire["vek"];

	$start_date = new DateTime();
	$end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
	$dd = date_diff($start_date,$end_date);
	
	$id=$zvire['IDz'];
	echo "<div class='objednavka'>";
		echo "<img src='{$zvire["obrazek"]}'>";
		echo "<h3>{$zvire["jmeno"]}</h3>";
		echo "<h4>{$zvire["druh"]}</h4>";
		if($dd->y == 0){
			echo "<h4>Věk: ".$dd->m."měsíců ".$dd->d."dnů"."</h4>";
		}
		else{
			echo "<h4>Věk: ".$dd->y."roků ".$dd->m."měsíců ".$dd->d."dnů"."</h4>";
		}
		echo "<p class='popis'>{$zvire["popis"]}</p>";
		if(isset($_SESSION['uzivatel']))
			echo "<form method='post'>
					  <input type='submit' name='order_zvire' value='Zapůjčit' class='zapujcitorderbtn'/>
				  </form>";
		else
			echo "<p class='chyba'>Pro zapůjčení zvířete se musíte příhlásit!</p>";
	echo "</div>";
  }
?>
</ul>
<?php
	require 'static/html_bottom.php';
?>