<?php
session_start();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../index.css">
	<link rel="stylesheet" href="myaccount.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<title>Document</title>
</head>
<div id="main">
	<?php include_once '../navigation.php';?>
	<?php if ($_SESSION['loggued_on_user'])?>
	<h1 class="h1-account">Hello <?php echo $_SESSION['loggued_on_user']?> ! 👋</h1>
	<h2 class="h2-account">Bienvenue sur ton compte</h2>
	<hr>
	<h3 class="h3-account">✏️ Modifier mon compte</h3>
	<div class='modify-account-wrapper'>
		<div class=''>
			<h4 class="h4-account">👥 Modifier mon login</h4><br />
			<form action="./modif_username.php" method="POST">
				<input placeholder="Login" type="text" name="login" value=""/>
				<br />
				<input placeholder="Nouveau login" type="text" name="newlogin" value=""/>
				<br />
				<input placeholder="Mot de passe" type="text" name="passwd" value=""/>
				<br /><br />
				<input class="valid-form-account" type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />
		<div class=''>
			<h4 class="h4-account">🔒 Modifier mon mot de passe</h4><br />
			<form action="./modif_passwd.php" method="POST">
				<input placeholder="Login" type="text" name="login" value=""/>
				<br />
				<input placeholder="Mot de passe actuel" type="text" name="oldpw" value=""/>
				<br />
				<input placeholder="Nouveau mot de passe" type="text" name="passwd" value=""/>
				<br /><br />
				<input class="valid-form-account" type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />
		<div class=''>
			<h4 class="h4-account">❌ Supprimer mon compte</h4><br />
			<form action="./del_user.php" method="POST">
				<input placeholder="Login" type="text" name="deluser" value=""/>
				<br />
				<input placeholder="Mot de passe" type="text" name="passwd" value=""/>
				<br />
				<input placeholder="Confirmer mot de passe" type="text" name="confpw" value=""/>
				<br /><br />
				<input class="valid-form-account" type='submit' name='submit' value='Delete'/>
			</form><br />
		</div><br />
	</div>
</html>
