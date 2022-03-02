<?php
session_start();
require 'static/db_pripojeni.php';

require 'static/html_top.php';

  $dotaz = "
    SELECT z.*, DATEDIFF(CURTIME(),z.dat_nar) as vek
    FROM zvirata z LEFT JOIN vypujcky v ON z.IDz = v.IDz
	WHERE v.IDz IS NULL OR v.IDz NOT IN (SELECT z.IDz FROM zvirata z LEFT JOIN vypujcky v ON z.IDz = v.IDz WHERE v.datum_vraceni IS NULL)
	GROUP BY z.jmeno
  ";
  $zvirata = mysqli_query($db, $dotaz);
  $zvirata = mysqli_fetch_all($zvirata, MYSQLI_ASSOC);
?>

  <h1>Zvířata</h1>
  <p>Zde se můžete kouknout na všechna zvířata, které momentálně jsou dostupné k půjčení.</p>	

<?php
  foreach ($zvirata as $zvire) {
	$days = $zvire["vek"];

	$start_date = new DateTime();
	$end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
	$dd = date_diff($start_date,$end_date);
	
	$id=$zvire['IDz'];
	echo "<div class='zvirata'>";
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
		echo "<form action='objednavka.php?id=$id' method='post'>
			      <input type='submit' name='vypujceni' value='Zapůjčit' class='zapujcitbtn'/>
			  </form>";
	echo "</div>";
  }
?>
</ul>
<?php
	require 'static/html_bottom.php';
?>