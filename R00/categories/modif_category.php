<?php
include ('./../utils.php');
session_start();

$category_name = $_POST['oldname'];
$new_name = $_POST['newname'];

//  Check if private folder exists and if not creates it
if (!file_exists('../private'))
mkdir('../private');
// Check if passwd file exists and if not creates it ans append username and passwd values
if (!file_exists('../private/users'))
file_put_contents('../private/users', null);

if (!file_exists('../private/categories'))
file_put_contents('../private/categories', null);

$userfile = unserialize(file_get_contents("./../private/users"));
$category_file = unserialize(file_get_contents("./../private/categories"));

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
		<?if ($category_name && $new_name && $_POST['submit'] == 'OK') {
			if ($category_file) {
				$category_exists = 0;
				foreach ($category_file as $k => $v) {
					if ($v['name'] === $new_name)
						$category_exists += 1;
				}
				if ($category_exists !== 0){?>
					<h1 style="text-align: center;"><i>Category <? echo $new_name ?></i> already exist !</h1><br />
					<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
						<a href="../admin.php"><i>Go back to admin page</i></a><br />
					<?} else {?>
						<a href="./index"><i>Homepage</i></a><br />
					<?}
					exit();
				}
				else {
					foreach ($category_file as $k => $v) {
						if ($v['name'] === $category_name){
							$category_file[$k]['name'] = $new_name;
							file_put_contents('../private/categories', serialize($category_file)."\n");?>
							<h1 style="text-align: center;"><i><? echo $category_name ?></i> successfully renamed <i><? echo $new_name ?></i></h1><br />
							<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
							<a href="../admin.php"><i>Go back to admin page</i></a><br />
							<?} else {?>
							<a href="./login.html"><i>Log in</i></a><br />
							<?}
							exit();
						}
					}
				}
			}?>
			<h1 style="text-align: center;"><i><? echo $category_name ?></i> doesn't exist !</h1><br />
			<? if (is_admin($_SESSION['loggued_on_user'], $userfile) == 1){?>
				<a href="../admin.php"><i>Go back to admin page</i></a><br />
			<?} else {?>
				<a href="./login.html"><i>Log in</i></a><br />
			<?}
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
