<?php
session_start();
if ($_GET['login'] && $_GET['passwd'] && $_GET['submit'] == 'OK'){
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
?>
<html><body>
<form action='index.php' method='GET'>
Identifiant: <input type='text' name='login' value=''/>
<br />
Mot de passe: <input type='text' name='passwd' value=''/>
<br />
<input type='submit' name='submit' value='OK'/>
</form>
</body></html>
