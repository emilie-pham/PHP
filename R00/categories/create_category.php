<?php
include ('../utils.php');
session_start();

$name = $_POST['name'];

if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists('../private/users'))
	file_put_contents('../private/users', null);
if (!file_exists('../private/categories'))
	file_put_contents('../private/categories', null);
if (!file_exists('../private/products'))
	file_put_contents('../private/products', null);

$userfile = unserialize(file_get_contents("../private/users"));
$file = unserialize(file_get_contents('../private/categories'));


?>
<html>
	<head>
		<meta charset="utf-8">
		<title>New Category</title>
		<style>
			*{
				font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			}
			body{
				background-color: #f2f2f2;
			}
			.category{
				margin: auto;
				width: 50%;
				background-color: #ffe6e6;
				padding: 5%;
				border-radius: 2%;
			}
			form{
				margin: auto;
			}
			a {
				text-decoration: none;
				text-align: center;
				color: black;
				margin-left: 35%;
				width: 100%;
				font-size: 20px;
			}
			input[type="text"]{
				width: 70%;
				height: 2%;
			}
		</style>
	</head>
	<body>
		<div class='category'>
		<?if ($name && $_POST['submit'] == 'OK') {
			$already_exist = 0;
			if ($file) {
				foreach ($file as $k => $v) {
					if ($v['name'] === $name) {
						$already_exist = 1;?>
						<h1 style="text-align: center;">Category <i><? echo $name ?></i> already exists</h1><br />
						<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
							<a href="../admin.php"><i>Go back to admin page</i></a><br />
						<?}
						exit();
					}
				}
			}
			if (!$already_exist) {
				$tmp['name'] = $name;
				$file[] = $tmp;
				file_put_contents('../private/categories', serialize($file)."\n");?>
				<h1 style="text-align: center;">Category <i><? echo $name ?></i> successfully created</h1><br />
				<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
					<a href="../admin.php"><i>Go back to admin page</i></a><br />
				<?}
			}
		}
		else {?>
			<h1 style="text-align: center;">Category name can not be empty !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="../admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="./index.php"><i>Homepage</i></a><br />
			<?}
		}?>
		</div>
	</body>
</html>
