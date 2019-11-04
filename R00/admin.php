<?php
	include ('./utils.php');
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Page</title>
		<link rel="stylesheet" href="index.css">
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
	<div id="main">
	<?php

	$userfile = unserialize(file_get_contents("./private/users"));
	if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){
	?>
		<!-- NEW CATEGORY -->
		<div class='box'>
			<h1 style="text-align: center;">Add a new category</h1><br />
			<form action="./categories/create_category.php" method="POST">
				<p>Name : </p>
				<input type="text" name="name" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='OK'/>
			</form><br />
			<a href="../index.html"><i>Go back</i></a><br />
		</div><br />

		<!-- MODIFY CATEGORY -->
		<div class='box'>
			<h1 style="text-align: center;">Modify a category's name</h1><br />
			<form action="./categories/modif_category.php" method="POST">
			<p>Current category name : </p>
			<input type="text" name="oldname" value=""/>
			<br />
			<p>New category name : </p>
			<input type="text" name="newname" value=""/>
			<br /><br />
			<input type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />

		<!-- DELETE CATEGORY -->
		<div class='box'>
			<h1 style="text-align: center;">Delete category</h1><br />
			<form action="./categories/del_category.php" method="POST">
				<p>Category name : </p>
				<input type='text' name='name' value=""/>
				<br /><br />
				<input type='submit' name='submit' value='Delete'/>
			</form><br />
			<a href="../index.html"><i>Go back</i></a><br />
		</div><br />

		<!-- NEW PRODUCT -->
		<div class='box'>
			<h1 style="text-align: center;">Add a new product</h1><br />
			<form action="./products/create_product.php" method="POST">
				<p>Name : </p>
				<input type="text" name="name" value=""/>
				<br />
				<p>Categories : </p>
				<?
				if (!file_exists('./private'))
					mkdir('./private');
				if (!file_exists('./private/categories'))
					file_put_contents('./private/categories', null);
				$file = unserialize(file_get_contents('./private/categories'));
				if ($file){
					foreach ($file as $k => $v) {?>
						<input type="checkbox" name="<?echo $v['name']?>"/><?echo $v['name']?><br/>
					<?}
				}
				?>
				<br /><br />
				<p>Description : </p>
				<input type="text" name="description" value=""/>
				<br /><br />
				<p>Price : </p>
				<input type="text" name="price" value=""/>
				<br /><br />
				<p>Image : </p>
				<input type="text" name="img" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />

		<!-- MODIFY PRODUCT -->
		<div class='box'>
			<h1 style="text-align: center;">Modify existing product</h1><br />
			<form action="./products/modif_product.php" method="POST">
				<p>Current product name : </p>
				<input type="text" name="name" value=""/>
				<br />
				<p>New name : </p>
				<input type="text" name="newname" value=""/>
				<br />
				<p>Categories : </p>
				<?
				if (!file_exists('./private'))
					mkdir('./private');
				if (!file_exists('./private/categories'))
					file_put_contents('./private/categories', null);
				$file = unserialize(file_get_contents('./private/categories'));
				if ($file){
					foreach ($file as $k => $v) {?>
						<input type="checkbox" name="<?echo $v['name']?>"/><?echo $v['name']?><br/>
					<?}
				}
				?>
				<br /><br />
				<p>Description : </p>
				<input type="text" name="description" value=""/>
				<br /><br />
				<p>Price : </p>
				<input type="text" name="price" value=""/>
				<br /><br />
				<p>Image : </p>
				<input type="text" name="img" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />

		<!-- DELETE PRODUCT -->
		<div class='box'>
			<h1 style="text-align: center;">Delete a product</h1><br />
			<form action="./products/del_product.php" method="POST">
				<p>Product name : </p>
				<input type="text" name="name" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='Delete'/>
			</form><br />
		</div><br />

		<!-- NEW ACCOUNT -->
		<div class='box'>
			<h1 style="text-align: center;">Create a new account</h1><br />
			<form action="./users/create_user.php" method="POST">
				<p>Login : </p>
				<input type="text" name="login" value=""/>
				<br />
				<p>Password : </p>
				<input type="text" name="passwd" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='OK'/>
			</form><br />
		</div>
		</div><br />

		<!-- MODIFY ACCOUNT -->
		<div class='box'>
			<h1 style="text-align: center;">Modify an account</h1><br />
			<form action="./users/modif_passwd.php" method="POST">
			<p>Login : </p>
			<input type="text" name="login" value=""/>
			<br />
			<p> Current password : </p>
			<input type="text" name="oldpw" value=""/>
			<br />
			<p> New password : </p>
			<input type="text" name="passwd" value=""/>
			<br /><br />
			<input type='submit' name='submit' value='OK'/>
			</form><br />
		</div><br />

		<!-- DELETE ACCOUNT -->
		<div class='box'>
			<h1 style="text-align: center;">Delete an account</h1><br />
			<form action="./users/del_user.php" method="POST">
				<p>Login : </p>
				<input type="text" name="deluser" value=""/>
				<br /><br />
				<input type='submit' name='submit' value='Delete'/>
			</form><br />
		</div><br />
		<?php }
		else {?>
		<div class='box'>
			<h1 style="text-align: center;">You are not admin !</h1><br />
			<a href="index.php"><i>Go back</i></a><br />
		</div><? } ?>
	<a href="./index.php"><i>Homepage</i></a><br />
	<a href="./orders.php"><i>Orders</i></a><br />

		</div>
	</body>
</html>

