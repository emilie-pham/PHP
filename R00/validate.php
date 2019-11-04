<?php
	include ("utils.php");
	session_start();

	if (!file_exists('./private'))
		mkdir('./private');
	if (!file_exists('./private/users'))
		file_put_contents('./private/users', null);
	if (!file_exists('./private/categories'))
		file_put_contents('./private/categories', null);
	if (!file_exists('./private/products'))
		file_put_contents('./private/products', null);
	if (!file_exists('./private/archives'))
		file_put_contents('./private/archives', null);

	$validation = $_SESSION;
	$order = $_SESSION['cart'];

// Count order != 0
// User loggued in

// file put content

	if (count($order) !== 0){
		if ($_SESSION['loggued_on_user'] == null) {
			header("Location: users/login.html");
		}
		else {
			"user is loggued in\n";
			file_put_contents("./private/archives", serialize($validation)."\n");
			echo "YOUR ORDER HAS BEEN PROCESSED\n";
		}
	}
	else {
		echo "your order is empty\n";
	}
?>