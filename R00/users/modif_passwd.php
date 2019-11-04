<?php
include ('./../utils.php');
session_start();

$username = $_POST['login'];
$oldpasswd = hash('ripemd160', $_POST['oldpw']);
$passwd = $_POST['passwd'];

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
			<?if ($username && $oldpasswd && $passwd && $_POST['submit'] == 'OK') {
				// If file exists, check if username exists in file with current passwd
				if ($userfile) {
					foreach ($userfile as $k => $v) {
						if ($v['login'] === $username && $v['passwd'] == $oldpasswd){
							$userfile[$k]['passwd'] = hash('ripemd160', $passwd);
							file_put_contents('../private/users', serialize($userfile)."\n");?>
							<h1 class="h1-message"><i><? echo $username ?></i>'s password successfully modified</h1><br />
							<? if ($_SESSION['loggued_on_user'] === $username) {?>
							<a href="/users/myaccount.php"><i>👈 Back to my account</i></a><br />
							<?} else if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
							<a href="/admin.php"><i>👈 Retour au compte admin</i></a><br />
							<?}
							exit();
						}
					}
				}
			}?>
			<h1 class="h1-message">Mauvaise combinaison login / mot de passe !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="/admin.php"><i>👈 Retour au compte admin</i></a><br />
			<?} else {?>
				<a href="/users/myaccount.php"><i>👈 Back to my account</i></a><br />
			<?}?>
		</div>
	</body>
</html>
