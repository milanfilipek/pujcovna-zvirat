<?php
session_start();

$jmeno = "";
$prijmeni = "";
$login = "";
$email = "";
$dat_nar = "";
$errors = array(); 

require 'static/db_pripojeni.php';

require 'static/html_top.php';

if (isset($_POST['reg_user'])) {
  $jmeno = mysqli_real_escape_string($db, $_POST['jmeno']);
  $prijmeni = mysqli_real_escape_string($db, $_POST["prijmeni"]);
  $login = mysqli_real_escape_string($db, $_POST['login']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $dat_nar = mysqli_real_escape_string($db, $_POST['dat_nar']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($jmeno)) { array_push($errors, "Tento údaj je povinný: jméno"); }
  if (empty($prijmeni)) { array_push($errors, "Tento údaj je povinný: příjmení"); }
  if (empty($login)) { array_push($errors, "Tento údaj je povinný: přihlašovací jméno"); }
  if (empty($email)) { array_push($errors, "Tento údaj je povinný: email"); }
  if (empty($dat_nar)){ array_push($errors, "Tento údaj je povinný: datum narození"); }
  if (empty($password_1)) { array_push($errors, "Tento údaj je povinný: heslo"); }
  if (empty($password_2)) { array_push($errors, "Tento údaj je povinný: znovu heslo"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Hesla se musí shodovat!");
  }

  $user_check_query = "SELECT * FROM uzivatele WHERE login='$login' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['login'] === $login) {
      array_push($errors, "Toto přihlašovací jméno už existuje.");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Tento email již existuje.");
    }
  }

  if (count($errors) == 0) {
  	$password = sha1($password_1);

  	$query = "INSERT INTO uzivatele(jmeno, prijmeni, login, heslo, dat_nar, email, role) 
  			  VALUES('$jmeno', '$prijmeni', '$login', '$password', '$dat_nar', '$email', 'uzivatel')";
  	mysqli_query($db, $query);
	
  	$_SESSION['login'] = $login;
  	$_SESSION['success'] = "Jste přihlášen";
	header('location: index.php');
  }
}
?>

<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>

<body class="bg2">
  <div class="header">
  	<h1>Vytvoření nového účtu</h1>
  </div>
	
  <form method="post" action="registrace.php">
	<div class="input-group">
  	  <label>Jméno</label>
  	  <input type="text" name="jmeno" id="jmeno">
  	</div>

	<div class="input-group">
  	  <label>Příjmení</label>
  	  <input type="text" name="prijmeni" id="prijmeni" >
  	</div>

  	<div class="input-group">
  	  <label>Přihlašovací jméno</label>
  	  <input type="text" name="login" id="login">
  	</div>

  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" id="email">
  	</div>
	
	<div class="input-group">
		<label>Datum narození</label>
		<input type="date" name="dat_nar" id="dat_nar">
	</div>
	
  	<div class="input-group">
  	  <label>Heslo</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Znovu heslo</label>
  	  <input type="password" name="password_2">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Zaregistrovat</button>
  	</div>
  	<p class="mateucet">
  		Už máte účet? Přihlásit se můžete zde. <a href="login.php">Přihlásit se</a>
  	</p>
  </form>
</body>
</html>
<?php
    require 'static/html_bottom.php';
?>