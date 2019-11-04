<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<div id="main">
	<div>
			<?php include_once 'navigation.php'; ?>

	</div>
	<div class="wrapper">
		<div class="categories-wrapper">
			<?php include_once 'categories.php'; ?>
		</div>
		<div class="display">
			<?php include_once 'display.php'; ?>
		</div>
	</div>
</div>

</body>
</html>
