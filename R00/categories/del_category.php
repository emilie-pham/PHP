<?php
include ('./../utils.php');
session_start();

$name = $_POST['name'];

//  Check if private folder exists and if not creates it
if (!file_exists("../private"))
	mkdir("../private");
if (!file_exists("../private/users"))
	file_put_contents("../private/users", null);
if (!file_exists("../private/categories"))
	file_put_contents("../private/categories", null);
if (!file_exists("../private/products"))
	file_put_contents("../private/products", null);

$userfile = unserialize(file_get_contents("../private/users"));
$productfile = unserialize(file_get_contents("../private/products"));
$category_file = unserialize(file_get_contents("../private/categories"));

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Page</title>
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
			form{
				margin: auto;
			}
			a {
				text-decoration: none;
				text-align: center;
				color: black;
				margin-left: 45%;
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
		<div class='box'>
		<?if ($name && $_POST['submit'] == "Delete") {
			// If file exists, check if username exists in file with current passwd
			if ($category_file) {
				$nocategory = 1;
				foreach ($category_file as $k => $v) {
					if ($v['name'] === $name){
						unset($category_file[$k]);
						$category_file = array_values($category_file);
						file_put_contents("../private/categories", serialize($category_file)."\n");?>
						<h1 style="text-align: center;"><i>Category <? echo $name ?></i> successfully deleted <i><? echo $new_name ?></i></h1><br />
						<? $nocategory = 0;
					}
				}
				if ($nocategory === 0){
					// Remove category from existing products
					foreach ($productfile as $file => $category) {
						$category_list = ($productfile[$file]['categories']);
						foreach ($category_list as $k => $v){
							if ($v === $name){
								unset($productfile[$file]['categories'][$k]);
								$productfile = array_values($productfile);
							}
						}
					}
					file_put_contents("../private/products", serialize($productfile)."\n");?>
					<h1 style="text-align: center;"> Category <i><? echo $name ?></i> successfully deleted from all products</h1><br />
					<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
						<a href="/admin.php"><i>Go back to admin page</i></a><br />
					<?} else {?>
						<a href="/index.php"><i>Homepage</i></a><br />
					<?}
					exit();
				}
			}?>
			<h1 style="text-align: center;">Category <i><? echo $name ?></i> doesn't exist !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="/admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="/index.php"><i>Homepage</i></a><br />
			<?}
		}
		else {?>
			<h1 style="text-align: center;">Category name can not be empty !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="/admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="/index.php"><i>Homepage</i></a><br />
			<?}
		}?>
		</div>
	</body>
</html>
