<?php
session_start();
require 'static/db_pripojeni.php';

require 'static/html_top.php';
?>
  <style>
 * {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  transition: 0.25s;
  background-color: white;
  color: black;
  padding: 12px 20px;
  transition: 0.25s;
  background-color: white;
  color: black;
  cursor: pointer;
  text-align: center;
  border: 2px solid black;
  border-radius: 2px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
}

input[type=submit]:hover, .input-group button:hover{
  background-color: black;
  color: white;	
}

.container {
  border-radius: 5px;
  background-color: rgb(255, 255, 255, 0.6);
  padding: 50px;
}

.column {
  float: left;
  width: 50%;
  margin-top: 6px;
  padding: 20px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
.form1 label{
  text-align: left;
}
@media screen and (max-width: 600px) {
  .column, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
  </style>
  <div class="container">
  <div style="text-align:center">
  <h1>Nejčastější dotazy</h1>
  <h3>Jak vznikl nápad na stránku</h3>
	<p>Jeden deštivý den se Filip a Milan sešli, aby dali dohromady nápad století. Ať dělali co dělali tak stále žádný dobrý nápad. Když v tom vrazil do dveří posel se zprávou pro dva mistry. Ve zprávě stálo že Velký Miloš si žádá jejich okamžité přítomnosti na Hradu. Když před mocného Miloše Milan a Filip předstoupili byli velice zvědaví o co se jedná. Velký Miloš jim povyprávěl o jeho problémech. Nemohl si vybrat šelmu, která by stála po jeho boku. Totiž k tak velké a mocné osobnosti musí patřit bestie stejné velikosti. Ale Pražské zoo byly už vyprázdněné a panovník začínal být zoufalý. A tak se Milan a Filip rozhodli, že svému panovníkovi vytvoří velký katalog šelem a všelijakých zvířat z celého světa. Ale napadlo je, co kdyby si Miloš zvíře vzal, ale pak se rozdhodl, že to není to pravé jako to udělal i minulých případů. A tak se z katalogu stala velká půjčovna.</p>
  <h3>Jak vznikla samotná půjčovna</h3>
	<p>Ovšem ani tak moc dokonalý nápad měl jednu malou chybu. Na tak velký projekt prostě neměli finance. Obrátili se tedy na největšího investora dnešní doby Andyho Bejbiše. Ten jim po vyslechnutí samozřejmě velice rád pomohl. A tak vznikla naše geniální půjčovna!</p>
  <h3>Máš na nás další otázky či nové nápady?</h3>
  
	<h4>Kontaktuj nás</h4>
    <p>Přijď na Pražský hrad, kde má půjčovna jedinou pobočku nebo zanech zprávu:</p>
  </div>
  <div class="row">
    <div class="column">
      <img src="imgs/mapa.JPG" alt="Fotka mapy pražského hradu" style="height:53%;width:100%">
    </div>
    <div class="column">
      <form class="form1">
        <label for="fname">Jméno</label>
        <input type="text" id="fname" name="firstname" placeholder="Křestní jméno">
        <label for="lname">Příjmení</label>
        <input type="text" id="lname" name="lastname" placeholder="Příjmení">
        <label for="country">Země</label>
        <select id="country" name="country">
          <option value="cr">Česká Republika</option>
          <option value="kan">Kanada</option>
          <option value="usa">USA</option>
		  <option value="aus">Austrálie</option>
		  <option value="sk">Slovensko</option>
		  <option value="uk">UK</option>
		  <option value="rus">Rusko</option>
		  <option value="nz">Nový Zéland</option>
		  <option value="ne">Německo</option>
        </select>
        <label for="subject">Zpráva</label>
		<textarea id="subject" name="subject" placeholder="Napiš nám.." style="height:170px"></textarea>
        <input type="submit" value="Odeslat">
      </form>
	</div>
  </div>
</div>
<?php
	require 'static/html_bottom.php';
?>