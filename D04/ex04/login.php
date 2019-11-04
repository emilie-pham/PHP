<?php
session_start();
include ('auth.php');

if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK'){
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['passwd'] = $_POST['passwd'];
}
else if ($_GET['login'] && $_GET['passwd']){
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
if (file_exists('../private/passwd')){
	$file = unserialize(file_get_contents('../private/passwd'));
	$_SESSION['loggued_on_user'] = "";
	if (auth($_SESSION['login'], $_SESSION['passwd'])){
		$_SESSION['loggued_on_user'] = $_SESSION['login'];
		echo "OK\n"; ?>
		
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
		
		<?php
		exit();
	}
}
echo "ERROR\n";
?>
