<?php
include ('../utils.php');
session_start();

// Get new product variables
$name = $_POST['name'];

if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists('../private/products'))
	file_put_contents('../private/products', null);
if (!file_exists('../private/users'))
	file_put_contents('../private/users', null);

$userfile = unserialize(file_get_contents('../private/users'));
$productfile = unserialize(file_get_contents('../private/products'));
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Delete Product</title>
		<style>
			*{
				font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			}
			body{
				background-color: #f2f2f2;
			}
			.product{
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
		<div class='product'>
		<?if ($name && $_POST['submit'] == 'Delete') {
			$already_exist = 0;
			if ($productfile) {
				foreach ($productfile as $k => $v) {
					if ($v['name'] === $name) {
						$already_exist = 1;
						unset($productfile[$k]);
						$productfile = array_values($productfile);
						file_put_contents('../private/products', serialize($productfile)."\n");?>
						<h1 style="text-align: center;"><i>Product <? echo $name ?></i> successfully deleted <i><? echo $new_name ?></i></h1><br />
						<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
						<a href="../admin.php"><i>Go back to admin page</i></a><br />
						<?} else {?>
						<a href="./index.php"><i>Homepage</i></a><br />
						<?}
						exit();
					}
				}
			}
			if (!$already_exist) {?>
				<h1 style="text-align: center;">Product <i><? echo $name ?></i> doesn't exist !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="../admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="./index.php"><i>Homepage</i></a><br />
			<?}
			}
		}
		else {?>
			<h1 style="text-align: center;">Product name can not be empty !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="../admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="./index.php"><i>Homepage</i></a><br />
			<?}
		}?>
		</div>
	</body>
</html>
