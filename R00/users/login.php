<?php
session_start();
include ('./../utils.php');

// Get arguments for auth function
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK'){
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['passwd'] = $_POST['passwd'];
}
else if ($_GET['login'] && $_GET['passwd']){
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}

// Get file with all users / passwd and compare
$file = unserialize(file_get_contents('../private/users'));
$_SESSION['loggued_on_user'] = "";
if (auth($_SESSION['login'], $_SESSION['passwd'])){
	$_SESSION['loggued_on_user'] = $_SESSION['login'];
  	header('Location: ./../index.php');
  	exit();
}
else
	echo "ERROR\n";
?>
