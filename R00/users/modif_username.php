<?php
include ('./../utils.php');
session_start();

$username = $_POST['login'];
$newname = $_POST['newlogin'];
$passwd = hash('ripemd160', $_POST['passwd']);

if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists('../private/users'))
	file_put_contents('../private/users', null);
if (!file_exists('../private/categories'))
	file_put_contents('../private/categories', null);
if (!file_exists('../private/products'))
	file_put_contents('../private/products', null);

$userfile = unserialize(file_get_contents("./../private/users"));
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Page</title>
		<link rel="stylesheet" href="myaccount.css">
	</head>
	<body>
		<div class='box-message'>
			<?if ($username && $_SESSION['loggued_on_user'] === $username && $newname && $passwd && $_POST['submit'] == 'OK') {
				foreach ($userfile as $k => $v) {
					if ($v['login'] === $username && $v['passwd'] === $passwd){
						$userfile[$k]['login'] = $newname;
						$_SESSION['loggued_on_user'] = $newname;
						file_put_contents('../private/users', serialize($userfile)."\n");?>
						<h1 class="h1-message">Le login a bien été modifié !</h1><br />
						<a href="./myaccount.php"><i>👈 Retour à mon compte</i></a><br />
						<?exit();
					}
				}
			}?>
			<h1 class="h1-message">Mauvaise combinaison login / mot de passe !</h1><br />
			<a href="./myaccount.php">👈 Retour à mon compte</a><br />
		</div>
	</body>
</html>
