<?php
if ($_GET['action'] == "set"){
	setcookie($_GET['name'], $_GET['value'], time() + 600);
}
else if ($_GET['action'] == 'get' && $_GET['value'] != "" && $_GET['name'] != ""){
	echo $_COOKIE[$_GET['name']]."\n";
}
else if ($_GET['action'] == "del" && $_GET['name'] != "" && $_GET['value'] != ""){
	setcookie($_GET['name'], $_GET['value'], time() - 600);
}
?>