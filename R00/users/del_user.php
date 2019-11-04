<?php
include ('../utils.php');
session_start();

if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists('../private/users'))
	file_put_contents('../private/users', null);
if (!file_exists('../private/categories'))
	file_put_contents('../private/categories', null);
if (!file_exists('../private/products'))
	file_put_contents('../private/products', null);

$unsrzd = unserialize(file_get_contents("./../private/users"));
$admin_login = $_SESSION['loggued_on_user'];
$user_to_del = $_POST['deluser'];
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="myaccount.css">
		<title>Delete User</title>
	</head>
	<body>
		<div class='box-message'>
		<? $i = 0;
			if ($user_to_del && $unsrzd && $_POST['submit'] == 'Delete' && !is_admin($user_to_del, $unsrzd) && (is_admin($admin_login, $unsrzd) || $_SESSION['loggued_on_user'] == $_POST['deluser'])) {
				foreach ($unsrzd as $key => $value) {
					if ($value['login'] === $user_to_del) {
						unset($unsrzd[$key]);
						$unsrzd = array_values($unsrzd); // reindex from 0;
						file_put_contents("./../private/users", serialize($unsrzd)."\n");
						$i = 1;?>
							<h1 class="h1-message">L'utilisateur <i><? echo $user_to_del ?></i> a été supprimé !</h1><br />
							<?if (is_admin($admin_login, $unsrzd) == 1){?>
							<a href="../admin.php"><i>👈 Retour au compte admin</i></a><br />
							<?} else {
							session_destroy();
							?>
							<a href="/index.php"><i>👈 Home</i></a><br /><?
							exit();
							}
					}
				}
				if ($i === 0){?>
					<h1 class="h1-message">User <? echo $user_to_del ?> n'existe pas</h1><br />
					<? if (is_admin($admin_login, $unsrzd) == 1){?>
						<a href="../admin.php"><i>Essaie encore !</i></a><br />
					<?} else {
						session_destroy();
						?>
						<a href="./myaccount.php"><i>👈 Retour à mon compte</i></a><br />
					<?exit();						
					}
				}
			if (is_admin($user_to_del, $unsrzd)){?>
				<h1 class="h1-message">Tu ne peux pas supprimer un compte admin !</h1><br />
				<a href="../admin.php"><i>👈 Retour au compte admin</i></a><br />
			<?}
			else if (!$user_to_del) {?>
				<h1 class="h1-message">Le login ne peut pas être vide !</h1><br />
				<? if (is_admin($admin_login, $unsrzd) == 1){?>
					<a href="../admin.php"><i>👈 Retour au compte admin</i></a><br />
				<?} else {
					session_destroy();
					?>
					<a href="./myaccount.php"><i>👈 Retour à mon compte</i></a><br />
				<?}
			}
		}?>
		</div>
	</body>
</html>
