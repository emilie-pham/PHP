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

$userfile = unserialize(file_get_contents("../private/users"));
$username = $_POST['login'];
$passwd = $_POST['passwd'];

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>create User</title>
		<style>
			*{
				font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			}
			body{
				background-color: #f2f2f2;
			}
			.box{
				margin: auto;
				width: 50%;
				background-color: #ffe6e6;
				padding: 5%;
				border-radius: 2%;
			}
			a {
				text-decoration: none;
				text-align: center;
				color: black;
				margin-left: 35%;
				width: 100%;
				font-size: 20px;
			}
		</style>
	</head>
	<body>
		<div class='box'>
		<!-- IF USERNAME, PASSWORD GOOD FORMAT -->
		<?if ($username && $passwd && $_POST['submit'] == 'OK') {
			$already_exist = 0;
			if ($userfile) {
				foreach ($userfile as $k => $v) {
					if ($v['login'] === $username)
						$already_exist = 1;
				}
			}
			if (!$already_exist) {
				$tmp['login'] = $username;
				$tmp['passwd'] = hash('ripemd160', $passwd);
				$tmp['admin'] = false;
				$userfile[] = $tmp;
				file_put_contents('../private/users', serialize($userfile)."\n");?>
				<h1 style="text-align: center;">User <i><? echo $username ?></i> successfully created</h1><br />
				<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
					<a href="../admin.php"><i>Go back to admin page</i></a><br />
				<?} else {?>
					<a href="./login.html"><i>Log in</i></a><br />
				<?}
			} 
			else {?> 
				<h1 style="text-align: center;">User <i><? echo $username ?></i> already exists</h1><br />
				<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
					<a href="../admin.php"><i>Try again</i></a><br />			
				<?} else {?>
					<a href="./create_user.html"><i>Try again</i></a><br />
				<?}
			}
		}
		else { ?>
			<h1 style="text-align: center;">Wrong user / password format</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="../admin.php"><i>Try again</i></a><br />			
			<?} else {?>
				<a href="./create_user.html"><i>Try again</i></a><br />
			<?}
		}?>
		</div>
	</body>
</html>
